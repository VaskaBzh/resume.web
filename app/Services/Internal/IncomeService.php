<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Actions\Income\Complete;
use App\Actions\Income\Create;
use App\Actions\Sub\Update;
use App\Dto\IncomeData;
use App\Dto\SubData;
use App\Enums\Income\Status;
use App\Models\Income;
use App\Models\MinerStat;
use App\Models\Sub;
use App\Models\Wallet;
use App\Services\External\BtcComService;
use Illuminate\Support\Arr;

class IncomeService
{
    public const ALLBTC_FEE = 1.5;
    private array $incomeData = [
        'status' => Status::REJECTED->value,
        'unit' => 'T',
    ];
    private Sub $sub;
    private Wallet $wallet;

    private array $subData = [];

    private function __construct(
        private array $params,
    )
    {}

    public static function buildWithParams(array $params = []): IncomeService
    {
        $params = self::prepareParams($params);

        return new self($params);
    }

    private static function prepareParams(array $params): array
    {
        $collectedParams = collect($params);

        return $collectedParams->flatMap(static fn(array $param) => [
            'fppsPercent' => $param['more_than_pps96_rate'],
            'difficulty' => $param['diff'],
            'reward_block' => MinerStat::first()->reward_block,
        ])->toArray();
    }

    public function getIncomeParam(string $key)
    {
        return Arr::get($this->incomeData, $key);
    }

    public function setIncomeData(string $key, $value): IncomeService
    {
        $this->incomeData[$key] = $value;

        return $this;
    }

    public function setPercent(): IncomeService
    {
        $this->incomeData['percent'] = $this->wallet->percent_withdrawal ?? Wallet::DEFAULT_PERCENTAGE;

        return $this;
    }

    public function canWithdraw(): bool
    {
        return $this->incomeData['payment'] >= Wallet::MIN_BITCOIN_WITHDRAWAL;
    }

    public function setSubData(string $key, $value): IncomeService
    {
        $this->subData[$key] = $value;

        return $this;
    }

    public function setSub(Sub $sub): IncomeService
    {
        $this->sub = $sub;

        return $this;
    }

    public function setWallet(Wallet $wallet): void
    {
        $this->wallet = $wallet;
    }

    /**
     *
     * Проверяем хеш рейт
     * Устанавливаем херщрейт и сложность сети в свойство IncomeData
     *
     * @return bool
     */
    public function setHashRate(): bool
    {
        $hashRate = resolve(BtcComService::class)
            ->getWorkerList($this->sub->group_id)
            ->sum('shares_1d');

        if ($hashRate > 0) {
            $this->params['hashRate'] = $hashRate;
            $this->incomeData['hash'] = $hashRate;
            $this->incomeData['diff'] = $this->params['difficulty'];

            return true;
        }

        return false;
    }

    /**
     * Обновляем запись локального саб-аккаунта
     *
     * @return void
     */
    public function updateLocalSub(): void
    {
        Update::execute(
            subData: SubData::fromRequest([
                'user_id' => $this->sub->user_id,
                'group_id' => $this->sub->group_id,
                'group_name' => $this->sub->sub,
                'payments' => $this->subData['payments'],
                'unPayments' => $this->subData['unPayments'],
                'accruals' => $this->subData['accruals']
            ]),
            sub: $this->sub
        );
    }

    /**
     *
     * Создаем обьект DTO для Income
     *
     * @return IncomeData
     */
    private function buildDto(): IncomeData
    {
        return IncomeData::fromRequest([
            'group_id' => $this->sub->group_id,
            'percent' => $this->incomeData['percent'],
            'txid' => Arr::get($this->incomeData, 'txid'),
            'wallet' => $this->wallet->wallet,
            'payment' => $this->incomeData['payment'],
            'amount' => $this->incomeData['amount'],
            'unit' => $this->incomeData['unit'],
            'status' => $this->incomeData['status'],
            'message' => $this->incomeData['message'],
            'hash' => $this->incomeData['hash'],
            'diff' => $this->incomeData['diff'],
        ]);
    }

    public function create(): void
    {
        Create::execute(
            incomeData: $this->buildDto()
        );
    }

    /**
     * Меняем статусы и сообщения на "completed"
     */
    public function complete(): void
    {
        $incomes = Income::getNotCompleted(
            groupId: $this->sub->group_id,
            walletUid: $this->wallet->wallet
        )->get();

        if ($incomes) {
            Complete::execute(
                incomes: $incomes,
                incomeData: $this->buildDto()
            );
        }
    }

    public function createLocalIncome(): void
    {
        $income = $this->getIncome();

        if ($income) {
//            if ($income->created_at->diffInHours(now()) > 12) {
                $this->create();
//            }
        } else {
            $this->create();
        }
    }

    public function getIncome(): ?Income
    {
        return Income::getPrevious(
            groupId: $this->sub->group_id,
            walletUid: $this->wallet->wallet
        )
            ->get()
            ->first();
    }

    /**
     * Посчитать добычу саб-аккаунта
     *
     * $earnTime - время добычи блока с заданным хешрейтом ($share * pow(10, 12))
     * $this->>hashRate - хешрейт
     * $this->>rewardBlock - награда за блок
     * $this->>difficulty - сложность сети биткоина
     * $this->>fppsPercent - F(доход от транзакционных комиссий) + PPS (вознаграждение за блок)
     */
    public function getEarn(): float|\Exception
    {
        return match (true) {
            !isset($this->params['difficulty']) => throw new \Exception('Не указана сложность сети'),
            !isset($this->params['hashRate']) => throw new \Exception('Не указан хэшрейт'),
            !isset($this->params['reward_block']) => throw new \Exception('Не указана награда за блок'),
            default => $this->calculate()
        };
    }

    private function calculate(): float
    {
        $secondsPerDay = 86400;
        $earnTime = ($this->params['difficulty'] * pow("2", "32"))
            / (($this->params['hashRate'] * pow("10", "12")) * $secondsPerDay);

        $total = $this->params['reward_block'] / $earnTime;

        return $total + $total * (($this->params['fppsPercent'] - BtcComService::FEE - self::ALLBTC_FEE) / 100);
    }
}

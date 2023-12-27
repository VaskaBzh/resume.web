<?php

declare(strict_types=1);

namespace Feature;

use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Enums\Income\Type;
use App\Models\Income;
use App\Models\User;
use App\Services\ReferralService;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ReferralTest extends TestCase
{
    public User $referrer;

    public User $referral;

    protected function setUp(): void
    {
        parent::setUp();

        $this->referrer = User::where('name', 'Referrer')->first();
        $this->referral = User::where('name', 'Referral')->first();
        $this->referrer->assignRole('referrer');
        $this->referral->markEmailAsVerified();
        $this->referrer->markEmailAsVerified();
    }

    /**
     * @test
     *
     * @testdox it trows error if user not have a rights
     */
    public function checkPermissions(): void
    {
        $this->getJson(route('v1.referral.statistic', $this->referrer))
            ->assertExactJson(['errors' => ['messages' => ['Unauthenticated.']]])
            ->assertStatus(Response::HTTP_UNAUTHORIZED);

        Sanctum::actingAs($this->referral);

        $this->getJson(uri: route('v1.referral.statistic', $this->referral))
            ->assertExactJson(['errors' => ['messages' => ['User does not have the right roles.']]])
            ->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->getJson(uri: route('v1.referral.list', $this->referral))
            ->assertExactJson(['errors' => ['messages' => ['User does not have the right roles.']]])
            ->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->referral->assignRole('referrer');

        $this->getJson(route('v1.referral.statistic', $this->referrer))
            ->assertExactJson(['errors' => ['messages' => ['This action is unauthorized.']]])
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->getJson(route('v1.referral.list', $this->referrer))
            ->assertExactJson(['errors' => ['messages' => ['This action is unauthorized.']]])
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     *
     * @testdox it show referral statistic data
     *
     * @dataProvider incomesDataProvider
     */
    public function showReferralStatistic(array $incomes): void
    {
        Income::insert($incomes);

        Sanctum::actingAs($this->referrer);
        $this->referrer->update(['referral_code' => ReferralService::generateReferralCode($this->referrer)]);

        $this->getJson(route('v1.referral.statistic', $this->referrer))
            ->assertExactJson(data: [
                'data' => [
                    'active_referrals_count' => 1.00,
                    'attached_referrals_count' => 1,
                    'group_id' => 1,
                    'referral_percent' => 1,
                    'referrals_total_amount' => '0.00044444',
                    'referral_url' => route('v1.register', 'referral_code='.$this->referrer->referral_code),
                    'total_referrals_hash_rate' => '200.00',
                    'hash_rate_unit' => 'T',
                ],
            ])
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     *
     * @testdox it show referral list
     *
     * @dataProvider incomesDataProvider
     */
    public function showReferralList(array $incomes): void
    {
        Income::insert($incomes);

        $this->referral
            ->subs()
            ->hasWorkerHashRate()
            ->update(['total_amount' => 0.00044444]);

        Sanctum::actingAs($this->referrer);

        $this->getJson(route('v1.referral.list', $this->referrer))
            ->assertExactJson(data: [
                'data' => [
                    [
                        'email' => 'second@gmail.com',
                        'referral_active_workers_count' => 1,
                        'referral_hash_per_day' => '200.00',
                        'referral_hash_per_day_unit' => 'T',
                        'referral_inactive_workers_count' => 1,
                        'referral_percent' => 1,
                        'total_amount' => 0.00044444,
                    ],
                ],
            ])
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     *
     * @testdox it show referrals income list
     *
     * @dataProvider incomesDataProvider
     */
    public function showIncomeList(array $incomes): void
    {
        Income::insert($incomes);

        Sanctum::actingAs($this->referrer);

        $this->getJson(route('v1.referral.income.list', $this->referrer))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonPath('data.0.email', $this->referral->email)
            ->assertJsonPath('data.0.daily_amount', (string) $incomes[0]['daily_amount'])
            ->assertJsonPath('data.0.hash', $incomes[0]['hash'])
            ->assertJsonPath('data.1.email', $this->referral->email)
            ->assertJsonPath('data.1.daily_amount', (string) $incomes[1]['daily_amount'])
            ->assertJsonPath('data.1.hash', $incomes[1]['hash']);
    }

    public function incomesDataProvider(): array
    {
        return [
            'fill incomes' => [
                'incomes' => [
                    [
                        'group_id' => 1,
                        'type' => Type::REFERRAL->value,
                        'referral_id' => 2,
                        'wallet_id' => null,
                        'daily_amount' => 0.00022222,
                        'status' => Status::PENDING->value,
                        'message' => Message::LESS_MIN_WITHDRAWAL->value,
                        'hash' => 100,
                        'unit' => 'T',
                        'diff' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'group_id' => 1,
                        'type' => Type::REFERRAL->value,
                        'referral_id' => 2,
                        'wallet_id' => null,
                        'daily_amount' => 0.00022222,
                        'status' => Status::PENDING->value,
                        'message' => Message::LESS_MIN_WITHDRAWAL->value,
                        'hash' => 100,
                        'unit' => 'T',
                        'diff' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ],
            ],
        ];
    }
}

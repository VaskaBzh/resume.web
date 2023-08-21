import { Profit } from "../../../Scripts/profit";

import { InputData } from "../../common/DTO/InputData";

import currency from "@/api/currency";

export class ProCalculatorService {
    constructor() {
        this.btcInfo = {};
        this.graphColumn = [];
        this.graphCircle = [];
        this.table = [];
        this.inputs = [];
    }

    setInputs(btcInfo) {
        this.btcInfo = btcInfo;

        this.inputs = [
            new InputData(
                "currency",
                "Курс BTC",
                btcInfo.price.toLocaleString("en-US"),
                null,
                "USD",
                "USD",
                true
            ),
            new InputData(
                "halving",
                "Дней до халвинга",
                "120",
                null,
                null,
                null,
                true
            ),
            new InputData(
                "courseUp",
                "Повышение курса BTC",
                "",
                "0",
                "%",
                "USD",
                false
            ),
            new InputData("hash", "Хешрейт", "100", "0", "Th/ s", null, false),
            new InputData(
                "commission",
                "Комиссия",
                "4",
                null,
                "%",
                "USD",
                true
            ),
            new InputData(
                "difficulty",
                "Сложность",
                btcInfo.diff,
                null,
                null,
                null,
                true
            ),
            new InputData(
                "next_difficulty",
                "Повышение сложности",
                "",
                "0",
                "%",
                "USD",
                false
            ),
            new InputData(
                "electro",
                "Затраты",
                "10,000",
                "0",
                "руб/мес",
                null,
                false
            ),
            new InputData("tax", "Налог на прибыль", "", "0", "%", null, false),
            new InputData(
                "price",
                "Цена устр-в",
                "1000",
                "0",
                "USD",
                "USD",
                false
            ),
            new InputData(
                "cash",
                "Другие расходы",
                "",
                "0",
                "USD/мес",
                null,
                false
            ),
            // new InputData(
            //     "power",
            //     "Мощность устройств",
            //     "1200",
            //     "0",
            //     "Вт",
            //     null,
            //     false
            // ),
        ];
    }

    setItem(inputName, newValue) {
        let changedInput = this.inputs.find(
            (input) => input.inputName === inputName
        );

        changedInput.inputValue = newValue;
    }

    async getGraph(interval) {
        // let profit = await this.getProfit(interval);
        // profit = profit.toFixed(8);
        // const cost = await this.getCost(profit, interval);
        // let clearProfit = profit - cost;
        // clearProfit = clearProfit < 0 ? 0.0 : clearProfit;
        // clearProfit = clearProfit.toFixed(8);
        // this.getPayback();
        // this.graph = [
        //     {
        //         value: profit,
        //         title: "Доход",
        //         color: "#84CAFF",
        //     },
        //     {
        //         value: cost,
        //         title: "Расход",
        //         color: "#2E90FA",
        //     },
        //     {
        //         value: clearProfit,
        //         title: "Прибыль",
        //         color: "#1849A9",
        //     },
        // ];
    }

    getPayback() {
        /* Индексы для инпутов */
        const hashrateIndex = 3;
        const priceIndex = 9;

        /* Множитель перевода секунд и месяцы */
        const convertmultiplier = 3600 * 24 * 30;

        /* fee (комиссия) */
        const fee = 4;

        /* Хешрейт */
        const hashrate = this.inputs[hashrateIndex].inputValue;
        /* Хешрейт в h/s для формулы */
        const formulHashrate = hashrate * Math.pow(10, 12);

        /* Сложность для формулы */
        const formulDifficulty = this.btcInfo.diff * Math.pow(2, 32);

        /* Награда за блок биткоина (в биткоинах) */
        const bitcoinReward = this.btcInfo.reward;

        /* Стоимость устройств пользователя */
        const ownPrice = this.inputs[priceIndex].inputValue;

        /* Стоимость устройств пользователя в биткоинах */
        const bitcoinPrice = ownPrice / this.btcInfo.price;

        /* Стоимость устройств пользователя в биткоинах с учетом комисий */
        const bitcoinWithFee = bitcoinPrice + bitcoinPrice * (fee / 100);

        /* Время на майнинг блока в секундах */
        let earnTime = bitcoinReward / bitcoinWithFee;

        /* Время на окупаемость в секундах */
        const seconds = formulDifficulty / (formulHashrate * earnTime);

        /* Время на окупаемость в месяцах */
        console.log(seconds / convertmultiplier);

        /* result: 4.898917437665151 */
    }

    async getProfit(interval) {
        const hashrate = this.inputs[0].inputValue;
        const profit = new Profit(
            hashrate,
            this.btcInfo.diff,
            this.btcInfo.reward,
            this.btcInfo.fpps
        );
        return profit.amount(interval);
    }

    async converted(btc) {
        const rubleCost = btc.toFixed(8);
        const usdCourse = (await currency()).data.rates.USD || 0;
        const btcCourse = this.btcInfo.price;
        const btcCost = rubleCost * usdCourse;
        const result = btcCost / btcCourse;

        return result.toFixed(8);
    }

    async getCost(profit, interval) {
        const power = this.inputs[2].inputValue;
        const costPerKWh = this.inputs[1].inputValue;
        const kw = power / 1000;

        let result = interval * kw * costPerKWh;
        result = await this.converted(result);

        return result;
    }
}

import { Profit } from "../../../Scripts/profit";

import { InputData } from "../../common/DTO/InputData";

import store from "@/store";

export class LightCalculatorService {
    constructor() {
        this.btcInfo = {};
        this.graph = [];
        this.inputs = [];
    }

    setInputs(btcInfo) {
        this.btcInfo = btcInfo;

        this.inputs = [
            new InputData(
                "hash",
                "hash",
                "100",
                "0",
                "Th/ s",
                null,
                false,
                false
            ),
            // new InputData(
            //     "electro",
            //     "Затраты",
            //     "0.89",
            //     "0",
            //     "руб/kWh",
            //     null,
            //     false,
            //     false
            // ),
            // new InputData(
            //     "power",
            //     "Мощность устройств",
            //     "1200",
            //     "0",
            //     "Вт",
            //     null,
            //     false,
            //     false
            // ),
            // new InputData(
            //     "difficulty",
            //     "Текущая сложность",
            //     btcInfo.diff,
            //     null,
            //     null,
            //     "USD",
            //     false,
            //     false
            // ),
            new InputData(
                "currency",
                "currency",
                btcInfo.price.toLocaleString("en-US"),
                null,
                "USD",
                null,
                true,
                false
            ),
        ];
    }

    setItem(inputName, newValue) {
        let changedInput = this.inputs.find(
            (input) => input.inputName === inputName
        );

        changedInput.inputValue = newValue;
    }

    async getGraph(interval) {
        this.profit = await this.getProfit(interval);
        // const cost = await this.getCost(profit, interval);
        // let clearProfit = profit - cost;
        // clearProfit = clearProfit < 0 ? 0.0 : clearProfit;
        // clearProfit = clearProfit.toFixed(8);

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

    async getProfit(interval) {
        const hashrate = this.inputs[0].inputValue;
        const profit = new Profit(
            hashrate,
            this.btcInfo.diff,
            this.btcInfo.reward,
            this.btcInfo.fpps
        );
        return profit.calculatorAmount(interval);
    }

    async converted(btc) {
        const rubleCost = btc.toFixed(8);
        const usdCourse = store.getters.currency.rates.USD || 0;
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

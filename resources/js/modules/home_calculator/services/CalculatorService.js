import { Profit } from "../../../Scripts/profit";
import currency from "../../../api/currency";
import { InputData } from "@/modules/common/DTO/InputData";
// import { InputData } from "../DTO/InputData";

export class CalculatorService {
    constructor(translate) {
        this.btcInfo = {};
        this.graph = [];
        this.inputs = [];
        this.const = 0;
        this.multiplier = 1;

        this.translate = translate;
    }

    setInputs(btcInfo) {
        this.btcInfo = btcInfo;

        this.inputs = [
            new InputData(
                "hash",
                "",
                "",
                this.translate("home.calculator.placeholder[0]"),
                "TH/s",
                null,
                false,
                false
            ),
            new InputData(
                "count",
                "",
                "",
                this.translate("home.calculator.placeholder[1]"),
                "",
                null,
                false,
                false
            ),
            new InputData(
                "power",
                "",
                "",
                this.translate("home.calculator.placeholder[2]"),
                "W",
                null,
                false,
                false
            ),
            new InputData(
                "electro",
                "",
                "",
                this.translate("home.calculator.placeholder[3]"),
                "/кВт",
                null,
                false,
                true
            ),
        ];
    }

    setItem(inputName, newValue) {
        let changedInput = this.inputs.find(
            (input) => input.inputName === inputName
        );

        changedInput.inputValue = newValue;
    }

    setMultiplier(multiplier) {
        this.multiplier = multiplier;
    }

    async getProfit(interval) {
        const firstIndex = 0;
        const secondIndex = 1;

        const hashrate =
            this.inputs[firstIndex].inputValue *
            this.inputs[secondIndex].inputValue;

        const profit = new Profit(
            hashrate,
            this.btcInfo.diff,
            this.btcInfo.reward,
            this.btcInfo.fpps
        );

        return profit.calculatorAmount(interval).toFixed(8);
    }

    async converted(btc) {
        const rubleCost = btc.toFixed(8);
        const usdCourse = (await currency()).data.rates.USD || 0;
        const btcCourse = this.btcInfo.price;
        const btcCost = rubleCost * usdCourse;
        const result = btcCost / btcCourse;

        return result.toFixed(8);
    }

    async getCost(interval) {
        const thirdIndex = 2;
        const fourthIndex = 3;

        const power = this.inputs[thirdIndex].inputValue;
        const costPerKWh = this.inputs[fourthIndex].inputValue;
        const kw = power / 1000;
        let result = interval * kw * (costPerKWh * this.multiplier);
        result = await this.converted(result);

        this.cost = result;
    }
}

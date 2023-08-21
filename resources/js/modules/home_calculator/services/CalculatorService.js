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
                this.translate("home.calculator.placeholder[4]"),
                "/кВт",
                null,
                false,
                true
            ),
        ];
    }

    async getProfit(interval) {
        const hashrate = this.inputs[0] * this.inputs[1];
        const profit = new Profit(
            hashrate,
            this.btcInfo.diff,
            this.btcInfo.reward,
            this.btcInfo.fpps
        );
        return profit.lightCalculatorAmount(interval).toFixed(8);
    }

    async converted(btc) {
        const rubleCost = btc.toFixed(8);
        const usdCourse = (await currency()).data.rates.USD || 0;
        const btcCourse = this.btcInfo.price;
        const btcCost = rubleCost * usdCourse;
        const result = btcCost / btcCourse;
        return result.toFixed(8);
    }

    async getCost() {
        const power = this.inputs[2];
        const costPerKWh = this.inputs[3];
        const kw = power / 1000;
        let result = 720 * kw * costPerKWh;
        result = await this.converted(result);
        this.cost = result;
    }
}

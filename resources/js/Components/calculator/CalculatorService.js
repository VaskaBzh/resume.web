import { Profit } from "../../Scripts/profit";
import  currency  from "../../api/currency";
// import { InputData } from "../DTO/InputData";

// import currency from "@/api/currency";

export class CalculatorService {
    constructor() {
        this.btcInfo = {};
        this.graph = [];
        this.inputs = [];
        this.const = 0;
    }
    setInputs(btcInfo) {
      this.btcInfo = btcInfo;
  }
    async getProfit(interval) {
        const hashrate = this.inputs[0] * this.inputs[1];
        const profit = new Profit(
            hashrate,
            this.btcInfo.diff,
            this.btcInfo.reward,
            this.btcInfo.fpps
        );
        return (profit.lightCalculatorAmount(interval)).toFixed(8);
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
      console.log(this.inputs);
        const power =  this.inputs[2];
        const costPerKWh = this.inputs[3];
        const kw = power / 1000;
        let result = 720 * kw * costPerKWh;
        result = await this.converted(result);
        this.cost = result;
    }
}

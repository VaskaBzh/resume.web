import * as d3 from "d3";

export class FormatHashrateService {
    formatHashrate(value) {
        if (value / 1000000 > 1) {
            return { val: Number(value / 1000000).toFixed(2), unit: "E" };
        } else if (value / 1000 >= 1) {
            return { val: Number(value / 1000).toFixed(2), unit: "P" };
        } else {
            return { val: Number(value).toFixed(2), unit: "T" };
        }
    }
}

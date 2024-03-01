import { HashRateFormatters } from "@/formatters/HashRateFormatters";
import { TimeFormatter } from "@/formatters/TimeFormatter";

export class workerHashrateData {
    constructor(workerHashrateRecord) {
        this.values = workerHashrateRecord.hash ?? 0;
        this.convertedValues = HashRateFormatters.formatHashRateInObject(this.values).hashRate;
        this.unit = workerHashrateRecord.unit ?? "T";

        const customDate = [
            workerHashrateRecord.day_at ?? TimeFormatter.formatTime("yy.mm.dd", new Date().getTime()),
            workerHashrateRecord.hour_at ?? TimeFormatter.formatTime("hh:ii", new Date().getTime()),
        ];

        this.dayAt = customDate[0];
        this.hourAt = customDate[1];

        customDate[0] = customDate[0].split(".").reverse().join(".");

        this.dates = new Date(customDate);
    }
}

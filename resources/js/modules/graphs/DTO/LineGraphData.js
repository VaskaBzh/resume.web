import { HashRateFormatters } from "@/formatters/HashRateFormatters";
import { TimeFormatter } from "@/formatters/TimeFormatter";

export class LineGraphData {
    constructor(hashrateRecord) {
        this.values = hashrateRecord.hash ?? 0;
        this.convertedValues = HashRateFormatters.formatHashRateInObject(this.values).hashRate;
        this.unit = hashrateRecord.unit ?? "T";
        this.amount = hashrateRecord.worker_count ?? 0;

        const customDate = hashrateRecord.day_hour ? hashrateRecord.day_hour.split(" ") : TimeFormatter.formatTime("yy.mm.dd hh:ii", new Date().getTime()).split(" ");

        this.dayAt = customDate[0];
        this.hourAt = customDate[1];

        customDate[0] = customDate[0].split(".").reverse().join(".");

        this.dates = new Date(customDate);
    }
}

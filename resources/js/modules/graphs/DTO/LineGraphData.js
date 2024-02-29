import { HashRateFormatters } from "@/formatters/HashRateFormatters";

export class LineGraphData {
    constructor(hashrateRecord) {
        this.values = hashrateRecord.hash;
        this.convertedValues = HashRateFormatters.formatHashRateInObject(
            hashrateRecord.hash
        ).hashRate;
        this.unit = hashrateRecord.unit;
        this.amount = hashrateRecord.worker_count;

        const customDate = hashrateRecord.day_hour.split(" ");

        this.dayAt = customDate[0];
        this.hourAt = customDate[1];

        customDate[0] = customDate[0].split(".").reverse().join(".");

        this.dates = new Date(customDate);
    }
}

import { HashRateFormatters } from "../formatters/HashRateFormatters";

export class workerHashrateData {
    constructor(workerHashrateRecord) {
        this.values = workerHashrateRecord.hash;
        this.convertedValues = HashRateFormatters.formatHashRateInObject(
            workerHashrateRecord.hash
        ).hashRate;
        this.unit = workerHashrateRecord.unit;

        const customDate = [
            workerHashrateRecord.day_at,
            workerHashrateRecord.hour_at,
        ];

        this.dayAt = customDate[0];
        this.hourAt = customDate[1];

        customDate[0] = customDate[0].split(".").reverse().join(".");

        this.dates = new Date(customDate);
    }
}

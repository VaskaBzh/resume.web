export class HashRateFormatters {
    static formatHashRateInObject(pureHashRate) {
        const pureHashRateLength = String(pureHashRate).length;

        let value = 0;
        let unit = "T";

        if (pureHashRate > 0 && pureHashRateLength < 13) {
            value = pureHashRate / 1000000000;
            unit = "G";
        }
        if (pureHashRateLength < 16 && pureHashRateLength >= 13) {
            value = pureHashRate / 1000000000000;
            unit = "T";
        }
        if (pureHashRateLength >= 16) {
            value = pureHashRate / 1000000000000000;
            unit = "P";
        }

        const validatedValue = value.toFixed();

        return { val: validatedValue, unit: unit };
    }

    static formatHashRateInString(pureHashRate) {
        const hashRateData = this.formatHashRateInObject(pureHashRate);

        return `${hashRateData.val} ${hashRateData.unit}h/s`;
    }
}

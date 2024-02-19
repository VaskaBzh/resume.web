export class FormatTrait {
    formatHashRateWithUnit(hashRateValue, hashRateUnit) {
        return (
            `${hashRateValue} ${hashRateUnit}h/s`
        );
    }
}

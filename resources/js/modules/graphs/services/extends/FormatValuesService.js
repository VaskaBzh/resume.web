export class FormatValuesService {
    tooltipFormatNumberWithUnit(adjustValue, graphData, num, i) {
        return (
            adjustValue(num, graphData.unit[i]).val +
            " " +
            adjustValue(num, graphData.unit[i]).unit +
            "H"
        );
    }
}

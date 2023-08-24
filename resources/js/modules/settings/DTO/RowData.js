import { SvgEnums } from "@/modules/settings/enums/SvgEnums";

export class RowData {
    constructor(title, name, value, svgKey) {
        this.title = title;
        this.name = name;
        this.value = value;
        this.svg = SvgEnums[svgKey];
    }
}

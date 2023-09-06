import { SelectSvgEnum } from "@/modules/referral/map/SelectSvgEnum";

export class SelectData {
    constructor(svg, text, value) {
        this.svg = SelectSvgEnum[svg];
        this.text = text;
        this.value = value;
    }
}

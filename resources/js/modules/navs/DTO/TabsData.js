import TabsIconsEnums from "../enums/TabsIconsEnums";

export class TabsData {
    constructor(url, name, translateKey, icon) {
        this.url = url;
        this.name = name;
        this.translateKey = translateKey;
        this.icon = TabsIconsEnums[icon];
    }
}

import TabsIconsEnums from "../enums/TabsIconsEnums";

export class TabsData {
    constructor(url, name, icon) {
        this.url = url;
        this.name = name;
        this.icon = TabsIconsEnums[icon];
    }
}

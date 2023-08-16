import TabsIconsEnums from "../enums/TabsIconsEnums";

export class TabsData {
    constructor(key) {
        this.route = key;
        this.url = key;
        this.name = key;
        this.icon = TabsIconsEnums[key];
    }
}

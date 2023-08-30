import TabsIconsEnums from "../enums/TabsIconsEnums";

export class TabsData {
    constructor(route, url, name, icon) {
        this.route = route;
        this.url = url;
        this.name = name;
        this.icon = TabsIconsEnums[icon];
    }
}

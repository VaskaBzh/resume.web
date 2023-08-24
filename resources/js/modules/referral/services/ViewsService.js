import { TabData } from "@/modules/referral/DTO/TabData";

export class ViewsService {
    constructor(translate) {
        this.tabs = [];
        this.translate = translate;
        this.view = "Cabinet";
    }

    setTabs() {
        this.tabs = [
            ...this.tabs,
            new TabData(this.translate("tabs[0]"), "Cabinet"),
            new TabData(this.translate("tabs[1]"), "Referrals"),
            new TabData(this.translate("tabs[2]"), "Referrals_income"),
        ];
    }

    setView(viewName) {
        this.view = viewName;
    }
}

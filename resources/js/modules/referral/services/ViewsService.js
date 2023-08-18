import { TabData } from "@/modules/referral/DTO/TabData";

export class ViewsService {
    constructor() {
        this.tabs = [];
        this.view = "Cabinet";
    }

    setTabs() {
        this.tabs = [
            ...this.tabs,
            new TabData("Кабинет", "Cabinet"),
            new TabData("Мои рефералы", "Referrals"),
            new TabData("Вознаграждение", "Referrals_income"),
        ];
    }

    setView(viewName) {
        this.view = viewName;
    }
}

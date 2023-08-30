import { TabData } from "@/modules/referral/DTO/TabData";
import { router } from "@inertiajs/vue3";

export class ViewsService {
    constructor(translate, page) {
        this.tabs = [];
        this.translate = translate;
        this.view = page.url;
    }

    setTabs() {
        this.tabs = [
            ...this.tabs,
            new TabData(
                this.translate("tabs[0]"),
                "/profile/referrals/dashboard"
            ),
            new TabData(
                this.translate("tabs[1]"),
                "/profile/referrals/attached-referrals"
            ),
            new TabData(
                this.translate("tabs[2]"),
                "/profile/referrals/incomes"
            ),
        ];
    }

    setView(page) {
        this.view = page.url;
    }

    tabRoute(routeName) {
        router.visit(routeName);

        return this;
    }
}

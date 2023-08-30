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
            new TabData(this.translate("tabs[0]"), [
                "referral.dashboard",
                "overview",
            ]),
            new TabData(this.translate("tabs[1]"), [
                "referral.attached",
                "my-referral",
            ]),
            new TabData(this.translate("tabs[2]"), [
                "referral.incomes",
                "earn-rewards",
            ]),
        ];
    }

    setView(page) {
        this.view = page.url;
    }

    tabRoute(routeName) {
        const firstIndex = 0;
        const lastIndex = routeName.length - 1;
        const name = routeName[firstIndex];
        const param = routeName[lastIndex];

        router.visit(name, { page: param });

        return this;
    }
}

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
                "/profile/referral?page=overview"
            ),
            new TabData(
                this.translate("tabs[1]"),
                "/profile/referral?page=my-referral"
            ),
            new TabData(
                this.translate("tabs[2]"),
                "/profile/referral?page=earn-rewards"
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

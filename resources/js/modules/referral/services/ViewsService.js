import { TabData } from "@/modules/referral/DTO/TabData";
import { useRouter } from "vue-router";


export class ViewsService {
    constructor(translate) {
        this.tabs = [];
        this.translate = translate;
        this.view = null;
        this.router = useRouter();
    }

    setTabs() {
        this.tabs = [];

        this.tabs = [
            ...this.tabs,
            new TabData(this.translate("tabs[0]"), ["referral", "overview"]),
            new TabData(this.translate("tabs[1]"), ["referral", "my-referral"]),
            new TabData(this.translate("tabs[2]"), ["referral", "earn-rewards",]),
        ];
        return this;
    }

    setView(page) {
        this.view = page.name;
    }

    tabRoute(routeName) {
        const lastIndex = routeName.length - 1;
        const param = routeName[lastIndex];

        this.router.push({ name: param });

        return this;
    }
}

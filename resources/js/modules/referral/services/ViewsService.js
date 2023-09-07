import { TabData } from "@/modules/referral/DTO/TabData";
import { useRoute } from "vue-router";

export class ViewsService {
    constructor(translate, page) {
        this.tabs = [];
        this.translate = translate;
        this.view = null;
        this.router = useRoute();

        this.setView(page);
    }

    setTabs() {
        this.tabs = [
            ...this.tabs,
            new TabData(this.translate("tabs[0]"), ["referral", "overview"]),
            new TabData(this.translate("tabs[1]"), ["referral", "my-referral"]),
            new TabData(this.translate("tabs[2]"), [
                "referral",
                "earn-rewards",
            ]),
        ];
    }

    setView(page) {
        const splitedUrl = page.url.split("?");
        const lastIndexUrl = splitedUrl.length - 1;
        const pageParams = splitedUrl[lastIndexUrl].split("=");
        const lastIndexParams = splitedUrl.length - 1;
        this.view = pageParams[lastIndexParams];
    }

    tabRoute(routeName) {
        const firstIndex = 0;
        const lastIndex = routeName.length - 1;
        const name = routeName[firstIndex];
        const param = routeName[lastIndex];

        this.router.push({ name: name, params: { page: param } });

        return this;
    }
}

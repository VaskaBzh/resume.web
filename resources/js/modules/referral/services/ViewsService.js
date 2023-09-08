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
        this.tabs = [
            ...this.tabs,
            new TabData(this.translate("tabs[0]"), ["referral", "overview"]),
            new TabData(this.translate("tabs[1]"), ["referral", "my-referral"]),
            new TabData(this.translate("tabs[2]"), [
                "referral",
                "earn-rewards",
            ]),
        ];

        return this;
    }

    setView(page) {
        const splitedUrl = page.fullPath.split("?");
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

        console.log(name, param);
        this.router.push({ name: param, params: { page: param } });

        return this;
    }
}

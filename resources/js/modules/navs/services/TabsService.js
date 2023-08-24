import { TabsData } from "../DTO/TabsData";
import { router } from "@inertiajs/vue3";

export class TabsService {
    constructor() {
        this.links = [];
    }

    setLinks() {
        this.links = [
            new TabsData("statistic"),
            new TabsData("income"),
            new TabsData("wallets"),
            new TabsData("accounts"),
            new TabsData("workers"),
            new TabsData("connecting"),
            new TabsData("ref"),
        ];
    }

    back() {
        router.visit("/profile/statistic");
        // if (window.history.length > 1) {
        //     window.history.back();
        // } else {
        //     router.visit("/profile/statistic");
        // }
    }
}

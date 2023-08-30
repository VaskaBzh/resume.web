import { TabsData } from "../DTO/TabsData";
import { router } from "@inertiajs/vue3";

export class TabsService {
    constructor() {
        this.links = [];
    }

    setLinks() {
        this.links = [
            new TabsData("statistic", "statistic", "statistic", "statistic"),
            new TabsData("income", "income", "income", "income"),
            new TabsData("wallets", "wallets", "wallets", "wallets"),
            new TabsData("accounts", "accounts", "accounts", "accounts"),
            new TabsData("workers", "workers", "workers", "workers"),
            new TabsData(
                "connecting",
                "connecting",
                "connecting",
                "connecting"
            ),
            new TabsData("referrals", "referrals", "referrals", "referrals"),
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

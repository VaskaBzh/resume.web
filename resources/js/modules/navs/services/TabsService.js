import {TabsData} from "../DTO/TabsData";
import {router} from "@inertiajs/vue3";

export class TabsService {
    constructor() {
        this.links = [];
    }

    setLinks() {
        this.links = [
            new TabsData("/profile/statistic", "statistic", "statistic"),
            new TabsData("/profile/income", "income", "income"),
            new TabsData("/profile/wallets", "wallets", "wallets"),
            new TabsData("/profile/accounts", "accounts", "accounts"),
            new TabsData("/profile/workers", "workers", "workers"),
            new TabsData(
                "/profile/connecting",
                "connecting",
                "connecting"
            ),
            new TabsData("referral.tabs", "referral", "referral", "referral"),
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

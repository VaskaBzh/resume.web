import { TabsData } from "../DTO/TabsData";
import { router } from "@inertiajs/vue3";

export class TabsService {
    constructor() {
        this.links = [];
    }

    setLinks(hasReferralRole) {
        this.links = [
            ...this.links,
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
        ];

        if (hasReferralRole)
            this.setReferralTab();
    }

    setReferralTab() {
        this.links = [
            ...this.links,
            new TabsData("/profile/referral", "referral", "referral"),
        ]
    }

    dropLinks() {
        this.links = [];
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

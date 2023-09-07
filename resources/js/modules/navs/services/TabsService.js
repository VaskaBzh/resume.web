import { TabsData } from "../DTO/TabsData";
import {useRouter} from "vue-router";

export class TabsService {
    constructor() {
        this.links = [];

        this.router = useRouter();
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
        this.router.go(-1);
        // if (window.history.length > 1) {
        //     window.history.back();
        // } else {
        //     router.visit("/profile/statistic");
        // }
    }
}

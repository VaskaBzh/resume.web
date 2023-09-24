import { TabsData } from "../DTO/TabsData";

export class TabsService {
    constructor(router) {
        this.links = [];
        this.subLinks = [];
        this.settingLinks = [];
        this.router = router;
    }

    setLinks(user) {
        this.links = [
            ...this.links,
            {
                links: [
                    new TabsData(
                        "/profile/statistic",
                        "statistic",
                        "statistic"
                    ),
                    new TabsData("/profile/income", "income", "income"),
                    new TabsData("/profile/workers", "workers", "workers"),
                    new TabsData("/profile/accounts", "accounts", "accounts"),
                ],
            },
            {
                group_name: "Субаккаунт",
                links: [
                    new TabsData(
                        "/profile/connecting",
                        "connecting",
                        "connecting"
                    ),
                    new TabsData("/profile/wallets", "wallets", "wallets"),
                    new TabsData("/profile/watchers", "watchers", "watchers"),
                ],
            },
        ];

        if (user.roles)
            if (user.roles.find((role) => role.name === "referral"))
                this.setReferralTab();
            else this.setWithoutReferralTab();
    }

    setWatcherLinks() {
        this.links = [
            ...this.links,
            {
                links: [
                    new TabsData(
                        "/watchers/statistic",
                        "statistic",
                        "statistic"
                    ),
                    new TabsData("/watchers/income", "income", "income"),
                    new TabsData("/watchers/workers", "workers", "workers"),
                ],
            },
        ];
    }

    setReferralTab() {
        this.links = [
            ...this.links,
            {
                group_name: "Настройки",
                links: [
                    new TabsData("/profile/settings", "settings", "account"),
                    new TabsData("/profile/referral", "referral", "referral"),
                    new TabsData("/profile/faq", "faq", "faq"),
                    // new TabsData("/profile/watchers", "support", "support"),
                ],
            },
        ];
    }

    setWithoutReferralTab() {
        this.links = [
            ...this.links,
            {
                group_name: "Настройки",
                links: [
                    new TabsData("/profile/settings", "settings", "account"),
                    new TabsData("/profile/faq", "faq", "faq"),
                    // new TabsData("/profile/watchers", "support", "support"),
                ],
            },
        ];
    }

    dropLinks() {
        this.links = [];
    }

    back() {
        this.router.go(-1);
    }
}

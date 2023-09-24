import { TabsData } from "../DTO/TabsData";
import api from "@/api/api";

export class TabsService {
    constructor(router, route) {
        this.links = [];
        this.allowedRoutes = [];

        this.router = router;
        this.route = route;
    }

    setLinks(user) {
        this.links = [
            ...this.links,
            {
                links: [
                    new TabsData(
                        "/profile/statistic",
                        "statistic",
                        "statistic",
                        "statistic"
                    ),
                    new TabsData("/profile/income", "income", "income", "income"),
                    new TabsData("/profile/workers", "workers", "workers", "workers"),
                    new TabsData("/profile/accounts", "accounts", "accounts", "accounts"),
                ],
            },
            {
                group_name: "Субаккаунт",
                links: [
                    new TabsData(
                        "/profile/connecting",
                        "connecting",
                        "connecting",
                        "connecting"
                    ),
                    new TabsData("/profile/wallets", "wallets","wallets", "wallets"),
                    new TabsData("/profile/watchers", "watchers","watchers", "watchers"),
                ],
            },
        ];

        if (user.roles)
            if (user.roles.find((role) => role.name === "referral"))
                this.setReferralTab();
            else this.setWithoutReferralTab();
    }

    async setAllowedRoutes() {
        try {
            this.allowedRoutes = (
                await api.get(`/allowed/${this.route?.query?.access_key}`, {
                    headers: {
                        "X-Access-Key": this.route?.query?.access_key,
                    },
                })
            ).data.data.allowed_routes;
        } catch (err) {
            console.error(err);
        }
    }

    async setWatcherLinks() {
        await this.setAllowedRoutes();

        let matchedKeys = [];

        for (let route of this.allowedRoutes) {
            let key = this.isAllowedRoute(route);
            if (key && !matchedKeys.includes(key)) {
                matchedKeys.push(key);
            }
        }

        this.links = [
            ...this.links,
            {
                links: [
                    ...matchedKeys.map(
                        (key) =>
                            new TabsData(
                                `/watcher/${key}`,
                                `watcher_${key}`,
                                key,
                                key
                            )
                    ),
                ],
            },
        ];
    }

    isAllowedRoute(route) {
        const allowedRoutesList = {
            statistic: ["v1.sub.show", "v1.hashrate.list"],
            workers: [
                "v1.worker.list",
                "v1.worker.show",
                "v1.worker_hashrate.list",
            ],
            income: ["v1.income.list", "v1.payout.list"],
        };

        for (let key in allowedRoutesList) {
            if (allowedRoutesList[key].includes(route)) {
                return key;
            }
        }

        return null;
    }

    setReferralTab() {
        this.links = [
            ...this.links,
            {
                group_name: "Настройки",
                links: [
                    new TabsData("/profile/settings", "settings", "settings", "account"),
                    new TabsData("/profile/referral", "referral", "referral", "referral"),
                    new TabsData("/profile/faq", "faq", "faq", "faq"),
                    // new TabsData("/profile/watchers", "support", "support", "support"),
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
                    new TabsData("/profile/settings", "settings", "settings", "account"),
                    new TabsData("/profile/faq", "faq", "faq", "faq"),
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

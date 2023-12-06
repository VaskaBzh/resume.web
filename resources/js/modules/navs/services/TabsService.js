import { TabsData } from "../DTO/TabsData";
import { ProfileApi } from "@/api/api";

export class TabsService {
    constructor(router, route) {
        this.links = [];
        this.allowedRoutes = [];

        this.router = router;
        this.route = route;
    }

    setLinks(user) {
        this.dropLinks();

        if (user?.has_referrer_role) {
            this.setReferralTab();
        } else {
            this.setWithoutReferralTab();
        }

        this.links = [
            ...this.links,
            {
                group_name: "tabs.subs_group",
                links: [
                    new TabsData(
                        "/profile/connecting",
                        "connecting",
                        "connecting",
                        "connecting"
                    ),
                    new TabsData(
                        "/profile/wallets",
                        "wallets",
                        "wallets",
                        "wallets"
                    ),
                    new TabsData(
                        "/profile/watchers",
                        "watchers",
                        "watchers",
                        "watchers"
                    ),
                ],
            },
            {
                group_name: "tabs.settings_group",
                links: [
                    new TabsData(
                        "/profile/settings",
                        "settings",
                        "settings",
                        "account"
                    ),
                    new TabsData("/faq", "faq", 'faq', "faq"),
                ],
            },
        ];
    }

    async setAllowedRoutes() {
        try {
            this.allowedRoutes = (
                await ProfileApi.get(
                    `/allowed/${this.route?.query?.access_key}`
                )
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

        this.dropLinks();

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
                links: [
                    new TabsData(
                        "/profile/statistic",
                        "statistic",
                        "statistic",
                        "statistic"
                    ),
                    new TabsData(
                        "/profile/income",
                        "income",
                        "income",
                        "income"
                    ),
                    new TabsData(
                        "/profile/workers",
                        "workers",
                        "workers",
                        "workers"
                    ),
                    new TabsData(
                        "/profile/accounts",
                        "accounts",
                        "accounts",
                        "accounts"
                    ),
                    new TabsData(
                        "/profile/referral",
                        "referral",
                        "referral",
                        "referral"
                    ),
                ],
            },
        ];
    }

    setWithoutReferralTab() {
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
                    new TabsData(
                        "/profile/income",
                        "income",
                        "income",
                        "income"
                    ),
                    new TabsData(
                        "/profile/workers",
                        "workers",
                        "workers",
                        "workers"
                    ),
                    new TabsData(
                        "/profile/accounts",
                        "accounts",
                        "accounts",
                        "accounts"
                    ),
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

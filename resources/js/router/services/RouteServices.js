import { RoutePublicData } from "../DTO/RoutePublicData";
import { RouteProfileData } from "../DTO/RouteProfileData";
import { RouteReferralData } from "../DTO/RouteReferralData";
import { RouteAuthData } from "../DTO/RouteAuthData";
import { RouteConfirmData } from "../DTO/RouteConfirmData";
import { RouteNamesMap } from "@/router/map/RouteNamesMap";
import {VerifyMiddleware} from "../middlewares/VerifyMiddleware";

export class RouteServices {
    constructor() {
        this.routes = [];
    }

    setRoutes() {
        this.routes = [
            ...this.routes,
            ...this.setDefaultRoutes(),
            // new RoutePublicData('about', 'about'),
            new RoutePublicData("calculator", "calculator"),
            // new RoutePublicData('complexity', 'complexity'),
            new RoutePublicData("help", "help"),
            new RoutePublicData("hosting", "hosting"),
            new RoutePublicData("miners", "miners"),
            new RouteAuthData("login", "login"),
            new RouteAuthData("registration", "registration"),
            new RouteConfirmData("confirm", "confirm"),
            new RouteProfileData("accounts", "accounts"),
            new RouteProfileData("statistic", "statistic"),
            new RouteProfileData("connecting", "connecting"),
            new RouteProfileData("income", "income"),
            new RouteProfileData("settings", "settings"),
            new RouteProfileData("wallets", "wallets"),
            new RouteProfileData("workers", "workers"),
            new RouteProfileData("watchers", "watchers"),
            new RouteProfileData("faq", "faq"),
        ];
    }

    setDefaultRoutes() {
        return [
            {
                path: `/`,
                name: "home",
                component: () =>
                    import(`../../Pages/${RouteNamesMap.public["home"]}.vue`),
                meta: {
                    middleware: [
                        "LoadLayoutMiddleware",
                        "DropErrorsMiddleware",
                        "ActionValidateMiddleware",
                    ],
                    link: "LayoutView",
                },
            },
            {
                path: "/profile",
                name: "profile",
                redirect: "/profile/statistic",
            },
            {
                path: "/profile/referral",
                name: "referral",
                component: () =>
                    import("../../layouts/ReferralsLayoutView.vue"),
                redirect: (to) => {
                    return {
                        name: "overview",
                    };
                },
                children: [
                    new RouteReferralData("overview", "overview"),
                    new RouteReferralData("my-referral", "my-referral"),
                    new RouteReferralData("earn-rewards", "earn-rewards"),
                ],
            },
            // {
            //     path: "/v1/verify",
            //     name: "verify",
            //     meta: {
            //         middleware: ["VerifyMiddleware"],
            //     },
            // },
            // {
            //     path: "/v1/password/reset/verify/",
            //     name: "password_reset",
            //     meta: {
            //         middleware: ["VerifyMiddleware"],
            //     },
            // },
            {
                path: "/watcher",
                name: "watcher",
                redirect: (to) => {
                    return {
                        name: "watcher_statistic",
                        query: {
                            access_key: to.query.access_key,
                            puid: to.query.puid,
                        },
                    };
                },
            },
            {
                path: "/watcher/statistic",
                name: "watcher_statistic",
                component: () =>
                    import("../../Pages/Profile/StatisticPage.vue"),
                meta: {
                    middleware: [
                        "LoadLayoutMiddleware",
                        "DropErrorsMiddleware",
                        "AuthCheckProfileMiddleware",
                    ],
                    layout: "ProfileLayoutView",
                },
            },
            {
                path: "/watcher/workers",
                name: "watcher_workers",
                component: () => import("../../Pages/Profile/WorkersPage.vue"),
                meta: {
                    middleware: [
                        "LoadLayoutMiddleware",
                        "DropErrorsMiddleware",
                        "AuthCheckProfileMiddleware",
                    ],
                    layout: "ProfileLayoutView",
                },
            },
            {
                path: "/watcher/income",
                name: "watcher_income",
                component: () => import("../../Pages/Profile/IncomePage.vue"),
                meta: {
                    middleware: [
                        "LoadLayoutMiddleware",
                        "DropErrorsMiddleware",
                        "AuthCheckProfileMiddleware",
                    ],
                    layout: "ProfileLayoutView",
                },
            },
        ];
    }

    dropRoutes() {
        this.routes = [];
    }
}

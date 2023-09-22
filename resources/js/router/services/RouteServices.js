import { RoutePublicData } from "../DTO/RoutePublicData";
import { RouteProfileData } from "../DTO/RouteProfileData";
import { RouteReferralData } from "../DTO/RouteReferralData";
import { RouteAuthData } from "../DTO/RouteAuthData";
import { RouteNamesMap } from "@/router/map/RouteNamesMap";


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
            new RouteAuthData("login", "login"),
            new RouteAuthData("registration", "registration"),
            new RouteAuthData("confirm", "confirm"),
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
                params: { page: "" },
                component: () =>
                    import('../../layouts/ReferralsLayoutView.vue'),
                redirect: (to) => {
                    return {
                        name: "overview",
                        query: { page: "overview" },
                    };
                },
                children: [
                    new RouteReferralData("overview", "overview"),
                    new RouteReferralData("my-referral", "my-referral"),
                    new RouteReferralData("earn-rewards", "earn-rewards"),
                ],
            },
            {
                path: "/verify",
                name: "verify",
                meta: {
                    middleware: ["EmailVerifyController"],
                },
                query: {
                    verify_hash: null,
                },
            },
        ];
    }

    dropRoutes() {
        this.routes = [];
    }
}

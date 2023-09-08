import { RoutePublicData } from "../DTO/RoutePublicData";
import { RouteProfileData } from "../DTO/RouteProfileData";
import { RouteReferralData } from "../DTO/RouteReferralData";
import { RouteAuthData } from "../DTO/RouteAuthData";

export class RouteServices {
    constructor() {
        this.routes = [];
    }

    setRoutes() {
        this.routes = [
            ...this.routes,
            ...this.setDefaultRoutes(),
            new RoutePublicData("home", "home"),
            // new RoutePublicData('about', 'about'),
            new RoutePublicData("calculator", "calculator"),
            // new RoutePublicData('complexity', 'complexity'),
            new RoutePublicData("help", "help"),
            new RoutePublicData("hosting", "hosting"),
            new RouteAuthData("login", "login"),
            new RouteAuthData("registration", "registration"),
            new RouteProfileData("accounts", "accounts"),
            new RouteProfileData("statistic", "statistic"),
            new RouteProfileData("connecting", "connecting"),
            new RouteProfileData("income", "income"),
            new RouteProfileData("settings", "settings"),
            new RouteProfileData("wallets", "wallets"),
            new RouteProfileData("workers", "workers"),
        ];
    }

    setDefaultRoutes() {
        return [
            {
                path: "/",
                name: "default",
                redirect: "/home",
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
                    import(`../../layouts/ReferralsLayoutView.vue`),
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
        ];
    }

    dropRoutes() {
        this.routes = [];
    }
}

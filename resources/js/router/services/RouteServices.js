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
            this.setDefaultRoute(),
            new RoutePublicData('home', 'home'),
            // new RoutePublicData('about', 'about'),
            new RoutePublicData('calculator', 'calculator'),
            // new RoutePublicData('complexity', 'complexity'),
            new RoutePublicData('help', 'help'),
            new RoutePublicData('hosting', 'hosting'),
            new RouteAuthData('login', 'login'),
            new RouteAuthData('registration', 'registration'),
            new RouteProfileData('accounts', 'accounts'),
            new RouteProfileData('statistic', 'statistic'),
            new RouteProfileData('connecting', 'connecting'),
            new RouteProfileData('income', 'income'),
            new RouteProfileData('settings', 'settings'),
            new RouteProfileData('wallets', 'wallets'),
            new RouteProfileData('workers', 'workers'),
            new RouteReferralData('overview', 'overview'),
            new RouteReferralData('myReferral', 'myReferral'),
            new RouteReferralData('earnRewards', 'earnRewards'),
        ]
    }

    setDefaultRoute() {
        return {
            path: '/',
            name: 'default',
            redirect: '/home',
            // component: () => import(`../../Pages/${RouteNamesMap.public['home']}`),
        }
    }

    dropRoutes() {
        this.routes = [];
    }
}

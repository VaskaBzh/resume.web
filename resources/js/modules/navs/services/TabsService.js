import { TabsData } from "../DTO/TabsData";
import { useRouter } from "vue-router";

export class TabsService {
    constructor() {
        this.mainLinks = [];
        this.subLinks = []
        this.settingLinks = []
        this.router = useRouter();
    }

    setMainLinks(user) {
        this.mainLinks = [
            ...this.mainLinks,
            new TabsData("/profile/statistic", "statistic", "statistic"),
            new TabsData("/profile/income", "income", "income"),
            new TabsData("/profile/workers", "workers", "workers"),
            new TabsData("/profile/accounts", "accounts", "accounts"),
        ];
        if (user.roles)
            if (user.roles.find((role) => role.name === "referral"))
                this.setReferralTab();
    }

    setReferralTab() {
        this.mainLinks = [
            ...this.mainLinks,
            new TabsData("/profile/referral", "referral", "referral"),
        ];
    }
    
    setSubaccountLinks(){
        this.subLinks =
            [
                new TabsData("/profile/wallets", "wallets", "wallets"),
                new TabsData("/profile/connecting", "connecting", "connecting"),
                new TabsData("/profile/watchers", "watchers", "watchers"),
            ]
    }
    setSettingsLinks(){
        this.settingLinks = [
            new TabsData("/profile/referral", "referral", "referral"),
            new TabsData("/profile/connecting", "connecting", "connecting"),
            new TabsData("/profile/watchers", "watchers", "connecting"),
        ]
    }

    dropLinks() {
        this.links = [];
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

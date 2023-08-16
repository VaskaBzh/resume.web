import { TabsData } from "../DTO/TabsData";
import accounts from "../../../store/modules/accountsInfo/accounts";

export class TabsService {
    constructor() {
        this.links = [];
    }

    setLinks() {
        this.links = [
            new TabsData(
                "statistic",
                "statistic",
                "tabs.statistic",
                "statistic"
            ),
            new TabsData("income"),
            new TabsData("wallets"),

            new TabsData("accounts"),
            new TabsData("workers"),
            new TabsData("connecting"),
        ];
    }
}

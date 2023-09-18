import { GraphDataService } from "../../common/services/GraphDataService";
import store from "@/store";
import { SubHashrateData } from "../../../DTO/SubHashrateData";
import api from "@/api/api";

export class StatisticService extends GraphDataService {
    constructor(titles, translate, offset) {
        super(titles, translate, offset);

        this.waitGraph = true;
        this.waitGraphChange = true;
        this.buttons = [];
    }

    setButtons() {
        this.buttons = [
            { title: `24 ${this.translate("hours")}`, value: 24 },
            { title: `7 ${this.translate("days")}`, value: 168 },
        ]
    }

    async fetch() {
        return await api.get(
            `/hashrate/${this.group_id}?offset=${this.offset}`,
            {
                headers: {
                    Authorization: `Bearer ${store.getters.token}`,
                },
            }
        );
    }

    async index() {
        if (this.group_id !== -1) {
            this.waitGraphChange = true;

            this.setDefaultKeys();

            this.records = (await this.fetch()).data.data.map((el) => {
                return new SubHashrateData(el);
            });

            await this.makeFullValues();

            this.waitGraph = false;
            this.waitGraphChange = false;
        }
    }

}

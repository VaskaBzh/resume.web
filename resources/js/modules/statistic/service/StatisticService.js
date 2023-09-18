import { GraphDataService } from "@/modules/common/services/GraphDataService";
import store from "@/store";
import { LineGraphData } from "@/modules/statistic/DTO/LineGraphData";
import api from "@/api/api";
import { BarGraphData } from "@/modules/statistic/DTO/BarGraphData";

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

    async fetchIncomes(page = 1, per_page = 30) {
        return await api.get(
            `/incomes/${this.group_id}?page=${page}&per_page=${per_page}`,
            {
                headers: {
                    Authorization: `Bearer ${store.getters.token}`,
                },
            }
        );
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

    async lineGraphIndex() {
        if (this.group_id !== -1) {
            this.waitGraphChange = true;

            this.setDefaultKeys();

            this.records = (await this.fetch()).data.data.map((el) => {
                return new LineGraphData(el);
            });

            await this.makeFullValues();

            this.waitGraph = false;
            this.waitGraphChange = false;
        }
    }

    async barGraphIndex() {
        if (this.group_id !== -1) {
            this.setDefaultKeys();

            this.records = (await this.fetchIncomes()).data.data.map((el) => {
                return new BarGraphData(el);
            });

            await this.makeFullBarValues();
        }
    }
}

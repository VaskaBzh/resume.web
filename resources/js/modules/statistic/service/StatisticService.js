import { GraphDataService } from "@/modules/common/services/GraphDataService";
import store from "@/store";
import { LineGraphData } from "@/modules/statistic/DTO/LineGraphData";
import { ProfileApi } from "@/api/api";
import { BarGraphData } from "@/modules/statistic/DTO/BarGraphData";

export class StatisticService extends GraphDataService {
    constructor(titles, translate, offset, route) {
        super(titles, translate, offset);

        this.waitGraph = true;
        this.waitGraphChange = true;
        this.buttons = [];

        this.route = route;
    }

    setButtons() {
        this.buttons = [
            { title: `24 ${this.translate("hours")}`, value: 96 },
            { title: `7 ${this.translate("days")}`, value: 672 },
            { title: `7 ${this.translate("month")}`, value: 2880 },
        ];
    }

    async fetchIncomes(page = 1, per_page = 30) {
        // console.log(this.route?.query?.access_key);
        return await ProfileApi.get(
            `/incomes/${this.group_id}?page=${page}&per_page=${per_page}`,
            {
                headers: {
                    ...(this.route?.query?.access_key
                        ? { "X-Access-Key": this.route.query.access_key }
                        : {
                              Authorization: `Bearer ${store.getters.token}`,
                          }),
                },
            }
        );
    }

    async fetch() {
        return await ProfileApi.get(
            `/hashrate/${this.group_id}?offset=${this.offset}`,
            {
                headers: {
                    ...(this.route?.query?.access_key
                        ? { "X-Access-Key": this.route.query.access_key }
                        : {
                              Authorization: `Bearer ${store.getters.token}`,
                          }),
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
            this.waitGraphChange = true;

            this.setDefaultKeys();

            this.records = (await this.fetchIncomes()).data.data.map((el) => {
                return new BarGraphData(el);
            });

            await this.makeFullBarValues();

            this.waitGraphChange = false;
        }
    }
}

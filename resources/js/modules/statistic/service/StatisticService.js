import { GraphDataService } from "@/modules/common/services/GraphDataService";
import store from "@/store";
import { LineGraphData } from "@/modules/statistic/DTO/LineGraphData";
import { ProfileApi } from "@/api/api";
import { BarGraphData } from "@/modules/statistic/DTO/BarGraphData";

export class StatisticService extends GraphDataService {
    constructor(offset, route) {
        super(offset);

        this.waitGraph = true;
        this.waitGraphChange = true;
        this.buttons = [];

        this.route = route;
    }

    setButtons() {
        this.buttons = [
            { title: `24 ${this.translate("hours")}`, value: 96 },
            { title: `7 ${this.translate("days")}`, value: 672 },
            { title: `1 ${this.translate("month")}`, value: 2880 },
        ];
    }

    async fetch() {
        return await ProfileApi.get(
            `/statistic/${this.group_id}?offset=${this.offset}`,
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

            try {
                const response = (await this.fetch()).data;

                this.records = response.hashes.map(hashEl => new LineGraphData(hashEl));

                await this.makeFullValues();

                this.waitGraph = false;
                this.waitGraphChange = false;
            } catch (err) {
                console.error(err);
            }
        }
    }

    async barGraphIndex() {
        if (this.group_id !== -1) {
            this.waitGraphChange = true;

            this.setDefaultKeys();

            try {
                const response = (await this.fetch()).data;

                this.records = response.incomes.map(incomeEl => new BarGraphData(incomeEl));

                await this.makeFullBarValues();

                this.waitGraph = false;
                this.waitGraphChange = false;
            } catch (err) {
                console.error(err);

                this.waitGraphChange = false;
            }
        }
    }
}

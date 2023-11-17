import {LineGraphData} from "@/modules/statistic/DTO/LineGraphData";
import {ProfileApi} from "@/api/api";
import {BarGraphData} from "@/modules/statistic/DTO/BarGraphData";
import {GraphDataService} from "@/modules/common/services/extends/GraphDataService";

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
            {title: `24 ${this.translate("hours")}`, value: 96},
            {title: `7 ${this.translate("days")}`, value: 672},
            // { title: `1 ${this.translate("month")}`, value: 2880 },
        ];
    }

    async fetch() {
        return await ProfileApi.get(
            `/statistic/${this.group_id}?offset=${this.offset}`
        );
    }

    async lineGraphIndex() {
        if (this.group_id !== -1) {
            this.waitGraphChange = true;

            this.setDefaultKeys();

            try {
                const response = (await this.fetch()).data;

                this.records = response.hashes.map(
                    (hashEl) => new LineGraphData(hashEl)
                );

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

            try {
                const response = (await this.fetch()).data;

                this.records = response.incomes.data.map(
                    (incomeEl) => new BarGraphData(incomeEl)
                );

                this.setDefaultKeys(60 * 60 * 1000 * 24);
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

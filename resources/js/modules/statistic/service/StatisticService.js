import { LineGraphData } from "@/modules/graphs/DTO/LineGraphData";
import { ProfileApi } from "@/api/api";
import { BarGraphData } from "@/modules/graphs/DTO/BarGraphData";
import { GraphDataService } from "@/modules/common/services/extends/GraphDataService";
import store from "@/store";
import { ResponseTrait } from "@/traits/ResponseTrait";

export class StatisticService {
    interval = "day";

    constructor(route) {
        this.waitGraph = true;
        this.waitGraphChange = true;

        this.route = route;

        this.graphDataService = this.createGraphDataService();
    }

    async setInterval(newIntervalValue) {
        this.interval = newIntervalValue;

        await this.lineGraphIndex();
    }

    createGraphDataService() {
        return new GraphDataService();
    }

    async fetchStatistic() {
        return await ProfileApi.get(
            `/statistic/${store.getters.getActive}?period=${this.interval}`
        );
    }

    async lineGraphIndex() {
        if (store.getters.getActive !== -1) {
            this.waitGraphChange = true;

            try {
                const response = ResponseTrait.getResponseData(await this.fetchStatistic());

                this.graphDataService.setRecords(response.hashes, LineGraphData).makeFullValues();

                this.waitGraph = false;
                this.waitGraphChange = false;
            } catch (err) {
                console.error(err);
            }
        }
    }

    async barGraphIndex() {
        if (store.getters.getActive !== -1) {
            this.waitGraphChange = true;

            try {
                const response = await this.fetchStatistic();

                this.graphDataService.setRecords(ResponseTrait.getResponseData(response).incomes, BarGraphData).makeFullValues();

                this.waitGraph = false;
                this.waitGraphChange = false;
            } catch (err) {
                console.error(err);

                this.waitGraphChange = false;
            }
        }
    }
}

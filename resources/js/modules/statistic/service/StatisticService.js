import { LineGraphData } from "@/modules/graphs/DTO/LineGraphData";
import { ProfileApi } from "@/api/api";
import { BarGraphData } from "@/modules/graphs/DTO/BarGraphData";
import { GraphDataService } from "@/modules/common/services/extends/GraphDataService";
import store from "@/store";
import { ResponseTrait } from "@/traits/ResponseTrait";

export class StatisticService {
    constructor(route) {
        this.waitGraph = true;
        this.waitGraphChange = true;

        this.route = route;

        this.graphDataService = this.createGraphDataService();
    }

    createGraphDataService() {
        return new GraphDataService();
    }

    async fetchStatistic() {
        return await ProfileApi.get(
            `/statistic/${store.getters.getActive}?offset=${this.graphDataService.offset}`
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
                const response = ResponseTrait.getResponseData(await this.fetchStatistic());

                this.graphDataService.setRecords(response.incomes, BarGraphData)

                // this.setDefaultKeys(60 * 60 * 1000 * 24);
                // await this.makeFullBarValues();

                this.waitGraph = false;
                this.waitGraphChange = false;
            } catch (err) {
                console.error(err);

                this.waitGraphChange = false;
            }
        }
    }
}

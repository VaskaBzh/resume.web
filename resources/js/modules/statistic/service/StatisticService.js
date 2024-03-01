import { LineGraphData } from "@/modules/graphs/DTO/LineGraphData";
import { ProfileApi } from "@/api/api";
import { BarGraphData } from "@/modules/graphs/DTO/BarGraphData";
import { PeriodOffsetEnum } from "@/modules/graphs/enums/PeriodOffsetEnum";
import { PeriodIntervalEnum } from "@/modules/graphs/enums/PeriodIntervalEnum";
import { GraphDataService } from "@/modules/common/services/extends/GraphDataService";
import { ResponseTrait } from "@/traits/ResponseTrait";

import store from "@/store";

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
                const response = ResponseTrait.getResponseData(
                    await this.fetchStatistic()
                );

                this.graphDataService
                    .setInterval(PeriodIntervalEnum[this.interval])
                    .setOffset(PeriodOffsetEnum[this.interval])
                    .setRecords(response.hashes, LineGraphData)
                    .makeFullValues();

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

                this.graphDataService
                    .setInterval(PeriodOffsetEnum["month"])
                    .setOffset(30)
                    .setRecords(
                        ResponseTrait.getResponseData(response).incomes,
                        BarGraphData
                    )
                    .makeFullValues();

                this.waitGraph = false;
                this.waitGraphChange = false;
            } catch (err) {
                console.error(err);

                this.waitGraphChange = false;
            }
        }
    }
}

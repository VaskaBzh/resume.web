import { ProfileApi } from "@/api/api";
import { workerData } from "@/DTO/workerData";
import { workerHashrateData } from "@/DTO/workerHashrateData";
import { GraphDataService } from "@/modules/common/services/extends/GraphDataService";
import { PeriodIntervalEnum } from "@/modules/graphs/enums/PeriodIntervalEnum";
import { PeriodOffsetEnum } from "@/modules/graphs/enums/PeriodOffsetEnum";
import { ResponseTrait } from "@/traits/ResponseTrait";

import store from "@/store";

export class WorkerService {
    interval = "day";

    constructor(translate, titles, route) {
        this.group_id = store.getters.getActive;
        this.worker_id = -1;
        this.translate = translate;
        this.titles = [];
        this.titleIndexes = titles;
        this.rows = [];
        this.filterButtons = [];
        this.status = "all";

        this.table = new Map();
        this.graphDataService = this.createGraphDataService();

        this.waitWorkers = true;
        this.emptyTableWorkers = false;

        this.popupCardOpened = false;
        this.popupCardClosed = false;

        this.target_worker = {};
        this.waitTargetWorker = true;
        this.visibleCard = false;

        this.route = route;
    }

    createGraphDataService() {
        return new GraphDataService();
    }

    async setInterval(newInterval) {
        this.interval = newInterval;

        await this.getWorkerGraph();
    }

    useTranslater(indexes) {
        this.titles = indexes.map((index) =>
            this.translate(`workers.table.thead[${index}]`)
        );
    }

    updateGroup_id() {
        this.group_id = store.getters.getActive;
    }

    async fillTable() {
        this.updateGroup_id();
        await this.getList();

        if (this.group_id !== -1) {
            this.table.set("titles", this.titles);
            this.table.set("rows", this.rows);
        }
    }

    clearWorkerId() {
        this.worker_id = -1;
    }

    setStatus(status) {
        this.status = status;

        return this;
    }

    setFilterButtons() {
        let active = store.getters.getAccount?.workers_count_active;
        let inActive = store.getters.getAccount?.workers_count_in_active;
        let dead = store.getters.getAccount?.workers_count_unstable;
        let sumWorkers = store.getters.getAccount?.workers_count;
        this.filterButtons = [
            {
                name: "all",
                value: "all",
                count: sumWorkers,
            },
            {
                name: "active",
                value: "active",
                count: active,
            },
            {
                name: "inactive",
                value: "inactive",
                count: inActive,
            },
            {
                name: "dead",
                value: "dead",
                count: dead,
            },
        ];

        return this;
    }

    async fetchList() {
        return await ProfileApi.get(
            `/workers/${this.group_id}?per_page=1000&status=${this.status}`
        );
    }

    async fetchWorker() {
        return await ProfileApi.get(`/workers/worker/${this.worker_id}`);
    }

    async fetchWorkerGraph() {
        return await ProfileApi.get(
            `/workerhashrate/${this.worker_id}?period=${this.interval}`
        );
    }

    clearTable() {
        this.table = {};
    }

    async getList() {
        if (this.group_id !== -1) {
            this.useTranslater(this.titleIndexes);
            this.emptyTableWorkers = false;
            this.waitWorkers = true;

            try {
                this.rows = (await this.fetchList()).data.data.map((el) => {
                    return new workerData({
                        ...el,
                    });
                });

                // this.rows.unshift(this.setFirstRow());
                if (this.rows.length === 0) {
                    this.emptyTableWorkers = true;
                }

                this.waitWorkers = false;
            } catch (e) {
                console.error(`Error with: ${e}`);
            }
        }
    }

    async getWorker() {
        if (this.group_id !== -1) {
            this.waitTargetWorker = true;

            Object.assign(
                this.target_worker,
                new workerData({
                    ...(await this.fetchWorker()).data.data,
                })
            );
        }
    }

    dropWorker() {
        this.target_worker = {};

        this.visibleCard = false;
        this.waitTargetWorker = true;

        return this;
    }

    openPopupCard() {
        this.popupCardOpened = true;

        setTimeout(() => {
            this.popupCardOpened = false;
        }, 300);
    }

    closePopupCard() {
        this.popupCardClosed = true;

        setTimeout(() => {
            this.popupCardClosed = false;
        }, 300);
    }

    async getPopup(worker_id) {
        this.visibleCard = true;

        this.updateGroup_id();

        this.worker_id = worker_id;

        this.openPopupCard();

        await this.getWorkerGraph();

        this.waitTargetWorker = true;
        await this.getWorker();

        this.waitTargetWorker = false;
    }

    async getWorkerGraph() {
        if (this.group_id !== -1) {
            this.waitTargetWorker = true;

            try {
                const response = await this.fetchWorkerGraph();

                this.graphDataService
                    .setInterval(PeriodIntervalEnum[this.interval])
                    .setOffset(PeriodOffsetEnum[this.interval])
                    .setRecords(
                        ResponseTrait.getResponseData(response),
                        workerHashrateData
                    )
                    .makeFullValues();

                this.waitTargetWorker = false;
            } catch (err) {
                console.error(`Error with: ${err}`);
            }
        }
    }
}

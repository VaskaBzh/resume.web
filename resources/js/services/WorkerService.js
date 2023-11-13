import { ProfileApi } from "@/api/api";

import { workerData } from "@/DTO/workerData";
import store from "@/store";
import { workerHashrateData } from "@/DTO/workerHashrateData";

export class WorkerService {
    constructor(translate, titles, route) {
        this.group_id = store.getters.getActive;
        this.worker_id = -1;
        this.translate = translate;
        this.titles = [];
        this.titleIndexes = titles;
        this.rows = [];
        this.workers_graph = {};
        this.records = [];
        this.filterButtons = [];
        this.status = "all";

        this.table = new Map();

        this.waitWorkers = true;
        this.emptyTableWorkers = false;

        this.popupCardOpened = false;
        this.popupCardClosed = false;

        this.target_worker = {};
        this.waitTargetWorker = true;
        this.visibleCard = false;

        this.route = route;
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
        this.filterButtons = [
            {
                name: "all",
                value: "all",
            },
            {
                name: "active",
                value: "active",
            },
            {
                name: "inactive",
                value: "inactive",
            },
            {
                name: "dead",
                value: "dead",
            },
        ]

        return this;
    }

    async fetchList() {
        return await ProfileApi.get(`/workers/${this.group_id}?status=${this.status}`);
    }

    async fetchWorker() {
        return await ProfileApi.get(`/workers/worker/${this.worker_id}`);
    }

    async fetchWorkerGraph() {
        return await ProfileApi.get(`/workerhashrate/${this.worker_id}`);
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

    setButtons() {
        this.buttons = [
            { title: `24 ${this.translate("hours")}`, value: 24 },
            { title: `7 ${this.translate("days")}`, value: 168 },
        ];
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
    }

    setGraphTitles() {
        return [0, 1].map((title) => this.translate(`chart.labels[${title}]`));
    }

    setDates() {
        const currentTime = new Date().getTime();
        const interval = 60 * 60 * 1000;

        return Array.from({ length: 24 }, (_, i) => {
            const date = new Date(currentTime - (24 - 1 - i) * interval);
            return date.getTime();
        });
    }

    setDefaultKeys() {
        this.workers_graph = {
            ...this.workers_graph,
            title: this.setGraphTitles(),
            dates: this.setDates(),
        };
    }

    randomizeTest(min, max) {
        return Math.random() * (max - min) + min;
    }

    async makeFullValues() {
        const [hashrate, unit] = this.records.slice(-24).reduce(
            (acc, el) => {
                acc[0].push(el.hashrate);
                acc[1].push(el.unit);

                return acc;
            },
            [[], [], []]
        );

        while (hashrate.length < 24) {
            hashrate.push(0);
            unit.push("T");
        }

        Object.assign(this.workers_graph, {
            values: hashrate.reverse(),
            unit: unit.reverse(),
        });
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

        await this.setDefaultKeys();
        this.openPopupCard();

        await this.getWorkerGraph();

        await this.makeFullValues();
        await this.getWorker();

        this.waitTargetWorker = false;
    }

    async getWorkerGraph() {
        if (this.group_id !== -1) {
            this.waitTargetWorker = true;

            this.records = (await this.fetchWorkerGraph()).data.data.map(
                (el) => {
                    return new workerHashrateData({
                        ...el,
                    });
                }
            );
        }
    }
}

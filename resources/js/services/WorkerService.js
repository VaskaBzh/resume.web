import api from "@/api/api";

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

        this.table = new Map();

        this.waitWorkers = true;
        this.emptyWorkers = false;
        this.waitTargetWorkers = true;
        this.popupCardOpened = false;
        this.popupCardClosed = false;
        this.target_worker = {};

        this.route = route;
    }

    useTranslater(indexes) {
        this.titles = indexes.map((index) =>
            this.translate(`workers.table.thead[${index}]`)
        );
    }

    // setFirstRow() {
    //     return {
    //         class: "main",
    //         name: this.translate("workers.table.sub_thead"),
    //         hashrate:
    //             store.getters.getAccount.hash_per_min +
    //             store.getters.getAccount.unit +
    //             "h/s",
    //         // unit: store.getters.getAccount.unit,
    //         hashRate24:
    //             store.getters.getAccount.hash_per_day +
    //             store.getters.getAccount.unit +
    //             "h/s",
    //         // unit24: store.getters.getAccount.unit,
    //         rejectRate: store.getters.getAccount.reject_percent + " %",
    //     };
    // }

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

    async fetchList() {
        return await api.get(`/workers/${this.group_id}`, {
            headers: {
                ...(this.route?.query?.access_key
                    ? { "X-Access-Key": this.route.query.access_key }
                    : {
                          Authorization: `Bearer ${store.getters.token}`,
                      }),
            },
        });
    }

    async fetchWorker() {
        return await api.get(`/workers/worker/${this.worker_id}`, {
            headers: {
                ...(this.route?.query?.access_key
                    ? { "X-Access-Key": this.route.query.access_key }
                    : {
                          Authorization: `Bearer ${store.getters.token}`,
                      }),
            },
        });
    }

    async fetchWorkerGraph() {
        return await api.get(`/workerhashrate/${this.worker_id}`, {
            headers: {
                ...(this.route?.query?.access_key
                    ? { "X-Access-Key": this.route.query.access_key }
                    : {
                          Authorization: `Bearer ${store.getters.token}`,
                      }),
            },
        });
    }

    clearTable() {
        this.table = {};
    }

    async getList() {
        if (this.group_id !== -1) {
            this.useTranslater(this.titleIndexes);
            this.emptyWorkers = false;
            this.waitWorkers = true;

            try {
                this.rows = (await this.fetchList()).data.data.map((el) => {
                    return new workerData({
                        ...el,
                    });
                });

                // this.rows.unshift(this.setFirstRow());

                if (this.rows.length === 0) this.emptyWorkers = true;

                this.waitWorkers = false;
            } catch (e) {
                console.error(`Error with: ${e}`);

                this.emptyWorkers = true;
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
            this.waitTargetWorkers = true;

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
        this.updateGroup_id();

        this.worker_id = worker_id;
        await this.setDefaultKeys();

        await this.getWorkerGraph();

        await this.makeFullValues();
        await this.getWorker();

        this.waitTargetWorkers = false;
    }

    async getWorkerGraph() {
        if (this.group_id !== -1) {
            this.waitTargetWorkers = true;

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

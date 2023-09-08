import api from "@/api/api";

import { workerData } from "@/DTO/workerData";
import store from "@/store";
import { workerHashrateData } from "@/DTO/workerHashrateData";

export class WorkerService {
    constructor(translate, titles) {
        this.group_id = store.getters.getActive;
        this.worker_id = -1;
        this.translate = translate;
        this.titles = this.useTranslater(titles);
        this.rows = [];

        this.table = new Map();

        this.waitWorkers = true;
        this.waitTargetWorkers = true;
        this.target_worker = {};
    }

    useTranslater(indexes) {
        return indexes.map((index) =>
            this.translate(`workers.table.thead[${index}]`)
        );
    }

    setFirstRow() {
        return {
            class: "main",
            name: this.translate("workers.table.sub_thead"),
            hashrate:
                store.getters.getAccount.hash_per_min +
                store.getters.getAccount.unit +
                "h/s",
            // unit: store.getters.getAccount.unit,
            hashRate24:
                store.getters.getAccount.hash_per_day +
                store.getters.getAccount.unit +
                "h/s",
            // unit24: store.getters.getAccount.unit,
            rejectRate: store.getters.getAccount.reject_percent + " %",
        };
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

    async fetchList() {
        return await api.get(`/workers/${this.group_id}`, {
            headers: {
                Authorization: `Bearer ${store.getters.token}`,
            },
        });
    }

    async fetchWorker() {
        return await api.get(`/workers/worker/${this.worker_id}`, {
            headers: {
                Authorization: `Bearer ${store.getters.token}`,
            },
        });
    }

    async fetchWorkerGraph() {
        return await api.get(`/workerhashrate/${this.worker_id}`, {
            headers: {
                Authorization: `Bearer ${store.getters.token}`,
            },
        });
    }

    clearTable() {
        this.table = {};
    }

    async getList() {
        if (this.group_id !== -1) {
            this.waitWorkers = true;

            try {
                this.rows = (await this.fetchList()).data.data.map((el) => {
                    return new workerData({
                        ...el,
                    });
                });

                this.rows.unshift(this.setFirstRow());

                this.waitWorkers = false;
            } catch (e) {
                console.error(`Error with: ${e}`);
            }
        }
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
        this.graph = {
            ...this.graph,
            title: this.setGraphTitles(),
            dates: this.setDates(),
        };
    }

    randomizeTest(min, max) {
        return Math.random() * (max - min) + min;
    }

    async makeFullValues() {
        const [values, unit] = this.workers_graph.slice(-24).reduce(
            (acc, el) => {
                let hashrate = el.hashrate ?? 0;
                if (el.unit === "P") hashrate *= 1000;
                else if (el.unit === "E") hashrate *= 1000000;
                acc[0].push(Number(hashrate));
                acc[1].push("T");

                return acc;
            },
            [[], [], []]
        );

        while (values.length < 24) {
            values.push(0);
            unit.push("T");
        }

        Object.assign(this.graph, {
            values: values.reverse(),
            unit: unit.reverse(),
        });
    }

    async getPopup(worker_id) {
        this.updateGroup_id();

        this.worker_id = worker_id;
        await this.getWorkerGraph();

        await this.setDefaultKeys();

        await this.makeFullValues();
        await this.getWorker();

        this.waitTargetWorkers = false;
    }

    async getWorkerGraph() {
        if (this.group_id !== -1) {
            this.waitTargetWorkers = true;

            this.workers_graph = (await this.fetchWorkerGraph()).data.data.map(
                (el) => {
                    return new workerHashrateData({
                        ...el,
                    });
                }
            );
        }
    }
}

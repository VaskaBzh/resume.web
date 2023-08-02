import api from "@/api/api";

import { workerData } from "@/DTO/workerData";
import store from "@/store";

export class WorkerService {
    constructor(translate, titles) {
        this.group_id = store.getters.getActive;
        this.translate = translate;
        this.titles = this.useTranslater(titles);
        this.rows = [];

        this.table = new Map();

        this.waitWorkers = true;
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
                store.getters.getAccount.unit,
            // unit: store.getters.getAccount.unit,
            hashRate24:
                store.getters.getAccount.hash_per_day +
                store.getters.getAccount.unit,
            // unit24: store.getters.getAccount.unit,
            rejectRate: store.getters.getAccount.reject_percent,
        };
    }

    setRow(row) {
        this.rows.push(row);
    }

    async fillTable() {
        if (store.getters.getActive !== -1) {
            await this.getList();

            this.table.set("titles", this.titles);
            this.table.set("rows", this.rows);
        }
    }

    clearWorkerId() {
        this.worker_id = -1;
    }

    async fetchList() {
        return await api.get(`/api/sub/${this.group_id}/workers`);
    }

    async fetchWorker() {
        return await api.get(`/api/worker/${this.worker_id}`);
    }

    async fetchWorkerGraph() {
        return await api.get(`/api/workerhashrate/${this.worker_id}`);
    }

    clearTable() {
        this.table = {};
    }

    async getList() {
        if (store.getters.getActive !== -1) {
            this.waitWorkers = true;

            this.rows = (await this.fetchList()).data.data.map((el) => {
                return new workerData({
                    ...el,
                });
            });
            this.rows.unshift(this.setFirstRow());

            this.waitWorkers = false;
        }
    }

    async getWorker(worker_id) {
        this.worker_id = worker_id;
        if (store.getters.getActive !== -1) {
            this.waitWorkers = true;

            this.target_worker = (await this.fetchWorker()).data.data.map(
                (el) => {
                    return new workerData({
                        ...el,
                    });
                }
            );

            this.waitWorkers = false;
        }
    }

    async getWorkerGraph(worker_id) {
        this.worker_id = worker_id;
        if (store.getters.getActive !== -1) {
            this.waitWorkers = true;

            this.workers_graph = (await this.fetchWorkerGraph()).data.data.map(
                (el) => {
                    return new workerData({
                        ...el,
                    });
                }
            );

            this.waitWorkers = false;
        }
    }
}

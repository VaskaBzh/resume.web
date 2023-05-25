import axios from "axios";

const header = {
    "Content-Type": "application/json; charset=utf-8",
    "X-CSRF-TOKEN": document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    "X-Requested-With": "XMLHttpRequest",
};

export default {
    async fetch_accounts() {
        let response = null;
        let error = null;
        await axios
            .get("/accountsAll", {
                header,
            })
            .then(async (res) => {
                response = res;
            })
            .catch((err) => (error = err));
        return response || error;
    },
    async fetch_subs() {
        let response = null;
        let error = null;
        await axios
            .get(route("sub_process"), {
                header,
            })
            .then(async (res) => {
                response = res;
            })
            .catch((err) => (error = err));
        return response || error;
    },
    async fetch_miner_history(data) {
        let response = null;
        let error = null;
        await axios
            .get("/worker_process", {
                params: data,
                header,
            })
            .then(async (res) => {
                response = res;
            })
            .catch((err) => (error = err));
        return response || error;
    },
    async fetch_income(data) {
        let response = null;
        let error = null;
        await axios
            .get("/income_process", {
                params: data,
                header,
            })
            .then(async (res) => {
                response = res;
            })
            .catch((err) => (error = err));
        return response || error;
    },
    async fetch_wallets(data) {
        let response = null;
        let error = null;
        await axios
            .get("/wallet_process", {
                params: data,
                header,
            })
            .then(async (res) => {
                response = res;
            })
            .catch((err) => (error = err));
        return response || error;
    },
    async fetch_accounts_hash(data) {
        let response = null;
        let error = null;
        await axios
            .get("/hash_process", {
                params: {
                    group_id: data.group_id,
                },
                header,
            })
            .then(async (res) => {
                response = res;
            })
            .catch((err) => (error = err));
        return response || error;
    },
    async check_workers(data) {
        let response = null;
        let error = null;
        await axios
            .get("/worker", {
                params: { id: data.el.gid },
                header,
            })
            .then(async (res) => {
                response = res;
            })
            .catch((err) => (error = err));
        return response || error;
    },
    async worker_create(data) {
        await axios.post("/worker_create", data);
    },
    async fetch(data) {
        let response = null;
        let error = null;
        await axios
            .put(
                "/proxy",
                {
                    data: data.data,
                    path: data.path,
                    type: data.method,
                    link_type: data.link_type,
                },
                header
            )
            .then(async (res) => {
                response = res;
            })
            .catch((err) => (error = err));
        return response || error;
    },
};

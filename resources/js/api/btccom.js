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
        let response, error;
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
        let response, error;
        const config = {
            headers: header, // Ваши заголовки
        };

        try {
            response = await axios.get(route("sub_process"), config);
        } catch (err) {
            error = err;
        }

        return response || error;
    },
    async fetch_miner_history(data) {
        let response, error;
        const config = {
            params: data,
            headers: header, // Ваши заголовки
        };

        try {
            response = await axios.get("/worker_process", config);
        } catch (err) {
            error = err;
        }

        return response || error;
    },
    async fetch_income(data) {
        let response, error;
        const config = {
            params: data,
            headers: header, // Ваши заголовки
        };

        try {
            response = await axios.get("/income_process", config);
        } catch (err) {
            error = err;
        }

        return response || error;
    },
    async fetch_wallets(data) {
        let response, error;
        const config = {
            params: data,
            headers: header, // Ваши заголовки
        };

        try {
            response = await axios.get("/wallet_process", config);
        } catch (err) {
            error = err;
        }

        return response || error;
    },
    async fetch_accounts_hash(data) {
        let response, error;
        const config = {
            params: {
                group_id: data.group_id,
            },
            headers: header, // Ваши заголовки
        };

        try {
            response = await axios.get("/hash_process", config);
        } catch (err) {
            error = err;
        }

        return response || error;
    },
    async check_workers(data) {
        let response, error;
        const config = {
            params: { id: data.el.gid },
            headers: header, // Ваши заголовки
        };

        try {
            response = await axios.get("/worker", config);
        } catch (err) {
            error = err;
        }

        return response || error;
    },
    async worker_create(data) {
        await axios.post("/worker_create", data);
    },
    async fetch(data) {
        let response, error;
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

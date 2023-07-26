import axios from "axios";

const header = {
    "Content-Type": "application/json; charset=utf-8",
    "X-CSRF-TOKEN": document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    "X-Requested-With": "XMLHttpRequest",
};

export default {
    async fetch_subs() {
        let response, error;
        const config = {
            headers: header,
        };

        try {
            response =
                (await axios.get(route("sub_process"), config)).data ?? [];
        } catch (err) {
            error = err;
        }

        return response ?? error;
    },
    async fetch_miner_history(data) {
        let response, error;
        const config = {
            params: data,
            headers: header,
        };

        try {
            response = (await axios.get("/worker_process", config)).data ?? [];
        } catch (err) {
            error = err;
        }

        return response ?? error;
    },
    async fetch_income(data) {
        let response, error;
        const config = {
            params: data,
            headers: header,
        };

        try {
            response = (await axios.get("/income_process", config)).data ?? [];
        } catch (err) {
            error = err;
        }

        return response ?? error;
    },
    async fetch_wallets(data) {
        let response, error;
        const config = {
            params: data,
            headers: header,
        };

        try {
            response = (await axios.get("/wallet_process", config)).data ?? [];
        } catch (err) {
            error = err;
        }

        return response ?? error;
    },
    async fetch_accounts_hash(data) {
        let response, error;
        const config = {
            params: {
                group_id: data.group_id,
            },
            headers: header,
        };

        try {
            response = (await axios.get("/hash_process", config)).data ?? [];
        } catch (err) {
            error = err;
        }

        return response ?? error;
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
                },
                header
            )
            .then(async (res) => {
                response = res.data.data ?? res.data;
            })
            .catch((err) => (error = err.response ?? err));
        return response ?? error;
    },
};

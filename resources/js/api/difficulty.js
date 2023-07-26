import axios from "axios";

const header = {
    "Content-Type": "application/json; charset=utf-8",
    "X-CSRF-TOKEN": document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    "X-Requested-With": "XMLHttpRequest",
};

export default {
    async fetch(data) {
        let response = null;
        let error = null;
        await axios
            .put(
                "/proxy_diff",
                {
                    data: data.data,
                    path: data.path,
                    type: data.method,
                },
                header
            )
            .then(async (res) => {
                response = res.data;
            })
            .catch((err) => (error = err.response ?? err));
        return response ?? error;
    },
    async fetch_minerstat() {
        let response = null;
        let error = null;
        await axios
            .get("/miner_stat")
            .then(async (res) => {
                response = res.data;
            })
            .catch((err) => (error = err.response ?? err));
        return response ?? error;
    },
};

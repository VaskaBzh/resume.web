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

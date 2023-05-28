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

import axios from "axios";

const instance = axios.create({
    baseURL: "/v1",
    headers: {
        "Content-Type": "application/json; charset=utf-8",
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-TOKEN": document
            .querySelector("meta[name='csrf-token']")
            .getAttribute("content"),
    },
});

export default instance;

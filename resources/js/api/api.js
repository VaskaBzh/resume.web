import axios from "axios";

const instance = axios.create({
    headers: {
        "Content-Type": "application/json; charset=utf-8",
        "X-CSRF-TOKEN": document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
        "X-Requested-With": "XMLHttpRequest",
    },
});

export default instance;

import axios from "axios";

const instance = axios.create({
    headers: {
        "Content-Type": "application/json; charset=utf-8",
        "X-Requested-With": "XMLHttpRequest",
    },
});

export default instance;

import axios from "axios";
import store from "@/store";
import { router } from "@/router/index";

const instance = axios.create({
    baseURL: "/v1",
    // headers: {
    //     "Content-Type": "application/json; charset=utf-8",
    //     "X-Requested-With": "XMLHttpRequest",
    //     "X-CSRF-TOKEN": document
    //         .querySelector("meta[name='csrf-token']")
    //         .getAttribute("content"),
    // },
});

instance.interceptors.response.use(
    (response) => {
        return response;
    },
    async (error) => {
        if (error.response && error.response.status === 401) {
            await router.push({ name: "home" });

            store.dispatch("dropUser");
            store.dispatch("dropToken");
        }

        return Promise.reject(error);
    }
);

export default instance;

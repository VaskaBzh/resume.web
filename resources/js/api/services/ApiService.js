import axios from "axios";
import store from "@/store";
import { router } from "@/router/index";
import { openNotification } from "@/modules/notifications/services/NotificationServices";

export class ApiService {
    constructor() {
        this.instance = null;
        this.controller = null;
    }

    setInstance() {
        this.instance = axios.create({
            baseURL: "/v1",
            headers: {
                "Content-Type": "application/json; charset=utf-8",
                "X-Requested-With": "XMLHttpRequest",
            },
        });

        return this;
    }

    setHeaders() {
        this.setTokenHeaders()
            .setLocaleHeaders()
            .setCsrfHeaders();

        return this;
    }

    setTokenHeaders() {
        this.instance.interceptors.request.use((config) => {
            const token = store.getters.token;
            if (token) config.headers["Authorization"] = `Bearer ${token}`;

            return config;
        });

        return this;
    }

    setLocaleHeaders() {
        this.instance.interceptors.request.use((config) => {
            const locale = localStorage.getItem("location");
            if (locale) config.headers["Accept-Language"] = locale;

            return config;
        });

        return this;
    }

    setCsrfHeaders() {
        this.instance.interceptors.request.use((config) => {
            const csrf = document
                .querySelector("meta[name='csrf-token']")
                .getAttribute("content");
            if (csrf) config.headers["X-CSRF-TOKEN"] = csrf;

            return config;
        });

        return this;
    }

    authorizationControl() {
        const unAuthorizedError = 401;

        this.instance.interceptors.response.use(
            (response) => {
                return response;
            },
            async (error) => {
                if (error.response && error.response.status === unAuthorizedError) {
                    await this.homeRedirect()

                    this.dropUser();
                }

                return Promise.reject(error);
            }
        );

        return this;
    }

    async homeRedirect() {
        await router.push({ name: "home" });

        return this;
    }

    dropUser() {
        store.dispatch("dropUser");
        store.dispatch("dropToken");
    }

    setController() {
        this.controller = new AbortController();

        this.setSignal();

        return this;
    }

    // initNotifications() {
    //
    //     this.instance.interceptors.response.use(
    //         (response) => {
    //             const fulfilledMessage = response.data.message;
    //
    //
    //
    //             return response;
    //         },
    //         async (error) => {
    //             const errorMessage = error.response.data.message ?? error.response.data.error;
    //
    //             openNotification(false, this.translate("validate_messages.error"), errorMessage);
    //
    //             return Promise.reject(error);
    //         }
    //     );
    //
    //     return this;
    // }

    setSignal() {
        this.instance.interceptors.request.use((config) => {
            config["signal"] = this.controller.signal;

            return config;
        });

        return this;
    }

    stopAxios() {
        this.controller.abort();

        this.setController();
    }
}
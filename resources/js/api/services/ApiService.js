import axios from "axios";
import store from "@/store";
import { router } from "@/router/index";
// import { MethodsEnum } from "@/api/enums/MethodsEnum";

export class ApiService {
    constructor() {
        this.instance = null;
        this.controller = null;
        // this.waitEvent = null;
        // this.passedEvent = null;
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
        this.setTokenHeaders().setLocaleHeaders().setCsrfHeaders();

        return this;
    }

    setTokenHeaders() {
        this.instance.interceptors.request.use((config) => {
            const token = store.getters.token;
            let access_key = null;

            if (router.currentRoute.value.query?.access_key) {
                access_key = router.currentRoute.value.query?.access_key;

                config.headers["X-Access-Key"] = access_key;
            }

            if (token && !access_key) {
                config.headers["Authorization"] = `Bearer ${token}`;
            }

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
                if (
                    error.response &&
                    error.response.status === unAuthorizedError
                ) {
                    await this.homeRedirect();

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

    // createWaitListener() {
    //     this.waitEvent = new CustomEvent("waitRequest");
    //
    //     // {
    //     //     detail: { [this.errorName]: this.errorList },
    //     // }
    //
    //     document.dispatchEvent(this.waitEvent);
    // }
    //
    // createPassedListener() {
    //     this.passedEvent = new CustomEvent("passedRequest");
    //
    //     // {
    //     //     detail: { [this.errorName]: this.errorList },
    //     // }
    //
    //     document.dispatchEvent(this.passedEvent);
    // }
    //
    // checkWaitMethods() {
    //     this.instance.interceptors.request.use(
    //         (response) => {
    //             if (
    //                 response.method === MethodsEnum["post"] ||
    //                 response.method === MethodsEnum["put"]
    //             ) {
    //                 console.log("start");
    //                 this.createWaitListener();
    //             }
    //
    //             return response;
    //         },
    //         (error) => {
    //             console.log(error);
    //             // if (
    //             //     error.method === MethodsEnum["post"] &&
    //             //     error.method === MethodsEnum["put"]
    //             // ) {
    //
    //             return Promise.reject(error);
    //             // }
    //         }
    //     );
    //
    //     return this;
    // }

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

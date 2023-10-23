import {createRouter, createWebHistory} from "vue-router";

import {LoadLayoutMiddleware} from "@/router/middlewares/LoadLayoutMiddleware";
import {AuthCheckProfileMiddleware} from "@/router/middlewares/AuthCheckProfileMiddleware";
import {AuthMiddleware} from "@/router/middlewares/AuthMiddleware";
import {DropErrorsMiddleware} from "@/router/middlewares/DropErrorsMiddleware";
import {DropSubsMiddleware} from "@/router/middlewares/DropSubsMiddleware";
import {VerifyMiddleware} from "@/router/middlewares/VerifyMiddleware";
import {ActionValidateMiddleware} from "@/router/middlewares/ActionValidateMiddleware";

import routes from "@/router/routes/rotes";
import { apiService } from "@/api/api";

export const router = createRouter({
    history: createWebHistory(),
    scrollBehavior() {
        document.body.scrollTo(0, 0);
    },
    routes,
});

const middlewares = {
    LoadLayoutMiddleware,
    AuthCheckProfileMiddleware,
    AuthMiddleware,
    DropErrorsMiddleware,
    VerifyMiddleware,
    DropSubsMiddleware,
    ActionValidateMiddleware,
};

router.beforeEach(async (to, from, next) => {
    apiService.stopAxios();

    const routeMiddleware = to.meta.middleware;

    if (to.path.startsWith("/profile") || to.path.startsWith("/watcher/")) {
        document.querySelector("body").style.overflow = "hidden";
    } else {
        document.querySelector("body").removeAttribute("style");
    }

    if (
        from.path.split("/")[1] === "watcher" &&
        to.path.split("/")[1] === "watcher"
    ) {
        const accessKey = from?.query?.access_key;
        const puid = from?.query?.puid;

        to.query = {
            access_key: accessKey,
            puid: puid,
        };
    }

    if (!routeMiddleware) {
        return next();
    }

    const middlewareFunctions = routeMiddleware.map(
        (name) => middlewares[name]
    );

    for (let i = 0; i < middlewareFunctions.length; i++) {
        await middlewareFunctions[i](to, router);
    }

    return next();
});

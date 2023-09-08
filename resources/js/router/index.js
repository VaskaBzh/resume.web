import { createRouter, createWebHashHistory } from "vue-router";

import { LoadLayoutMiddleware } from "@/router/middlewares/LoadLayoutMiddleware";
import { AuthCheckProfileMiddleware } from "@/router/middlewares/AuthCheckProfileMiddleware";
import { AuthMiddleware } from "@/router/middlewares/AuthMiddleware";
import { DropErrorsMiddleware } from "@/router/middlewares/DropErrorsMiddleware";

import routes from "@/router/routes/rotes";

export const router = createRouter({
    // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
    history: createWebHashHistory(),
    routes, // short for `routes: routes`
});

const middlewares = {
    LoadLayoutMiddleware,
    AuthCheckProfileMiddleware,
    AuthMiddleware,
    DropErrorsMiddleware,
};

router.beforeEach(async (to, from, next) => {
    const routeMiddleware = to.meta.middleware;

    if (!routeMiddleware) {
        return next();
    }

    const middlewareFunctions = routeMiddleware.map(
        (name) => middlewares[name]
    );

    for (let i = 0; i < middlewareFunctions.length; i++) {
        await middlewareFunctions[i](to);
    }

    return next();
});

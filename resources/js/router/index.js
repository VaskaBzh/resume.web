import { createRouter, createWebHistory } from "vue-router";

import { LoadLayoutMiddleware } from "@/router/middlewares/LoadLayoutMiddleware";
import { AuthCheckProfileMiddleware } from "@/router/middlewares/AuthCheckProfileMiddleware";
import { AuthMiddleware } from "@/router/middlewares/AuthMiddleware";
import { DropErrorsMiddleware } from "@/router/middlewares/DropErrorsMiddleware";
import { DropSubsMiddleware } from "@/router/middlewares/DropSubsMiddleware";

import routes from "@/router/routes/rotes";

export const router = createRouter({
    history: createWebHistory(),
    routes,
});

const middlewares = {
    LoadLayoutMiddleware,
    AuthCheckProfileMiddleware,
    AuthMiddleware,
    DropErrorsMiddleware,
    DropSubsMiddleware,
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
        await middlewareFunctions[i](to, router);
    }

    return next();
});

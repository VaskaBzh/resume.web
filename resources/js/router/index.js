import { createRouter, createWebHashHistory } from "vue-router";

import routes from "@/router/routes/rotes";
import { LoadLayoutMiddleware } from "@/router/middlewares/LoadLayoutMiddleware";
import { AuthCheckProfileMiddleware } from "@/router/middlewares/AuthCheckProfileMiddleware";
import { AuthMiddleware } from "@/router/middlewares/AuthMiddleware";

export const router = createRouter({
    // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
    history: createWebHashHistory(),
    routes, // short for `routes: routes`
});

const middlewares = {
    LoadLayoutMiddleware,
    AuthCheckProfileMiddleware,
    AuthMiddleware,
};

router.beforeEach(async (to, from, next) => {
    const routeMiddleware = to.meta.middleware;

    if (!routeMiddleware) {
        return next();
    }

    const middlewareFunctions = routeMiddleware.map(
        (name) => middlewares[name]
    );

    middlewareFunctions.forEach(async func => {
        await func(to);
    });

    return next();
});

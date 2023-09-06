import routes from "./routes/rotes";
import { createRouter, createWebHashHistory } from 'vue-router';
import { LoadLayoutMiddleware } from "./middlewares/LoadLayoutMiddleware";

export const router = createRouter({
    // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
    history: createWebHashHistory(),
    routes, // short for `routes: routes`
})

const middlewares = {
    LoadLayoutMiddleware
};

router.beforeEach(async (to, from, next) => {
    const routeMiddleware = to.meta.middleware;

    if (!routeMiddleware) {
        return next();
    }

    const middlewareFunctions = routeMiddleware.map(name => middlewares[name]);

    await middlewareFunctions[0](to);

    return next();
});

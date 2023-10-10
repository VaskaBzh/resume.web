import store from "@/store";

export async function AuthCheckProfileMiddleware(route, router) {
    const token = store.getters.token;

    if (
        !token &&
        !route?.query?.access_key
    ) {
        router.push({ name: "home" });

        store.dispatch("drop_all");
        store.dispatch("dropUser");
        store.dispatch("dropToken");
    }
}

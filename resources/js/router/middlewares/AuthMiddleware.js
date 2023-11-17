import store from "@/store";

export async function AuthMiddleware(_, router) {
    const token = store.getters.token;

    if (!!token) {
        router.push({ name: "statistic" });
    } else {
        store.dispatch("dropUser");
        store.dispatch("dropToken");
        store.dispatch("drop_all");
    }
}

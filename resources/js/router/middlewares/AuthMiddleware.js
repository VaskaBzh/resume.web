import store from "@/store";

export async function AuthMiddleware(_, router) {
    const user = store.getters.user;

    if (!!user && Object.entries(user).length > 0) {
        router.push({ name: "statistic" });
    } else {
        store.dispatch("dropUser");
        store.dispatch("dropToken");
        store.dispatch("drop_all");
    }
}

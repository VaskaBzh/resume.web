import store from "@/store";

export async function AuthCheckProfileMiddleware(route, router) {
    const user = store.getters.localUser;

    if (
        (!user ||
        Object.entries(user).length === 0) &&
        !route?.query?.access_key
    ) {
        router.push({ name: "home" });

        store.dispatch("drop_all");
        store.dispatch("dropUser");
        store.dispatch("dropToken");
    } else if (!!user) {
        store.dispatch("set_accounts", { route: route, user_id: user?.id });
    }
}

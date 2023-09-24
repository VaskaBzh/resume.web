import store from "@/store";

export async function AuthCheckProfileMiddleware(route, router) {
    const user = store.getters.user;

    if (
        !!user &&
        Object.entries(user).length === 0 &&
        !route?.query?.access_key
    ) {
        router.push({ name: "home" });
        store.dispatch("drop_all");
    } else {
        store.dispatch("set_accounts", { route: route, user_id: user.id });
    }
}

import store from "@/store";

export async function AuthCheckProfileMiddleware(_, router) {
    const user = store.getters.user;

    let interval = null;

    if (!!user && Object.entries(user).length === 0) {
        router.push({ name: "home" });
        store.dispatch("drop_all");
    } else {
        store.dispatch("set_accounts", user.id);
    }
}

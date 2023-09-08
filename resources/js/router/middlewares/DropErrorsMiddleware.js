import store from "@/store";

export async function DropErrorsMiddleware() {
    store.dispatch("dropErrors");
}

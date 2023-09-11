import store from "@/store";

export async function DropSubsMiddleware() {
    store.dispatch("drop_all");
}

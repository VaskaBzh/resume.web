import api from "@/api";

export async function AuthCheckProfileMiddleware(route) {
    const user = (await api.get("/get_user")).data.data;

    !user ? route.push({ name: "default" }) : (route.params.user = user);
}

import api from "@/api/api";

export async function AuthMiddleware(route) {
    const user = (await api.get("/get_user")).data.data;

    if (!user) route.push({ name: "statistic" });
}

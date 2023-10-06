import { ProfileApi } from "@/api/api";

export async function VerifyMiddleware(route, router) {
    try {
        await ProfileApi.get(route.fullPath);

        router.push({
            name: "statistic",
        });
    } catch (err) {
        router.push({
            name: "login",
        });
    }
}

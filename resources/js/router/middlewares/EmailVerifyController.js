import { ProfileApi } from "@/api/api";

export async function EmailVerifyController(route, router) {
    try {
        await ProfileApi.post(route.fullPath,);

        router.push({
            name: "statistic",
        });
    } catch (err) {
        router.push({
            name: "login",
        });
    }
}

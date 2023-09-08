import store from "@/store";
import axios from "axios";

export async function EmailVerifyController(route, router) {
    const verify_hash = route.query.verify_hash;
    const user = store.getters.user;
    const token = store.getters.token;

    try {
        await axios.post(
            "/v1/verify",
            {
                user: user,
            },
            {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            }
        );
    } catch (err) {
        router.push({
            name: "login",
            query: {
                verify_hash: verify_hash,
            },
        });
    }
}

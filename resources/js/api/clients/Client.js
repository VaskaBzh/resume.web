import { ProfileApi } from "@/api/api";

export class Client {
    async incomes(group_id, page = 1, per_page = 1000) {
        return await ProfileApi.get(
            `/incomes/${group_id}?page=${page}&per_page=${per_page}`
        );
    }
}

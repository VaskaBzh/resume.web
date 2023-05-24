import btccom from "@/api/btccom";

export default {
    actions: {
        async update_group({ state, commit }, data) {
            commit("setMessage", "Мы подключаем воркеров к вашему аккаунту");

            setTimeout(() => {
                commit("setMessage", "");
            }, 3000);

            const delay = (ms) =>
                new Promise((resolve) => setTimeout(resolve, ms));

            for (const workerId of Object.values(data.updateId)) {
                let updateData = {
                    puid: "781195",
                    group_id: String(data.gid),
                    worker_id: String(workerId),
                };
                await btccom.request({
                    data: updateData,
                    link: "worker/update",
                    method: "post",
                });

                await btccom.worker_create(updateData);
                await delay(1000); // Задержка в 1 секунду между каждым запросом
            }

            this.dispatch("getAccounts");
        },
    },
};

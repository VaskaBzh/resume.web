import { Inertia } from "@inertiajs/inertia";
import btccom from "@/api/btccom";

export default {
    actions: {
        async check_worker({ commit, state }, data) {
            await btccom
                .check_workers(data)
                .then(async (workers) => {
                    const workerChecker = (str, substr) => {
                        const regExp = new RegExp(substr);

                        return (
                            regExp.test(str) &&
                            str.split(".")[0].length === substr.length
                        );
                    };
                    // let wordsLength = 0;
                    Object.values(data.arr).forEach((group) => {
                        workers.data.data.data.forEach(async (worker) => {
                            if (workerChecker(worker.worker_name, group.sub)) {
                                // разобраться с возможным багом
                                // if (wordsLength < group.sub.length) {
                                // wordsLength = group.sub.length;
                                await commit("updateGroupName", {
                                    name: group.sub,
                                    groupName: data.groupName,
                                });
                                await commit("updateUpdateId", {
                                    item: worker.worker_id,
                                });
                                // }
                            }
                        });
                    });
                })
                .catch((err) => {
                    // this.dispatch("getAccounts");

                    if (
                        err.response &&
                        err.response.data.message === "CSRF token mismatch."
                    ) {
                        Inertia.reload();
                        // commit(
                        //     "setMessage",
                        //     "Кажется возникла проблема, перезагрузите страницу."
                        // );
                        //
                        // setTimeout(() => {
                        //     commit("setMessage", "");
                        // }, 3000);
                    }
                });
        },
    },
};

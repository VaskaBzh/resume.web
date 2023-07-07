import accounts_getter from "@/store/modules/accountsInfo/accounts";
import accountHashHistory from "@/store/modules/accountsInfo/accountHashHistory";
import hashrate from "@/store/modules/accountsInfo/hashrate";
import income_getter from "@/store/modules/accountsInfo/income";
import income_history from "@/store/modules/accountsInfo/incomeHistory";
import minerHashHistory from "@/store/modules/accountsInfo/minerHashHistory";
import wallets from "@/store/modules/accountsInfo/wallets";
import addWorkers from "@/store/modules/workersProcess/addWorkers";
import checkWorkers from "@/store/modules/workersProcess/checkWorkers";

export default {
    modules: {
        accounts_getter,
        checkWorkers,
        addWorkers,
        accountHashHistory,
        hashrate,
        income_getter,
        income_history,
        minerHashHistory,
        wallets,
    },
    actions: {
        destroyer({ commit }) {
            commit("destroy");
            this.dispatch("destroy_accounts");
            this.dispatch("destroy_hashrate");
            this.dispatch("destroy_income");
            this.dispatch("destroy_income_history");
            this.dispatch("destroy_miner_history_hash");
            this.dispatch("destroy_wallets");
        },
        getFullInfo() {
            // this.dispatch("accounts", state);
        },
        getAccounts({ commit, state }) {
            this.dispatch("accounts_all");
        },
        getHash({ commit, state }, data) {
            this.dispatch("get_hash", data);
        },
        async workerChecker({ commit, state }, data) {
            // await this.dispatch("check_worker", data);
        },
        getWallets({ commit, state }, data) {
            this.dispatch("get_wallets", data);
        },
        getIncomeHistory({ commit, state }, data) {
            this.dispatch("get_income_history", data);
        },
        getAllIncome({ commit, state }, data) {
            this.dispatch("get_all_income", data);
        },
        getHistoryHash({ commit, state }, data) {
            this.dispatch("get_history_hash", data);
        },
        getMinerHistoryHash({ commit, state }, data) {
            this.dispatch("get_miner_history_hash", data);
        },
    },
    mutations: {
        destroy(state) {
            state.groupName = "";
        },
    },
    state: {
        groupName: "",
    },
};

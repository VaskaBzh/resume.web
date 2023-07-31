import accounts_getter from "@/store/modules/accountsInfo/accounts";
import accountHashHistory from "@/store/modules/accountsInfo/accountHashHistory";
import hashrate from "@/store/modules/accountsInfo/hashrate";
import income_getter from "@/store/modules/accountsInfo/income";
import income_history from "@/store/modules/accountsInfo/incomeHistory";
import minerHashHistory from "@/store/modules/accountsInfo/minerHashHistory";
import wallets from "@/store/modules/accountsInfo/wallets";

export default {
    modules: {
        accounts_getter,
        accountHashHistory,
        hashrate,
        income_getter,
        income_history,
        minerHashHistory,
        wallets,
    },
    actions: {
        destroyer({ _ }) {
            this.dispatch("destroy_accounts");
            this.dispatch("destroy_hashrate");
            this.dispatch("destroy_income");
            this.dispatch("destroy_income_history");
            this.dispatch("destroy_miner_history_hash");
            this.dispatch("destroy_wallets");
        },
        getAccounts({ _ }, user_id) {
            this.dispatch("accounts_all", user_id);
        },
        getHash({ _ }, data) {
            this.dispatch("get_hash", data);
        },
        getWallets({ _ }, data) {
            this.dispatch("get_wallets", data);
        },
        getIncomeHistory({ _ }, data) {
            this.dispatch("get_income_history", data);
        },
        getAllIncome({ _ }, data) {
            this.dispatch("get_all_income", data);
        },
        getHistoryHash({ _ }, data) {
            this.dispatch("get_history_hash", data);
        },
        getMinerHistoryHash({ _ }, data) {
            this.dispatch("get_miner_history_hash", data);
        },
    },
};

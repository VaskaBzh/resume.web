import accounts_getter from "@/store/modules/accountsInfo/accounts";

export default {
    modules: {
        accounts_getter,
    },
    actions: {
        destroyer() {
            this.dispatch("destroy_accounts");
        },
        getAccounts() {
            this.dispatch("accounts_all");
        },
    },
};

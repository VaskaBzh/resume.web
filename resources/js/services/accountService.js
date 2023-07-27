export class AccountService {
    constructor(context) {
        this.$ = context;
        this.subs = [];
    }

    checkName(btcSub, subs) {
        let filtered = subs.filter((sub) => {
            return !!Object.values(sub).includes(btcSub.name);
        });

        return filtered.length;
    }

    fillTable(dispatchLink, dispatchData) {
        this.$.dispatch(dispatchLink, dispatchData);

        return this;
    }
}

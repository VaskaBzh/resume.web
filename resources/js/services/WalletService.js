import api from "@/api/api";

import { walletData } from "@/DTO/walletData";
import { useForm } from "@inertiajs/vue3";
import store from "@/store";

export class WalletService {
    constructor() {
        this.group_id = store.getters.getActive;

        this.form = useForm({
            name: "",
            wallet: "",
            percent: "100",
            minWithdrawal: "0.005",
            group_id: this.group_id,
        });

        this.waitWallets = true;
        this.wait = false;
        this.closed = false;
    }

    substring(name) {
        return (
            name.substr(0, 4) +
            "..." +
            name.substr(name.length - 4, name.length)
        );
    }

    getName(name, wallet) {
        return name ? this.substring(name) : this.substring(wallet);
    }

    clearForm(form) {
        this.form = {
            ...form,
            name: "",
            wallet: "",
            percent: "100",
            minWithdrawal: "0.005",
            group_id: store.getters.getActive,
        };
    }

    setForm(wallet) {
        this.form = {
            ...this.form,
            name: wallet.fullName,
            wallet: wallet.wallet_address,
            percent: wallet.percent,
            minWithdrawal: wallet.minWithdrawal,
            group_id: store.getters.getActive,
        };
    }

    closePopup() {
        setTimeout(() => {
            this.closed = true;
        }, 300);
        setTimeout(() => {
            this.closed = false;
        }, 600);
    }

    async index() {
        if (store.getters.getActive !== -1) {
            this.waitWallets = true;

            this.wallets = (await this.fetch()).data.data.map((el) => {
                return new walletData({
                    ...el,
                    name: this.getName(el.name, el.wallet),
                    fullName: el.name ?? el.wallet,
                });
            });

            this.waitWallets = false;
        }
    }

    async addWallet() {
        if (store.getters.getActive !== -1) {
            this.wait = true;

            await this.form.post("/wallets/create", {
                onSuccess: (res) => {
                    this.index();
                    this.clearForm();
                    this.closePopup();
                },
            });
            this.wait = false;
        } else {
            store.dispatch("getMessage", "Подождите 5 секунд.");
        }
    }

    async changeWallet() {
        if (store.getters.getActive !== -1) {
            this.wait = true;

            await this.form.post("/wallets/update", {
                onSuccess: (res) => {
                    this.index();
                    this.clearForm();
                    this.closePopup();
                },
            });
            this.wait = false;
        } else {
            store.dispatch("getMessage", "Подождите 5 секунд.");
        }
    }

    async removeWallet(wallet) {
        this.setForm(wallet);
        await this.form.post("walletswallet_delete", {});
        this.index();
    }

    // async filter(needDrop) {
    //     if (this.wallets) {
    //         if (needDrop) {
    //             this.wallets.filter((wallet) => wallet.payment !== 0);
    //         } else {
    //             this.index();
    //         }
    //     }
    // }

    async fetch() {
        return await api.get(`/wallets/${this.group_id}`);
    }
}

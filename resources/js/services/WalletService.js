import api from "@/api/api";

import { walletData } from "@/DTO/walletData";
import store from "@/store";
import { openNotification } from "@/modules/notifications/services/NotificationServices";

export class WalletService {
    constructor(translate) {
        this.group_id = store.getters.getActive;

        this.translate = translate;

        this.form = {
            name: "",
            wallet: "",
            percent: "100",
            minWithdrawal: "0.005",
            group_id: this.group_id,
        };

        this.waitWallets = true;
        this.emptyTable = false;
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

    async sendEmailVerification() {
        try {
            const response = await api.post("/email/reverify",
                {},
                {
                    headers: {
                        Authorization: `Bearer ${store.getters.token}`,
                    },
                }
            )

            openNotification(true, this.translate("validate_messages.success"), response.data.message);
        } catch (err) {
            console.error("Error with: " + err);

            this.verifyTimer = 60000;
            openNotification(false, this.translate("validate_messages.error"), err.response.data.message);
        }
    }

    async index() {
        if (store.getters.getActive !== -1) {
            this.waitWallets = true;

            try {
                const response = await this.fetch();

                if (response) {
                    this.wallets = response.map((el) => {
                        return new walletData({
                            ...el,
                            name: this.getName(el.name, el.wallet),
                            fullName: el.name ?? el.wallet,
                        });
                    });
                }

                if (this.wallets?.length === 0) {
                    this.emptyTable = true;
                }
            } catch (err) {
                console.error(err);

                openNotification(
                    false,
                    this.translate("validate_messages.error"),
                    err.response.data.message
                );
            }

            this.waitWallets = false;
        }
    }

    async addWallet() {
        if (store.getters.getActive !== -1) {
            this.wait = true;
            try {
                const response = await api.post("/wallets/create", this.form, {
                    headers: {
                        Authorization: `Bearer ${store.getters.token}`,
                    },
                });

                openNotification(
                    true,
                    this.translate("validate_messages.success"),
                    response.data.message
                );
                this.index();
                this.clearForm();
                this.closePopup();
            } catch (err) {
                console.error("Error with: " + err);
                store.dispatch("setFullErrors", err.response.data.errors);

                openNotification(
                    false,
                    this.translate("validate_messages.error"),
                    err.response.data.message
                );
            }
            this.wait = false;
        } else {
            store.dispatch("getMessage", this.translate("wallets.messages[0]"));
        }
    }

    async changeWallet() {
        if (store.getters.getActive !== -1) {
            this.wait = true;

            try {
                const response = await api.put("/wallets/update", this.form, {
                    headers: {
                        Authorization: `Bearer ${store.getters.token}`,
                    },
                });

                openNotification(
                    true,
                    this.translate("validate_messages.connected"),
                    response.data.message
                );

                this.index();
                this.clearForm();
                this.closePopup();
            } catch (e) {
                console.error("Error with: " + e);
                store.dispatch("setFullErrors", e.response.data.errors);

                openNotification(
                    false,
                    this.translate("validate_messages.error"),
                    err.response.data.message
                );
            }
            this.wait = false;
        } else {
            store.dispatch("getMessage", this.translate("wallets.messages[0]"));
            store.dispatch("setFullErrors", err.response.data.errors);
        }
    }

    async removeWallet(wallet) {
        this.setForm(wallet);
        // await this.form.post("/wallet_delete", {});
        store.dispatch("getMessage", this.translate("wallets.messages[1]"));
        // this.index();
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
        if (store.getters.getActive !== -1) {
            this.emptyTable = false;
            this.waitWallets = true;

            let response = null;

            try {
                response = (
                    await api.get(`/wallets/${store.getters.getActive}`, {
                        headers: {
                            Authorization: `Bearer ${store.getters.token}`,
                        },
                    })
                ).data.data;
            } catch (err) {
                store.dispatch("setFullErrors", err.response.data.errors);

                openNotification(
                    false,
                    this.translate("validate_messages.error"),
                    err.response.data.message
                );

                this.emptyTable = true;
                this.waitWallets = false;
            }

            return response;
        }
    }
}

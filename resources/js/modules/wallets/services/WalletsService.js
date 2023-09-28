import { ProfileApi } from "@/api/api";

import { WalletData } from "@/modules/wallets/DTO/WalletData";
import store from "@/store";
import { openNotification } from "@/modules/notifications/services/NotificationServices";
import { DefaultSubsService } from "../../common/services/DefaultSubsService";
import { VerifyService } from "../../verify/services/VerifyService";

export class WalletService extends DefaultSubsService {
    constructor(translate) {
        super();

        this.verify = new VerifyService(translate);

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
            group_id: this.group_id,
        };
    }

    setForm(wallet) {
        this.form = {
            ...this.form,
            name: wallet.fullName,
            wallet: wallet.wallet_address,
            percent: wallet.percent,
            minWithdrawal: wallet.minWithdrawal,
            group_id: this.group_id,
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
        if (this.group_id !== -1) {
            this.waitWallets = true;

            try {
                const response = await this.fetch();

                if (response) {
                    this.wallets = response.map((el) => {
                        return new WalletData({
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
        if (this.group_id !== -1) {
            this.wait = true;
            try {
                const response = await ProfileApi.post("/wallets/create", this.form);

                openNotification(
                    true,
                    this.translate("validate_messages.success"),
                    response.data.message
                );
                await this.index();
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
        if (this.group_id !== -1) {
            this.wait = true;

            try {
                const response = await ProfileApi.put("/wallets/update", this.form);

                openNotification(
                    true,
                    this.translate("validate_messages.connected"),
                    response.data.message
                );

                await this.index();
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
        if (this.group_id !== -1) {
            this.emptyTable = false;
            this.waitWallets = true;

            let response = null;

            try {
                response = (
                    await ProfileApi.get(`/wallets/${this.group_id}`)
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

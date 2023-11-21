import { ProfileApi } from "@/api/api";

import { WalletData } from "@/modules/wallets/DTO/WalletData";
import store from "@/store";
import { DefaultSubsService } from "@/modules/common/services/extends/DefaultSubsService";
import { VerifyService } from "@/modules/verify/services/VerifyService";

export class WalletsService extends DefaultSubsService {
    constructor(translate) {
        super();

        this.verify = new VerifyService(translate);

        this.translate = translate;

        this.form = {
            id: "",
            name: "",
            wallet: "",
            group_id: this.group_id,
            code: "",
        };

        this.waitWallets = true;
        this.emptyTable = false;
        this.wait = false;
        this.closed = false;
        this.opened = false;
        this.isCodeSend = false;

        this.waitAddWallet = false;
        this.waitChangeWallet = false;

        this.user = {};
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
            id: "",
            name: "",
            wallet: "",
            group_id: this.group_id,
            code: "",
        };
    }

    setForm(wallet) {
        this.form = {
            ...this.form,
            id: wallet.id,
            name: wallet.fullName,
            wallet: wallet.wallet_address,
            group_id: this.group_id,
            code: "",
        };

        this.openPopup();
    }

    openPopup() {
        this.opened = true;

        setTimeout(() => (this.opened = false), 300);
    }

    closePopup() {
        setTimeout(() => {
            this.closed = true;
        }, 300);
        setTimeout(() => {
            this.closed = false;
        }, 600);

        this.isCodeSend = false;
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
                            fullName: el.name ?? null,
                        });
                    });
                }

                if (this.wallets?.length === 0) {
                    this.emptyTable = true;
                }
            } catch (err) {
                console.error(err);

                // store.dispatch("setNotification", {
                //     status: "warning",
                //     title: "warning",
                //     text: err.response?.data?.message,
                // });
            }

            this.waitWallets = false;
        }
    }

    validateAddress() {
        if (this.form.wallet.length < 20) {
            store.dispatch("setNotification", {
                status: "error",
                title: "error",
                text: "text.wallet_address_minlength",
            });

            return true;
        }
        if (this.form.wallet.length > 191) {
            store.dispatch("setNotification", {
                status: "error",
                title: "error",
                text: "text.wallet_address_maxlength",
            });

            return true;
        }
    }

    validateName() {
        if (this.form.name !== "" && this.form.name?.length < 3) {
            store.dispatch("setNotification", {
                status: "error",
                title: "error",
                text: "text.name_minlength",
            });

            return true;
        }
    }

    async addWallet() {
        this.waitAddWallet = true;

        if (this.group_id !== -1) {
            if (this.validateAddress() || this.validateName()) {
                this.waitAddWallet = false;

                return this;
            }

            this.wait = true;

            if (!this.form.code) {
                try {
                    const response = await ProfileApi.post(
                        `/send/code/${this.user.id}`,
                        this.form
                    );

                    this.isCodeSend = true;

                    store.dispatch("setNotification", {
                        status: "success",
                        title: "success",
                        text: response.data.message,
                    });

                    this.waitAddWallet = false;
                } catch (err) {
                    this.waitAddWallet = false;

                    console.error("Error with: " + err);
                    store.dispatch("setFullErrors", err.response.data.errors);

                    store.dispatch("setNotification", {
                        status: "error",
                        title: "error",
                        text: err.response.data.message,
                    });
                }
            } else {
                try {
                    const form = {
                        wallet_address: this.form.wallet,
                        name: this.form.name,
                        group_id: this.group_id,
                        confirmation_code: this.form.code,
                    };
                    const response = await ProfileApi.post(
                        "/wallets/create",
                        form
                    );

                    this.isCodeSend = false;

                    store.dispatch("setNotification", {
                        status: "success",
                        title: "success",
                        text: response.data.message,
                    });

                    await this.index();
                    this.clearForm();
                    this.closePopup();

                    this.waitAddWallet = false;
                } catch (err) {
                    this.waitAddWallet = false;

                    console.error("Error with: " + err);
                    store.dispatch("setFullErrors", err.response.data.errors);

                    if (err.response.status === 403) {
                        store.dispatch("setNotification", {
                            status: "warning",
                            title: "warning",
                            text: err.response.data.message,
                        });
                    } else {
                        store.dispatch("setNotification", {
                            status: "error",
                            title: "error",
                            text: err.response.data.message,
                        });
                    }
                }
            }

            this.wait = false;
        } else {
            store.dispatch("getMessage", this.translate("wallets.messages[0]"));

            this.waitAddWallet = false;
        }
    }

    setUser(user) {
        this.user = user;
    }

    back() {
        this.isCodeSend = false;
        this.form.code = "";
    }

    async changeWallet() {
        this.waitChangeWallet = true;

        if (this.group_id !== -1) {
            if (this.validateAddress() || this.validateName()) {
                this.waitChangeWallet = false;

                return this;
            }

            this.wait = true;

            let requestCount = 0;

            const currentWallet = this.wallets.filter(
                (wallet) => this.form.id === wallet.id
            )[0];

            try {
                if (currentWallet.fullName !== this.form.name) {
                    try {
                        const response = await ProfileApi.put(
                            `/wallets/update/${currentWallet.wallet_address}`,
                            this.form
                        );

                        store.dispatch("setNotification", {
                            status: "success",
                            title: "changed",
                            text: response.data.data.message,
                        });

                        requestCount++;

                        this.waitChangeWallet = false;
                    } catch (err) {
                        this.waitChangeWallet = false;

                        console.error("Error with: " + err);
                        store.dispatch(
                            "setFullErrors",
                            err.response.data.errors
                        );

                        store.dispatch("setNotification", {
                            status: "error",
                            title: "error",
                            text: err.response.data.message,
                        });
                    }
                }
                if (this.form.code) {
                    try {
                        const form = {
                            wallet_address: this.form.wallet,
                            group_id: this.form.group_id,
                            confirmation_code: this.form.code,
                        };
                        const response = await ProfileApi.put(
                            `/wallets/change/address/${currentWallet.wallet_address}`,
                            form
                        );

                        store.dispatch("setNotification", {
                            status: "success",
                            title: "changed",
                            text: response.data.message,
                        });

                        await this.index();
                        this.clearForm();
                        this.closePopup();

                        this.waitChangeWallet = false;
                        return;
                    } catch (err) {
                        this.waitChangeWallet = false;

                        console.error("Error with: " + err);
                        store.dispatch(
                            "setFullErrors",
                            err.response.data.errors
                        );

                        store.dispatch("setNotification", {
                            status: "error",
                            title: "error",
                            text: err.response.data.message,
                        });

                        return;
                    }
                }
                if (currentWallet.wallet_address !== this.form.wallet) {
                    try {
                        const response = await ProfileApi.post(
                            `/send/code/${this.user.id}`,
                            this.form
                        );

                        this.isCodeSend = true;

                        store.dispatch("setNotification", {
                            status: "success",
                            title: "success",
                            text: response.data.message,
                        });

                        requestCount++;

                        this.waitChangeWallet = false;
                        return;
                    } catch (err) {
                        this.waitChangeWallet = false;

                        console.error("Error with: " + err);
                        store.dispatch(
                            "setFullErrors",
                            err.response.data.errors
                        );

                        store.dispatch("setNotification", {
                            status: "error",
                            title: "error",
                            text: err.response.data.message,
                        });
                    }
                }

                this.waitChangeWallet = false;

                if (requestCount > 0) {
                    this.closePopup();
                    await this.index();
                    this.clearForm();
                }
            } catch (err) {
                this.waitChangeWallet = false;

                console.error(err);
            }

            this.wait = false;
        } else {
            store.dispatch("getMessage", this.translate("wallets.messages[0]"));

            this.waitChangeWallet = false;
        }
    }

    async fetch() {
        if (this.group_id !== -1) {
            this.emptyTable = false;
            this.waitWallets = true;

            let response = null;

            try {
                response = (await ProfileApi.get(`/wallets/${this.group_id}`))
                    .data.data;
            } catch (err) {
                this.emptyTable = true;
                this.waitWallets = false;
            }

            return response;
        }
    }
}

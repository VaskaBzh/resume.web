import { MetaTableService } from "@/modules/common/services/extends/MetaTableService";
import { WatchersData } from "@/modules/watchers/DTO/WatchersData";
import { WatchersFormData } from "@/modules/watchers/DTO/WatchersFormData";
import { ProfileApi } from "@/api/api";
import store from "@/store";

export class WatchersService extends MetaTableService {
    constructor(translate, titleIndexes) {
        super(translate, titleIndexes);

        this.form = {};
        this.popupClosed = false;
        this.popupCardOpened = false;
        this.popupCardClosed = false;
        this.blocks = [];
        this.card = null;
    }

    useTranslater() {
        return;
    }

    closePopup() {
        this.popupClosed = true;

        setTimeout(() => {
            this.popupClosed = false;
        }, 300);
    }

    closeCardPopup() {
        this.popupCardClosed = true;

        setTimeout(() => {
            this.popupCardClosed = false;
        }, 300);
    }

    openCardPopup() {
        this.popupCardOpened = true;

        setTimeout(() => {
            this.popupCardOpened = false;
        }, 300);
    }

    setForm(name = "", allowedRows = []) {
        this.form = {
            ...this.form,
            ...new WatchersFormData(name, allowedRows),
        };
    }

    dropForm() {
        this.form = {};
    }

    async fetch(page = 1, per_page = 10) {
        return await ProfileApi.get(
            `/watchers/${store.getters.user.id}/${this.group_id}`,
            {
                headers: {
                    Authorization: `Bearer ${store.getters.token}`,
                },
            }
        );
    }

    async fetchCard(id) {
        return await ProfileApi.get(`/watchers/${id}`, {
            headers: {
                Authorization: `Bearer ${store.getters.token}`,
            },
        });
    }

    setCard(card) {
        this.card = {
            ...new WatchersData(
                card.name,
                card.allowed_routes,
                card.id,
                card.url
            ),
        };
    }

    dropCard() {
        this.card = null;
    }

    async getCard(id) {
        try {
            const card = (await this.fetchCard(id)).data.data;

            this.setCard(card);

            this.openCardPopup();
        } catch (e) {
            console.error(`Error with: ${e}`);

            this.dropCard();
        }
    }

    async index(page = 1, per_page = 10) {
        if (this.group_id !== -1) {
            try {
                this.rows = (await this.fetch()).data.data.map(
                    (el) => new WatchersData(el.name, el.allowed_routes, el.id)
                );

                this.setTable();

                this.checkEmpty();
            } catch (e) {
                console.error(`Error with: ${e}`);

                this.emptyTable = true;
            }

            this.waitTable = false;
        }
    }

    async createWatcher() {
        if (this.group_id !== -1) {
            try {
                const response = await ProfileApi.post(
                    `/watchers/create/${this.group_id}`,
                    this.form,
                    {
                        headers: {
                            Authorization: `Bearer ${store.getters.token}`,
                        },
                    }
                );

                store.dispatch("setNotification", {
                    status: "success",
                    title: "success",
                    text: this.translate("validate_messages.watcher_message"),
                });

                this.dropForm();
                this.closePopup();
            } catch (err) {
                console.error(err);

                store.dispatch("setNotification", {
                    status: "error",
                    title: "error",
                    text: err.response?.data?.message,
                });
            }
        }
    }

    async changeWatcher(id) {
        if (this.group_id !== -1) {
            try {
                const response = await ProfileApi.put(
                    `/watchers/update/${id}`,
                    this.form,
                    {
                        headers: {
                            Authorization: `Bearer ${store.getters.token}`,
                        },
                    }
                );

                store.dispatch("setNotification", {
                    status: "success",
                    title: "success",
                    text: response.data.message,
                });

                this.dropForm();
                this.closePopup();
            } catch (err) {
                console.error(err);

                store.dispatch("setNotification", {
                    status: "false",
                    title: "error",
                    text: err.response.data.message,
                });

                await this.getCard(id);
            }
        }
    }

    async removeWatcher(id) {
        if (this.group_id !== -1) {
            try {
                const response = await ProfileApi.delete(
                    `/watchers/delete/${id}`,
                    {
                        headers: {
                            Authorization: `Bearer ${store.getters.token}`,
                        },
                    }
                );

                store.dispatch("setNotification", {
                    status: "success",
                    title: "success",
                    text: response.data.message,
                });

                this.dropForm();
                this.closePopup();
            } catch (err) {
                console.error(err);

                store.dispatch("setNotification", {
                    status: "error",
                    title: "error",
                    text: err.response.data.message,
                });
            }
        }
    }
}

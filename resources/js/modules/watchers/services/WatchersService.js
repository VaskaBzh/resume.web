import { MetaTableService } from "@/modules/common/services/MetaTableService";
import { WatchersData } from "@/modules/watchers/DTO/WatchersData";
import { WatchersFormData } from "@/modules/watchers/DTO/WatchersFormData";
import api from "@/api/api";
import store from "@/store";

export class WatchersService extends MetaTableService {
    constructor(translate, titleIndexes) {
        super(translate, titleIndexes);

        this.form = {};
        this.popupClosed = false;
        this.blocks = [];
    }

    closePopup() {
        this.popupClosed = true;

        setTimeout(() => {
            this.popupClosed = false;
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

    setBlocks(newBlocks) {
        this.blocks = [...newBlocks];
    }

    dropBlocks() {
        this.blocks = [];
    }

    async fetch(page = 1, per_page = 10) {
        return await api.get(
            `/watchers/${store.getters.user.id}/${this.group_id}`,
            {
                headers: {
                    Authorization: `Bearer ${store.getters.token}`,
                },
            }
        );
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
                await api.post(`/watchers/create/${this.group_id}`, this.form, {
                    headers: {
                        Authorization: `Bearer ${store.getters.token}`,
                    },
                });

                this.dropForm();
                this.closePopup();
            } catch (err) {
                console.error(err);
            }
        }
    }
}

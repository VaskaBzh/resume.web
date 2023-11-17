import store from "@/store";

import { DefaultSubsService } from "@/modules/common/services/extends/DefaultSubsService";
import { PageService } from "@/modules/common/services/extends/PageService";
import { PopupControllService } from "@/modules/popup/services/PopupControllService";
import { Form } from "@/modules/form/models/Form";
import { ProfileApi } from "@/api/api";
import { AddFormData } from "@/modules/subs/DTO/AddFormData";

export class SubService extends DefaultSubsService {
    constructor(titleIndexes = [0, 1, 2, 3, 4]) {
        super();

        this.subsType = store.getters.viewportWidth < 768;

        this.subList = null;

        this.subsTable = new Map();
        this.rows = null;
        this.titles = null;
        this.titleIndexes = titleIndexes;

        this.waitSubs = true;
        this.emptySubs = false;
        this.emptyTableSubs = false;
        this.waitSubAdd = false;

        this.page = new PageService();

        this.addForm = this.createFormModel();
        this.addPopup = this.createPopupControllService();
    }

    createFormModel() {
        return new Form();
    }

    createPopupControllService() {
        return new PopupControllService();
    }

    addFormProcess() {
        this.addForm.setFormData(AddFormData).setClearForm();
    }

    async addSubaccount() {

        try {
            this.addForm.validate({
                name: "required|min:3|max:15|en",
            });

            const response = (await this.fetchSubAdd()).data;

            store.dispatch("setNotification", {
                status: "success",
                title: "added",
                text: response.message,
            });

            this.addPopup.closePopup();
            this.addForm.setClearForm();

            store.dispatch("accounts_all", store.getters.user.id);
        } catch (err) {
            console.error(`Error with: ${err}`);

            if (err.response && err.response.status !== 401) {
                store.dispatch("setFullErrors", {
                    name: err.response.data.errors.messages,
                });
            }
        }
    }

    async fetchSubAdd() {
        return await ProfileApi.post(
            `/subs/create/${store.getters.user.id}`,
            this.addForm.form
        );
    }

    setTranslate(translate) {
        // this.translate = translate;
    }

    setWait(newWaitState) {
        this.waitSubs = newWaitState;
    }

    setEmpty(newEmptyState) {
        this.emptySubs = newEmptyState;
    }

    setTableEmpty(newEmptyTableState) {
        this.emptyTableSubs = newEmptyTableState;
    }

    statesProcess() {
        if (this.subList.length > 0) {
            this.setWait(false);

            this.setEmpty(this.subList.length === 0);
        }

        return this;
    }

    tableStatesProcess() {
        if (this.subList.length > 0) {
            this.setTableEmpty(this.subList.length === 0);
        }

        return this;
    }

    setTitleIndexes(newTitleIndexes = [0, 1, 2, 3, 4]) {
        this.titleIndexes = newTitleIndexes;
    }

    setTitles() {
        this.titles = this.useTranslater(this.titleIndexes);

        return this;
    }

    setRows() {
        this.rows = this.subList;

        return this;
    }

    tableProcess() {
        this.setRows().setTitles().setTable();

        return this;
    }

    searchSub(searchQuery) {
        const query = searchQuery.toLowerCase().trim();

        if (!query) {
            this.setSubList().tableStatesProcess().tableProcess();

            return this;
        }

        const newSubsArray = store.getters.allAccounts
            .map((sub) => {
                const filteredSubsList = sub.name.toLowerCase().includes(query);

                return filteredSubsList ? sub : null;
            })
            .filter((bool) => bool);

        this.setSubList(newSubsArray).tableStatesProcess().tableProcess();
    }

    setSubList(newSubList = store.getters.allAccounts) {
        this.subList = newSubList;

        return this;
    }

    useTranslater(indexes) {
        return indexes.map((index) => `sub_table.titles[${index}]`);
    }

    setTable() {
        this.subsTable.set("titles", this.titles);
        this.subsTable.set("rows", this.rows);

        return this;
    }

    toggleSubsType(subsTypeState = null) {
        this.subsType = subsTypeState ?? !this.subsType;
    }

    setDocumentTitle(title) {
        this.page.titleProcess(title);
    }
}

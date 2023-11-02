import { DefaultSubsService } from "@/modules/common/services/extends/DefaultSubsService";
import { PageService } from "@/modules/common/services/extends/PageService";
import store from "@/store";

export class SubService extends DefaultSubsService {
    constructor(titleIndexes = [0, 1, 2, 3, 4]) {
        super();

        this.subsType = true;

        this.subList = null;

        this.subsTable = new Map();
        this.rows = null;
        this.titles = null;
        this.titleIndexes = titleIndexes;

        this.waitSubs = true;
        this.emptySubs = false;
        this.emptyTableSubs = false;
        this.page = new PageService();
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
        this.setRows()
            .setTitles()
            .setTable();

        return this;
    }

    searchSub(searchQuery) {
        const query = searchQuery.toLowerCase().trim();

        if (!query) {
            this.setSubList()
                .tableStatesProcess()
                .tableProcess();

            return this;
        }

        const newSubsArray = store.getters.allAccounts
            .map((sub) => {

                const filteredSubsList = sub.name.toLowerCase().includes(query);

                return filteredSubsList ? sub : null;
            })
            .filter(bool => bool);

        this.setSubList(newSubsArray)
            .tableStatesProcess()
            .tableProcess();

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

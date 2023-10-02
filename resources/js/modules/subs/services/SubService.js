import { DefaultSubsService } from "@/modules/common/services/DefaultSubsService";
import { PageService } from "@/modules/common/services/PageService";
import { SubsData } from "@/modules/subs/DTO/SubsData";

export class SubService extends DefaultSubsService {
    constructor() {
        super();

        this.subsType = false;

        this.subList = null;

        this.subsTable = null;
        this.rows = null;
        this.titles = null;
        this.titleIndexes = null;

        this.waitSubs = true;
        this.emptySubs = false;
        this.page = new PageService();
    }

    setTranslate(translate) {
        this.translate = translate;
    }

    setWait(newWaitState) {
        this.waitSubs = newWaitState;
    }

    setEmpty(newEmptyState) {
        this.emptySubs = newEmptyState;
    }

    statesProcess() {
        if (this.subList) {
            this.setWait(false);

            this.setEmpty(this.subList.length === 0);
        }
    }

    setSubList(newSubList) {
        this.subList = newSubList;

        this.statesProcess();

        return this;
    }

    useTranslater(indexes) {
        return indexes.map((index) =>
            this.translate(`table.titles[${index}]`)
        );
    }

    setTable() {
        this.table.set("titles", this.titles);
        this.table.set("rows", this.rows);

        return this;
    }

    toggleSubsType() {
        this.subsType = !this.subsType;
    }

    setDocumentTitle(title) {
        this.page.titleProcess(title);
    }
}

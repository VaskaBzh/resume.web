import { DefaultSubsService } from "@/modules/common/services/DefaultSubsService";
import { PageService } from "../../common/services/PageService";

export class SubService extends DefaultSubsService {
    constructor() {
        super();

        this.isTable = false;

        this.subList = null;

        this.waitSubs = true;
        this.emptySubs = false;
        this.page = new PageService();
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

            this.setEmpty(Object.entries(this.subList).length === 0);
        }
    }

    setSubList(newSubList) {
        this.subList = newSubList;

        this.statesProcess();
    }

    toggleIsTable() {
        this.isTable = !this.isTable;
    }

    setDocumentTitle(title) {
        this.page.titleProcess(title);
    }
}

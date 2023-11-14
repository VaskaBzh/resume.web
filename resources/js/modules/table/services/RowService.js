import { ColumnBlackListEnum } from "@/modules/table/enums/ColumnBlackListEnum";
import { WorkersKeysEnum } from "@/modules/table/enums/WorkersKeysEnum";

export class RowService {
    constructor() {
        this.filteredColumns = {};
        this.columns = {};

        this.filteredTitles = [];
        this.titles = [];

        this.workers = [];

        this.unit = null;
        this.group_id = null;

        this.viewportWidth = null;
    }

    setViewportWidth(newViewportWidth) {
        this.viewportWidth = newViewportWidth;

        return this;
    }

    setColumns(newColumns) {
        this.columns = newColumns;

        return this;
    }

    setTitles(newTitles) {
        this.titles = newTitles;

        return this;
    }

    filterColumns() {
        this.filteredColumns = Object.entries(this.columns).filter(elem => !ColumnBlackListEnum[elem[0]]);

        return this;
    }

    getUnit() {
        this.unit = Object.entries(this.columns).filter(elem => elem[0] === 'unit')[0];
        return this;
    }

    getGroupId() {
        this.group_id = Object.entries(this.columns).filter(elem => elem[0] === 'group_id')[0];

        return this;
    }

    filterTitles() {
        if (this.viewportWidth <= 767.98) {
            this.filteredTitles = [
                ...this.titles,
            ];
        }

        return this;
    }

    rowProcess(columns, titles) {
        this.setColumns(columns)
            .setTitles(titles)
            .filterColumns()
            .filterTitles()
            .getWorkers()
            .getUnit()
            .getGroupId();
    }

    getWorkers() {
        const workersObject = ["workers", {}];

        Object.entries(this.columns).forEach(elem => {
            if (WorkersKeysEnum[elem[0]]) {
                workersObject[1][elem[0]] = elem[1];
            }
        })

        if (Object.entries(workersObject[1]).length === 0) {
            return this;
        }

        this.filteredColumns.splice(1, 0, workersObject);

        return this;
    }
}

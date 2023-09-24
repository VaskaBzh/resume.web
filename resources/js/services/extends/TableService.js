import store from "@/store";

export class TableService {
    constructor(translate, titleIndexes = [0, 1, 2, 3, 6, 7]) {
        this.translate = translate;

        this.table = new Map();
        this.rows = [];
        this.titles = this.useTranslater(titleIndexes);

        this.titleIndexes = titleIndexes;

        this.activeId = store.getters.getActive;

        this.waitTable = true;
        this.emptyTable = false;
    }

    dateFormatter(date) {
        let d = date.split("");
        d.length = 10;
        return d.join("").split("-").reverse().join(".");
    }

    useTranslater(indexes) {
        return indexes.map((index) =>
            this.translate(`income.table.thead[${index}]`)
        );
    }

    setTable() {
        this.table.set("titles", this.titles);
        this.table.set("rows", this.rows);

        return this;
    }
}

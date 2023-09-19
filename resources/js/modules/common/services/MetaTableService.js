import { DefaultSubsService } from "@/modules/common/services/DefaultSubsService";

export class MetaTableService extends DefaultSubsService{
    constructor(translate, titleIndexes = [0, 1, 2, 3, 6, 7]) {
        super();

        this.translate = translate;

        this.table = new Map();
        this.rows = [];
        this.meta = null;
        this.titles = this.useTranslater(titleIndexes);

        this.titleIndexes = titleIndexes;

        this.waitTable = true;
        this.emptyTable = false;
    }

    dateFormatter(date) {
        let d = date.split("");
        d.length = 10;
        return d.join("").split("-").reverse().join(".");
    }

    getTitleMap() {
        return "income.table.thead";
    }

    useTranslater(indexes) {
        return indexes.map((index) =>
            this.translate(`${this.getTitleMap()}[${index}]`)
        );
    }

    checkEmpty() {
        if (this.rows.length === 0) {
            this.emptyTable = true;
        }
    }

    setTable() {
        this.table.set("titles", this.titles);
        this.table.set("rows", this.rows);

        this.waitTable = false;

        return this;
    }

    cutText(word) {
        return String(word).length > 15 ? this.removeLetters(word) : word;
    }

    setMeta(meta) {
        this.meta = meta;
    }

    removeLetters(word) {
        return (
            word.substr(0, 6) +
            "..." +
            word.substr(word.length - 6, word.length)
        );
    }
}

import api from "@/api/api";

export class incomeService {
    constructor(id, translate, titleIndexes = [0, 1, 2, 3, 4, 5]) {
        this.incomeList = [];
        this.incomeRows = [];

        this.translate = translate;

        this.incomeTitles = this.useTranslater(titleIndexes);

        this.activeId = id;
    }

    useTranslater(indexes) {
        return indexes.map((index) =>
            this.translate(`income.table.thead[${index}]`)
        );
    }

    async fetch(filter, page = 1, per_page = 15) {
        this.response = await api.get(
            `/api/incomes/${this.activeId}?filter[txid]=${filter}&page=${page}&per_page=${per_page}`
        );
    }

    setRows() {
        this.incomeRows = this.response.data;
    }

    setTitles(titles) {
        this.incomeTitles = titles;
    }

    setId(id) {
        this.activeId = id;
    }

    setTable() {
        this.incomeList = Object.assign({}, this.incomeTitles, this.incomeRows);
    }
}

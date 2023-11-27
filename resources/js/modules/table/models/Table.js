export class Table {
    constructor() {
        this.rows = {};

        this.rowsData = null;

        this.titleString = null;
        this.titlesLength = null;
    }

    setTitlesLength(newTitlesLength) {
        this.titlesLength = newTitlesLength;

        return this;
    }

    setTitleString(newTitleString) {
        this.titleString = newTitleString;

        return this;
    }

    get titles() {
        const fullArray = [];

        for (let i = 0; i < this.titlesLength; i++) {
            fullArray.push(`${this.titleString}[${i}]`);
        }

        return fullArray;
    }

    setRowsData(newRowsData) {
        this.rowsData = newRowsData;

        return this;
    }

    setRows(newRows) {
        this.rows = newRows.map((row) => new this.rowsData(row));

        return this;
    }

    get table() {
        return {
            titles: this.titles,
            rows: this.rows,
        };
    }
}

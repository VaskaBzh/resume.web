import { GraphDataService } from "@/modules/common/services/extends/GraphDataService";
import { TableService } from "@/modules/table/services/TableService";
import { IncomeData } from "@/modules/income/DTO/IncomeData";
import store from "@/store";

export class IncomeService {
    constructor() {
        this.graphService = new GraphDataService(30);
        this.waitGraphChange = true;

        this.tableService = this.createTableService();
    }

    createTableService() {
        return new TableService();
    }

    async index() {
        this.tableService.tableModel
            .setTitlesLength(8)
            .setTitleString("income.table.titles")
            .setRowsData(IncomeData);

        await this.tableService.fetch(
            "incomes",
            store.getters.getActive,
            1,
            1000
        );
    }

    get table() {
        return this.tableService.tableModel.table;
    }

    get isWait() {
        return this.tableService.tableStates.isWait;
    }

    get isEnd() {
        return this.tableService.tableStates.isEnd;
    }

    get isEmpty() {
        return this.tableService.tableStates.isEmpty;
    }
}

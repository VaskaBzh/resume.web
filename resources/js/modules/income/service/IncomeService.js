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

    index() {
        this.tableService
            .setTitles()
            .setRowsData(IncomeData)
            .fetch("incomes", store.getters.getActive, 1, 1222);
    }
}

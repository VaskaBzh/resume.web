import { TableControllService } from "@/modules/table/services/TableControllService";
import { Client } from "@/api/clients/Client";
import { ResponseTrait } from "@/traits/ResponseTrait";

export class TableService {
    constructor() {
        this.table = {};

        this.rows = {};
        this.titles = {};

        this.rowsData = null;

        this.client = this.createClient();

        this.responseTrait = this.useResponseTrait();

        this.tableStates = this.createTableControllService();
    }

    createClient() {
        return new Client();
    }

    useResponseTrait() {
        return new ResponseTrait();
    }

    createTableControllService() {
        return new TableControllService();
    }

    setRowsData(newRowsData) {
        this.rowsData = newRowsData;

        return this;
    }

    setRows(newRows) {
        this.rows = new this.rowsData(newRows);

        return this;
    }

    setTitles(newTitles) {
        this.titles = newTitles;

        return this;
    }

    async fetch(client, ...params) {
        this.tableStates.waitResponse();

        try {
            const response = await this.client[client](...params);

            const responseData = this.responseTrait.getResponseData(response);

            if (this.responseTrait.checkResponseLength(responseData)) {
                this.tableStates.emptyResponse();

                return this;
            }

            this.tableStates.endResponse();

            return this;
        } catch (err) {
            console.error(`Error with: ${err}`);

            this.tableStates.emptyResponse();

            return this;
        }
    }
}

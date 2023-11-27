import { TableControllService } from "@/modules/table/services/TableControllService";
import { Client } from "@/api/clients/Client";
import { ResponseTrait } from "@/traits/ResponseTrait";

export class TableService {
    GROUP_ID_PARAMS_INDEX = 0;

    constructor() {
        this.rows = {};

        this.rowsData = null;

        this.client = this.createClient();

        this.responseTrait = this.useResponseTrait();

        this.tableStates = this.createTableControllService();

        this.savedParams = null;
        this.savedClent = null;

        this.titleString = null;
        this.titlesLength = null;

        this.eventsCount = 0;
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

    saveArguments(client, params) {
        this.savedClent = client;
        this.savedParams = params;
    }

    async restartFetchWithNewGroupId(event) {
        const newParams = this.savedParams;

        newParams[this.GROUP_ID_PARAMS_INDEX] = event.detail.group_id;

        await this.fetch(this.savedClent, ...newParams);
    }

    async createRestartListener() {
        if (this.eventsCount < 1) {
            document.addEventListener(
                "changeGroupId",
                await this.restartFetchWithNewGroupId.bind(this),
                true
            );

            this.eventsCount++;
        }
    }

    async fetch(client, ...params) {
        this.saveArguments(client, params);

        await this.createRestartListener();

        if (params[this.GROUP_ID_PARAMS_INDEX] === -1) {
            new Error("Group_id is not available");

            return null;
        }

        this.tableStates.waitResponse();

        try {
            const response = await this.client[client](...params);

            const responseData = this.responseTrait.getResponseData(response);

            if (this.responseTrait.checkResponseLength(responseData)) {
                this.tableStates.emptyResponse();

                return this;
            }

            this.setRows(responseData);

            this.tableStates.endResponse();

            return this;
        } catch (err) {
            console.error(`Error with: ${err}`);

            this.tableStates.emptyResponse();

            return this;
        }
    }
}

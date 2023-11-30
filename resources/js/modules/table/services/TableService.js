import { TableControllService } from "@/modules/table/services/TableControllService";
import { Client } from "@/api/clients/Client";
import { ResponseTrait } from "@/traits/ResponseTrait";
import { Table } from "@/modules/table/models/Table";

export class TableService {
    GROUP_ID_PARAMS_INDEX = 0;

    constructor() {
        this.client = this.createClient();
        this.tableModel = this.createTableModel();
        this.responseTrait = this.useResponseTrait();
        this.tableStates = this.createTableControllService();

        this.savedParams = null;
        this.savedClent = null;

        this.eventsCount = 0;
    }

    createTableModel() {
        return new Table();
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

            if (this.responseTrait.isEmptyResponse(responseData)) {
                this.tableStates.emptyResponse();

                return this;
            }

            this.tableModel.setRows(responseData);

            this.tableStates.endResponse();

            return this;
        } catch (err) {
            console.error(`Error with: ${err}`);

            this.tableStates.emptyResponse();

            return this;
        }
    }
}

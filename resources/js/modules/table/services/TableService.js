import { TableControllService } from "@/modules/table/services/TableControllService";
import { Client } from "@/api/clients/Client";
import { ResponseTrait } from "@/traits/ResponseTrait";
import { Table } from "@/modules/table/models/Table";
import { Pagination } from "@/modules/table/models/Pagination";
import { ObjectTrait } from "@/traits/ObjectTrait";

export class TableService {
    GROUP_ID_PARAMS_INDEX = 0;

    savedParams = null;
    savedClient = null;

    eventsCount = 0;

    constructor() {
        this.client = this.createClient();
        this.tableModel = this.createTableModel();
        this.paginationModel = this.createPaginationModel();
        // this.responseTrait = this.useResponseTrait();
        this.objectTrait = this.useObjectTrait();
        this.tableStates = this.createTableControllService();
    }

    createPaginationModel() {
        return new Pagination();
    }

    createTableModel() {
        return new Table();
    }

    createClient() {
        return new Client();
    }

    // useResponseTrait() {
    //     return new ResponseTrait();
    // }

    useObjectTrait() {
        return new ObjectTrait();
    }

    createTableControllService() {
        return new TableControllService();
    }

    saveArguments(client, params) {
        this.savedClient = client;
        this.savedParams = params;
    }

    async restartFetchWithNewGroupId(event) {
        const newParams = this.savedParams;

        newParams[this.GROUP_ID_PARAMS_INDEX] = event.detail.group_id;

        await this.fetch(this.savedClient, ...newParams);
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

            const responseData = ResponseTrait.getResponseData(response);
            // const responseMeta = this.objectTrait.findValueByKey(
            //     response,
            //     "meta"
            // );

            if (ResponseTrait.isEmptyResponse(responseData)) {
                this.tableStates.emptyResponse();

                return this;
            }

            this.tableModel.setRows(responseData);

            // if (responseMeta) {
            //     this.paginationModel.paginationProcess(responseMeta);
            //     console.log(this.paginationModel);
            // }

            this.tableStates.endResponse();

            return this;
        } catch (err) {
            console.error(`Error with: ${err}`);

            this.tableStates.emptyResponse();

            return this;
        }
    }
}

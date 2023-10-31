import { ProfileApi } from "@/api/api";

import { TableService } from "./extends/TableService";

import { incomeData } from "@/DTO/incomeData";
import { paymentData } from "@/DTO/paymentData";
import store from "@/store";
import { BarGraphData } from "@/modules/statistic/DTO/BarGraphData";
import { GraphDataService } from "@/modules/common/services/extends/GraphDataService";

export class IncomeService extends TableService {
    constructor(translate, titleIndexes, route) {
        super(translate, titleIndexes);

        this.graphService = new GraphDataService(30);
        this.route = route;
        this.waitGraphChange = true;
        this.incomeBarGraph = {};
    }

    async fetchIncomes(page = 1, per_page = 1000) {
        return await ProfileApi.get(
            `/incomes/${this.activeId}?page=${page}&per_page=${per_page}`
        );
    }

    async fetchPayout(page = 1, per_page = 15) {
        return await ProfileApi.get(
            `/payouts/${this.activeId}?page=${page}&per_page=${per_page}`
        );
    }

    setMessage(message) {
        switch (message) {
            case "no wallet":
                return this.translate("income.table.messages.no_wallet");
            case "less minWithdrawal":
                return this.translate(
                    "income.table.messages.less_minWithdrawal"
                );
            case "error":
                return this.translate("income.table.messages.error");
            case "error payout":
                return this.translate("income.table.messages.error_payout");
            case "completed":
                return this.translate("income.table.messages.completed");
            case "ready to payout":
                return this.translate("income.table.messages.wallet");
        }
    }

    setStatus(status) {
        switch (status) {
            case "complete":
                return this.translate("income.table.status.fullfill");
            case "completed":
                return this.translate("income.table.status.fullfill");
            case "error":
                return this.translate("income.table.status.rejected");
            case "error payout":
                return this.translate("income.table.status.rejected");
            case "rejected":
                return this.translate("income.table.status.rejected");
            case "pending":
                return this.translate("income.table.status.pending");
            case "ready to payout":
                return this.translate("income.table.status.pending");
        }
    }

    setter(income, filter) {
        let datePay = "...";

        if (filter) {
            datePay = this.dateFormatter(income["created_at"]);
        } else {
            if (income["status"] === "completed") {
                datePay = this.dateFormatter(income["updated_at"]);
            }
        }
        let wallet = "...";
        if (income["wallet"]) {
            wallet = income["wallet"];
        }

        return filter
            ? new paymentData(
                  datePay,
                  income["payout"],
                  this.getCutted(wallet),
                  this.getCutted(income["txid"])
              )
            : new incomeData(
                  income["referral_id"]
                      ? this.translate("income.types[0]")
                      : this.translate("income.types[1]"),
                  this.dateFormatter(income["created_at"]),
                  datePay,
                  income["hash"],
                  "T",
                  income["amount"],
                  this.getCutted(wallet),
                  this.setStatus(income["status"]),
                  income["message"],
                  income["status"]
              );
    }

    getCutted(word) {
        return String(word).length > 15 ? this.removeLetters(word) : word;
    }

    removeLetters(word) {
        return (
            word.substr(0, 6) +
            "..." +
            word.substr(word.length - 6, word.length)
        );
    }

    async index(filter, page = 1, per_page = 15) {
        if (store.getters.getActive !== -1) {
            this.emptyTable = false;
            this.waitTable = true;
            let tableTitleIndexes = null;

            try {
                let response;

                if (filter) {
                    response = await this.fetchPayout(page, per_page);
                } else {
                    response = await this.fetchIncomes(page, per_page);
                }

                this.meta = response.data;

                this.rows = response.data.data.map((el) => {
                    return this.setter(el, filter);
                });

                if (
                    this.rows.filter(
                        (row) => row.type === this.translate("income.types[0]")
                    ).length === 0
                ) {
                    this.rows = this.rows.map((item) => {
                        delete item.type;
                        return item;
                    });
                    tableTitleIndexes = [...this.titleIndexes];
                    tableTitleIndexes.shift();
                    this.titles = this.useTranslater(tableTitleIndexes);
                }

                if (this.rows.length === 0) this.emptyTable = true;

                this.waitTable = false;
            } catch (err) {
                this.emptyTable = true;
            }

            if (filter) {
                this.titles = this.useTranslater([1, 4, 6, 7]);

                return this;
            }
            if (!tableTitleIndexes) {
                if (!filter) {
                    this.titles = this.useTranslater([0, 1, 2, 3, 4, 7, 8]);
                }
            }

            return this;
        }
    }

    async setTable(filter, page = 1, per_page = 15) {
        await this.index(filter, page, per_page);

        this.table.set("titles", this.titles);
        this.table.set("rows", this.rows);

        return this;
    }

    async barGraphIndex() {
        if (this.group_id !== -1) {
            this.waitGraphChange = true;

            this.graphService.setDefaultKeys(60 * 60 * 1000 * 24);

            try {
                const response = (await this.fetchIncomes(1, 30)).data.data;

                this.graphService.records = response.map((el) => {
                    return new BarGraphData(el);
                });
            } catch (e) {
                console.error(e);

                this.graphService.records = new BarGraphData({ amount: 0 });
            }

            await this.graphService.makeFullBarValues();

            this.incomeBarGraph = this.graphService.graph;

            this.waitGraphChange = false;
        }
    }
}

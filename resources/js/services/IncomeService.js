import api from "@/api/api";

import { incomeData } from "@/DTO/incomeData";
import { paymentData } from "@/DTO/paymentData";
import store from "@/store";

export class IncomeService {
    constructor(translate, titleIndexes = [0, 1, 2, 3, 6, 7]) {
        this.incomeList = new Map();
        this.incomeRows = [];

        this.translate = translate;

        this.incomeTitles = this.useTranslater(titleIndexes);

        this.activeId = store.getters.getActive;
    }

    useTranslater(indexes) {
        return indexes.map((index) =>
            this.translate(`income.table.thead[${index}]`)
        );
    }

    async fetch(filter, page = 1, per_page = 15) {
        return await api.get(
            `/api/incomes/${this.activeId}?filter[txid]=${filter}&page=${page}&per_page=${per_page}`
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
        }
    }

    setStatus(status) {
        switch (status) {
            case "completed":
                return this.translate("income.table.status.fullfill");
            case "rejected":
                return this.translate("income.table.status.rejected");
            case "pending":
                return this.translate("income.table.status.pending");
        }
    }

    dateFormatter(date) {
        let d = date.split("");
        d.length = 10;
        return d.join("").split("-").reverse().join(".");
    }

    setter(income, filter) {
        let datePay = "...";
        if (filter) {
            datePay = this.dateFormatter(income["updated_at"]);
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
                  income["payment"],
                  this.getCutted(wallet),
                  this.getCutted(income["txid"])
              )
            : new incomeData(
                  this.dateFormatter(income["created_at"]),
                  datePay,
                  income["hash"],
                  income["unit"],
                  income["amount"],
                  this.getCutted(wallet),
                  this.setStatus(income["status"]),
                  this.setMessage(income["message"]),
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

    async setRows(filter, page = 1, per_page = 15) {
        if (store.getters.getActive !== -1) {
            let response = await this.fetch(filter, page, per_page);

            this.meta = response.data;

            if (filter) {
                this.incomeTitles = this.useTranslater([1, 4, 5, 6]);
            } else {
                this.incomeTitles = this.useTranslater([0, 1, 2, 3, 6, 7]);
            }

            this.incomeRows = await response.data.data.map((income) => {
                return this.setter(income, filter);
            });

            return this;
        }
    }

    setTable() {
        this.incomeList.set("titles", this.incomeTitles);
        this.incomeList.set("rows", this.incomeRows);

        return this;
    }
}
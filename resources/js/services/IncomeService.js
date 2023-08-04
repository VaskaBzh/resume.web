import api from "@/api/api";

import { TableService } from "./extends/TableService";

import { incomeData } from "@/DTO/incomeData";
import { paymentData } from "@/DTO/paymentData";
import store from "@/store";

export class IncomeService extends TableService {
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

        console.log(income);

        return filter
            ? new paymentData(
                  datePay,
                  income["payout"],
                  this.getCutted(wallet),
                  this.getCutted(income["txid"])
              )
            : new incomeData(
                  this.dateFormatter(income["created_at"]),
                  datePay,
                  income["hash"],
                  "T",
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

    async index(filter, page = 1, per_page = 15) {
        if (store.getters.getActive !== -1) {
            this.waitTable = true;

            let response = await this.fetch(filter, page, per_page);

            this.meta = response.data;

            this.rows = response.data.data.map((el) => {
                return this.setter(el, filter);
            });

            if (filter) {
                this.titles = this.useTranslater([1, 4, 5, 6]);
            } else {
                this.titles = this.useTranslater([0, 1, 2, 3, 6, 7]);
            }

            return this;
        }
    }

    async setTable(filter, page = 1, per_page = 15) {
        await this.index(filter, page, per_page);

        this.table.set("titles", this.titles);
        this.table.set("rows", this.rows);

        if (store.getters.getActive !== -1) {
            this.waitTable = false;
        }

        return this;
    }
}

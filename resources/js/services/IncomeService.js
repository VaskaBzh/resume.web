import api from "@/api/api";

import { TableService } from "./extends/TableService";

import { incomeData } from "@/DTO/incomeData";
import { paymentData } from "@/DTO/paymentData";
import store from "@/store";

export class IncomeService extends TableService {
    async fetchIncomes(page = 1, per_page = 15) {
        return await api.get(
            `/incomes/${this.activeId}?page=${page}&per_page=${per_page}`,
            {
                headers: {
                    Authorization: `Bearer ${store.getters.token}`,
                },
            }
        );
    }

    async fetchPayout(page = 1, per_page = 15) {
        return await api.get(
            `/payouts/${this.activeId}?page=${page}&per_page=${per_page}`,
            {
                headers: {
                    Authorization: `Bearer ${store.getters.token}`,
                },
            }
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
        this.waitTable = true;
        if (store.getters.getActive !== -1) {
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

            if (filter) {
                this.titles = this.useTranslater([1, 4, 5, 6]);
            } else {
                this.titles = this.useTranslater([0, 1, 2, 3, 4, 7, 8]);
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

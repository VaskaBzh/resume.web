export const IncomeMessages = {
    en: {
        title: "Income",
        block: {
            titles: {
                full_income: "Accrued for all time",
                income: "Accrued",
                yesterday_amount: "Yesterday's income",
                month_profit: "Monthly income",
                month_profit_graph: "Monthly income chart",
            },
            hints: {
                income: `On your subaccount <span class="tooltip_text-blue">0.00051380 BTC</span> /
                    Auto payout occurs when the balance is <span class="tooltip_text-blue">> 0.005 BTC</span>`,
            },
        },
        table: {
            titles: [
                "Accrual Date",
                "Accrued",
                "Hashrate",
                "Payout Date",
                "Wallet",
                "Payout",
                "TxID",
                "Status",
            ],
            hints: {
                hashrate:
                    "Average power value of all your devices for 24 hours (calculation time 11:00 AM GMT+4)",
                txid: "Unique transaction identifier in the Bitcoin blockchain. You can use it to track the status of your transaction in the network.",
                statuses: `<div class="tooltip__list">
                            <span class="tooltip_status tooltip_status-complete">Paid</span> — accrual paid to your wallet
                            <span class="tooltip_status tooltip_status-checking">Checking</span> — your wallet is under review, 24 hours left
                            <span class="tooltip_status tooltip_status-pending">Pending</span> — not enough balance for the minimum payout threshold
                            <span class="tooltip_status tooltip_status-reject">Error</span> — error during payout
                        </div>`,
            },
        },
    },
    ru: {
        title: "Доход",
        block: {
            titles: {
                full_income: "Начислено за все время",
                income: "Начислено",
                yesterday_amount: "Вчерашний доход",
                month_profit: "Доход за месяц",
                month_profit_graph: "График дохода за месяц",
            },
            hints: {
                income: `На вашем субаккаунте <span class="tooltip_text-blue">0.00051380 BTC</span> /
                    Автовыплата происходит при  балансе <span class="tooltip_text-blue">> 0.005 BTC</span>`,
            },
        },
        table: {
            titles: [
                "Дата начисления",
                "Начислено",
                "Хешрейт",
                "Дата выплаты",
                "Кошелек",
                "Выплата",
                "TxID",
                "Статус",
            ],
            hints: {
                hashrate:
                    "Среднее значение мощности всех ваших устройств за 24 часа (время расчета 11: 00 AM GMT+4)",
                txid: "Уникальный идентификатор транзакции в блокчейне Bitcoin. С его помощью вы можете отследить статус вашей транзакции в сети.",
                statuses: `<div class="tooltip__list">
                            <span class="tooltip_status tooltip_status-complete">Выплачено</span> — начисление выплачено на ваш кошелек
                            <span class="tooltip_status tooltip_status-checking">Проверка</span> — ваш кошелек на проверке, осталось 24 час(-ов, -а)
                            <span class="tooltip_status tooltip_status-pending">В ожидании</span> — на балансе недостаточно средств для мин. порога выплаты
                            <span class="tooltip_status tooltip_status-reject">Ошибка</span> — ошибка во время выплаты
                        </div>`,
            },
        },
    },
};

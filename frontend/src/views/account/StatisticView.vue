<template>
    <div class="statistic">
        <div class="statistic__wrapper">
            <main-title tag="h2" class="statistic__title">
                Статистика
            </main-title>
            <BarChartStatistic :graphs="graphs" />
            <div class="statistic__wrap">
                <main-title tag="h3" class="statistic__wrap_title">
                    Начисления и выплаты
                </main-title>
                <payment-card
                    BTCValueFirst="0.00000000"
                    BTCValueSecond="0.00000000"
                    titleFirst="Начисление за вчера"
                    titleSecond="Прогнозируемое начисление за сегодня"
                />
                <payment-card
                    BTCValueFirst="0.00000000"
                    BTCValueSecond="0.00000000"
                    titleFirst="Сумма к выплате"
                    titleSecond="Всего выплачено"
                />
            </div>
            <div class="statistic__wrap">
                <div class="statistic__wrap_head">
                    <main-title tag="h3">Воркеры</main-title>
                    <div class="statistic__legend">
                        <div
                            class="statistic__legend_elem statistic__legend_elem-active"
                        >
                            Активные: {{ this.active }}
                        </div>
                        <div
                            class="statistic__legend_elem statistic__legend_elem-unstable"
                        >
                            Нестабильные: {{ this.unstable }}
                        </div>
                        <div
                            class="statistic__legend_elem statistic__legend_elem-unactive"
                        >
                            Неактивные: {{ this.unactive }}
                        </div>
                        <div
                            class="statistic__legend_elem statistic__legend_elem-all"
                        >
                            Все: {{ this.all }}
                        </div>
                    </div>
                </div>
                <workers-table :table="this.miniWorkers" />
                <router-link class="statistic__link main__link" to="/workers"
                    >Расширенная страница воркеров
                </router-link>
            </div>
            <div class="statistic__wrap">
                <div class="statistic__wrap_head">
                    <main-title tag="h3">Выплаты</main-title>
                </div>
                <payment-table :table="this.miniPayment" />
                <router-link class="statistic__link main__link" to="/payment"
                    >Расширенная страница выплат
                </router-link>
            </div>
        </div>
    </div>
</template>
<script>
import PaymentCard from "@/components/account/PaymentCard";
import BarChartStatistic from "@/components/account/BarChartStatistic";
import WorkersTable from "@/components/tables/WorkersTable";
import PaymentTable from "@/components/tables/PaymentTable";

export default {
    components: { PaymentCard, BarChartStatistic, WorkersTable, PaymentTable },
    data() {
        return {
            graphs: [
                {
                    id: 1,
                    title: ["Хешрейт", "Время"],
                    values: [
                        48, 70, 55, 105, 103, 145, 90, 140, 105, 150, 160, 190,
                        90,
                    ],
                },
            ],
            active: 1,
            unstable: 1,
            unactive: 1,
            all: 1,
            tables: {
                workers: {
                    titles: [
                        "Имя воркера",
                        "Текущий",
                        "Ср.хешрейт /1ч",
                        "Ср.хешрейт /24ч",
                        "Частота отказов /24ч",
                    ],
                    rows: [
                        {
                            hashClass: "active",
                            hash: 1,
                            hashRate: 171.7,
                            hashAvarage: 171.7,
                            hashAvarage24: 171.7,
                            rejectRate: 0.16,
                        },
                        {
                            hashClass: "unstable",
                            hash: 4,
                            hashRate: 171.7,
                            hashAvarage: 171.7,
                            hashAvarage24: 171.7,
                            rejectRate: 0.16,
                        },
                        {
                            hashClass: "unactive",
                            hash: 8,
                            hashRate: 171.7,
                            hashAvarage: 171.7,
                            hashAvarage24: 171.7,
                            rejectRate: 0.16,
                        },
                    ],
                    mainRow: {
                        hash: "Общий хешрейт",
                        hashRate: 171.7,
                        hashAvarage: 171.7,
                        hashAvarage24: 171.7,
                        rejectRate: 0,
                    },
                },
                payment: {
                    titles: ["Дата", "Сумма", "Ссылка на транзакцию"],
                    rows: [
                        {
                            date: "29.11.2022",
                            time: "15:10:45",
                            BTC: 0,
                            link: "54df54s8454ad445s4d515xs4d6asd45xa54s",
                        },
                        {
                            date: "29.11.2022",
                            time: "15:10:45",
                            BTC: 0,
                            link: "54df54s8454ad445s4d515xs4d6asd45xa54s",
                        },
                        {
                            date: "29.11.2022",
                            time: "15:10:45",
                            BTC: 0,
                            link: "54df54s8454ad445s4d515xs4d6asd45xa54s",
                        },
                        {
                            date: "29.11.2022",
                            time: "15:10:45",
                            BTC: 0,
                            link: "54df54s8454ad445s4d515xs4d6asd45xa54s",
                        },
                    ],
                },
            },
        };
    },
    /* eslint-disable */
    computed: {
        miniWorkers() {
            if (this.tables.workers.rows.length > 3) {
                this.tables.workers.rows.length = 3;
            }
            return this.tables.workers;
        },
        miniPayment() {
            if (this.tables.payment.rows.length > 4) {
                this.tables.payment.rows.length = 4;
            }
            return this.tables.payment;
        },
    },
    mounted() {
        document.title = "Статистика";
        console.dir(document)
    },
};
</script>
<style lang="scss" scoped>
.statistic {
    width: 100%;

    &__title {
        margin-bottom: 16px;
    }

    .graph {
        margin-bottom: 30px;
    }

    &__wrap {
        width: 100%;
        padding: 24px 16px;
        background: rgba(255, 255, 255, 0.29);
        border-radius: 21px;
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 30px;

        &:last-child {
            margin-bottom: 0;
        }

        &_title {
            margin-bottom: 12px;
            width: 100%;
        }

        &_head {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }
    }

    &__legend {
        display: flex;
        justify-content: flex-end;

        &_elem {
            margin-left: 48px;
            display: inline-flex;
            align-items: center;
            color: rgba(0, 0, 0, 0.62);
            font-weight: 400;
            font-size: 16px;
            line-height: 23px;

            &:first-child {
                margin-left: 0;
            }

            &::before {
                content: "";
                margin-right: 8px;
                width: 12px;
                height: 12px;
                border-radius: 50%;
            }

            &-active {
                &::before {
                    background-color: #13d60e;
                }
            }

            &-unstable {
                &::before {
                    background-color: #e9c058;
                }
            }

            &-unactive {
                &::before {
                    background-color: #ff0000;
                }
            }

            &-all {
                &::before {
                    content: none;
                }
            }
        }
    }

    &__link {
        margin-top: 16px;
    }
}
</style>

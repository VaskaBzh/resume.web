<template>
    <Head title="Статистика" />
    <div class="statistic">
        <div class="statistic__wrapper">
            <main-title tag="h2" class="statistic__title">
                Статистика
            </main-title>
            <div
                class="invisible_button"
                ref="popupShow"
                data-popup="#graph"
            ></div>
            <div class="wrap wrap-no-padding">
                <div class="wrap_head wrap_head-graph">
                    <main-title tag="h3" class="statistic__wrap_title">
                        Общий хешрейт
                    </main-title>
                </div>
                <div class="wrap__block wrap__block-graph">
                    <div class="propeller" v-if="this.id === 0"></div>
                    <statistic-chart
                        v-else-if="this.graphs[0].values.length > 0"
                        class="no-title"
                        :graphs="this.graphs"
                        :key="
                            this.graphs[0].values[
                                this.graphs[0].values.length - 1
                            ]
                        "
                    />
                    <div v-else></div>
                </div>
                <div class="wrap__block">
                    <div class="wrap_head">
                        <div class="wrap__row">
                            <span class="wrap_title"> Текущий хешрейт </span>
                            <span class="wrap_hash"
                                >{{
                                    Number(this.workers.hash).toFixed(2)
                                }}
                                TH/s</span
                            >
                        </div>
                        <div class="wrap__row">
                            <span class="wrap_title"> Ср.хешрейт /24ч </span>
                            <span class="wrap_hash"
                                >{{
                                    Number(this.workers.hash24).toFixed(2)
                                }}
                                TH/s</span
                            >
                        </div>
                    </div>
                    <ul class="wrap_list">
                        <main-title tag="h4" class="wrap_title">
                            <Link class="main__link" :href="route(`workers`)"
                                >Воркеры
                            </Link>
                        </main-title>
                        <li class="active">
                            {{ this.workers.active }}<span> Активные</span>
                        </li>
                        <li class="unStable">
                            {{ this.workers.unStable
                            }}<span> Нестабильные</span>
                        </li>
                        <li class="inActive">
                            {{ this.workers.inActive }}<span> Неактивные</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="wrap">
                <main-title tag="h3" class="statistic__wrap_title">
                    Начисления и выплаты
                </main-title>
                <div class="statistic__block">
                    <payment-card
                        :BTCValueFirst="this.yesterdayEarn"
                        :BTCValueSecond="this.todayEarn"
                        titleFirst="Начисление за вчера"
                        titleSecond="Прогнозируемое начисление за сегодня"
                        :iconFirst="1"
                        :iconSecond="1"
                    />
                    <payment-card
                        :BTCValueFirst="this.earn"
                        :BTCValueSecond="0"
                        titleFirst="Сумма к выплате"
                        titleSecond="Всего выплачено"
                        :iconFirst="2"
                        :iconSecond="2"
                    />
                </div>
            </div>
            <wrap-table
                :table="this.tables.payment"
                :wait="this.allHistoryForDays"
                link="payment"
                linkText="выплат"
                title="Выплаты"
            />
        </div>
    </div>
</template>
<script>
import { Link, Head, router } from "@inertiajs/vue3";
import PaymentCard from "@/Components/account/PaymentCard.vue";
import StatisticChart from "@/Components/charts/StatisticChart.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import WrapTable from "@/Components/tables/WrapTable.vue";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import { mapGetters } from "vuex";

export default {
    props: ["errors", "message", "user", "auth_user"],
    components: {
        WrapTable,
        StatisticChart,
        MainTitle,
        PaymentCard,
        Head,
        Link,
    },
    layout: profileLayoutView,
    data() {
        return {
            visualType: "table",
            interval: null,
            hash: 0,
            hash24: 0,
            reject: 0,
            workersActive: 0,
            workersUnActive: 0,
            workersInActive: 0,
            id: 0,
            graphs: [
                {
                    id: 1,
                    title: ["Хешрейт", "Время"],
                    values: [],
                },
            ],
            tables: {
                payment: {
                    rows: [],
                },
            },
        };
    },
    computed: {
        workers() {
            let obj = {
                hash: 0,
                hash24: 0,
                active: 0,
                unStable: 0,
                inActive: 0,
                all: 0,
            };
            if (Object.values(this.allAccounts).length > 0) {
                obj.hash = this.allAccounts[this.getActive].shares1m;
                obj.hash24 = this.allAccounts[this.getActive].shares1d;
                obj.active = this.allAccounts[this.getActive].workersActive;
                obj.unStable = this.allAccounts[this.getActive].workersDead;
                obj.inActive = this.allAccounts[this.getActive].workersInActive;
                obj.all = this.allAccounts[this.getActive].workersAll;
            }
            return obj;
        },
        earn() {
            if (this.$store.getters.FullEarn[this.getActive]) {
                return Number(this.$store.getters.FullEarn[this.getActive]);
            } else {
                return 0;
            }
        },
        todayEarn() {
            let val = 0;
            if (this.btcInfo) {
                if (this.allAccounts[this.getActive]) {
                    if (this.allAccounts[this.getActive].shares1d > 0) {
                        val =
                            (this.allAccounts[this.getActive].shares1d *
                                Math.pow(10, 12) *
                                86400 *
                                this.btcInfo.btc.reward) /
                            (this.btcInfo.btc.diff * Math.pow(2, 32));
                    } else if (this.allAccounts[this.getActive].shares1m > 0) {
                        val =
                            (this.allAccounts[this.getActive].shares1m *
                                Math.pow(10, 12) *
                                86400 *
                                this.btcInfo.btc.reward) /
                            (this.btcInfo.btc.diff * Math.pow(2, 32));
                    }
                }
            }
            if (typeof val === "number") {
                return val;
            } else {
                return 0;
            }
        },
        yesterdayEarn() {
            let val = 0;
            if (this.allHistoryForDays[this.getActive]) {
                if (
                    Object.values(this.allHistoryForDays[this.getActive]) &&
                    Object.values(this.allHistoryForDays[this.getActive])[1]
                ) {
                    val = Number(
                        Object.values(
                            this.allHistoryForDays[this.getActive]
                        )[1][3]
                    );
                }
            }
            if (typeof val === "number") {
                return val;
            } else {
                return 0;
            }
        },
        ...mapGetters([
            "getTable",
            "getActive",
            "allAccounts",
            "allHistory",
            "allHash",
            "allHistoryForDays",
            "btcInfo",
        ]),
    },
    methods: {
        changeId() {
            if (this.id === 0) {
                this.id = 1;
            } else if (this.id === 1) {
                this.id = 2;
            } else {
                this.id = 1;
            }
        },
        router() {
            return router;
        },
        renderChart() {
            this.changeId();
            let history = {};
            if (
                this.allHistory[this.getActive] &&
                Object.values(this.allHistory[this.getActive])[0]
            ) {
                history = Object.values(this.allHistory[this.getActive]).map(
                    (el) => {
                        if (el[2] === "T") {
                            return el[1];
                        } else {
                            return Number(el[1]) * 1000;
                        }
                    }
                );
            }
            let values = [];
            for (let i = 1; i <= 25; i++) {
                if (history) {
                    let timeStamp = history[history.length - i];
                    if (timeStamp) {
                        values.unshift(Number(timeStamp).toFixed(2));
                    } else {
                        values.unshift(String(0));
                    }
                } else {
                    values.unshift(String(0));
                }
            }
            this.graphs[0].values = values;
        },
    },
    mounted() {
        document.title = "Статистика";
        if (this.allHistory[this.getActive]) {
            if (Object.values(this.allHistory[this.getActive])) {
                this.renderChart();
            }
        }
    },
    beforeUpdate() {
        if (this.allHistory[this.getActive]) {
            if (Object.values(this.allHistory[this.getActive])) {
                if (this.id === 0) {
                    this.renderChart();
                }
            }
        }
    },
};
</script>
<style lang="scss" scoped>
.statistic {
    @media (min-width: 1271px) {
        padding-left: 330px;
    }
    width: 100%;
    .wrap {
        .title {
            width: 100%;
        }
        &-no-padding {
            display: grid;
            grid-template-columns: 600px auto;
            gap: 12px 32px;
            grid-template-rows: repeat(2, auto);
            @media (max-width: 998.98px) {
                overflow: hidden;
                grid-template-columns: 65% auto;
            }
            @media (max-width: 767.98x) {
                grid-template-columns: 10%;
            }
            .title {
                @media (min-width: 767.98px) {
                    margin-bottom: 0;
                }
            }
        }
        &__row,
        &_list {
            display: flex;
            flex-direction: column;
            .wrap_title,
            a {
                margin-bottom: 0;
                margin-top: 0;
                font-weight: 400;
                font-size: 20px;
                line-height: 23px;
                text-align: left;
                font-family: AmpleSoftPro, serif;
                @media (max-width: 479.98px) {
                    font-size: 16px;
                    line-height: 20px;
                }
                @media (max-width: 320.98px) {
                    font-size: 12px;
                    line-height: 14px;
                }
            }
            .wrap_hash,
            li {
                color: #000034;
                font-weight: 500;
                font-size: 18px;
                line-height: 26px;
                @media (max-width: 479.98px) {
                    font-size: 16px;
                    line-height: 18px;
                }
                @media (max-width: 320.98px) {
                    font-size: 12px;
                    line-height: 14px;
                }
                span {
                    font-weight: 400;
                    font-size: 16px;
                    line-height: 23px;
                    //margin-top: auto
                    @media (max-width: 320.9px) {
                        font-size: 12px;
                        line-height: 14px;
                    }
                }
            }
        }
        &__row {
            gap: 8px;
            @media (max-width: 998.98px) {
                gap: 4px;
            }
        }
        &_head {
            &-graph {
                grid-column-start: 1;
                grid-column-end: 3;
                @media (max-width: 778.98px) {
                    grid-column-end: 2;
                }
            }
        }
        &_list {
            gap: 4px;
            li {
                display: inline-flex;
                align-items: flex-end;
                gap: 8px;
                span {
                    display: inline-flex;
                    gap: 4px;
                    align-items: center;
                    &:before {
                        content: "";
                        width: 12px;
                        height: 12px;
                        border-radius: 50%;
                    }
                }
                &.active {
                    span {
                        &:before {
                            background: #13d60e;
                        }
                    }
                }
                &.inActive {
                    span {
                        &:before {
                            background: #ff0000;
                        }
                    }
                }
                &.unStable {
                    span {
                        &:before {
                            background: #e9c058;
                        }
                    }
                }
            }
        }
        &__block {
            width: 100%;
            min-height: 325px;
            background: #ffffff;
            border-radius: 21px;
            padding: 24px;
            gap: 24px;
            display: flex;
            flex-direction: column;
            @media (max-width: 767.98px) {
                padding: 15px;
                grid-column-start: 1;
                grid-column-end: 2;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                min-height: 100px;
                &-graph {
                    order: 3;
                    padding: 24px !important;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    .propeller {
                        margin: auto auto auto auto !important;
                    }
                }
            }
            @media (max-width: 479.98px) {
                min-height: 100px;
                &-graph {
                    order: 3;
                    padding: 15px 4px !important;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    .propeller {
                        margin: auto auto auto auto !important;
                    }
                }
            }
            .wrap {
                &_head {
                    display: flex;
                    justify-content: flex-start;
                    flex-direction: column;
                    gap: 8px;
                    padding: 0 !important;
                }
            }
            .propeller {
                margin: auto;
            }
            &-graph {
                padding: 24px 24px 4px 12px;
            }
        }
    }
    .invisible_button {
        width: 0;
        height: 0;
        position: absolute;
        left: 0;
        top: 0;
        z-index: -10;
        visibility: hidden;
        opacity: 0;
    }
    &__title {
        margin-bottom: 16px;
        @media (max-width: 479.98px) {
            margin-bottom: 24px;
        }
    }
    .graph {
        //margin-bottom: 32px;
        //animation: shadowDown 0.3s ease forwards;
        @media (max-width: 479.98px) {
            margin-bottom: 0;
        }
    }
    &__wrap {
        &_title {
            @media (min-width: 767.98px) {
                margin-bottom: 12px;
            }
        }
    }
    &__block {
        display: grid;
        width: 100%;
        grid-template-columns: repeat(2, 1fr);
        gap: 32px;
        @media (max-width: 767.98px) {
            grid-template-columns: 1fr;
            gap: 8px;
        }
    }
    &__link {
        margin-top: 16px;
        font-size: 18px;
        @media (max-width: 479.98px) {
            font-size: 14px;
        }
    }
}
</style>

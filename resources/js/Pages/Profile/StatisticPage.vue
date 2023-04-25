<template>
    <Head title="Статистика" />
    <div class="hidden">{{ this.allHistory[this.getActive] }}</div>
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
            <div class="wrap wrap-no-padding wrap-modify">
                <div class="wrap__head wrap__head-graph">
                    <main-title tag="h3" class="statistic__wrap_title">
                        Общий хешрейт
                    </main-title>
                </div>
                <div class="wrap__block wrap__block-graph">
                    <div class="propeller" v-if="this.id === 0"></div>
                    <statistic-chart
                        v-else
                        class="no-title"
                        :graphs="this.graphs"
                        :key="
                            this.graphs[0].values[
                                this.graphs[0].values.length - 1
                            ]
                        "
                    />
                </div>
                <div class="wrap__block wrap__column">
                    <div class="wrap__head">
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
            <!--            <div-->
            <!--                class="wrap wrap-no-padding wrap-modify wrap-modify-reverse-mini"-->
            <!--            >-->
            <!--                <div class="wrap__head wrap__head-graph">-->
            <!--                    <main-title tag="h3" class="statistic__wrap_title">-->
            <!--                        Подключение и аккаунты-->
            <!--                    </main-title>-->
            <!--                </div>-->
            <!--                <div class="wrap__block">-->
            <!--                    <div class="connecting__block">-->
            <!--                        <div class="connecting__row connecting__row-copy">-->
            <!--                            Port:-->
            <!--                            <div-->
            <!--                                class="connecting__block-copy copy"-->
            <!--                                ref="linkAddress"-->
            <!--                            >-->
            <!--                                {{ this.linkAddress }}-->
            <!--                                <svg-->
            <!--                                    class="copy-button"-->
            <!--                                    @click="this.copyLink(1)"-->
            <!--                                    xmlns="http://www.w3.org/2000/svg"-->
            <!--                                    width="24"-->
            <!--                                    height="24"-->
            <!--                                    viewBox="0 0 24 24"-->
            <!--                                    fill="none"-->
            <!--                                >-->
            <!--                                    <path-->
            <!--                                        d="M15 3V6.4C15 6.96005 15 7.24008 15.109 7.45399C15.2049 7.64215 15.3578 7.79513 15.546 7.89101C15.7599 8 16.0399 8 16.6 8H20M10 8H6C4.89543 8 4 8.89543 4 10V19C4 20.1046 4.89543 21 6 21H12C13.1046 21 14 20.1046 14 19V16M16 3H13.2C12.0799 3 11.5198 3 11.092 3.21799C10.7157 3.40973 10.4097 3.71569 10.218 4.09202C10 4.51984 10 5.0799 10 6.2V12.8C10 13.9201 10 14.4802 10.218 14.908C10.4097 15.2843 10.7157 15.5903 11.092 15.782C11.5198 16 12.0799 16 13.2 16H16.8C17.9201 16 18.4802 16 18.908 15.782C19.2843 15.5903 19.5903 15.2843 19.782 14.908C20 14.4802 20 13.9201 20 12.8V7L16 3Z"-->
            <!--                                        stroke-width="2"-->
            <!--                                        stroke-linejoin="round"-->
            <!--                                    />-->
            <!--                                </svg>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="connecting__row connecting__row-copy">-->
            <!--                            Port 1:-->
            <!--                            <div-->
            <!--                                class="connecting__block-copy copy"-->
            <!--                                ref="linkAddress1"-->
            <!--                            >-->
            <!--                                {{ this.linkAddress1 }}-->
            <!--                                <svg-->
            <!--                                    class="copy-button"-->
            <!--                                    @click="this.copyLink(2)"-->
            <!--                                    xmlns="http://www.w3.org/2000/svg"-->
            <!--                                    width="24"-->
            <!--                                    height="24"-->
            <!--                                    viewBox="0 0 24 24"-->
            <!--                                    fill="none"-->
            <!--                                >-->
            <!--                                    <path-->
            <!--                                        d="M15 3V6.4C15 6.96005 15 7.24008 15.109 7.45399C15.2049 7.64215 15.3578 7.79513 15.546 7.89101C15.7599 8 16.0399 8 16.6 8H20M10 8H6C4.89543 8 4 8.89543 4 10V19C4 20.1046 4.89543 21 6 21H12C13.1046 21 14 20.1046 14 19V16M16 3H13.2C12.0799 3 11.5198 3 11.092 3.21799C10.7157 3.40973 10.4097 3.71569 10.218 4.09202C10 4.51984 10 5.0799 10 6.2V12.8C10 13.9201 10 14.4802 10.218 14.908C10.4097 15.2843 10.7157 15.5903 11.092 15.782C11.5198 16 12.0799 16 13.2 16H16.8C17.9201 16 18.4802 16 18.908 15.782C19.2843 15.5903 19.5903 15.2843 19.782 14.908C20 14.4802 20 13.9201 20 12.8V7L16 3Z"-->
            <!--                                        stroke-width="2"-->
            <!--                                        stroke-linejoin="round"-->
            <!--                                    />-->
            <!--                                </svg>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="connecting__row connecting__row-copy">-->
            <!--                            Port 2:-->
            <!--                            <div-->
            <!--                                class="connecting__block-copy copy"-->
            <!--                                ref="linkAddress2"-->
            <!--                            >-->
            <!--                                {{ this.linkAddress2 }}-->
            <!--                                <svg-->
            <!--                                    class="copy-button"-->
            <!--                                    @click="this.copyLink(3)"-->
            <!--                                    xmlns="http://www.w3.org/2000/svg"-->
            <!--                                    width="24"-->
            <!--                                    height="24"-->
            <!--                                    viewBox="0 0 24 24"-->
            <!--                                    fill="none"-->
            <!--                                >-->
            <!--                                    <path-->
            <!--                                        d="M15 3V6.4C15 6.96005 15 7.24008 15.109 7.45399C15.2049 7.64215 15.3578 7.79513 15.546 7.89101C15.7599 8 16.0399 8 16.6 8H20M10 8H6C4.89543 8 4 8.89543 4 10V19C4 20.1046 4.89543 21 6 21H12C13.1046 21 14 20.1046 14 19V16M16 3H13.2C12.0799 3 11.5198 3 11.092 3.21799C10.7157 3.40973 10.4097 3.71569 10.218 4.09202C10 4.51984 10 5.0799 10 6.2V12.8C10 13.9201 10 14.4802 10.218 14.908C10.4097 15.2843 10.7157 15.5903 11.092 15.782C11.5198 16 12.0799 16 13.2 16H16.8C17.9201 16 18.4802 16 18.908 15.782C19.2843 15.5903 19.5903 15.2843 19.782 14.908C20 14.4802 20 13.9201 20 12.8V7L16 3Z"-->
            <!--                                        stroke-width="2"-->
            <!--                                        stroke-linejoin="round"-->
            <!--                                    />-->
            <!--                                </svg>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div-->
            <!--                    class="wrap__block wrap__block-no-bg"-->
            <!--                    v-if="Object.values(this.allAccounts).length > 0"-->
            <!--                >-->
            <!--                    <account-profile-mini-->
            <!--                        v-for="(account, i) in this.allAccounts"-->
            <!--                        :key="i"-->
            <!--                        :accKey="i"-->
            <!--                        :accountInfo="account"-->
            <!--                        :profit="this.profit"-->
            <!--                        @changeActive="this.activeChanger"-->
            <!--                    />-->
            <!--                </div>-->
            <!--                <div class="wrap__block no-info" v-else>-->
            <!--                    <div class="propeller"></div>-->
            <!--                </div>-->
            <!--            </div>-->
        </div>
    </div>
</template>
<script>
import { Link, Head, router } from "@inertiajs/vue3";
import PaymentCard from "@/Components/account/PaymentCard.vue";
import StatisticChart from "@/Components/charts/StatisticChart.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import { mapGetters } from "vuex";
import AccountProfileMini from "@/Components/account/AccountProfileMini.vue";
import Vue from "lodash";

export default {
    props: ["errors", "message", "user", "auth_user"],
    components: {
        AccountProfileMini,
        StatisticChart,
        MainTitle,
        PaymentCard,
        Head,
        Link,
    },
    layout: profileLayoutView,
    data() {
        return {
            profit: {},
            linkAddress: "btc.all-btc.com:4444",
            linkAddress1: "btc.all-btc.com:3333",
            linkAddress2: "btc.all-btc.com:2222",
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
            if (this.$store.getters.getIncome[this.getActive]) {
                return Number(
                    this.$store.getters.getIncome[this.getActive].accruals
                );
            } else {
                return 0;
            }
        },
        todayEarn() {
            let val = 0;
            if (this.btcInfo) {
                if (this.allAccounts[this.getActive]) {
                    val =
                        (this.allAccounts[this.getActive].shares1m *
                            Math.pow(10, 12) *
                            86400 *
                            this.btcInfo.btc.reward) /
                        (this.btcInfo.btc.diff * Math.pow(2, 32));
                    val = val * (1 - 0.035 - 0.0175);
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
            if (this.allIncomeHistory[this.getActive]) {
                if (
                    Object.values(this.allIncomeHistory[this.getActive]) &&
                    Object.values(this.allIncomeHistory[this.getActive])[1]
                ) {
                    val = Number(
                        Object.values(this.allIncomeHistory[this.getActive])[1][
                            "amount"
                        ]
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
            "allIncomeHistory",
            "btcInfo",
        ]),
    },
    methods: {
        activeMount() {
            document.querySelectorAll(".profile").forEach((profile) => {
                profile.classList.remove("active");
                if (profile.dataset.key == this.getActive) {
                    profile.classList.add("active");
                }
            });
        },
        activeChanger(el) {
            this.$store.commit("updateActive", el);
            setTimeout(this.activeMount, 300);
        },
        async startMount(index) {
            this.activeChanger(index);
        },
        getForcast() {
            if (this.btcInfo) {
                let val = 0;
                Object.values(this.allAccounts).forEach((el, i) => {
                    if (el.shares1d > 0) {
                        val =
                            (el.shares1d *
                                Math.pow(10, 12) *
                                86400 *
                                this.btcInfo.btc.reward) /
                            (this.btcInfo.btc.diff * Math.pow(2, 32));
                    } else if (el.shares1m > 0) {
                        val =
                            (el.shares1m *
                                Math.pow(10, 12) *
                                86400 *
                                this.btcInfo.btc.reward) /
                            (this.btcInfo.btc.diff * Math.pow(2, 32));
                    }
                    Vue.set(
                        this.profit,
                        Object.keys(this.allAccounts)[i],
                        val * 3.5 * 1.75
                    );
                });
            }
        },
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
        copyLink(i) {
            if (i === 1) {
                navigator.clipboard.writeText(this.linkAddress);
                this.$refs.linkAddress.classList.add("active");
                setTimeout(() => {
                    this.$refs.linkAddress.classList.remove("active");
                }, 1000);
            } else if (i === 2) {
                navigator.clipboard.writeText(this.linkAddress1);
                this.$refs.linkAddress1.classList.add("active");
                setTimeout(() => {
                    this.$refs.linkAddress1.classList.remove("active");
                }, 1000);
            } else if (i === 3) {
                navigator.clipboard.writeText(this.linkAddress2);
                this.$refs.linkAddress2.classList.add("active");
                setTimeout(() => {
                    this.$refs.linkAddress2.classList.remove("active");
                }, 1000);
            }
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
                        if (el["unit"] === "T") {
                            return el["hash"];
                        } else {
                            return Number(el["hash"]) * 1000;
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
            this.activeMount();
            this.getForcast();
            this.renderChart();
        }
    },
    beforeUpdate() {
        if (this.allHistory[this.getActive]) {
            this.startMount(this.getActive);
            this.getForcast();
            this.renderChart();
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
        &__head {
            flex-direction: column;
            .title {
                @media (max-width: 767.98px) {
                    margin-bottom: 8px;
                }
            }
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
            min-height: 325px;
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

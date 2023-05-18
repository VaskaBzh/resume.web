<template>
    <Head :title="$t('statistic.title')" />
    <div class="statistic">
        <div class="statistic__wrapper">
            <main-title tag="h2" class="statistic__title">
                {{ $t("statistic.title") }}
            </main-title>
            <div
                class="invisible_button"
                ref="popupShow"
                data-popup="#graph"
            ></div>
            <div
                class="wrap"
                v-if="
                    this.allHistory[this.getActive]?.filter((a) => a.hash > 0)
                        .length !== 0
                "
            >
                <div class="wrap__head wrap__head-graph">
                    <main-title tag="h3" class="statistic__wrap_title">
                        {{ $t("statistic.chart.title") }}
                    </main-title>
                    <div class="buttons">
                        <button
                            class="button"
                            :key="button.title + i"
                            v-for="(button, i) in buttons"
                            :class="{ active: button.value === this.val }"
                            @click="changeGraph(button.value)"
                        >
                            {{ button.title }}
                        </button>
                    </div>
                </div>
                <div class="wrap__block wrap__block-graph">
                    <div class="propeller" v-if="this.id !== this.val"></div>
                    <statistic-chart
                        v-else
                        class="no-title"
                        :val="this.val"
                        :graphs="this.graphs"
                        :key="
                            this.graphs[0].values[
                                this.graphs[0].values.length - 1
                            ]
                        "
                    />
                </div>
            </div>
            <div class="wrap" v-else>
                <div class="wrap__block-connect">
                    <main-title
                        tag="h3"
                        :titleName="$t('statistic.chart.no_workers_title')"
                    ></main-title>
                    <copy-block
                        v-for="(object, i) in this.copyObject"
                        :key="i"
                        :copyObject="object"
                    ></copy-block>
                </div>
            </div>
            <div class="wrap">
                <main-title tag="h3" class="statistic__wrap_title">
                    {{ $t("statistic.info_blocks.title") }}
                </main-title>
                <div class="statistic__block">
                    <payment-card
                        :key="this.allHistory[this.getActive]"
                        :BTCValueFirst="this.yesterdayEarn"
                        :BTCValueSecond="this.todayEarn"
                        :titleFirst="
                            $t('statistic.info_blocks.payment.titles[0]')
                        "
                        :titleSecond="
                            $t('statistic.info_blocks.payment.titles[1]')
                        "
                        :iconFirst="1"
                        :iconSecond="1"
                    />
                    <!--                    <account-profile-swiper-->
                    <!--                        :key="this.allHistory[this.getActive]"-->
                    <!--                        v-if="Object.values(this.allAccounts).length > 0"-->
                    <!--                    ></account-profile-swiper>-->
                    <div
                        class="wrap__block"
                        v-if="Object.values(this.allAccounts).length > 0"
                    >
                        <div class="wrap__head wrap__column">
                            <div class="wrap__row">
                                <span class="wrap_title">
                                    {{ $t("statistic.info_blocks.hash.titles[0]") }}
                                </span>
                                <span class="wrap_hash"
                                    >{{
                                        Number(this.workers.hash).toFixed(2)
                                    }}
                                    TH/s</span
                                >
                            </div>
                            <div class="wrap__row">
                                <span class="wrap_title">
                                    {{ $t("statistic.info_blocks.hash.titles[1]") }}
                                </span>
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
                                <Link
                                    class="main__link"
                                    :href="route(`workers`)"
                                    >{{ $t("statistic.info_blocks.workers.title") }}
                                </Link>
                            </main-title>
                            <li class="active">
                                {{ this.workers.active
                                }}<span>
                                    {{ $t("statistic.info_blocks.workers.types[0]") }}</span
                                >
                            </li>
                            <li class="unStable">
                                {{ this.workers.unStable
                                }}<span>
                                    {{ $t("statistic.info_blocks.workers.types[1]") }}</span
                                >
                            </li>
                            <li class="inActive">
                                {{ this.workers.inActive
                                }}<span>{{
                                    $t("statistic.info_blocks.workers.types[2]")
                                }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="wrap__column no-info" v-else>
                        <div class="propeller"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import CopyBlock from "@/Components/account/CopyBlock.vue";
import { Link, Head, router } from "@inertiajs/vue3";
import PaymentCard from "@/Components/account/PaymentCard.vue";
import StatisticChart from "@/Components/charts/StatisticChart.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import { mapGetters } from "vuex";
import AccountProfileSwiper from "@/Components/account/AccountProfileSwiper.vue";

export default {
    props: ["errors", "message", "user", "auth_user"],
    components: {
        AccountProfileSwiper,
        StatisticChart,
        MainTitle,
        PaymentCard,
        Head,
        Link,
        CopyBlock,
    },
    layout: profileLayoutView,
    data() {
        return {
            copyObject: [
                {
                    title: "1. Настройте ваше устройство согласно представленным ниже данным:",
                    copyObject: [
                        { link: "btc.all-btc.com:4444", title: "Port" },
                        { link: "btc.all-btc.com:3333", title: "Port 1" },
                        { link: "btc.all-btc.com:2222", title: "Port 2" },
                    ],
                },
            ],
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
            val: 24,
            buttons: [
                // { title: "6 часов", value: 6 },
                { title: "24 часа", value: 24 },
                { title: "7 дней", value: 168 },
            ],
            graphs: [
                {
                    id: 1,
                    title: ["Хешрейт", "Время"],
                    values: [],
                    time: [],
                    amount: [],
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
                    val = val * (1 - 0.035 - 0.005);
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
        changeGraph(val) {
            this.val = val;
        },
        changeId() {
            this.id = this.val;
        },
        router() {
            return router;
        },
        renderChart() {
            let history = {};
            if (
                this.allHistory[this.getActive] &&
                Object.values(this.allHistory[this.getActive])[0]
            ) {
                history = Object.values(this.allHistory[this.getActive]).map(
                    (el) => {
                        if (el["unit"] === "T") {
                            return el["hash"];
                        } else if (el["unit"] === "P") {
                            return Number(el["hash"]) * 1000;
                        } else if (el["unit"] === "E") {
                            return Number(el["hash"]) * 1000 * 1000;
                        }
                    }
                );
            }
            let val = this.val + 1;
            let values = [];
            let amount = [];
            for (let i = 1; i <= val; i++) {
                let timeItem = Object.values(this.allHistory[this.getActive])[
                    Object.values(this.allHistory[this.getActive]).length - i
                ]?.["created_at"];
                let amountItem = Object.values(this.allHistory[this.getActive])[
                    Object.values(this.allHistory[this.getActive]).length - i
                ]?.amount;
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
                if (amountItem) {
                    amount.unshift(amountItem);
                } else {
                    amount.unshift(String(0));
                }
            }
            this.graphs[0].values = values;
            this.graphs[0].amount = amount;
            setTimeout(this.changeId, 1000);
        },
    },
    mounted() {
        document.title = "Статистика";
        if (this.allHistory[this.getActive]) {
            this.renderChart();
        }
    },
    beforeUpdate() {
        if (this.allHistory[this.getActive]) {
            this.renderChart();
        }
    },
};
</script>
<style lang="scss" scoped>
.statistic {
    @media (min-width: 1271px) {
        padding-left: 310px;
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
                    font-weight: 500;
                    font-size: 14px;
                    line-height: 18px;
                }
            }
            .wrap_hash,
            li {
                color: #000034;
                font-weight: 500;
                font-size: 18px;
                line-height: 26px;
                @media (max-width: 479.98px) {
                    font-size: 14px;
                    line-height: 16px;
                }
                span {
                    font-weight: 400;
                    font-size: 16px;
                    line-height: 23px;
                    //margin-top: auto
                    @media (max-width: 479.98px) {
                        font-size: 14px;
                        line-height: 16px;
                    }
                    @media (max-width: 320.98px) {
                        font-size: 14px;
                        line-height: 18px;
                    }
                }
            }
        }
        &__row {
            gap: 8px;
            @media (max-width: 991.98px) {
                gap: 4px;
            }
        }
        &__head {
            gap: 8px;
            .buttons {
                display: flex;
                align-items: center;
                gap: 8px;
                @media (max-width: 767.98px) {
                    gap: 1px;
                    position: absolute;
                    top: calc(100% + 40px);
                    left: 0;
                }
            }
            .button {
                white-space: nowrap;
                padding: 2px 12px;
                border-radius: 16px;
                min-height: 36px;
                color: #99acd3;
                font-weight: 400;
                font-size: 17px;
                line-height: 20px;
                background: transparent;
                transition: all 0.3s ease 0s;
                @media (max-width: 767.98px) {
                    border-radius: 12px;
                    padding: 2px 20px;
                    font-weight: 400;
                    font-size: 16px;
                    line-height: 18px;
                    min-height: 26px;
                }
                @media (max-width: 479.98px) {
                    font-size: 14px;
                    line-height: 18px;
                }
                &.active {
                    color: #181847;
                    background: #ffffff;
                }
            }
            .title {
                @media (max-width: 767.98px) {
                    margin-bottom: 8px;
                }
            }
            &-graph {
                align-items: center;
                grid-column-start: 1;
                grid-column-end: 3;
                position: relative;
                .title {
                    margin-bottom: 0;
                    &:after {
                        content: none;
                    }
                }
                @media (max-width: 767.98px) {
                    grid-column-end: 2;
                    margin-bottom: calc(26px + 48px);
                    &:after {
                        content: "";
                        height: 1px;
                        position: absolute;
                        bottom: -20px;
                        left: 0;
                        width: 100%;
                        background-color: #d7d8d9;
                    }
                }
                @media (min-width: 767.98px) {
                    margin-bottom: 12px;
                }
                @media (max-width: 479.98px) {
                    flex-wrap: wrap;
                }
            }
        }
        &_list {
            gap: 4px;
            li {
                display: inline-flex;
                align-items: center;
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
            &:not(.wrap__column) {
                min-height: 0;
                @media (min-width: 991.98px) {
                    align-items: center;
                }
            }
            &:not(.wrap__block-graph) {
                &:last-child {
                    @media (max-width: 998.98px) {
                        flex-direction: column;
                    }
                    @media (max-width: 767.98px) {
                        flex-direction: row;
                    }
                }
            }
            &-connect {
                width: 100%;
                height: 100%;
                padding: 0 0 4px 12px;
                .title {
                    margin-bottom: 12px;
                    @media (max-width: 767.98px) {
                        margin-bottom: 40px;
                    }
                }
            }
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
                min-height: 415px !important;
                padding: 24px 24px 20px 8px;
                @media (max-width: 991.98px) {
                    min-height: 370px !important;
                }
                @media (max-width: 767.98px) {
                    min-height: 310px !important;
                }
                @media (max-width: 479.98px) {
                    min-height: 216px !important;
                }
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
        gap: 24px;
        .no-info {
            padding: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .swiper {
            padding: 4px 4px 6px !important;
            background: rgba(255, 255, 255, 0.3);
        }
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

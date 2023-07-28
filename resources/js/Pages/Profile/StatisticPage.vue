<template>
    <Head :title="$t('statistic.title')" />
    <div class="statistic profile">
        <div class="statistic__wrapper">
            <div class="main-header-container">
                <main-title tag="h3" class="cabinet_title">
                    {{ $t("statistic.title") }}
                    <!--                <main-checkbox @is_checked="allStat">-->
                    <!--                    {{ $t("statistic.checkbox") }}</main-checkbox-->
                    <!--                >-->
                </main-title>
                <CurrentExchangeRate />
            </div>

            <no-info
                class="cabinet"
                :wait="waitHistory"
                :interval="80"
                :end="endHistory"
            ></no-info>
            <div
                class="cabinet"
                v-if="
                    endHistory &&
                    !waitHistory &&
                    allHistory[getActive]?.filter((a) => a.hash > 0).length !==
                        0
                "
            >
                <div class="cabinet__head">
                    <main-title tag="h4" class="headline">
                        {{ $t("statistic.chart.title") }}
                    </main-title>
                    <div class="cabinet__buttons">
                        <button
                            class="cabinet_button"
                            :key="button.title + i"
                            v-for="(button, i) in buttons"
                            :class="{ active: button.value === this.val }"
                            @click="changeGraph(button.value)"
                        >
                            {{ button.title }}
                        </button>
                    </div>
                </div>
                <div
                    class="cabinet__block cabinet__block-graph cabinet__block-light"
                >
                    <no-info-wait
                        class="no-bg"
                        :wait="id !== val"
                    ></no-info-wait>
                    <statistic-chart
                        v-if="id === val"
                        class="no-title"
                        :val="val"
                        :graphs="graphs"
                        :viewportWidth="viewportWidth"
                        :key="graphs[0].values[graphs[0].values.length - 1]"
                    />
                </div>
            </div>
            <div
                class="cabinet"
                v-if="
                    endHistory &&
                    !waitHistory &&
                    Object.values(this.allHash[this.getActive]).length === 0 &&
                    allHistory[getActive]?.filter((a) => a.hash > 0).length ===
                        0
                "
            >
                <!--                allHistory[getActive]?.filter((a) => a.hash > 0).length ===-->
                <!--                0-->
                <main-title tag="h4" class="headline">{{
                    $t("statistic.chart.no_workers_title")
                }}</main-title>
                <copy-block
                    v-for="(object, i) in copyObject"
                    :key="i"
                    :copyObject="object"
                ></copy-block>
            </div>
            <div class="cabinet">
                <main-title tag="h4" class="headline">
                    {{ $t("statistic.info_blocks.title") }}
                </main-title>
                <div class="statistic__row">
                    <div
                        class="cabinet__block cabinet__block-light hash__block"
                        v-if="!waitAccounts"
                    >
                        <main-title
                            class="title title-blue"
                            :href="route(`workers`)"
                            >{{ $t("statistic.info_blocks.workers.title") }}
                        </main-title>
                        <ul class="statistic__list">
                            <li class="active text text-md">
                                <span>
                                    {{
                                        $t(
                                            "statistic.info_blocks.workers.types[0]"
                                        )
                                    }}</span
                                >
                                {{ this.workers.active }}
                            </li>
                            <li class="unStable text text-md">
                                <span>
                                    {{
                                        $t(
                                            "statistic.info_blocks.workers.types[1]"
                                        )
                                    }}</span
                                >
                                {{ this.workers.unStable }}
                            </li>
                            <li class="inActive text text-md">
                                <span>{{
                                    $t("statistic.info_blocks.workers.types[2]")
                                }}</span>
                                {{ this.workers.inActive }}
                            </li>
                        </ul>
                        <ul class="statistic__list statistic__list-last">
                            <li class="text text-md">
                                {{ $t("statistic.info_blocks.hash.titles[0]") }}
                                <span class="statistic_info text-blue"
                                    ><b v-hash
                                        >{{
                                            Number(this.workers.hash).toFixed(2)
                                        }}
                                        TH/s</b
                                    ></span
                                >
                            </li>
                            <li class="text text-md">
                                {{ $t("statistic.info_blocks.hash.titles[1]") }}
                                <span class="statistic_info text-blue"
                                    ><b v-hash
                                        >{{
                                            Number(this.workers.hash24).toFixed(
                                                2
                                            )
                                        }}
                                        TH/s</b
                                    ></span
                                >
                            </li>
                        </ul>
                    </div>
                    <no-info
                        :wait="waitAccounts"
                        :interval="50"
                        :end="endAccounts"
                    ></no-info>
                    <div
                        class="statistic__info cabinet__block cabinet__block-light"
                    >
                        <main-title tag="h4" class="title title-blue">{{
                            this.$t("statistic.info_blocks.title_clear")
                        }}</main-title>
                        <p class="text text-md" v-if="!clearProfit">
                            {{ this.$t("statistic.info_blocks.text_clear") }}
                        </p>
                        <blue-button v-if="!clearProfit">
                            <Link
                                :href="route('settings')"
                                class="text text-md text-white"
                                ><b>
                                    {{
                                        this.$t(
                                            "statistic.info_blocks.button_clear"
                                        )
                                    }}</b
                                ></Link
                            >
                        </blue-button>
                        <btc-calculator
                            v-if="clearProfit"
                            :title="
                                this.$t('statistic.info_blocks.clear.titles[0]')
                            "
                            :BTC="todayEarn"
                            :clearProfit="clearProfitDay"
                        />
                        <btc-calculator
                            v-if="clearProfit"
                            :title="
                                this.$t('statistic.info_blocks.clear.titles[1]')
                            "
                            :BTC="clearBTCMounth"
                            :clearProfit="clearProfit"
                        />
                    </div>
                    <div
                        class="statistic__info cabinet__block cabinet__block-light"
                    >
                        <main-title tag="h4" class="title title-blue">{{
                            $t("statistic.info_blocks.title")
                        }}</main-title>
                        <btc-calculator
                            :title="
                                this.$t(
                                    'statistic.info_blocks.payment.titles[0]'
                                )
                            "
                            :BTC="this.yesterdayEarn"
                        />
                        <btc-calculator
                            :title="
                                this.$t(
                                    'statistic.info_blocks.payment.titles[1]'
                                )
                            "
                            :BTC="this.todayEarn"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import CopyBlock from "@/Components/technical/blocks/profile/CopyBlock.vue";
import { Link, Head, router } from "@inertiajs/vue3";
import StatisticChart from "@/Components/technical/charts/StatisticChart.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import { mapGetters } from "vuex";
import BlueButton from "@/Components/UI/BlueButton.vue";
import BtcCalculator from "@/Components/UI/profile/BTCCalculator.vue";
import MainCheckbox from "@/Components/UI/MainCheckbox.vue";
import NoInfoWait from "@/Components/technical/blocks/NoInfoWait.vue";
import NoInfo from "@/Components/technical/blocks/NoInfo.vue";
import CurrentExchangeRate from "@/Components/technical/blocks/CurrentExchangeRate.vue";


import { Profit } from "/resources/js/Scripts/profit.js";

export default {
    props: ["errors", "message", "user", "auth_user"],
    components: {
        StatisticChart,
        MainTitle,
        Head,
        Link,
        CopyBlock,
        BlueButton,
        BtcCalculator,
        MainCheckbox,
        NoInfoWait,
        NoInfo,
        CurrentExchangeRate
    },
    layout: profileLayoutView,
    data() {
        return {
            waitHistory: true,
            waitAccounts: true,
            viewportWidth: 0,
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
            clearProfit: null,
            graphs: [
                {
                    id: 1,
                    title: [
                        this.$t("chart.labels[0]"),
                        this.$t("chart.labels[1]"),
                    ],
                    values: [],
                    dates: [],
                    amount: [],
                    unit: [],
                },
            ],
            tables: {
                payment: {
                    rows: [],
                },
            },
            activeHistory: null,
            all: false,
        };
    },
    created: function () {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    computed: {
        endHistory() {
            return !!this.allHistory[this.getActive];
        },
        endAccounts() {
            return !!this.allAccounts[this.getActive];
        },
        clearProfitDay() {
            if (this.btcInfo) {
                if (this.allAccounts[this.getActive]) {
                    return Number(this.clearProfit) / 30;
                }
            }
            return 0;
        },
        clearBTCMounth() {
            if (this.btcInfo) {
                if (this.allAccounts[this.getActive]) {
                    return this.todayEarn * 30;
                }
            }
            return 0;
        },
        copyObject() {
            return [
                {
                    title: this.$t("connection.block.title"),
                    copyObject: [
                        { link: "btc.all-btc.com:4444", title: "Port" },
                        { link: "btc.all-btc.com:3333", title: "Port 1" },
                        { link: "btc.all-btc.com:2222", title: "Port 2" },
                    ],
                },
            ];
        },
        buttons() {
            return [
                // { title: "6 часов", value: 6 },
                { title: `24 ${this.$t("hours")}`, value: 24 },
                { title: `7 ${this.$t("days")}`, value: 168 },
            ];
        },
        workers() {
            if (Object.values(this.allAccounts).length > 0) {
                return {
                    hash: this.allAccounts[this.getActive].shares1m,
                    hash24: this.allAccounts[this.getActive].shares1d,
                    active: this.allAccounts[this.getActive].workersActive,
                    unStable: this.allAccounts[this.getActive].workersDead,
                    inActive: this.allAccounts[this.getActive].workersInActive,
                    all: this.allAccounts[this.getActive].workersAll,
                };
            }
            return null;
        },
        todayEarn() {
            if (this.btcInfo) {
                if (this.allAccounts[this.getActive]) {
                    let val = new Profit(
                        this.allAccounts[this.getActive].shares1d,
                        this.btcInfo.btc.diff,
                        this.btcInfo.btc.reward,
                        this.btcInfo.fpps
                    );
                    return val.amount();
                }
            }
            return 0;
        },
        yesterdayEarn() {
            if (this.allIncomeHistory[this.getActive]) {
                if (
                    Object.values(this.allIncomeHistory[this.getActive])
                        ?.length > 0
                ) {
                    return Number(
                        Object.values(
                            this.allIncomeHistory[this.getActive]
                        ).reverse()[0]["amount"]
                    );
                }
            }
            return 0;
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
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        changeGraph(val) {
            this.val = val;
        },
        changeId() {
            this.id = this.val;
        },
        router() {
            return router;
        },
        // allStat(bool) {
        //     if (this.allHistory[this.getActive]) {
        //         if (bool) {
        //             let allArrays = Object.values(this.allHistory);
        //             this.activeHistory = allArrays.reduce((a, b) => {
        //                 let arr, another;
        //                 if (a.length > b.length) {
        //                     arr = a;
        //                     another = b;
        //                 } else {
        //                     arr = b;
        //                     another = a;
        //                 }
        //                 return arr.map((el, i) => {
        //                     let hash = el.hash + another[i].hash || 0;
        //                     return {
        //                         hash: hash,
        //                         unit:
        //                             hash < 1000
        //                                 ? "T"
        //                                 : hash < 1000000
        //                                 ? "P"
        //                                 : "E",
        //                         amount: el.amount + another[i].amount || 0,
        //                     };
        //                 });
        //             });
        //             this.all = true;
        //         } else {
        //             this.setActive();
        //             this.all = false;
        //         }
        //         try {
        //             let id = this.id;
        //             this.changeGraph(1);
        //             this.changeId();
        //             this.renderChart();
        //             this.changeGraph(id);
        //         } catch (err) {
        //             console.error(err);
        //         }
        //     }
        // },
        setActive() {
            this.activeHistory = this.allHistory[this.getActive];
        },
        renderChart() {
            const interval = 60 * 60 * 1000;
            const currentTime = new Date().getTime();
            const historyValues = Object.values(this.activeHistory);

            this.graphs[0].dates = Array.from({ length: this.val }, (_, i) => {
                const date = new Date(
                    currentTime - (this.val - 1 - i) * interval
                );
                return date.getTime();
            });

            const [values, amount, unit] = historyValues
                .slice(-this.val)
                .reverse()
                .reduce(
                    (acc, el) => {
                        let hash = el.hash ?? 0;
                        if (el.unit === "P") hash *= 1000;
                        else if (el.unit === "E") hash *= 1000000;
                        acc[0].push(Number(hash));
                        el.amount ? acc[1].push(el.amount) : acc[1].push(0);
                        acc[2].push("T");

                        return acc;
                    },
                    [[], [], []]
                );

            let randomize = (min, max) => {
                return Math.random() * (max - min) + min;
            };

            while (values.length < this.val) {
                values.push(0);
                amount.push("0");
                unit.push("T");
            }

            Object.assign(this.graphs[0], {
                values: values.reverse(),
                amount: amount.map(String).reverse(),
                unit: unit.reverse(),
            });

            setTimeout(() => {
                this.end = true;
            }, 10);
            setTimeout(this.changeId, 700);
        },
    },
    mounted() {
        this.getUSD();
        document.title = this.$t("header.links.statistic");
        if (this.allHistory[this.getActive]) {
            this.setActive();
            this.renderChart();
            this.waitHistory = false;
        }
        if (localStorage.getItem("clearProfit")) {
            this.clearProfit = localStorage.getItem("clearProfit");
        }
        if (this.allAccounts[this.getActive]) this.waitAccounts = false;
    },
    beforeUpdate() {
        this.getUSD();
        if (this.allHistory[this.getActive]) {
            if (!this.all) {
                this.setActive();
            }
            this.renderChart();
            setTimeout(() => (this.waitHistory = false), 300);
        }
        if (this.allAccounts[this.getActive])
            setTimeout(() => (this.waitAccounts = false), 300);
    },
};
</script>
<style lang="scss" scoped>
.statistic {
    &__row {
        display: grid;
        gap: 16px;
        grid-template-columns: repeat(3, 1fr);
        @media (max-width: 1320.98px) {
            grid-template-rows: repeat(2, 1fr);
            grid-template-columns: repeat(2, 1fr);
        }
        @media (max-width: 479.98px) {
            grid-template-columns: 1fr;
            grid-template-rows: repeat(3, 1fr);
        }
        .cabinet__block {
            display: flex;
            flex-direction: column;
            gap: 8px;
            .no-info {
                margin-bottom: 0;
            }
        }
    }
    &__info {
        display: flex;
        flex-direction: column;
        gap: 16px;
        .blue-button {
            margin-top: auto;
            padding: 0 24px;
            .text {
                z-index: 1;
            }
        }
    }
    &__list {
        display: flex;
        flex-direction: column;
        gap: 4px;
        &-last {
            margin-top: 8px;
        }
        li {
            width: 100%;
            display: inline-flex;
            justify-content: space-between;
            span {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                &:before {
                    content: "";
                    width: 12px;
                    height: 12px;
                    display: flex;
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
            .statistic_info {
                &:before {
                    content: none;
                }
            }
        }
    }
    &__title {
        margin-bottom: 16px;
        @media (max-width: 479.98px) {
            margin-bottom: 24px;
        }
    }
    &__block {
        display: grid;
        width: 100%;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        @media (max-width: 998.98px) {
            grid-template-columns: auto 300px;
        }
        .wrap {
            &__block {
                justify-content: space-between;
                @media (max-width: 998.98px) {
                    justify-content: center;
                }
                @media (max-width: 767.98px) {
                    justify-content: space-between;
                }
            }
            &__head {
                width: auto;
            }
        }
        .no-info {
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
            font-size: 16px;
        }
    }
    .hash__block {
        @media (max-width: 479.98px) {
            grid-template-columns: 1fr;
        }
    }
    .main-header-container{
        display: flex;
        align-items: baseline;
    }
}
</style>

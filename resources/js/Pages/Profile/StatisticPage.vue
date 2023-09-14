<template>
    <div class="statistic">
        <div class="statistic__wrapper">
            <main-preloader
                class="cabinet"
                :wait="waitHistory"
                :interval="20"
                :end="endHistory"
            />
            <div
                class="cabinet"
                v-if="
                    endHistory &&
                    !waitHistory &&
                    hashrates.records?.filter((a) => a.hashrate > 0).length !==
                        0
                "
            >
                <div class="cabinet__head">
                    <main-title tag="h4" class="headline">
                        {{ $t("statistic.chart.title") }}
                    </main-title>
                    <main-tabs
                        @getValue="changeGraph"
                        :tabs="buttons"
                        :active="offset"
                    />
                </div>
                <div
                    class="cabinet__block cabinet__block-graph cabinet__block-light"
                >
                    <wait-preloader
                        class="no-bg"
                        :wait="hashrates.waitHashrate"
                    />
                    <statistic-chart
                        v-if="!hashrates.waitHashrate"
                        class="no-title"
                        :offset="offset"
                        :graph="hashrates.graph"
                        :viewportWidth="viewportWidth"
                    />
                </div>
            </div>
            <div class="cabinet">
                <div class="statistic-container">
                    <HashrateCards></HashrateCards>
                    <div class="statistic-card">
                        <p class="statistic-card-title"> {{$t("statistic.info_blocks.workers.types[0]")}}</p>
                        <p class="statistic-card-num color-green"> {{ this.workers.active }}</p>
                    </div>
                    <div class="statistic-card">
                        <p class="statistic-card-title"> {{$t("statistic.info_blocks.workers.types[2]")}}</p>
                        <p class="statistic-card-num color-red"> {{ this.workers.inActive }}</p>
                    </div>
                    </div>
                    <main-preloader
                        :wait="waitAccounts"
                        :interval="20"
                        :end="endAccounts"
                    />

                    <div
                        class="statistic__info cabinet__block cabinet__block-light"
                    >
                        <btc-calculator
                            :title="
                                $t('statistic.info_blocks.payment.titles[1]')
                            "
                            :BTC="todayEarn"
                        />
                        <btc-calculator
                            :title="
                                $t('statistic.info_blocks.payment.titles[0]')
                            "
                            :BTC="yesterdayEarn"
                        />

                    </div>
            </div>
        </div>
    </div>
</template>
<script>
import CopyBlock from "@/Components/technical/blocks/profile/CopyBlock.vue";
import { Head, router } from "@inertiajs/vue3";
import StatisticChart from "@/Components/technical/charts/StatisticChart.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import { mapGetters } from "vuex";
import BtcCalculator from "@/Components/UI/profile/BTCCalculator.vue";
import WaitPreloader from "@/modules/preloader/Components/WaitPreloader.vue";
import MainPreloader from "@/modules/preloader/Components/MainPreloader.vue";
// import CurrentExchangeRate from "@/Components/technical/blocks/CurrentExchangeRate.vue";
import MainTabs from "@/Components/UI/profile/MainTabs.vue";
import HashrateCards from '@/modules/hashrate/Components/HashrateCards.vue'
import { SubHashrateService } from "@/services/SubHashrateService";

export default {
    props: ["errors", "message", "user", "auth_user"],
    components: {
        StatisticChart,
        MainTitle,
        Head,
        CopyBlock,
        BtcCalculator,
        WaitPreloader,
        MainPreloader,
        // CurrentExchangeRate,
        MainTabs,
        HashrateCards,
    },
    data() {
        return {
            waitHistory: true,
            waitAccounts: true,
            waitAjax: true,
            viewportWidth: 0,
            profit: {},
            linkAddress: "btc.all-btc.com:4444",
            linkAddress1: "btc.all-btc.com:3333",
            linkAddress2: "btc.all-btc.com:2222",
            visualType: "table",
            interval: null,
            intervalRender: null,
            offset: 24,
            clearProfit: null,
            hashrates: {},
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
    watch: {
        async getActive() {
            await this.initHashrate();

            this.waitHistory = this.getActive === -1 ? true : false;
        },
        async offset() {
            await this.initHashrate();

            this.waitHistory = this.getActive === -1 ? true : false;
        },
    },
    computed: {
        endHistory() {
            return !!this.hashrates;
        },
        endAccounts() {
            return !!this.getAccount;
        },
        clearProfitDay() {
            if (this.btcInfo) {
                if (this.getAccount) {
                    return Number(this.clearProfit) / 30;
                }
            }
            return 0;
        },
        clearBTCMounth() {
            if (this.btcInfo) {
                if (this.getAccount) {
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
            return {
                hash: this.getAccount.hash_per_min ?? 0,
                hash24: this.getAccount.hash_per_day ?? 0,
                active: this.getAccount.workers_count_active ?? 0,
                unStable: this.getAccount.workers_count_unstable ?? 0,
                inActive: this.getAccount.workers_count_in_active ?? 0,
                all: this.getAccount.workersAll ?? 0,
            };
        },
        todayEarn() {
            let val = this.getAccount?.today_forecast || 0;
            return Number(val).toFixed(8);
        },
        yesterdayEarn() {
            let val = this.getAccount?.yesterday_amount || 0;
            return Number(val).toFixed(8);
        },
        ...mapGetters([
            "getTable",
            "getActive",
            "allAccounts",
            "getAccount",
            "allHistory",
            "allHash",
            "allIncomeHistory",
            "btcInfo",
        ]),
    },
    methods: {
        async initHashrate(needUpdate = false) {
            needUpdate ? (this.waitHistory = true) : (this.waitHistory = false);
            this.hashrates = new SubHashrateService(
                this.$t,
                [0, 1],
                this.offset
            );

            await this.hashrates.index();

            this.intervalRender = setInterval(() => {
                this.hashrates.index();
            }, 60000);
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        changeGraph(val) {
            this.offset = val;
        },
        router() {
            return router;
        },
    },
    async mounted() {
        await this.initHashrate(true);
        this.waitHistory = this.getActive === -1 ? true : false;
        if (localStorage.getItem("clearProfit")) {
            this.clearProfit = localStorage.getItem("clearProfit");
        }
        if (Object.keys(this.getAccount).length > 0) this.waitAccounts = false;
    },
    unmounted() {
        clearInterval(this.intervalRender);
    },
    beforeUpdate() {
        if (Object.keys(this.getAccount).length > 0) this.waitAccounts = false;
    },
};
</script>
<style lang="scss" scoped>
.statistic-container{
    width: 100%;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}
.statistic-card{
    border-radius: 24px;
    background: var(--light-secondary-wb, #FFF);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.05);
    padding: 16px 24px;
    min-width: 349px;
}
@media (max-width: 1860px) {
    .statistic-card{
         min-width: 120px;
    }
    .hashrate-card{
        min-width: 349px;
    }
}
.statistic-card-title{
    color: var(--light-gray-400, #98A2B3);
    font-family: NunitoSans;
    font-size: 14px;
    font-style: normal;
    font-weight: 600;
    line-height: 145%; /* 20.3px */
}
.color-green{
    color: var(--light-green-100, #1FB96C);
}
.color-red{
    color: var(--light-red-100, #F1404A);
}
.color-main{
    color: var(--light-gray-800, #1D2939);
}
.flex-row{
    display: flex;
    gap: 24px;
    align-items: center;
}
.color-gray{
    color: var(--light-gray-300, var(--gray-3100, #D0D5DD));
    font-family: Unbounded;
    font-size: 27px;
    font-style: normal;
    font-weight: 400;
    line-height: 147%; /* 39.69px */
}
.statistic-card-num{
    font-family: Unbounded;
    font-size: 41px;
    font-style: normal;
    font-weight: 400;
    line-height: 137%; /* 56.17px */
}
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
            grid-template-rows: repeat(2, 1fr);
        }
        .cabinet__block {
            display: flex;
            flex-direction: column;
            gap: 8px;
            .preloader {
                margin-bottom: 0;
            }
        }
    }
    &__info {
        display: flex;
        flex-direction: column;
        width: 50%;
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
        .preloader {
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
    .main-header-container {
        display: flex;
        align-items: baseline;
    }
}
</style>

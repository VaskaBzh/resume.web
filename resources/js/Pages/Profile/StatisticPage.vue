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
                    <no-info-wait
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
                    <div class="statistic-card flex-row hashrate-card">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64" fill="none">
                            <path d="M24.501 2V8" stroke="#53B1FD" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M39.5 2V8" stroke="#53B1FD" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M24.501 56V62" stroke="#53B1FD" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M39.5 56V62" stroke="#53B1FD" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M62 39.5L56 39.5" stroke="#53B1FD" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 24.5L2 24.5" stroke="#53B1FD" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 39.5L2 39.5" stroke="#53B1FD" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M62 24.5L56 24.5" stroke="#53B1FD" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M34.0826 21.5L27.8096 29.112C27.1373 29.9277 27.6192 31.1014 28.7154 31.3186L35.2866 32.6204C36.4553 32.852 36.9011 34.1513 36.0839 34.9446L28.3007 42.5" stroke="#53B1FD" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 32C8 20.6863 8 15.0294 11.5147 11.5147C15.0294 8 20.6863 8 32 8C43.3137 8 48.9706 8 52.4853 11.5147C56 15.0294 56 20.6863 56 32C56 43.3137 56 48.9706 52.4853 52.4853C48.9706 56 43.3137 56 32 56C20.6863 56 15.0294 56 11.5147 52.4853C8 48.9706 8 43.3137 8 32Z" stroke="#53B1FD" stroke-width="2.52" stroke-linejoin="round"/>
                        </svg>
                        <div>
                            <p class="statistic-card-title"> {{ $t("statistic.info_blocks.hash.titles[0]") }}</p>
                            <span class="statistic-card-num color-main"> {{ Number(this.workers.hash).toFixed(2) }}</span>
                            <span class="color-gray"> TH/s</span>
                        </div>
                    </div>
                    <div class="statistic-card flex-row">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64" fill="none">
                            <path d="M56 25.9995C55.8923 18.5608 55.3403 14.3435 52.5095 11.5142C48.9928 7.99951 43.3329 7.99951 32.013 7.99951C20.6932 7.99951 15.0333 7.99951 11.5166 11.5142C8 15.0289 8 20.6858 8 31.9995C8 43.3132 8 48.9701 11.5166 52.4848C14.7063 55.6728 19.6594 55.9691 29 55.9967" stroke="#98A2B3" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M24.5 2V8" stroke="#98A2B3" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M39.5 1.99976V7.99976" stroke="#98A2B3" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M24.5 56V62" stroke="#98A2B3" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 24.4998L2 24.4998" stroke="#98A2B3" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 39.4995L2 39.4995" stroke="#98A2B3" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M62 24.4998L56 24.4998" stroke="#98A2B3" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div>
                            <p class="statistic-card-title"> {{ $t("statistic.info_blocks.hash.titles[1]") }}</p>
                            <span class="statistic-card-num color-main"> {{Number(this.workers.hash24).toFixed(2)}}</span>
                            <span class="color-gray"> TH/s</span>
                        </div>
                    </div>
                    <div class="statistic-card">
                        <p class="statistic-card-title"> {{$t("statistic.info_blocks.workers.types[0]")}}</p>
                        <p class="statistic-card-num color-green"> {{ this.workers.active }}</p>
                    </div>
                    <div class="statistic-card">
                        <p class="statistic-card-title"> {{$t("statistic.info_blocks.workers.types[2]")}}</p>
                        <p class="statistic-card-num color-red"> {{ this.workers.inActive }}</p>
                    </div>
                    </div>
                    <no-info
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
            .no-info {
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
    .main-header-container {
        display: flex;
        align-items: baseline;
    }
}
</style>

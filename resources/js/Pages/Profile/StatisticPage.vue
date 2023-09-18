<template>
    <div class="statistic" :class="{ 'statistic-center':
            waitHistory ||
            hashrates.values?.filter((a) => a.hashrate > 0).length === 0
        }"
    >
        <main-preloader
            class="cabinet__preloader"
            :wait="waitHistory"
            :interval="20"
            :end="endHistory"
        />
        <div
            class="cabinet statistic__cabinet"
            v-if="
                endHistory &&
                !waitHistory &&
                hashrates.values?.filter((a) => a.hashrate > 0).length !==
                    0
            "
        >
            <div
                class="statistic_graph cabinet__block cabinet__block-graph cabinet__block-light"
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
            <main-hashrate-cards />
            <div class="cabinet__block cabinet__block-light cabinet__block-card statistic__card statistic__card-active">
                <p class="statistic__card_title">
                    {{ $t("statistic.info_blocks.workers.types[0]") }}
                </p>
                <p class="statistic__card_num">
                    {{ getAccount.workers_count_active }}
                </p>
            </div>
            <div class="cabinet__block cabinet__block-light cabinet__block-card statistic__card statistic__card-in-active">
                <p class="statistic__card_title">
                    {{ $t("statistic.info_blocks.workers.types[2]") }}
                </p>
                <p class="statistic__card_num">
                    {{ getAccount.workers_count_in_active }}
                </p>
            </div>
            <div
                class="statistic__info cabinet__block cabinet__block-light"
            >
                <btc-calculator
                    :title="$t('statistic.info_blocks.payment.titles[1]')"
                    :BTC="todayAmount"
                />
                <btc-calculator
                    :title="$t('statistic.info_blocks.payment.titles[0]')"
                    :BTC="yesterdayAmount"
                />
                <btc-calculator
                    :title="$t('statistic.info_blocks.payment.titles[0]')"
                    :BTC="monthAmount"
                />
            </div>
        </div>
    </div>
</template>
<script>
import CopyBlock from "@/Components/technical/blocks/profile/CopyBlock.vue";
import { Head, router } from "@inertiajs/vue3";
import StatisticChart from "@/Components/technical/charts/StatisticChart.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import { mapGetters } from "vuex";
import BtcCalculator from "@/modules/common/Components/Ui/BTCCalculator.vue";
import MainPreloader from "@/modules/preloader/Components/MainPreloader.vue";
// import CurrentExchangeRate from "@/Components/technical/blocks/CurrentExchangeRate.vue";
import MainTabs from "@/modules/common/Components/Ui/MainTabs.vue";
import MainHashrateCards from "@/modules/common/Components/UI/MainHashrateCards.vue";
import { SubHashrateService } from "@/services/SubHashrateService";
import NoInfoWait from "@/Components/technical/blocks/NoInfoWait.vue";

export default {
    props: ["errors", "message", "user", "auth_user"],
    components: {
        StatisticChart,
        MainTitle,
        Head,
        CopyBlock,
        BtcCalculator,
        MainPreloader,
        // CurrentExchangeRate,
        MainTabs,
        MainHashrateCards,
        NoInfoWait,
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

            this.waitHistory = this.getActive === -1;
        },
        async offset() {
            await this.initHashrate();

            this.waitHistory = this.getActive === -1;
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
        todayAmount() {
            let val = this.getAccount?.today_forecast || 0;
            return Number(val).toFixed(8);
        },
        yesterdayAmount() {
            let val = this.getAccount?.yesterday_amount || 0;
            return Number(val).toFixed(8);
        },
        monthAmount() {
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
        this.waitHistory = this.getActive === -1;
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
.statistic {
    width: 100%;
    height: 100%;
    position: relative;
    &__cabinet {
        display: grid;
        grid-template-rows: repeat(3, auto);
        grid-template-columns: repeat(4, 1fr);
    }
    &_graph {
        grid-column: 1 / 5;
        position: relative;
        padding: 24px 24px 48px 24px;
        display: flex;
        flex-direction: column;
        gap: 24px;
        width: 100%;
        height: fit-content;
    }
    &-center {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    &__card {
        display: flex;
        flex-direction: column;
        gap: 4px;
        &-active {
            .statistic__card_num {
                color: var(--light-green-100, #1FB96C);
            }
        }
        &-in-active {
            .statistic__card_num {
                color: var(--light-red-100, #F1404A);
            }
        }
        &_title {
            color: var(--light-gray-400, #98A2B3);
            font-family: NunitoSans, serif;
            font-size: 14px;
            font-weight: 600;
            line-height: 145%;
        }
        &_num {
            font-family: Unbounded, serif;
            font-size: 41px;
            font-weight: 400;
            line-height: 137%;
        }
    }
}
</style>

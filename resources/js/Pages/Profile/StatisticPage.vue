<template>
    <Head :title="$t('statistic.title')" />
    <div class="statistic profile">
        <div class="statistic__wrapper">
            <main-title tag="h2" class="statistic__title">
                {{ $t("statistic.title") }}
            </main-title>
            <div
                class="wrap"
                v-if="
                    this.allHistory[this.getActive]?.filter((a) => a.hash > 0)
                        .length !== 0
                "
            >
                <div class="wrap__head wrap__head-graph">
                    <main-title tag="h3">
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
                    <div class="propeller" v-if="id !== val"></div>
                    <statistic-chart
                        v-else
                        class="no-title"
                        :val="val"
                        :graphs="graphs"
                        :viewportWidth="viewportWidth"
                        :key="graphs[0].values[graphs[0].values.length - 1]"
                    />
                    <teleport to="body">
                        <main-popup
                            id="graph"
                            class="popup-graph"
                            @opened="active = true"
                            @closed="active = false"
                        >
                            <statistic-chart
                                :val="val"
                                :graphs="graphs"
                                :viewportWidth="viewportWidth"
                                :tooltip="true"
                                :key="
                                    graphs[0].values[
                                        graphs[0].values.length - 1
                                    ]
                                "
                            />
                        </main-popup>
                    </teleport>
                    <div
                        class="hover"
                        v-show="id === val && this.viewportWidth <= 479.98"
                        data-popup="#graph"
                        :class="{ active: active, hover_event: hover }"
                        @touchstart="hover = true"
                        @touchend="hover = false"
                    >
                        <div class="hover_wrap" ref="fullScreen">
                            <svg
                                width="32"
                                height="32"
                                viewBox="0 0 32 32"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M25 7V12C25 12.5523 25.4477 13 26 13C26.5523 13 27 12.5523 27 12V6C27 5.44772 26.5523 5 26 5H20C19.4477 5 19 5.44772 19 6C19 6.55228 19.4477 7 20 7H25Z"
                                    fill="#1C1C1C"
                                />
                                <path
                                    d="M26.7067 6.70748C26.8943 6.51995 27 6.26522 27 6C27 5.73478 26.8946 5.48043 26.7071 5.29289L26.6985 5.28436C26.5117 5.1024 26.2607 5 26 5C25.7348 5 25.4804 5.10536 25.2929 5.29289L18.2933 12.2925C18.1057 12.4801 18 12.7348 18 13C18 13.016 18.0004 13.032 18.0012 13.048C18.0131 13.2964 18.1171 13.5313 18.2929 13.7071C18.4804 13.8946 18.7348 14 19 14C19.2652 14 19.5196 13.8946 19.7071 13.7071L26.7067 6.70748Z"
                                    fill="#1C1C1C"
                                />
                                <path
                                    d="M7 25V20C7 19.4477 6.55228 19 6 19C5.44772 19 5 19.4477 5 20V26C5 26.5523 5.44772 27 6 27H12C12.5523 27 13 26.5523 13 26C13 25.4477 12.5523 25 12 25H7Z"
                                    fill="#1C1C1C"
                                />
                                <path
                                    d="M13.7067 19.7075C13.8943 19.5199 14 19.2652 14 19C14 18.7348 13.8946 18.4804 13.7071 18.2929L13.6985 18.2844C13.5117 18.1024 13.2607 18 13 18C12.7348 18 12.4804 18.1054 12.2929 18.2929L5.29327 25.2925C5.10573 25.4801 5 25.7348 5 26C5 26.016 5.00038 26.032 5.00115 26.048C5.0131 26.2964 5.1171 26.5313 5.29289 26.7071C5.48043 26.8946 5.73478 27 6 27C6.26522 27 6.51957 26.8946 6.70711 26.7071L13.7067 19.7075Z"
                                    fill="#1C1C1C"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrap" v-else>
                <div class="wrap__block-connect">
                    <main-title tag="h3">{{
                        $t("statistic.chart.no_workers_title")
                    }}</main-title>
                    <copy-block
                        v-for="(object, i) in this.copyObject"
                        :key="i"
                        :copyObject="object"
                    ></copy-block>
                </div>
            </div>
            <div class="wrap">
                <main-title tag="h3">
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
                        class="wrap__block hash__block"
                        v-if="Object.values(this.allAccounts).length > 0"
                    >
                        <div class="wrap__head wrap__column">
                            <div class="wrap__row">
                                <span class="wrap_title">
                                    {{
                                        $t(
                                            "statistic.info_blocks.hash.titles[0]"
                                        )
                                    }}
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
                                    {{
                                        $t(
                                            "statistic.info_blocks.hash.titles[1]"
                                        )
                                    }}
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
                                    >{{
                                        $t(
                                            "statistic.info_blocks.workers.title"
                                        )
                                    }}
                                </Link>
                            </main-title>
                            <li class="active">
                                {{ this.workers.active
                                }}<span>
                                    {{
                                        $t(
                                            "statistic.info_blocks.workers.types[0]"
                                        )
                                    }}</span
                                >
                            </li>
                            <li class="unStable">
                                {{ this.workers.unStable
                                }}<span>
                                    {{
                                        $t(
                                            "statistic.info_blocks.workers.types[1]"
                                        )
                                    }}</span
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
import CopyBlock from "@/Components/technical/blocks/profile/CopyBlock.vue";
import { Link, Head, router } from "@inertiajs/vue3";
import PaymentCard from "@/Components/technical/blocks/profile/PaymentCard.vue";
import StatisticChart from "@/Components/technical/charts/StatisticChart.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import { mapGetters } from "vuex";
import MainPopup from "@/Components/technical/MainPopup.vue";

export default {
    props: ["errors", "message", "user", "auth_user"],
    components: {
        StatisticChart,
        MainTitle,
        PaymentCard,
        Head,
        Link,
        CopyBlock,
        MainPopup,
    },
    layout: profileLayoutView,
    data() {
        return {
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
            active: false,
            hover: false,
        };
    },
    created: function () {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    computed: {
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
        renderChart() {
            const interval = 60 * 60 * 1000;
            const currentTime = new Date().getTime();
            const activeHistory = this.allHistory[this.getActive];
            const historyValues = Object.values(activeHistory);

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
                        acc[2].push(el.unit ?? "T");

                        return acc;
                    },
                    [[], [], []]
                );

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

            setTimeout(this.changeId, 700);
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
.hover {
    background: rgba(#4182ec, 0.4);
    border-radius: 21px;
    position: absolute;
    left: 0;
    top: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    transition: all 0.3s ease 0s;
    opacity: 0;
    box-shadow: 0 0 6px 4px rgba(#4182ec, 0.4);
    -webkit-backdrop-filter: blur(10px);
    backdrop-filter: blur(2px);
    &.hover_event {
        opacity: 1;
    }
    &.active {
        opacity: 1;
        .hover {
            &_wrap {
                background: #4182ec;
                svg {
                    path {
                        &:nth-child(1) {
                            transform: translate(1px, -1px);
                        }
                        &:nth-child(2) {
                            transform: translate(1px, -1px);
                        }
                        &:nth-child(3) {
                            transform: translate(-1px, 1px);
                        }
                        &:nth-child(4) {
                            transform: translate(-1px, 1px);
                        }
                    }
                }
            }
        }
    }
    &_wrap {
        background: rgba(#000034, 0.6);
        border-radius: 14px;
        padding: 6px;
        transition: all 0.3s ease 0s;

        svg {
            min-width: 30px;
            height: 30px;

            path {
                fill: #fff;
                transition: all 0.3s ease 0s;
            }

            @media (min-width: 479.98px) {
                display: none;
            }
        }
    }
}
.statistic {
    .wrap {
        overflow: visible;
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
                    font-size: 16px;
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
                    font-size: 16px;
                    line-height: 16px;
                }
                span {
                    font-weight: 400;
                    font-size: 16px;
                    line-height: 23px;
                    //margin-top: auto
                    @media (max-width: 479.98px) {
                        font-size: 16px;
                        line-height: 16px;
                    }
                    @media (max-width: 320.98px) {
                        font-size: 16px;
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
                    width: 100%;
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
                width: fit-content;
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
                    font-size: 16px;
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
            overflow: visible;
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
                    position: relative;
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
                    padding: 15px !important;
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
                padding: 24px;
                &:active {
                    @media (max-width: 479.98px) {
                        .hover {
                            opacity: 1;
                        }
                    }
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
            font-size: 16px;
        }
    }
    .hash__block {
        @media (max-width: 479.98px) {
            grid-template-columns: 1fr;
        }
    }
}
</style>

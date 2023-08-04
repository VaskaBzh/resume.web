<template>
    <div class="income" ref="page">
        <div class="main-header-container">
            <main-title class="profile cabinet_title" tag="h3">
                {{ $t("income.title") }}
            </main-title>
            <CurrentExchangeRate />
        </div>

        <div class="income__column">
            <div class="income__row">
                <div class="cabinet__block cabinet__block-light">
                    <span class="text"
                        >{{ $t("income.income_info.titles[0]") }}:</span
                    >
                    <span class="main__number"
                        >{{ this.payed }}
                        BTC
                    </span>
                </div>
                <div class="cabinet__block cabinet__block-light">
                    <span class="text"
                        >{{ $t("income.income_info.titles[1]") }}:
                    </span>
                    <span class="main__number">
                        {{ this.unPayment }}
                        BTC
                    </span>
                </div>
                <div class="cabinet__block cabinet__block-light">
                    <span class="text"
                        >{{ $t("income.income_info.titles[2]") }}:
                    </span>
                    <span class="main__number">
                        {{ this.yesterdayProfit }}
                    </span>
                </div>
            </div>
        </div>
        <div class="cabinet__head">
            <main-title tag="h4" class="headline history-transaction">
                {{ $t("income.table.title") }}
            </main-title>
        </div>
        <!-- <blue-button></blue-button> -->

        <!-- <div class="income__filter">-->
        <!--                <div-->
        <!--                    class="income__filter_block"-->
        <!--                    v-show="this.walletOptions[1]"-->
        <!--                >-->
        <!--                    <div class="income__filter_label">Кошелек</div>-->
        <!--                    <main-select-->
        <!--                        @getCoin="this.filter"-->
        <!--                        class="income__filter_select"-->
        <!--                        :options="this.walletOptions"-->
        <!--                    ></main-select>-->
        <!--                </div>-->
        <!--                <div class="income__filter_block income__filter_block-adapt">-->
        <!--                    <div class="income__filter_label">Статус операции</div>-->
        <!--                    <main-select-->
        <!--                        @getCoin="this.filter"-->
        <!--                        class="income__filter_select"-->
        <!--                        :options="this.operationOptions"-->
        <!--                    ></main-select>-->
        <!--                </div>-->
        <!--            <div class="income__filter_block">-->
        <!--                <div class="income__filter_label">{{ $t("date.label") }}</div>-->
        <!--                <main-date-->
        <!--                    v-model="date"-->
        <!--                    :placeholder="$t('date.placeholder')"-->
        <!--                ></main-date>-->
        <!--            </div>-->
        <!--        </div> -->
        <article class="income-table-block">
            <div class="tabs-block-container">
                <button
                    class="btn-table"
                    :class="{ 'tabs-active': !filter }"
                    @click="changeActiveTab('All')"
                >
                    {{ $t("income.table.tabs[0]") }}
                </button>
                <button
                    class="btn-table"
                    :class="{ 'tabs-active': filter }"
                    @click="changeActiveTab('Payots')"
                >
                    {{ $t("income.table.tabs[1]") }}
                </button>
            </div>
            <!--            <div class="filter-block-container">-->
            <!--                &lt;!&ndash; <div class="income__filter"> &ndash;&gt;-->
            <!--                <div class="filter_block">-->
            <!--                    <main-date-->
            <!--                        v-model="date"-->
            <!--                        :placeholder="$t('date.placeholder')"-->
            <!--                        @calendarChange="filterTable"-->
            <!--                    ></main-date>-->
            <!--                </div>-->
            <!--                &lt;!&ndash; </div> &ndash;&gt;-->
            <!--            </div>-->
        </article>

        <main-slider
            :wait="incomes.waitTable"
            :empty="incomes.rows"
            :table="incomes.table"
            :rowsNum="per_page"
            :errors="errors"
            :meta="incomes.meta"
            :key="getActive"
            @changePerPage="changePerPage"
            @changePage="page = $event"
        ></main-slider>
    </div>
</template>
<script>
import MainSlider from "@/Components/technical/MainSlider.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import MainDate from "@/Components/UI/MainDate.vue";
import CurrentExchangeRate from "@/Components/technical/blocks/CurrentExchangeRate.vue";
import { mapGetters } from "vuex";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";

import { IncomeService } from "@/services/IncomeService";

export default {
    components: {
        MainSlider,
        MainTitle,
        MainDate,
        CurrentExchangeRate,
    },
    props: ["errors", "message", "user"],
    data() {
        return {
            error: "",
            viewportWidth: 0,
            operationOptions: [
                { title: "Любой", value: "all" },
                { title: "Отклонено", value: "rejected" },
                { title: "В ожидании", value: "pending" },
                { title: "Выполнено", value: "completed" },
            ],
            date: {},
            per_page: 25,
            page: 1,
            filter: "",
            incomes: {},
        };
    },
    layout: profileLayoutView,
    computed: {
        ...mapGetters([
            "allIncomeHistory",
            "getActive",
            "getAccount",
            "getIncome",
            "getWallet",
        ]),
        unPayment() {
            let sum = 0;
            if (Object.values(this.getAccount).length > 0) {
                sum = this.getAccount.pending_amount;
            }
            return Number(sum).toFixed(8);
        },
        payed() {
            let sum = 0;
            if (Object.values(this.getAccount).length > 0) {
                sum = this.getAccount.total_payout;
            }
            return Number(sum).toFixed(8);
        },
        yesterdayProfit() {
            let sum = 0;
            if (Object.values(this.getAccount).length > 0) {
                sum = this.getAccount.yesterday_amount;
            }
            return Number(sum).toFixed(8);
        },
    },
    watch: {
        page() {
            this.initIncomes();
        },
        filter() {
            this.initIncomes();
        },
        per_page() {
            this.initIncomes();
        },
        getActive() {
            this.initIncomes();
        },
    },
    methods: {
        async initIncomes() {
            this.incomes = new IncomeService(this.$t, [0, 1, 2, 3, 4, 5]);

            await this.incomes.setTable(this.filter, this.page, this.per_page);
        },
        // filterDate() {
        //     if (this.date && Object.values(this.date).length !== 0) {
        //         if (
        //             Object.values(this.date)[0] &&
        //             Object.values(this.date)[1]
        //         ) {
        //             this.incomeInfo.rows.length = 0;
        //             Object.values(
        //                 this.allIncomeHistory[this.getActive]
        //             ).forEach((row) => {
        //                 if (
        //                     new Date(row.created_at) >=
        //                         new Date(Object.values(this.date)[0]) &&
        //                     new Date(row.created_at) <=
        //                         new Date(Object.values(this.date)[1])
        //                 ) {
        //                     this.setRows(row);
        //                 }
        //             });
        //         }
        //     }
        // },
        // filter(data) {
        //     this.incomeInfo.rows.length = 0;
        //     if (data !== "all") {
        //         Object.values(this.allIncomeHistory[this.getActive]).forEach(
        //             (row) => {
        //                 if (row["status"] === data) {
        //                     this.setRows(row);
        //                 }
        //                 if (row["wallet"] === data) {
        //                     this.setRows(row);
        //                 }
        //             }
        //         );
        //     } else {
        //         this.getIncomeInfo();
        //     }
        // },
        filterTable(e) {
            console.log(e);
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        changePerPage($event) {
            this.per_page = $event;
            this.page = 1;
        },
        changeActiveTab(tabName) {
            switch (tabName) {
                case "Payots": {
                    this.filter = true;
                    this.page = 1;
                    break;
                }
                case "All": {
                    this.filter = "";
                    this.page = 1;
                    break;
                }
            }
        },
    },
    async created() {
        // await this.$store.dispatch("getAccounts");
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    mounted() {
        document.title = this.$t("header.links.income");
        this.$refs.page.style.opacity = 1;
        this.initIncomes();
    },
};
</script>
<style lang="scss" scoped>
.income {
    width: 100%;
    transition: all 0.3s linear 0.2s;
    opacity: 0;
    @media (max-width: 1271.98px) {
        transition: all 0.3s ease 0s;
    }

    &__column {
        display: flex;
        flex-direction: column;
        gap: 24px;
        margin-bottom: 40px;
    }
    &__row {
        display: flex;
        align-items: center;
        gap: 16px;
        .cabinet__block {
            display: flex;
            flex-direction: column;
            gap: 4px;
            width: 100%;
        }
        @media (max-width: 767.98px) {
            flex-wrap: wrap;
        }
    }

    // .income__button
    &__button {
        min-width: 228px;
        min-height: 51px;
        padding: 0;

        a {
            width: 100%;
            height: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        @media (min-width: 767.98px) {
            font-size: 20px;
            line-height: 28px;
        }
        @media (max-width: 767.98px) {
            min-height: 48px;
            min-width: 150px;
        }
        @media (max-width: 479.98px) {
            min-height: 28px;
            min-width: 90px;
        }

        &::before {
            @media (max-width: 767.98px) {
                border-radius: 21px;
            }
        }
    }

    // .income__filter
    &__filter {
        display: flex;
        width: 100%;
        align-items: flex-end;
        margin-bottom: 40px;
        gap: 16px;
        justify-content: flex-start;
        @media (max-width: 767.98px) {
            margin: 0 0 20px;
            justify-content: space-between;
            position: relative;
            gap: 17px;
        }
        @media (max-width: 479.98px) {
            align-items: flex-start;
        }
        // .income__filter_block
        &_block {
            display: flex;
            flex-direction: column;
            max-width: 320px;
            width: 100%;
            @media (max-width: 767.98px) {
                max-width: 100%;
                margin-right: 0;
            }

            &-adapt {
                @media (max-width: 991.98px) {
                    display: none;
                }
            }
        }

        // .income__filter_label
        &_label {
            margin-bottom: 8px;
            font-weight: 400;
            font-size: 16px;
            line-height: 23px;
            color: rgba(0, 0, 0, 0.62);
        }

        // .income__filter_select
        &_select {
            height: 48px;
            @media (max-width: 767.98px) {
                max-width: 100% !important;
            }
        }
    }
    .wrap {
        height: fit-content;
        &__row {
            height: fit-content;
            @media (max-width: 767.98px) {
                flex-direction: column;
            }
        }
        &__block {
            gap: 6px;
            @media (max-width: 991.98px) {
                padding: 16px;
            }

            .main__number {
                font-size: 24px;
                line-height: 34px;
                @media (max-width: 767.98px) {
                    font-size: 20px;
                    line-height: 30px;
                }
            }
            .text {
                font-weight: 500;
                font-size: 18px;
                line-height: 26px;
                @media (max-width: 767.98px) {
                    font-size: 16px;
                    line-height: 24px;
                }
            }
        }
    }
    .btn-table {
        // padding: 12px 49.8px;
        padding: 12px;
        // width: 32%;
        border-radius: 8px;
        color: rgba(129, 140, 153, 1);
        font-size: 18px;
    }
    .tabs-active {
        color: rgba(121, 163, 232, 1);
        background: rgba(250, 250, 250, 1);
        box-shadow: 0px 4px 10px 0px rgba(85, 85, 85, 0.1);
    }
    .filter_block {
        width: 100%;
        box-shadow: 0px 4px 10px 0px rgba(85, 85, 85, 0.1);
        border-radius: 8px;
    }
    .income-table-block {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 24px 0 8px;
    }
    .filter-block-container {
        width: 32%;
        border: none;
    }

    @media (max-width: 991px) {
        .filter-block-container {
            width: 45%;
        }
    }
    .tabs-block-container {
        width: 28%;
        display: flex;
        // justify-content: space-between;
        gap: 10px;
        align-items: center;
    }
    .main-header-container {
        display: flex;
        align-items: baseline;
    }
    @media (max-width: 760px) {
        .main-header-container {
            flex-direction: column;
            margin-bottom: 24px;
        }
        .income-table-block {
            flex-direction: column-reverse;
            align-items: flex-start;
            gap: 16px;
            margin: 24px 0;
        }
        .filter-block-container {
            width: 100%;
        }
    }
}
</style>

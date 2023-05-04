<template>
    <div class="income" ref="page">
        <div class="income__container">
            <main-title
                v-if="this.viewportWidth > 767.98"
                tag="h2"
                titleName="История платежей"
            >
                <!--                <blue-button class="income__button">-->
                <!--                    <Link :href="route('wallets')"> Кошельки </Link>-->
                <!--                </blue-button>-->
            </main-title>

            <main-title v-else tag="h2" titleName="Платежи">
                <!--                <blue-button class="income__button">-->
                <!--                    <Link :href="route('wallets')"> Кошельки</Link>-->
                <!--                </blue-button>-->
            </main-title>
            <div class="wallets__wrap">
                <div class="wallets__row wallets__row-balance">
                    <h3 class="wallets__title">Платежи:</h3>
                </div>
                <div class="wallets__row">
                    <div class="wallets__block">
                        <div class="wallets__column">
                            <span class="wallets__subtitle">Оплачено:</span>
                            <span class="wallets__value"
                                ><span> 0.00000000 </span>
                                BTC
                            </span>
                        </div>
                    </div>
                    <div class="wallets__block">
                        <div class="wallets__column">
                            <span class="wallets__subtitle">
                                Неоплаченно:
                            </span>
                            <span class="wallets__value">
                                <span>
                                    {{ this.unPayment }}
                                </span>
                                BTC
                            </span>
                        </div>
                    </div>
                    <div class="wallets__block">
                        <div class="wallets__column">
                            <span class="wallets__subtitle">
                                Вчерашний доход:
                            </span>
                            <span class="wallets__value">
                                <span>
                                    {{ this.yesterdayProfit }}
                                </span>
                                BTC
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="income__filter">
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
                <div class="income__filter_block">
                    <div class="income__filter_label">Дата</div>
                    <main-date
                        v-model="date"
                        placeholder="За все время"
                    ></main-date>
                </div>
            </div>
            <main-slider
                class="wrap-no-overflow"
                :wait="this.allIncomeHistory"
                :table="this.incomeInfo"
                type="Платежи"
            ></main-slider>
        </div>
    </div>
</template>
<script>
import MainSlider from "@/components/account/MainSlider.vue";
import MainSelect from "@/Components/UI/MainSelect.vue";
import MainTitle from "@/components/UI/MainTitle.vue";
import BlueButton from "@/components/UI/BlueButton.vue";
import MainDate from "@/components/UI/MainDate.vue";
import { Link, router } from "@inertiajs/vue3";
import { mapGetters } from "vuex";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import { ref } from "vue";

export default {
    components: {
        MainSlider,
        MainSelect,
        MainTitle,
        BlueButton,
        MainDate,
        Link,
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
            incomeInfo: {
                titles: [
                    "Дата начисления",
                    "Дата выплаты",
                    "Средний Хешрейт",
                    "Сумма начислений",
                    "Кошелек",
                    "Процент вывода",
                    "Статус",
                ],
                shortTitles: [
                    "Дата начисления",
                    "Дата выплаты",
                    "Средний Хешрейт",
                    "Сумма начислений",
                    "Кошелек",
                    "Процент вывода",
                    "Статус",
                ],
                rows: [],
            },
        };
    },
    layout: profileLayoutView,
    computed: {
        ...mapGetters([
            "allIncomeHistory",
            "getActive",
            "getIncome",
            "getWallet",
        ]),
        walletOptions() {
            let arr = [{ title: "Любой", value: "all" }];
            if (this.getWallet && this.getWallet[this.getActive]) {
                this.getWallet[this.getActive].forEach((el) => {
                    let walletModel = {
                        value: el.wallet,
                        title: el.wallet,
                    };
                    if (el.name !== "") {
                        walletModel.title = el.name;
                    }
                    arr.push(walletModel);
                });
            }
            return arr;
        },
        unPayment() {
            let sum = 0;
            if (this.getIncome[this.getActive]) {
                sum = this.getIncome[this.getActive].unPayments;
            }
            return Number(sum).toFixed(8);
        },
        result() {
            let sum = 0;
            if (this.getIncome[this.getActive]) {
                sum =
                    this.getIncome[this.getActive].unPayments *
                    (Number(this.amount.replace("%", "")) / 100);
            }
            return Number(sum).toFixed(8) + " BTC";
        },
        yesterdayProfit() {
            let sum = 0;
            if (
                this.allIncomeHistory &&

                Object.values(this.allIncomeHistory).length > 0
            ) {
                Object.values(this.allIncomeHistory).forEach((acc) => {
                    if (acc[1]) {
                        sum += Number(acc[1]["amount"]);
                    }
                });
            }
            return sum.toFixed(8);
        },
    },
    methods: {
        getIncomeInfo() {
            if (
                this.allIncomeHistory &&
                this.allIncomeHistory[this.getActive]
            ) {
                this.incomeInfo.rows.length = 0;
                Object.values(this.allIncomeHistory[this.getActive]).forEach(
                    (row) => {
                        this.setRows(row);
                    }
                );
            }
        },
        setRows(row) {
            let date = row["created_at"].split("");
            let time = row["created_at"].substr(11).split("");
            time.length = 8;
            date.length = 10;
            let percent = 0;
            let datePay = "...";
            let wallet = "...";
            if (row["percent"]) {
                percent = row["percent"];
            }
            if (row["status"] === "completed") {
                datePay = date.join("").split("-").reverse().join(".");
            }
            if (row["wallet"]) {
                wallet = row["wallet"];
            }
            let rowModel = {
                date: date.join("").split("-").reverse().join("."),
                payDate: datePay,
                time: time.join(""),
                earn: row["amount"],
                payment: row["payment"],
                percent: percent,
                diff: row["diff"],
                hash: `${row["hash"]} ${row["unit"]}H/s`,
                status: row["status"],
                txid: row["txid"],
                message: row["message"],
                wallet: wallet,
            };
            this.incomeInfo.rows.push(rowModel);
        },
        router() {
            return router;
        },
        filterDate() {
            if (this.date && Object.values(this.date).length !== 0) {
                if (
                    Object.values(this.date)[0] &&
                    Object.values(this.date)[1]
                ) {
                    this.incomeInfo.rows.length = 0;
                    Object.values(
                        this.allIncomeHistory[this.getActive]
                    ).forEach((row) => {
                        if (
                            new Date(row.created_at) >=
                                new Date(Object.values(this.date)[0]) &&
                            new Date(row.created_at) <=
                                new Date(Object.values(this.date)[1])
                        ) {
                            this.setRows(row);
                        }
                    });
                }
            } else {
                this.getIncomeInfo();
            }
        },
        filter(data) {
            this.incomeInfo.rows.length = 0;
            if (data !== "all") {
                Object.values(this.allIncomeHistory[this.getActive]).forEach(
                    (row) => {
                        if (row["status"] === data) {
                            this.setRows(row);
                        }
                        if (row["wallet"] === data) {
                            this.setRows(row);
                        }
                    }
                );
            } else {
                this.getIncomeInfo();
            }
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
    },
    async created() {
        // await this.$store.dispatch("getAccounts");
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
        this.getIncomeInfo();
    },
    updated() {
        this.getIncomeInfo();
        this.filterDate();
    },
    mounted() {
        document.title = "История";
        this.$refs.page.style.opacity = 1;
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

    .title {
        margin: 0 0 24px;
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: space-between;
        @media (min-width: 1271.98px) {
            padding-left: 70px;
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
}
</style>

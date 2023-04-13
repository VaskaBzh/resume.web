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
                    <div class="wallets__buttons">
                        <!--                        <blue-button class="wallets__button">-->
                        <!--                            <svg-->
                        <!--                                xmlns="http://www.w3.org/2000/svg"-->
                        <!--                                width="24"-->
                        <!--                                height="24"-->
                        <!--                                viewBox="0 0 24 24"-->
                        <!--                                fill="none"-->
                        <!--                            >-->
                        <!--                                <path-->
                        <!--                                    d="M16.5156 9.34814H21.0156V4.84814"-->
                        <!--                                    stroke-width="2"-->
                        <!--                                    stroke-linecap="round"-->
                        <!--                                    stroke-linejoin="round"-->
                        <!--                                />-->

                        <!--                                <path-->
                        <!--                                    d="M6.16602 6.16637C6.9321 5.40029 7.84157 4.7926 8.84251 4.37799C9.84344 3.96339 10.9162 3.75 11.9996 3.75C13.0831 3.75 14.1558 3.96339 15.1568 4.37799C16.1577 4.7926 17.0672 5.40029 17.8333 6.16637L21.0153 9.34835"-->
                        <!--                                    stroke-width="2"-->
                        <!--                                    stroke-linecap="round"-->
                        <!--                                    stroke-linejoin="round"-->
                        <!--                                />-->
                        <!--                                <path-->
                        <!--                                    d="M7.48438 14.6519H2.98438V19.1519"-->
                        <!--                                    stroke-width="2"-->
                        <!--                                    stroke-linecap="round"-->
                        <!--                                    stroke-linejoin="round"-->
                        <!--                                />-->
                        <!--                                <path-->
                        <!--                                    d="M17.8336 17.8338C17.0675 18.5999 16.1581 19.2076 15.1571 19.6222C14.1562 20.0368 13.0834 20.2502 12 20.2502C10.9166 20.2502 9.84378 20.0368 8.84285 19.6222C7.84191 19.2076 6.93244 18.5999 6.16635 17.8338L2.98438 14.6519"-->
                        <!--                                    stroke-width="2"-->
                        <!--                                    stroke-linecap="round"-->
                        <!--                                    stroke-linejoin="round"-->
                        <!--                                />-->
                        <!--                            </svg>-->
                        <!--                            Обменять-->
                        <!--                        </blue-button>-->
                        <blue-button
                            class="wallets__button"
                            data-popup="#payment"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                            >
                                <path
                                    d="M8.0625 7.68457L12 3.74707L15.9375 7.68457"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M12 14.25V3.75"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M21 12.75V19.5C21 19.6989 20.921 19.8897 20.7803 20.0303C20.6397 20.171 20.4489 20.25 20.25 20.25H3.75C3.55109 20.25 3.36032 20.171 3.21967 20.0303C3.07902 19.8897 3 19.6989 3 19.5V12.75"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            Вывести
                        </blue-button>
                        <!--                        <blue-button class="wallets__button">-->
                        <!--                            <svg-->
                        <!--                                xmlns="http://www.w3.org/2000/svg"-->
                        <!--                                width="24"-->
                        <!--                                height="24"-->
                        <!--                                viewBox="0 0 24 24"-->
                        <!--                                fill="none"-->
                        <!--                            >-->
                        <!--                                <path-->
                        <!--                                    d="M8.0625 10.3125L12 14.25L15.9375 10.3125"-->
                        <!--                                    stroke-width="2"-->
                        <!--                                    stroke-linecap="round"-->
                        <!--                                    stroke-linejoin="round"-->
                        <!--                                />-->
                        <!--                                <path-->
                        <!--                                    d="M12 3.74707V14.2471"-->
                        <!--                                    stroke-width="2"-->
                        <!--                                    stroke-linecap="round"-->
                        <!--                                    stroke-linejoin="round"-->
                        <!--                                />-->
                        <!--                                <path-->
                        <!--                                    d="M21 12.75V19.5C21 19.6989 20.921 19.8897 20.7803 20.0303C20.6397 20.171 20.4489 20.25 20.25 20.25H3.75C3.55109 20.25 3.36032 20.171 3.21967 20.0303C3.07902 19.8897 3 19.6989 3 19.5V12.75"-->
                        <!--                                    stroke-width="2"-->
                        <!--                                    stroke-linecap="round"-->
                        <!--                                    stroke-linejoin="round"-->
                        <!--                                />-->
                        <!--                            </svg>-->
                        <!--                            Пополнить-->
                        <!--                        </blue-button>-->
                    </div>
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
                <div class="income__filter_block">
                    <div class="income__filter_label">Кошелек</div>
                    <main-select
                        @add-filter="this.filter"
                        class="income__filter_select"
                        :options="this.walletOptions"
                    ></main-select>
                </div>
                <div class="income__filter_block income__filter_block-adapt">
                    <div class="income__filter_label">Продукт</div>
                    <main-select
                        @add-filter="this.filter"
                        class="income__filter_select"
                        :options="this.walletOptions"
                    ></main-select>
                </div>
                <div class="income__filter_block income__filter_block-adapt">
                    <div class="income__filter_label">Тип операции</div>
                    <main-select
                        @add-filter="this.filter"
                        class="income__filter_select"
                        :options="this.operationOptions"
                    ></main-select>
                </div>
                <div class="income__filter_block">
                    <div class="income__filter_label">Дата</div>
                    <main-date placeholder="За все время"></main-date>
                </div>
            </div>
            <main-slider
                class="wrap-no-overflow"
                :wait="this.allIncomeHistory"
                :table="this.incomeInfo"
            ></main-slider>
        </div>
    </div>
    <popup-view id="payment">
        <div class="form_wrapper-message">
            <div class="form_message" v-if="this.error">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="25"
                    height="24"
                    viewBox="0 0 25 24"
                    fill="none"
                >
                    <path
                        d="M12.5 16C12.3022 16 12.1088 16.0587 11.9444 16.1686C11.7799 16.2784 11.6518 16.4346 11.5761 16.6173C11.5004 16.8001 11.4806 17.0011 11.5192 17.1951C11.5578 17.3891 11.653 17.5673 11.7929 17.7071C11.9327 17.847 12.1109 17.9422 12.3049 17.9808C12.4989 18.0194 12.6999 17.9996 12.8827 17.9239C13.0654 17.8482 13.2216 17.72 13.3314 17.5556C13.4413 17.3911 13.5 17.1978 13.5 17C13.5 16.7348 13.3946 16.4805 13.2071 16.2929C13.0195 16.1054 12.7652 16 12.5 16ZM23.17 17.47L15.12 3.47003C14.8598 3.00354 14.4798 2.61498 14.0192 2.3445C13.5586 2.07401 13.0341 1.9314 12.5 1.9314C11.9658 1.9314 11.4414 2.07401 10.9808 2.3445C10.5202 2.61498 10.1402 3.00354 9.87997 3.47003L1.87997 17.47C1.61076 17.924 1.46611 18.441 1.46061 18.9688C1.45511 19.4966 1.58897 20.0166 1.84865 20.4761C2.10834 20.9356 2.48467 21.3185 2.93965 21.5861C3.39463 21.8536 3.91215 21.9964 4.43997 22H20.56C21.092 22.0053 21.6159 21.8689 22.0779 21.6049C22.5399 21.341 22.9233 20.9589 23.1889 20.4978C23.4546 20.0368 23.5928 19.5134 23.5895 18.9814C23.5861 18.4493 23.4414 17.9277 23.17 17.47ZM21.44 19.47C21.3523 19.626 21.2244 19.7556 21.0697 19.8453C20.9149 19.935 20.7389 19.9815 20.56 19.98H4.43997C4.26108 19.9815 4.08507 19.935 3.93029 19.8453C3.7755 19.7556 3.64762 19.626 3.55997 19.47C3.4722 19.318 3.42599 19.1456 3.42599 18.97C3.42599 18.7945 3.4722 18.622 3.55997 18.47L11.56 4.47003C11.6439 4.30623 11.7714 4.16876 11.9284 4.07277C12.0854 3.97678 12.2659 3.92599 12.45 3.92599C12.634 3.92599 12.8145 3.97678 12.9715 4.07277C13.1286 4.16876 13.2561 4.30623 13.34 4.47003L21.39 18.47C21.4892 18.6199 21.5462 18.7937 21.555 18.9732C21.5638 19.1527 21.5241 19.3312 21.44 19.49V19.47ZM12.5 8.00003C12.2348 8.00003 11.9804 8.10538 11.7929 8.29292C11.6053 8.48046 11.5 8.73481 11.5 9.00003V13C11.5 13.2652 11.6053 13.5196 11.7929 13.7071C11.9804 13.8947 12.2348 14 12.5 14C12.7652 14 13.0195 13.8947 13.2071 13.7071C13.3946 13.5196 13.5 13.2652 13.5 13V9.00003C13.5 8.73481 13.3946 8.48046 13.2071 8.29292C13.0195 8.10538 12.7652 8.00003 12.5 8.00003Z"
                    />
                </svg>
                {{ this.error }}
            </div>
        </div>
        <form
            @submit.prevent="this.getPayment"
            class="form form-popup popup__form"
        >
            <main-title tag="h3" title-name="Введите имя кошелька" />
            <input
                v-model="this.form.wallet"
                required
                autofocus
                type="text"
                class="input popup__input"
                placeholder="Ваш кошелек"
            />
            <div class="form_row">
                <div class="form_column">
                    <input
                        v-model="this.amount"
                        required
                        autofocus
                        type="text"
                        class="input popup__input input-amount"
                        placeholder="0"
                        max="100"
                        ref="amount"
                    />
                </div>
                <div class="form_column">
                    {{ this.result }}
                </div>
            </div>
            <blue-button>
                <button type="submit" class="all-link">+ Добавить</button>
            </blue-button>
        </form>
    </popup-view>
</template>
<script>
import MainSlider from "@/components/account/MainSlider.vue";
import MainSelect from "@/components/UI/MainSelect.vue";
import MainTitle from "@/components/UI/MainTitle.vue";
import BlueButton from "@/components/UI/BlueButton.vue";
import MainDate from "@/components/UI/MainDate.vue";
import { Link, router } from "@inertiajs/vue3";
import { mapGetters } from "vuex";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import axios from "axios";
import PopupView from "@/Components/technical/PopupView.vue";

export default {
    components: {
        PopupView,
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
            amount: "",
            form: {
                wallet: "",
            },
            date: {},
            viewportWidth: 0,
            walletOptions: [
                { title: "Любой", value: 1 },
                { title: "Bitcoin", value: 2 },
                { title: "Bitcoin Cash", value: 3 },
                { title: "Litecoin", value: 4 },
            ],
            operationOptions: [
                { title: "Любой", value: 1 },
                { title: "Пополнение", value: 2 },
                { title: "Доход", value: 3 },
                { title: "Вывод", value: 4 },
            ],
        };
    },
    layout: profileLayoutView,
    computed: {
        ...mapGetters(["allIncomeHistory", "getActive", "getIncome"]),
        unPayment() {
            let sum = 0;
            if (this.getIncome[this.getActive]) {
                sum = this.getIncome[this.getActive].unPayments;
            }
            return sum.toFixed(8);
        },
        result() {
            let sum = 0;
            if (this.getIncome[this.getActive]) {
                sum =
                    this.getIncome[this.getActive].unPayments *
                    (Number(this.amount.replace("%", "")) / 100);
            }
            return sum.toFixed(8) + " BTC";
        },
        yesterdayProfit() {
            let sum = 0;
            if (
                this.allIncomeHistory &&
                Object.values(this.allIncomeHistory).length > 0
            ) {
                Object.values(this.allIncomeHistory).forEach((acc) => {
                    if (acc[1]) {
                        sum += Number(acc[1][3]);
                    }
                });
            }
            return sum.toFixed(8);
        },
        incomeInfo() {
            let obj = {
                titles: [
                    "Дата",
                    "Тип начисления",
                    "Процент вывода",
                    "Средний Хешрейт",
                    "Сумма",
                    "Сложность",
                    "Статус",
                ],
                shortTitles: ["Дата", "Тип", "%", "Хешрейт", "Сумма", "Статус"],
                rows: [],
            };
            if (
                this.allIncomeHistory &&
                this.allIncomeHistory[this.getActive]
            ) {
                Object.values(this.allIncomeHistory[this.getActive]).forEach(
                    (row) => {
                        let date = row["created_at"].split("");
                        let time = row["created_at"].substr(11).split("");
                        time.length = 8;
                        date.length = 10;
                        console.log(row["percent"]);
                        let rowModel = {
                            date: date.join("").split("-").reverse().join("."),
                            time: time.join(""),
                            earn: row["amount"],
                            payment: row["payment"],
                            percent: row["percent"],
                            diff: row["diff"],
                            hash: `${row["hash"]} ${row["unit"]}H/s`,
                            status: row["status"],
                            txid: row["txid"],
                            message: row["message"],
                            wallet: row["wallet"],
                        };
                        obj.rows.push(rowModel);
                    }
                );
            }
            return obj;
        },
    },
    watch: {
        amount(newAm, oldAm) {
            let reg = new RegExp(/[^\d]/g);
            let per = new RegExp("%");
            newAm = newAm.replace(per, "");
            oldAm = oldAm.replace(per, "");
            Number(newAm) > 100
                ? (this.amount = "100%")
                : reg.test(newAm)
                ? (this.amount = oldAm + "%")
                : newAm === ""
                ? (this.amount = newAm)
                : (this.amount = newAm + "%");
        },
    },
    methods: {
        getPayment() {
            if (this.getIncome) {
                if (this.result > 0.005) {
                    let db = {
                        group_id: this.allAccounts[this.getActive].id,
                        amount: this.result,
                        percent: this.amount,
                        address: this.form.wallet,
                    };
                    axios.post("/send_payment", db);
                } else {
                    this.error = "Минимальная сумма вывода 0.005";
                }
            }
        },
        router() {
            return router;
        },
        filter() {
            console.log(123);
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
    },
    async created() {
        // await this.$store.dispatch("getAccounts");
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
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
        padding-left:  70px;
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
            max-width: 100%;
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

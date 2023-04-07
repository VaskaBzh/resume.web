<template>
    <Head title="Выплаты" />
    <div class="hidden">{{ this.getTable }}</div>
    <div class="payment">
        <div class="payment__wrapper">
            <main-title tag="h2" titleName="Выплаты"></main-title>
            <div class="payment__filter">
                <div class="payment__filter_block payment__filter_block-sum">
                    <div class="main__label">Сумма всех выплат</div>
                    <div class="main-number main__number-lg">
                        <span>{{ this.allPayment }}</span> BTC
                    </div>
                </div>
                <div class="payment__filter_wrapper">
                    <div class="payment__filter_block">
                        <div class="payment__filter_label">Дата</div>
                        <main-date placeholder="За все время"></main-date>
                    </div>
                    <blue-button
                        data-popup="#payment"
                        class="payment__button small"
                        >Вывести</blue-button
                    >
                </div>
            </div>
            <main-slider
                :table="this.paymentInfo"
                :wait="this.allHistoryForDays"
            ></main-slider>
            <popup-view id="payment">
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
                    <blue-button>
                        <button type="submit" class="all-link">
                            + Добавить
                        </button>
                    </blue-button>
                </form>
            </popup-view>
        </div>
    </div>
</template>
<script>
import { Head } from "@inertiajs/vue3";
import MainTitle from "@/Components/UI/MainTitle.vue";
import MainDate from "@/Components/UI/MainDate.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import MainSlider from "@/Components/account/MainSlider.vue";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import { mapGetters } from "vuex";
import PopupView from "@/Components/technical/PopupView.vue";
import axios from "axios";

export default {
    props: ["user"],
    components: {
        PopupView,
        MainSlider,
        BlueButton,
        MainTitle,
        MainDate,
        Head,
    },
    layout: profileLayoutView,
    data() {
        return {
            date: {},
            paymentInfo: {
                titles: ["Дата", "Сумма", "Статус"],
                rows: [],
            },
            amount: "",
            form: {
                wallet: "",
            },
        };
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
    computed: {
        ...mapGetters([
            "FullEarn",
            "getActive",
            "getTable",
            "allHistoryForDays",
        ]),
        allPayment() {
            let val = 0;
            if (this.paymentInfo.rows.length > 0) {
                this.paymentInfo.rows.forEach((el) => {
                    val += Number(el.earn);
                });
            }
            return val.toFixed(8);
        },
    },
    methods: {
        iconRemover() {
            this.$refs.icon.style.display = "none";
        },
        getPayment() {
            if (this.FullEarn) {
                if (this.FullEarn[this.getActive] > 0) {
                    let date = new Date();
                    if (this.paymentInfo.rows.length > 0) {
                        if (
                            this.paymentInfo.rows[
                                this.paymentInfo.rows.length - 1
                            ].date
                                .split("-")
                                .reverse()
                                .join(".") !== date.toLocaleDateString("eu-US")
                        ) {
                            let db = {
                                user_id: this.user.id,
                                amount: (
                                    (Number(this.earn - this.allPayment) /
                                        100) *
                                    Number(this.amount.replace("%", ""))
                                ).toFixed(8),
                                // percent: this.amount,
                                wallet_address: this.form.wallet,
                            };
                            // this.$store.dispatch("postInfo", db);
                        }
                    } else {
                        let db = {
                            user_id: this.user.id,
                            // this.FullEarn[this.getActive] - this.allPayment
                            amount:
                                this.FullEarn[this.getActive] -
                                this.allPayment *
                                    100 *
                                    Number(
                                        this.amount.replace("%", "")
                                    ).toFixed(8),
                            percent: this.amount,
                            address: this.form.wallet,
                        };
                        axios.post("/send_payment", db);
                        // this.$store.dispatch("postInfo", db);
                    }
                }
            }
        },
        pushRows() {
            this.paymentInfo.rows = [];
            this.getTable.forEach((row) => {
                let paymentModel = {
                    date: row.date,
                    link: row.address,
                    earn: row.amount,
                    // percent: row.percent,
                    info: row.info,
                    infoClass: row.infoClass,
                };

                this.paymentInfo.rows.push(paymentModel);
            });
        },
    },
    updated() {
        if (this.getTable.length > 0) {
            this.pushRows();
        }
    },
    mounted() {
        document.title = "Выплаты";
        if (this.getTable.length > 0) {
            this.pushRows();
        }
        // axios
        //     .get("/see_balance")
        //     .then((res) => {
        //         console.log(res);
        //     })
        //     .catch((err) => {
        //         console.log(err);
        //     });
        // let instance = axios.create({
        //     baseURL: "https://pool.api.btc.com/v1",
        //     headers: {
        //         "Content-Type": "application/json; charset=utf-8",
        //         Authorization: "sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N",
        //     },
        // });
        // instance
        //     .get("/worker/stats")
        //     .then((res) => {
        //         console.log(res);
        //     })
        //     .catch((err) => {
        //         console.log(err);
        //     });
    },
};
</script>
<style lang="scss" scoped>
.payment {
    width: 100%;

    @media (min-width: 1271px) {
        padding-left: 330px;
    }

    .title {
        margin-bottom: 16px;
        @media (max-width: 479.98px) {
            margin-bottom: 24px;
        }
    }

    &__wrapper {
        width: 100%;
    }

    &__filter {
        display: flex;
        width: 100%;
        justify-content: space-between;
        margin-bottom: 24px;
        align-items: flex-end;
        @media (max-width: 767.98px) {
            display: grid;
            grid-template-rows: 1fr 1fr;
            grid-template-columns: 1fr 1fr;
            gap: 20px 17px;
            margin-bottom: 20px;
        }

        &_wrapper {
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
            gap: 16px;
            @media (max-width: 767.98px) {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                grid-column-start: 1;
                grid-column-end: 3;
            }
        }

        &_block {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            max-width: 270px;
            width: 100%;
            gap: 8px;

            &-sum {
                height: 100%;
                gap: 0;
                @media (min-width: 768.98px) {
                    min-height: 79px;
                }

                @media (max-width: 767.98px) {
                    background: #ffffff;
                    border: 0.5px solid rgba(0, 0, 0, 0.08);
                    border-radius: 8px;
                    width: 100%;
                    max-width: 100%;
                    padding: 4px 10px;
                    grid-column-start: 1;
                    grid-column-end: 3;
                    flex-direction: row;
                    align-items: center;
                    justify-content: space-between;
                    min-height: 48px;
                }
                @media (max-width: 479.98px) {
                    flex-direction: column;
                    align-items: flex-start;
                    min-height: 0;
                }

                .payment__filter_label {
                    @media (max-width: 991.98px) {
                        padding-right: 5px;
                    }
                }
            }

            @media (max-width: 767.98px) {
                max-width: 100%;
                margin: 0;
            }
        }
    }

    &__button {
        min-width: 141px;
        @media (max-width: 767.98px) {
            min-width: 100%;
        }
    }
}
</style>

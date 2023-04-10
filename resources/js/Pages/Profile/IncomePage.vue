<template>
    <div class="income">
        <div class="income__container">
            <main-title
                v-if="this.viewportWidth > 767.98"
                tag="h2"
                titleName="История доходов"
            >
                <blue-button class="income__button">
                    <Link :href="route('wallets')"> Кошельки </Link>
                </blue-button>
            </main-title>

            <main-title v-else tag="h2" titleName="Доходы">
                <blue-button class="income__button">
                    <Link :href="route('wallets')"> Кошельки</Link>
                </blue-button>
            </main-title>

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
</template>
<script>
import MainSlider from "@/components/account/MainSlider.vue";
import MainSelect from "@/components/UI/MainSelect.vue";
import MainTitle from "@/components/UI/MainTitle.vue";
import BlueButton from "@/components/UI/BlueButton.vue";
import MainDate from "@/components/UI/MainDate.vue";
import { Link, router } from "@inertiajs/vue3";
import { mapGetters } from "vuex";

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
    computed: {
        ...mapGetters(["allIncomeHistory", "getActive"]),
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
                shortTitles: [
                    "Дата",
                    "Тип",
                    "%",
                    "Хешрейт",
                    "Сумма",
                    "Сообщение",
                    "Статус",
                ],
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
    methods: {
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
    },
};
</script>
<style lang="scss" scoped>
.income {
    .title {
        margin: 49px 0 24px;
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: space-between;
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

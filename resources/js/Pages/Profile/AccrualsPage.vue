<template>
    <Head title="Начисления" />
    <div class="hidden" v-if="this.allHistoryForDays[this.getActive]">
        {{ this.allHistoryForDays }}
    </div>
    <div class="accruals">
        <div class="accruals__wrapper">
            <main-title tag="h2" titleName="Начисления"></main-title>
            <div class="accruals__filter">
                <div class="accruals__filter_block">
                    <div class="main__label">Сумма всех начислений</div>
                    <div
                        class="main-number main__number-lg"
                        v-if="this.FullEarn[this.getActive]"
                    >
                        <span>{{ this.FullEarn[this.getActive] }}</span> BTC
                    </div>
                    <div class="main-number main__number-lg" v-else>
                        <span>0.00000000</span> BTC
                    </div>
                </div>

                <!--                <div class="accruals__filter_block accruals__filter_block-type">-->
                <!--                    <div class="accruals__filter_label">Тип начислений</div>-->
                <!--                    <main-select-->
                <!--                        class="accruals__select"-->
                <!--                        :options="types"-->
                <!--                    ></main-select>-->
                <!--                </div>-->
                <div class="accruals__filter_block">
                    <div class="accruals__filter_label">Дата</div>
                    <main-date placeholder="За все время"></main-date>
                </div>
                <blue-button class="accruals__button small"
                    >Выгрузить</blue-button
                >
            </div>
            <main-slider
                :key="this.allHistoryForDays[this.getActive]"
                :table="this.accrualsInfo"
                :wait="this.allHistoryForDays"
            ></main-slider>
        </div>
    </div>
</template>
<script>
import { Head } from "@inertiajs/vue3";
import MainSlider from "@/Components/account/MainSlider.vue";
import MainDate from "@/Components/UI/MainDate.vue";
// import MainSelect from "@/Components/UI/MainSelect.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import { mapGetters } from "vuex";

export default {
    components: {
        BlueButton,
        MainTitle,
        // MainSelect,
        MainSlider,
        MainDate,
        Head,
    },
    layout: profileLayoutView,
    data() {
        return {
            history: {},
            date: {},
            // types: [
            //     { title: "Любой", value: 1 },
            //     { title: "FPPS+ начисление", value: 2 },
            // ],
            accrualsInfo: {
                titles: [
                    "Дата",
                    "Тип наисления",
                    "Ср. хешрейт",
                    "Доходы",
                    "Сложность",
                ],
                shortTitles: ["Дата", "Тип", "Ср. хешрейт", "Доходы"],
                rows: [],
            },
        };
    },
    computed: {
        ...mapGetters(["getActive", "allHistoryForDays", "FullEarn"]),
    },
    methods: {
        iconRemover() {
            this.$refs.icon.style.display = "none";
        },
        async getEarn() {
            this.accrualsInfo.rows = [];
            if (this.allHistoryForDays[this.getActive]) {
                this.allHistoryForDays[this.getActive].forEach((el, i) => {
                    let date = new Date(el[0] * 1000);
                    let accModel = {
                        date: `${date.getFullYear()}.${
                            String(date.getMonth()).length < 2
                                ? "0" + date.getMonth()
                                : date.getMonth()
                        }.${
                            String(date.getDay()).length < 2
                                ? "0" + date.getDay()
                                : date.getDay()
                        }`,
                        time: el[0],
                        mode: `FPPS+ Начисление`,
                        hash: Number(el[1]).toFixed(2),
                        unit: el[2],
                        earn: el[3],
                        diff: (el[3] / 1000000000000).toFixed(2),
                    };
                    if (!isNaN(el[3]) && Number(el[3]) !== 0) {
                        this.accrualsInfo.rows.push(accModel);
                    }
                });
            }
        },
    },
    // async created() {
    //     // await this.$store.dispatch("getAccounts");
    //     if (localStorage.active) {
    //         this.activeIndex = JSON.parse(localStorage.active);
    //     }
    //
    //     this.getEarn();
    // },
    async created() {
        await this.getEarn();
    },
    mounted() {
        document.title = "Начисления";
    },
    async updated() {
        await this.getEarn();
    },
};
</script>
<style lang="scss" scoped>
.accruals {
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

    &__select {
        height: 48px;
        @media (max-width: 767.98px) {
            max-width: 100%;
        }
        @media (max-width: 479.98px) {
            height: 34px;
        }

        .select_title {
            font-weight: 500;
            font-size: 18px;
            line-height: 26px;
            color: #000034;
        }
    }

    &__wrapper {
        width: 100%;
    }

    &__filter {
        display: flex;
        width: 100%;
        align-items: flex-end;
        margin-bottom: 24px;
        @media (max-width: 991.98px) {
            display: grid;
            grid-template-rows: 1fr auto;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 17px;
        }
        @media (max-width: 767.98px) {
            grid-template-rows: 1fr auto auto;
            grid-template-columns: 1fr 1fr;
            gap: 17px;
            margin-bottom: 20px;
        }

        &_block {
            display: flex;
            flex-direction: column;
            max-width: 270px;
            width: 100%;
            margin-right: 16px;
            gap: 8px;
            @media (max-width: 991.98px) {
                max-width: 100% !important;
                margin: 0;
                gap: 6px;
            }

            &:first-child {
                margin-right: auto;
                width: auto;
                min-height: 79px;
                justify-content: space-between;
                gap: 0;
                @media (max-width: 991.98px) {
                    background: #ffffff;
                    border: 0.5px solid rgba(0, 0, 0, 0.08);
                    border-radius: 8px;
                    width: 100%;
                    max-width: 100%;
                    padding: 4px 10px;
                    grid-column-start: 1;
                    grid-column-end: 4;
                    flex-direction: row;
                    align-items: center;
                    justify-content: space-between;
                    min-height: 48px;
                }
                @media (max-width: 767.98px) {
                    grid-column-end: 3;
                }
                @media (max-width: 479.98px) {
                    flex-direction: column;
                    align-items: flex-start;
                    min-height: 0;
                }

                .accruals__filter_label {
                    margin-bottom: auto;
                    @media (max-width: 991.98px) {
                        padding-right: 5px;
                        margin-bottom: 0;
                    }
                }
            }

            &-type {
                max-width: 220px;
            }
        }
    }

    &__button {
        min-width: 141px;
        @media (max-width: 991.98px) {
            min-width: 100%;
        }
        @media (max-width: 767.98px) {
            grid-column-start: 1;
            grid-column-end: 3;
        }
    }
}
</style>

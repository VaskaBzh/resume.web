<template>
    <div ref="page" class="income">
        <main-title class="title-income">
            {{ $t("income.title") }}
        </main-title>
        <article class="income-cards-article">
            <div
                class="income-cards-container onboarding_block"
                :class="{
                    'onboarding_block-target':
                        instructionService.isVisible &&
                        instructionService.step === 1,
                }"
            >
                <AccrualsCard />
                <YesterdayIncomeCard />
                <instruction-step
                    :step_active="1"
                    :steps_count="instructionService.steps_count"
                    :step="instructionService.step"
                    :is-visible="instructionService.isVisible"
                    text="texts.income[0]"
                    title="titles.income[0]"
                    class-name="onboarding__card-top"
                    @next="instructionService.nextStep()"
                    @prev="instructionService.prevStep()"
                    @close="instructionService.nextStep(6)"
                />
            </div>
            <div
                class="month-card-container onboarding_block"
                :class="{
                    'onboarding_block-target':
                        instructionService.isVisible &&
                        instructionService.step === 2,
                }"
            >
                <MonthIncome
                    :wait="incomes.waitGraphChange"
                    :graph="incomes.incomeBarGraph"
                />
                <instruction-step
                    :step_active="2"
                    :steps_count="instructionService.steps_count"
                    :step="instructionService.step"
                    :is-visible="instructionService.isVisible"
                    text="texts.income[1]"
                    title="titles.income[1]"
                    class-name="onboarding__card-right"
                    @next="instructionService.nextStep()"
                    @prev="instructionService.prevStep()"
                    @close="instructionService.nextStep(6)"
                />
            </div>
        </article>

        <article class="income-table-block">
            <div class="tabs-block-container">
                <button
                    class="btn-table"
                    :class="{ 'tabs-active': filter }"
                    @click="changeActiveTab('Payots')"
                >
                    {{ $t("income.table.tabs[1]") }}
                </button>
                <button
                    class="btn-table"
                    :class="{ 'tabs-active': !filter }"
                    @click="changeActiveTab('All')"
                >
                    {{ $t("income.table.tabs[0]") }}
                </button>
            </div>
        </article>

        <!--        incomes.incomeBarGraph-->
        <main-slider
            class="income__slider onboarding_block"
            :class="{
                'onboarding_block-target':
                    instructionService.isVisible &&
                    instructionService.step === 3,
            }"
            :wait="incomes.waitTable"
            :empty="incomes.emptyTable"
            rows-num="1000"
            :have-nav="false"
        >
            <template #instruction>
                <instruction-step
                    :step_active="3"
                    :steps_count="instructionService.steps_count"
                    :step="instructionService.step"
                    :is-visible="instructionService.isVisible"
                    text="texts.income[2]"
                    title="titles.income[2]"
                    class-name="onboarding__card-bottom"
                    @next="instructionService.nextStep()"
                    @prev="instructionService.prevStep()"
                    @close="instructionService.nextStep(6)"
                />
            </template>
            <main-table :table="incomes.table"></main-table>
        </main-slider>
    </div>
    <instruction-button
        hint="incomes"
        @openInstruction="instructionService.setStep().setVisible()"
    />
</template>
<script>
import MainSlider from "@/modules/slider/Components/MainSlider.vue";
import AccrualsCard from "@/modules/income/Components/AccrualsCard.vue";
import YesterdayIncomeCard from "@/modules/income/Components/YesterdayIncomeCard.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MonthIncome from "@/modules/income/Components/MonthIncome.vue";
import MainTable from "@/Components/tables/MainTable.vue";
import InstructionStep from "@/modules/instruction/Components/InstructionStep.vue";

import { IncomeService } from "@/services/IncomeService";
import { InstructionService } from "@/modules/instruction/services/InstructionService";
import { mapGetters } from "vuex";
import InstructionButton from "../../modules/instruction/Components/UI/InstructionButton.vue";

export default {
    components: {
        InstructionButton,
        MainSlider,
        AccrualsCard,
        YesterdayIncomeCard,
        MonthIncome,
        MainTable,
        MainTitle,
        InstructionStep,
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
            per_page: 1000,
            page: 1,
            filter: true,
            incomes: new IncomeService(
                this.$t,
                [0, 1, 2, 3, 4, 5, 8],
                this.$route
            ),
            instructionService: new InstructionService(),
        };
    },
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
        async getActive(newActiveIndex) {
            if (newActiveIndex !== -1) {
                this.incomes.setActive(newActiveIndex);
                await this.initIncomes();
                await this.incomes.barGraphIndex();
            }
        },
        "$i18n.locale"() {
            this.incomes.graphService.setTranslate(this.$t);
            this.initIncomes();
            document.title = this.$t("header.links.income");
        },
    },
    async created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    async mounted() {
        this.instructionService.setStepsCount(3);

        document.title = this.$t("header.links.income");
        this.$refs.page.style.opacity = 1;
        if (this.$t) {
            this.incomes.graphService.setTranslate(this.$t);
        }
        if (this.getActive !== -1) {
            this.incomes.setActive(this.getActive);
            await this.initIncomes();
            await this.incomes.barGraphIndex();
        }
    },
    methods: {
        async initIncomes() {
            await this.incomes.setTable(this.filter, this.page, this.per_page);
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
};
</script>
<style lang="scss" scoped>
.title-income {
    display: none;
}

.income-cards-container {
    display: flex;
    flex-direction: column;
    gap: 12px;
    width: 100%;
}

.income-cards-article {
    width: 100%;
    display: flex;
    gap: 12px;
}

@media (max-width: 1100px) {
    .income-cards-article {
        flex-direction: column;
        gap: 12px;
    }
}

@media (max-width: 500px) {
    .title-income {
        display: inline-block;
        padding: 0 0 16px 16px;
        color: var(--text-primary);
        font-family: Unbounded !important;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: 32px; /* 160% */
    }
    .income-cards-container,
    .income-cards-article {
        gap: 8px;
    }
}

.month-card-container {
    width: 100%;
}

.income {
    width: 100%;
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    transition: all 0.3s linear 0.2s;
    opacity: 0;
    @media (max-width: 1271.98px) {
        transition: all 0.3s ease 0s;
    }

    &__slider {
        height: fit-content;
        flex: 1 1 auto;
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
        color: var(--buttons-tabs-text-default);
        font-size: 18px;
    }

    .tabs-active {
        color: var(--buttons-tabs-text-focus, #2e90fa);
        background: var(--buttons-tabs-fill-border-focus);
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

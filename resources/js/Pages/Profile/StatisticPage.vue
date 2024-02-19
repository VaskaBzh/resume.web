<template>
    <div
        class="statistic"
        :class="{
            'statistic-center':
                lineChartService.waitGraph || !getAccount.workers_count,
        }"
    >
        <main-preloader
            class="cabinet__preloader cabinet__preloader-bg"
            :wait="lineChartService.waitGraph"
            :interval="20"
            :end="!!lineChartService"
        />
        <div
            v-if="!lineChartService.waitGraph && getAccount.workers_count"
            v-scroll="'opacity transition--fast'"
            class="cabinet statistic__cabinet"
        >
            <main-title class="title-statistic"
                >{{ $t("statistic.title") }}
            </main-title>
<!--            <statistic-line-graph-->
<!--                class="statistic_graph"-->
<!--                :wait-graph-change="lineChartService.waitGraphChange"-->
<!--                :offset="lineChartService.offset"-->
<!--                :graph="lineChartService.graph"-->
<!--                :buttons="graphOffsetTabs"-->
<!--                :instruction-config="instructionService"-->
<!--                @getValue="lineChartService.graphDataService.setOffset($event)"-->
<!--            />-->
            <div
                class="statistic__cards onboarding_block"
                :class="{
                    'onboarding_block-target':
                        instructionService.isVisible &&
                        instructionService.step === 2,
                }"
            >
                <cabinet-card
                    class="statistic__card-first"
                    :title="$t('statistic.info_blocks.hash.titles[0]')"
                    :value="getAccount.hash_per_min ?? 0"
                    :unit="`${getAccount.hash_per_min_unit ?? 'T'}H/s`"
                >
                    <template #svg>
                        <minute-hashrate-icon />
                    </template>
                </cabinet-card>
                <cabinet-card
                    class="statistic__card-second"
                    :title="$t('statistic.info_blocks.hash.titles[1]')"
                    :value="getAccount.hash_per_day ?? 0"
                    :unit="`${getAccount.hash_per_day_unit ?? 'T'}H/s`"
                >
                    <template #svg>
                        <day-hashrate-icon />
                    </template>
                </cabinet-card>
                <cabinet-card
                    class="card-active statistic__card-third"
                    :title="$t('statistic.info_blocks.workers.types[0]')"
                    :value="String(getAccount.workers_count_active)"
                />
                <cabinet-card
                    class="card-in-active statistic__card-fourth"
                    :title="$t('statistic.info_blocks.workers.types[2]')"
                    :value="String(getAccount.workers_count_in_active)"
                />
                <instruction-step
                    :step_active="2"
                    :steps_count="instructionService.steps_count"
                    :step="instructionService.step"
                    :is-visible="instructionService.isVisible"
                    text="texts.statistic[1]"
                    title="titles.statistic[1]"
                    class-name="onboarding__card-bottom"
                    @next="instructionService.nextStep()"
                    @prev="instructionService.prevStep()"
                    @close="instructionService.nextStep(6)"
                />
            </div>
            <info-block
                class="statistic__info"
                :instruction-config="instructionService"
            />
<!--            <statistic-column-graph-->
<!--                :instruction-config="instructionService"-->
<!--                :wait-graph-change="barChartService.waitGraphChange"-->
<!--                :graph="barChartService.graph"-->
<!--                class="statistic_graph-column"-->
<!--            />-->
        </div>
        <no-information
            v-if="!lineChartService.waitGraph && !getAccount.workers_count"
            v-scroll="'opacity transition--fast'"
            class="cabinet__preloader-bg"
        />
    </div>
    <teleport to=".header_button-instruction" v-if="isMounted">
        <instruction-button
            hint="statistic"
            @openInstruction="instructionService.setStep().setVisible()"
        />
    </teleport>
</template>
<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainPreloader from "@/modules/preloader/Components/MainPreloader.vue";
import CabinetCard from "@/modules/common/Components/UI/CabinetCard.vue";
import InfoBlock from "@/modules/statistic/Components/InfoBlock.vue";
import StatisticLineGraph from "@/modules/statistic/Components/StatisticLineGraph.vue";
import StatisticColumnGraph from "@/modules/statistic/Components/StatisticColumnGraph.vue";
import NoInformation from "@/modules/statistic/Components/NoInformation.vue";
import DayHashrateIcon from "@/modules/common/icons/DayHashrateIcon.vue";
import MinuteHashrateIcon from "@/modules/common/icons/MinuteHashrateIcon.vue";
import InstructionStep from "@/modules/instruction/Components/InstructionStep.vue";
import InstructionButton from "@/modules/instruction/Components/UI/InstructionButton.vue";

import { InstructionService } from "@/modules/instruction/services/InstructionService";
import { StatisticService } from "@/modules/statistic/service/StatisticService";
import { mapGetters } from "vuex";

export default {
    components: {
        InstructionButton,
        MainTitle,
        MainPreloader,
        CabinetCard,
        InfoBlock,
        StatisticLineGraph,
        StatisticColumnGraph,
        NoInformation,
        MinuteHashrateIcon,
        DayHashrateIcon,
        InstructionStep,
    },
    data() {
        return {
            lineChartService: new StatisticService(this.$route),
            barChartService: new StatisticService(),
            instructionService: new InstructionService(),
            isMounted: false,
        };
    },
    watch: {
        "$i18n.locale"() {
            document.title = this.$t("header.links.statistic");
        },
        async "lineChartService.offset"() {
            await this.lineChartService.lineGraphIndex();
        },
        async getActive() {
            await this.lineChartService.lineGraphIndex();
            await this.barChartService.barGraphIndex();
        },
    },
    computed: {
        ...mapGetters(["getActive", "getAccount"]),
        graphOffsetTabs() {
            return [
                {title: `24 ${this.$t("hours")}`, value: 96},
                {title: `7 ${this.$t("days")}`, value: 672},
                // { title: `1 ${this.translate("month")}`, value: 2880 },
            ];
        }
    },
    async mounted() {
        this.isMounted = true
        this.instructionService.setStepsCount(4);

        document.title = this.$t("header.links.statistic");

        this.lineChartService.graphDataService.setOffset(this.graphOffsetTabs[0].value);
        this.barChartService.graphDataService.setOffset(30);

        await this.lineChartService.lineGraphIndex();
        await this.barChartService.barGraphIndex();
    },
};
</script>
<style lang="scss">
.onboarding_block {
    transition: none;
}

.onboarding_block-target {
    background: var(--background-globe);
}

.title-statistic {
    display: none;
}

@media (max-width: 500px) {
    .title-statistic {
        display: inline-block;
        padding: 8px 0 8px 16px;
        color: var(--text-primary);
        font-family: Unbounded, serif !important;
        font-size: 20px !important;
        font-style: normal;
        font-weight: 400;
        min-height: 40px;
        line-height: 32px; /* 160% */
    }
}

.statistic {
    width: 100%;
    position: relative;
    flex: 1 1 auto;

    &__cards {
        width: 100%;
        grid-column: 1 / 5;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        @media (max-width: 2100px) {
            grid-template-columns: repeat(6, 1fr);
            grid-column: 1 / 7;
        }
        @media (max-width: 1100px) {
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(2, 1fr);
        }
        @media (max-width: 998px) {
            display: flex;
            flex-direction: column;
        }
    }

    &__cabinet {
        display: grid;
        grid-template-rows: repeat(3, auto);
        grid-template-columns: repeat(4, 1fr);
        @media (max-width: 2100px) {
            grid-template-columns: repeat(6, 1fr);
        }
        @media (max-width: 998px) {
            display: flex;
            flex-direction: column;
        }
    }

    &_graph {
        grid-column: 1 / 5;
        position: relative;
        padding: 24px 24px 48px 24px;
        display: flex;
        flex-direction: column;
        gap: 24px;
        width: 100%;
        max-height: 588px;
        @media (max-width: 2100px) {
            grid-column: 1 / 7;
        }

        .y-axis-container {
            @media (max-width: 500px) {
                top: 18px;
                left: 16px;
            }
        }

        @media (max-width: 500px) {
            flex-direction: column-reverse;
            padding: 16px;
        }
        @media (max-width: 998px) {
            gap: 32px;
        }

        &-column {
            grid-column: 3 / 5;
            @media (max-width: 2100px) {
                grid-column: 4 / 7;
            }
        }
    }

    &-center {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    &__info {
        grid-column: 1 / 3;
        @media (max-width: 2100px) {
            grid-column: 1 / 4;
        }
    }

    &__card {
        &-first {
            grid-column: 1 / 2;
            @media (max-width: 2100px) {
                grid-column: 1 / 3;
            }
            @media (max-width: 1100px) {
                grid-column: 1 / 2;
            }
        }

        &-second {
            grid-column: 2 / 3;
            @media (max-width: 2100px) {
                grid-column: 3 / 5;
            }
            @media (max-width: 1100px) {
                grid-column: 2 / 3;
            }
        }

        &-third {
            grid-column: 3 / 4;
            @media (max-width: 2100px) {
                grid-column: 5 / 6;
            }
            @media (max-width: 1100px) {
                grid-column: 1 / 2;
                grid-row: 2 / 3;
            }
        }

        &-fourth {
            grid-column: 4 / 5;
            @media (max-width: 2100px) {
                grid-column: 6 / 7;
            }
            @media (max-width: 1100px) {
                grid-column: 2 / 3;
                grid-row: 2 / 3;
            }
        }
    }
}
</style>

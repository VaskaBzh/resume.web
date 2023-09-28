<template>
    <div
        class="statistic"
        :class="{
            'statistic-center':
                lineChartService.waitGraph ||
                lineChartService.records?.filter((a) => a.hashrate > 0)
                    .length === 0,
        }"
    >
        <main-preloader
            class="cabinet__preloader cabinet__preloader-bg"
            :wait="lineChartService.waitGraph"
            :interval="20"
            :end="!!lineChartService"
        />
        <div
            v-scroll="'opacity transition--fast'"
            class="cabinet statistic__cabinet"
            v-if="
                !lineChartService.waitGraph &&
                lineChartService.records?.filter((a) => a.hashrate > 0)
                    .length !== 0
            "
        >
            <main-title class="title-statistic" tag="h4">{{
                $t("statistic.title")
            }}</main-title>
            <statistic-line-graph
                class="statistic_graph"
                @getValue="lineChartService.setOffset($event)"
                :waitGraphChange="lineChartService.waitGraphChange"
                :offset="lineChartService.offset"
                :graph="lineChartService.graph"
                :buttons="lineChartService.buttons"
            />
            <cabinet-card
                class="statistic__card-first"
                :title="$t('statistic.info_blocks.hash.titles[0]')"
                :value="Number(getAccount.hash_per_min).toFixed(2)"
                unit="TH/s"
            >
                <template v-slot:svg>
                    <hashrate-icon />
                </template>
            </cabinet-card>
            <cabinet-card
                class="statistic__card-second"
                :title="$t('statistic.info_blocks.hash.titles[1]')"
                :value="Number(getAccount.hash_per_day).toFixed(2)"
                unit="TH/s"
            >
                <template v-slot:svg>
                    <hashrate-icon24 />
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
            <info-block class="statistic__info" />
            <statistic-column-graph
                :waitGraphChange="barChartService.waitGraphChange"
                :graph="barChartService.graph"
                class="statistic_graph-column"
            />
        </div>
        <no-information
            v-scroll="'opacity transition--fast'"
            class="cabinet__preloader-bg"
            v-if="
                !lineChartService.waitGraph &&
                lineChartService.records?.filter((a) => a.hashrate > 0)
                    .length === 0
            "
        />
    </div>
</template>
<script>
// import CopyBlock from "@/Components/technical/blocks/profile/CopyBlock.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import { mapGetters } from "vuex";
import MainPreloader from "@/modules/preloader/Components/MainPreloader.vue";
import CabinetCard from "@/modules/common/Components/UI/CabinetCard.vue";
import HashrateIcon from "@/modules/common/icons/HashrateIcon.vue";
import HashrateIcon24 from "@/modules/common/icons/HashrateIcon24.vue";
import InfoBlock from "@/modules/statistic/Components/InfoBlock.vue";
import StatisticLineGraph from "@/modules/statistic/Components/StatisticLineGraph.vue";
import StatisticColumnGraph from "@/modules/statistic/Components/StatisticColumnGraph.vue";
import { StatisticService } from "@/modules/statistic/service/StatisticService";
import NoInformation from "../../modules/statistic/Components/NoInformation.vue";

export default {
    components: {
        MainTitle,
        // CopyBlock,
        MainPreloader,
        CabinetCard,
        HashrateIcon,
        HashrateIcon24,
        InfoBlock,
        StatisticLineGraph,
        StatisticColumnGraph,
        NoInformation,
    },
    data() {
        return {
            lineChartService: new StatisticService(
                [0, 1],
                this.$t,
                this.offset,
                this.$route
            ),
            barChartService: new StatisticService([0, 1], this.$t, 30),
        };
    },
    watch: {
        "$i18n.locale"() {
            document.title = this.$t("header.links.statistic");
        },
        async "lineChartService.offset"() {
            await this.lineChartService.lineGraphIndex();
            await this.barChartService.barGraphIndex();
        },
        async getActive(newActiveId) {
            this.lineChartService.setGroupId(newActiveId);
            this.barChartService.setGroupId(newActiveId);

            await this.lineChartService.lineGraphIndex();
            await this.barChartService.barGraphIndex();
        },
        async offset() {
            await this.lineChartService.lineGraphIndex();
            await this.barChartService.barGraphIndex();
        },
        async getAccount() {
            await this.lineChartService.lineGraphIndex();
            await this.barChartService.barGraphIndex();
        },
    },
    computed: {
        ...mapGetters(["getActive", "getAccount"]),
    },
    async mounted() {
        document.title = this.$t("header.links.statistic");
        this.lineChartService.setGroupId(this.getActive);
        this.barChartService.setGroupId(this.getActive);

        this.lineChartService.setButtons();

        await this.lineChartService.lineGraphIndex();
        await this.barChartService.barGraphIndex();
    },
};
</script>
<style lang="scss">
.title-statistic {
    display: none;
}
@media (max-width: 500px) {
    .title-statistic {
        display: inline-block;
        padding: 0 0 8px 16px;
        color: var(--text-primary);
        font-family: Unbounded !important;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: 32px; /* 160% */
    }
}
.statistic {
    width: 100%;
    padding: 24px;
    position: relative;
    flex: 1 1 auto;
    @media (max-width: 900px) {
        padding: 24px 12px 24px;
    }
    &__cabinet {
        display: grid;
        grid-template-rows: repeat(3, auto);
        grid-template-columns: repeat(4, 1fr);
        @media (max-width: 1700px) {
            grid-template-columns: repeat(6, 1fr);
        }
        @media (max-width: 900px) {
            display: flex;
            flex-direction: column;
        }
    }
    &_graph {
        grid-column: 1 / 7;
        position: relative;
        padding: 24px 24px 48px 24px;
        display: flex;
        flex-direction: column;
        gap: 24px;
        width: 100%;
        height: fit-content;
        .y-axis-container {
            @media (max-width: 500px) {
                top: 18px;
                left: 16px
            }
        }
        @media (max-width: 500px) {
            flex-direction: column-reverse;
            padding: 16px;
        }
        @media (max-width: 900px) {
            gap: 32px;
        }
        &-column {
            grid-column: 3 / 5;
            @media (max-width: 1700px) {
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
        @media (max-width: 1700px) {
            grid-column: 1 / 4;
        }
    }
    &__card {
        &-first {
            grid-column: 1 / 2;
            @media (max-width: 1700px) {
                grid-column: 1 / 3;
            }
        }
        &-second {
            grid-column: 2 / 3;
            @media (max-width: 1700px) {
                grid-column: 3 / 5;
            }
        }
        &-third {
            grid-column: 3 / 4;
            @media (max-width: 1700px) {
                grid-column: 5 / 6;
            }
        }
        &-fourth {
            grid-column: 4 / 5;
            @media (max-width: 1700px) {
                grid-column: 6 / 7;
            }
        }
    }
}
</style>

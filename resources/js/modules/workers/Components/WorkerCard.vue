<template>
    <div class="card">
        <wait-preloader
            class="card_preloader"
            :wait="wait"
            :interval="20"
            :end="!wait"
        />
        <div class="card__wrapper">
            <div class="card__content">
                <transition name="fade">
                    <div v-show="!wait" class="card__head">
                        <h3 class="card_title">{{ target_worker.name }}</h3>
                        <span
                            class="card_status"
                            :class="{
                                'card_status-active':
                                    target_worker.class === 'ACTIVE',
                                'card_status-in-active':
                                    target_worker.class === 'INACTIVE',
                                'card_status-dead':
                                    target_worker.class === 'DEAD',
                            }"
                            >{{
                                $t(`status-worker.title.${target_worker.class}`)
                            }}</span
                        >
                    </div>
                </transition>
                <cross-icon class="card_close" @click="$emit('closeCard')" />
                <transition name="fade">
                    <main-tabs
                        v-if="!wait"
                        class="card__tabs"
                        :tabs="graphOffsetTabs"
                        :active="interval"
                        @getValue="$emit('getValue', $event)"
                    />
                </transition>
                <transition name="fade">
                    <div v-if="!wait" class="card_graph">
                        <main-line-graph :graph-data="graph" :height="height" />
                    </div>
                </transition>
                <transition name="fade">
                    <div v-show="!wait" class="card__block">
                        <cabinet-card
                            class="card__elem"
                            :title="$t('statistic.info_blocks.hash.titles[0]')"
                            :value="hashPerDay"
                            unit="TH/s"
                            :page="'worker'"
                        >
                            <template #svg>
                                <minute-hashrate-icon />
                            </template>
                        </cabinet-card>
                        <cabinet-card
                            class="card__elem"
                            :title="$t('statistic.info_blocks.hash.titles[1]')"
                            :value="hashPerMin"
                            unit="TH/s"
                            :page="'worker'"
                        >
                            <template #svg>
                                <day-hashrate-icon />
                            </template>
                        </cabinet-card>
                    </div>
                </transition>
            </div>
        </div>
    </div>
</template>

<script>
import MainTabs from "@/modules/common/Components/UI/MainTabs.vue";
import MainLineGraph from "@/modules/graphs/Components/MainLineGraph.vue";
import CabinetCard from "@/modules/common/Components/UI/CabinetCard.vue";
import CrossIcon from "@/modules/common/icons/CrossIcon.vue";
import MinuteHashrateIcon from "@/modules/common/icons/MinuteHashrateIcon.vue";
import DayHashrateIcon from "@/modules/common/icons/DayHashrateIcon.vue";
import WaitPreloader from "@/modules/preloader/Components/WaitPreloader.vue";
import { mapGetters } from "vuex";
import { WorkerMessages } from "@/modules/workers/lang/WorkerMessages";

export default {
    name: "WorkerCard",
    components: {
        WaitPreloader,
        DayHashrateIcon,
        MinuteHashrateIcon,
        CrossIcon,
        MainTabs,
        MainLineGraph,
        CabinetCard,
    },
    props: {
        target_worker: Object,
        graph: Object,
        wait: Boolean,
        interval: String,
    },
    i18n: {
        sharedMessages: WorkerMessages,
    },
    data() {
        return {
            height: 190,
        };
    },
    computed: {
        ...mapGetters(["viewportWidth"]),
        graphOffsetTabs() {
            return [
                { title: `24 ${this.$t("hours")}`, value: "day" },
                { title: `7 ${this.$t("days")}`, value: "week" },
                { title: `1 ${this.$t("month")}`, value: "month" },
            ];
        },
        hashPerDay() {
            return this.wait
                ? null
                : Number(this.target_worker.hashrate?.split(" ")[0]).toFixed(2);
        },
        hashPerMin() {
            return this.wait
                ? null
                : Number(
                      this.target_worker.hashrate_per_day?.split(" ")[0]
                  ).toFixed(2);
        },
    },
};
</script>

<style scoped lang="scss">
@keyframes fade {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
.card {
    border-radius: 24px;
    background: var(--background-island, #fff);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    overflow: hidden;
    position: relative;
    height: fit-content;
}
:global(.card__tabs .cabinet_button) {
    width: 100%;
}
.card_preloader {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}
.card__wrapper {
    padding: 24px;
    width: 100%;
}
@media (max-width: 1200px) {
    .card {
        border-radius: 0;
    }
    .card_close {
        display: none;
    }
    .card__wrapper {
        padding: 0;
    }
    .card__head .card_title {
        width: fit-content;
    }
}
.card__content {
    position: relative;
    display: flex;
    flex-direction: column;
    gap: 24px;
}
.card_close {
    position: absolute;
    right: -8px;
    top: 0;
    height: 32px;
    width: 32px;
    cursor: pointer;
    padding: 8px;
}
.card__head {
    display: flex;
    gap: 16px;
}
.card_title {
    color: var(--text-primary, rgba(29, 41, 57, 0.8));
    font-family: Unbounded, serif;
    font-size: 18px;
    font-weight: 400;
    line-height: 28px;
}
.card_graph {
    height: 190px;
}
.card_status {
    border-radius: 8px;
    min-height: 32px;
    padding: 0 8px;
    text-align: center;
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
    display: inline-flex;
    align-items: center;
}
.card_status-active {
    color: var(--status-succesfull, #1fb96c);
    background: var(--background-success, #e9f8f1);
}
.card__block {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 8px;
    margin-top: 24px;
}
.card__elem {
    width: 100%;
    border-radius: 24px;
    background: var(--background-island-inner-3, #f8fafd);
    box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.01);
}
.card_status-in-active {
    color: var(--status-failed, #f1404a);
    background: var(--background-failed, #feeced);
}
@media (max-width: 410px) {
    .card__block {
        grid-template-columns: 1fr;
    }
    .card__elem {
        width: 100%;
    }
    .card__head {
        gap: 8px;
    }
    .card_status {
        border-radius: 8px;
        background: var(--background-success, #21322e);
        font-size: 12px;
    }
}
.card_status-dead {
    color: var(--status-death, #667085);
    background: var(--background-death, rgba(44, 47, 52, 0.05));
}
</style>

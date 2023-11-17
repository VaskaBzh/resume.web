<template>
    <div class="workers">
        <div class="workers__wrapper">
            <main-title class="title-worker"
                >{{ $t("workers.title") }}
            </main-title>
            <div
                class="cards-container onboarding_block"
                :class="{
                    'onboarding_block-target':
                        instructionService.isVisible &&
                        instructionService.step === 1,
                }"
            >
                <main-hashrate-cards class="workers-header-cards" />
                <instruction-step
                    :step_active="1"
                    :steps_count="instructionService.steps_count"
                    :step="instructionService.step"
                    :is-visible="instructionService.isVisible"
                    text="texts.workers[0]"
                    title="titles.workers[0]"
                    class-name="onboarding__card-top"
                    @next="instructionService.nextStep()"
                    @prev="instructionService.prevStep()"
                    @close="instructionService.nextStep(6)"
                />
            </div>
            <div class="workers__content">
                <worker-tabs
                    :tabs="worker_service.filterButtons"
                    :active_tab="worker_service.status"
                    @changeStatus="setStatus"
                />
                <div class="workers__table">
                    <main-slider
                        class="onboarding_block"
                        :class="{
                            'onboarding_block-target':
                                instructionService.isVisible &&
                                instructionService.step === 2,
                        }"
                        :wait="worker_service.waitWorkers"
                        :empty="worker_service.emptyTableWorkers"
                        rows-num="1000"
                        :have-nav="false"
                    >
                        <template #instruction>
                            <instruction-step
                                :step_active="2"
                                :steps_count="instructionService.steps_count"
                                :step="instructionService.step"
                                :is-visible="instructionService.isVisible"
                                text="texts.workers[1]"
                                title="titles.workers[1]"
                                class-name="onboarding__card-bottom"
                                @next="instructionService.nextStep()"
                                @prev="instructionService.prevStep()"
                                @close="instructionService.nextStep(6)"
                            />
                        </template>
                        <main-table
                            :table="worker_service.table"
                            :remove-percent="removePercent"
                            :empty="worker_service.emptyTableWorkers"
                            :wait="worker_service.waitWorkers"
                            @getData="getTargetWorker($event)"
                        ></main-table>
                    </main-slider>
                    <transition name="slide">
                        <worker-card
                            v-if="
                                viewportWidth > 1200 &&
                                worker_service.visibleCard
                            "
                            class="workers__card"
                            :wait="worker_service.waitTargetWorker"
                            :target_worker="worker_service.target_worker"
                            :graph="worker_service.workers_graph"
                            @closeCard="dropWorkers"
                        />
                    </transition>
                </div>
            </div>
        </div>
    </div>
    <workers-popup-card
        v-if="viewportWidth <= 1200"
        :wait="worker_service.wait"
        :closed="worker_service.popupCardClosed"
        :opened="worker_service.popupCardOpened"
        @dropWatcher="dropWorkers"
    >
        <worker-card
            class="workers__card"
            :target_worker="worker_service.target_worker"
            :graph="worker_service.workers_graph"
            :wait="worker_service.waitTargetWorker"
            @closeCard="dropWorkers"
        />
    </workers-popup-card>
    <instruction-button
        hint="workers"
        @openInstruction="instructionService.setStep().setVisible()"
    />
</template>
<script>
import MainHashrateCards from "@/modules/common/Components/UI/MainHashrateCards.vue";
import MainSlider from "@/modules/slider/Components/MainSlider.vue";
import MainTable from "@/Components/tables/MainTable.vue";
import MainPreloader from "@/modules/preloader/Components/MainPreloader.vue";
import WorkerCard from "@/modules/workers/Components/WorkerCard.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import WorkersPopupCard from "@/modules/workers/Components/WorkersPopupCard.vue";
import InstructionStep from "@/modules/instruction/Components/InstructionStep.vue";
import InstructionButton from "@/modules/instruction/Components/UI/InstructionButton.vue";
import WorkerTabs from "@/modules/workers/Components/WorkerTabs.vue";

import { InstructionService } from "@/modules/instruction/services/InstructionService";
import { WorkerService } from "@/services/WorkerService";
import { mapGetters } from "vuex";

export default {
    components: {
        WorkerTabs,
        InstructionButton,
        MainHashrateCards,
        MainSlider,
        MainTable,
        MainPreloader,
        WorkerCard,
        MainTitle,
        WorkersPopupCard,
        InstructionStep,
    },
    data() {
        return {
            workersActive: 0,
            workersInActive: 0,
            workersDead: 0,
            changedActive: -1,
            removePercent: false,
            worker_service: new WorkerService(
                this.$t,
                [0, 1, 3, 4],
                this.$route
            ),
            instructionService: new InstructionService(),
        };
    },
    watch: {
        getActive(newActive, oldActive) {
            this.changedActive = oldActive === -1 ? -1 : newActive;
            this.initWorkers();
        },
        "$i18n.locale"() {
            this.initWorkers();
            document.title = this.$t("header.links.workers");
        },
    },
    methods: {
        setStatus(status) {
            this.worker_service.setStatus(status);

            this.initWorkers();
        },
        async initWorkers() {
            await this.worker_service.fillTable();
        },
        async getTargetWorker(data) {
            if (this.viewportWidth > 1200) {
                this.removePercent = true;
            }

            await this.worker_service.getPopup(data.id);
        },
        dropWorkers() {
            this.worker_service.dropWorker();

            this.viewportWidth > 1200
                ? (this.removePercent = false)
                : this.worker_service.closePopupCard();
        },
    },
    computed: {
        ...mapGetters([
            "getActive",
            "allAccounts",
            "allHash",
            "allHistoryMiner",
            "getAccount",
            "viewportWidth",
        ]),
        statuses() {
            return [
                { title: this.$t("workers.select[0]"), value: "all" },
                { title: this.$t("workers.select[1]"), value: "active" },
                { title: this.$t("workers.select[2]"), value: "unstable" },
                // { title: "Неактивные", value: "instable" },
            ];
        },
    },
    mounted() {
        this.instructionService.setStepsCount(2);

        this.worker_service.setFilterButtons();

        this.initWorkers();

        document.title = this.$t("header.links.workers");
    },
};
</script>
<style lang="scss" scoped>
.title-worker {
    display: none;
}

@media (max-width: 500px) {
    .title-worker {
        display: inline-block;
        padding: 0 0 16px 16px;
        color: var(--text-primary);
        font-family: Unbounded !important;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: 32px; /* 160% */
    }

    .workers-header-cards {
        align-items: unset;
    }
}

.cards-container {
    display: flex;
    justify-content: space-between;
    margin-bottom: 32px;
}

@media (max-width: 998px) {
    .cards-container {
        flex-direction: column;
        gap: 16px;
    }
}

@media (max-width: 497.98px) {
    .cards-container {
        flex-direction: row;
        flex-wrap: nowrap;
        gap: 0px;
        margin-bottom: 24px;
    }
}

.workers {
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;

    &__wrapper {
        flex: 1 1 auto;
        display: flex;
        flex-direction: column;
    }

    .form .title {
        margin-bottom: 0;
    }

    &__content {
        display: flex;
        gap: 12px;
        flex-direction: column;
        flex: 1 1 auto;
    }

    &__table {
        display: flex;
        gap: 12px;
        flex: 1 1 auto;
    }

    &__card {
        min-width: calc(50% - 6px);
        min-height: 300px;

        @media (min-width: 1200px) {
            margin-top: 64px;
        }
    }

    &__button {
        min-width: 60px;
        min-height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        @media (max-width: 767.98px) {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: -10px;
            &:before {
                content: none;
            }
            &:active {
                transform: translateY(-50%);
            }
        }

        svg {
            width: 14px;
            height: 14px;
            fill: #fff;
        }

        @media (max-width: 479.89px) {
            background: transparent;
            min-width: 40px;
            min-height: 40px;

            svg {
                fill: #4182ec;
                width: 18px;
                height: 18px;
            }
        }
    }

    &__filter {
        margin: 16px 0 24px;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        width: 100%;
        gap: 16px;
        @media (max-width: 767.98px) {
            margin: 24px 0 20px;
            justify-content: space-between;
            position: relative;
        }

        &_wrapper {
            display: flex;
            gap: 16px;
            width: 100%;
        }

        &_block {
            max-width: 230px;
            width: 100%;
            @media (max-width: 767.98px) {
                max-width: 100%;
            }
        }

        &_label {
            font-weight: 400;
            font-size: 16px;
            line-height: 23px;
            color: rgba(0, 0, 0, 0.62);
            margin-bottom: 8px;
            @media (max-width: 767.98px) {
                font-size: 16px;
                line-height: 20px;
                color: var(--text-secondary);
                margin-bottom: 6px;
            }
        }
    }

    &__select {
        height: 48px;
        @media (max-width: 767.98px) {
            max-width: 100% !important;
        }
        @media (max-width: 479.98px) {
            height: 28px;
        }

        .select_title {
            font-weight: 500;
            font-size: 18px;
            line-height: 26px;
            color: #000034;
            z-index: 2;
        }
    }
}

.slide-enter-active,
.slide-leave-active {
    transition: all 0.5s ease-out;
}

.slide-enter-from,
.slide-leave-to {
    @media (min-width: 1300px) {
        max-width: 0;
        min-width: 0;
    }
    opacity: 0;
}
</style>

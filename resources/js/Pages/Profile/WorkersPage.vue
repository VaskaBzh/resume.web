<template>
    <div class="workers">
        <main-preloader
            class="cabinet__preloader"
            :wait="worker_service.waitWorkers"
            :interval="35"
            :end="!worker_service.waitWorkers"
            :empty="worker_service.emptyWorkers"
        />
        <div
            class="workers__wrapper"
            v-if="!worker_service.waitWorkers && !worker_service.emptyWorkers"
        >
            <main-title class="title-worker" tag="h4">{{
                $t("workers.title")
            }}</main-title>
            <div
                class="cards-container onboarding_block"
                :class="{
                    'onboarding_block-target': instructionService.isVisible && instructionService.step === 1
                }"
            >
                <main-hashrate-cards />
                <instruction-step
                    @next="instructionService.nextStep()"
                    @prev="instructionService.prevStep()"
                    @close="instructionService.nextStep(6)"
                    :step_active="1"
                    :steps_count="instructionService.steps_count"
                    :step="instructionService.step"
                    :isVisible="instructionService.isVisible"
                    text="texts.workers[0]"
                    title="titles.workers[0]"
                    className="onboarding__card-top"
                />
            </div>
            <div class="workers__content">
                <main-slider
                    class="onboarding_block"
                    :class="{
                        'onboarding_block-target': instructionService.isVisible && instructionService.step === 2
                    }"
                    :wait="worker_service.waitWorkers"
                    :empty="worker_service.emptyWorkers"
                    rowsNum="1000"
                    :haveNav="false"
                >
                    <template v-slot:instruction>
                        <instruction-step
                            @next="instructionService.nextStep()"
                            @prev="instructionService.prevStep()"
                            @close="instructionService.nextStep(6)"
                            :step_active="2"
                            :steps_count="instructionService.steps_count"
                            :step="instructionService.step"
                            :isVisible="instructionService.isVisible"
                            text="texts.workers[1]"
                            title="titles.workers[1]"
                            className="onboarding__card-bottom"
                        />
                    </template>
                    <main-table
                        :table="worker_service.table"
                        :removePercent="removePercent"
                        @getData="getTargetWorker($event)"
                    ></main-table>
                </main-slider>
                <transition name="slide">
                    <worker-card
                        class="workers__card"
                        v-if="
                            viewportWidth > 1200 && worker_service.visibleCard
                        "
                        :wait="worker_service.waitTargetWorker"
                        :target_worker="worker_service.target_worker"
                        :graph="worker_service.workers_graph"
                        @closeCard="dropWorkers"
                    />
                </transition>
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
            v-if="Object.entries(worker_service.target_worker).length > 0"
            :target_worker="worker_service.target_worker"
            :graph="worker_service.workers_graph"
            :wait="worker_service.waitTargetWorker"
            @closeCard="dropWorkers"
    />
    </workers-popup-card>
    <instruction-button
        @openInstruction="instructionService.setStep().setVisible()"
        hint="workers"
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

import { InstructionService } from "@/modules/instruction/services/InstructionService";
import { WorkerService } from "@/services/WorkerService";
import { mapGetters } from "vuex";
import InstructionButton from "../../modules/instruction/Components/UI/InstructionButton.vue";

export default {
    components: {
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
        async initWorkers() {
            await this.worker_service.fillTable();
        },
        async getTargetWorker(data) {
            if (this.viewportWidth > 1200) {
                this.removePercent = true
            }

            await this.worker_service.getPopup(data.id);
            this.worker_service.openPopupCard()
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
}
.cards-container {
    display: flex;
    justify-content: space-between;
    margin-bottom: 32px;
}
@media (max-width: 900px) {
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
    padding: 24px;
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    @media (max-width: 900px) {
        padding: 24px 12px 24px;
    }
    .form .title {
        margin-bottom: 0;
    }
    &__content {
        display: flex;
        gap: 12px;
        @media (max-width: 1300px) {
            flex-direction: column;
        }
    }
    &__card {
        min-width: calc(50% - 6px);
        min-height: 440px;
        @media (max-width: 1300px) {
            min-height: 437px;
        }
        @media (max-width: 900px) {
            min-height: 450px;
            position: absolute;
            width: calc(100% - 20px);
        }
        @media (max-width: 500px) {
            min-height: 380px;
        }
        @media (max-width: 490px) {
            width: 100%;
        }
        @media (max-width: 410px) {
            min-height: 550px;
        }
        @media (max-width: 390px) {
            min-height: 490px;
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

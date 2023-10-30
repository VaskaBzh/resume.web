<template>
    <div class="watchers">
        <div
            class="watchers__head onboarding_block"
            :class="{
                'onboarding_block-target':
                    instructionService.isVisible &&
                    instructionService.step === 1,
            }"
        >
            <div class="watchers__head__block">
                <main-title>{{ $t("title") }}</main-title>
                <main-description class="is-vis-text-mobile"
                    >{{ $t("text") }}
                </main-description>
            </div>
            <main-button data-popup="#addWatcher">
                <template #svg>
                    <plus-icon />
                </template>
            </main-button>
            <instruction-step
                :step_active="1"
                :steps_count="instructionService.steps_count"
                :step="instructionService.step"
                :is-visible="instructionService.isVisible"
                text="texts.watchers[0]"
                title="titles.watchers[0]"
                class-name="onboarding__card-top"
                @next="instructionService.nextStep()"
                @prev="instructionService.prevStep()"
                @close="instructionService.nextStep(6)"
            />
        </div>
        <div class="cabinet watchers__wrapper">
            <main-preloader
                class="cabinet__preloader watchers__preloader"
                :wait="service.waitTable"
                :interval="35"
                :end="!service.waitTable"
                :empty="service.emptyTable"
            />
            <transition name="fade">
                <main-slider
                    v-show="!service.waitTable && !service.emptyTable"
                    :wait="service.waitTable"
                    :empty="service.emptyTable"
                    rows-num="1000"
                    :have-nav="false"
                    :have-preloader="false"
                    :meta="service.meta"
                >
                    <watchers-list
                        :blocks="service.table.get('rows')"
                        :active-watcher="activeCard"
                        @getWatcher="service.getCard($event)"
                    />
                </main-slider>
            </transition>

            <transition name="fade">
                <watchers-card
                    v-if="
                        viewportWidth > 500 &&
                        !service.waitTable &&
                        !service.emptyTable
                    "
                    :watcher="activeCard"
                    @changeWatcher="changeWatcher"
                    @removeWatcher="removeWatcher"
                />
            </transition>
        </div>
    </div>
    <watchers-popup-add
        :wait="service.wait"
        :opened="openOnBoardingPopup"
        :closed="service.popupClosed || closeOnBoardingPopup"
        :instruction-config="instructionService"
        @createWatcher="createWatcher($event)"
        @closed="instructionService.nextStep()"
    />
    <watchers-popup-remove
        :id="activeCard?.id"
        :wait="service.wait"
        :closed="service.popupClosed"
        :name="name"
        @removeWatcher="removeWatcher($event)"
    />
    <watchers-popup-card
        v-if="viewportWidth <= 500"
        :wait="service.wait"
        :closed="service.popupCardClosed"
        :opened="service.popupCardOpened"
        @dropWatcher="dropWatcher"
    >
        <watchers-card
            v-if="!service.waitTable && !service.emptyTable && activeCard"
            :watcher="activeCard"
            @changeWatcher="changeWatcher"
            @removeWatcher="removeWatcher"
        />
    </watchers-popup-card>
    <instruction-button
        hint="watchers"
        @openInstruction="instructionService.setStep().setVisible()"
    />
</template>

<script>
import MainDescription from "@/modules/common/Components/UI/MainDescriptionOld.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import PlusIcon from "@/modules/common/icons/PlusIcon.vue";
import MainSlider from "@/modules/slider/Components/MainSlider.vue";
import WatchersList from "@/modules/watchers/Components/blocks/WatchersList.vue";
import WatchersPopupAdd from "@/modules/watchers/Components/blocks/WatchersPopupAdd.vue";
import WatchersCard from "@/modules/watchers/Components/blocks/WatchersCard.vue";
import WatchersPopupRemove from "@/modules/watchers/Components/blocks/WatchersPopupRemove.vue";
import MainPreloader from "@/modules/preloader/Components/MainPreloader.vue";
import WatchersPopupCard from "@/modules/watchers/Components/blocks/WatchersPopupCard.vue";
import InstructionStep from "@/modules/instruction/Components/InstructionStep.vue";

import { InstructionService } from "@/modules/instruction/services/InstructionService";
import { WatchersService } from "@/modules/watchers/services/WatchersService";
import { mapGetters } from "vuex";
import { WatchersMessage } from "@/modules/watchers/lang/WatchersMessages";
import InstructionButton from "../../modules/instruction/Components/UI/InstructionButton.vue";

export default {
    name: "WatchersPage",
    components: {
        InstructionButton,
        WatchersList,
        MainSlider,
        PlusIcon,
        MainTitle,
        MainDescription,
        MainButton,
        WatchersPopupAdd,
        WatchersPopupRemove,
        WatchersPopupCard,
        WatchersCard,
        MainPreloader,
        InstructionStep,
    },
    i18n: {
        sharedMessages: WatchersMessage,
    },
    data() {
        return {
            service: new WatchersService(this.$t),
            instructionService: new InstructionService(),
            openOnBoardingPopup: false,
            closeOnBoardingPopup: false,
        };
    },
    computed: {
        ...mapGetters(["getActive", "getAccount", "viewportWidth"]),
        name() {
            return this.service.card?.name;
        },
        activeCard() {
            return this.service.card;
        },
    },
    watch: {
        async getActive(newActiveId) {
            this.service.setGroupId(newActiveId);

            await this.service.index();
        },
        async getAccount() {
            await this.service.index();
        },
        "$i18n.locale"() {
            document.title = this.$t("header.links.watchers");
        },
        "instructionService.step"(newStepValue) {
            if (newStepValue === 2) {
                this.openOnBoardingPopup = true;

                setTimeout(() => (this.openOnBoardingPopup = false), 300);
            }
            if (newStepValue === 3) {
                this.closeOnBoardingPopup = true;

                setTimeout(() => (this.closeOnBoardingPopup = false), 300);
            }
        },
    },
    async mounted() {
        this.instructionService.setStepsCount(2);

        document.title = this.$t("header.links.watchers");
        this.service.setGroupId(this.getActive);
        this.service.setForm();

        await this.service.index();
    },
    methods: {
        dropWatcher() {
            this.service.dropCard();
        },
        async createWatcher(formData) {
            this.service.setForm(formData.name, formData.allowedRoutes);
            await this.service.createWatcher();
            await this.service.index();
        },
        async changeWatcher(formData) {
            this.service.setForm(formData.name, formData.allowedRoutes);
            await this.service.changeWatcher(formData.id);
            await this.service.index();
        },
        async removeWatcher(id) {
            await this.service.removeWatcher(id);
            this.service.dropCard();
            await this.service.index();
        },
    },
};
</script>

<style scoped>
.onboarding_block {
    transition: none;
}

.onboarding_block-target {
    background: var(--background-island);
}

.fade-enter-active,
.fade-leave-active {
    transition: all 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.watchers {
    flex: 1 1 auto;
    padding: 24px;
    width: 100%;
    display: flex;
    flex-direction: column;
}

.is-vis-text-mobile {
    display: inline-block;
}

.is-vis-add-button-mobile {
    display: none;
}

.watchers__preloader {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}

.watchers__head.onboarding_block-target {
    padding: 8px;
    margin: -8px -8px 24px;
    width: calc(100% + 16px);
}

.watchers__head {
    display: flex;
    justify-content: space-between;
    gap: 8px;
    margin-bottom: 32px;
    align-items: center;
}

.watchers__head__block {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.watchers__wrapper {
    height: 100%;
    width: 100%;
    flex: 1 1 auto;
    display: grid;
    gap: 12px;
    grid-template-rows: 1fr;
    grid-template-columns: repeat(2, 1fr);
    position: relative;
}

@media (max-width: 900px) {
    .watchers {
        padding: 24px 12px 24px;
    }
}

@media (max-width: 700px) {
    .watchers__wrapper {
        display: flex;
    }
}

@media (max-width: 500px) {
    .watchers__head {
        margin: 16px 16px 32px;
    }

    .is-vis-text-mobile {
        display: none;
    }

    .is-vis-add-button-mobile {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }
}
</style>

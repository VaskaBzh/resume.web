<template>
    <main-popup
        id="addWatcher"
        :wait="wait"
        :opened="opened"
        :closed="closed"
        :instruction-config="instructionConfig"
        :class-name="
            instructionConfig.isVisible && instructionConfig.step === 2
                ? 'onboarding_block-target'
                : ''
        "
        @closed="$emit('closed')"
    >
        <form @submit.prevent="setFormAllowedRoutes" class="watchers__form">
            <div class="watchers__column">
                <div class="watchers-add">
                    <main-title class="watcher_title"
                        >{{ $t("add_watcher_card.title") }}
                    </main-title>
                    <main-description
                        >{{ $t("add_watcher_card.text[0]") }}
                    </main-description>
                </div>
                <main-input
                    class="watchers_input"
                    input-name="name"
                    :input-label="$t('add_watcher_card.labels')"
                    :input-value="form.name"
                    :error="errorsExpired.name"
                    @getValue="setFormName($event)"
                />
                <div class="watchers__block">
                    <div class="watchers_label">
                        {{ $t("add_watcher_card.text[1]") }}
                    </div>
                    <div class="watchers__block watchers__block-selects">
                        <main-checkbox
                            v-for="(route, i) in allowedRoutes"
                            :key="i"
                            :is_checked="route.checked"
                            :editable="route.editable"
                            class="checkbox-sm"
                            @is_checked="setAllowedRoutes($event, i)"
                        >
                            {{ route.name }}
                        </main-checkbox>
                    </div>
                </div>
            </div>
            <main-button
                type="submit"
                class="button-blue button-full watchers_button"

            >
                <template #text>
                    {{ $t("add_watcher_card.buttons") }}
                </template>
            </main-button>
        </form>
        <template #instruction>
            <instruction-step
                :step_active="2"
                :steps_count="instructionConfig.steps_count"
                :step="instructionConfig.step"
                :is-visible="instructionConfig.isVisible"
                text="texts.watchers[1]"
                title="titles.watchers[1]"
                class-name="onboarding__card-right"
                @next="instructionConfig.nextStep()"
                @prev="instructionConfig.prevStep()"
                @close="instructionConfig.nextStep(6)"
            />
        </template>
    </main-popup>
</template>

<script>
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescriptionOld.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import MainInput from "@/modules/common/Components/inputs/MainInput.vue";
import MainCheckbox from "@/modules/common/Components/UI/MainCheckbox.vue";
import InstructionStep from "@/modules/instruction/Components/InstructionStep.vue";

import { mapGetters } from "vuex";
import { WatchersMessage } from "@/modules/watchers/lang/WatchersMessages";

export default {
    name: "WatchersPopupAdd",
    components: {
        MainCheckbox,
        MainInput,
        MainButton,
        MainPopup,
        MainTitle,
        MainDescription,
        InstructionStep,
    },
    props: {
        wait: Boolean,
        opened: Boolean,
        closed: Boolean,
        instructionConfig: Boolean,
    },
    i18n: {
        sharedMessages: WatchersMessage,
    },
    data() {
        return {
            form: {
                name: "",
                allowedRoutes: [],
            },
            allowedRoutes: [
                {
                    name: this.$t("tabs[0]"),
                    checked: true,
                    editable: false,
                    routes: [
                        "v1.sub.show",
                        "v1.statistic.show",
                        "v1.allowed-routes",
                    ],
                },
                {
                    name: this.$t("tabs[2]"),
                    checked: false,
                    editable: true,
                    routes: [
                        "v1.worker.show",
                        "v1.worker.list",
                        "v1.worker_hashrate.list",
                    ],
                },
                {
                    name: this.$t("tabs[1]"),
                    checked: false,
                    editable: true,
                    routes: ["v1.income.list", "v1.payout.list"],
                },
            ],
        };
    },
    watch: {
        "$i18n.locale"() {
            this.allowedRoutes.map(
                (route, i) => (route.name = this.$t(`tabs[${i}]`))
            );
        },
        closed(newClosedState) {
            if (newClosedState) {
                this.allowedRoutes = [
                    {
                        name: this.$t("tabs[0]"),
                        checked: true,
                        editable: false,
                        routes: [
                            "v1.sub.show",
                            "v1.statistic.show",
                            "v1.allowed-routes",
                        ],
                    },
                    {
                        name: this.$t("tabs[2]"),
                        checked: false,
                        editable: true,
                        routes: [
                            "v1.worker.show",
                            "v1.worker.list",
                            "v1.worker_hashrate.list",
                        ],
                    },
                    {
                        name: this.$t("tabs[1]"),
                        checked: false,
                        editable: true,
                        routes: ["v1.income.list", "v1.payout.list"],
                    },
                ];

                this.form = {
                    name: "",
                    allowedRoutes: [],
                };
            }
        },
    },
    methods: {
        setFormName(name) {
            this.form = {
                ...this.form,
                name: name,
            };
        },
        dropFormAllowedRoutes() {
            this.form.allowedRoutes = [];
        },
        setFormAllowedRoutes() {
            this.dropFormAllowedRoutes();
            this.allowedRoutes.forEach((route) => {
                if (route.checked)
                    this.form.allowedRoutes = [
                        ...this.form.allowedRoutes,
                        ...route.routes,
                    ];
            });

            this.$emit("createWatcher", this.form);
        },
        setAllowedRoutes(checkState, index) {
            this.allowedRoutes[index].checked = checkState;
        },
    },
    computed: {
        ...mapGetters(["errorsExpired"]),
    },
};
</script>

<style scoped>
.watchers__form {
    display: flex;
    flex-direction: column;
    gap: 80px;
    width: 100%;
}

.watcher_title {
    margin-bottom: 4px;
}

@media (max-width: 500px) {
    .watcher_title {
        font-size: 16px;
    }
}

.watchers__column {
    display: flex;
    flex-direction: column;
    gap: 40px;
}

.watchers__block {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.watchers__block-selects {
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 24px;
    border-radius: 24px;
    background: var(--background-modal-input, #2c2f34);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
}

.watchers_input {
    background: var(--background-modal-input, #2c2f34);
}

.watchers_label {
    padding: 0 16px;
    color: var(--text-teritary);
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 20px;
}

.watchers_button {
    min-height: 56px;
}
</style>

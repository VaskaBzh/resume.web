<template>
    <div class="connecting">
        <div class="connecting__wrapper">
            <main-title class="title-connecting"
                >{{ $t("connection.title") }}
            </main-title>
            <main-description class="connecting_description">
                {{ $t("connection.block.title") }}
            </main-description>
            <div class="connecting__content">
                <copy-block
                    v-for="(object, i) in copyObject"
                    :key="i"
                    :copy-object="object"
                    :instruction-config="instructionService"
                />
                <copy-row
                    :copy-object="{
                        link: `${getAccount.name}.worker_name`,
                        title: 'Worker name',
                    }"
                    class="onboarding_block"
                    :class="{
                        'onboarding_block-target':
                            instructionService.isVisible &&
                            instructionService.step === 2,
                    }"
                >
                    <template #instruction>
                        <instruction-step
                            :step_active="2"
                            :steps_count="instructionService.steps_count"
                            :step="instructionService.step"
                            :is-visible="instructionService.isVisible"
                            text="texts.connecting[1]"
                            title="titles.connecting[1]"
                            class-name="onboarding__card-right"
                            @next="instructionService.nextStep()"
                            @prev="instructionService.prevStep()"
                            @close="instructionService.nextStep(6)"
                        />
                    </template>
                </copy-row>
            </div>
            <div class="note-card">
                <connection-icon class="note_icon" />
                <span class="note-text">{{ $t("connection.note") }}</span>
            </div>
            <warning-block text="connecting_text" link="connecting_feedback" />
        </div>
    </div>
    <instruction-button
        hint="connecting"
        @openInstruction="instructionService.setStep().setVisible()"
    />
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import CopyBlock from "@/Components/technical/blocks/profile/CopyBlock.vue";
import InstructionStep from "@/modules/instruction/Components/InstructionStep.vue";
import CopyRow from "@/modules/common/Components/UI/CopyRow.vue";
import InstructionButton from "@/modules/instruction/Components/UI/InstructionButton.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescriptionOld.vue";
import ConnectionIcon from "@/modules/connecting/icons/ConnectionIcon.vue";

import { InstructionService } from "@/modules/instruction/services/InstructionService";
import { mapGetters } from "vuex";
import WarningBlock from "../../modules/common/Components/UI/WarningBlock.vue";

export default {
    components: {
        WarningBlock,
        MainDescription,
        InstructionButton,
        CopyRow,
        MainTitle,
        CopyBlock,
        InstructionStep,
        ConnectionIcon,
    },
    data() {
        return {
            viewportWidth: 0,
            instructionService: new InstructionService(),
        };
    },
    async created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    methods: {
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
    },
    computed: {
        ...mapGetters(["allAccounts", "getAccount"]),
        copyObject() {
            return [
                {
                    copyObject: [
                        { link: "btc.all-btc.com:4444", title: "Port1" },
                        { link: "btc.all-btc.com:3333", title: "Port 2" },
                        { link: "btc.all-btc.com:2222", title: "Port 3" },
                    ],
                },
            ];
        },
    },
    watch: {
        "$i18n.locale"() {
            document.title = this.$t("header.links.connecting");
        },
    },
    mounted() {
        this.instructionService.setStepsCount(2);
        document.title = this.$t("header.links.connecting");
    },
};
</script>
<style lang="scss" scoped>
.title-connecting {
    margin-bottom: 4px;
    color: var(--text-primary, #1d2939);
    font-family: Unbounded, serif;
    font-size: 20px;
    font-style: normal;
    font-weight: 400;
    line-height: 32px;
}

.note-card {
    border-radius: 12px;
    background: var(--background-island-inner-1, #f5faff);
    padding: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-top: 40px;
    margin-bottom: 16px;
}

.note_icon {
    width: 24px;
    height: 24px;
    min-width: 24px;
}

.note-text {
    color: var(--primary-400, #53b1fd);
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 145%; /* 20.3px */
}

@media (max-width: 500px) {
    .note-text {
        font-size: 12px;
        line-height: 16px;
    }
    .note-card {
        margin-top: 32px;
    }
}

.connecting {
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 1 1 auto;

    &_description {
        color: var(--text-teritary, #98a2b3);
        font-family: NunitoSans, serif;
        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
        margin-bottom: 40px;
    }

    &__content {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    // .connecting_question
    &__question {
        width: 100%;
        min-height: 68px;
        padding: 12px 20px;
        border-radius: 21px;
        background-color: #fff;
        display: flex;
        align-items: center;
        @media (max-width: 767.98px) {
            padding: 12px;
        }

        &_wrap {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            margin-right: 16px;
            background-color: rgba(194, 213, 242, 0.61);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            @media (max-width: 767.98px) {
                margin-right: 10px;
            }
        }

        &_title {
            font-weight: 700;
            font-family: AmpleSoftPro, serif;
            font-size: 18px;
            line-height: 21px;
            color: #000000;
            margin-bottom: 8px;
            @media (max-width: 767.98px) {
                margin: 0;
                font-size: 16px;
                line-height: 20px;
            }
        }

        &_text {
            font-weight: 400;
            line-height: 21px;
            @media (max-width: 767.98px) {
                font-size: 16px;
                line-height: 16px;
            }
        }
    }

    // .connecting__wrapper
    &__wrapper {
        border-radius: 24px;
        background: var(--background-island);
        box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
        width: 560px;
        padding: 32px 40px;
        @media (max-width: 767.98px) {
            margin: 0 16px;
            padding: 16px;
        }
    }

    &__select {
        max-width: 280px !important;
        height: 40px;
        @media (max-width: 767.98px) {
            margin: 6px 0 0;
            max-width: 100% !important;
            height: 38px;
        }
    }
}
</style>

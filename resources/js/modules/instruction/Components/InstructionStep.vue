<template>
    <teleport to="body">
        <div
            v-if="isVisible && step_active === step"
            class="onboarding"
            @click="$emit('next')"
        ></div>
    </teleport>
    <div
        v-if="isVisible && step_active === step"
        class="onboarding__card"
        :class="className"
    >
        <instruction-title :title="$t(title)" />
        <instruction-nav
            :step="step"
            :steps_count="steps_count"
            @next="$emit('next')"
            @prev="$emit('prev')"
            @close="$emit('close')"
        />
        <instruction-text :text="$t(text)" />
    </div>
</template>

<script>
import InstructionTitle from "@/modules/instruction/Components/UI/InstructionTitle.vue";
import InstructionNav from "@/modules/instruction/Components/UI/InstructionNav.vue";
import InstructionText from "@/modules/instruction/Components/UI/InstructionText.vue";
import { InstructionMessage } from "@/modules/instruction/lang/InstructionMessage";

export default {
    name: "InstructionStep",
    components: {
        InstructionText,
        InstructionNav,
        InstructionTitle,
    },
    i18n: {
        sharedMessages: InstructionMessage,
    },
    props: {
        className: String,
        title: String,
        text: String,
        step: Number,
        step_active: Number,
        steps_count: Number,
        isVisible: Boolean,
    },
    mounted() {
        if (this.isVisible) {
            this.$emit("start");
        }
    },
};
</script>

<style lang="scss">
.onboarding {
    position: fixed;
    height: 100vh;
    width: 100vw;
    top: 0;
    left: 0;
    z-index: 98;
    background: rgba(0, 0, 0, 0.5);
    cursor: pointer;

    @media (max-height: 1000px) {
        display: none;
    }

    @media (max-width: 1279.98px) {
        display: none;
    }

    &_block {
        transition: all 0.5s ease 0s;
        border-width: 2px;
        border-style: dashed;
        border-color: transparent;

        @media (max-height: 1000px) {
            border-width: 0;
        }

        @media (max-width: 1279.98px) {
            border-width: 0;
        }

        &-target {
            border-radius: 24px;
            border-color: var(--text-focus, #2e90fa);
            z-index: 1001;
            position: relative;

            @media (max-height: 1000px) {
                border-color: transparent;
            }

            @media (max-width: 1279.98px) {
                border-color: transparent;
            }
        }
    }

    &__card {
        border-radius: 16px;
        background: var(--background-datepicker, #2c2f34);
        box-shadow: 0 2px 12px -1px rgba(16, 24, 40, 0.08);
        padding: 8px;
        min-width: 436px;
        position: absolute;
        z-index: 1002;
        max-width: 420px;

        @media (max-height: 1000px) {
            display: none;
        }

        @media (max-width: 1279.98px) {
            display: none;
        }

        &-left {
            top: 50%;
            transform: translateY(-50%);
            left: calc(100% + 12px);
        }

        &-top {
            top: calc(100% + 12px);
            transform: translateX(-50%);
            left: 50%;
        }

        &-right {
            top: 50%;
            transform: translateY(-50%);
            right: calc(100% + 12px);
        }

        &-bottom {
            bottom: calc(100% + 12px);
            transform: translateX(-50%);
            left: 50%;
        }
    }
}
</style>

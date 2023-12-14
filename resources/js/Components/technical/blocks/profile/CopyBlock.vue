<template>
    <div
        class="copy__block onboarding_block"
        :class="{
            'onboarding_block-target':
                instructionConfig.isVisible && instructionConfig.step === 1,
        }"
    >
        <copy-row
            v-for="(copy, i) in copyObject.copyObject"
            :key="i"
            :copy-object="copy"
        />

        <instruction-step
            :step_active="1"
            :steps_count="instructionConfig.steps_count"
            :step="instructionConfig.step"
            :is-visible="instructionConfig.isVisible"
            text="texts.connecting[0]"
            title="titles.connecting[0]"
            class-name="onboarding__card-right"
            @next="instructionConfig.nextStep()"
            @prev="instructionConfig.prevStep()"
            @close="instructionConfig.nextStep(6)"
        />
    </div>
</template>

<script>
import CopyRow from "@/modules/common/Components/UI/CopyRow.vue";
import InstructionStep from "@/modules/instruction/Components/InstructionStep.vue";

export default {
    name: "CopyBlock",
    components: {
        CopyRow,
        InstructionStep,
    },
    props: {
        copyObject: Object,
        instructionConfig: Object,
    },
};
</script>

<style scoped lang="scss">
.onboarding_block {
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    transition: none;
}
.onboarding_block-target {
    background: var(--background-island);
}
@media (max-width: 500px) {
    .connecting-description {
        font-size: 12px;
        line-height: 16px;
    }
}
.copy {
    &__block {
        display: flex;
        flex-direction: column;
        gap: 16px;
        flex: 1 1 auto;
        @media (max-width: 500px) {
            gap: 8px;
        }
        //@media (max-width: 767.98px) {
        //.connecting__row {
        //    &:first-child {
        //        margin-bottom: -16px;
        //    }
        //}
        //&:last-child {
        //    gap: 6px;
        //    .connecting__row {
        //        flex-direction: row;
        //        margin-top: 6px;
        //        margin-bottom: 0 !important;
        //    }
        //}
        //}
    }
}
</style>

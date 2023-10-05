<template>
    <div class="button" @click="$emit('openInstruction')">
        <div class="button__block">
            <div class="button_hint">
                {{ hint }}
            </div>
            <info-icon
                class="button_icon"
            />
        </div>
    </div>
</template>

<script>
import InfoIcon from "@/modules/instruction/icons/InfoIcon.vue";

export default {
    name: "instruction-button",
    components: {
        InfoIcon
    },
    props: {
        hint: String,
    }
}
</script>

<style scoped>
.button {
    filter: drop-shadow(0px 10px 10px rgba(0, 0, 0, 0.10));
    backdrop-filter: blur(6px);
    background: var(--background-tooltip, rgba(44, 47, 52, 0.90));
    position: fixed;
    width: 48px;
    height: 48px;
    right: 32px;
    bottom: 16px;
    display: none;
    border-radius: 50%;
    cursor: pointer;
}
@media (min-width: 1279.98px) {
    .button {
        display: flex;
    }
}
.button__block {
    width: 100%;
    height: 100%;
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.button__block:hover .button_hint {
    transform: translateY(-50%) scale(1);
    opacity: 1;
}
.button_hint {
    position: absolute;
    right: calc(100% + 8px);
    top: 50%;
    transform: translateY(-50%) scale(0);
    opacity: 0;
    min-height: 40px;
    display: inline-flex;
    align-items: center;
    padding: 4px 12px;
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    border: 1px solid var(--background-tooltip, rgba(44, 47, 52, 0.90));
    background: var(--background-tooltip, rgba(44, 47, 52, 0.90));
    color: var(--text-secondary, #C5C8CD);
    font-family: NunitoSans, serif;
    font-size: 12px;
    font-weight: 600;
    line-height: 16px;
    transition: all 0.3s ease 0s;
    transform-origin: right center;
    width: fit-content;
    white-space: nowrap;
}
.button_icon {
    fill: var(--text-focus, #2E90FA);
    width: 24px;
    height: 24px;
}
</style>

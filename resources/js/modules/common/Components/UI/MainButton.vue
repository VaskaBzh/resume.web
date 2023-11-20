<template>
    <button
        class="button"
        :class="{
            'button-icon': !$slots.text && $slots.svg,
            'button-disabled': !!wait,
        }"
        :type="{
            button: !!wait,
            submit: !wait,
        }"
        :disabled="!!wait"
    >
        <span v-show="$slots.text && !wait" class="button_text">
            <slot name="text" />
        </span>
        <span v-show="$slots.svg && !wait" class="button_icon">
            <slot name="svg" />
        </span>
        <span v-show="wait" class="button_icon button_icon-wait">
            <main-icon class="icon-md" name="cabinet-wait" />
        </span>
    </button>
</template>

<script>
import MainIcon from "@/modules/common/icons/MainIcon.vue";

export default {
    name: "MainButton",
    components: { MainIcon },
    props: {
        wait: {
            type: Boolean,
            default: false,
        },
    },
};
</script>

<style scoped>
@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.button {
    width: fit-content;
    border-radius: 12px;
    background: var(--buttons-primary-fill-border-default, #2e90fa);
    box-shadow: 0px 0px 1px 0px rgba(0, 0, 0, 0.4),
        0px 8px 24px -6px rgba(0, 0, 0, 0.16);
    border: none;
    outline: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: var(--buttons-primary-text, var(--main-gohan, #fff));
    padding: 0 16px;
    font-family: NunitoSans, serif;
    font-size: clamp(16px, 3vw, 18px);
    line-height: 32px;
}

.button-xl {
    min-height: 56px;
    font-weight: 700;
}

.button-lg {
    min-height: 48px;
    font-weight: 600;
}

.button-md {
    min-height: 40px;
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
}

.button-sm {
    min-height: 32px;
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
    border-radius: 8px;
}

.button-xs {
    min-height: 24px;
    font-size: 12px;
    font-weight: 600;
    line-height: 16px;
    border-radius: 8px;
}

.button-sm .button_icon,
.button-xs .button_icon {
    width: 16px;
    height: 16px;
}

.button-icon.button-lg {
    padding: 0 12px;
}

.button-icon.button-md {
    padding: 0 8px;
}

.button-icon.button-sm {
    padding: 0 8px;
}

.button-icon.button-xs {
    padding: 0 4px;
}

.button_icon {
    width: 24px;
    height: 24px;
    stroke: none;
    fill: var(--buttons-primary-text, var(--main-gohan, #fff));
}

.button_icon-wait {
    animation: rotate 1s linear 0s infinite;
    transform-origin: center;
}

.button-stroke .button_icon {
    fill: none;
    stroke: var(--buttons-primary-text, var(--main-gohan, #fff));
}

.button-red {
    background: var(--buttons-delete-fill-border-default, #f1404a);
    color: var(--buttons-delete-text, var(--main-gohan, #fff));
}

.button-red .button_icon {
    stroke: none;
    fill: var(--buttons-delete-text, var(--main-gohan, #fff));
}

.button-red.button-stroke .button_icon {
    fill: none;
    stroke: var(--buttons-delete-text, var(--main-gohan, #fff));
}

.button-reverse {
    background: transparent;
    border: 1px solid var(--buttons-stroke-border-default, #98a2b3);
    color: var(--buttons-stroke-text, #475467);
}

.button-reverse .button_icon {
    stroke: none;
    fill: var(--buttons-stroke-text, #475467);
}

.button-reverse.button-stroke .button_icon {
    stroke: var(--buttons-stroke-text, #475467);
    fill: none;
}

.button-ghost {
    background: transparent;
    border: none;
    color: var(--buttons-ghost-text-default, #53b1fd);
}

.button-ghost .button_icon {
    stroke: none;
    fill: var(--buttons-ghost-text-default, #53b1fd);
}

.button-ghost.button-stroke .button_icon {
    stroke: var(--buttons-ghost-text-default, #53b1fd);
    fill: none;
}

.button-white {
    background: var(--background-island, #fff);
    box-shadow: 0 2px 12px -5px rgba(16, 24, 40, 0.02);
    color: var(--icons-primary, #98a2b3);
    min-width: 72px;
}

.button-white .button_icon {
    stroke: none;
    fill: var(--icons-primary, #98a2b3);
}

.button-white.button-stroke .button_icon {
    stroke: var(--icons-primary, #98a2b3);
    fill: none;
}

.button-cross {
    background: transparent;
}

.button-cross .button_icon {
    stroke: none;
    fill: var(--icons-secondary, #d0d5dd);
}

.button-cross.button-stroke .button_icon {
    stroke: var(--icons-secondary, #d0d5dd);
    fill: none;
}

.button-full {
    min-width: 100%;
}

.button-disabled {
    opacity: 0.5;
}
</style>

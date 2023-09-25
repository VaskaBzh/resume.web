<template>
    <button class="button">
        <span class="button_icon" v-show="$slots.svg">
            <slot name="svg" />
        </span>
        <slot name="text" />
    </button>
</template>

<script>
export default {
    name: "main-button",
};
</script>

<style scoped>
.button {
    min-width: 80px;
    width: fit-content;
    min-height: 40px;
    border-radius: 12px;
    background: var(--background-island, #fff);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    border: none;
    outline: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #2e90fa;
    padding: 0 16px;
}
.button-blue {
    background: var(--old-primary-500, #2e90fa);
    color: var(--buttons-primary-text, var(--main-gohan, #fff));
    box-shadow: 0px 10px 10px -6px rgba(0, 0, 0, 0.1);
}
.button-red {
    background: var(--old-light-red-100, #f1404a);
    color: var(--buttons-delete-text, var(--main-gohan, #fff));
    box-shadow: 0px 0px 1px 0px rgba(0, 0, 0, 0.4),
        0px 8px 24px -6px rgba(0, 0, 0, 0.16);
}
.button-blue .button_icon,
.button-red .button_icon {
    stroke: var(--background-island, var(--background-island, #fff));
}
.button-reverse {
    background: transparent;
    border: 1px solid var(--old-light-gray-400, #98a2b3);
    color: var(--buttons-stroke-text, #475467);
}
.button-reverse .button_icon {
    stroke: var(--old-light-gray-600, #475467);
}
.button-md {
    min-width: 220px;
}
.button-full {
    min-width: 100%;
}
.button_icon {
    width: 24px;
    height: 24px;
    stroke: #2e90fa;
}
</style>

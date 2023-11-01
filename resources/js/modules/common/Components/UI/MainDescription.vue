<template>
    <p class="text">
        <slot />
    </p>
</template>

<script>
export default {
    name: "MainDescription",
};
</script>

<style scoped lang="scss">
.text {
    color: var(--text-teritary, #6f7682);
    font-family: NunitoSans, serif;
    font-size: adaptive-value(12px, 16px);
    font-weight: 400;
    line-height: adaptive-value(16px, 18px);
}

.text-warning {
    color: var(--status-waiting, #ffb868);
}

.text-md {
    font-size: adaptive-value(12px, 14px);
    line-height: adaptive-value(16px, 20px);
}
</style>

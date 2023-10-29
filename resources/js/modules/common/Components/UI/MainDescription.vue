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

<style scoped>
.text {
    color: var(--text-teritary, #6f7682);
    font-family: NunitoSans, serif;
    font-size: clamp(12px, 5vw, 16px);
    font-weight: 400;
    line-height: clamp(16px, 2vw, 24px);
}

.text-warning {
    color: var(--status-waiting, #ffb868);
}

.text-md {
    font-size: clamp(12px, 1vw, 14px);
    line-height: clamp(16px, 1vw, 20px);
}
</style>

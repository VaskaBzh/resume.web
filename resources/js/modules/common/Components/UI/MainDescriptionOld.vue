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
    color: var(--old-light-gray-400, #98a2b3);
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 20px;
}
</style>

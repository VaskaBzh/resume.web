<template>
    <span class="tag">
        <slot />
    </span>
</template>

<script>
export default {
    name: "watcher-tag"
}
</script>

<style scoped>
.tag {
    border-radius: 8px;
    background: var(--old-primary-4007, rgba(83, 177, 253, 0.07));
    min-height: 32px;
    padding: 0 8px;
    color: var(--old-primary-400, #53B1FD);
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
</style>

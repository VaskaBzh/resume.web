<template>
    <div
        class="block cabinet__block cabinet__block-card cabinet__block-light"
    >
        <span class="block_name">
            {{ name }}
        </span>
        <div class="block__tags">
            <watcher-tag v-for="(tag, i) in tags" :key="i" :tag="tag" />
        </div>
    </div>
</template>

<script>
import WatcherTag from "@/modules/watchers/Components/UI/WatcherTag.vue";

export default {
    name: "watcher-block",
    props: {
        name: String,
        tags: Array,
    },
    components: {
        WatcherTag,
    },
};
</script>

<style scoped lang="scss">
.block {
    display: flex;
    flex-direction: column;
    gap: 16px;
    cursor: pointer;
}
.block_name {
    color: var(--old-light-gray-500, #667085);
    font-family: Unbounded, serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 24px;
}
.block__tags {
    display: flex;
    gap: 8px;
}
</style>

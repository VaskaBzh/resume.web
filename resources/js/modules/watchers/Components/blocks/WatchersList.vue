<template>
    <div class="list">
        <watcher-block
            v-for="(block, i) in blocks"
            :key="i"
            :name="block.name"
            :tags="block.tags"
            @click="$emit('getWatcher', block.id)"
        />
    </div>
</template>

<script>
import WatcherBlock from "@/modules/watchers/Components/WatcherBlock.vue";

export default {
    name: "watchers-list",
    components: {
        WatcherBlock,
    },
    props: {
        blocks: Array,
    },
};
</script>

<style scoped>
.list {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
</style>

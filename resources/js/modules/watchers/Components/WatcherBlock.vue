<template>
    <div class="block cabinet__block cabinet__block-card cabinet__block-light">
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
    position: relative;
}
.block::before {
    content: "";
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    transition: all 0.5s ease 0s;
    background: transparent;
    border-radius: 0px 4px 4px 0px;
    width: 3px;
    height: 48px;
}
.block_name {
    color: var(--text-teritary, #6f7682);
    font-family: Unbounded, serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 24px;
    transition: all 0.5s ease 0s;
}
.block__tags {
    display: flex;
    gap: 8px;
}
.list_block-active .block_name {
    color: var(--text-focus, #2e90fa);
}
.list_block-active::before {
    background: var(--text-focus, #2e90fa);
}
</style>

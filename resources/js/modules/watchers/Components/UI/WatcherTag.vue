<template>
    <span class="tag" v-show="tagName">
        {{ tagName }}
    </span>
</template>

<script>
import { WatchersMessage } from "@/modules/watchers/lang/WatchersMessages";

export default {
    name: "watcher-tag",
    props: {
        tag: String,
    },
    i18n: {
        sharedMessages: WatchersMessage,
    },
    computed: {
        tagName() {
            const tagsNames = {
                "v1.sub.show":  this.$t('tabs[0]'),
                "v1.worker.list": this.$t('tabs[2]'),
                "v1.income.list": this.$t('tabs[1]'),
            };

            return tagsNames[this.tag];
        },
    },
};
</script>

<style scoped>
.tag {
    border-radius: 8px;
    background: var(--old-primary-4007, rgba(83, 177, 253, 0.07));
    min-height: 32px;
    padding: 0 8px;
    color: var(--old-primary-400, #53b1fd);
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
</style>

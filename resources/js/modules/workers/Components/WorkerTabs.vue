<template>
    <div class="tabs">
        <div
            class="tab"
            v-for="(tab, i) in tabs"
            :key="i"
            :class="{
                'tab-active': tab.value === active_tab
            }"
            @click="$emit('changeStatus', tab.value)"
        >
            {{ $t(tab.name) }} ({{tab.count ?? 0}})
        </div>
    </div>
</template>

<script>
import { WorkerMessages } from "@/modules/workers/lang/WorkerMessages";

export default {
    name: "worker-tabs",
    props: {
        tabs: Array,
        active_tab: String,
    },
    i18n: {
        sharedMessages: WorkerMessages,
    },

}
</script>

<style scoped>
.tabs {
    display: flex;
    min-height: 40px;
    width: 100%;
    background: transparent;
}
.tab {
    height: 100%;
    padding: 4px 12px;
    width: fit-content;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: var(--buttons-tabs-text-default);
    transition: all 0.5s ease 0s;
    border-radius: 12px;
    background: transparent;
    cursor: pointer;
	min-width: 48px;
}
.tab:hover {
    color: var(--text-focus, #2E90FA);
}
.tab-active {
    color: var(--text-focus, #2E90FA);
    background: var(--buttons-tabs-fill-border-focus, #FFF);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
}
</style>

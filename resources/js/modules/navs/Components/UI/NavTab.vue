<template>
    <router-link
        :to="{
            name: tab.name,
            query: {
                access_key: $route?.query?.access_key,
                puid: $route?.query?.puid,
            },
        }"
        class="tab"
        :class="{
            burger_link: viewportWidth < 991.98,
            'tab-active': $route.path.startsWith(tab.url),
        }"
        :target="this.tab.name === 'faq' ? '_blank':''"
    >
        <div class="tab_icon" v-html="tab.icon"></div>
        <span class="tab_text">
            {{ $t(`tabs.${tab.translateKey}`) }}
        </span>
    </router-link>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "NavTab",
    props: {
        tab: Object,
    },
    computed: {
        ...mapGetters(["viewportWidth"]),
    },
};
</script>

<style>
.tab {
    width: 100%;
    display: inline-flex;
    align-items: center;
    padding: 0 16px;
    min-height: 40px;
    transition: all 0.5s ease 0s;
    border-radius: 12px;
    background: transparent;
    gap: 16px;
}
.tab:hover,
.tab-active {
    background: var(--primary-4007, rgba(83, 177, 253, 0.07));
}
.tab_text {
    color: var(--text-secondary, #475467);
    font-family: NunitoSans, serif;
    font-size: 18px;
    font-weight: 400;
    line-height: 32px;
    transition: all 0.5s ease 0s;
}
.tab_icon,
.tab_icon svg {
    width: 24px;
    height: 24px;
}
.tab_icon-stroke {
    fill: none;
    stroke: var(--text-teritary);
}
.tab_icon-fill {
    fill: var(--text-teritary);
    stroke: none;
}
.tab:hover .tab_text,
.tab-active .tab_text {
    color: var(--primary-500, #2e90fa);
}
.tab:hover .tab_icon-fill,
.tab-active .tab_icon-fill {
    fill: var(--primary-500, #2e90fa);
}
.tab:hover .tab_icon-stroke,
.tab-active .tab_icon-stroke {
    stroke: var(--primary-500, #2e90fa);
}
</style>

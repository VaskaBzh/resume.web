<template>
    <div class="cabinet__buttons">
        <button
            class="cabinet_button"
            :key="tab.title + i"
            v-for="(tab, i) in tabs"
            :class="{
                active: activeCondition(tab)
            }"
            @click="activeCondition(tab)
                ? null
                : $emit('getValue', tab.value)"
        >
            {{ tab.title }}
        </button>
    </div>
</template>pp

<script>
export default {
    name: "main-tabs",
    props: {
        tabs: Array,
        active: Number,
    },
    methods: {
        activeCondition(tab) {
            return (tab.value?.length
                ? tab.value[tab.value.length - 1]
                : tab.value) === this.active;
        }
    }
};
</script>

<style scoped lang="scss"></style>

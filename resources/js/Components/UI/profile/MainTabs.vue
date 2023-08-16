<template>
    <div class="cabinet__buttons">
        <button
            class="cabinet_button"
            :key="tab.title + i"
            v-for="(tab, i) in tabs"
            :class="{ active: tab.value === active }"
            @click="$emit('getValue', tab.value)"
        >
            {{ tab.title }}
        </button>
    </div>
</template>

<script>
export default {
    name: "main-tabs",
    props: {
        tabs: Array,
        active: Number,
    },
};
</script>

<style scoped lang="scss"></style>

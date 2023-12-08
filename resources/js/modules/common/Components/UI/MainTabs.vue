<template>
    <div class="cabinet__buttons">
        <button
            class="cabinet_button referal-btns"
            v-for="(tab, i) in tabs"
            :key="tab.title"
            :class="{
                active:
                    (tab.value?.length
                        ? tab.value[tab.value.length - 1]
                        : tab.value) === active,
            }"
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

<style scoped lang="scss">
@media (max-width: 499.98px) {
    .referal-btns {
        font-size: 12px;
        font-style: normal;
        font-weight: 600;
        line-height: 16px;
        padding: 10px 12px;
        height: 32px;
        flex: 1;
    }
}

</style>

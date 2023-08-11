<template>
    <div class="calculator__tabs">
        <button
            v-for="(tab, i) in tabs"
            :key="i"
            @click.prevent="$emit('getDate', tab.value)"
            class="calculator_tab"
            :class="{ 'calculator_tab-active': activeValue === tab.value }"
        >
            {{ tab.name }}
        </button>
    </div>
</template>

<script>
export default {
    name: "calculator-tabs",
    props: {
        tabs: Array,
        activeValue: Number,
    },
};
</script>

<style scoped lang="scss">
.calculator {
    &__tabs {
        display: flex;
        align-items: center;
        gap: 8px;
        height: 36px;
        border-radius: 16px;
        background: rgba(#ffffff, 0.2);
        flex-wrap: nowrap;
    }
    &_tab {
        height: 100%;
        border-radius: 16px;
        border: 1px solid transparent;
        transition: all 0.5s ease 0s;
        color: rgba(255, 255, 255, 0.6);
        font-size: 18px;
        font-weight: 400;
        line-height: 28px;
        letter-spacing: 0.35px;
        width: 100%;
        background: transparent;
        &-active,
        &:hover {
            border-color: #fff;
            color: #fff;
        }
    }
}
</style>

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
        height: 44px;
        border-radius: 16px;
        background: rgba(#ffffff, 0.2);
        flex-wrap: nowrap;
    }
    &_tab {
        height: 100%;
        border-radius: 16px;
        border: 1px solid transparent;
        transition: all 0.5s ease 0s;
        color: var(--gray-370, rgba(208, 213, 221, 0.70));
        text-align: center;
        text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
        font-family: NunitoSans;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: 110%; /* 22px */
        width: 250px;
        background: transparent;
        @media(max-width: 890px){
            width: 164px;
            font-size: 18px;
        }
        @media(max-width: 550px){
            width: 33%;
            font-size: 12px;
        }
        &-active,
        &:hover {
            border-color: #D0D5DD;
            color: #D0D5DD;
        }
    }
}
</style>

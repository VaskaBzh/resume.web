<template>
    <div class="cabinet__block cabinet__block-light cabinet__block-card card" :class="[page == 'worker' ? 'max-width' : '']">
        <div class="card_svg" v-if="this.$slots.svg">
            <slot name="svg"></slot>
        </div>
        <div class="card__content">
            <main-title class="headline">
                {{ title }}
            </main-title>
            <p class="card_num">
                {{ value }}
                <span class="card_unit" v-show="unit">
                {{ unit }}
            </span>
            </p>
        </div>
    </div>
</template>
<script>
import MainTitle from "./MainTitle.vue";

export default {
    props: {
        title: String,
        value: String,
        unit: String,
        page: String,
    },
    components: {
        MainTitle,
    }
};
</script>
<style scoped>
.card {
    display: flex;
    flex-wrap: nowrap;
    align-items: center;
}
.max-width{
    width: 48%;
}
.card_svg {
    margin-right: 24px;
}
.card__content {
    display: flex;
    flex-direction: column;
    gap: 4px;
}
.card-active .card_num {
    color: var(--light-green-100, #1FB96C);
}
.card-in-active .card_num {
    color: var(--light-red-100, #F1404A);
}
.card_num {
    color: var(--light-gray-800, #1D2939);
    font-family: Unbounded, serif;
    font-size: 41px;
    font-weight: 400;
    line-height: 137%;
    display: inline-flex;
    gap: 8px;
    align-items: flex-end;
    opacity: 0.8;
}
.card_unit {
    color: var(--light-gray-300, #D0D5DD);
    font-family: Unbounded, serif;
    font-size: 27px;
    font-weight: 400;
    line-height: 147%;
}

</style>

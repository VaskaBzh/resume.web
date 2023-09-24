<template>
    <div class="button" @click="$emit('swipe', direction)">
        <swipe-icon class="button__icon" :class="{
            'button__icon-rotate': !direction
         }" />
    </div>
</template>

<script>
import SwipeIcon from "@/modules/slider/icons/SwipeIcon.vue";

export default {
    name: "slider-swipe",
    props: {
        direction: Boolean,
    },
    components: {
        SwipeIcon
    }
}
</script>

<style scoped>
.button {
    cursor: pointer;
    height: 32px;
    width: 32px;
    border-radius: 8px;
    background: transparent;
    transition: all 0.5s ease 0s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.button:hover {
    background: var(--old-primary-4007, rgba(83, 177, 253, 0.07));
}
.button__icon {
    stroke: #98A2B3;
}
.button__icon-rotate {
    transform: rotate(180deg);
}
</style>

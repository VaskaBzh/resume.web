<template>
    <component class="text" :is="tag ?? 'div'">
        <slot/>
    </component>
</template>

<script>
export default {
    name: "landing-text",
    props: {
        tag: String,
    },
};
</script>

<style scoped>
.text {
    color: var(--gray-170, rgba(245, 250, 255, 0.7));
    text-shadow: 0 4px 7px rgba(14, 14, 14, 0.05);
    font-family: NunitoSans, serif;
    font-size: clamp(18px, 5vw, 20px);
    font-weight: 400;
    line-height: 110%;
    text-transform: none;
}

.text-gray-140 {
    color: var(--gray-140, rgba(245, 250, 255, 0.4));
}

.text-gray-360 {
    color: var(--gray-360, rgba(208, 213, 221, 0.6));
}
</style>

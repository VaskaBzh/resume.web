<template>
    <component :is="tag" class="title title-h1">
        <slot/>
    </component>
</template>

<script>
export default {
    name: "landing-title",
    props: {
        tag: String,
    },
};
</script>

<style scoped>
.title {
    color: var(--gray-1100, #f5faff);
    text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
    font-family: Unbounded, serif;
    text-transform: uppercase;
}

.title-h1 {
    font-size: clamp(32px, 10vw, 110px);
    font-weight: 600;
    line-height: 100%;
}

.title-h2 {
    font-size: clamp(28px, 10vw, 65px);
    font-weight: 400;
    line-height: 120%;
}

.title-h3 {
    font-size: clamp(30px, 10vw, 46px);
    font-weight: 600;
    line-height: 120%;
}

.title-h4 {
    font-size: clamp(32px, 10vw, 110px);
    font-weight: 600;
    line-height: 100%;
}
</style>

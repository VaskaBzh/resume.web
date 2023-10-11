<template>
    <h1 v-if="tag === 'h1'" class="title title-h1">
        <slot></slot>
    </h1>
    <h2 v-else-if="tag === 'h2'" class="title title-h2">
        <slot></slot>
    </h2>
    <h3 v-else-if="tag === 'h3'" class="title title-h3">
        <slot></slot>
    </h3>
    <h4 v-else-if="tag === 'h4'" class="title title-h4">
        <slot></slot>
    </h4>
    <div v-else class="title">
        <slot></slot>
    </div>
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
    font-size: 110px;
    font-weight: 600;
    line-height: 100%;
}

.title-h2 {
    font-size: 65px;
    font-weight: 400;
    line-height: 120%;
}

.title-h3 {
    font-size: 46px;
    font-weight: 600;
    line-height: 120%;
}

.title-h4 {
    font-size: 110px;
    font-weight: 600;
    line-height: 100%;
}
</style>

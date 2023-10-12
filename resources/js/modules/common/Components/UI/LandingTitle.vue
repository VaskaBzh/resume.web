<template>
    <component :is="tagHtml" class="title title-h1">
        <slot></slot>
    </component>
</template>

<script>
export default {
    name: "landing-title",
    props: {
        tag: String,
    },
    computed: {
        tagHtml() {
            return document.createElement(this.tag ?? "div");
        },
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

<template>
    <div class="title">
        <slot />
    </div>
</template>

<script>
export default {
    name: "MainTitle",
    props: {
        tag: String,
    },
};
</script>
<style scoped lang="scss">

.title {
    color: var(--text-primary, #1d2939);
    font-family: Unbounded, serif;
    font-size: 20px;
    font-weight: 400;
    line-height: 32px;
}

.title-popup {
    font-size: adaptive-value(16px, 20px);
    line-height: adaptive-value(24px, 32px);
}

.title-mobile {
    display: none;
}

@media (max-width: 768.98px) {
    .title-mobile {
        display: block;
    }
}

.title.headline,
.title-headline {
    color: var(--text-teritary, #98a2b3);
    font-family: NunitoSans, serif;
    font-size: adaptive-value(12px, 14px);
    font-weight: 600;
    line-height: adaptive-value(16px, 20px);
}
</style>

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
    &-profile {
        @media (min-width: $mobile) {
            display: none;
        }
    }
}

.title-popup {
    font-size: clamp(16px, 5vw, 20px);
    line-height: clamp(24px, 5vw, 32px);
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
    color: var(--text-teritary);
    font-family: NunitoSans, serif;
    font-size: clamp(12px, 5vw, 14px);
    font-weight: 600;
    line-height: clamp(16px, 5vw, 20px);
}
</style>

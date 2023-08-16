<template>
    <div class="referral_content">
        <div class="cabinet__block cabinet__block-light"></div>
        <div
            class="cabinet__block cabinet__block-light referral__block referral__block-full"
        ></div>
        <div class="cabinet__block cabinet__block-light"></div>
        <div class="cabinet__block cabinet__block-light"></div>
    </div>
</template>

<script>
export default {
    name: "cabinet-view",
};
</script>

<style scoped lang="scss">
.referral {
    &_content {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(3, 1fr);
        gap: 16px;
        @media (max-width: $mobile) {
            gap: 8px;
        }
    }
    &__block {
        &-full {
            grid-row: 1/3;
            grid-column: 2/3;
        }
    }
}
</style>

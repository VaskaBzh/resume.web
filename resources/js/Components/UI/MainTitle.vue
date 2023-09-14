<template>
    <h1 v-if="tag === 'h1'" class="title">
        <slot></slot>
    </h1>
    <h2 v-else-if="tag === 'h2'" class="title">
        <slot></slot>
    </h2>
    <h3 v-else-if="tag === 'h3'" class="title">
        <slot></slot>
    </h3>
    <h4 v-else-if="tag === 'h4'" class="title">
        <slot></slot>
    </h4>
    <div v-else class="title">
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: "main-title",
    props: {
        tag: String,
    },
};
</script>
<style lang="scss" scoped>
*{
}
h1 {
    font-weight: 500;
    font-size: 64px;
    line-height: 107.6%;
    @media (max-width: 991.98px) {
        font-size: 56px;
        line-height: 100%;
    }
    @media (max-width: 767.98px) {
        font-size: 40px;
        line-height: 100%;
    }
}

h2 {
    font-weight: 500;
    font-size: 56px;
    line-height: 105%;
    @media (max-width: 767.89px) {
        font-size: 40px;
    }
    @media (max-width: 479.89px) {
        font-size: 28px;
    }
}

h3 {
    color: var(--light-gray-800, #1D2939);
    font-size: 20px;
    font-style: normal;
    font-weight: 400;
    line-height: 160%; /* 32px */
    @media (max-width: 767.98px) {
        font-size: 32px;
    }
    @media (max-width: 479.98px) {
        font-size: 24px;
    }
}

h4 {
    font-weight: 500;
    font-size: 24px;
    line-height: 107.6%;
    @media (max-width: 767.98px) {
        font-size: 18px;
        line-height: 135%;
    }
}
.title {
    font-family: Unbounded;
    font-style: normal;
    color: var(--light-gray-800, #1D2939);
    &.profile {
        margin: 0 0 40px;
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: space-between;
    }
    &-blue {
        color: #3f7bdd;
    }
    &-white {
        color: #ffffff;
    }
    &.headline {
        font-weight: 500;
        font-size: 24px;
        line-height: 115%;
        color: #545454;
        @media (max-width: 767.98px) {
            font-size: 20px;
        }
        @media (max-width: 479.98px) {
            font-size: 18px;
        }
    }
}
</style>

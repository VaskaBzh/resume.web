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
h1 {
    font-size: 64px;
    font-style: normal;
    font-weight: 500;
    line-height: 107.6%;
    @media (max-width: 479.98px) {
        font-size: 36px;
    }
}

h2 {
    font-size: 56px;
    font-style: normal;
    font-weight: 500;
    line-height: 105%;

    @media (max-width: 479.98px) {
        font-size: 36px;
    }

}

h3 {
    font-size: 20px;
    font-style: normal;
    font-weight: 400;
    line-height: 160%; /* 32px */
    @media (max-width: 479.98px) {
        font-size: 20px;
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
    font-family: Unbounded, serif;
    color: var(--text-primary);
    font-weight: 400;
    &.profile {
        margin: 0 0 40px;
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: space-between;
    }
    &.headline {
        color: var(--light-gray-400, #98a2b3);
        font-family: NunitoSans, serif;
        font-size: 14px;
        font-weight: 600;
        line-height: 145%;
    }

    &-blue {
        color: #3F7BDD;
    }
}
</style>

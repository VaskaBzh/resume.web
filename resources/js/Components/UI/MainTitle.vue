<template>
    <h1 v-if="this.tag === 'h1'" class="title">
        <slot></slot>
    </h1>
    <h2 v-else-if="this.tag === 'h2'" class="title">
        <slot></slot>
    </h2>
    <h3 v-else-if="this.tag === 'h3'" class="title">
        <slot></slot>
    </h3>
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
    font-weight: 500;
    font-size: 64px;
    line-height: 107.6%;
    @media (max-width: 767.98px) {
        font-size: 56px;
        line-height: 100%;
    }
    @media (max-width: 479.98px) {
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
    font-weight: 500;
    font-size: 40px;
    line-height: 120%;
    @media (max-width: 767.98px) {
        font-size: 32px;
    }
    @media (max-width: 479.98px) {
        font-size: 24px;
    }
}

h4 {
    font-weight: 700;
    font-size: 24px;
    line-height: 30px;
    @media (max-width: 479.89px) {
        font-size: 21px;
        line-height: 26px;
    }
    @media (max-width: 767.98px) {
        position: relative;
        margin-bottom: 24px;
        &:after {
            content: "";
            height: 1px;
            position: absolute;
            bottom: -20px;
            left: 0;
            width: 100%;
            background-color: #d7d8d9;
        }
    }
}
.title {
    font-family: AmpleSoftPro, serif;
    font-style: normal;
    color: #343434;
    &.profile {
        margin: 0 0 24px;
        @media (min-width: 1271.98px) {
            padding-left: 70px;
        }
        @media (max-width: 767.98px) {
            margin-bottom: 18px;
        }
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: space-between;
    }
    &-blue {
        color: #3f7bdd;
    }
}
</style>

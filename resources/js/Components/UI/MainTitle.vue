<template>
    <h1 v-if="this.tag === 'h1'" class="title">
        {{ this.titleName }}
        <slot></slot>
    </h1>
    <h2 v-else-if="this.tag === 'h2'" class="title">
        {{ this.titleName }}
        <slot></slot>
    </h2>
    <h3 v-else-if="this.tag === 'h3'" class="title">
        {{ this.titleName }}
        <slot></slot>
    </h3>
    <div v-else class="title">
        {{ this.titleName }}
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: "main-title",
    props: {
        titleName: String,
        tag: String,
    },
};
</script>
<style lang="scss" scoped>
.title {
    font-family: AmpleSoftPro;
    font-style: normal;
}
h1 {
    color: #000034;
    font-weight: 500;
    font-size: 64px;
    line-height: 107.6%;
    @media (max-width: 1270px) {
        font-size: 48px;
        line-height: 52px;
    }
    @media (max-width: 479.89px) {
        text-align: center;
        font-size: 35px;
        line-height: 38px;
    }
}
h2 {
    font-weight: 700;
    font-size: 40px;
    line-height: 50px;
    color: #000000;
    @media (max-width: 479.89px) {
        font-size: 24px;
        line-height: 30px;
        color: #000034;
    }
}
h3 {
    font-weight: 700;
    font-size: 24px;
    line-height: 30px;
    color: #000034;
    @media (max-width: 479.89px) {
        font-size: 21px;
        line-height: 26px;
    }
    @media (max-width: 767.98px) {
        position: relative;
        margin-bottom: 40px !important;
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
</style>

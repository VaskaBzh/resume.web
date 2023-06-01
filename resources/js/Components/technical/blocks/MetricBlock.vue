<template>
    <div class="metric__block wrap__block wrap__column">
        <span class="number">{{ options.number }}</span>
        <span class="text text-md" v-html="options.text"></span>
    </div>
</template>

<script>
export default {
    name: "metric-block",
    props: {
        options: Object,
    },
};
</script>

<style scoped lang="scss">
.metric__block {
    min-height: 222px;
    padding: 30px 20px;
    gap: 24px;
    align-items: center;
    width: 100%;
    @media (max-width: 767.98px) {
        min-height: 142px;
        padding: 16px;
    }
    .number {
        background: #e8effb;
        width: 70px;
        height: 70px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-family: "AmpleSoftPro", serif;
        font-style: normal;
        font-weight: 700;
        font-size: 24px;
        line-height: 32px;
        color: #000034;
        border-radius: 50%;
        @media (max-width: 767.98px) {
            width: 48px;
            height: 48px;
        }
    }
    .text {
        text-align: center;
        color: #000034;
        font-weight: 300;
        line-height: 181.1%;
        b {
            font-weight: 500;
            color: #000;
        }
        @media (max-width: 767.98px) {
            font-size: 16px;
            line-height: 143.1%;
        }
    }
}
</style>

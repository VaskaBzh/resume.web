<template>
    <div
        class="no-info"
        v-scroll="'opacity transition--fast'"
        v-if="Object.values(this.wait).length === 0"
    >
        <div class="propeller"></div>
    </div>
    <div
        v-scroll="'opacity'"
        class="no-info"
        v-if="
            empty &&
            Object.values(this.empty).length === 0 &&
            Object.values(this.wait).length !== 0
        "
    >
        <img src="../../../../assets/img/img_no-info.png" alt="no_info" />
        <span>{{ $t("no_info") }}</span>
    </div>
</template>

<script>
export default {
    name: "no-info",
    props: {
        wait: Object,
        empty: Object,
    },
    // mounted() {
    //     console.log(this.wait);
    //     console.log(this.empty);
    // },
};
</script>

<style scoped lang="scss">
.no-info {
    display: flex;
    flex-direction: column;
    gap: 28px;
    align-items: center;
    padding: 52px 0 46px;
    background: #ffffff;
    border-radius: 21px;
    width: 100%;
    transition: all 1.5s ease 0s;
    img {
        max-width: 118px;
    }
    span {
        font-weight: 500;
        font-size: 18px;
        line-height: 26px;
        color: #000034;
    }
}
</style>

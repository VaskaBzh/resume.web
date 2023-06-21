<template>
    <div
        class="no-info cabinet__block cabinet__block-light"
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
<!--<template>-->
<!--    <div-->
<!--        class="no-info"-->
<!--        v-scroll="'opacity transition&#45;&#45;fast'"-->
<!--        v-if="Object.values(this.wait).length === 0"-->
<!--    >-->
<!--        <div class="propeller">-->
<!--            &lt;!&ndash;            <svg width="75" height="75" viewBox="0 0 75 75" fill="none" xmlns="http://www.w3.org/2000/svg">&ndash;&gt;-->
<!--            &lt;!&ndash;                <mask id="path-1-inside-1_470_17867" fill="white">&ndash;&gt;-->
<!--            &lt;!&ndash;                    <path d="M0 0C0 9.84914 1.93993 19.6018 5.70903 28.7013C9.47813 37.8007 15.0026 46.0686 21.967 53.033C28.9314 59.9974 37.1993 65.5219 46.2987 69.291C55.3982 73.0601 65.1509 75 75 75V71.25C65.6433 71.25 56.3783 69.4071 47.7338 65.8264C39.0894 62.2458 31.2348 56.9975 24.6186 50.3814C18.0025 43.7652 12.7542 35.9106 9.17358 27.2662C5.59294 18.6217 3.75 9.35668 3.75 0H0Z"/>&ndash;&gt;-->
<!--            &lt;!&ndash;                </mask>&ndash;&gt;-->
<!--            &lt;!&ndash;                <path d="M0 0C0 9.84914 1.93993 19.6018 5.70903 28.7013C9.47813 37.8007 15.0026 46.0686 21.967 53.033C28.9314 59.9974 37.1993 65.5219 46.2987 69.291C55.3982 73.0601 65.1509 75 75 75V71.25C65.6433 71.25 56.3783 69.4071 47.7338 65.8264C39.0894 62.2458 31.2348 56.9975 24.6186 50.3814C18.0025 43.7652 12.7542 35.9106 9.17358 27.2662C5.59294 18.6217 3.75 9.35668 3.75 0H0Z" fill="#E8ECF3" stroke="url(#paint0_linear_470_17867)" stroke-width="16" mask="url(#path-1-inside-1_470_17867)"/>&ndash;&gt;-->
<!--            &lt;!&ndash;                <defs>&ndash;&gt;-->
<!--            &lt;!&ndash;                    <linearGradient id="paint0_linear_470_17867" x1="75" y1="75" x2="75" y2="-75" gradientUnits="userSpaceOnUse">&ndash;&gt;-->
<!--            &lt;!&ndash;                        <stop stop-color="#407CDE" stop-opacity="0"/>&ndash;&gt;-->
<!--            &lt;!&ndash;                        <stop offset="1" stop-color="#407CDE"/>&ndash;&gt;-->
<!--            &lt;!&ndash;                    </linearGradient>&ndash;&gt;-->
<!--            &lt;!&ndash;                </defs>&ndash;&gt;-->
<!--            &lt;!&ndash;            </svg>&ndash;&gt;-->

<!--            <img-->
<!--                src="../../../../assets/img/preloader-logo.png"-->
<!--                alt="no_info"-->
<!--            />-->
<!--            {{ percent }} %-->
<!--            &lt;!&ndash;            <div><span class="cabinet__block-light"></span></div>&ndash;&gt;-->
<!--        </div>-->
<!--    </div>-->
<!--    <div-->
<!--        v-scroll="'opacity'"-->
<!--        class="no-info"-->
<!--        v-if="-->
<!--            empty &&-->
<!--            Object.values(this.empty).length === 0 &&-->
<!--            Object.values(this.wait).length !== 0-->
<!--        "-->
<!--    >-->
<!--        <img src="../../../../assets/img/preloader-logo.png" alt="no_info" />-->
<!--        <span>{{ $t("no_info") }}</span>-->
<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--export default {-->
<!--    name: "no-info",-->
<!--    props: {-->
<!--        wait: Object,-->
<!--        clearWait: Boolean,-->
<!--        empty: Object,-->
<!--        interval: {-->
<!--            type: Number,-->
<!--            default: 20,-->
<!--        },-->
<!--    },-->
<!--    data() {-->
<!--        return {-->
<!--            percent: 0,-->
<!--        };-->
<!--    },-->
<!--    watch: {-->
<!--        wait: {-->
<!--            handler(newVal) {-->
<!--                if (Object.values(newVal).length !== 0) {-->
<!--                    this.percent = 100;-->
<!--                }-->
<!--            },-->
<!--            deep: true,-->
<!--        },-->
<!--    },-->
<!--    mounted() {-->
<!--        let interval = setInterval(() => {-->
<!--            if (this.percent < 90) {-->
<!--                this.percent++;-->
<!--            } else {-->
<!--                clearInterval(interval);-->
<!--            }-->
<!--        }, this.interval); // Задержка в миллисекундах, регулируйте для изменения скорости анимации-->
<!--    },-->
<!--};-->
<!--</script>-->

<style lang="scss">
.no-info {
    display: flex;
    flex-direction: column;
    gap: 28px;
    align-items: center;
    padding: 52px 0 46px;
    transition: all 1.5s ease 0s;
    &.no-bg {
        background: transparent !important;
    }
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

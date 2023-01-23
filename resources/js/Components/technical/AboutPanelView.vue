<template>
    <div class="about-panel">
        <div class="about-panel__container">
            <div class="about-panel__main panel-am">
                <div class="panel-am__content">
                    <div class="panel-am__title" v-scroll="'left delay--md'">
                        Удобная панель управления
                    </div>
                    <div class="panel-am__text" v-scroll="'left delay--lg'">
                        Панель управления весьма удобна и обеспечивает отличную
                        детализацию с регулярными обновлениями.
                    </div>
                </div>
                <img
                    v-if="viewportWidth >= 991.98"
                    src="../../assets/img/about-panel-img.png"
                    alt=""
                    class="panel-am__image"
                    v-scroll="'left'"
                />

                <img
                    v-else
                    src="../../assets/img/about-panel-img-mob.png"
                    alt=""
                    class="panel-am__image"
                    v-scroll="'left'"
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            viewportWidth: 0,
        };
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    methods: {
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
    },
};
</script>

<style lang="scss" scoped>
.about-panel {
    background-image: url("../../assets/img/about-panel-bg.png");
    background-position: center 30%;
    background-size: contain;
    background-repeat: no-repeat;
    margin-bottom: 64px;
    // animation: 3s linear 0s infinite strokeAnimate;
    // transition: all 0.3s ease;
    @media (max-width: 991.98px) {
        margin-bottom: 32px;
    }
    @media (max-width: 767.98px) {
        background-position: center 45%;
    }
}
// @keyframes strokeAnimate {
//   0% {../
//     background-position-x: -344px;
//  }
//   100% {
//     background-position-x: 0;
//   }
// }
.panel-am {
    display: flex;
    align-items: center;
    @media (max-width: 1270px) {
        gap: 65px;
    }
    @media (max-width: 991.98px) {
        flex-direction: column;
        gap: 20px;
    }
    // .panel-am__content
    &__content {
        flex: 0 0 50%;
    }
    // .panel-am__title
    &__title {
        font-family: "AmpleSoftPro";
        font-style: normal;
        font-weight: 500;
        font-size: 36px;
        line-height: 132.6%;
        color: #000034;
        margin-bottom: 24px;
        @media (max-width: 991.98px) {
            text-align: center;
        }
        @media (max-width: 767.98px) {
            font-size: 27px;
            line-height: 107.6%;
            margin-bottom: 16px;
        }
    }
    // .panel-am__text
    &__text {
        font-style: normal;
        font-weight: 300;
        font-size: 18px;
        line-height: 181.1%;
        color: #000000;
        @media (max-width: 991.98px) {
            text-align: center;
        }
        @media (max-width: 767.98px) {
            font-size: 16px;
            line-height: 148.1%;
        }
    }
    // .panel-am__image
    &__image {
        max-width: 1120px;
        margin-left: -12pc;
        margin-top: -10pc;
        @media (max-width: 1270px) {
            max-width: 930px;
        }
        @media (max-width: 991.98px) {
            margin-left: 23%;
            margin-top: -9pc;
            max-height: 700px;
            max-width: unset;
        }
        @media (max-width: 767.98px) {
            max-height: unset;
            max-width: 510px;
            margin-left: 33vw;
            margin-top: -5pc;
        }
    }
}
</style>

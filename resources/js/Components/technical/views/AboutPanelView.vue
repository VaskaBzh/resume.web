<template>
    <div class="about-panel section">
        <div class="about-panel__container">
            <div class="about-panel__main panel-am">
                <div class="panel-am__content">
                    <main-title
                        tag="h2"
                        class="title-blue"
                        v-scroll="'left delay--md'"
                    >
                        {{ $t("panel.title") }}
                    </main-title>
                    <div
                        class="description description-sm"
                        v-scroll="'left delay--lg'"
                    >
                        {{ $t("panel.text") }}
                    </div>
                </div>
                <img
                    :src="img"
                    alt=""
                    class="panel-am__image"
                    v-scroll="'left'"
                />
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";

export default {
    components: {
        MainTitle,
    },
    data() {
        return {
            viewportWidth: 0,
        };
    },
    computed: {
        img() {
            return new URL(
                `/resources/assets/img/${this.$t("panel.img")}.png`,
                import.meta.url
            );
        },
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
    //background-image: url("../../../../assets/img/about-panel-bg.png");
    //background-position: center 30%;
    //background-size: contain;
    //background-repeat: no-repeat;
    //margin-bottom: 64px;
    // animation: 3s linear 0s infinite strokeAnimate;
    // transition: all 0.3s ease;
    //@media (max-width: 767.98px) {
    //    background-position: center 45%;
    //}
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
    gap: 84px;
    @media (max-width: 991.98px) {
        flex-direction: column;
        gap: 48px;
        align-items: center;
    }
    // .panel-am__content
    &__content {
        flex: 0 0 50%;
        padding-top: 46px;
        display: flex;
        flex-direction: column;
        gap: 48px;
        @media (max-width: 991.98px) {
            flex: 0 0 100%;
        }
    }
    // .panel-am__text
    .text {
        @media (max-width: 991.98px) {
            text-align: center;
        }
    }
    &__image {
        width: 100%;
    }
}
</style>

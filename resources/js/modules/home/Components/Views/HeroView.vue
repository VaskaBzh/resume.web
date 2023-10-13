<template>
    <div class="hero hero__section" ref="view">
        <div class="hero__content">
            <logo-background/>
            <div class="hero__head">
                <landing-title tag="h1" class="hero_title">
                    <span class="hero_title_row hero_title_row-first">
                        <span class="hero_title_elem">{{
                                $t("title[0]")
                            }}</span>
                        <span class="hero_title_elem">{{
                                $t("title[1]")
                            }}</span>
                    </span>
                    <span class="hero_title_row hero_title_row-left">
                        <span class="hero_title_elem">{{
                                $t("title[2]")
                            }}</span>
                    </span>
                    <span class="hero_title_row hero_title_row-top">
                        <span class="hero_title_elem"
                        >{{
                                $t("title[3]")
                            }}<span class="hero_title_elem">{{
                                    $t("title[4]")
                                }}</span></span
                        >
                    </span>
                    <span class="hero_title_row">
                        <span class="hero_title_elem hero_title_elem-last"
                        >Bitcoin</span
                        >
                        <landing-text tag="span" class="hero_text"
                        >{{ $t("text") }}
                        </landing-text>
                    </span>
                </landing-title>
            </div>

            <landing-button class="hero_button">
                <template v-slot:text>{{ $t("button") }}</template>
            </landing-button>
        </div>
    </div>
</template>

<script>
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import LandingButton from "@/modules/common/Components/UI/LandingButton.vue";
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";
import LandingText from "@/modules/common/Components/UI/LandingText.vue";
import LogoBackground from "@/modules/home/Components/Views/LogoBackground.vue";

export default {
    name: "hero-view",
    components: {
        LogoBackground,
        LandingText,
        LandingTitle,
        LandingButton,
    },
    i18n: {
        sharedMessages: HomeMessage,
    },
    data() {
        return {
            validScroll: false,
            startY: null,
            touchY: null,
        };
    },
    props: {
        start: {
            type: Boolean,
            default: false,
        },
    },
    methods: {
        handleTouchStart(e) {
            this.startY = e.touches[0].clientY;
        },
        handleTouchMove(e) {
            this.touchY = e.touches[0].clientY;
            this.handleWheel();
        },
        handleWheel(e) {
            if (this.startY ? this.startY - this.touchY > 110 : e.deltaY > 10) {
                this.remove();
                setTimeout(this.scroll, 300);
                if (
                    this.$refs.view.offsetHeight -
                    document.scrollingElement.clientHeight >
                    20 && !this.validScroll) {
                    this.$refs.view.style.transform = `translateY(-${
                        this.$refs.view.offsetHeight -
                        document.scrollingElement.clientHeight
                    }px)`;

                    this.validScroll = true;
                } else {
                    this.$emit("next");
                }
            }
            if (
                this.startY ? this.touchY - this.startY > 110 : e.deltaY < -10
            ) {
                this.remove();
                setTimeout(this.scroll, 300);

                if (
                    this.$refs.view.offsetHeight -
                    document.scrollingElement.clientHeight >
                    20 && this.validScroll) {
                    this.$refs.view.style.transform = `translateY(0px)`;

                    this.validScroll = false;
                } else {
                    this.$emit("prev");
                }
            }
        },
        scroll() {
            if (this.$refs.view) {
                this.$refs.view.addEventListener("wheel", this.handleWheel);
                this.$refs.view.addEventListener(
                    "touchstart",
                    this.handleTouchStart
                );
                this.$refs.view.addEventListener(
                    "touchmove",
                    this.handleTouchMove
                );
            }
        },
        remove() {
            if (this.$refs.view) {
                this.$refs.view.removeEventListener("wheel", this.handleWheel);
                this.$refs.view.removeEventListener(
                    "touchstart",
                    this.handleTouchStart
                );
                this.$refs.view.removeEventListener(
                    "touchmove",
                    this.handleTouchMove
                );
            }
        },
    },
    watch: {
        start(newStartState) {
            if (newStartState) {
                this.scroll();
            } else {
                this.remove();
            }
        },
    },
    mounted() {
        this.scroll();
    },
    unmounted() {
        this.remove();
    },
};
</script>

<style scoped>
.hero {
    max-width: 860px;
    margin: 0 auto;
    width: 100%;
    min-height: 400px;
    height: 100vh;
    display: flex;
    padding: clamp(60px, 5vw, 120px) 0;
    align-items: center;
}

.hero__content {
    display: flex;
    flex-direction: column;
}

.hero__head {
    margin-bottom: clamp(60px, 5vw, 50px);
    z-index: 2;
}

.hero_title {
    display: inline-flex;
    flex-flow: column nowrap;
    gap: 12px;
}

@media (max-width: 991.98px) {
    .hero_title {
        align-items: center;
    }
}

.hero_text {
    padding-left: 10px;
    max-width: 406px;
    width: 100%;
}

@media (max-width: 991.98px) {
    .hero_text {
        max-width: 100%;
        padding: 70px 280px 0 120px;
    }
}

@media (max-width: 768.98px) {
    .hero_text {
        max-width: 100%;
        padding: 70px 70px 0 40px;
    }
}

.hero_title_row {
    display: inline-flex;
    align-items: center;
}

@media (max-width: 991.98px) {
    .hero_title_row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
}

@media (max-width: 660.98px) {
    .hero_title_row-first {
        margin-right: auto;
    }
}

.hero_title_row-left {
    margin-left: -102px;
}

.hero_title_row-top {
    margin-top: 6px;
}

@media (max-width: 660.98px) {
    .hero_title_elem-last {
        margin-left: auto;
    }
}
</style>

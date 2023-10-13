<template>
    <div class="hero hero__section" ref="view">
        <div class="hero__content">
            <logo-background/>
            <div class="hero__head">
                <landing-title tag="h1" class="hero_title">
                    <span class="hero_title_row">
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
                        <span class="hero_title_elem">Bitcoin</span>
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
        };
    },
    props: {
        start: {
            type: Boolean,
            default: false,
        },
    },
    methods: {
        handleWheel(e) {
            if (e.deltaY > 50) {
                if (!this.validScroll) {
                    this.$refs.view.style.transform = `translateY(-${
                        this.$refs.view.offsetHeight -
                        document.scrollingElement.clientHeight
                    }px)`;

                    this.validScroll = true;
                } else {
                    this.$emit("next");
                }
            }
            if (e.deltaY < -50) {
                if (this.validScroll) {
                    this.$refs.view.style.transform = `translateY(0px)`;

                    this.validScroll = false;
                } else {
                    this.$emit("prev");
                }
            }
        },
        scroll() {
            this.$refs.view.addEventListener("wheel", this.handleWheel);
        },
        remove() {
            if (this.$refs.view) {
                this.$refs.view.removeEventListener("wheel", this.handleWheel);
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
    padding: clamp(60px, 10vw, 120px) 0;
    align-items: center;
}

.hero__content {
    display: flex;
    flex-direction: column;
}

.hero__head {
    margin-bottom: clamp(60px, 10vw, 50px);
    z-index: 2;
}

.hero_title {
    display: inline-flex;
    flex-flow: column nowrap;
    gap: 12px;
}

.hero_text {
    padding-left: 10px;
    min-width: 406px;
}

.hero_title_row {
    display: inline-flex;
    align-items: center;
}

.hero_title_row-left {
    margin-left: -102px;
}

.hero_title_row-top {
    margin-top: 6px;
}
</style>

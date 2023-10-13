<template>
    <div class="miners miners__section" ref="view">
        <faq-view :faq="faq" :headline="$t('why_allbtc.button')">
            <template v-slot:title>
                <landing-title tag="h3" class="faq_title miners_title">
                    <span class="miners_title_elem animation-up_line">
                        <span class="animation-right">{{
                                $t("why_allbtc.title[0]")
                            }}</span>
                    </span>
                    <span
                        class="miners_title_elem-left miners_title_elem animation-up_line"
                    >
                        <span class="animation-left">{{
                                $t("why_allbtc.title[1]")
                            }}</span>
                    </span>
                    <span class="miners_title_elem animation-up_line">
                        <span class="animation-right">{{
                                $t("why_allbtc.title[2]")
                            }}</span>
                    </span>
                    <span class="miners_title_elem animation-up_line">
                        <span class="animation-left">{{
                                $t("why_allbtc.title[3]")
                            }}</span>
                    </span>
                </landing-title>
            </template>
        </faq-view>
    </div>
</template>

<script>
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import FaqView from "@/modules/home/Components/Views/FaqView.vue";
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";
import {upLeft, upRight} from "../../services/AnimationService";

export default {
    name: "MinersInfoView",
    components: {
        LandingTitle,
        FaqView,
    },
    computed: {
        faq() {
            return [
                {
                    title: this.$t("why_allbtc.list.title[0]"),
                    text: this.$t("why_allbtc.list.text[0]"),
                },
                {
                    title: this.$t("why_allbtc.list.title[1]"),
                    text: this.$t("why_allbtc.list.text[1]"),
                },
                {
                    title: this.$t("why_allbtc.list.title[2]"),
                    text: this.$t("why_allbtc.list.text[2]"),
                },
            ];
        },
    },
    i18n: {
        sharedMessages: HomeMessage,
    },
    data() {
        return {
            validScroll: false,
            startY: null,
            touchY: null,
            progress: 0,
        };
    },
    props: {
        start: Boolean,
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
            if (this.startY
                ? this.startY - this.touchY > 110
                : e.deltaY > 10) {
                this.remove();
                setTimeout(this.scroll, 300);

                if (this.progress === 0) {
                    this.progress++;
                } else if (this.progress === 1) {
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
            }
            if (
                this.startY ? this.touchY - this.startY > 110 : e.deltaY < -10
            ) {
                this.remove();
                setTimeout(this.scroll, 300);

                if (this.progress === 1) {
                    this.progress--;
                } else if (this.progress === 0) {
                    if (this.validScroll) {
                        this.$refs.view.style.transform = `translateY(0px)`;

                        this.validScroll = false;
                    } else {
                        this.$emit("prev");
                    }
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
        setTimeout(() => {
            upLeft();
            upRight();
        }, 1000);
    },
    unmounted() {
        this.remove();
    },
};
</script>

<style scoped lang="scss">
.miners {
    &__content {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    &_title {
        max-width: 300px;
        display: flex;
        flex-direction: column;
        margin-bottom: clamp(70px, 5vw, 140px);

        @media (max-width: 798.98px) {
            max-width: 200px;
        }

        &_elem {
            white-space: nowrap;

            &-left {
                transform: translateX(-180px);
                @media (max-width: 798.98px) {
                    transform: translateX(-95px);
                }
            }
        }
    }
}
</style>

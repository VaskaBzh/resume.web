<template>
    <div class="mission-view mission__section" ref="view">
        <div class="mission__content">
            <landing-headline class="mission__headline"
            >{{ $t("main.button") }}
            </landing-headline>
            <landing-wrap
                :title="$t('main.title[0]')"
            >
                <template v-slot:content>
                    <landing-text>
                        <div class="mission__cards animation-up animation-opacity">
                            <p class="mission-view_item_text">
                                {{ $t("main.text[0]") }}
                            </p>
                            <p class="mission-view_item_text-two">
                                {{ $t("main.text[1]") }}.
                            </p>
                            <p class="mission-view_item_text-three">
                                {{ $t("main.text[2]") }}
                            </p>
                        </div>
                    </landing-text>
                </template>
            </landing-wrap>
        </div>
    </div>
</template>

<script>
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import LandingHeadline from "@/modules/common/Components/UI/LandingHeadline.vue";
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";
import LandingButton from "@/modules/common/Components/UI/LandingButton.vue";
import LandingWrap from "@/modules/common/Components/blocks/LandingWrap.vue";
import LandingText from "../../../common/Components/UI/LandingText.vue";

export default {
    name: "MissionView",
    components: {
        LandingText,
        LandingWrap,
        LandingButton,
        LandingTitle,
        LandingHeadline,
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
            if (
                this.startY ? this.touchY - this.startY > 110 : e.deltaY < -10
            ) {
                this.remove();
                setTimeout(this.scroll, 300);

                if (this.validScroll) {
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

<style scoped lang="scss">
.mission {
    width: 100%;

    &__content {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    &__headline {
        @media (max-width: 1500.87px) {
            margin-bottom: 160px;
        }
        @media (max-width: 991.87px) {
            margin-bottom: 135px;
        }
    }

    &__wrapper {
        display: flex;
        flex-direction: column;
        width: 100%;
        align-items: center;
    }

    &_link {
        width: 100%;
        height: 100%;
        white-space: pre-wrap;
    }
}
</style>

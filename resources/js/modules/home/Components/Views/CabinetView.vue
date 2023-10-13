<template>
    <div class="cabinet cabinet__section cabinet__section-wrap" ref="view">
        <div class="cabinet__content">
            <landing-headline
            >{{ $t("personal_account.button[0]") }}
            </landing-headline>
            <landing-title tag="h3" class="cabinet_title">
                <span
                    class="cabinet_title_elem cabinet_title_elem-right animation-up_line"
                >
                    <span class="animation-right">{{
                            $t("personal_account.title[0]")
                        }}</span>
                </span>
                <span
                    class="cabinet_title_elem cabinet_title_elem-left animation-up_line"
                >
                    <span class="animation-left">{{
                            $t("personal_account.title[1]")
                        }}</span>
                </span>
                <span class="cabinet_title_elem animation-up_line">
                    <span class="animation-right">{{
                            $t("personal_account.title[2]")
                        }}</span>
                </span>
            </landing-title>
            <landing-text class="cabinet_text"
            >{{ $t("personal_account.text") }}
            </landing-text>
            <img
                src="../../../../../assets/img/land-makeup.png"
                alt="all-btc"
                class="cabinet_image"
            />
            <landing-button>
                <template v-slot:text>
                    {{ $t("personal_account.button[1]") }}
                </template>
            </landing-button>
        </div>
    </div>
</template>

<script>
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import LandingTitle from "../../../common/Components/UI/LandingTitle.vue";
import LandingHeadline from "../../../common/Components/UI/LandingHeadline.vue";
import LandingButton from "../../../common/Components/UI/LandingButton.vue";
import LandingText from "../../../common/Components/UI/LandingText.vue";
import {upLeft, upRight} from "../../services/AnimationService";

export default {
    name: "MakeUpCab",
    components: {LandingText, LandingButton, LandingHeadline, LandingTitle},
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
.cabinet {
    &__content {
        display: flex;
        flex-direction: column;
        width: 100%;
        align-items: center;
    }

    &_image {
        max-width: 100%;
        height: 100%;
        object-fit: cover;
        margin-bottom: clamp(40px, 5vw, 50px);
    }

    &_title {
        display: flex;
        flex-direction: column;
        max-width: 300px;
        margin-bottom: clamp(20px, 5vw, 40px);

        &_elem {
            &-left {
                transform: translateX(-70px);
            }

            &-right {
                transform: translateX(50px);
            }
        }
    }

    &_text {
        max-width: 430px;
        margin-bottom: clamp(40px, 5vw, 70px);
    }
}
</style>

<template>
    <div
        class="calculator alculator__section calculator__section-wrap"
        ref="view"
    >
        <div class="calculator__content">
            <landing-headline class="calculator_title_default"
            >{{ $t("profitability_calculator.button[0]") }}
            </landing-headline>
            <landing-title
                tag="h3"
                class="calculator_title animation-destroy"
            >
                    <span class="calculator_title_elem calculator_title_base">
                        <span class="animation-left">{{
                                $t("profitability_calculator.title[0]")
                            }}</span>
                    </span>
                <span class="calculator_title_elem calculator_title_one">
                        <span class="animation-right">{{
                                $t("profitability_calculator.title[1]")
                            }}</span>
                    </span>
                <span class="calculator_title_elem calculator_title_two">
                        <span class="animation-left">{{
                                $t("profitability_calculator.title[2]")
                            }}</span>
                    </span>
                <span class="calculator_title_elem calculator_title_three">
                        <span class="animation-right">{{
                                $t("profitability_calculator.title[3]")
                            }}</span>
                    </span>
                <span class="calculator_title_elem calculator_title_four">
                        <span class="animation-left">{{
                                $t("profitability_calculator.title[4]")
                            }}</span></span
                >
            </landing-title>
            <landing-text
                class="calculator_text animation-destroy"
            >{{ $t("profitability_calculator.text") }}
            </landing-text>
            <light-calculator-view class="calculator__block"/>
        </div>
    </div>
</template>

<script>
import LightCalculatorView from "@/modules/calculator/Components/views/LightCalculatorView.vue";
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";
import LandingHeadline from "@/modules/common/Components/UI/LandingHeadline.vue";
import LandingText from "@/modules/common/Components/UI/LandingText.vue";
import {destroy, reDestroy, upLeft, upRight,} from "../../services/AnimationService";

export default {
    name: "CalculatorLand",
    components: {
        LandingText,
        LandingHeadline,
        LandingTitle,
        LightCalculatorView,
    },
    i18n: {
        sharedMessages: HomeMessage,
    },
    data() {
        return {
            validScroll: false,
            progress: 0,
        };
    },
    props: {
        start: Boolean,
    },
    methods: {
        handleWheel(e) {
            if (e.deltaY > 50) {
                this.remove();
                setTimeout(this.scroll, 500);

                if (this.progress === 0) {
                    destroy();
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
            if (e.deltaY < -50) {
                this.remove();
                setTimeout(this.scroll, 500);

                if (this.progress === 1) {
                    this.progress--;
                    reDestroy();
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
            }
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
.calculator {
    height: 100vh;
    max-width: 860px;
    width: 100%;
    margin: 0 auto;

    &__content {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    &_title {
        width: fit-content;
        display: flex;
        flex-flow: column nowrap;
        margin-bottom: clamp(20px, 10vw, 40px);
        max-height: 300px;

        &_elem {
            width: fit-content;
            display: flex;
        }

        &_one {
            position: relative;
            left: -100px;
            top: 0;
        }

        &_two {
            position: relative;
            left: 50px;
            top: 0;
        }

        &_three {
            position: relative;
            left: 50px;
            top: 0;
        }

        &_text {
            display: block;
            position: relative;
        }
    }

    &_text {
        width: 420px;
        margin-bottom: clamp(30px, 10vw, 70px);
        max-height: 300px;
    }

    &__block {
        width: 100%;
        border-radius: 40px;
        background: linear-gradient(113deg, #0043AE 24.37%, #3A8FE3 111.64%);
        padding: 50px 30px;
        box-shadow: 0px 4px 7px 0px rgba(14, 14, 14, 0.05);
        @media(max-width: 550px){
            padding: 20px 16px;
        }
    }
}
</style>

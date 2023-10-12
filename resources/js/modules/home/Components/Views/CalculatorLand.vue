<template>
    <div class="calculator alculator__section calculator__section-wrap">
        <div class="calculator__content">
            <landing-headline class="calculator_title_default"
            >{{ $t("profitability_calculator.button[0]") }}
            </landing-headline>
            <landing-title tag="h3" class="calculator_title">
                <span class="calculator_title_base">{{
                        $t("profitability_calculator.title[0]")
                    }}</span>
                <span class="calculator_title_o ne">{{
                        $t("profitability_calculator.title[1]")
                    }}</span>
                <span class="calculator_title_two">{{
                        $t("profitability_calculator.title[2]")
                    }}</span>
                <span class="calculator_title_three">{{
                        $t("profitability_calculator.title[3]")
                    }}</span>
                <span class="calculator_title_four">{{
                        $t("profitability_calculator.title[4]")
                    }}</span>
            </landing-title>
            <landing-text class="calculator_text"
            >{{ $t("profitability_calculator.text") }}
            </landing-text>
            <light-calculator-view class="calculator__block"/>
        </div>
    </div>
</template>

<script>
import HeadLine from "@/modules/common/Components/UI/HeadLine.vue";
import LightCalculatorView from "@/modules/calculator/Components/views/LightCalculatorView.vue";
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";
import LandingHeadline from "@/modules/common/Components/UI/LandingHeadline.vue";
import LandingText from "@/modules/common/Components/UI/LandingText.vue";

export default {
    name: "CalculatorLand",
    components: {
        LandingText,
        LandingHeadline,
        LandingTitle,
        LightCalculatorView,
        HeadLine,
    },
    i18n: {
        sharedMessages: HomeMessage,
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
    }

    &__block {
        width: 100%;
    }
}
</style>

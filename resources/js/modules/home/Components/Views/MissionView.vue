<template>
    <div class="mission-view mission__section" ref="view">
        <div class="mission__content">
            <landing-headline class="mission__headline"
                >{{ $t("main.button") }}
            </landing-headline>
            <landing-wrap>
                <template #title>
                    {{ $t("main.title[0]") }}
                </template>
                <template #content>
                    <landing-text>
                        <div
                            class="mission__cards animation-up animation-opacity"
                        >
                            <p class="mission-view_item_text">
                                {{ $t("main.text[0]") }}
                            </p>
                        </div>
                    </landing-text>
                </template>
            </landing-wrap>
            <landing-wrap>
                <template #title>
                    {{ $t("main.title[1]") }}
                </template>
                <template #content>
                    <landing-text>
                        <div
                            class="mission__cards animation-up animation-opacity"
                        >
                            <p class="mission-view_item_text-two">
                                {{ $t("main.text[1]") }}.
                            </p>
                        </div>
                    </landing-text>
                </template>
            </landing-wrap>
            <landing-wrap>
                <template #title>
                    {{ $t("main.title[2]") }}
                </template>
                <template #content>
                    <landing-text>
                        <div
                            class="mission__cards animation-up animation-opacity"
                        >
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
import { HomeMessage } from "@/modules/home/lang/HomeMessage";
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

<template>
    <div class="cabinet cabinet__section cabinet__section-wrap">
        <div class="cabinet__content">
            <landing-headline
            >{{ $t("personal_account.button[0]") }}
            </landing-headline>
            <landing-title tag="h3" class="cabinet_title">
                <span class="cabinet_title_elem cabinet_title_elem-right">{{
                        $t("personal_account.title[0]")
                    }}</span>
                <span class="cabinet_title_elem cabinet_title_elem-left">{{
                        $t("personal_account.title[1]")
                    }}</span>
                <span>{{ $t("personal_account.title[2]") }}</span>
            </landing-title>
            <landing-text class="cabinet_text"
            >{{ $t("personal_account.text") }}
            </landing-text>
            <img
                src="../../../../../assets/img/land-makeup.png"
                alt="all-btc"
                class="cabinet_image"
            />
            <landing-button class="cabinet_button">
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

export default {
    name: "MakeUpCab",
    components: {LandingText, LandingButton, LandingHeadline, LandingTitle},
    i18n: {
        sharedMessages: HomeMessage,
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

<template>
    <div class="about about__section" ref="view">
        <div class="about__wrapper">
            <landing-headline class="about__headline">
                {{ $t("who_we_are.button") }}
            </landing-headline>
            <landing-wrap>
                <template v-slot:title>{{
                    $t("who_we_are.card_private.title[0]")
                }}</template>
                <template v-slot:content>
                    <div class="about__cards">
                        <about-info
                            class="about__card"
                            :title="$t('who_we_are.card_private.num[0]')"
                            :text="$t('who_we_are.card_private.text[0]')"
                        />
                        <about-info
                            class="about__card"
                            :title="$t('who_we_are.card_private.num[1]')"
                            :text="$t('who_we_are.card_private.text[1]')"
                        />
                        <about-info
                            class="about__card"
                            :title="$t('who_we_are.card_private.num[3]')"
                            :text="$t('who_we_are.card_private.text[4]')"
                            :prefix="$t('who_we_are.card_private.text[3]')"
                        />
                    </div>
                </template>

                <template v-slot:link>
                    <a href="#" class="about_link">
                        {{ $t("who_we_are.card_private.button[0]") }}
                        <landing-arrow-right class="about_icon" />
                    </a>
                </template>
            </landing-wrap>
            <a
                href="https://t.me/allbtc_support"
                target="_blank"
                class="about-view_btn"
            >
                <landing-button>
                    <template v-slot:text>
                        {{ $t("who_we_are.card_private.button[1]") }}
                    </template>
                </landing-button>
            </a>
        </div>
        <div class="about__wrapper">
            <landing-wrap>
                <template v-slot:title>{{
                    $t("who_we_are.card_community.title[0]")
                }}</template>
                <template v-slot:content>
                    <div class="about__cards">
                        <about-info
                            class="about__card"
                            :title="$t('who_we_are.card_community.num[0]')"
                            :text="$t('who_we_are.card_community.text[0]')"
                        />
                        <about-info
                            class="about__card"
                            :title="$t('who_we_are.card_community.num[1]')"
                            :text="$t('who_we_are.card_community.text[1]')"
                        />
                        <about-info
                            class="about__card"
                            :title="$t('who_we_are.card_community.num[3]')"
                            :text="$t('who_we_are.card_community.text[3]')"
                        />
                    </div>
                </template>
            </landing-wrap>
        </div>
    </div>
</template>

<script>
import { HomeMessage } from "@/modules/home/lang/HomeMessage";
import LandingHeadline from "@/modules/common/Components/UI/LandingHeadline.vue";
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";
import AboutInfo from "@/modules/home/Components/blocks/AboutInfo.vue";
import LandingButton from "@/modules/common/Components/UI/LandingButton.vue";
import LandingWrap from "@/modules/common/Components/blocks/LandingWrap.vue";
import LandingArrowRight from "@/modules/common/icons/LandingArrowRight.vue";

export default {
    name: "about-view",
    components: {
        LandingArrowRight,
        LandingWrap,
        LandingButton,
        AboutInfo,
        LandingTitle,
        LandingHeadline,
    },
    i18n: {
        sharedMessages: HomeMessage,
    },
    computed: {
        infoCards() {
            return {
                hostings: {
                    title: this.$t("who_we_are.card_private.title[0]"),
                    cards: [
                        {
                            title: ">3",
                            text: this.$t("who_we_are.card_private.text[0]"),
                        },
                        {
                            title: "2.8",
                            text: this.$t("who_we_are.card_private.text[1]"),
                        },
                        // {
                        //     title: "30",
                        //     text: this.$t("who_we_are.card_private.text[2]"),
                        // },
                        {
                            prefix: this.$t("who_we_are.card_private.text[3]"),
                            title: "50%",
                            text: this.$t("who_we_are.card_private.text[4]"),
                        },
                    ],
                },
                miners: {
                    title: this.$t("who_we_are.card_community.title[0]"),
                    cards: [
                        {
                            title: "№1",
                            text: this.$t("who_we_are.card_community.text[0]"),
                        },
                        {
                            title: "24/7",
                            text: this.$t("who_we_are.card_community.text[1]"),
                        },
                        // {
                        //     title: "1",
                        //     text: this.$t("who_we_are.card_community.text[2]"),
                        // },
                        {
                            title: "4%",
                            text: this.$t("who_we_are.card_community.text[3]"),
                            hint: this.$t("who_we_are.card_community.tooltip"),
                        },
                    ],
                },
            };
        },
    },
    data() {
        return {
            key: "hostings",
            keys: ["hostings", "miners"],
        };
    },
};
</script>

<style scoped lang="scss">
.about-view_btn {
    max-width: 860px;
    width: 100%;
    outline: none;
    border: none;
}

.about {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: clamp(50px, 5vw, 100px);

    &__headline {
        @media (max-width: 1500.87px) {
            margin-bottom: 135px;
        }
    }

    &__cards {
        display: flex;
        flex-direction: column;
        gap: clamp(50px, 10vw, 30px);
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

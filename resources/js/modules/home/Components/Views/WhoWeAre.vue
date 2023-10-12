<template>
    <div class="about about-view scroll-section">
        <landing-headline>{{ $t("who_we_are.button") }}</landing-headline>
        <div class="about__wrapper bg">
            <div class="about__inner">
                <div class="about__inner_wrap">
                    <div class="about_item">
                        <landing-title tag="h2" class="about_item_title">
                            {{ $t("who_we_are.card_private.title[0]") }}
                        </landing-title>
                        <div class="about_item_cards">
                            <about-info
                                title="7"
                                :text="$t('who_we_are.card_private.text[0]')"
                            />
                            <about-info
                                title="1.7"
                                :text="$t('who_we_are.card_private.text[1]')"
                            />
                            <about-info
                                title="30"
                                :text="$t('who_we_are.card_private.text[2]')"
                            />
                            <about-info
                                :prefix="$t('who_we_are.card_private.text[3]')"
                                title="50%"
                                :text="$t('who_we_are.card_private.text[4]')"
                                hint="При больших мощностях вы можете получить персональную сниженную комиссию"
                            />
                            <!--                            <div class="about_item_card">-->
                            <!--                                <div class="about_item_card_num">7</div>-->
                            <!--                                <div class="about_item_card_description">-->
                            <!--                                    {{ $t("who_we_are.card_private.text[0]") }}-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <!--                            <div class="about_item_card">-->
                            <!--                                <div class="about_item_card_num">1.7</div>-->
                            <!--                                <div class="about_item_card_description">-->
                            <!--                                    {{ $t("who_we_are.card_private.text[1]") }}-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <!--                            <div class="about_item_card">-->
                            <!--                                <div class="about_item_card_num">30</div>-->
                            <!--                                <div class="about_item_card_description">-->
                            <!--                                    {{ $t("who_we_are.card_private.text[2]") }}-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <!--                            <div class="about_item_card">-->
                            <!--                                <div class="about_item_card_num">-->
                            <!--                                    <span>{{-->
                            <!--                                            $t("who_we_are.card_private.text[3]")-->
                            <!--                                        }}</span-->
                            <!--                                    >75%-->
                            <!--                                </div>-->
                            <!--                                <div class="about_item_card_description">-->
                            <!--                                    {{ $t("who_we_are.card_private.text[4]") }}-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                        </div>
                        <!--                <button-blue class="about_link">{{ $t("who_we_are.card_private.button") }}</button-blue>-->
                    </div>
                </div>
                <!--                <div class="about__inner_wrap">-->
                <!--                    <div class="about_item">-->
                <!--                        <h2 class="about_item_title-two">-->
                <!--                            {{ $t("who_we_are.card_community.title[0]") }}-->
                <!--                        </h2>-->
                <!--                        <div class="about_item_cards">-->
                <!--                            <div class="about_item_card-two">-->
                <!--                                <div class="about_item_card_num">№1</div>-->
                <!--                                <div class="about_item_card_description">-->
                <!--                                    {{-->
                <!--                                        $t("who_we_are.card_community.text[0]")-->
                <!--                                    }}-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                            <div class="about_item_card-two">-->
                <!--                                <div class="about_item_card_num">24/7</div>-->
                <!--                                <div class="about_item_card_description">-->
                <!--                                    {{-->
                <!--                                        $t("who_we_are.card_community.text[1]")-->
                <!--                                    }}-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                            <div class="about_item_card-two">-->
                <!--                                <div class="about_item_card_num">1</div>-->
                <!--                                <div class="about_item_card_description">-->
                <!--                                    {{-->
                <!--                                        $t("who_we_are.card_community.text[2]")-->
                <!--                                    }}-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                            <div class="about_item_card-two">-->
                <!--                                <div class="about_item_card_num">4%</div>-->
                <!--                                <div class="about_item_card_description">-->
                <!--                                    {{-->
                <!--                                        $t("who_we_are.card_community.text[3]")-->
                <!--                                    }}-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
            </div>
            <div class="about_stiky">
                <div class="about_stiky_block"></div>
            </div>
            <button-blue class="about_link"
            >{{ $t("who_we_are.card_community.button[0]") }}
            </button-blue>
        </div>

        <button-blue class="about_btn"
        >{{ $t("who_we_are.card_private.button[1]") }}
        </button-blue>
    </div>
</template>

<script>
import ButtonBlue from "../../../common/Components/UI/ButtonBlue.vue";
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import LandingHeadline from "@/modules/common/Components/UI/LandingHeadline.vue";
import LandingTitle from "../../../common/Components/UI/LandingTitle.vue";
import AboutInfo from "../blocks/AboutInfo.vue";

export default {
    name: "WhoWeAre",
    components: {AboutInfo, LandingTitle, LandingHeadline, ButtonBlue},
    i18n: {
        sharedMessages: HomeMessage,
    },
    mounted() {
        // scrollingAbout();
    },
};
</script>

<style scoped lang="scss">
.about {
    width: 100vw;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-flow: column nowrap;
    gap: 30px;
    padding: 100px 0 186px;

    &__wrapper {
        position: relative;
        display: flex;
        flex-flow: row nowrap;
    }

    &__inner {
        position: absolute;
        height: 100vh;
        left: -25%;
        top: 0;
        width: 100%;
        display: flex;
        flex-flow: column nowrap;
        margin: 0 auto;

        &_wrap {
            height: 75vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
        }
    }

    &_item {
        width: 100%;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        justify-content: center;
        top: 0;
        gap: 30px;
        z-index: 99;
        position: relative;

        &_title {
            color: #f5faff;
            font-family: Unbounded, serif;
            font-size: clamp(14px, 5vw, 65px);
            font-style: normal;
            font-weight: 400;
            line-height: 120%;
            text-transform: uppercase;
            width: 70%;
        }

        &_title-two {
            color: #f5faff;
            font-family: Unbounded, serif;
            font-size: clamp(14px, 5vw, 65px);
            font-style: normal;
            font-weight: 400;
            line-height: 120%;
            text-transform: uppercase;
            width: 70%;
            opacity: 0;
        }

        &_cards {
            display: flex;
            flex-flow: column nowrap;
            align-items: flex-start;
            justify-content: center;
            gap: 50px;
        }

        &_card {
            display: flex;
            flex-flow: column nowrap;

            &_num {
                color: #d0d5dd;
                font-family: Unbounded, serif;
                font-size: 75px;
                font-style: normal;
                font-weight: 600;
                line-height: 100%; /* 75px */
                text-transform: uppercase;

                span {
                    font-family: NunitoSans, serif;
                    font-size: 20px;
                    font-style: normal;
                    font-weight: 400;
                    line-height: 110%;
                    color: rgba(208, 213, 221, 0.6);
                }
            }

            &_description {
                font-family: NunitoSans, serif;
                font-size: 20px;
                font-style: normal;
                font-weight: 400;
                line-height: 110%;
                color: rgba(208, 213, 221, 0.6);
            }
        }

        &_card-two {
            display: flex;
            flex-flow: column nowrap;

            &_num {
                color: #d0d5dd;
                font-family: Unbounded, serif;
                font-size: 75px;
                font-style: normal;
                font-weight: 600;
                line-height: 100%; /* 75px */
                text-transform: uppercase;

                span {
                    font-family: NunitoSans, serif;
                    font-size: 20px;
                    font-style: normal;
                    font-weight: 400;
                    line-height: 110%;
                    color: rgba(208, 213, 221, 0.6);
                }
            }

            &_description {
                font-family: NunitoSans, serif;
                font-size: 20px;
                font-style: normal;
                font-weight: 400;
                line-height: 110%;
                color: rgba(208, 213, 221, 0.6);
            }
        }
    }

    &_stiky {
        position: relative;
        left: 0;
        top: 0;
        width: 100%;
        height: 75vh;
        display: flex;
        flex-flow: column nowrap;
        align-items: center;
        justify-content: center;

        &_block {
            width: 860px;
            height: 680px;
            max-width: 860px;
            max-height: 680px;
            border-radius: 40px;
            border-top: 2px solid #555353;
            border-bottom: 0.5px solid #555353;
            background: rgba(13, 13, 13, 0.5);
            backdrop-filter: blur(10px);
        }
    }
}
</style>

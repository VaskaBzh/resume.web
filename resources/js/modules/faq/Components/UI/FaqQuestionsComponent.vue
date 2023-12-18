<template>
    <div class="faq-questions">
        <div class="faq-questions__items">
            <div id="flood" class="faq-questions__item">
                <landing-title tag="h4" class="faq-title">{{$t("scroll_questions.tabs[0]")}}</landing-title>
                <div class="faq_questions-text">
                    <p  class="faq-subtitle">{{ $t("scroll_questions.subtitle[0]") }}</p>
                    <ol class="faq-questions_orders">
                        <li class="faq-questions_order">
                            {{$t("scroll_questions.frood.list[0]")}}
                            <p> {{$t("scroll_questions.frood.text_list[0]")}}</p>
                        </li>
                        <li class="faq-questions_order">
                            {{$t("scroll_questions.frood.list[1]")}}
                            <p> {{$t("scroll_questions.frood.text_list[1]")}}</p>
                        </li>
                        <li class="faq-questions_order">
                            {{$t("scroll_questions.frood.list[2]")}}
                            <p> {{$t("scroll_questions.frood.text_list[2]")}}</p>
                        </li>
                        <li class="faq-questions_order">
                            {{$t("scroll_questions.frood.list[3]")}}
                            <p> {{$t("scroll_questions.frood.text_list[3]")}}</p>
                        </li>
                        <li class="faq-questions_order">
                            {{$t("scroll_questions.frood.list[4]")}}
                            <p> {{$t("scroll_questions.frood.text_list[4]")}}</p>
                        </li>
                    </ol>
                    <p class="faq-questions-text"></p>
                </div>
            </div>
            <div id="security_jam"  class="faq-questions__item">
                <landing-title tag="h4" class="faq-title">{{$t("scroll_questions.tabs[1]")}}</landing-title>
                <div class="faq_questions-text">
                    <p  class="faq-subtitle">{{ $t("scroll_questions.subtitle[1]") }}</p>
                    <ol class="faq-questions_orders">
                        <li class="faq-questions_order">
                            {{$t("scroll_questions.security_jam.list[0]")}}
                            <p> {{$t("scroll_questions.security_jam.text_list[0]")}}</p>
                        </li>
                        <li class="faq-questions_order">
                            {{$t("scroll_questions.security_jam.list[1]")}}
                            <p> {{$t("scroll_questions.security_jam.text_list[1]")}}</p>
                        </li>
                        <li class="faq-questions_order">
                            {{$t("scroll_questions.security_jam.list[2]")}}
                            <p> {{$t("scroll_questions.security_jam.text_list[2]")}}</p>
                        </li>
                    </ol>
                    <p class="faq-questions-text" ></p>
                </div>
            </div>
            <div id="security_information"  class="faq-questions__item">
                <landing-title tag="h4" class="faq-title">{{$t("scroll_questions.tabs[2]")}}</landing-title>
                <div class="faq_questions-text">
                    <p  class="faq-subtitle">{{ $t("scroll_questions.subtitle[2]") }}</p>
                    <ol class="faq-questions_orders">
                        <li class="faq-questions_order">
                            {{$t("scroll_questions.security_information.list[0]")}}
                            <p> {{$t("scroll_questions.security_information.text_list[0]")}}</p>
                        </li>
                        <li class="faq-questions_order">
                            {{$t("scroll_questions.security_information.list[1]")}}
                            <p> {{$t("scroll_questions.security_information.text_list[1]")}}</p>
                        </li>
                        <li class="faq-questions_order">
                            {{$t("scroll_questions.security_information.list[2]")}}
                            <p> {{$t("scroll_questions.security_information.text_list[2]")}}</p>
                        </li>
                    </ol>
                </div>
            </div>
            <div id="security_account"  class="faq-questions__item">
                <landing-title tag="h4" class="faq-title">{{$t("scroll_questions.tabs[3]")}}</landing-title>
                <div class="faq_questions-text">
                    <p  class="faq-subtitle">{{ $t("scroll_questions.subtitle[3]") }}</p>
                    <ol class="faq-questions_orders">
                        <li class="faq-questions_order">
                            {{$t("scroll_questions.security_account.list[0]")}}
                            <p> {{$t("scroll_questions.security_account.text_list[0]")}}</p>
                        </li>
                        <li class="faq-questions_order">
                            {{$t("scroll_questions.security_account.list[1]")}}
                            <p> {{$t("scroll_questions.security_account.text_list[1]")}}</p>
                        </li>
                        <li class="faq-questions_order">
                            {{$t("scroll_questions.security_account.list[2]")}}
                            <p> {{$t("scroll_questions.security_account.text_list[2]")}}</p>
                        </li>
                        <li class="faq-questions_order">
                            {{$t("scroll_questions.security_account.list[3]")}}
                            <p> {{$t("scroll_questions.security_account.text_list[3]")}}</p>
                        </li>
                        <li class="faq-questions_order">
                            {{$t("scroll_questions.security_account.list[4]")}}
                            <p> {{$t("scroll_questions.security_account.text_list[4]")}}</p>
                        </li>
                    </ol>
                </div>
            </div>
            <div id="methods_security"  class="faq-questions__item">
                <landing-title tag="h4" class="faq-title">{{$t("scroll_questions.tabs[4]")}}</landing-title>
                <div class="faq_questions-text">
                    <p  class="faq-subtitle">{{ $t("scroll_questions.subtitle[4]") }}</p>
                    <p  class="faq-subtitle" v-i18n='$t("scroll_questions.texts.methods_security")'></p>
                </div>
            </div>
            <div id="stratum"  class="faq-questions__item">
                <landing-title tag="h4" class="faq-title">{{$t("scroll_questions.tabs[6]")}}</landing-title>
                <div class="faq_questions-text">
                    <p  class="faq-subtitle">{{ $t("scroll_questions.subtitle[6]") }}</p>
                    <p class="faq-questions-text" v-i18n='$t("scroll_questions.texts.stratum")'></p>
                </div>
            </div>
            <div id="status_reject"  class="faq-questions__item">
                <landing-title tag="h4" class="faq-title">{{$t("scroll_questions.tabs[7]")}}</landing-title>
                <div class="faq_questions-text">
                    <p  class="faq-subtitle">{{ $t("scroll_questions.subtitle[7]") }}</p>
                    <p class="faq-questions-text" v-i18n='$t("scroll_questions.texts.status_reject")'></p>
                    <ol class="faq-questions_orders">
                        <li class="faq-questions_order reject">{{$t("scroll_questions.texts.status_reject_list[0]")}}</li>
                        <li class="faq-questions_order reject">{{$t("scroll_questions.texts.status_reject_list[1]")}}</li>
                        <li class="faq-questions_order reject">{{$t("scroll_questions.texts.status_reject_list[2]")}}</li>
                        <li class="faq-questions_order reject">{{$t("scroll_questions.texts.status_reject_list[3]")}}</li>
                    </ol>
                </div>
            </div>
            <div id="fact_hashrate"  class="faq-questions__item">
                <landing-title tag="h4" class="faq-title">{{$t("scroll_questions.tabs[8]")}}</landing-title>
                <div class="faq_questions-text">
                    <p  class="faq-subtitle" v-i18n='$t("scroll_questions.subtitle[8]")'></p>
                    <p class="faq-questions-text" v-i18n='$t("scroll_questions.texts.fact_hashrate[0]")'></p>
                    <ol class="faq-questions_orders">
                        <li class="faq-questions_order reject">{{$t("scroll_questions.texts.fact_hashrate_list[0]")}}</li>
                        <li class="faq-questions_order reject">{{$t("scroll_questions.texts.fact_hashrate_list[1]")}}</li>
                        <li class="faq-questions_order reject">{{$t("scroll_questions.texts.fact_hashrate_list[2]")}}</li>
                    </ol>
                    <p class="faq-questions-text">{{$t("scroll_questions.texts.fact_hashrate[1]")}}</p>
                </div>
            </div>
            <div id="what_workers"  class="faq-questions__item">
                <landing-title tag="h4" class="faq-title">{{$t("scroll_questions.tabs[9]")}}</landing-title>
                <div class="faq_questions-text">
                    <p  class="faq-subtitle">{{ $t("scroll_questions.subtitle[9]") }}</p>
                    <p class="faq-questions-text" v-i18n='$t("scroll_questions.texts.what_workers")'></p>
                </div>
            </div>
            <div id="workers_not_visible"  class="faq-questions__item">
                <landing-title tag="h4" class="faq-title">{{$t("scroll_questions.tabs[10]")}}</landing-title>
                <div class="faq_questions-text">
                    <p class="faq-questions-text" >{{$t("scroll_questions.subtitle[10]")}}</p>
                </div>
            </div>
            <div id="where_name_workers"  class="faq-questions__item">
                <landing-title tag="h4" class="faq-title">{{$t("scroll_questions.tabs[11]")}}</landing-title>
                <div class="faq_questions-text">
                    <p class="faq-questions-text" v-i18n='$t("scroll_questions.subtitle[11]")'></p>
                    <ol class="faq-questions_orders">
                        <li class="faq-questions_order reject">{{$t("scroll_questions.texts.where_name_workers_list[0]")}}</li>
                        <li class="faq-questions_order reject">{{$t("scroll_questions.texts.where_name_workers_list[1]")}}</li>
                        <li class="faq-questions_order reject">{{$t("scroll_questions.texts.where_name_workers_list[2]")}}</li>
                    </ol>
                    <p class="faq-questions-text" v-i18n='$t("scroll_questions.texts.where_name_workers")'></p>
                </div>
            </div>
            <div id="methods_income"  class="faq-questions__item">
                <landing-title tag="h4" class="faq-title">{{$t("scroll_questions.tabs[12]")}}</landing-title>
                <div class="faq_questions-text">
                    <p  class="faq-subtitle">{{ $t("scroll_questions.subtitle[12]") }}</p>
                    <p class="faq-questions-text" >{{$t("scroll_questions.texts.methods_income")}}</p>
                </div>
            </div>
            <div id="not_enter_wallets"  class="faq-questions__item">
                <landing-title tag="h4" class="faq-title">{{$t("scroll_questions.tabs[13]")}}</landing-title>
                <div class="faq_questions-text">
                    <p  class="faq-questions-text">{{ $t("scroll_questions.subtitle[13]") }}</p>
                </div>
            </div>
            <div id="why_not_income"  class="faq-questions__item">
                <landing-title tag="h4" class="faq-title">{{$t("scroll_questions.tabs[14]")}}</landing-title>
                <div class="faq_questions-text">
                    <p  class="faq-subtitle">{{ $t("scroll_questions.subtitle[14]") }}</p>
                    <p class="faq-questions-text" v-i18n='$t("scroll_questions.texts.why_not_income")'></p>
                    <ol class="faq-questions_orders">
                        <li class="faq-questions_order reject">{{$t("scroll_questions.texts.why_not_income_list[0]")}}</li>
                        <li class="faq-questions_order reject">{{$t("scroll_questions.texts.why_not_income_list[1]")}}</li>
                        <li class="faq-questions_order reject">{{$t("scroll_questions.texts.why_not_income_list[2]")}}</li>
                        <li class="faq-questions_order reject">{{$t("scroll_questions.texts.why_not_income_list[3]")}}</li>
                        <li class="faq-questions_order reject">{{$t("scroll_questions.texts.why_not_income_list[4]")}}</li>
                    </ol>
                </div>
            </div>
            <div id="min_sum_income"  class="faq-questions__item">
                <landing-title tag="h4" class="faq-title">{{$t("scroll_questions.tabs[15]")}}</landing-title>
                <div class="faq_questions-text">
                    <p  class="faq-questions-text">{{ $t("scroll_questions.subtitle[15]") }}</p>
                </div>
            </div>
            <div id="stop_income"  class="faq-questions__item">
                <landing-title tag="h4" class="faq-title">{{$t("scroll_questions.tabs[16]")}}</landing-title>
                <div class="faq_questions-text">
                    <p  class="faq-questions-text">{{ $t("scroll_questions.subtitle[16]") }}</p>
                </div>
            </div>
            <div id="txid"  class="faq-questions__item">
                <landing-title tag="h4" class="faq-title">{{$t("scroll_questions.tabs[17]")}}</landing-title>
                <div class="faq_questions-text">
                    <p  class="faq-questions-text">{{  $t("scroll_questions.subtitle[17]") }}</p>
                </div>
            </div>
            <div id="sub"  class="faq-questions__item">
                <landing-title tag="h4" class="faq-title">{{$t("scroll_questions.tabs[18]")}}</landing-title>
                <div class="faq_questions-text">
                    <p  class="faq-subtitle">{{ $t("scroll_questions.subtitle[18]") }}</p>
                    <p class="faq-questions-text" v-i18n='$t("scroll_questions.texts.sub")' ></p>
                </div>
            </div>
            <div id="delete_acc"  class="faq-questions__item">
                <landing-title tag="h4" class="faq-title">{{$t("scroll_questions.tabs[19]")}}</landing-title>
                <div class="faq_questions-text">
                    <p  class="faq-questions-text">{{ $t("scroll_questions.subtitle[19]") }}</p>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";
import LandingText from "@/modules/common/Components/UI/LandingText.vue";
import {faqTranslate} from "@/modules/faq/lang/FaqTranslate";


export default {
    components: {LandingText, LandingTitle},
    i18n: {
        sharedMessages: faqTranslate
    },
    mounted() {
        document.title = "FAQ";
    },
};
</script>

<style lang="scss" scoped>
.fade-enter-active,
.fade-leave-active {
    transition: all 0.3s ease;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}

.faq-questions__items .faq-questions__item:not(:first-child) {
    padding-top: 44px;
}

.faq-questions__items .faq-questions__item:last-child {
    padding-bottom: 44px;
}

.faq-questions__item p {
    font-weight: 400;
}

.faq-title {
    font-family: Unbounded, serif;
    font-size: clamp(16px, 2vw, 27px);
    font-style: normal;
    font-weight: 400;
    line-height: clamp(25px, 3.5vw, 45px);
    text-transform: none;
    margin-bottom: 24px;
}

.faq-subtitle {
    color: var(--text-teritary-night, #6F7682);
    font-family: NunitoSans, serif;
    font-size: clamp(14px, 2vw, 16px);
    font-style: normal;
    font-weight: 700;
    line-height: 150%;
    margin-bottom: 12px;
}

.faq-questions-text {
    color: var(--text-teritary-night, #6F7682);
    font-family: NunitoSans, serif;
    font-size: clamp(14px, 3.5vw, 16px);
    font-style: normal;
    font-weight: 700;
    line-height: 150%;
}

.faq-questions_orders {
    display: flex;
    flex-flow: column nowrap;
    gap: 12px;
    color: var(--text-secondary);
    font-family: NunitoSans, serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 700;
    line-height: 150%;
    letter-spacing: -0.176px;
    padding-left: 15px;
}

.faq-questions_order p {
    color: #6F7682;
    font-family: NunitoSans, serif;
    font-size:  clamp(14px, 2vw, 16px);
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
}

.reject {
    color: #6F7682;
    font-family: NunitoSans, serif;
    font-size: clamp(14px, 2vw, 16px);
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
}

.description-text {
    color: #98a2b3;
    font-family: NunitoSans, serif;
    margin: 8px 0 40px;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%; /* 24px */
}

.title-gray {
    color: #6F7682;
    font-family: NunitoSans, serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%; /* 24px */
    margin-left: 24px;
}

@media (max-width: 500px) {
    .title-gray {
        font-size: 12px;
        margin: 16px 16px 0;
    }
    .faq__container {
        padding: 0;
    }
    .description-text {
        display: none;
    }
}

.faq {
    flex: 1 1 0;
    display: flex;
    flex-direction: column;

    &__main {
        flex: 1 1 auto;
    }

    &_title {
        margin-top: 8px;
        font-size: 27px;
        color: var(--text-primary);
        font-family: Unbounded, serif;
        font-style: normal;
        font-weight: 400;
        line-height: 40px; /* 148.148% */
        @media (max-width: 991.98px) {
            margin-top: 48px;
        }
        @media (max-width: 767.98px) {
            margin-top: 0px;
        }
        @media (max-width: 500px) {
            margin: 0px 0 0 16px;
        }
    }

    .search {
        margin: 56px 0 48px;
        @media (max-width: 991.98px) {
            margin: 40px 0;
        }
        @media (max-width: 767.98px) {
            margin: 24px 0 32px;
        }
    }

    &__list {
        margin-bottom: 40px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        width: 100%;
        @media (max-width: 998px) {
            margin-bottom: 40px;
            width: 100%;
        }
        @media (max-width: 479.98px) {
            margin-bottom: 32px;
            gap: 8px;
        }

        .section__block {
            border-radius: 24px;
            background: var(--background-island);
            padding: 0 16px;
            box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.05);
        }
    }
}
</style>


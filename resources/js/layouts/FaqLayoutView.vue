<template>
    <div class="faq__layout">
        <header class="faq-header">
            <logo-block class="nav_logo" v-if="viewportWidth > 768"/>
            <router-link :to="{ name: 'home' }" class="svg-mobile" v-if="viewportWidth < 768">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="40"
                    height="32"
                    viewBox="0 0 40 32"
                    fill="none"
                >
                    <path
                        d="M28.8143 18.963C23.6098 18.963 19.0956 20.0535 16.318 21.598C16.2412 21.6411 16.0719 21.7232 16 21.7709C16.8299 21.3789 17.8194 21.0815 18.7454 20.9668H18.7504C19.0909 20.9237 19.4362 20.9046 19.7817 20.9046C19.9446 20.9046 20.1029 20.9094 20.2613 20.9189C22.0362 21.0194 23.7247 21.6649 25.1016 22.7409C25.111 22.7457 25.1207 22.7505 25.1303 22.7601C25.1447 22.7697 25.1495 22.7793 25.1592 22.7887C25.8307 23.3196 26.4255 23.9603 26.9197 24.6873L27.0587 24.8928L27.073 24.9168H27.078L30.3495 29.7517C31.9324 32.0901 35.1082 32.7023 37.4491 31.1242C38.9173 30.139 39.7037 28.5321 39.7037 26.8967C39.7037 25.9164 39.421 24.9216 38.8259 24.0465C36.6768 20.8664 33.0791 18.963 29.2367 18.963H28.8143Z"
                        fill="url(#paint0_linear_881_27955)"
                    />
                    <path
                        d="M15.6499 2.24664L4.32603 18.945L3.00786 20.8893L2.45946 21.6987L0.877116 24.0356C0.626812 24.4042 0.43426 24.7969 0.289958 25.1992C-0.0179454 26.0611 -0.0753944 26.9758 0.0927313 27.8473C0.294784 28.9154 0.838516 29.9161 1.69 30.6824C1.86808 30.8405 2.05535 30.9888 2.25741 31.123C4.60513 32.7033 7.79425 32.0902 9.38171 29.7486C9.38171 29.7486 12.0036 25.4386 13.1627 24.1791C13.2301 24.1025 13.3023 24.0259 13.3792 23.9492C14.091 23.1017 14.962 22.4074 15.9287 21.8949C16.03 21.8422 16.429 21.6268 16.506 21.5837C19.2913 20.037 23.8181 18.945 29.037 18.945H16.7081L19.9794 14.1227L24.1594 7.95951C24.7511 7.08335 25.0349 6.09205 25.0349 5.10555C25.0349 3.46309 24.246 1.85396 22.7742 0.86746C21.9177 0.292854 20.946 0.0103588 19.9794 0.000751495C19.9498 0.000152588 19.9207 0 19.8912 0C18.252 0 16.6374 0.788359 15.6499 2.24664Z"
                        fill="url(#paint1_linear_881_27955)"
                    />
                    <defs>
                        <linearGradient
                            id="paint0_linear_881_27955"
                            x1="21.9259"
                            y1="25.4815"
                            x2="37.4556"
                            y2="13.7367"
                            gradientUnits="userSpaceOnUse"
                        >
                            <stop offset="0.158705" stop-color="#1B3867"/>
                            <stop offset="0.566881" stop-color="#1C70DC"/>
                            <stop offset="0.977621" stop-color="#3565B5"/>
                        </linearGradient>
                        <linearGradient
                            id="paint1_linear_881_27955"
                            x1="-2.66667"
                            y1="35.8518"
                            x2="36.7523"
                            y2="13.7755"
                            gradientUnits="userSpaceOnUse"
                        >
                            <stop offset="0.158705" stop-color="#024BC0"/>
                            <stop offset="0.977621" stop-color="#3597F9"/>
                        </linearGradient>
                    </defs>
                </svg>
            </router-link>
            <current-exchange-rate class="faq_current"/>
            <select-language
                v-if="viewportWidth >= 768"
                :viewport-width="viewportWidth"
                class="faq_dark"
            />
            <div
                class="burger-svg-mobile"
                @click="this.isOpenBurgerFaq = !this.isOpenBurgerFaq"
                v-if="viewportWidth < 768"
                :class="{'active-position': isOpenBurgerFaq}"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="25"
                    height="24"
                    viewBox="0 0 25 24"
                    fill="none"
                >
                    <path
                        d="M4.70312 5L20.7031 5M4.70312 12L20.7031 12M4.70312 19L20.7031 19"
                        stroke="#2E90FA"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </div>
        </header>
        <nav-tabs
            :is-open-burger="isOpenBurgerFaq"
            :instruction-config="instructionService"
        />
        <div class="faq__bar">
            <faq-tabs  :tabs="activeTabs">
                <h2 class="fat__tabs_title">{{ $t("title_scroll_tabs") }}</h2>
            </faq-tabs>
            <div class="faq_main_blocks">
                <div class="faq__main_items" :class="{'faq_questions': this.$route.name.includes('questions')}">
                    <faq-navs-tabs id="faq_navs"/>
                    <keep-alive>
                        <router-view/>
                    </keep-alive>
                </div>
            </div>
        </div>
        <div class="layout__block-fixed">
            <a href="#faq_navs" class="layout_button">
                <arrow-up-icon class="layout_icon"/>
            </a>
        </div>
    </div>
</template>


<script>

import LogoBlock from "@/modules/navs/Components/blocks/LogoBlock.vue";
import HeaderComponentProfile from "@/modules/common/Components/HeaderComponentProfile.vue";
import SelectLanguage from "@/Components/technical/language/SelectLanguage.vue";
import {mapGetters} from "vuex"
import CurrentExchangeRate from "@/Components/technical/blocks/CurrentExchangeRate.vue";
import BurgerMenu from "@/modules/burger/Components/BurgerMenu.vue";
import FooterHosting from "@/modules/hosting/Components/FooterHosting.vue";
import FaqNavsTabs from "@/modules/faq/Components/UI/FaqNavsTabs.vue";
import FaqTabs from "@/modules/faq/Components/UI/FaqTabs.vue";
import {faqTranslate} from "@/modules/faq/lang/FaqTranslate";
import NavTabs from "@/modules/navs/Components/NavTabs.vue";
import {InstructionService} from "@/modules/instruction/services/InstructionService";
import ArrowUpIcon from "@/modules/common/icons/ArrowUpIcon.vue";

export default {
    name: "FaqLayoutView",
    components: {
        ArrowUpIcon,
        NavTabs,
        FaqTabs,
        FaqNavsTabs,
        FooterHosting, BurgerMenu, CurrentExchangeRate, SelectLanguage, HeaderComponentProfile, LogoBlock
    },
    i18n: {
        sharedMessages: faqTranslate
    },
    data() {
        return {
            isOpenBurgerFaq: false,
            instructionService: new InstructionService(),
            selectFaq: false,
            activeTabs: null
        }
    },
    computed: {
        ...mapGetters(['viewportWidth', 'user']),
        tabsDescription() {
            return {
                choosesub: this.$t('scroll_tabs[0]'),
                statistic: this.$t('scroll_tabs[1]'),
                income: this.$t('scroll_tabs[2]'),
                workers: this.$t('scroll_tabs[3]'),
                Subs: this.$t('scroll_tabs[4]'),
                connect: this.$t('scroll_tabs[5]'),
                wallets: this.$t('scroll_tabs[6]'),
                watchers: this.$t('scroll_tabs[7]'),
                accounts: this.$t('scroll_tabs[8]'),
                course: this.$t('scroll_tabs[9]'),
                changeTheme: this.$t('scroll_tabs[10]'),
                changeLang: this.$t('scroll_tabs[11]'),
            }
        },
        tabsQuestions() {
            return {
                flood: this.$t('scroll_questions.tabs[0]'),
                security_jam: this.$t('scroll_questions.tabs[1]'),
                security_information: this.$t('scroll_questions.tabs[0]'),
            }
        },
    },
    watch: {
        "$route.name"(newVal) {
            if(newVal === 'description') {
                this.activeTabs = this.tabsDescription
            }
            if(newVal === 'questions') {
                this.activeTabs = this.tabsQuestions
            }
        }
    },
    async mounted() {
        this.activeTabs = this.$route.name === 'questions' ? this.tabsQuestions:this.tabsDescription
        if (!this.$route?.query.access_key) {
            await this.$store.dispatch("setUser");
        }

        this.$store.dispatch("set_accounts", {
            route: this.$route,
            user_id: this.user?.id,
        });
        document.title = "FAQ";


    },

}
</script>


<style scoped>
.faq__layout {
    display: flex;
    flex-flow: column nowrap;
    justify-content: space-between;
}

.faq-header {
    display: flex;
    align-items: center;
    padding: 16px 24px;
    background: #212327;
    height: 72px;
    justify-content: space-between;
    min-height: 72px;
}

@media (max-width: 475px) {
    .faq-header {
        padding: 8px 12px;
    }
}

.faq_current {
    display: flex;
    align-items: center;
    flex-flow: row nowrap;
    justify-content: flex-start;
    margin-left: 43px;
    padding: 24px 16px;
}

.nav_logo {
    height: 40px;
}

@media (max-width: 768px) {
    .faq_current {
        z-index: 999;
        padding: unset;
        margin-left: 0;
    }
}

.faq__bar {
    display: flex;
    gap: 122px;
    flex-flow: row nowrap;
    background: #161616;
}

.layout_button {
    border: 0.5px solid rgba(192, 228, 255, 0.6);
    background: rgba(13, 13, 13, 0.7);
    backdrop-filter: blur(10px);
    width: clamp(40px, 3vw, 80px);
    height: clamp(40px, 3vw, 80px);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #e4e7ec;
    font-family: Unbounded, serif;
    font-size: clamp(20px, 5vw, 32px);
    font-weight: 400;
    line-height: 120%;
    text-transform: uppercase;
}

.layout_icon {
    width: clamp(20px, 5vw, 32px);
    height: clamp(20px, 5vw, 32px);
}

.layout__block-fixed {
    position: fixed;
    right: clamp(16px, 5vw, 100px);
    bottom: clamp(16px, 5vw, 100px);
    z-index: 12;
    max-width: 100%;
}

.faq_dark {
    background: #2C2F34;
    margin-left: auto;
    margin-right: 0;
}

.faq_main_blocks {
    padding: 44px 24px;
    overflow-y: scroll;
    width: 100%;
}

@media (max-width: 475px) {
    .faq_main_blocks {
        padding: 12px;
    }
}

.faq_main_blocks::-webkit-scrollbar {
    display: none;
}

.faq__main_items {
    display: flex;
    flex-flow: column nowrap;
    gap: 36px;
    flex: 1 1 0;
    height: calc(100vh - 165px);
    max-width: 690px;
    margin: 0 auto;
    padding: 0;
}


@media (min-width: 1920px) {
    .faq__main_items {
        max-width: 1170px;
    }
}

@media (max-width: 1440px) {
    .faq__main_items {
        max-width: unset;
        margin: 0;
        padding: 0 275px;
    }

}

@media (max-width: 1200px) {
    .faq__main_items {
        padding: 0 0 0 275px;
    }
}

@media (max-width: 999.99px) {
    .faq__main_items {
        margin: 0 auto;
        max-width: 100%;
        width: 100%;
        padding: 0;
    }

}

@media (max-width: 475px) {
    .faq__main_items {
        height: calc(100vh - 100px);
        gap: 16px;
    }

}

.fat__tabs_title {
    font-size: 20px;
    font-style: normal;
    font-weight: 400;
    line-height: 40px;
    color: #ffffff;
    font-family: Unbounded, serif;
}

.svg-mobile {
    z-index: 999;
}

.active-position {
    z-index: 99999999;
}
</style>

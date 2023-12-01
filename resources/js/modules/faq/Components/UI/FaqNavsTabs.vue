<template>
    <nav class="faq__navs_tabs">
        <router-Link :to="{name: 'statistic'}" class="faq__tabs_comeback" v-if="viewportWidth > 768">
            <ArrowBackIcon/>
            <landing-text class="faq_text">{{ $t("comeback") }}</landing-text>
        </router-Link>
        <div class="faq__links">
            <router-link
                v-for="(tab, i) in navTabs"
                :key="i"
                @click="choosingTabs(i)"
                :to="{name: `${i}`}"
                class="faq_link"
                :class="{'active': $route.path.startsWith(tab.url)}"
            >
                {{ tab.title }}
            </router-link>
        </div>
    </nav>
</template>


<script>
import ArrowBackIcon from "@/modules/faq/icons/ArrowBackIcon.vue";
import LandingText from "@/modules/common/Components/UI/LandingText.vue";
import {faqTranslate} from "@/modules/faq/lang/FaqTranslate";
import MainTabs from "@/modules/common/Components/UI/MainTabs.vue";
import viewportWidth from "@/store/modules/ViewportWidth";
import {mapGetters} from "vuex";

export default {
    name: "FaqNavsTabs",
    components: {MainTabs, LandingText, ArrowBackIcon},
    i18n: {
        sharedMessages: faqTranslate
    },
    data() {
        return {
            active: 'description',
        }
    },
    computed: {
        ...mapGetters(['viewportWidth']),
        navTabs() {
            return {
                questions: {
                    title: this.$t('faq-links[0]'),
                    url: '/faq/questions'
                },
                description: {
                    title: this.$t('faq-links[1]'),
                    url: '/faq/description'
                },
            }
        }
    },
    methods: {
        choosingTabs(value) {
            this.active = value
        }
    },

}
</script>


<style scoped>

.faq__navs_tabs {
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
    justify-content: space-between;
    gap: 32px;
}

.faq_text {
    font-size: clamp(14px, 2vw, 18px);
    color: #6F7682;
}

.faq__tabs_comeback {
    display: flex;
    flex-flow: row nowrap;
    gap: 8px;
    align-items: center;
    padding: 8px 12px;
}

.faq__links {
    display: flex;
    flex-flow: row nowrap;
    gap: 10px;
}

.faq_link {
    padding: 10px 12px;
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 600;
    line-height: 20px;
    color: #2C2F34;
    border-radius: 12px
}

.faq_link:hover {
    border-radius: 12px;
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    color: #2E90FA;
}

.active {
    border-radius: 12px;
    background: #212327;
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    color: #2E90FA;
}
</style>

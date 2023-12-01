<template>
    <div class="faq__tabs" v-if="viewportWidth > 1000">
        <slot></slot>
        <div class="faq_lists" >
            <a
                v-for="(tab, i) in tabs"
                :key="i"
                class="faq_list"
                @click="choosingTabs(i)"
                :href="`#${i}`"
                :class="{'active': activeTab === i}"
            >
                {{ tab }}
            </a>
        </div>
    </div>
</template>


<script>
import { mapGetters } from "vuex";
import {faqTranslate} from "@/modules/faq/lang/FaqTranslate";
import ArrowBackIcon from "@/modules/faq/icons/ArrowBackIcon.vue";
import LandingText from "@/modules/common/Components/UI/LandingText.vue";

export default {
    name: "FaqTabs",
    components: {LandingText, ArrowBackIcon},
    i18n: {
        sharedMessages: faqTranslate
    },
    data() {
        return {
            activeTab: '',
        }
    },
    computed: {
        ...mapGetters(['viewportWidth']),
        tabs() {
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
        }
    },
    methods: {
        choosingTabs(value) {
            this.activeTab = value
        }
    },
}
</script>

<style scoped>
.faq__tabs {
    display: flex;
    flex-flow: column nowrap;
    align-items: flex-start;
    flex: 1 1 auto;
    justify-content: flex-start;
    max-width: fit-content;
    gap: 16px;
    height: calc(100vh - 144px);
    transition: all .3s ease;
    overflow: hidden;
    overflow-y: scroll;
    position: fixed;
}

.faq__tabs::-webkit-scrollbar {
    display: none;
}


.faq_lists {
    display: flex;
    flex-flow: column nowrap;
    list-style-type: none;
    align-items: flex-start;
    justify-content: flex-start;
    position: relative;
    top: 0;
    left: 0;
    transition: all .3s ease;
}

.faq_lists:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 2px;
    height: 100%;
    background: rgba(83, 177, 253, 0.15);
}

.faq_list {
    width: 100%;
    font-family: NunitoSans, serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
    color: #6F7682;
    padding: 8px 16px;
    cursor: pointer;
    border-left: 2px solid transparent;
    transition: all .3s ease;
}

.faq_list:hover {
    border-left: 2px solid #2E90FA;
    color: #2E90FA;
    background: rgba(83, 177, 253, 0.15);
}

.active {
    border-left: 2px solid #2E90FA;
    color: #2E90FA;
    background: rgba(83, 177, 253, 0.15);
}

</style>

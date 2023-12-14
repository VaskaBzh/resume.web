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
import {tabs} from "@/modules/faq/Enum/FaqTabsEnum";

export default {
    name: "FaqTabs",
    components: {LandingText, ArrowBackIcon},
    i18n: {
        sharedMessages: faqTranslate
    },
    props: {
        tabs: {
            type: Object,
        }
    },
    data() {
        return {
            activeTab: '',
        }
    },
    computed: {
        ...mapGetters(['viewportWidth']),
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
    height: calc(100vh - 74px);
    transition: all .3s ease;
    overflow: hidden;
    overflow-y: scroll;
    position: fixed;
    padding: 44px 24px;
    max-width: 280px;
}

.faq__tabs::-webkit-scrollbar {
    display: none;
}


.faq_lists {
    position: relative;
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
    display: block;
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

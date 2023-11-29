<template>
    <div class="faq-info_items">
        <div class="faq-info_items_item">
            <LandingTitle tag="h3" class="faq_item_title">{{ $t('title') }}</LandingTitle>
            <div class="faq_item_images">
                <img src="@/modules/faq/images/1.png" alt="all btc" class="faq-image">
            </div>
            <div>
                <ol class="faq_item_order-lists">
                    <li v-for="(link, i) in tabs" :key="link[i]" class="faq_item_order-list">
                        <a :href="`#${i}`" class="faq_item_order-link">{{ link }}</a>
                    </li>
                </ol>
            </div>
        </div>
        <div id="choosesub" class="faq-info_items_item">
            <LandingTitle tag="h3" class="faq_item_title">1. {{ $t("titles_texts.titles[0]") }}</LandingTitle>
            <div class="faq_item_images">
                <img src="@/modules/faq/images/2.png" alt="all btc" class="faq-image">
            </div>
            <LandingText :tag="'p'" class="faq_item_text">{{ $t("texts.text[0]") }}
            </LandingText>
        </div>
        <div id="statistic" class="faq-info_items_item">
            <LandingTitle tag="h3" class="faq_item_title">2. {{ $t("titles_texts.titles[1]") }}</LandingTitle>
            <landing-title tag="h4">{{ $t("titles_texts.subtitles[0]")  }}</landing-title>
            <div class="faq_item_images">
                <img src="@/modules/faq/images/3.png" alt="all btc" class="faq-image">
            </div>
            <LandingText :tag="'p'" class="faq_item_text">
                {{ $t("texts.text[1]") }}
            </LandingText>
            <landing-title tag="h4">{{ $t("titles_texts.subtitles[1]") }}</landing-title>
            <div class="faq_item_images">
                <img src="@/modules/faq/images/4.png" alt="all btc" class="faq-image">
            </div>
            <LandingText :tag="'p'" class="faq_item_text">
                {{ $t("texts.text[2]") }}
            </LandingText>
            <LandingText :tag="'p'" class="faq_item_text">
                {{ $t("texts.text[3]") }}            </LandingText>
            <LandingText :tag="'p'" class="faq_item_text">
                {{ $t("texts.text[3]") }}            </LandingText>
            <LandingText :tag="'p'" class="faq_item_text">
                {{ $t("texts.text[4]") }}            </LandingText>
            <landing-title tag="h4">{{ $t("titles_texts.subtitles[2]") }}</landing-title>
            <div class="faq_item_images">
                <img src="@/modules/faq/images/5.png" alt="all btc" class="faq-image">
            </div>
            <ul class="faq_item_text_lists">
                <li>{{ $t("texts.text[5]") }}</li>
                <li>{{ $t("texts.text[6]") }}</li>
                <li>{{ $t("texts.text[7]") }}</li>
            </ul>
            <landing-title tag="h4">{{ $t("titles_texts.subtitles[3]") }}</landing-title>
            <div class="faq_item_images">
                <img src="@/modules/faq/images/6.png" alt="all btc" class="faq-image">
            </div>
            <LandingText :tag="'p'" class="faq_item_text">
                {{ $t("texts.text[8]") }}
            </LandingText>
            <LandingText :tag="'p'" class="faq_item_text">{{ $t("texts.text[9]") }}
            </LandingText>
        </div>
        <div id="income" class="faq-info_items_item">
            <LandingTitle tag="h3" class="faq_item_title">3. {{ $t("titles_texts.titles[2]") }}</LandingTitle>
            <div class="faq_item_images">
                <img src="@/modules/faq/images/7.png" alt="all btc" class="faq-image">
            </div>
            <LandingText :tag="'p'" class="faq_item_text">{{ $t("texts.text[10]") }}
            </LandingText>
            <ul class="faq_item_text_lists">
                <li>{{ $t("texts.text[11]") }}
                </li>
                <li>{{ $t("texts.text[12]") }}</li>
                <li>{{ $t("texts.text[13]") }}</li>
                <li>{{ $t("texts.text[14]") }}
                </li>
                <li>{{ $t("texts.text[15]") }}</li>
                <li>{{ $t("texts.text[16]") }}</li>
                <li>{{ $t("texts.text[17]") }}
                </li>
                <li>{{ $t("texts.text[18]") }}
                </li>
            </ul>
        </div>
        <div id="workers" class="faq-info_items_item">
            <LandingTitle tag="h3" class="faq_item_title">4. {{ $t("titles_texts.titles[3]") }}</LandingTitle>
            <div class="faq_item_images">
                <img src="@/modules/faq/images/8.png" alt="all btc" class="faq-image">
            </div>
            <LandingText :tag="'p'" class="faq_item_text">{{ $t("texts.text[19]") }}
            </LandingText>
        </div>
        <div id="Subs" class="faq-info_items_item">
            <LandingTitle tag="h3" class="faq_item_title">5. {{ $t("titles_texts.titles[4]") }}</LandingTitle>
            <div class="faq_item_images">
                <img src="@/modules/faq/images/9.png" alt="all btc" class="faq-image">
            </div>
            <LandingText :tag="'p'" class="faq_item_text">{{ $t("texts.text[20]") }}
            </LandingText>
        </div>
        <div id="connect" class="faq-info_items_item">
            <LandingTitle tag="h3" class="faq_item_title">6. {{ $t("titles_texts.titles[5]") }}</LandingTitle>
            <landing-title tag="h4">{{ $t("titles_texts.subtitles[4]") }}</landing-title>
            <div class="faq_item_images">
                <img src="@/modules/faq/images/10.png" alt="all btc" class="faq-image">
            </div>
            <LandingText :tag="'p'" class="faq_item_text">{{ $t("texts.text[21]") }}
            </LandingText>
            <landing-title tag="h4">{{ $t("titles_texts.subtitles[5]") }}</landing-title>
            <div class="faq_item_images">
                <img src="@/modules/faq/images/11.png" alt="all btc" class="faq-image">
            </div>
            <LandingText :tag="'p'" class="faq_item_text">{{ $t("texts.text[21]") }}
            </LandingText>
        </div>
        <div id="wallets" class="faq-info_items_item">
            <LandingTitle tag="h3" class="faq_item_title">7. {{ $t("titles_texts.titles[6]") }}</LandingTitle>
            <landing-title tag="h4">{{ $t("titles_texts.subtitles[6]") }}</landing-title>
            <div class="faq_item_images">
                <img src="@/modules/faq/images/12.png" alt="all btc" class="faq-image">
            </div>
            <LandingText :tag="'p'" class="faq_item_text">{{ $t("texts.text[22]") }}
            </LandingText>
            <FaqWarning :tag="'a'">
                <p>{{ $t("warning_wallets.text") }}</p>
                <p>{{ $t("warning_wallets.sub_text") }}</p>
            </FaqWarning>
            <landing-title tag="h4">{{ $t("titles_texts.subtitles[7]") }}</landing-title>
            <div class="faq_item_images">
                <img src="@/modules/faq/images/13.png" alt="all btc" class="faq-image">
            </div>
            <LandingText :tag="'p'" class="faq_item_text">{{ $t("texts.text[23]") }}
            </LandingText>
            <FaqWarning :tag="'a'">
                <p>
                    {{ $t("warning_wallets_change.sub_text") }}</p>
            </FaqWarning>
        </div>
        <div id="watchers" class="faq-info_items_item">
            <LandingTitle tag="h3" class="faq_item_title">8. {{ $t("titles_texts.titles[7]") }}</LandingTitle>
            <div class="faq_item_images">
                <img src="@/modules/faq/images/14.png" alt="all btc" class="faq-image">
            </div>
            <LandingText :tag="'p'" class="faq_item_text">{{ $t("texts.text[24]") }}
                чтения.
            </LandingText>
        </div>
        <div id="accounts" class="faq-info_items_item">
            <LandingTitle tag="h3" class="faq_item_title">9. {{ $t("titles_texts.titles[8]") }}</LandingTitle>
            <div class="faq_item_images">
                <img src="@/modules/faq/images/15.png" alt="all btc" class="faq-image">
            </div>
            <LandingText :tag="'p'" class="faq_item_text">{{ $t("texts.text[25]") }}
            </LandingText>
        </div>
        <div id="course" class="faq-info_items_item">
            <LandingTitle tag="h3" class="faq_item_title">10. {{ $t("titles_texts.titles[9]") }}</LandingTitle>
            <div class="faq_item_images faq_image_one">
                <img src="@/modules/faq/images/16.png" alt="all btc" class="faq-image">
            </div>
            <LandingText :tag="'p'" class="faq_item_text">{{ $t("texts.text[26]") }}
            </LandingText>
        </div>
        <div id="changeTheme" class="faq-info_items_item">
            <LandingTitle tag="h3" class="faq_item_title">11. {{ $t("titles_texts.titles[10]") }}</LandingTitle>
            <div class="faq_item_image faq_image_two">
                <img src="@/modules/faq/images/17.png" alt="all btc" class="faq-image">
            </div>
            <LandingText :tag="'p'" class="faq_item_text">{{ $t("texts.text[27]") }}
            </LandingText>
        </div>
        <div id="changeLang" class="faq-info_items_item">
            <LandingTitle tag="h3" class="faq_item_title">12. {{ $t("titles_texts.titles[11]") }}</LandingTitle>
            <div class="faq_item_image faq_image_three">
                <img src="@/modules/faq/images/18.png" alt="all btc" class="faq-image">
            </div>
            <LandingText :tag="'p'" class="faq_item_text">{{ $t("texts.text[28]") }}
            </LandingText>
        </div>
    </div>
</template>


<script>
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";
import FaqTabs from "@/modules/faq/Components/UI/FaqTabs.vue";
import LandingText from "@/modules/common/Components/UI/LandingText.vue";
import FaqWarning from "@/modules/faq/Components/UI/FaqWarning.vue";
import {faqTranslate} from "@/modules/faq/lang/FaqTranslate";

export default {
    name: "FaqImagesComponent",
    components: {FaqWarning, LandingText, FaqTabs, LandingTitle},
    i18n: {
        sharedMessages: faqTranslate
    },
    data() {
        return {
            activeTab: '',
        }
    },
    computed: {
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
    }
}
</script>


<style scoped>
.faq-info_items {
    display: flex;
    flex-flow: column nowrap;
    gap: 58px;
    overflow-y: scroll;
    padding-bottom: 44px;
    scrollbar-width: thin;
    max-width: 760px;
    height: 100%;
}

.faq-info_items::-webkit-scrollbar {
    display: none;
}

.faq_item_title {
    color: #F1F1F2;
    font-family: Unbounded, serif;
    font-size: clamp(18px, 2vw, 26px);
    font-style: normal;
    font-weight: 400;
    line-height: 40px;
}

.faq_item_images {
    max-width: 690px;
    height: auto;
}

.faq-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
}

.faq_item_text {
    color: #6F7682;
    font-family: NunitoSans, serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
}

.faq-info_items_item {
    display: flex;
    flex-flow: column;
    flex: 1 1 0;
    gap: 28px;
}

.faq_item_order-lists {
    display: flex;
    flex-flow: column nowrap;
    align-items: flex-start;
    justify-content: flex-start;
    padding-left: 25px;
}

.faq_item_order-list {
    color: #2E90FA;
}

.faq_item_order-link {
    padding-left: 5px;
    font-family: NunitoSans, serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
    color: #2E90FA;
}

.faq_item_text_lists {
    display: flex;
    flex-flow: column nowrap;
    gap: 10px;
}

.faq_item_text_lists li {
    color: #6F7682;
    font-family: NunitoSans, serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
    position: relative;
    padding-left: 15px;
}

.faq_item_text_lists li:before {
    content: '';
    width: 5px;
    height: 5px;
    position: absolute;
    top: 0;
    left: 0;
    transform: translate(50%, 170%);
    border-radius: 50%;
    background: white;
}


.faq_image_one {
    max-width: 279px;
}

.faq_image_two {
    max-width: 88px;
}

.faq_image_three {
    max-width: 144px;
}

</style>

<template>
    <div class="hero" ref="view">
        <div class="hero__content">
            <logo-background/>
            <div class="hero__head">
                <landing-title tag="h1" class="hero_title">
                    <span class="hero_title_row hero_title_row-first">
                        <span class="hero_title_elem">
                            {{ $t("title[0]") }}
                        </span>
                    </span>
                    <span class="hero_title_row hero_title_row-left">
                        <span class="hero_title_elem">
                            {{ $t("title[1]") }}
                        </span>
                    </span>
                    <span class="hero_title_row hero_title_row-top">
                        <span class="hero_title_elem">
                            {{ $t("title[2]") }}
                        </span>
                    </span>
                    <span class="hero_title_row">
                        <span class="hero_title_elem hero_title_elem-last">
                            {{ $t("title[3]") }}
                        </span>
                        <landing-text tag="span" class="hero_text">
                            {{ $t("text") }}
                        </landing-text>
                    </span>
                </landing-title>
            </div>

            <a
                class="hero_link"
                href="https://all-btc.com/watcher/statistic?access_key=eyJuYW1lIjoiTWFpbkxpbmsiLCJncm91cF9pZCI6NjAwMTkxMn0=&puid=6001912"
                target="_blank"
            >
                <landing-button class="hero_button">
                    <template v-slot:text>
                        {{ $t("button") }}
                    </template>
                </landing-button>
            </a>
        </div>
    </div>
</template>

<script>
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import LandingButton from "@/modules/common/Components/UI/LandingButton.vue";
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";
import LandingText from "@/modules/common/Components/UI/LandingText.vue";
import LogoBackground from "@/modules/home/Components/Views/LogoBackground.vue";

export default {
    name: "hero-view",
    components: {
        LogoBackground,
        LandingText,
        LandingTitle,
        LandingButton,
    },
    i18n: {
        sharedMessages: HomeMessage,
    },
};
</script>

<style scoped>
.hero_link {
    max-width: 860px;
    width: 100%;
}

.hero {
    max-width: 860px;
    margin: 0 auto;
    width: 100%;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    padding-top: 6em;
    align-items: center;
}

@media (max-width: 768.98px) {
    .hero {
        min-height: 600px;
    }
}

.hero__content {
    display: flex;
    flex-direction: column;
}

.hero__head {
    margin-bottom: clamp(60px, 5vw, 50px);
    z-index: 2;
}

.hero_title {
    display: inline-flex;
    flex-flow: column nowrap;
    gap: 12px;
}

@media (max-width: 991.98px) {
    .hero_title {
        align-items: center;
    }
}

.hero_text {
    padding-left: 10px;
    max-width: 406px;
    width: 100%;
    margin: auto 0;
}

@media (max-width: 991.98px) {
    .hero_text {
        max-width: 100%;
        padding: 70px 280px 0 120px;
    }
}

@media (max-width: 768.98px) {
    .hero_text {
        max-width: 100%;
        padding: 70px 70px 0 40px;
    }
}

.hero_title_row {
    display: inline-flex;
}

@media (max-width: 991.98px) {
    .hero_title_row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
}


.hero_title_row-left {
    margin-left: -102px;
}

@media (max-width: 1200px) {
    .hero_title_row-left {
        margin-left: -62px;
    }
}

@media (max-width: 991.98px) {
    .hero_title_row-left {
        margin-left: 0;
    }
}

.hero_title_row-top {
    margin-top: 6px;
}

</style>

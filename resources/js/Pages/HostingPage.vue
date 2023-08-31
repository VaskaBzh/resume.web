<template>
    <Head title="Хостингам" />
    <div class="hosting section">
        <div class="hosting__container">
            <div class="hosting__main page__main">
                <div class="hosting__content page__content">
                    <main-title
                        tag="h1"
                        class="hosting_title page__title title-blue"
                    >
                        {{ $t("hosting.title") }}
                    </main-title>
                    <div
                        class="description"
                        v-html="this.$t('hosting.text')"
                    ></div>
                    <blue-button
                        class="button button-lg button-with-propeller"
                        v-if="this.auth_user"
                    >
                        <Link href="/profile/accounts" class="all-link">
                            {{ $t("hosting.button") }}
                            <div class="button_propeller"></div
                        ></Link>
                    </blue-button>
                    <blue-button
                        class="button button-lg button-with-propeller"
                        v-else
                    >
                        <Link href="/registration" class="all-link">
                            {{ $t("hosting.button") }}
                            <div class="button_propeller"></div
                        ></Link>
                    </blue-button>
                </div>
                <div class="hosting__image page__image">
                    <img
                        v-show="!getTheme"
                        src="../../assets/img/hosting_back_img.webp"
                        alt=""
                    />
                    <img
                        v-show="getTheme"
                        src="../../assets/img/hosting_back_img-dark.webp"
                        alt=""
                    />
                </div>
            </div>
        </div>
    </div>
    <info-view>
        <template v-slot:pc>
            <info-card
                v-for="(card, i) in cards"
                :key="i"
                :card="card"
            ></info-card>
        </template>
        <template v-slot:mobile>
            <swiper-slide :key="i" v-for="(card, i) in cards">
                <info-card :key="i" :card="card"></info-card>
            </swiper-slide>
        </template>
    </info-view>
    <advantages-view />
    <profit-view />
    <control-view />
    <interface-view />
    <sikker-view />
    <efficiency-view />
    <get-consultation></get-consultation>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import { Link, Head } from "@inertiajs/vue3";
import InfoView from "@/Components/technical/views/InfoView.vue";
import AdvantagesView from "@/Components/technical/views/AdvantagesView.vue";
import ProfitView from "@/Components/technical/views/ProfitView.vue";
import GetConsultation from "@/Components/technical/views/GetConsultation.vue";
import InterfaceView from "@/Components/technical/views/InterfaceView.vue";
import SikkerView from "@/Components/technical/views/SikkerView.vue";
import EfficiencyView from "@/Components/technical/views/EfficiencyView.vue";
import ControlView from "@/Components/technical/views/ControlView.vue";
import { mapGetters } from "vuex";
import InfoCard from "@/Components/technical/blocks/InfoCard.vue";
import { SwiperSlide } from "swiper/vue";

export default {
    name: "hosting-page",
    props: {
        auth_user: Boolean,
    },
    components: {
        EfficiencyView,
        MainTitle,
        BlueButton,
        InfoView,
        AdvantagesView,
        ProfitView,
        GetConsultation,
        InterfaceView,
        SikkerView,
        ControlView,
        Link,
        Head,
        SwiperSlide,
        InfoCard,
    },
    computed: {
        ...mapGetters(["getTheme"]),
        cards() {
            return [
                {
                    title: this.$t("hosting_info.cards[0].title"),
                    img: this.$t("hosting_info.cards[0].img"),
                    text: this.$t("hosting_info.cards[0].text"),
                },
                {
                    title: this.$t("hosting_info.cards[1].title"),
                    img: this.$t("hosting_info.cards[1].img"),
                    text: this.$t("hosting_info.cards[1].text"),
                },
                {
                    title: this.$t("hosting_info.cards[2].title"),
                    img: this.$t("hosting_info.cards[2].img"),
                    text: this.$t("hosting_info.cards[2].text"),
                },
            ];
        },
    },
    mounted() {
        document.title = this.$t("header.links.hosting");
    },
};
</script>

<style scoped lang="scss">
.hosting {
    .description {
        max-width: 492px;
        @media (max-width: 991.98px) {
            max-width: 100%;
        }
        @media (max-width: 767.98px) {
            margin: 16px 0 40px;
        }
    }
    &_title {
        @media (max-width: 991.98px) {
            max-width: 100%;
            text-align: left;
        }
        @media (max-width: 767.98px) {
            margin: 0;
        }
    }
    &__image {
        img {
            @media (min-width: 767.98px) {
                min-width: 897px;
            }
        }
        @media (max-width: 991.98px) {
            margin: 40px 0 0;
            display: flex;
            align-items: center;
            justify-content: center;
            img {
                width: 100%;
                left: 0;
            }
        }
        @media (max-width: 767.98px) {
            margin: 0;
            order: -1;
            img {
                width: 100%;
            }
        }
        @media (max-width: 479.98px) {
            height: 187px;
            margin: calc(79px - 56px) 0 48px;
        }
    }
}
</style>

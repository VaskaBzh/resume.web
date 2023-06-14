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
                        <Link :href="route('accounts')" class="all-link">
                            {{ $t("hosting.button") }}
                            <div class="button_propeller"></div
                        ></Link>
                    </blue-button>
                    <blue-button
                        class="button button-lg button-with-propeller"
                        v-else
                    >
                        <a href="#" data-popup="#auth" class="all-link">
                            {{ $t("hosting.button") }}
                            <div class="button_propeller"></div
                        ></a>
                    </blue-button>
                </div>
                <div class="hosting__image page__image">
                    <img
                        v-if="!getTheme"
                        src="../../assets/img/hosting_back_img.png"
                        alt=""
                    />
                    <img
                        v-else
                        src="../../assets/img/hosting_back_img-dark.png"
                        alt=""
                    />
                </div>
            </div>
        </div>
    </div>
    <hosting-info-view />
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
import HostingInfoView from "@/Components/technical/views/HostingInfoView.vue";
import AdvantagesView from "@/Components/technical/views/AdvantagesView.vue";
import ProfitView from "@/Components/technical/views/ProfitView.vue";
import GetConsultation from "@/Components/technical/views/GetConsultation.vue";
import InterfaceView from "@/Components/technical/views/InterfaceView.vue";
import SikkerView from "@/Components/technical/views/SikkerView.vue";
import EfficiencyView from "@/Components/technical/views/EfficiencyView.vue";
import ControlView from "@/Components/technical/views/ControlView.vue";
import { mapGetters } from "vuex";

export default {
    name: "hosting-page",
    props: {
        auth_user: Boolean,
    },
    components: {
        EfficiencyView,
        MainTitle,
        BlueButton,
        HostingInfoView,
        AdvantagesView,
        ProfitView,
        GetConsultation,
        InterfaceView,
        SikkerView,
        ControlView,
        Link,
        Head,
    },
    computed: {
        ...mapGetters(["getTheme"]),
    },
    mounted() {
        document.title = "Хостингам";
    },
};
</script>

<style scoped lang="scss">
.hosting {
    margin-top: 140px;
    @media (max-width: 991.98px) {
        margin-top: 56px;
    }
    @media (max-width: 767.98px) {
        margin-top: 56px;
    }

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

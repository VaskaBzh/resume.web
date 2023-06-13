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
                        class="hosting__button"
                        v-if="this.auth_user"
                        v-scroll="'left'"
                    >
                        <Link :href="route('accounts')" class="all-link">
                            {{ $t("hosting.button") }}
                            <div class="button_propeller"></div
                        ></Link>
                    </blue-button>
                    <blue-button
                        class="hosting__button"
                        v-else
                        v-scroll="'left'"
                    >
                        <a href="#" data-popup="#auth" class="all-link">
                            {{ $t("hosting.button") }}
                            <div class="button_propeller"></div
                        ></a>
                    </blue-button>
                </div>
                <div class="hosting__image page__image">
                    <img src="../../assets/img/hosting_back_img.png" alt="" />
                </div>
            </div>
        </div>
    </div>
    <hosting-info-view />
    <advantages-view />
    <profit-view />
    <interface-view />
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

export default {
    name: "hosting-page",
    props: {
        auth_user: Boolean,
    },
    components: {
        MainTitle,
        BlueButton,
        HostingInfoView,
        AdvantagesView,
        ProfitView,
        GetConsultation,
        InterfaceView,
        Link,
        Head,
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
    &__button {
        gap: 36px;
        width: 347px;
        height: 85px;
        z-index: 5;
        margin: 0;
        a {
            display: flex;
            justify-content: center;
            align-items: center;
            font-style: normal;
            font-weight: 500;
            font-size: 22px;
            line-height: 107.6%;
            color: #ffffff;
            padding: 0 20px;
            gap: 36px;
        }
        @media (any-hover: hover) {
            &:hover {
                box-shadow: inset 0px 4px 4px rgba(0, 0, 0, 0.25);
                transform: translate(10px, 10px);
                &::before {
                    top: 0;
                    left: 0;
                }
            }
        }
        @media (max-width: 767.98px) {
            width: fit-content;
            padding: 0 26px 0 45px;
            height: 65px;
            .all-link {
                gap: 32px;
                padding: 0;
                font-weight: 500;
                font-size: 16px;
                line-height: 107%;
            }
        }
        &::before {
            content: "";
            position: absolute;
            z-index: -1;
            background: linear-gradient(
                84.14deg,
                rgba(63, 123, 221, 0.27) 8.75%,
                rgba(66, 130, 236, 0.27) 92.01%
            );
            border-radius: 10px;
            width: 100%;
            height: 100%;
            top: 10px;
            left: 10px;
            transition: all 0.3s ease 0s;
        }
    }
    &__image {
        position: relative;
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

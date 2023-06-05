<template>
    <Head title="Хостингам" />
    <div class="hosting">
        <div class="hosting__container">
            <div class="hosting__main page__main">
                <div class="hosting__content page__content">
                    <main-title tag="h1" class="hosting_title page__title">
                        Платформа управления хостингом
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
        <personal-system-view />
        <advantages-view />
        <monitoring-view />
        <metrics-view />
        <monitoring-indicators-view />
        <get-consultation></get-consultation>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import { Link, Head } from "@inertiajs/vue3";
import PersonalSystemView from "@/Components/technical/views/PersonalSystemView.vue";
import AdvantagesView from "@/Components/technical/views/AdvantagesView.vue";
import MonitoringView from "@/Components/technical/views/MonitoringView.vue";
import MetricsView from "@/Components/technical/views/MetricsView.vue";
import MonitoringIndicatorsView from "@/Components/technical/views/MonitoringIndicatorsView.vue";
import GetConsultation from "@/Components/technical/views/GetConsultation.vue";

export default {
    name: "hosting-page",
    props: {
        auth_user: Boolean,
    },
    components: {
        MainTitle,
        BlueButton,
        PersonalSystemView,
        AdvantagesView,
        MonitoringView,
        MetricsView,
        MonitoringIndicatorsView,
        GetConsultation,
        Link,
        Head,
    },
};
</script>

<style scoped lang="scss">
.hosting {
    margin-top: 150px;
    @media (max-width: 991.98px) {
        margin-top: 40px;
    }
    .description {
        max-width: 478px;
        margin-bottom: 36px;
        @media (max-width: 991.98px) {
            max-width: 100%;
            text-align: center;
        }
    }
    &_title {
        @media (max-width: 991.98px) {
            max-width: 100%;
            text-align: center;
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
        @media (max-width: 1270px) {
            height: 74px;
            width: 266px;
            gap: 26px;
            font-size: 20px;
            line-height: 22px;
        }
        @media (max-width: 991.98px) {
            margin: 0 auto;
        }
        @media (max-width: 767.98px) {
            height: 74px;
            width: 266px;
            gap: 32px;
            font-size: 16px;
            line-height: 107%;
        }
        @media (max-width: 479.98px) {
            height: 65px;
            .all-link {
                gap: 12px;
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
        margin-bottom: 130px;
        @media (max-width: 991.98px) {
            margin: 40px 0 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            img {
                width: 100%;
                left: 0;
            }
        }
        @media (max-width: 767.98px) {
            margin: 100px 0;
            img {
                width: 140%;
            }
        }
        &:before,
        &:after {
            width: 300px;
            height: 300px;
            position: absolute;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            @media (max-width: 1270.98px) {
                height: 250px;
                width: 250px;
            }
            @media (max-width: 479.98px) {
                height: 200px;
                width: 200px;
            }
        }
        &:before {
            content: "";
            background: url("/resources/assets/img/hosting_img_bitcoin.png"),
                no-repeat, center;
            background-size: cover;
            left: 10%;
            bottom: -100px;
            animation: plane-soaring infinite 5s ease-in-out 0s;
            z-index: 10;
            @media (max-width: 1270.98px) {
                left: 0;
            }
            @media (max-width: 991.98px) {
                bottom: -130px;
                left: -60px;
            }
            @media (max-width: 479.98px) {
                bottom: -70px;
            }
            @media (max-width: 320.98px) {
                bottom: -140px;
                left: -40px;
            }
        }
        &:after {
            content: "";
            background: url("/resources/assets/img/hosting_img_etherium.png"),
                no-repeat, center;
            background-size: cover;
            right: 10%;
            top: 0;
            animation: plane-soaring infinite 3s ease-in-out 0s;
            @media (max-width: 1270.98px) {
                right: 15%;
            }
            @media (max-width: 991.98px) {
                right: 0;
                top: -80px;
            }
            @media (max-width: 767.98px) {
                right: -60px;
            }
        }
        @keyframes plane-soaring {
            0% {
                transform: translate(0, 0);
            }
            50% {
                transform: translate(0, 15px);
            }
            100% {
                transform: translate(0px, 0px);
            }
        }
    }
}
</style>

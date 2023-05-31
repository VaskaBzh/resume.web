<template>
    <Head title="Хостингам" />
    <div class="hosting">
        <div class="hosting__container">
            <div class="hosting__main page__main">
                <div class="hosting__content page__content">
                    <main-title tag="h1" class="hosting__title page__title">
                        Платформа управления хостингом
                    </main-title>
                    <div class="description">
                        Вы ищете надежную платформу <br />
                        для
                        <b>эффективного управления дата-центрами?</b>
                        Наша платформа - это идеальное решение для тех, кто
                        хочет максимизировать свою прибыль от майнинга
                        криптовалют
                    </div>
                    <blue-button
                        class="hosting__button"
                        v-if="this.auth_user"
                        v-scroll="'left'"
                    >
                        <Link :href="route('accounts')" class="all-link">
                            {{ $t("home.button") }}
                            <div class="button_propeller"></div
                        ></Link>
                    </blue-button>
                    <blue-button
                        class="hosting__button"
                        v-else
                        v-scroll="'left'"
                    >
                        <a href="#" data-popup="#auth" class="all-link">
                            {{ $t("home.button") }}
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
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import { Link, Head } from "@inertiajs/vue3";

export default {
    name: "hosting-page",
    components: {
        MainTitle,
        BlueButton,
        Link,
        Head,
    },
};
</script>

<style scoped lang="scss">
.hosting {
    margin-top: 150px;
    .description {
        max-width: 478px;
        margin-bottom: 36px;
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
}
</style>

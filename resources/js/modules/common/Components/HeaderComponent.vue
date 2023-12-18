<template>
    <nav id="header" class="nav">
        <div class="nav__container">
            <router-link to="login" class="button-black">
                {{ $t("footer.button") }}
            </router-link>
            <router-link to="/">
                <header-logo-icon class="nav_logo" />
            </router-link>
            <nav-links class="nav__navigation" />
            <select-language-land class="nav_lang" />
        </div>
    </nav>
    <div class="burger-mobile">
        <burger-menu />
    </div>
</template>

<script>
import NavLinks from "../../navs/Components/NavLinks.vue";
import SelectLanguageLand from "../../HomeMainPage/SelectLanguageLand.vue";
import { HomeMessage } from "@/modules/home/lang/HomeMessage";
import BurgerMenu from "../../burger/Components/BurgerMenu.vue";
import HeaderLogoIcon from "@/modules/common/icons/HeaderLogoIcon.vue";

export default {
    components: { SelectLanguageLand, NavLinks, BurgerMenu, HeaderLogoIcon },
    i18n: {
        sharedMessages: HomeMessage,
    },
};
</script>

<style lang="scss" scoped>
.nav {
    position: absolute;
    width: 100%;
    display: flex;
    align-items: center;
    //justify-content: space-between;
    //background: transparent;
    z-index: 100;
    padding: 16px 0;
    transition: all 0.8s ease 0s;
    //border-radius: 0 0 clamp(20px, 5vw, 40px) clamp(20px, 5vw, 40px);
    //border-bottom: 2px solid #555353;
    //background: rgba(13, 13, 13, 0.95);

    @media (max-width: 768.98px) {
        padding: 8px 0;
    }

    &_logo {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: clamp(87px, 15vw, 187px);
        height: clamp(26px, 15vw, 56px);
        @media (max-width: 768.98px) {
            position: relative;
            left: 0;
            top: 0;
            transform: none;
        }
    }

    &__container {
        margin: 0 auto;
        align-items: center;
        display: flex;
        max-width: 1920px;
        padding: 0 clamp(16px, 5vw, 100px);
        justify-content: space-between;
        width: 100%;
        position: relative;
    }

    &_lang {
        @media (max-width: 768.98px) {
            display: none;
        }
    }

    &__navigation {
        margin-left: clamp(30px, 32vw, 500px);
        @media (max-width: 768.98px) {
            display: none;
        }
    }

    .button-black {
        padding: 8px 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: clamp(14px, 2vw, 18px);
        font-style: normal;
        font-weight: 400;
        line-height: 120%;
        text-transform: uppercase;
        border-radius: 40px;
        border: 0.5px solid rgba(192, 228, 255, 0.6);
        background: transparent;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        @media (max-width: 768.98px) {
            display: none;
        }
    }
}

.burger-mobile {
    position: fixed;
    height: 26px;
    right: calc(
        (100vw - clamp(0px, 100vw, 1920px)) / 2 + clamp(16px, 5vw, 100px)
    );
    transition: all 0.5s ease 0s;
    align-items: center;
    display: inline-flex;
    cursor: pointer;
    justify-content: flex-end;
    width: fit-content;
    z-index: 120;
    outline: none;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}

.burger-mobile:focus,
.burger-mobile:active {
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}

@media (min-width: 768px) {
    .burger-mobile {
        opacity: 0;
    }
}
</style>

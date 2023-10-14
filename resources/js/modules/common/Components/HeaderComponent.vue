<template>
    <nav class="nav">
        <div class="nav__container">
            <button-blue class="button-black">
                {{ $t("footer.button") }}
            </button-blue
            >
            <nav-links class="nav__navigation"/>
            <select-language-land class="nav_lang"/>
            <div class="burger-mobile">
                <burger-menu/>
            </div>
        </div>
    </nav>
</template>

<script>
import NavLinks from "../../navs/Components/NavLinks.vue";
import SelectLanguageLand from "../../HomeMainPage/SelectLanguageLand.vue";
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import BurgerMenu from "../../burger/Components/BurgerMenu.vue";

export default {
    components: {SelectLanguageLand, NavLinks, BurgerMenu},
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
    justify-content: space-between;
    background: transparent;
    z-index: 100;
    padding: 50px 15px;
    transition: all 0.8s ease 0s;
    //opacity: 0;
    &__container {
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    &_lang {
        @media (max-width: 760.98px) {
            display: none;
        }
    }

    &__navigation {
        margin-left: clamp(30px, 15vw, 500px);
        @media (max-width: 760.98px) {
            display: none;
        }
    }

    .button-black {
        width: 200px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: clamp(18px, 5vw, 14px);
        font-style: normal;
        font-weight: 400;
        line-height: 120%;
        text-transform: uppercase;
        border-radius: 40px;
        border: 0.5px solid rgba(192, 228, 255, 0.6);
        background: transparent;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        @media (max-width: 760.98px) {
            display: none;
        }
    }
}

.burger-mobile {
    display: none;
}

@media(max-width: 760px) {
    .burger-mobile {
        display: inline-block;
        margin-left: auto;
    }
}
</style>

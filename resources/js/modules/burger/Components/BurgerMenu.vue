<template>
    <div @click="actionBurger">
        <!-- <transition name="bounce"> -->
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="17"
            height="17"
            viewBox="0 0 17 17"
            fill="none"
            v-if="isOpen"
            :class="{ 'close-cross': isOpen }"
        >
            <rect
                x="0.824219"
                y="16.0254"
                width="21.757"
                height="0.870282"
                rx="0.435141"
                transform="rotate(-45 0.824219 16.0254)"
                fill="#E4E7EC"
            />
            <rect
                x="1.43945"
                y="0.359375"
                width="21.757"
                height="0.870282"
                rx="0.435141"
                transform="rotate(45 1.43945 0.359375)"
                fill="#E4E7EC"
            />
        </svg>
        <svg
            width="25"
            height="13"
            viewBox="0 0 25 13"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            v-else
            :class="{ 'open-cross': isOpen }"
        >
            <rect x="10" width="15" height="1" rx="0.5" fill="#E4E7EC"/>
            <rect y="6" width="25" height="1" rx="0.5" fill="#E4E7EC"/>
            <rect y="12" width="25" height="1" rx="0.5" fill="#E4E7EC"/>
        </svg>
        <!-- </transition> -->
    </div>
    <div
        class="burger-background"
        v-if="isOpen"
        :class="{ 'open-burger': isOpen, 'close-burger': closeBurger }"
    >
        <div class="burger__content">
            <router-link to="/">
                <header-logo-icon class="burger_logo"/>
            </router-link>
            <div
                class="menu-container"
                :class="{ 'start-opacity': isOpen, 'end-opacity': closeBurger }"
            >
                <nav-links @click="actionBurger"/>
            </div>
            <div class="menu-footer">
                <router-link to="login" class="headline-menu"
                >{{ $t("footer.button") }}
                </router-link>
                <select-language-land/>
                <button class="headline-menu link-tg">
                    <a target="_blank" href="https://t.me/allbtc_support"> ? </a>
                </button>
            </div>
        </div>
    </div>
    <transition name="fadeIn">
        <div
            class="burger__background"
            @click="actionBurger"
            v-show="isOpen"
        ></div>
    </transition>
</template>
<script>
import NavLinks from "../../navs/Components/NavLinks.vue";
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import SelectLanguageLand from "../../HomeMainPage/SelectLanguageLand.vue";
import HeaderLogoIcon from "../../common/icons/HeaderLogoIcon.vue";

export default {
    components: {SelectLanguageLand, NavLinks, HeaderLogoIcon},
    i18n: {
        sharedMessages: HomeMessage,
    },
    data() {
        return {
            isOpen: false,
            closeBurger: false,
        };
    },
    methods: {
        actionBurger() {
            if (this.isOpen) {
                this.closeBurger = true;
                setTimeout(() => {
                    this.isOpen = false;
                    this.closeBurger = false;
                }, 400);
            } else {
                this.isOpen = true;
            }
        },
    },
};
</script>
<style scoped>
svg {
    position: relative;
    z-index: 100;
}

.fadeIn-enter-active,
.fadeIn-leave-active {
    transition: all 0.5s ease 0s, visibility 0.5s ease 0s;
}

.fadeIn-enter-from,
.fadeIn-leave-to {
    visibility: hidden;
    opacity: 0;
}

.burger__background {
    background: var(--gray-480, rgba(13, 13, 13, 0.8));
    backdrop-filter: blur(2.5px);
    position: fixed;
    z-index: 80;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
    width: 100%;
    height: 100%;
}

.burger__content {
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: space-around;
    width: 100%;
    height: 100%;
    gap: 32px;
    position: relative;
}

.burger_logo {
    position: absolute;
    left: 0;
    top: 50px;
    width: clamp(87px, 15vw, 129px);
    height: clamp(26px, 15vw, 40px);
}

.menu-container {
    width: 100%;
}

.burger-background {
    background: var(--gray-4100, #0d0d0d);
    position: fixed;
    top: 0px;
    bottom: 0px;
    width: 100vw;
    height: 100vh;
    right: 0px;
    padding: 0px clamp(16px, 5vw, 50px);
    z-index: 90;
}

@media (min-width: 768.98px) {
    .burger-background {
        max-width: 730px;
        width: 100%;
    }
}

.menu-footer {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 15px;
    width: 100%;
}

.headline-menu {
    border-radius: 40px;
    border: 0.5px solid rgba(192, 228, 255, 0.6);
    background: var(--gray-470, rgba(13, 13, 13, 0.7));
    padding: 8px 20px;
    color: var(--gray-2100, #e4e7ec);
    font-family: Unbounded;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 110%; /* 15.4px */
    text-transform: uppercase;
    height: 48px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    width: 100%;
}

.link-tg {
    width: 48px;
    color: var(--gray-2100, #e4e7ec);
    font-family: Unbounded;
    font-size: 27px;
    font-style: normal;
    font-weight: 400;
    line-height: 120%; /* 32.4px */
    text-transform: uppercase;
}

.open-burger {
    animation: openBg 0.8s ease;
}

.close-burger {
    animation: closeBg 0.8s ease;
}

@keyframes openBg {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(0);
    }
}

@keyframes closeBg {
    100% {
        transform: translateX(100%);
    }
    0% {
        transform: translateX(0);
    }
}

.start-opacity {
    animation: startList 0.7s linear;
}

@keyframes startList {
    0% {
        opacity: 0;
    }
    50% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

.end-opacity {
    animation: endList 0.5s linear;
}

@keyframes endList {
    100% {
        opacity: 0;
    }
    50% {
        opacity: 0;
    }
    0% {
        opacity: 1;
    }
}

.close-cross {
    animation: closeCross 0.5s linear;
}

@keyframes closeCross {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
</style>

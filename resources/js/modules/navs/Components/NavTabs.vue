<template>
    <div class="nav onboarding_block" :class="{
        'open-burger': isOpenBurger,
        'close-burger': !isOpenBurger,
        'onboarding_block-target': instructionConfig.isVisible && instructionConfig.step === 1,
        'nav-untouchable': $route.query?.onboarding === 'true'
    }">
        <div class="nav__content">
            <div class="nav__block">
                <logo-block class="nav_logo" />
                <div class="header-select-container">
                    <select-theme></select-theme>
                    <select-language></select-language>
                </div>
                <div class="nav__tabs">
                    <account-menu></account-menu>
                    <nav class="nav__column">
                        <nav-group
                            @click="$emit('closeBurger')"
                            v-for="(group, i) in service.links"
                            :group="group"
                            :key="i"
                        />
                    </nav>
                </div>
            </div>
            <logout-link class="nav_logout" />
        </div>
        <instruction-step
            @next="instructionConfig.nextStep()"
            @prev="instructionConfig.prevStep()"
@close="instructionConfig.nextStep(6)"
            :step_active="1"
            :steps_count="instructionConfig.steps_count"
            :step="instructionConfig.step"
            :isVisible="instructionConfig.isVisible"
            text="texts.common[0]"
            title="titles.common[0]"
            className="onboarding__card-left"
        />
    </div>
    <div
        class="nav-bg-mobile"
        :class="[isOpenBurger ? 'open-bg' : 'close-bg']"
        @click="$emit('changeBurger', !isOpenBurger)"
    ></div>
</template>
<script>
import { TabsService } from "@/modules/navs/services/TabsService";
import { mapGetters } from "vuex";
import AccountMenu from "@/modules/common/Components/UI/AccountMenu.vue";
import { defineComponent } from "vue";
import LogoBlock from "@/modules/navs/Components/blocks/LogoBlock.vue";
import LogoutLink from "@/modules/navs/Components/UI/LogoutLink.vue";
import NavGroup from "@/modules/navs/Components/UI/NavGroup.vue";
import SelectLanguage from "@/Components/technical/language/SelectLanguage.vue";
import SelectTheme from "@/Components/technical/theme/SelectTheme.vue";
import InstructionStep from "@/modules/instruction/Components/InstructionStep.vue";

export default defineComponent({
    components: {
        InstructionStep,
        LogoutLink,
        AccountMenu,
        LogoBlock,
        NavGroup,
        SelectLanguage,
        SelectTheme,
    },
    props: {
        isOpenBurger: {
            type: Boolean,
        },
        instructionConfig: Object,
    },
    data() {
        return {
            service: new TabsService(this.$router, this.$route),
        };
    },
    mounted() {
        this.$route?.query?.access_key
            ? this.service.setWatcherLinks()
            : this.service.setLinks(this.user);
    },
    unmounted() {
        this.service.dropLinks();
    },
    computed: {
        ...mapGetters(["user", "viewportWidth"]),
    },
});
</script>
<style scoped>
.nav {
    height: 100vh;
    /*
    min-height: 100vh;
    overflow-y: scroll;
    overflow-x: hidden;
    */
    min-width: 320px;
    position: relative;
}
.nav::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: transparent;
    z-index: -10;
    display: none;
}
.nav-untouchable::before {
    z-index: 1000;
    display: block;
}
.nav::-webkit-scrollbar {
    width: 0;
    height: 0;
}
.nav__content {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 100%;
    padding: 40px 16px 16px;
    gap: 8px;

    min-height: 100vh;
}
@media (max-width: 900px) {
    .nav__content {
        padding: 0px 16px 56px;
    }
}
.header-select-container {
    display: none;
}
.open-bg {
    z-index: 5;
}
@media (max-width: 900px) {
    .nav {
        position: fixed;
        right: 0;
        top: 71px;
        padding: 20px 24px 24px;
        z-index: 100;
        background: var(--background-island);
        box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
        display: none;
    }
    .header-select-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 24px;
    }
    .nav_logo {
        display: none;
    }
    .nav-bg-mobile {
        position: fixed;
        background: rgba(0, 0, 0, 0.15);
        left: 0;
        right: 0;
        bottom: 0;
        top: 71px;
        display: none;
    }
    .open-burger {
        display: inline-block;
        animation: openBurger 0.4s linear;
        min-width: 100%;
    }
    @keyframes openBurger {
        0% {
            transform: translateX(350px);
        }
        100% {
            transform: translateX(0px);
        }
    }
    .close-burger {
        animation: closeBurger 0.4s linear;
    }
    @keyframes closeBurger {
        0% {
            display: inline-block;

            transform: translateX(0px);
        }
        100% {
            transform: translateX(350px);
            display: none;
        }
    }
    .open-bg {
        display: inline-block;
        transition: all 0.3s linear;
    }
}
.nav_logo {
    margin: 0 0 40px 16px;
}
</style>

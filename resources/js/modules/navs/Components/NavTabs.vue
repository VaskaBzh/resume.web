<template>
    <transition name="burger">
        <div
            v-show="isOpenBurger || viewportWidth >= 900 || !viewportWidth"
            class="nav onboarding_block"
            :class="{
                'onboarding_block-target':
                    instructionConfig.isVisible && instructionConfig.step === 1,
            }"
        >
            <div
                class="nav__content"
                :class="{
                    'nav-untouchable': $route.query?.onboarding === 'true',
                }"
            >
                <div class="nav__block">
                    <logo-block class="nav_logo" />
                    <div class="header-select-container">
                        <select-theme />
                        <select-language />
                    </div>
                    <div class="nav__tabs">
                        <account-menu />
                        <nav class="nav__column">
                            <nav-group
                                v-for="(group, i) in service.links"
                                :key="i"
                                :group="group"
                                @closeBurger="$emit('closeBurger')"
                            />
                        </nav>
                    </div>
                </div>
                <logout-link
                    v-show="!$route?.query?.access_key"
                    class="nav_logout"
                />
            </div>
            <instruction-step
                :step_active="1"
                :steps_count="instructionConfig.steps_count"
                :step="instructionConfig.step"
                :is-visible="instructionConfig.isVisible"
                text="texts.common[0]"
                title="titles.common[0]"
                class-name="onboarding__card-left"
                @next="instructionConfig.nextStep()"
                @prev="instructionConfig.prevStep()"
                @close="endCommonInstruction"
            />
        </div>
    </transition>
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
            throttle: null,
        };
    },
    watch: {
        user: {
            handler(newUserData) {
                this.$route?.query?.access_key
                    ? this.service.setWatcherLinks()
                    : this.service.setLinks(newUserData);
            },
            deep: true,
        },
    },
    mounted() {
        this.$route?.query?.access_key
            ? this.service.setWatcherLinks()
            : this.service.setLinks(this.user);
    },
    beforeUpdate() {
        this.$route?.query?.access_key
            ? this.service.setWatcherLinks()
            : this.service.setLinks(this.user);
    },
    unmounted() {
        this.service.dropLinks();
    },
    methods: {
        endCommonInstruction() {
            this.instructionConfig.nextStep(6);

            this.$router.push({
                name: "statistic",
            });
        },
    },
    computed: {
        ...mapGetters(["user", "viewportWidth"]),
    },
});
</script>
<style scoped>
.onboarding_block-target {
    background: var(--background-island);
}

.burger-enter-active,
.burger-leave-active {
    transition: all 0.5s ease;
}

.burger-enter-from,
.burger-leave-to {
    transform: translateX(100vw);
}

.nav {
    min-width: 320px;
    position: relative;
}

.nav::before {
    content: "";
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

.nav__content {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 100%;
    overflow: scroll;
    padding: 40px 16px 16px;
    gap: 8px;
    height: 100vh;
}

.nav__content::-webkit-scrollbar {
    width: 0;
    height: 0;
}

@media (max-width: 900px) {
    .nav__content {
        padding: 0 16px 112px;
    }
}

.header-select-container {
    display: none;
}

@media (max-width: 500px) {
    .nav {
        min-width: 100vw;
    }
}

@media (max-width: 900px) {
    .nav {
        position: fixed;
        right: 0;
        top: 71px;
        padding: 20px 24px 24px;
        z-index: 100;
        background: var(--background-island);
        box-shadow: 0 2px 12px -5px rgba(16, 24, 40, 0.02);
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
        top: 71px;
    }
}

.nav_logo {
    margin: 0 0 40px 16px;
}
</style>

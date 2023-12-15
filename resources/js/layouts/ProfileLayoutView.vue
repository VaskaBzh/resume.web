<template>
    <div class="layout">
        <nav-tabs
            ref="tabs"
            :is-open-burger="isOpenBurger"
            :instruction-config="instructionService"
            @changeBurger="change($event)"
            @closeBurger="change(false)"
        />
        <div class="layout__content">
            <header-component-profile
                class="header-container"
                :is-open-burger="isOpenBurger"
                :instruction-config="instructionService"
                @changeBurger="change($event)"
            />

            <div
                class="page-container"
                :style="{
                    'overflow-y':
                        isOpenBurger && viewportWidth <= 900
                            ? 'hidden'
                            : 'scroll',
                }"
            >
                <notification-list/>
                <keep-alive>
                    <slot/>
                </keep-alive>
            </div>
        </div>
    </div>
</template>
<script>
import NavTabs from "@/modules/navs/Components/NavTabs.vue";
import HeaderComponentProfile from "@/modules/common/Components/HeaderComponentProfile.vue";
import NotificationList from "@/modules/notification/Components/NotificationList.vue";

import {InstructionService} from "@/modules/instruction/services/InstructionService";
import {mapGetters} from "vuex";

export default {
    components: {
        NotificationList,
        NavTabs,
        HeaderComponentProfile,
    },
    data() {
        return {
            isOpenBurger: false,
            instructionService: new InstructionService(),
        };
    },
    methods: {
        change(event) {
            this.isOpenBurger = event;

            document.body.style.overflowY = event ? "hidden" : "scroll";
        },
    },
    computed: {
        ...mapGetters(["getActive", "user", "viewportWidth"]),
    },
    async mounted() {
        if (!this.$route?.query.access_key) {
            await this.$store.dispatch("setUser");
        }

        this.$store.dispatch("set_accounts", {
            route: this.$route,
            user_id: this.user?.id,
        });

        if (this.$route.query?.onboarding === "true") {
            this.instructionService.setStepsCount(2).setVisible();
        }
    },
};
</script>
<style scoped>
.layout {
    width: 100%;
    min-height: 100vh;
    height: 100%;
    background: var(--background-island);
    display: flex;
    overflow: hidden;
}

.layout__content {
    width: 100%;
    display: flex;
    flex-direction: column;
}

.header-container {
    width: 100%;
    min-height: 72px;
    display: flex;
    align-items: center;
    transition: all 0.3s ease 0s;
}

.page-container {
    /* padding: 24px; */
    overflow-x: hidden;
    display: flex;
    flex-direction: column;
    border-radius: 48px 0px 0px 0px;
    background: var(--background-globe);
    width: 100%;
    flex: 1 1 auto;
    padding: clamp(12px, 2vw, 24px);
    position: relative;
}

.page-container::before {
    content: "";
    position: fixed;
    width: 100%;
    height: 100%;
    transform: translate(-24px, -24px);
    border-radius: 48px 0 0 0;
    box-shadow: 0 5px 10px 0 var(--main-page-shadow) inset;
    z-index: 5;
    pointer-events: none;
}

.page-container::-webkit-scrollbar {
    display: none;
}

@media (min-width: 998px) {
    .page-container {
        overflow-y: scroll;
        height: calc(100vh - 72px);
    }
}

@media (max-width: 998px) {
    .page-container {
        border-radius: 0;
    }

    .page-container::before {
        display: none;
    }
}

@keyframes noteAnimation {
    0% {
        transform: translateX(280px);
        opacity: 1;
    }
    5% {
        transform: translateX(-24px);
    }
    95% {
        transform: translateX(-24px);
        opacity: 1;
    }
    100% {
        transform: translateX(260px);
        opacity: 0;
    }
}
</style>

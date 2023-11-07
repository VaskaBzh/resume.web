<template>
    <div class="referral profile">
        <div class="referral__wrapper">
            <div class="cabinet referral__cabinet">
                <div class="referral__tabs">
                    <main-tabs
                        class="referral__tabs-list"
                        @getValue="referralRouting($event)"
                        :tabs="viewService.tabs"
                        :active="viewService.view"
                    />
                </div>
                <router-view />
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainTabs from "@/modules/common/Components/UI/MainTabs.vue";

import { ViewsService } from "@/modules/referral/services/ViewsService";
import { ReferralsMessage } from "@/modules/referral/lang/ReferralsMessage";

export default {
    components: {
        MainTitle,
        MainTabs,
    },
    i18n: {
        sharedMessages: ReferralsMessage,
    },
    props: {
        user: Object,
        errors: Object,
        message: String,
    },
    data() {
        return {
            viewService: new ViewsService(this.$t),
        };
    },
    watch: {
        $route(newRoute) {
            this.viewService.setView(newRoute);
        },
    },
    methods: {
        referralRouting(routeName) {
            this.viewService.tabRoute(routeName);
        },
    },
    mounted() {
        document.title = this.$t("header.links.referral");

        this.viewService.setTabs().setView(this.$route);
    },
};
</script>

<style scoped lang="scss">
.page-leave-active {
    transition: all 0s ease 0s;
}
.page-enter-active {
    transition: all 0.3s ease 0.3s;
}
.page-leave-to,
.page-enter-from {
    opacity: 0;
}
.referral {
    padding: 24px;
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;

    &__wrapper {
        display: flex;
        flex-direction: column;
        flex: 1 1 auto;
    }
    &__buttons {
        min-height: 48px;

    }
    &__cabinet {
        gap: 24px;
        flex-direction: column;
        flex: 1 1 auto;
    }
    &__tabs {
        @media (max-width: $mobile) {
            overflow-x: scroll;
            padding: 0 15px;
            margin: 0 -15px;
            &::-webkit-scrollbar {
                width: 0;
                display: none;
            }



        }

        &-list {
            width: fit-content;
            @media (max-width: 497.98px) {
                font-size: 12px;
                font-style: normal;
                font-weight: 600;
                line-height: 16px;
                padding: 12px 0;
                background: transparent;
            }
        }
    }
}
</style>

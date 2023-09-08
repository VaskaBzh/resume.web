<template>
    <div class="referral profile">
        <div class="referral__wrapper">
            <div class="cabinet__head">
                <main-title tag="h3" class="cabinet_title">{{
                    $t("title")
                }}</main-title>
            </div>
            <div class="cabinet referral__cabinet">
                <div class="referral__tabs">
                    <main-tabs
                        class="referral__tabs-list"
                        @getValue="referralRouting($event)"
                        :tabs="viewService.tabs"
                        :active="viewService.view"
                    />
                </div>
                <transition name="page">
                    <router-view />
                </transition>
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import MainTabs from "@/Components/UI/profile/MainTabs.vue";

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
    &__wrapper {
        display: flex;
        flex-direction: column;
    }
    &__buttons {
        min-height: 48px;
    }
    &__cabinet {
        gap: 24px;
        flex-direction: column;
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
            min-width: fit-content;
        }
    }
}
</style>

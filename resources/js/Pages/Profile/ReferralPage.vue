<template>
    <div class="referral profile">
        <div class="referral__wrapper">
            <div class="cabinet__head">
                <main-title tag="h3" class="cabinet_title"
                    >Реферальный кабинет</main-title
                >
            </div>
            <div class="cabinet referral__cabinet">
                <div class="referral__tabs">
                    <main-tabs
                        class="referral__tabs-list"
                        @getValue="viewService.setView($event)"
                        :tabs="viewService.tabs"
                        :active="viewService.view"
                    />
                </div>
                <transition name="page">
                    <cabinet-view
                        :user="user"
                        :message="message"
                        :errors="errors"
                        v-show="viewService.view === 'Cabinet'"
                    />
                </transition>
                <transition name="page">
                    <referrals-view
                        :user="user"
                        v-show="viewService.view === 'Referrals'"
                    />
                </transition>
                <transition name="page">
                    <payment-view
                        :user="user"
                        v-show="viewService.view === 'Referrals_income'"
                    />
                </transition>
            </div>
        </div>
    </div>
</template>

<script>
import ProfileLayoutView from "@/Shared/ProfileLayoutView.vue";
import MainTitle from "../../Components/UI/MainTitle.vue";
import MainTabs from "../../Components/UI/profile/MainTabs.vue";
import CabinetView from "../../modules/referral/Components/views/CabinetView.vue";
import ReferralsView from "@/modules/referral/Components/views/ReferralsView.vue";
import PaymentView from "@/modules/referral/Components/views/PaymentView.vue";

import { ViewsService } from "@/modules/referral/services/ViewsService";

export default {
    name: "referral-page",
    layout: ProfileLayoutView,
    components: {
        MainTitle,
        MainTabs,
        CabinetView,
        PaymentView,
        ReferralsView,
    },
    props: {
        user: Object,
        errors: Object,
        message: String,
    },
    data() {
        return {
            viewService: new ViewsService(),
        };
    },
    mounted() {
        document.title = this.$t("header.links.ref");

        this.viewService.setTabs();
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
            }
        }
        &-list {
            min-width: fit-content;
        }
    }
}
</style>

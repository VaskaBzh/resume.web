<template>
    <div class="referral profile">
        <div class="referral__wrapper">
            <div class="cabinet__head">
                <main-title tag="h3" class="cabinet_title"
                    >Реферальный кабинет</main-title
                >
            </div>
            <div class="cabinet referral__cabinet">
                <!--                <main-tabs-->
                <!--                    @getValue="swapView"-->
                <!--                    :tabs=""-->
                <!--                    :active="offset"-->
                <!--                />-->
                <cabinet-view />
            </div>
        </div>
    </div>
</template>

<script>
import ProfileLayoutView from "@/Shared/ProfileLayoutView.vue";
import MainTitle from "../../Components/UI/MainTitle.vue";
import MainTabs from "../../Components/UI/profile/MainTabs.vue";
import CabinetView from "../../modules/referral/Components/views/CabinetView.vue";

export default {
    name: "referral-page",
    layout: ProfileLayoutView,
    components: {
        MainTitle,
        MainTabs,
        CabinetView,
    },
    data() {
        return {
            viewName: "Cabinet",
        };
    },
    mounted() {
        document.title = this.$t("header.links.ref");
    },
    methods: {
        swapView(viewName) {
            this.viewName = viewName;
        },
    },
};
</script>

<style scoped lang="scss">
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
}
</style>

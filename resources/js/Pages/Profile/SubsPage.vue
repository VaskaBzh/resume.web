<template>
    <div class="subs">
        <div class="subs__wrapper">
            <main-title class="subs_title" tag="h4">{{
                $t("subs.title")
            }}</main-title>
            <div class="subs__wrapper" v-if="!service.waitSubs && !service.emptySubs">
                <sub-header
                    class="subs__header"
                    :subsType="service.subsType"
                    @changeType="toggleIsTable"
                    @searched="service.searchSub($event)"
                />
                <sub-list
                    :subsType="service.subsType"
                    :table="service.subsTable"
                    :empty="service.emptyTableSubs"
                />
            </div>
            <main-preloader
                class="cabinet__preloader"
                :wait="service.waitSubs"
                :interval="50"
                :end="!service.waitSubs"
                :empty="service.emptySubs"
            />
        </div>
    </div>
</template>

<script>
import AccountProfile from "@/Components/technical/blocks/profile/AccountProfile.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import BlueButton from "@/modules/common/Components/UI/ButtonBlue.vue";
import MainPreloader from "@/modules/preloader/Components/MainPreloader.vue";
import { mapGetters } from "vuex";
import MainTable from "@/modules/table/Components/blocks/MainTable.vue";
import SubHeader from "@/modules/subs/Components/SubHeader.vue";
import SubList from "@/modules/subs/Components/SubList.vue";
import { SubMessages } from "@/modules/subs/lang/SubMessages";
import { SubService } from "@/modules/subs/services/SubService";

export default {
    components: {
        SubList,
        SubHeader,
        MainTitle,
        AccountProfile,
        MainPopup,
        BlueButton,
        MainPreloader,
        MainTable,
    },
    i18n: {
        sharedMessages: SubMessages,
    },
    watch: {
        "$i18n.locale"() {
            this.service.setDocumentTitle(this.$t("subs.title"));
        },
        allAccounts(newAccountsList) {
            this.service.setSubList(newAccountsList)
                .statesProcess()
                .tableProcess()
                .tableStatesProcess();
        },
        '$i18n.locale'() {
            this.service.setSubList(this.allAccounts)
                .statesProcess()
                .tableProcess()
                .tableStatesProcess()
                .setTranslate(this.$t);
        },
    },
    data() {
        return {
            service: new SubService(),
        };
    },
    computed: {
        ...mapGetters([
            "allAccounts",
            "allHistoryForDays",
            "btcInfo",
            "getActive",
            "getAccount",
        ]),
    },
    methods: {
        toggleIsTable() {
            this.service.toggleSubsType();
        }
    },
    mounted() {
        if (this.$t) {
            this.service.setTranslate(this.$t);
        }

        this.service.setDocumentTitle(this.$t("accounts.title"));
        this.service.setSubList(this.allAccounts)
            .statesProcess()
            .tableStatesProcess()
            .tableProcess();
    },
};
</script>

<style scoped>
.subs {
    padding: 24px;
    display: flex;
    flex: 1 1 auto;
    flex-direction: column;
}
@media (max-width: 900px) {
    .subs {
        padding: 24px 12px 24px;
    }
}
.subs_title {
    display: none;
}
@media (max-width: 500px) {
    .subs_title {
        display: inline-flex;
    }
}
.subs__wrapper {
    width: 100%;
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    gap: 16px;
}
</style>

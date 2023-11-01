<template>
    <div class="subs">
        <div class="subs__wrapper">
            <main-title class="subs_title">{{ $t("title") }} </main-title>
            <div
                v-if="!service.waitSubs && !service.emptySubs"
                class="subs__wrapper"
            >
                <sub-header
                    class="subs__header"
                    :subs-type="service.subsType"
                    @changeType="toggleIsTable($event)"
                    @searched="service.searchSub($event)"
                />
                <sub-list
                    :subs-type="service.subsType"
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
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainPreloader from "@/modules/preloader/Components/MainPreloader.vue";
import { mapGetters } from "vuex";
import SubHeader from "@/modules/subs/Components/SubHeader.vue";
import SubList from "@/modules/subs/Components/SubList.vue";
import { SubMessages } from "@/modules/subs/lang/SubMessages";
import { SubService } from "@/modules/subs/services/SubService";

export default {
    components: {
        SubList,
        SubHeader,
        MainTitle,
        MainPreloader,
    },
    i18n: {
        sharedMessages: SubMessages,
    },
    data() {
        return {
            service: new SubService(),
        };
    },
    watch: {
        allAccounts(newAccountsList) {
            this.service
                .setSubList(newAccountsList)
                .statesProcess()
                .tableProcess()
                .tableStatesProcess();
        },
        "$i18n.locale"() {
            this.service.setDocumentTitle(this.$t("title"));

            this.service
                .setSubList(this.allAccounts)
                .statesProcess()
                .tableProcess()
                .tableStatesProcess();
        },
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
    mounted() {
        this.service.setDocumentTitle(this.$t("title"));

        this.service
            .setSubList(this.allAccounts)
            .statesProcess()
            .tableStatesProcess()
            .tableProcess();
    },
    methods: {
        toggleIsTable(subsTypeState = null) {
            this.service.toggleSubsType(subsTypeState);
        },
    },
};
</script>

<style scoped>
.subs {
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

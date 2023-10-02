<template>
    <div class="subs">
        <div class="subs__wrapper">
            <main-title class="sub_title" tag="h4">{{
                $t("subs.title")
            }}</main-title>
            <div class="subs__content" v-show="!service.waitSubs && !service.emptySubs">
                <sub-header
                    class="subs__header"
                    :subsType="service.subsType"
                    @changeType="toggleIsTable"
                />
<!--                <sub-list-->
<!--                    :subsType="service.subsType"-->
<!--                    :table="service.subsTable"-->
<!--                    :wait="service.waitTable"-->
<!--                    :empty="service.emptyTable"-->
<!--                />-->
            </div>
            <main-preloader
                class="cabinet__preloader"
                :wait="service.waitSubs"
                :interval="50"
                :end="service.emptySubs"
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
            this.service.setSubList(newAccountsList);
        },
        '$i18n.locale'() {
            this.service.setSubList(this.allAccounts)
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
        this.service.setDocumentTitle(this.$t("accounts.title"));
        this.service.setSubList(this.allAccounts);

        if (this.$t) {
            this.service.setTranslate(this.$t);
        }
    },
};
</script>

<style lang="scss" scoped>
.sub_title {
    display: none;
}
@media (max-width: 500px) {
    .sub_title {
        display: inline-block;
        padding: 0 0 0px 16px;
        color: var(--text-primary);
        font-family: Unbounded !important;
        font-size: 20px !important;
        font-style: normal;
        font-weight: 400;
        line-height: 32px; /* 160% */
    }
}
.subs__header {
    margin-bottom: 24px;
}
@media(max-width:500px){
    .subs__header {
        margin-bottom: 16px;
    }
}
.subs_input {
    width: 349px;
    padding: 12px 12px 12px 44px;
    border-radius: 12px;
    background: var(--background-island);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    color: var(--text-secondary, #475467);
    font-family: NunitoSans;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 20px; /* 142.857% */
}
.buttons__block {
    display: flex;
    gap: 12px;
    position: relative;
}
.current-state {
    background: var(--background-island);
    transition: all 0.2s linear;
}
.button_choose-state {
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--buttons-fourth-fill-border-default, #2c2f34);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
}
.button__container {
    border-radius: 12px;
    padding: 8px;
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    width: 78px;
}
@media (max-width: 900px) {
    .button_choose-state {
        display: none;
    }
    .subs_input {
        max-width: 244px;
    }
    .button__container {
        width: 40px;
    }
}
.input__container {
    position: relative;
}
.input_svg {
    position: absolute;
    top: 8px;
    left: 12px;
}

.subs {
    padding: 24px;
    display: flex;
    flex: 1 1 auto;
    flex-direction: column;
    @media (max-width: 900px) {
        padding: 24px 12px 24px;
    }
    &__wrapper {
        width: 100%;
        flex: 1 1 auto;
    }
    &__content {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        &.preloader {
            display: flex;
        }
        @media (max-width: 1320.98px) {
            grid-template-columns: 1fr;
        }
        @media (max-width: 991.98px) {
            grid-template-columns: repeat(2, 1fr);
        }
        @media (max-width: 767.98px) {
            grid-template-columns: 1fr;
            gap: 8px;
        }
    }
    &__title {
        display: inline-flex;
        justify-content: space-between;
        margin-bottom: 16px;
        width: 100%;
        align-items: center;
        @media (max-width: 767.98px) {
            margin-bottom: 18px;
        }
    }
}
</style>

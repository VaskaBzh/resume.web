<template>
    <div class="settings" ref="page">
        <div class="settings__main">
            <main-title class="profile cabinet_title" tag="h3">{{
                $t("title")
            }}</main-title>
            <div class="settings__content">
                <settings-list
                    :rows="settingsService.rows"
                    @openPopup="settingsService.getHtml($event)"
                />
                <!--                    @send2fac="settingsService.send2Fac"-->
                <div class="settings__column">
<!--                    <settings-block-->
<!--                        :title="$t('cards.profit.title')"-->
<!--                        :text="$t('cards.profit.text')"-->
<!--                        :button="$t('cards.profit.button')"-->
<!--                        :value="settingsService.profit"-->
<!--                        :success="settingsService.clearProfit"-->
<!--                        @clicked="settingsService.setClearProfit($event)"-->
<!--                        :currency="true"-->
<!--                    />-->
                    <settings-block
                        :title="$t('cards.referral.title')"
                        :placeholder="$t('cards.referral.placeholder')"
                        :button="$t('cards.referral.button')"
                        :value="settingsService.userData.code"
                        :disabled="!!settingsService.userData.code"
                        @clicked="settingsService.setReferral($event)"
                    />
                </div>
            </div>
        </div>
    </div>
    <teleport to="body">
        <settings-popup
            :errors="errors"
            :form="settingsService.form"
            :validate="settingsService.validate"
            :wait="settingsService.waitAjax"
            :closed="settingsService.closed"
            @ajaxChange="settingsService.ajaxChange($event)"
            @validate="
                settingsService.validateProcess(
                    !!$event.target ? $event.target.value : $event
                )
            "
        />
    </teleport>
</template>
<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import SettingsBlock from "@/modules/settings/Components/blocks/SettingsBlock.vue";
import SettingsList from "@/modules/settings/Components/blocks/SettingsList.vue";
import SettingsPopup from "@/modules/settings/Components/blocks/SettingsPopup.vue";

import { SettingsService } from "@/modules/settings/services/SettingsService";
import { SettingsMessage } from "../../../modules/settings/lang/SettingsMessage";

export default {
    layout: profileLayoutView,
    i18n: {
        sharedMessages: SettingsMessage,
    },
    components: {
        MainTitle,
        SettingsBlock,
        SettingsList,
        SettingsPopup,
    },
    props: {
        errors: Object,
        message: String,
        user: Object,
        auth_user: Boolean,
        referral_code: String,
    },
    data() {
        return {
            settingsService: new SettingsService(this.$t, this.user, this.referral_code),
            is_checked: true,
            notification: true,
            password_confirmation: "",
            clearProfit: "",
            profit: "",
        };
    },
    watch: {
        "settingsService.profit"(newValue) {
            this.settingsService.setProfit(newValue.replace(/[^0-9]/g, ""));
        },
        user() {
            this.settingsService.setUserData();
        },
    },
    methods: {
        settingsProcess() {
            this.settingsService.setUserData();
            this.settingsService.setForm();
            this.settingsService.setRows();
            this.settingsService.setProfits();
        },
    },
    mounted() {
        document.title = this.$t("header.links.settings");
        this.$refs.page.style.opacity = 1;

        this.settingsProcess();
    },
};
</script>
<style lang="scss" scoped>
.settings {
    width: 100%;
    transition: all 0.3s linear 0.2s;
    opacity: 0;
    @media (max-width: 1271.98px) {
        transition: all 0.3s ease 0s;
    }
    &__main {
        width: 100%;
    }
    &__content {
        width: 100%;
        display: flex;
        gap: 32px;
        @media (max-width: $tablet) {
            flex-direction: column;
            gap: 24px;
        }
        @media (max-width: $mobile) {
            gap: 32px;
        }
    }
    &__column {
        display: flex;
        flex-direction: column;
        gap: 16px;
        width: 100%;
        transition: all 0.3s ease 0s;
        @media (max-width: $tablet) {
            gap: 24px;
        }
        @media (max-width: $mobile) {
            gap: 12px;
        }
    }

    &__checkbox {
        width: calc(50% - 32px / 2);
        justify-content: space-between;
        @media (max-width: 767.98px) {
            height: 28px;
            width: 100%;
        }
    }
}
</style>

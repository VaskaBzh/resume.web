<template>
    <div class="settings" ref="page">
        <main-title class="title-settings" tag="h3">{{
                    $t("title[2]")
                }}</main-title>
        <div class="settings__main">
            <div class="settings__card">
                <main-title class="cabinet_title" tag="h3">{{
                    $t("title[0]")
                }}</main-title>
                <div class="settings__content">
                    <settings-list
                        :rows="settingsService.rows"
                        @openPopup="settingsService.getHtml($event)"
                        :verifyTimer="settingsService.verifyTimer"
                    />
                </div>
            </div>
            <div class="settings__card">
                <main-title class="cabinet_title" tag="h3">{{
                    $t("title[1]")
                }}</main-title>
                <article class="card__article">
                    <div
                        class="card__container"
                        v-for="card in settingsService.blocks"
                    >
                        <SafetyCard :card="card" @send2fac="sendFac" />
                    </div>
                </article>
            </div>
        </div>
    </div>
    <settings-popup
        v-if="settingsService.form !== {}"
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
    <fac-popup
        :opened="settingsService.openedFacPopup"
        :wait="settingsService.waitAjax"
        :closed="settingsService.closedFacPopup"
        :qrCode="settingsService.qrCode"
        :code="settingsService.code"
        @sendVerify="sendVerify($event)"
    />
</template>
<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import SettingsList from "@/modules/settings/Components/blocks/SettingsList.vue";
import SettingsPopup from "@/modules/settings/Components/blocks/SettingsPopup.vue";
import { SettingsService } from "@/modules/settings/services/SettingsService";
import { SettingsMessage } from "@/modules/settings/lang/SettingsMessage";
import { mapGetters } from "vuex";
import SafetyCard from "@/modules/settings/Components/blocks/SafetyCard.vue";
import FacPopup from "@/modules/settings/Components/blocks/FacPopup.vue";

export default {
    i18n: {
        sharedMessages: SettingsMessage,
    },
    components: {
        MainTitle,
        SettingsList,
        SettingsPopup,
        SafetyCard,
        FacPopup,
    },
    props: {
        message: String,
        auth_user: Boolean,
    },
    computed: {
        ...mapGetters(["user"]),
        img() {
            return new URL(
                `/resources/assets/img/${this.card.img}`,
                import.meta.url
            );
        },
    },
    data() {
        return {
            settingsService: new SettingsService(this.$t),
            is_checked: true,
            notification: true,
            password_confirmation: "",
            clearProfit: "",
            profit: "",
        };
    },
    watch: {
        "$i18n.locale"() {
            document.title = this.$t("header.links.settings");
        },
        "settingsService.profit"(newValue) {
            this.settingsService.setProfit(newValue.replace(/[^0-9]/g, ""));
        },
        user(newUser) {
            this.settingsService.setUser(newUser);
            this.settingsService.setUserData();

            this.settingsProcess();
        },
    },
    methods: {
        async sendFac() {
            await this.settingsService.sendFac();
        },
        async sendVerify(form) {
            await this.settingsService.sendVerify(form);
        },
        settingsProcess() {
            this.settingsService.setUserData();
            this.settingsService.setForm();
            this.settingsService.setRows();
            this.settingsService.setBlocks();
            this.settingsService.setProfits();
        },
    },
    mounted() {
        document.title = this.$t("header.links.settings");
        this.$refs.page.style.opacity = 1;

        this.settingsService.setUser(this.user);
        this.settingsService.setUserData();

        this.settingsProcess();
    },
};
</script>
<style lang="scss" scoped>
.title-settings {
    display: none;
}
@media (max-width: 500px) {
    .title-settings {
        display: inline-block;
        padding: 0 0 16px 16px;
    }
}
.card__article {
    display: flex;
    flex-direction: column;
    gap: 32px;
}
.card__container {
    display: flex;
    justify-content: space-between;
}
@media (max-width: 900px) {
    .card__container {
        flex-direction: column;
        gap: 16px;
        padding: 0;
    }
}
.settings {
    padding: 24px;
    width: 100%;
    flex: 1 1 auto;
    transition: all 0.3s linear 0.2s;
    opacity: 0;
    @media (max-width: 1271.98px) {
        transition: all 0.3s ease 0s;
    }
    @media (max-width: 900px) {
        padding: 24px 12px 24px;
    }
    &__main {
        width: 100%;
        height: calc(100vh - 135px);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 12px;
        @media(max-width: 500px){
            height: auto;
        }
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
    &__card {
        border-radius: 24px;
        background: var(--background-island, #fff);
        padding: 24px;
        box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
        width: 711px;
        @media (max-width: 900px) {
            width: 90vw;
        }
    }
}
</style>

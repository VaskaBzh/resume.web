<template>
    <main-popup
        id="changes"
        class="popup-changes"
        :wait="wait"
        :closed="closed"
        :errors="errors"
    >
        <form
            @submit.prevent="
                form.type === $t('inputs.password')
                    ? getValue(true)
                    : getValue(false)
            "
            class="form form-popup popup__form"
        >
        <div class="header_card">
            <main-title tag="h3">{{
                `${
                    form.type !== "почту"
                        ? $t("popup.title")
                        : $t("popup.title_email")
                } ${form.type}`
            }}</main-title>
            <p class="popup-text">{{ $t("popup.text[0]") }}</p>
        </div>
            <input
                v-model="item"
                autofocus
                :type="
                    form.type === $t('inputs.password') ? 'password' : 'text'
                "
                class="input popup__input"
                :placeholder="placeholder"
            />
            <!--            :placeholder="`${$t(-->
            <!--            'settings.block.settings_block.popup.placeholders.placeholder'-->
            <!--            )} ${form.type}`"-->
            <settings-password
                v-if="form.type === $t('inputs.password')"
                name="password"
                :placeholder="`${$t('popup.placeholders.password_new')} ${
                    form.type
                }`"
                :model="password"
                :errors="errors"
                @change="$emit('validate', $event)"
            />
            <main-validate :validate="validate" />
            <settings-password
                v-if="form.type === $t('inputs.password')"
                name="password"
                :placeholder="`${$t(
                    'popup.placeholders.password_confirmation'
                )} ${form.type}`"
                :model="password_confirmation"
                :errors="errors"
                @change="password_confirmation = $event"
            />
            <div class="btn__block">
                <blue-button class="btn-back">
                        {{ $t("popup.button[0]") }}
                 </blue-button>
                <blue-button>
                        <popup-loading-icon />
                        {{ $t("popup.button[1]") }}
                        {{ form.type }}
                 </blue-button>
            </div>

        </form>
    </main-popup>
</template>

<script>
import MainPopup from "@/Components/technical/MainPopup.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import MainValidate from "@/modules/validate/Components/MainValidate.vue";
import PopupLoadingIcon from "@/modules/common/icons/PopupLoadingIcon.vue";
import SettingsPassword from "@/modules/settings/Components/SettingsPassword.vue";
import { SettingsMessage } from "@/modules/settings/lang/SettingsMessage";
import MainTitle from "@/Components/UI/MainTitle.vue";

export default {
    name: "settings-popup",
    i18n: {
        sharedMessages: SettingsMessage,
    },
    props: {
        errors: Object,
        form: Object,
        validate: Object,
        wait: Boolean,
        closed: Boolean,
    },
    components: {
        MainPopup,
        MainTitle,
        SettingsPassword,
        BlueButton,
        MainValidate,
        PopupLoadingIcon,
    },
    data() {
        return {
            item: "",
            placeholder: this.form.item,
            password_confirmation: this.form.password_confirmation,
            password: this.form.password,
        };
    },
    methods: {
        getValue(bool) {
            this.$emit("ajaxChange", { password: bool, value: this.item });
        },
    },
    watch: {
        "form.item"(newValue) {
            this.placeholder = newValue;
        },
    },
};
</script>

<style scoped lang="scss">
.header_card{
    margin-bottom: 40px;
}
.btn__block{
    display: flex;
    width: 100%;
    justify-content: space-between;
    margin-top: 80px;
    gap: 12px;
}
.btn-back{
    border-radius: 12px;
    border: 1px solid var(--light-gray-400, #98A2B3);
    padding: 12px 16px;
    background: inherit;
    color: var(--light-gray-600, #475467);
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: 175%; /* 31.5px */
}
.popup-text{
    color: var(--light-gray-400, #98A2B3);
    font-family: NunitoSans;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%; /* 24px */
}
.form_wrapper-message {
    position: relative;
    left: 0;
    top: 0;
    opacity: 1;
    width: 100%;
    .form_message {
        opacity: 1;
        width: 100%;
    }
}
</style>

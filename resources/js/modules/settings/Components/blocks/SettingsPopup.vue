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
                form.type === 'пароль' ? getValue(true) : getValue(false)
            "
            class="form form-popup popup__form"
        >
            <main-title tag="h3">{{
                `${
                    form.type !== "почту"
                        ? $t("settings.block.settings_block.popup.title")
                        : $t("settings.block.settings_block.popup.title_email")
                } ${form.type}`
            }}</main-title>
            <input
                v-model="item"
                autofocus
                :type="form.type === 'пароль' ? 'password' : 'text'"
                class="input popup__input"
                :placeholder="placeholder"
            />
            <!--            :placeholder="`${$t(-->
            <!--            'settings.block.settings_block.popup.placeholders.placeholder'-->
            <!--            )} ${form.type}`"-->
            <settings-password
                v-if="form.type === 'пароль'"
                name="password"
                :placeholder="`${$t(
                    'settings.block.settings_block.popup.placeholders.password_new'
                )} ${form.type}`"
                :model="password"
                :errors="errors"
                @change="$emit('validate', $event)"
            />
            <main-validate :validate="validate" />
            <settings-password
                v-if="form.type === 'пароль'"
                name="password"
                :placeholder="`${$t(
                    'settings.block.settings_block.popup.placeholders.password_confirmation'
                )} ${form.type}`"
                :model="password_confirmation"
                :errors="errors"
                @change="password_confirmation = $event"
            />
            <blue-button>
                <button type="submit" class="all-link">
                    <popup-loading-icon />
                    {{ $t("settings.block.settings_block.popup.button") }}
                    {{ form.type }}
                </button>
            </blue-button>
        </form>
    </main-popup>
</template>

<script>
import MainPopup from "@/Components/technical/MainPopup.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import MainValidate from "@/modules/common/Components/MainValidate.vue";
import PopupLoadingIcon from "@/modules/common/icons/PopupLoadingIcon.vue";
import SettingsPassword from "@/modules/settings/Components/SettingsPassword.vue";

export default {
    name: "settings-popup",
    props: {
        errors: Object,
        form: Object,
        validate: Object,
        wait: Boolean,
        closed: Boolean,
    },
    components: {
        MainPopup,
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

<template>
    <main-popup
        id="password"
        ref="password"
        :opened="opened"
        :wait="wait"
        :closed="closed"
        :makeResize="makeResize"
    >
        <div class="password__head">
            <main-title tag="h3">{{ $t("password_popup.title") }}</main-title>
            <main-description>{{ $t("password_popup.description") }}</main-description>
        </div>
        <div class="password__content">
            <profile-password
                class="password_input"
                name="password"
                :placeholder="this.$t('password_popup.placeholders.new_password')"
                :model="form.password"
                @change="changePasswordForm('password', $event)"
            />
            <main-validate :validate="validateService.validate"/>
            <profile-password
                class="password_input password_input-last"
                name="password"
                :placeholder="this.$t('password_popup.placeholders.confirm_password')"
                :model="form['password_confirmation']"
                @change="changePasswordForm('password_confirmation', $event)"
            />
            <main-button
                class="button-blue password_button button-full"
                @click="closePopup"
            >
                <template v-slot:text>{{
                        $t("password_popup.button")
                    }}
                </template>
            </main-button>
        </div>
    </main-popup>
</template>

<script>
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescriptionOld.vue";
import MainCopy from "@/modules/common/Components/UI/MainCopy.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import {mapGetters} from "vuex";
import {SettingsMessage} from "@/modules/settings/lang/SettingsMessage";
import ProfilePassword from "@/modules/common/Components/inputs/ProfilePassword.vue";
import MainValidate from "../../../validate/Components/MainValidate.vue";

export default {
    name: "password-popup",
    props: {
        opened: Boolean,
        closed: Boolean,
        wait: Boolean,
        validateService: Object,
    },
    i18n: {
        sharedMessages: SettingsMessage,
    },
    watch: {
        "form.password"() {
            setTimeout(() => {
                this.makeResize = true
                setTimeout(() => this.makeResize = false, 50);
            }, 355);
        }
    },
    data() {
        return {
            form: {
                password: "",
                "password_confirmation": "",
            },
            makeResize: false,
        };
    },
    computed: {
        ...mapGetters(["errorsExpired"]),
    },
    components: {
        MainValidate,
        ProfilePassword,
        MainDescription,
        MainPopup,
        MainTitle,
        MainCopy,
        MainButton,
    },
    methods: {
        closePopup() {
            this.$emit("sendPassword", this.form);
        },
        changePasswordForm(formKey, event) {
            const formValue = !!event.target ? event.target.value : event;

            this.form[formKey] = formValue;

            this.$emit("changePassword", this.form);
            this.validateService.validateProcess(this.form.password);
        },
    },
};
</script>

<style scoped>
.password__head {
    display: flex;
    flex-direction: column;
    gap: 4px;
    margin-bottom: 40px;
}

.password_button {
    min-height: 56px;
}

.password_input {
    margin-bottom: 16px;
}

.password_input-last {
    margin-bottom: 80px;
}
</style>

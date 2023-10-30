<template>
    <main-popup
        id="password"
        ref="password"
        :opened="opened"
        :wait="wait"
        :closed="closed"
        :make-resize="makeResize"
    >
        <div class="password__head">
            <main-title>{{ $t("password_popup.title") }}</main-title>
            <main-description
                >{{ $t("password_popup.description") }}
            </main-description>
        </div>
        <form @submit.prevent="closePopup" class="password__content">
            <span class="password_error"
                  v-if="validateInputs"
                  :class="{'active-error': this.errorsValid.includes(this.errorMassage)}"
            >
                {{ errorMassage }}
            </span>
            <profile-password
                class="password_input"
                name="password"
                ref="password"
                :placeholder="$t('password_popup.placeholders.new_password')"
                :model="form.password"
                @changeValue="changePasswordForm('password', $event)"
                :class="{'not-validate' : validateInputs}"
            />

            <main-validate :validate="validateService.validate" />
            <profile-password
                class="password_input password_input-last"
                name="password"
                :placeholder="
                    $t('password_popup.placeholders.confirm_password')
                "
                :model="form['password_confirmation']"
                @changeValue="changePasswordForm('password_confirmation', $event)"
            />
            <main-button
                type="submit"
                class="button-blue password_button button-full"

            >
                <template #text>{{ $t("password_popup.button") }}</template>
            </main-button>
        </form>
    </main-popup>
</template>

<script>
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescriptionOld.vue";
import MainCopy from "@/modules/common/Components/UI/MainCopy.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import { mapGetters } from "vuex";
import { SettingsMessage } from "@/modules/settings/lang/SettingsMessage";
import ProfilePassword from "@/modules/common/Components/inputs/ProfilePassword.vue";
import MainValidate from "../../../validate/Components/MainValidate.vue";
import loginForm from "../../../auth/Components/blocks/LoginForm.vue";

export default {
    name: "PasswordPopup",
    props: {
        opened: Boolean,
        closed: Boolean,
        wait: Boolean,
        validateService: Object,
    },
    i18n: {
        sharedMessages: SettingsMessage,
    },
    data() {
        return {
            form: {
                password: "",
                password_confirmation: "",
            },
            makeResize: false,
            validateInputs: false,
            errorsValid: [
                'Заполните необходимые поля',
                'Ваши пароли не совпадают',
                'Введенные данные не корректны'
            ],
            errorMassage: '',
        };
    },
    watch: {
        "form.password"(newVal, oldVal) {
            setTimeout(() => {
                this.makeResize = true;
                setTimeout(() => (this.makeResize = false), 50);
            }, 355);
            if(this.validateInputs && newVal !== oldVal) {
                this.validateInputs = false
            }
            console.log(newVal, oldVal)
        },
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
            // let indexError;
            // if(this.form.password.length === 0 && this.form["password_confirmation"].length === 0) {
            //     indexError = 0
            //     this.validateInputs = true
            //     this.errorMassage = this.errorsValid[indexError]
            //
            // }
            // if(this.form.password.length < this.form["password_confirmation"] || this.form.password.length > this.form["password_confirmation"]) {
            //     indexError = 1
            //     this.validateInputs = true
            //     this.errorMassage = this.errorsValid[indexError]
            //
            // }
            // if(Object.keys(this.validateService.validate).length !== 0) {
            //     indexError = 2
            //     this.validateInputs = true
            //     this.errorMassage = this.errorsValid[indexError]
            //
            // }
            if(this.form.password === this.form['password_confirmation'] && Object.keys(this.validateService.validate).length === 0 && this.form.password.length > 0) {
                this.$emit("sendPassword", this.form);
            } else {
                this.validateInputs = true
            }

        },
        changePasswordForm(formKey, event) {
            const formValue = event.target ? event.target.value : event;



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

.not-validate {
    border: 1px solid #F1404A;
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    border-radius: 12px;
    transition: all 0.5s ease 0s;
    outline: none;
}

.password_error {
    max-height: 0;
    overflow: hidden;
    color: #F1404A;
    font-family: NunitoSans, serif;
    font-size: 12px;
    font-style: normal;
    font-weight: 400;
    line-height: 16px;
    transition: max-height 1s ease-in;
}

.active-error {
    max-height: 100%;
    transition: all 1s ease-in;
}
</style>

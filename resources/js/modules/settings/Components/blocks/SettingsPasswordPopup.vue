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
        <form  @submit.prevent="closePopup" class="password__content">
            <profile-password
                class="password_input"
                name="old_password"
                :placeholder="
                    $t('password_popup.placeholders.current_password')
                "
                :model="form.old_password"
                @changeValue="changePasswordForm('old_password', $event)"
            />
            <profile-password
                class="password_input"
                name="password"
                :placeholder="$t('password_popup.placeholders.new_password')"
                :model="form.password"
                :class="{'not-validate' : validateInputs}"
                @changeValue="changePasswordForm('password', $event)"
            />
            <main-validate :validate="validateService.validate" />
            <profile-password
                class="password_input password_input-last"
                name="password"
                :placeholder="
                    $t('password_popup.placeholders.confirm_password')
                "
                :model="form['password_confirmation']"
                :class="{'not-validate' : validateInputs}"
                @changeValue="changePasswordForm('password_confirmation', $event)"
            />
            <transition name="error">
                <span class="password_error"
                      v-if="validateInputs"
                      :class="{'active-error': errorMassage}"
                >
                {{ $t('error.password-confirmation') }}
            </span>
            </transition>
            <main-button
                type="submit"
                class="button-blue password_button button-full"
                :disabled="sendButton"
                :class="{'active-disabled': sendButton}"
            >
                <template #text>{{ $t("password_popup.button") }} </template>
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

export default {
    name: "PasswordPopup",
    props: {
        opened: Boolean,
        closed: Boolean,
        wait: Boolean,
        validateService: Object,
        formData: Object,
    },
    i18n: {
        sharedMessages: SettingsMessage,
    },
    data() {
        return {
            form: this.formData,
            makeResize: false,
            sendButton: true,
            validateInputs: false,
            errorMassage: false,
        };
    },
    watch: {
        "form.password"(newVal, oldVal) {
            setTimeout(() => {
                this.makeResize = true;
                setTimeout(() => (this.makeResize = false), 50);
            }, 355);

            if(Object.keys(this.validateService.validate).length !== 0 && newVal !== oldVal) {
                this.validateInputs = false
                this.sendButton = true
            }

            if(this.validateInputs && newVal !== oldVal) {
                this.validateInputs = false
            }
        },
        "form.password_confirmation"(newVal, oldVal) {
            if(this.validateInputs && newVal !== oldVal) {
                this.validateInputs = false
            }
            if(newVal && Object.keys(this.validateService.validate).length === 0) {
                this.sendButton = false
            }
        },
        formData(newFormData) {
            this.form = {
                ...this.form,
                ...newFormData,
            };
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
           if (this.form.password === this.form['password_confirmation']) {

               this.$emit("sendPassword", this.form)
           } else {
               this.validateInputs = true
               this.errorMassage = true
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
    border: 2px solid transparent;
}

.password_input-last {
    margin-bottom: 80px;
}

.active-disabled {
    opacity: 0.6;
    pointer-events: none;
}

.not-validate {
    border: 2px solid #F1404A;
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    border-radius: 12px;
    transition: all 0.5s ease 0s;
    outline: none;
}

.password_error {
    max-height: 0;
    overflow: hidden;
    color: #F1404A;
    position: absolute;
    left: 0;
    bottom: 25%;
    font-family: NunitoSans, serif;
    font-size: 12px;
    font-style: normal;
    font-weight: 400;
    line-height: 16px;
    transition: max-height 1s ease-in;
}

.active-error {
    padding: 5px;
    max-height: 100%;
    transition: all .35s ease-in;
}

.error-enter-active,
.error-leave-active {
    position: absolute;
    transition: all .35s ease-in-out;
}
.error-enter-from,
.error-leave-to {
    opacity: 0;
    transform: translateX(-30px);
    max-height: 0;
    padding-top: 0;
}
</style>

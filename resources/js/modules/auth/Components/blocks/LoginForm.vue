<template>
    <form class="form-auth" @submit.prevent="service.login">
        <main-title class="form-auth_title"
            >{{ $t("auth.login.title") }}
        </main-title>
        <auth-errors :errors="errors" />
        <div class="form-auth__content">
            <auth-input
                :error="errorsExpired.error ?? errorsExpired.email"
                :model="service.form.email"
                :placeholder="$t('auth.login.placeholders[0]')"
                name="email"
                type="email"
                @change="
                    service.form.email = !!$event.target
                        ? $event.target.value
                        : $event
                "
            />
            <div
                class="form-auth_row password_row"
                :class="{ error: errorsExpired.error }"
            >
                <main-password
                    name="password"
                    :placeholder="$t('auth.login.placeholders[1]')"
                    :model="service.form.password"
                    :errors="errors"
                    @change="
                        service.form.password = !!$event.target
                            ? $event.target.value
                            : $event
                    "
                />
            </div>
        </div>
        <input
            id="checkbox"
            v-model="service.form.remember"
            class="form-auth_checkbox"
            type="checkbox"
        />
        <label for="checkbox">
            <div class="fake">
                <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M9.50538 18L4 12.2809L5.05684 11.183L9.50538 15.8043L18.9432 6L20 7.09787L9.50538 18Z"
                        fill="#7C7C7C"
                    />
                    <rect
                        x="0.5"
                        y="0.5"
                        width="23"
                        height="23"
                        rx="3.5"
                        stroke="#7C7C7C"
                    />
                </svg>
            </div>
            <span>{{ $t("auth.login.checkbox") }}</span>
        </label>
        <blue-button class="form-auth_button auth" type="submit"
            ><a class="all-link">{{ $t("auth.login.button") }}</a></blue-button
        >
        <verify-link
            class="form-auth_forgot-password"
            verify-url="/password/forgot"
            :verify-text="$t('auth.login.reset')"
            :data="service.form"
        />
        <p class="text text-light form-auth_text">
            {{ $t("auth.login.link[0]") }}
            <router-link :to="{ name: 'registration' }" class="form-auth_link">
                {{ $t("auth.login.link[1]") }}
            </router-link>
        </p>
    </form>
    <password-popup
        :opened="service.openedPasswordPopup"
        :wait="service.waitAjax"
        :closed="service.closedPasswordPopup"
        :validate-service="service"
        @sendPassword="sendPassword($event)"
    />
    <verify-popup
        :closed="service.closedTwoFacPopup"
        :opened="service.openedTwoFacPopup"
    >
        <two-fac-form
            title="form.fac.title"
            text="form.fac.text"
            placeholder="form.fac.placeholder"
            button_text="form.fac.button_text"
            @sendForm="loginWithSecretCode($event)"
        />
    </verify-popup>
</template>

<script>
import pdf from "@/../assets/files/policy.pdf";
import AuthInput from "@/modules/auth/Components/UI/AuthInput.vue";
import MainPassword from "@/modules/common/Components/inputs/MainPassword.vue";
import AuthErrors from "@/modules/auth/Components/UI/AuthErrors.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import BlueButton from "@/modules/common/Components/UI/ButtonBlue.vue";
import PasswordPopup from "@/modules/common/Components/blocks/PasswordPopup.vue";
import VerifyLink from "@/modules/verify/Components/UI/VerifyLink.vue";

import { AuthMessages } from "@/modules/auth/lang/AuthMessages";
import { LoginService } from "@/modules/auth/services/LoginService";
import { mapGetters } from "vuex";
import VerifyPopup from "../../../verify/Components/VerifyPopup.vue";
import TwoFacForm from "../../../verify/Components/TwoFacForm.vue";

export default {
    name: "LoginForm",
    components: {
        TwoFacForm,
        VerifyPopup,
        VerifyLink,
        AuthInput,
        MainPassword,
        AuthErrors,
        MainTitle,
        BlueButton,
        PasswordPopup,
    },
    i18n: {
        sharedMessages: AuthMessages,
    },
    computed: {
        ...mapGetters(["errors", "errorsExpired"]),
    },
    data() {
        return {
            pdf,
            service: new LoginService(this.$router, this.$route),
        };
    },
    watch: {
        "$i18n.locale"() {
            this.service.setTranslate(this.$t);
        },
    },
    mounted() {
        this.service.setForm();

        if (this.$route.query?.action === "password") {
            this.openPasswordPopup();
        }
        if (this.$route.query?.action === "email") {
            this.$store.dispatch("setNotification", {
                status: "success",
                title: "success",
                text: this.$t("validate_messages.verify_message"),
            });
        }

        if (this.$t) {
            this.service.setTranslate(this.$t);
        }
    },
    methods: {
        async loginWithSecretCode(secret) {
            this.service.form.google2fa_code = secret;
            await this.service.login();
        },
        async sendPassword(form) {
            await this.service.sendPassword(form);
        },
        async openPasswordPopup() {
            await this.service.openPasswordPopup();
        },
    },
};
</script>

<style scoped lang="scss">
.form-auth {
    gap: 0;
    width: 100%;
    @media (max-width: 991.98px) {
        padding: 0 clamp(16px, 5vw, 60px);
    }

    .form-auth_forgot-password {
        font-size: 20px;
        color: rgb(63, 123, 221);
        font-weight: 600;
        min-height: 56px;
        display: inline-flex;
        align-items: center;
        margin-left: 36px;
        @media (max-width: 1279.98px) {
            width: 100%;
            margin-left: 0;
        }
    }

    &__content {
        display: flex;
        flex-direction: column;
        width: 100%;
        gap: 16px;
        @media (min-width: 991.98px) {
            max-width: 536px;
        }
    }

    &_title {
        margin-bottom: 32px;
        // @media (max-width: 1550px) {
        //     margin-bottom: 16px;
        // }
        @media (max-width: $tablet) {
            // text-align: center;
        }
        @media (max-width: $mobile) {
            margin-bottom: 24px;
        }
    }

    &_button {
        padding: 0;
        margin: 0;
        background: rgb(63, 123, 221);
        color: #fff;
        text-transform: lowercase;
        border: none;
        width: fit-content;
        border-radius: 16px;
        @media (max-width: $mobileSmall) {
            min-width: 100%;
        }

        & .all-link {
            padding: 0;
            font-size: 20px;
            font-weight: 500;
            line-height: 135%;
            min-width: 300px;
        }

        @media (max-width: $tablet) {
            width: 100%;
            & .all-link {
                padding: 18px 0;
            }
        }
        @media (max-width: $mobile) {
            & .all-link {
                font-size: 16px;
                padding: 14px 0;
            }
        }
    }

    &_text {
        font-size: 24px;
        font-family: AmpleSoftPro, serif;
        font-weight: 500;
        line-height: 135%;
        margin-top: 48px;
        @media (max-width: 1550px) {
            margin-top: 40px;
        }
        @media (max-width: $tablet) {
            text-align: center;
        }
        // @media (max-width: $mobile) {
        //     margin-top: 32px;
        // }
        // @media (max-width: $mobileSmall) {
        //     margin-top: 24px;
        // }
        @media (max-width: $mobileSmall) {
            font-size: 14px;
            line-height: 130%;
        }
    }

    &_checkbox {
        display: none;

        &:checked + label .fake svg path {
            fill: #7c7c7c;
        }

        & + label {
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 16px;
            color: #7c7c7c;
            font-size: 24px;
            font-family: AmpleSoftPro, serif;
            line-height: 135%;
            margin: 16px 0 40px;
            position: relative;
            width: 100%;

            .form-auth_link {
                @media (max-width: $tablet) {
                    display: block;
                }
            }

            @media (max-width: 1550px) {
                margin: 16px 0 32px;
            }

            @media (max-width: $mobileSmall) {
                margin: 16px 0 24px;
                gap: 8px;
                font-size: 14px;
                font-family: Ubuntu, serif;
                line-height: 130%;
                .form_link {
                    font-size: inherit;
                    line-height: 130%;
                }
            }

            &.error {
                color: #e5403f !important;

                &:before {
                    border-color: #e5403f !important;
                }
            }

            .fake {
                width: 24px;
                height: 24px;

                & svg {
                    & path {
                        transition: all 0.3s ease 0s;
                        fill: rgba(0, 0, 0, 0);
                    }
                }

                @media (max-width: $mobileSmall) {
                    height: 16px;
                    width: 16px;
                    & svg {
                        height: 16px;
                        width: 16px;
                    }
                }
            }
        }
    }

    &_row {
        min-height: 56px;
        width: 100%;
        position: relative;
        @media (max-width: 479.98px) {
            min-height: 40px;
        }
    }

    &_link {
        color: rgba(63, 123, 221, 1);
        font-size: 24px;
        font-family: AmpleSoftPro, serif;
        font-weight: 500;
        line-height: 135%;
        @media (max-width: $mobileSmall) {
            font-size: 14px;
            font-family: Ubuntu, serif;
            line-height: 130%;
        }
    }
}
</style>

<template>
    <form @submit.prevent="service.account_create" class="form-auth">
        <main-title tag="h3" class="form-auth_title">{{
            this.$t("auth.reg.title")
        }}</main-title>
        <auth-errors :errors="errors" />
        <div class="form-auth__content">
            <auth-input
                :error="errorsExpired.email"
                :model="service.form.email"
                :placeholder="this.$t('auth.reg.placeholders[0]')"
                name="email"
                type="text"
                @change="
                    service.form.email = !!$event.target
                        ? $event.target.value
                        : $event
                "
            />
            <auth-input
                :error="errorsExpired.name"
                :model="service.form.name"
                :placeholder="this.$t('auth.reg.placeholders[1]')"
                name="name"
                type="text"
                @change="
                    service.form.name = !!$event.target
                        ? $event.target.value
                        : $event
                "
            />
            <div
                class="form-auth_row password_row"
                :class="{ error: errorsExpired.password }"
            >
                <main-password
                    name="password"
                    :placeholder="this.$t('auth.reg.placeholders[2]')"
                    :model="service.form.password"
                    :errors="errorsExpired"
                    @change="
                        service.validateProcess(
                            !!$event.target ? $event.target.value : $event
                        )
                    "
                />
            </div>
            <main-validate :validate="service.validate" />
            <div
                class="form-auth_row password_row"
                :class="{ error: errorsExpired.password }"
            >
                <main-password
                    name="password_confirmation"
                    :placeholder="this.$t('auth.reg.placeholders[3]')"
                    :model="service.form.password_confirmation"
                    @change="
                        service.form.password_confirmation = !!$event.target
                            ? $event.target.value
                            : $event
                    "
                />
            </div>
            <!--            <auth-input-->
            <!--                :error="service.errors.referral_code"-->
            <!--                :model="service.form.referral_code"-->
            <!--                :placeholder="this.$t('auth.reg.placeholders[4]')"-->
            <!--                name="email"-->
            <!--                type="text"-->
            <!--                @change="-->
            <!--                    service.form.referral_code = !!$event.target-->
            <!--                        ? $event.target.value-->
            <!--                        : $event-->
            <!--                "-->
            <!--            />-->
        </div>
        <input
            class="form-auth_checkbox"
            type="checkbox"
            id="checkbox"
            v-model="service.checkbox"
        />
        <label for="checkbox" :class="{ error: service.checkboxState }">
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
            <span
                >{{ this.$t("auth.reg.checkbox[0]") }}
                <a :href="pdf" class="form-auth_link">
                    {{ this.$t("auth.reg.checkbox[1]") }}
                </a>
            </span>
        </label>
        <blue-button class="form-auth_button auth" type="submit"
            ><a class="all-link">{{
                this.$t("auth.reg.button")
            }}</a></blue-button
        >
        <p class="text text-light form-auth_text">
            {{ this.$t("auth.reg.link[0]") }}
            <router-link :to="{ name: 'login' }" class="form-auth_link">{{
                this.$t("auth.reg.link[1]")
            }}</router-link>
        </p>
    </form>
</template>

<script>
import pdf from "@/../assets/files/policy.pdf";
import AuthInput from "@/modules/auth/Components/UI/AuthInput.vue";
import MainPassword from "@/modules/common/Components/inputs/MainPassword.vue";
import MainValidate from "@/modules/validate/Components/MainValidate.vue";
import AuthErrors from "@/modules/auth/Components/UI/AuthErrors.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import BlueButton from "@/modules/common/Components/UI/ButtonBlue.vue";

import { RegistrationService } from "@/modules/auth/services/RegistrationService";
import { mapGetters } from "vuex";

export default {
    name: "registration-form",
    components: {
        AuthInput,
        MainPassword,
        MainValidate,
        AuthErrors,
        MainTitle,
        BlueButton,
    },
    computed: {
        ...mapGetters(["errors", "errorsExpired"]),
    },
    data() {
        return {
            pdf,
            service: new RegistrationService(this.$router, this.$route),
        };
    },
    mounted() {
        this.service.setForm();
    },
};
</script>

<style scoped lang="scss">
.form-auth {
    gap: 0;
    &__content {
        display: flex;
        flex-direction: column;
        max-width: 536px;
        width: 100%;
        gap: 16px;
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
        @media (max-width: $mobileSmall) {
            min-width: 100%;
        }
        & .all-link {
            padding: 16px 45px;
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

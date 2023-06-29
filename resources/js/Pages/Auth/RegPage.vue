<template>
    <form @submit.prevent="account_create" class="form form-auth">
        <main-title tag="h3">{{ this.$t("auth.reg.title") }}</main-title>
        <div
            class="form_wrapper-message"
            v-if="Object.values(errors).length > 0"
        >
            <div
                class="form_message form_message-error"
                :key="i"
                v-for="(error, i) in Object.values(errors)"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="25"
                    height="24"
                    viewBox="0 0 25 24"
                    fill="none"
                >
                    <path
                        d="M12.5 16C12.3022 16 12.1088 16.0587 11.9444 16.1686C11.7799 16.2784 11.6518 16.4346 11.5761 16.6173C11.5004 16.8001 11.4806 17.0011 11.5192 17.1951C11.5578 17.3891 11.653 17.5673 11.7929 17.7071C11.9327 17.847 12.1109 17.9422 12.3049 17.9808C12.4989 18.0194 12.6999 17.9996 12.8827 17.9239C13.0654 17.8482 13.2216 17.72 13.3314 17.5556C13.4413 17.3911 13.5 17.1978 13.5 17C13.5 16.7348 13.3946 16.4805 13.2071 16.2929C13.0195 16.1054 12.7652 16 12.5 16ZM23.17 17.47L15.12 3.47003C14.8598 3.00354 14.4798 2.61498 14.0192 2.3445C13.5586 2.07401 13.0341 1.9314 12.5 1.9314C11.9658 1.9314 11.4414 2.07401 10.9808 2.3445C10.5202 2.61498 10.1402 3.00354 9.87997 3.47003L1.87997 17.47C1.61076 17.924 1.46611 18.441 1.46061 18.9688C1.45511 19.4966 1.58897 20.0166 1.84865 20.4761C2.10834 20.9356 2.48467 21.3185 2.93965 21.5861C3.39463 21.8536 3.91215 21.9964 4.43997 22H20.56C21.092 22.0053 21.6159 21.8689 22.0779 21.6049C22.5399 21.341 22.9233 20.9589 23.1889 20.4978C23.4546 20.0368 23.5928 19.5134 23.5895 18.9814C23.5861 18.4493 23.4414 17.9277 23.17 17.47ZM21.44 19.47C21.3523 19.626 21.2244 19.7556 21.0697 19.8453C20.9149 19.935 20.7389 19.9815 20.56 19.98H4.43997C4.26108 19.9815 4.08507 19.935 3.93029 19.8453C3.7755 19.7556 3.64762 19.626 3.55997 19.47C3.4722 19.318 3.42599 19.1456 3.42599 18.97C3.42599 18.7945 3.4722 18.622 3.55997 18.47L11.56 4.47003C11.6439 4.30623 11.7714 4.16876 11.9284 4.07277C12.0854 3.97678 12.2659 3.92599 12.45 3.92599C12.634 3.92599 12.8145 3.97678 12.9715 4.07277C13.1286 4.16876 13.2561 4.30623 13.34 4.47003L21.39 18.47C21.4892 18.6199 21.5462 18.7937 21.555 18.9732C21.5638 19.1527 21.5241 19.3312 21.44 19.49V19.47ZM12.5 8.00003C12.2348 8.00003 11.9804 8.10538 11.7929 8.29292C11.6053 8.48046 11.5 8.73481 11.5 9.00003V13C11.5 13.2652 11.6053 13.5196 11.7929 13.7071C11.9804 13.8947 12.2348 14 12.5 14C12.7652 14 13.0195 13.8947 13.2071 13.7071C13.3946 13.5196 13.5 13.2652 13.5 13V9.00003C13.5 8.73481 13.3946 8.48046 13.2071 8.29292C13.0195 8.10538 12.7652 8.00003 12.5 8.00003Z"
                    />
                </svg>
                {{ error }}
            </div>
        </div>
        <div class="form__content">
            <div class="form_row" :class="{ error: errs.email }">
                <input
                    name="email"
                    v-model="form.email"
                    type="text"
                    class="input"
                    :placeholder="this.$t('auth.reg.placeholders[0]')"
                />
            </div>
            <div class="form_row" :class="{ error: errs.name }">
                <input
                    name="name"
                    v-model="form.name"
                    type="text"
                    class="input"
                    :placeholder="this.$t('auth.reg.placeholders[1]')"
                />
            </div>
            <div class="form_row" :class="{ error: errs.password }">
                <main-password
                    name="password"
                    :placeholder="this.$t('auth.reg.placeholders[2]')"
                    :model="form.password"
                    :errors="errors"
                    @change="passwordProcess($event)"
                ></main-password>
            </div>
            <transition name="validate">
                <ul class="form_row validate" v-if="validate">
                    <li
                        class="validate_val"
                        :class="
                            !validate.length
                                ? 'validate_val-complete'
                                : 'validate_val-reject'
                        "
                    >
                        Длина от 10 до 50 символов
                    </li>
                    <ul class="validate__list">
                        <span
                            class="validate_val"
                            :class="
                                !(
                                    validate.lower ||
                                    validate.upper ||
                                    validate.symbol ||
                                    validate.number
                                )
                                    ? 'validate_val-complete'
                                    : 'validate_val-reject'
                            "
                        >
                            Пароль должен включать:</span
                        >
                        <li
                            class="validate_val"
                            :class="
                                !validate.lower
                                    ? 'validate_val-complete'
                                    : 'validate_val-reject'
                            "
                        >
                            Строчную букву (a-z)
                        </li>
                        <li
                            class="validate_val"
                            :class="
                                !validate.upper
                                    ? 'validate_val-complete'
                                    : 'validate_val-reject'
                            "
                        >
                            Заглавную букву (A-Z)
                        </li>
                        <li
                            class="validate_val"
                            :class="
                                !validate.symbol
                                    ? 'validate_val-complete'
                                    : 'validate_val-reject'
                            "
                        >
                            Спецсимвол (!, ?, %, $ и др.)
                        </li>
                        <li
                            class="validate_val"
                            :class="
                                !validate.number
                                    ? 'validate_val-complete'
                                    : 'validate_val-reject'
                            "
                        >
                            Цифру (0-9)
                        </li>
                    </ul>
                </ul>
            </transition>
            <div class="form_row" :class="{ error: errs.password }">
                <main-password
                    name="password_confirmation"
                    :placeholder="this.$t('auth.reg.placeholders[3]')"
                    :model="form.password_confirmation"
                    @change="form.password_confirmation = $event"
                ></main-password>
            </div>
        </div>
        <input type="checkbox" id="checkbox" v-model="form.checkbox" />
        <label for="checkbox" :class="{ error: checkbox }">
            <svg
                width="18"
                height="12"
                viewBox="0 0 18 12"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M6.44961 11.85L0.849609 6.24998L1.92461 5.17498L6.44961 9.69998L16.0496 0.0999756L17.1246 1.17498L6.44961 11.85Z"
                />
            </svg>
            <span
                >{{ this.$t("auth.reg.checkbox[0]") }}
                <a :href="pdf" class="form_link">{{
                    this.$t("auth.reg.checkbox[1]")
                }}</a></span
            >
        </label>
        <blue-button class="big" type="submit"
            ><a class="all-link">{{
                this.$t("auth.reg.button")
            }}</a></blue-button
        >
        <p class="text text-light">
            {{ this.$t("auth.reg.link[0]") }}
            <Link :href="route('login')" class="form_link">{{
                this.$t("auth.reg.link[1]")
            }}</Link>
        </p>
    </form>
</template>

<script>
import pdf from "@/../assets/files/policy.pdf";
import authLayoutView from "@/Shared/AuthLayoutView.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import { Link, useForm } from "@inertiajs/vue3";
import MainPassword from "@/Components/UI/MainPassword.vue";
import { ref } from "vue";

export default {
    layout: authLayoutView,
    name: "reg-page",
    props: ["errors"],
    components: {
        MainTitle,
        BlueButton,
        Link,
        MainPassword,
    },
    data() {
        return {
            pdf,
            errs: {},
        };
    },
    setup() {
        let checkbox = ref(false);
        let validate = ref(null);
        let form = useForm({
            email: "",
            name: "",
            password: "",
            ["password_confirmation"]: "",
            checkbox: false,
        });
        const account_create = () => {
            checkbox.value = false;
            if (form.checkbox) {
                if (!validate.value) {
                    form.post("/register", {});
                }
            } else {
                checkbox.value = true;
            }
        };
        const passwordProcess = (event) => {
            form.password = event;
            validate.value = {};
            if (form.password.length <= 10 || form.password.length >= 50) {
                validate.value.length = true;
            }

            if (!/[a-z]/.test(form.password)) {
                validate.value.lower = true;
            }

            if (!/[A-Z]/.test(form.password)) {
                validate.value.upper = true;
            }

            if (!/[0-9]/.test(form.password)) {
                validate.value.number = true;
            }

            if (!/[!@#\$%\^&\*]/.test(form.password)) {
                validate.value.symbol = true;
            }

            if (form.password.length === 0) {
                validate.value = null;
            }
        };
        return {
            form,
            account_create,
            checkbox,
            passwordProcess,
            validate,
        };
    },
    watch: {
        errors(newVal) {
            this.errs = newVal;
            setTimeout(() => {
                this.errs = {};
            }, 1500);
        },
    },
    mounted() {
        document.title = "Регистрация";
    },
};
</script>

<style scoped lang="scss">
.validate {
    width: 100%;
    padding: 16px;
    border-radius: 12px;
    background: #fafafa;
    box-shadow: 0px 4px 10px 0px rgba(85, 85, 85, 0.1);
    &.validate,
    &__list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    &_val {
        color: rgba(124, 124, 124, 0.7);
        font-size: 18px;
        font-weight: 400;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        line-height: 135%;
        transition: all 0.5s ease 0s;
        &:before {
            content: "";
            background: linear-gradient(
                    179deg,
                    #e6eaf0 0%,
                    #e6eaf1 20.89%,
                    #e7ebf1 42.88%,
                    #eaeef4 76.04%,
                    #e8ecf2 100%
                ),
                no-repeat, center / cover;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            transition: all 0.5s ease 0s;
        }
        &-complete {
            color: #0fb468;
            &:before {
                background: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10.525 16.55L17.6 9.475L16.45 8.35L10.525 14.275L7.525 11.275L6.4 12.4L10.525 16.55ZM12 22C10.6333 22 9.34167 21.7375 8.125 21.2125C6.90833 20.6875 5.84583 19.9708 4.9375 19.0625C4.02917 18.1542 3.3125 17.0917 2.7875 15.875C2.2625 14.6583 2 13.3667 2 12C2 10.6167 2.2625 9.31667 2.7875 8.1C3.3125 6.88333 4.02917 5.825 4.9375 4.925C5.84583 4.025 6.90833 3.3125 8.125 2.7875C9.34167 2.2625 10.6333 2 12 2C13.3833 2 14.6833 2.2625 15.9 2.7875C17.1167 3.3125 18.175 4.025 19.075 4.925C19.975 5.825 20.6875 6.88333 21.2125 8.1C21.7375 9.31667 22 10.6167 22 12C22 13.3667 21.7375 14.6583 21.2125 15.875C20.6875 17.0917 19.975 18.1542 19.075 19.0625C18.175 19.9708 17.1167 20.6875 15.9 21.2125C14.6833 21.7375 13.3833 22 12 22ZM12 20.5C14.3667 20.5 16.375 19.6708 18.025 18.0125C19.675 16.3542 20.5 14.35 20.5 12C20.5 9.63333 19.675 7.625 18.025 5.975C16.375 4.325 14.3667 3.5 12 3.5C9.65 3.5 7.64583 4.325 5.9875 5.975C4.32917 7.625 3.5 9.63333 3.5 12C3.5 14.35 4.32917 16.3542 5.9875 18.0125C7.64583 19.6708 9.65 20.5 12 20.5Z' fill='%230FB468'/%3E%3C/svg%3E%0A");
            }
        }
        &-reject {
            color: #e5403f;
            &:before {
                background: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M8.25 16.8L12 13.05L15.75 16.8L16.8 15.75L13.05 12L16.8 8.25L15.75 7.2L12 10.95L8.25 7.2L7.2 8.25L10.95 12L7.2 15.75L8.25 16.8ZM12 22C10.6333 22 9.34167 21.7375 8.125 21.2125C6.90833 20.6875 5.84583 19.9708 4.9375 19.0625C4.02917 18.1542 3.3125 17.0917 2.7875 15.875C2.2625 14.6583 2 13.3667 2 12C2 10.6167 2.2625 9.31667 2.7875 8.1C3.3125 6.88333 4.02917 5.825 4.9375 4.925C5.84583 4.025 6.90833 3.3125 8.125 2.7875C9.34167 2.2625 10.6333 2 12 2C13.3833 2 14.6833 2.2625 15.9 2.7875C17.1167 3.3125 18.175 4.025 19.075 4.925C19.975 5.825 20.6875 6.88333 21.2125 8.1C21.7375 9.31667 22 10.6167 22 12C22 13.3667 21.7375 14.6583 21.2125 15.875C20.6875 17.0917 19.975 18.1542 19.075 19.0625C18.175 19.9708 17.1167 20.6875 15.9 21.2125C14.6833 21.7375 13.3833 22 12 22ZM12 20.5C14.3667 20.5 16.375 19.6708 18.025 18.0125C19.675 16.3542 20.5 14.35 20.5 12C20.5 9.63333 19.675 7.625 18.025 5.975C16.375 4.325 14.3667 3.5 12 3.5C9.65 3.5 7.64583 4.325 5.9875 5.975C4.32917 7.625 3.5 9.63333 3.5 12C3.5 14.35 4.32917 16.3542 5.9875 18.0125C7.64583 19.6708 9.65 20.5 12 20.5Z' fill='%23E5403F'/%3E%3C/svg%3E%0A");
            }
        }
    }
    .validate__list {
        li {
            padding-left: 27px;
        }
    }
}
</style>

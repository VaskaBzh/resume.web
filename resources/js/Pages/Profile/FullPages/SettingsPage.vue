<template>
    <div class="settings" ref="page">
        <main-title class="profile cabinet_title" tag="h3">{{
            $t("settings.title")
        }}</main-title>
        <div class="settings__wrap settings__wrap-adapt">
            <div class="settings__column">
                <!--                <main-title class="headline" tag="h4">{{-->
                <!--                    $t("settings.block.titles[0]")-->
                <!--                }}</main-title>-->
                <settings-block
                    @openPopup="getHtml"
                    :name="
                        this.$t('settings.block.settings_block.labels.login')
                    "
                    :val="login"
                    :svg="svgs[0]"
                >
                </settings-block>
                <settings-block
                    @openPopup="getHtml"
                    :name="
                        this.$t('settings.block.settings_block.labels.email')
                    "
                    :val="email"
                    :svg="svgs[1]"
                ></settings-block>
                <settings-block
                    @openPopup="getHtml"
                    :name="
                        this.$t('settings.block.settings_block.labels.password')
                    "
                    :val="password"
                    :svg="svgs[2]"
                ></settings-block>
                <settings-block
                    @openPopup="getHtml"
                    :name="
                        this.$t('settings.block.settings_block.labels.phone')
                    "
                    :val="phone"
                    :svg="svgs[3]"
                ></settings-block>
            </div>
            <div class="settings__column">
                <div class="cabinet__block cabinet__block-light">
                    <span class="text text-black text-b"
                        >{{
                            this.$t(
                                "settings.block.settings_block.income.title"
                            )
                        }}
                        <span class="success" v-show="clearProfit">
                            <svg
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M9.99935 1.66663C5.40435 1.66663 1.66602 5.40496 1.66602 9.99996C1.66602 14.595 5.40435 18.3333 9.99935 18.3333C14.5943 18.3333 18.3327 14.595 18.3327 9.99996C18.3327 5.40496 14.5943 1.66663 9.99935 1.66663ZM9.99935 16.6666C6.32352 16.6666 3.33268 13.6758 3.33268 9.99996C3.33268 6.32413 6.32352 3.33329 9.99935 3.33329C13.6752 3.33329 16.666 6.32413 16.666 9.99996C16.666 13.6758 13.6752 16.6666 9.99935 16.6666Z"
                                />
                                <path
                                    d="M8.33273 11.3226L6.4169 9.41006L5.24023 10.5901L8.3344 13.6776L13.9227 8.08922L12.7444 6.91089L8.33273 11.3226Z"
                                />
                            </svg>
                            Успешно</span
                        ></span
                    >
                    <span class="text text-light text-md">{{
                        this.$t("settings.block.settings_block.income.text")
                    }}</span>
                    <div class="settings__row">
                        <div class="form_row">
                            <input
                                type="text"
                                :placeholder="200"
                                v-model="profit"
                                class="input"
                            />
                            <span>$</span>
                        </div>
                        <blue-button @click="setClearProfit">
                            <a href="#" class="all-link">{{
                                this.$t(
                                    "settings.block.settings_block.income.button"
                                )
                            }}</a>
                        </blue-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <teleport to="body">
        <main-popup
            id="changes"
            class="popup-changes"
            :wait="wait"
            v-if="form.type !== ''"
            :closed="closed"
            :errors="errors"
        >
            <form
                @submit.prevent="
                    form.type === 'пароль'
                        ? ajaxChange(true)
                        : ajaxChange(false)
                "
                class="form form-popup popup__form"
            >
                <main-title tag="h3">{{
                    `${
                        form.type !== "почту"
                            ? $t("settings.block.settings_block.popup.title")
                            : $t(
                                  "settings.block.settings_block.popup.title_email"
                              )
                    } ${form.type}`
                }}</main-title>
                <input
                    v-model="form.item"
                    autofocus
                    :type="form.type === 'пароль' ? 'password' : 'text'"
                    class="input popup__input"
                    :placeholder="`${$t(
                        'settings.block.settings_block.popup.placeholders.placeholder'
                    )} ${form.type}`"
                />
                <div class="form_row" v-if="form.type === 'пароль'">
                    <main-password
                        name="password"
                        :placeholder="`${$t(
                            'settings.block.settings_block.popup.placeholders.password_new'
                        )} ${form.type}`"
                        :model="form.password"
                        :errors="errors"
                        @change="passwordProcess($event)"
                    ></main-password>
                </div>
                <transition name="validate">
                    <ul
                        class="form_row validate"
                        v-if="Object.entries(validate).length > 0"
                    >
                        <li
                            class="validate_val"
                            :class="
                                !validate.length
                                    ? 'validate_val-complete'
                                    : 'validate_val-reject'
                            "
                        >
                            {{ this.$t("auth.reg.validate[0]") }}
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
                                {{ this.$t("auth.reg.validate[1]") }}
                            </span>
                            <li
                                class="validate_val"
                                :class="
                                    !validate.lower
                                        ? 'validate_val-complete'
                                        : ''
                                "
                            >
                                {{ this.$t("auth.reg.validate[2]") }}
                            </li>
                            <li
                                class="validate_val"
                                :class="
                                    !validate.upper
                                        ? 'validate_val-complete'
                                        : ''
                                "
                            >
                                {{ this.$t("auth.reg.validate[3]") }}
                            </li>
                            <li
                                class="validate_val"
                                :class="
                                    !validate.symbol
                                        ? 'validate_val-complete'
                                        : ''
                                "
                            >
                                {{ this.$t("auth.reg.validate[4]") }}
                            </li>
                            <li
                                class="validate_val"
                                :class="
                                    !validate.number
                                        ? 'validate_val-complete'
                                        : ''
                                "
                            >
                                {{ this.$t("auth.reg.validate[5]") }}
                            </li>
                        </ul>
                    </ul>
                </transition>
                <div class="form_row" v-if="form.type === 'пароль'">
                    <main-password
                        name="password"
                        :placeholder="`${$t(
                            'settings.block.settings_block.popup.placeholders.password_confirmation'
                        )} ${form.type}`"
                        :model="form.password_confirmation"
                        :errors="errors"
                        @change="form.password_confirmation = $event"
                    ></main-password>
                </div>
                <blue-button>
                    <button type="submit" class="all-link">
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 9.64 2 7.4 3.42 5.52C3.67 5.19 4.14 5.13 4.47 5.38C4.8 5.63 4.87 6.1 4.62 6.43C3.4 8.04 2.75 9.97 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75C11.59 2.75 11.25 2.41 11.25 2C11.25 1.59 11.59 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75Z"
                            />
                            <path
                                d="M12 19.75C7.73 19.75 4.25 16.27 4.25 12C4.25 11.59 4.59 11.25 5 11.25C5.41 11.25 5.75 11.59 5.75 12C5.75 15.45 8.55 18.25 12 18.25C15.45 18.25 18.25 15.45 18.25 12C18.25 8.55 15.45 5.75 12 5.75C11.59 5.75 11.25 5.41 11.25 5C11.25 4.59 11.59 4.25 12 4.25C16.27 4.25 19.75 7.73 19.75 12C19.75 16.27 16.27 19.75 12 19.75Z"
                            />
                            <path
                                d="M12 16.75C11.59 16.75 11.25 16.41 11.25 16C11.25 15.59 11.59 15.25 12 15.25C13.79 15.25 15.25 13.79 15.25 12C15.25 10.21 13.79 8.75 12 8.75C11.59 8.75 11.25 8.41 11.25 8C11.25 7.59 11.59 7.25 12 7.25C14.62 7.25 16.75 9.38 16.75 12C16.75 14.62 14.62 16.75 12 16.75Z"
                            />
                        </svg>
                        {{ $t("settings.block.settings_block.popup.button") }}
                        {{ form.type }}
                    </button>
                </blue-button>
            </form>
        </main-popup>
    </teleport>
</template>
<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import SettingsBlock from "@/Components/technical/blocks/profile/SettingsBlock.vue";
import MainPopup from "@/Components/technical/MainPopup.vue";
import axios from "axios";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import MainPassword from "@/Components/UI/MainPassword.vue";

export default {
    layout: profileLayoutView,
    components: {
        MainTitle,
        BlueButton,
        SettingsBlock,
        MainPopup,
        MainPassword,
    },
    props: ["errors", "message", "user", "auth_user"],
    setup() {
        let login = ref("...");
        let email = ref("...");
        let phone = ref("...");
        let password = ref("*********");
        // let sms = ref(null);
        // let fac = ref(null);
        let closed = ref(false);
        let wait = ref(false);

        let form = useForm({
            item: "",
            type: "",
            old_password: "",
            password: "",
            password_confirmation: "",
        });

        let validate = ref({});

        const passwordProcess = (event) => {
            form.password = event;
            validate.value = {};

            if (form.password?.length <= 10 || form.password?.length >= 50)
                validate.value.length = true;

            if (!/[a-z]/.test(form.password)) validate.value.lower = true;

            if (!/[A-Z]/.test(form.password)) validate.value.upper = true;

            if (!/[0-9]/.test(form.password)) validate.value.number = true;

            if (!/[!@#\$%\^&\*,.?]/.test(form.password))
                validate.value.symbol = true;

            if (form.password.length === 0) validate.value = {};
        };

        async function getInfo() {
            let getVal = {
                login: login,
                email: email,
                phone: phone,
            };

            Object.entries(getVal).forEach((el) => {
                axios.get(route(`get_${el[0]}`)).then((res) => {
                    el[1].value = res.data;
                });
            });
            // get_sms();
            // get_2fac();
        }

        const ajax = () => {
            wait.value = true;
            form.post(route("change"), {
                onFinish() {
                    wait.value = false;
                },
            });
        };

        const ajaxChange = (bool) => {
            if (bool) {
                if (Object.entries(validate.value).length === 0) {
                    form.old_password = form.item;
                    ajax();
                }
            } else {
                ajax();
            }
        };

        // async function get_sms() {
        //     await axios.get(route("get_sms")).then((res) => {
        //         res.data === 0 ? (sms.value = false) : (sms.value = true);
        //     });
        // }
        // async function get_2fac() {
        //     await axios.get(route("get_fac")).then((res) => {
        //         res.data === 0 ? (fac.value = false) : (fac.value = true);
        //     });
        // }

        getInfo();

        return {
            login,
            email,
            phone,
            password,
            // sms,
            // fac,
            passwordProcess,
            validate,
            form,
            closed,
            wait,
            ajaxChange,
        };
    },
    data() {
        return {
            is_checked: true,
            notification: true,
            password_confirmation: "",
            clearProfit: "",
            profit: "",
            svgs: [
                `<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.0007 15.9667C14.534 15.9667 13.334 15.5 12.4007 14.5667C11.4673 13.6333 11.0007 12.4333 11.0007 10.9667C11.0007 9.49999 11.4673 8.29999 12.4007 7.36666C13.334 6.43333 14.534 5.96666 16.0007 5.96666C17.4673 5.96666 18.6673 6.43333 19.6007 7.36666C20.534 8.29999 21.0007 9.49999 21.0007 10.9667C21.0007 12.4333 20.534 13.6333 19.6007 14.5667C18.6673 15.5 17.4673 15.9667 16.0007 15.9667ZM5.33398 26.6667V23.5333C5.33398 22.6889 5.5451 21.9667 5.96732 21.3667C6.38954 20.7667 6.93398 20.3111 7.60065 20C9.08954 19.3333 10.5173 18.8333 11.884 18.5C13.2507 18.1667 14.6229 18 16.0007 18C17.3784 18 18.7451 18.1722 20.1007 18.5167C21.4562 18.8611 22.8776 19.3577 24.3647 20.0065C25.0603 20.3204 25.6179 20.7755 26.0377 21.372C26.4574 21.9684 26.6673 22.6889 26.6673 23.5333V26.6667H5.33398ZM7.33398 24.6667H24.6673V23.5333C24.6673 23.1778 24.5618 22.8389 24.3507 22.5167C24.1395 22.1944 23.8784 21.9555 23.5673 21.8C22.1451 21.1111 20.8451 20.6389 19.6673 20.3833C18.4895 20.1278 17.2673 20 16.0007 20C14.734 20 13.5007 20.1278 12.3007 20.3833C11.1007 20.6389 9.80065 21.1111 8.40065 21.8C8.08954 21.9555 7.83398 22.1944 7.63398 22.5167C7.43398 22.8389 7.33398 23.1778 7.33398 23.5333V24.6667ZM16.0007 13.9667C16.8673 13.9667 17.584 13.6833 18.1507 13.1167C18.7173 12.55 19.0007 11.8333 19.0007 10.9667C19.0007 10.1 18.7173 9.38333 18.1507 8.81666C17.584 8.24999 16.8673 7.96666 16.0007 7.96666C15.134 7.96666 14.4173 8.24999 13.8507 8.81666C13.284 9.38333 13.0007 10.1 13.0007 10.9667C13.0007 11.8333 13.284 12.55 13.8507 13.1167C14.4173 13.6833 15.134 13.9667 16.0007 13.9667Z"/>
                </svg>
                `,
                `<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.66602 26.6667C4.13268 26.6667 3.66602 26.4667 3.26602 26.0667C2.86602 25.6667 2.66602 25.2 2.66602 24.6667V7.33333C2.66602 6.79999 2.86602 6.33333 3.26602 5.93333C3.66602 5.53333 4.13268 5.33333 4.66602 5.33333H27.3327C27.866 5.33333 28.3327 5.53333 28.7327 5.93333C29.1327 6.33333 29.3327 6.79999 29.3327 7.33333V24.6667C29.3327 25.2 29.1327 25.6667 28.7327 26.0667C28.3327 26.4667 27.866 26.6667 27.3327 26.6667H4.66602ZM15.9993 16.6L4.66602 9.16666V24.6667H27.3327V9.16666L15.9993 16.6ZM15.9993 14.6L27.1993 7.33333H4.83268L15.9993 14.6ZM4.66602 9.16666V7.33333V24.6667V9.16666Z"/>
                </svg>
                `,
                `<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.33398 29.3333C6.78398 29.3333 6.31315 29.1375 5.92148 28.7458C5.52982 28.3542 5.33398 27.8833 5.33398 27.3333V12.8667C5.33398 12.3167 5.52982 11.8458 5.92148 11.4542C6.31315 11.0625 6.78398 10.8667 7.33398 10.8667H9.66732V7.66667C9.66732 5.91445 10.2852 4.42084 11.5209 3.18584C12.7565 1.95084 14.251 1.33334 16.0042 1.33334C17.7574 1.33334 19.2507 1.95084 20.484 3.18584C21.7173 4.42084 22.334 5.91445 22.334 7.66667V10.8667H24.6673C25.2173 10.8667 25.6882 11.0625 26.0798 11.4542C26.4715 11.8458 26.6673 12.3167 26.6673 12.8667V27.3333C26.6673 27.8833 26.4715 28.3542 26.0798 28.7458C25.6882 29.1375 25.2173 29.3333 24.6673 29.3333H7.33398ZM7.33398 27.3333H24.6673V12.8667H7.33398V27.3333ZM16.0063 22.6667C16.7136 22.6667 17.3173 22.4219 17.8173 21.9323C18.3173 21.4427 18.5673 20.8542 18.5673 20.1667C18.5673 19.5 18.3155 18.8944 17.8117 18.35C17.308 17.8056 16.7024 17.5333 15.9951 17.5333C15.2877 17.5333 14.684 17.8056 14.184 18.35C13.684 18.8944 13.434 19.5056 13.434 20.1833C13.434 20.8611 13.6859 21.4444 14.1896 21.9333C14.6933 22.4222 15.2989 22.6667 16.0063 22.6667ZM11.6673 10.8667H20.334V7.66667C20.334 6.46296 19.9131 5.43981 19.0713 4.59724C18.2294 3.75464 17.2072 3.33334 16.0046 3.33334C14.802 3.33334 13.7784 3.75464 12.934 4.59724C12.0895 5.43981 11.6673 6.46296 11.6673 7.66667V10.8667Z"/>
                </svg>
                `,
                `<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M26.5 28C23.7889 28 21.0944 27.3333 18.4167 26C15.7389 24.6667 13.3333 22.9333 11.2 20.8C9.06667 18.6667 7.33333 16.2611 6 13.5833C4.66667 10.9056 4 8.21111 4 5.5C4 5.07142 4.14286 4.71428 4.42857 4.42857C4.71428 4.14286 5.07142 4 5.5 4H10.1667C10.4691 4 10.7392 4.10556 10.9769 4.31667C11.2145 4.52778 11.3667 4.81111 11.4333 5.16667L12.3333 9.36667C12.3778 9.67778 12.3722 9.96111 12.3167 10.2167C12.2611 10.4722 12.1444 10.6889 11.9667 10.8667L8.63333 14.2333C9.87778 16.3 11.2722 18.1 12.8167 19.6333C14.3611 21.1667 16.1111 22.4667 18.0667 23.5333L21.2333 20.2667C21.4556 20.0222 21.7111 19.85 22 19.75C22.2889 19.65 22.5778 19.6333 22.8667 19.7L26.8333 20.5667C27.1736 20.6417 27.4531 20.8104 27.6719 21.0729C27.8906 21.3354 28 21.6444 28 22V26.5C28 26.9286 27.8571 27.2857 27.5714 27.5714C27.2857 27.8571 26.9286 28 26.5 28ZM7.63333 12.4L10.3333 9.66667L9.56667 6H6C6 6.86667 6.13333 7.81667 6.4 8.85C6.66667 9.88333 7.07778 11.0667 7.63333 12.4ZM19.9333 24.5C20.8444 24.9222 21.8333 25.2667 22.9 25.5333C23.9667 25.8 25 25.9556 26 26V22.4333L22.5667 21.7333L19.9333 24.5Z"/>
                </svg>
                `,
            ],
        };
    },
    watch: {
        profit(newValue) {
            this.profit = newValue.replace(/[^0-9]/g, "");
        },
    },
    methods: {
        setProfits() {
            this.profit = localStorage.getItem("clearProfit") || "";
            this.clearProfit = this.profit;
        },
        setClearProfit() {
            localStorage.setItem("clearProfit", this.profit);
            this.clearProfit = this.profit;
        },
        getHtml(data) {
            this.form.item = data.name === "пароль" ? "" : data.val;
            this.form.type = data.name;
        },
    },
    mounted() {
        document.title = "Настройки";
        this.$refs.page.style.opacity = 1;
        this.setProfits();
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

    &__wrap {
        display: flex;
        justify-content: space-between;
        gap: 32px;
        @media (max-width: 991.98px) {
            flex-direction: column;
            gap: 24px;
        }
    }

    &__column {
        display: flex;
        flex-direction: column;
        gap: 16px;
        width: 100%;
        transition: all 0.3s ease 0s;
        &:last-child {
            .cabinet__block {
                display: flex;
                flex-direction: column;
                gap: 16px;
                .blue-button {
                    border-radius: 8px;
                }
                .text {
                    &:first-child {
                        display: flex;
                        justify-content: space-between;
                        width: 100%;
                        align-items: center;
                        @media (max-width: 479.98px) {
                            font-size: 16px;
                        }
                        .success {
                            display: inline-flex;
                            gap: 8px;
                            align-items: center;
                            color: #0fb468;
                            font-weight: 500;
                            font-size: 16px;
                            line-height: 140%;
                            svg {
                                fill: #0fb468;
                            }
                        }
                    }
                }
            }
        }
    }

    &__row {
        display: flex;
        gap: 12px;
        margin-top: 12px;
        @media (max-width: 479.98px) {
            flex-direction: column;
            gap: 8px;
        }
        .form_row {
            position: relative;
            width: 100%;
            @media (min-width: 479.98px) {
                max-width: calc(100% - 152px);
            }
            @media (max-width: 479.98px) {
                height: fit-content;
            }
            span {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                right: 16px;
            }
            .input {
                width: 100%;
            }
        }
        .blue-button {
            min-width: 140px;
            min-height: 48px;
            @media (max-width: 479.98px) {
                min-width: 100%;
            }
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

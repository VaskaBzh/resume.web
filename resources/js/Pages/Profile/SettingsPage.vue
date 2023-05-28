<template>
    <!--    <div class="hint">-->
    <!--        <div-->
    <!--            class="hint_item"-->
    <!--            v-for="(error, i) in this.errs"-->
    <!--            :key="i"-->
    <!--            v-hide="error"-->
    <!--        >-->
    <!--            {{ error }}-->
    <!--        </div>-->
    <!--    </div>-->
    <div class="settings" ref="page">
        <main-title tag="h2" class="profile" :title-name="$t('settings.title')"></main-title>
        <div class="settings__wrap settings__wrap-adapt wrap">
            <div class="settings__column">
                <main-title
                    tag="h3"
                    :title-name="$t('settings.block.titles[0]')"
                ></main-title>
                <settings-block
                    @openPopup="getHtml"
                    name="Логин"
                    :val="this.login"
                >
                </settings-block>
                <settings-block
                    @openPopup="getHtml"
                    name="Email"
                    :val="this.email"
                ></settings-block>
            </div>
            <div class="settings__column" ref="wrap">
                <main-title
                    tag="h3"
                    :title-name="$t('settings.block.titles[1]')"
                ></main-title>
                <settings-block
                    @openPopup="getHtml"
                    name="Пароль"
                    :val="this.password"
                ></settings-block>
                <settings-block
                    @openPopup="getHtml"
                    name="Телефон"
                    :val="this.phone"
                ></settings-block>
                <!--                    <settings-block-->
                <!--                        data-remove-->
                <!--                        :val="this.sms"-->
                <!--                        name="СМС авторизация"-->
                <!--                        text="Включив его, вы сможете войти в систему с помощью SMS. Но в целях безопасности в некоторых случаях вы можете включить его."-->
                <!--                    ></settings-block>-->
                <!--                    <settings-block-->
                <!--                        data-remove-->
                <!--                        :val="this.fac"-->
                <!--                        name="2х факторная аутентификация"-->
                <!--                        text="Двухфакторная аутентификация добавляет дополнительный уровень безопасности вашей учетной записи."-->
                <!--                    ></settings-block>-->
            </div>
        </div>
    </div>
    <popup-view id="changes" :wait="this.wait" v-if="this.popupHtml !== ''">
        <div
            v-for="(error, i) in this.errs"
            :key="i"
            class="form_wrapper-message"
        >
            <div class="form_message" v-if="error">
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
        <form
            @submit.prevent="
                this.popupHtml.password
                    ? this.ajaxChange(false, this.getInfo)
                    : this.ajaxChange(true, this.getInfo)
            "
            class="form form-popup popup__form"
        >
            <main-title
                tag="h3"
                :title-name="`${$t(
                    'settings.block.settings_block.popup.title'
                )} ${this.popupHtml.name}`"
            />
            <input
                v-model="this.form.item"
                required
                autofocus
                :type="this.popupHtml.name === 'пароль' ? 'password' : 'text'"
                class="input popup__input"
                :placeholder="`${$t(
                    'settings.block.settings_block.popup.placeholders.placeholder'
                )} ${this.popupHtml.name}`"
            />
            <input
                v-model="this.pass"
                v-if="this.popupHtml.password"
                required
                autofocus
                type="password"
                class="input popup__input"
                :placeholder="`${$t(
                    'settings.block.settings_block.popup.placeholders.password_new'
                )} ${this.popupHtml.name}`"
            />
            <input
                v-model="this.password_confirmation"
                v-if="this.popupHtml.password"
                required
                autofocus
                type="password"
                class="input popup__input"
                :placeholder="`${$t(
                    'settings.block.settings_block.popup.placeholders.password_confirmation'
                )} ${this.popupHtml.name}`"
            />
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
                    {{ this.popupHtml.name }}
                </button>
            </blue-button>
        </form>
    </popup-view>
</template>
<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import SettingsBlock from "@/Components/technical/blocks/profile/SettingsBlock.vue";
import PopupView from "@/Components/technical/PopupView.vue";
import axios from "axios";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

export default {
    layout: profileLayoutView,
    components: {
        MainTitle,
        BlueButton,
        SettingsBlock,
        PopupView,
    },
    props: ["errors", "message", "user", "auth_user"],
    setup() {
        let login = ref("...");
        let email = ref("...");
        let phone = ref("...");
        let password = ref("*********");
        let sms = ref(null);
        let fac = ref(null);

        async function get_login() {
            axios.get(route("get_login")).then((res) => {
                login.value = res.data;
            });
        }
        async function get_email() {
            axios.get(route("get_email")).then((res) => {
                email.value = res.data;
            });
        }
        async function get_phone() {
            axios.get(route("get_phone")).then((res) => {
                phone.value = res.data;
            });
        }
        async function get_sms() {
            axios.get(route("get_sms")).then((res) => {
                res.data === 0 ? (sms.value = false) : (sms.value = true);
            });
        }
        async function get_2fac() {
            axios.get(route("get_fac")).then((res) => {
                res.data === 0 ? (fac.value = false) : (fac.value = true);
                console.log(res.data);
            });
        }
        async function getInfo() {
            get_login();
            get_email();
            get_phone();
            get_sms();
            get_2fac();
        }

        getInfo();

        return {
            login,
            email,
            phone,
            password,
            sms,
            fac,
            getInfo,
        };
    },
    data() {
        return {
            is_checked: true,
            notification: true,
            popupHtml: ``,
            form: {
                item: "",
                type: "",
            },
            wait: false,
            pass: "",
            password_confirmation: "",
            checkboxes: [
                { title: "Выплаты за майнинг", isChecked: true },
                { title: "Изменение реферального уровня", isChecked: true },
                { title: "Начисления за майнинг", isChecked: true },
                { title: "Подключение воркера ", isChecked: true },
                { title: "Вывод с депозита", isChecked: false },
                { title: "Отключение воркера", isChecked: false },
                { title: "Реферальное вознаграждение", isChecked: false },
                { title: "Новости", isChecked: false },
                { title: "Mining", isChecked: false },
                { title: "Промоакции", isChecked: false },
            ],
        };
    },
    computed: {
        errs() {
            let errs = this.errors || {};
            errs = Object.values(errs).filter((el) => el !== "");
            return errs;
        },
    },
    methods: {
        getHtml(data) {
            this.popupHtml = data;
        },
        async ajaxChange(bool, func) {
            let form = useForm(this.form);

            form.type = this.popupHtml.name;

            if (bool) {
                form.password = this.password;
                form.password_confirmation = this.password_confirmation;
            }
            this.wait = true;

            await form.post(route("change"), {
                async onFinish() {
                    this.form = {
                        item: "",
                        type: "",
                    };
                    this.pass = "";
                    this.password_confirmation = "";

                    this.wait = false;
                    await func();

                    document.querySelector("[data-close]").click();
                },
            });
        },
        // remove_checkboxes(data) {
        //     this.$refs.wrap.querySelectorAll("[data-remove]").forEach((el) => {
        //         if (data) {
        //             el.style.visibility = "hidden";
        //             el.style.transition =
        //                 "all 0.3s ease 0.3s, display 0.3s ease 0.3s";
        //             el.style.opacity = 0;
        //             el.style.display = "none";
        //         } else {
        //             el.style.display = "flex";
        //             el.style.transition =
        //                 "all 0.3s ease 0s, display 0.3s ease 0.3s";
        //             el.style.visibility = "visible";
        //             el.style.opacity = 1;
        //         }
        //     });
        // },
        // checker() {
        //     if (!this.is_checked) {
        //         this.$refs.checkbox.classList.add("checked");
        //         this.is_checked = true;
        //     } else {
        //         this.$refs.checkbox.classList.remove("checked");
        //         this.is_checked = false;
        //     }
        // },
    },
    mounted() {
        document.title = "Настройки";
        this.$refs.page.style.opacity = 1;
        // this.$refs.checkbox.classList.add("checked");
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
        @media (min-width: 991.98px) {
            flex-direction: row;
            flex-wrap: nowrap;
        }
        gap: 24px;
        .title {
            @media (min-width: 1271.98px) {
                padding-left: 0;
            }
        }

        &-adapt {
            @media (max-width: 1270px) {
                padding: 20px;
            }
            @media (max-width: 991.98px) {
                background-color: transparent;
                padding: 0 !important;
                //width: 100% !important;
                //margin: 0 0 20px !important;
                gap: 20px;
                flex-direction: column;
                overflow: visible;
            }

            .settings__column {
                @media (max-width: 991.98px) {
                    background: rgba(255, 255, 255, 0.3);
                    border: 0.5px solid rgba(0, 0, 0, 0.08);
                    border-radius: 12px;
                    padding: 20px;
                    gap: 20px;
                    .title {
                        margin-bottom: 0 !important;

                        &:after {
                            content: none;
                        }
                    }
                }
            }
        }

        .title {
            margin: 0;

            &-notification {
                width: 100%;
                margin-bottom: 34px;
            }
        }

        //&:last-child {
        //    margin-bottom: 0;
        //    gap: 24px 30px;
        //    flex-wrap: wrap;
        //    @media (max-width: 767.98px) {
        //        gap: 6px;
        //        flex-direction: column;
        //        flex-wrap: nowrap;
        //    }
        //}
    }

    &__column {
        display: flex;
        flex-direction: column;
        gap: 16px;
        width: 100%;
        transition: all 0.3s ease 0s;
    }

    &__block {
        background: #fff;
        border-radius: 21px;
        width: 100%;
        padding: 16px 24px;
        height: 100%;
        &-errors {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        @media (max-width: 767.98px) {
            background: transparent;
            padding: 0;
            border-radius: 0;
        }
    }

    &__row {
        &:not(:last-child) {
            margin-bottom: 16px;
            @media (max-width: 767.98px) {
                margin-bottom: 6px;
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

    &__input {
        font-weight: 500;
        margin-top: 8px;
        @media (max-width: 479.98px) {
            margin-top: 6px;
        }
    }

    &__label {
        cursor: pointer;
    }

    .blue-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 64px;
        @media (max-width: 991.98px) {
            padding: 0 20px;
        }
        @media (max-width: 767.98px) {
            width: 100%;
        }
    }
}
</style>

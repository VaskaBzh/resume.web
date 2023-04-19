<template>
    <div class="hint" v-hide="this.message !== ''">
        {{ this.message }}
    </div>
    <div class="settings" ref="page">
        <div class="settings__container">
            <main-title tag="h2" title-name="Настройки"></main-title>
            <div class="settings__wrap settings__wrap-adapt wrap">
                <div
                    class="settings__column"
                    v-scroll="'opacity transition--fast'"
                    v-if="Object.values(this.errors).length > 0"
                >
                    <main-title tag="h3" title-name="Ошибки"></main-title>
                    <div class="settings__block settings__block-errors">
                        <div
                            v-for="(error, i) in this.errors"
                            :key="i"
                            class="form_wrapper-message"
                        >
                            <div class="form_message">
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
                    </div>
                </div>
                <form @submit.prevent="reset" class="settings__column">
                    <main-title tag="h3" title-name="Смена пароля"></main-title>
                    <div class="settings__block">
                        <div class="settings__row">
                            <label for="old" class="settings__label main__label"
                                >Введите старый пароль</label
                            >
                            <input
                                v-model="resetForm.old_password"
                                type="password"
                                name="old"
                                id="old"
                                class="settings__input input"
                            />
                        </div>
                        <div class="settings__row">
                            <label for="new" class="settings__label main__label"
                                >Введите новый пароль</label
                            >
                            <input
                                v-model="resetForm.password"
                                type="password"
                                name="new"
                                id="new"
                                class="settings__input input"
                            />
                        </div>
                        <div class="settings__row">
                            <label
                                for="accept"
                                class="settings__label main__label"
                                >Подтвердите пароль</label
                            >
                            <input
                                v-model="resetForm.password_confirmation"
                                type="password"
                                name="accept"
                                id="accept"
                                class="settings__input input"
                            />
                        </div>
                    </div>
                    <blue-button type="submit">
                        <button class="all-link">Изменить пароль</button>
                    </blue-button>
                </form>
            </div>
            <!--            <div class="settings__wrap wrap">-->
            <!--                <main-title-->
            <!--                    class="title-notification"-->
            <!--                    tag="h3"-->
            <!--                    title-name="Уведомления"-->
            <!--                ></main-title>-->
            <!--                <main-checkbox-->
            <!--                    v-for="checkbox in this.checkboxes"-->
            <!--                    :key="checkbox.value"-->
            <!--                    :is_checked="checkbox.isChecked"-->
            <!--                    class="settings__checkbox"-->
            <!--                >-->
            <!--                    {{ checkbox.title }}-->
            <!--                </main-checkbox>-->
            <!--            </div>-->
        </div>
    </div>
</template>
<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import { useForm } from "@inertiajs/vue3";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
// import MainCheckbox from "@/Components/UI/MainCheckbox.vue";

export default {
    layout: profileLayoutView,
    components: {
        MainTitle,
        BlueButton,
        // MainCheckbox,
    },
    setup() {
        let resetForm = useForm({
            old_password: "",
            password: "",
            password_confirmation: "",
        });

        let reset = () => {
            resetForm.post("/password/reset");
        };

        return {
            resetForm,
            reset,
        };
    },
    computed: {
        errors() {
            let errs = this.$page.props.errors || {};
            errs = Object.values(errs).filter((el) => el !== "");
            return errs;
        },
        message() {
            let message = this.$page.props.message || "";
            if (message !== "") {
                // eslint-disable-next-line vue/no-async-in-computed-properties
                setTimeout(() => {
                    message = "";
                }, 3000);
            }
            return message;
        },
    },
    data() {
        return {
            is_checked: true,
            notification: true,
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
    methods: {
        checker() {
            if (!this.is_checked) {
                this.$refs.checkbox.classList.add("checked");
                this.is_checked = true;
            } else {
                this.$refs.checkbox.classList.remove("checked");
                this.is_checked = false;
            }
        },
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
    .title {
        margin: 0 0 16px;
        @media (min-width: 1271.98px) {
            padding-left: 70px;
        }
        @media (max-width: 767.98px) {
            margin: 28px 0 24px;
        }
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
        gap: 30px;
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
                width: 100% !important;
                margin: 0 0 20px !important;
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
                    margin: 0 -15px;
                    width: calc(100% + 30px);
                    gap: 20px;
                    .title {
                        margin-bottom: 0 !important;

                        &:after {
                            content: none;
                        }
                    }
                }
                @media (max-width: 479.98px) {
                    margin: 0 -20px;
                    width: calc(100% + 40px);
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

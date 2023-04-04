<template>
    <div class="settings">
        <div class="settings__container">
            <main-title tag="h2" title-name="Настройки"></main-title>
            <div class="settings__wrap settings__wrap-adapt wrap">
                <form action="#" class="settings__column">
                    <main-title tag="h3" title-name="Выплаты"></main-title>
                    <div class="settings__block">
                        <div class="settings__row">
                            <label
                                for="wallet"
                                class="settings__label main__label"
                                >BTC кошелек для выплат</label
                            >
                            <input
                                type="text"
                                id="wallet"
                                name="wallet"
                                class="settings__input input input-no-bg"
                            />
                        </div>
                        <div class="settings__row">
                            <span
                                ref="checkbox"
                                @click="this.checker"
                                class="settings__label main__label main__label-check"
                                >Использовать кошелек Allbtc</span
                            >
                        </div>
                    </div>
                    <div class="settings__block">
                        <div class="settings__row">
                            <label for="pay" class="settings__label main__label"
                                >Минимальное значение</label
                            >
                            <input
                                type="text"
                                id="pay"
                                name="pay"
                                value="0"
                                class="settings__input input input-no-bg"
                            />
                        </div>
                    </div>
                    <blue-button>
                        <button class="all-link">Сохранить изменения</button>
                    </blue-button>
                </form>
                <form action="#" class="settings__column">
                    <main-title tag="h3" title-name="Смена пароля"></main-title>
                    <div class="settings__block">
                        <div class="settings__row">
                            <label for="old" class="settings__label main__label"
                                >Введите старый пароль</label
                            >
                            <input
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
                                type="password"
                                name="accept"
                                id="accept"
                                class="settings__input input"
                            />
                        </div>
                    </div>
                    <blue-button>
                        <button class="all-link">Изменить пароль</button>
                    </blue-button>
                </form>
            </div>
            <div class="settings__wrap wrap">
                <main-title
                    class="title-notification"
                    tag="h3"
                    title-name="Уведомления"
                ></main-title>
                <main-checkbox
                    v-for="checkbox in this.checkboxes"
                    :key="checkbox.value"
                    :is_checked="checkbox.isChecked"
                    class="settings__checkbox"
                >
                    {{ checkbox.title }}
                </main-checkbox>
            </div>
        </div>
    </div>
</template>
<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import MainCheckbox from "@/Components/UI/MainCheckbox.vue";

export default {
    components: {
        MainTitle,
        BlueButton,
        MainCheckbox,
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
        this.$refs.checkbox.classList.add("checked");
    },
};
</script>
<style lang="scss" scoped>
.settings {
    .title {
        margin: 49px 0 24px;
        @media (max-width: 767.98px) {
            margin: 28px 0 24px;
        }
    }

    &__wrap {
        @media (min-width: 767.98px) {
            flex-direction: row;
            flex-wrap: nowrap;
        }
        gap: 30px;

        &-adapt {
            @media (max-width: 1270px) {
                padding: 20px;
            }
            @media (max-width: 767.98px) {
                background-color: transparent;
                padding: 0 !important;
                width: 100% !important;
                margin: 0 0 20px !important;
                gap: 20px;
                flex-direction: column;
            }

            .settings__column {
                @media (max-width: 767.98px) {
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

        &:last-child {
            margin-bottom: 0;
            gap: 24px 30px;
            flex-wrap: wrap;
            @media (max-width: 767.98px) {
                gap: 6px;
                flex-direction: column;
                flex-wrap: nowrap;
            }
        }
    }

    &__column {
        display: flex;
        flex-direction: column;
        gap: 16px;
        width: 100%;
    }

    &__block {
        background: #fff;
        border-radius: 21px;
        width: 100%;
        padding: 16px 24px;
        height: 100%;
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

<template>
    <div class="login">
        <div class="login__container" v-if="!this.isReg">
            <main-title tag="h2" titleName="Вход"></main-title>

            <form action="#" class="login__form">
                <div class="login__form_row">
                    <label for="tel" class="login__form_label"
                        >Номер Телефона
                    </label>
                    <input
                        type="tel"
                        class="login__form_input"
                        placeholder="+7 ___-___-__-__"
                    />
                </div>
                <div class="login__form_row">
                    <label for="pas" class="login__form_label">Пароль</label>
                    <input
                        type="password"
                        class="login__form_input"
                        placeholder="•••••••••"
                    />
                </div>
                <div class="login__form_row">
                    <router-link to="/profile" class="login__form_link">
                        <blue-button class="login__form_button">
                            <a href="#" class="all-link">Войти</a>
                        </blue-button>
                    </router-link>
                    <a href="#" class="main__link" @click="this.changer(true)">
                        Зарегистрироваться
                    </a>
                </div>
            </form>
        </div>
        <div class="login__container" v-else>
            <main-title tag="h2" titleName="Регистрация"></main-title>
            <form action="#" class="login__form">
                <div class="login__form_row">
                    <label for="tel" class="login__form_label">
                        Номер Телефона
                    </label>
                    <input
                        type="tel"
                        class="login__form_input"
                        placeholder="+7 ___-___-__-__"
                    />
                </div>
                <div class="login__form_row">
                    <label for="pas" class="login__form_label">Пароль</label>
                    <input
                        type="password"
                        class="login__form_input"
                        placeholder="•••••••••"
                    />
                </div>
                <div class="login__form_row">
                    <label for="pas" class="login__form_label">
                        Повторите пароль
                    </label>
                    <input
                        type="password"
                        class="login__form_input"
                        placeholder="•••••••••"
                    />
                </div>
                <div class="login__form_row">
                    <router-link to="/profile" class="login__form_link">
                        <blue-button class="login__form_button">
                            <a href="#" class="all-link">Зарегистрироваться</a>
                        </blue-button>
                    </router-link>
                    <a href="#" class="main__link" @click="this.changer(false)">
                        Войти
                    </a>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            isReg: false,
        };
    },
    methods: {
        changer(boolean) {
            this.isReg = boolean;
        },
    },
};
</script>
<style lang="scss" scoped>
.login {
    &__container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: auto;
    }
    .title {
        margin: 33px 0 23px;
    }
    &__form {
        max-width: 660px;
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 23px;
        align-items: center;
        &_row,
        &_label,
        &_input,
        &_link {
            width: 100%;
        }

        &_link {
            display: inline-flex;
            justify-content: center;
        }
        &_row {
            &:last-child {
                margin-top: 30px;
                display: inline-flex;
                flex-direction: column;
                align-items: center;
            }
        }
        &_button {
            width: 50%;
            text-align: center;
            margin-bottom: 8px;
        }
        &_label {
            font-size: 18px;
            line-height: 23px;
            font-family: AmpleSoftPro;
            color: #000034;
        }
        &_input {
            background-color: #fff;
            border-radius: 21px;
            height: 50px;
            padding: 8px 24px;
            font-size: 18px;
            line-height: 23px;
            margin-top: 8px;
            color: #000034;
            &::placeholder {
                color: #0000349e;
            }
        }
    }
}
</style>

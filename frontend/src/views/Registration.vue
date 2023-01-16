<template>
    <div class="login">
        <div class="login__container">
            <main-title tag="h2" titleName="Регистрация"></main-title>
            <form @submit.prevent="submit" class="login__form">
                <div class="login__form_row">
                    <label for="tel" class="login__form_label"> Логин </label>
                    <input
                        v-model="data.name"
                        type="text"
                        class="login__form_input"
                        placeholder=""
                    />
                </div>
                <div class="login__form_row">
                    <label for="tel" class="login__form_label"> Email </label>
                    <input
                        v-model="data.email"
                        type="email"
                        class="login__form_input"
                        placeholder=""
                    />
                </div>
                <div class="login__form_row">
                    <label for="pas" class="login__form_label">Пароль</label>
                    <input
                        v-model="data.password"
                        type="password"
                        class="login__form_input"
                        placeholder=""
                    />
                </div>
                <!--                <div class="login__form_row">-->
                <!--                    <label for="pas" class="login__form_label">-->
                <!--                        Повторите пароль-->
                <!--                    </label>-->
                <!--                    <input-->
                <!--                        type="password"-->
                <!--                        class="login__form_input"-->
                <!--                        placeholder=""-->
                <!--                    />-->
                <!--                </div>-->
                <div class="login__form_row">
                    <!--                    <router-link to="/profile" class="login__form_link">-->
                    <blue-button class="login__form_button">
                        <button type="submit" class="all-link">
                            Зарегистрироваться
                        </button>
                    </blue-button>
                    <!--                    </router-link>-->
                    <router-link to="/login" class="login__form_link">
                        <button type="submit" class="main__link">Войти</button>
                    </router-link>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import { reactive } from "vue";
import { useRouter } from "vue-router";

export default {
    name: "register_page",

    setup() {
        const data = reactive({
            name: "",
            email: "",
            password: "",
        });

        const submit = async () => {
            const data = reactive({
                name: "",
                email: "",
                password: "",
            });
            const router = useRouter();
            const submit = async () => {
                await fetch("http://localhost:8000/api/register", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(data),
                });
                await router.push("/login");
            };
            return {
                data,
                submit,
            };
        };

        return {
            data,
            submit,
        };
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

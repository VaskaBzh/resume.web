<template>
    <div class="calculator__container">
        <div class="calculator__main">
            <div class="calculator__top">
                <div class="calculator__title" v-scroll="'left'">
                    Калькулятор
                </div>
                <div class="calculator__text">
                    Калькулятор доходности майнинга поможет узнать, какие
                    альткоины выгодно майнить и какой доход принесет
                    оборудование с учетом затрат на электроэнергию.
                </div>
            </div>
            <div class="calculator__form">
                <input
                    type="text"
                    class="calculator__input"
                    placeholder="Ваш хэшрейт TH/s"
                    v-scroll="'left delay--md'"
                />

                <main-select
                    v-scroll="'left delay'"
                    :options="calculatorOptions"
                    selectType="large"
                >
                </main-select>
                <blue-button v-scroll="'left'">
                    <a href="#" class="all-link">Начать майнинг</a>
                </blue-button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            calculatorOptions: [
                { title: "Bitcoin", value: 1, img: "bitcoin_img.png" },
                {
                    title: "Bitcoin Cash",
                    value: 2,
                    img: "bitcoin-cash_img.png",
                },
                { title: "Litecoin", value: 3, img: "litecoin_img.png" },
                { title: "Dash", value: 4, img: "dash_img.png" },
            ],
        };
    },
};
</script>

<style lang="scss" scoped>
.calculator {
    margin-top: 100px;
    // .calculator__top
    &__top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        @media (max-width: 1270px) {
            display: block;
        }
    }
    // .calculator__title
    &__title {
        font-family: "AmpleSoftPro";
        font-style: normal;
        font-weight: 500;
        font-size: 53px;
        line-height: 107.6%;
        color: #000034;
        @media (max-width: 1270px) {
            margin-bottom: 16px;
        }
        @media (max-width: 991.98px) {
            text-align: center;
        }
        @media (max-width: 767.98px) {
            font-size: 35px;
            line-height: 107.6%;
        }
    }
    // .calculator__text
    &__text {
        max-width: 730px;
        font-style: normal;
        font-weight: 300;
        font-size: 18px;
        line-height: 181.1%;
        color: #000000;
        @media (max-width: 767.98px) {
            font-size: 16px;
            line-height: 148.6%;
        }
    }
    // .calculator__form
    &__form {
        display: flex;
        margin-top: 40px;
        gap: 26px;
        @media (max-width: 991.98px) {
            margin-top: 26px;
            flex-direction: column;
        }
        & .blue-button {
            @media (max-width: 479.98px) {
                width: 100%;
                & a {
                    font-size: 18px;
                    line-height: 107.6%;
                }
            }
        }
    }
    // .calculator__input
    &__input {
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.16);
        border-radius: 10px;
        font-style: normal;
        font-weight: 300;
        font-size: 18px;
        line-height: 181.1%;
        color: rgba(0, 0, 0, 0.72);
        padding: 14px 30px;
    }
}

.all-link {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>

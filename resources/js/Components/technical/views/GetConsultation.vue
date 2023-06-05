<template>
    <div class="consultation">
        <div class="consultation__container">
            <div class="wrap">
                <div class="consultation__main wrap__block wrap__column">
                    <main-title
                        v-if="viewportWidth > 767.98"
                        tag="h2"
                        class="consultation_title"
                    >
                        Свяжитесь с нами и получите консультацию о том, как
                        эффективно управлять дата-центрами с помощью нашей
                        платформы управления хостингом
                    </main-title>
                    <main-title v-else tag="h2" class="consultation_title">
                        <img
                            src="../../../../assets/img/logo_icon.png"
                            alt="logo"
                        />
                        Не упустите возможность эффективно управлять
                        дата-центрами с помощью нашей платформы управления
                        хостингом
                    </main-title>
                    <p class="text" v-if="viewportWidth <= 767.98">
                        Свяжитесь с нами и получите консультацию о том, как
                        эффективно управлять дата-центрами с помощью нашей
                        платформы управления хостингом
                    </p>
                    <div class="wrap__row">
                        <input
                            class="input input-strong"
                            type="text"
                            placeholder="+7 (900) 00 00 000"
                        />
                        <blue-button class="consultation_button">
                            <a href="#" class="all-link">Перезвоните мне</a>
                        </blue-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";

export default {
    name: "get-consultation",
    components: {
        MainTitle,
        BlueButton,
    },
    data() {
        return {
            viewportWidth: 0,
        };
    },
    created: function () {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    methods: {
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
    },
};
</script>

<style scoped lang="scss">
.consultation {
    &_title {
        text-align: center;
        @media (max-width: 767.98px) {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 32px;
            img {
                width: 30%;
            }
        }
    }
    &__main {
        padding: 70px;
        align-items: center;
        gap: 32px;
        @media (max-width: 479.98px) {
            padding: 40px 6px;
            gap: 24px;
        }
    }
    &_button {
        min-width: 236px;
        border-radius: 5px;
        @media (max-width: 767.98px) {
            min-width: calc(50% - 27px / 2);
        }
        @media (max-width: 479.98px) {
            min-width: 100%;
            min-height: 60px;
        }
    }
    .text {
        text-align: center;
        padding: 0 14px;
    }
    .wrap {
        &__row {
            gap: 27px;
            @media (max-width: 479.98px) {
                flex-direction: column;
                padding: 0 14px;
                gap: 24px;
            }
            .input {
                max-width: 350px;
                @media (max-width: 479.98px) {
                    max-width: 100%;
                }
            }
        }
    }
}
</style>

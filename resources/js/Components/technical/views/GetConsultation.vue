<template>
    <div class="consultation">
        <div class="consultation__container">
            <div class="consultation__main section__block section__block-light">
                <div class="consultation__content">
                    <main-title class="consultation_title"
                        >{{ $t("hosting.consultation.title") }}
                    </main-title>
                    <p class="description">
                        {{ $t("hosting.consultation.text") }}
                    </p>
                </div>
                <form class="consultation__form">
                    <input
                        type="text"
                        class="input input-md input-white"
                        placeholder="+7 (900) 00 00 000"
                    />
                    <blue-button class="button button-md"
                        >{{ $t("hosting.consultation.button") }}
                    </blue-button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import BlueButton from "@/modules/common/Components/UI/ButtonBlue.vue";

export default {
    name: "GetConsultation",
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
    &__container {
        margin: 0 auto;
    }

    &__main {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 40px;
        padding: 40px;
        @media (max-width: 479.98px) {
            gap: 32px;
        }
    }

    &__content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;

        .description,
        .title {
            width: 100%;
            @media (min-width: 479.98px) {
                text-align: center;
            }
        }
    }

    &__form {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 30px;
        width: 100%;
        @media (max-width: 479.98px) {
            gap: 12px;
            flex-direction: column;
        }

        .input {
            max-width: 386px;
            width: 100%;
            height: 56px;
            font-size: 18px;
            color: #c5c5c5;
            line-height: 181.1%;
            font-weight: 500;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.16);
            outline: none;
            padding-left: 2em;

            &::placeholder {
                color: #c5c5c5;
                font-weight: 300;
            }
        }

        .button {
            min-width: 236px;
            @media (max-width: 479.98px) {
                min-width: 100%;
            }
        }
    }
}
</style>

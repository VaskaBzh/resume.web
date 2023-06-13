<template>
    <div class="advantages">
        <div class="advantages__container">
            <main-title tag="h3" class="advantages_title"
                >Присоединяйтесь к нам и ощутите преимущества продвинутого
                управления вашим майнинг-хостингом</main-title
            >
            <div class="advantages__buttons">
                <button class="button button-md button-blue">
                    Начать майнинг
                </button>
                <button class="button button-md button-light">
                    Оставить заявку
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";

export default {
    name: "advantages-view",
    components: {
        MainTitle,
    },
};
</script>

<style scoped lang="scss">
.advantages {
    margin: 124px 0;
    @media (max-width: 767.98px) {
        margin: 52px 0;
    }
    &_title {
        margin-bottom: 48px;
        max-width: 1216px;
        text-align: center;
        @media (max-width: 767.98px) {
            margin-bottom: 24px;
        }
        @media (max-width: 479.98px) {
            margin-bottom: 40px;
        }
    }
    &__buttons {
        display: flex;
        align-items: center;
        gap: 24px;
        width: fit-content;
        margin: 0 auto;
        .button {
            z-index: 5;
        }
        @media (max-width: 479.98px) {
            flex-direction: column;
            gap: 16px;
        }
    }
}
</style>

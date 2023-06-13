<template>
    <div class="card">
        <div class="card_img">
            <img :src="img" alt="card_img" />
        </div>
        <div class="card__content">
            <p class="subtitle">{{ card.title }}</p>
            <p class="description description-sm">{{ card.text }}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "hosting-info-card",
    props: {
        card: Object,
    },
    computed: {
        img() {
            return new URL(
                `/resources/assets/img/${this.card.img}`,
                import.meta.url
            );
        },
    },
};
</script>

<style scoped lang="scss">
.card {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 40px;
    background: #fafafa;
    box-shadow: -21.7831px 32.6746px 15.4297px rgba(0, 0, 0, 0.01),
        -11.7992px 18.1526px 13.6144px rgba(0, 0, 0, 0.03),
        -5.44577px 8.16865px 9.98391px rgba(0, 0, 0, 0.04),
        -0.907628px 1.81526px 5.44577px rgba(0, 0, 0, 0.05),
        0px 0px 0px rgba(0, 0, 0, 0.05);
    border-radius: 32px;
    padding: 32px 39px;
    @media (max-width: 767.98px) {
        padding: 32px;
        gap: 24px;
    }
    @media (max-width: 767.98px) {
        margin: 0 15px;
        width: auto;
    }
    &_img {
        display: flex;
        align-items: center;
        justify-content: center;
        max-width: 240px;
        height: 240px;
        @media (max-width: 767.98px) {
            max-width: 200px;
            height: 131px;
        }
        img {
            max-width: 240px;
            width: 100%;
            filter: drop-shadow(
                0px 8.35001px 41.75px rgba(112, 165, 236, 0.15)
            );
            @media (max-width: 767.98px) {
                max-width: 160px;
            }
        }
    }
    p {
        text-align: center;
    }
    &__content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        @media (max-width: 767.98px) {
            gap: 8px;
        }
    }
}
</style>

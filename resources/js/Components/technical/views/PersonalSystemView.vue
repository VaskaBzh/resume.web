<template>
    <div class="personal">
        <div class="personal__container">
            <div class="wrap">
                <div class="wrap__block">
                    <div class="personal__logo_con">
                        <img
                            class="personal__logo"
                            src="../../../../assets/img/logo_icon.png"
                            alt=""
                        />
                    </div>
                    <main-title tag="h2" class="personal__title">
                        {{ $t("personal_system.title") }}
                    </main-title>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";

export default {
    name: "personal-system-view",
    components: {
        MainTitle,
    },
};
</script>

<style lang="scss" scoped>
.personal {
    .wrap__block {
        min-height: 289px;
        padding: 20px;
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 18px;
        align-items: center;
        justify-content: center;
    }
    // .personal__logo
    &__logo {
        max-width: 95px;
        margin-bottom: 18px;
        @media (max-width: 767.98px) {
            max-width: 67px;
            margin-bottom: 32px;
        }
        &_con {
            display: flex;
            justify-content: center;
        }
    }
    // .personal__title
    &__title {
        font-family: "AmpleSoftPro",serif;
        font-style: normal;
        font-weight: 500;
        font-size: 31px;
        line-height: 132.6%;
        color: #000034;
        text-align: center;
        max-width: 881px;
        @media (max-width: 767.98px) {
            font-size: 27px;
            line-height: 107.6%;
        }
    }
    // .personal__list
    &__list {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 80px;
        @media (max-width: 991.98px) {
            gap: 36px;
        }
    }
    // .personal__item
    &__item {
        display: flex;
        flex-direction: column;
        align-items: center;
        // .personal__item_image
        &_image {
            &_con {
                height: 190px;
                display: flex;
                align-items: end;
            }
            &.n-1 {
                max-height: 190px;
            }
            &.n-2 {
                max-height: 145px;
            }
            &.n-3 {
                max-height: 137px;
            }
        }
        // .personal__item_title
        &_title {
            font-family: "AmpleSoftPro";
            font-style: normal;
            font-weight: 500;
            font-size: 27px;
            line-height: 107.6%;
            color: #000034;
            margin-bottom: 24px;
            align-self: start;
            text-align: center;
            width: 100%;
            @media (min-width: 1270.98px) {
                white-space: nowrap;
            }
            @media (max-width: 991.98px) {
                align-self: center;
                text-align: center;
            }
            @media (max-width: 767.98px) {
                font-size: 22px;
                line-height: 107.6%;
                margin-bottom: 20px;
            }
        }
        // .personal__item_text
        .text {
            text-align: center;
            @media (max-width: 767.98px) {
                align-self: center;
            }
        }
    }
}
</style>

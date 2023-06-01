<template>
    <div class="pull-static">
        <div class="pull-static__container">
            <div class="pull-static__main pull-sm">
                <div class="pull-sm__info">
                    <div class="pull-sm__title">
                        Статика пула в режиме реального времени
                    </div>
                    <ul class="pull-sm__list">
                        <li class="pull-sm__item">
                            <div class="pull-sm__item_info">
                                <span v-value-scroll>3</span> EH/s
                            </div>
                            <div class="pull-sm__item_span">Хэшрейт пула</div>
                        </li>
                        <li class="pull-sm__item">
                            <div class="pull-sm__item_info">
                                <span v-value-scroll>15723</span>
                            </div>
                            <div class="pull-sm__item_span">
                                Активные воркеры
                            </div>
                        </li>
                        <li class="pull-sm__item">
                            <div class="pull-sm__item_info">
                                <span v-value-scroll>1244</span>
                            </div>
                            <div class="pull-sm__item_span">
                                Активные пользователи
                            </div>
                        </li>
                        <li class="pull-sm__item">
                            <div class="pull-sm__item_info">
                                <span v-value-scroll>1 785</span> BTC
                            </div>
                            <div class="pull-sm__item_span">
                                Майнинг за все время
                            </div>
                        </li>
                        <li class="pull-sm__item">
                            <div class="pull-sm__item_info">FPPS</div>
                            <div class="pull-sm__item_span">
                                Система вознаграждений
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.pull-sm {
    margin-top: 56px;
    background: rgba(255, 255, 255, 0.29);
    border-radius: 21px;
    margin-bottom: 40px;
    padding: 17px;
    @media (max-width: 767.98px) {
        margin-top: 26px;
    }
    @media (max-width: 479.98px) {
        margin-top: 10px;
        margin-left: -15px;
        margin-right: -15px;
    }
    // .pull-sm__info
    &__info {
        background: #ffffff;
        border-radius: 21px;
        padding: 50px 15px 64px;
        @media (max-width: 991.98px) {
            padding: 34px 15px 48px;
        }
        @media (max-width: 767.98px) {
            padding: 0;
        }
    }
    // .pull-sm__title
    &__title {
        font-family: "AmpleSoftPro";
        font-style: normal;
        font-weight: 500;
        font-size: 36px;
        line-height: 107.6%;
        color: #000034;
        margin-bottom: 40px;
        text-align: center;
        @media (max-width: 767.98px) {
            font-size: 27px;
            line-height: 107.6%;
            margin-bottom: 32px;
            padding: 26px 20px 0;
        }
    }
    // .pull-sm__list
    &__list {
        display: flex;
        justify-content: center;
        gap: 68px;
        flex-wrap: wrap;
        @media (max-width: 767.98px) {
            align-items: center;
            flex-direction: column;
            gap: 26px;
        }
    }
    // .pull-sm__item
    &__item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 3px;
        position: relative;
        &:not(:last-child) {
            &::before {
                content: "";
                position: absolute;
                height: 100%;
                width: 1px;
                background: rgba(0, 0, 0, 0.07);
                right: -34px;
            }
        }
        @media (max-width: 767.98px) {
            padding: 0 15px;
            &:last-child {
                margin-bottom: 20px;
            }
            width: 100%;
            &:not(:last-child) {
                &::before {
                    right: 0;
                    width: 100%;
                    height: 1px;
                    bottom: -25%;
                }
            }
        }
        // .pull-sm__item_info
        &_info {
            font-family: "AmpleSoftPro";
            font-style: normal;
            font-weight: 500;
            font-size: 36px;
            line-height: 107.6%;
            color: #3f7bde;
        }
        // .pull-sm__item_span
        &_span {
            font-style: normal;
            font-weight: 300;
            font-size: 16px;
            line-height: 143.1%;
            color: rgba(0, 0, 0, 0.62);
        }
    }
}
</style>

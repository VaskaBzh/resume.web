<template>
    <div class="slider">
        <main-preloader
            class="cabinet__preloader"
            :wait="wait"
            :interval="35"
            :end="!wait"
            :empty="empty"
        />
        <slot v-if="!wait && !empty" />
        <div class="slider__nav" v-if="!wait && !empty">
            <!--            <page-info-->
            <!--                :startPage=""-->
            <!--            />-->
            <div class="slider__nav-slides">
                <slider-swipe
                    :direction="false"
                    @swipe="ajax(meta?.links.prev)"
                />
                <div class="slider__slides" v-if="!service.haveMeta">
                    <span>...</span>
                </div>
                <div class="slider__slides" v-else>
                    <slider-button
                        v-for="(link, i) in links"
                        :key="i"
                        :value="link.label"
                        :active="service.activeLink"
                        @swipePage="ajax(link.url)"
                    />
                </div>
                <slider-swipe
                    :direction="true"
                    @swipe="ajax(meta?.links.next)"
                />
            </div>
        </div>
    </div>
</template>
<script>
import SliderSwipe from "./UI/SliderSwipe.vue";
import SliderButton from "./UI/SliderButton.vue";
import PageInfo from "./UI/PageInfo.vue";
import MainPreloader from "../../preloader/Components/MainPreloader.vue";
import { mapGetters } from "vuex";
import { SliderService } from "../services/SliderService";

export default {
    components: {
        MainPreloader,
        PageInfo,
        SliderButton,
        SliderSwipe,
    },
    props: {
        table: Object,
        wait: Boolean,
        empty: Object,
        rowsNum: {
            type: Number,
            default: 10,
        },
        meta: Object,
    },
    watch: {
        "service.link"(newLinksArray) {
            this.service.setActiveLink(newLinksArray);
        },
        meta(newMeta) {
            this.service
                .getMeta(newMeta)
                .metaProcess(newMeta)
                .cacheTable(newMeta);
        },
        rowsNumber(newVal, oldVal) {
            this.rowsNumber = this.service.validateRowsNumber(newVal, oldVal);

            this.$emit("changePerPage", this.rowsNumber);
        },
    },
    data() {
        return {
            rowsNumber: this.rowsNum,
            saveTable: {},
            service: new SliderService(this.meta),
        };
    },
    computed: {
        ...mapGetters(["viewportWidth"]),
    },
    methods: {
        ajax(url) {
            if (url) {
                let link = url.split("=");
                this.$emit("changePage", link[link.length - 1]);
            }
        },
    },
};
</script>
<style lang="scss" scoped>
.ref {
    .slider__wrap {
        @media (max-width: 991.98px) {
            background: transparent;
            padding: 0;
            width: 100%;
            margin: 0;
        }
    }
}
.slider {
    height: 100%;
    width: 100%;
    // .slider__wrap
    &__wrap {
        width: 100%;
        padding: 24px 16px;
        background: rgba(255, 255, 255, 0.29);
        border-radius: 21px;
        margin-bottom: 16px;
        @media (max-width: 1270px) {
            padding: 20px;
        }
        @media (max-width: 767.98px) {
            margin: 0 -15px 20px;
            width: calc(100% + 30px);
        }
        @media (max-width: 479.98px) {
            margin: 0 -20px 20px;
            width: calc(100% + 40px);
        }
    }
    // .slider__nav
    &__nav {
        margin-top: 40px;
        width: 100%;
        display: flex;
        align-items: center;
        min-height: 40px;
        gap: 16px;
        @media (min-width: 480px) {
            justify-content: space-between;
        }
        @media (max-width: 479.98px) {
            display: grid;
            grid-template-rows: 1fr 1fr;
        }
        // .slider__nav_info
        &_info {
            font-weight: 500;
            font-size: 18px;
            font-family: AmpleSoftPro, serif;
            line-height: 22px;
            @media (max-width: 479.98px) {
                margin-bottom: 16px;
                color: #000034;
                font-size: 16px;
                line-height: 15px;
            }
        }

        &-rows {
            max-width: 96px;
            width: 100%;
            min-height: 40px;
            display: flex;
            padding: 0 5px;
            background: #fafafa;
            border-radius: 8px;
            align-items: center;
            @media (max-width: 767.98px) {
                display: none;
            }
            input {
                outline: none;
                color: #7c7c7c;
                border: none;
                font-family: AmpleSoftPro, serif;
                font-weight: 500;
                font-size: 18px;
                line-height: 135%;
                padding: 0 9px 0 8px;
                background: transparent;
                text-align: center;
                max-width: calc(18px + 13px + 12px);
            }
            &__buttons {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 0 15px 0 15px;
                position: relative;
                svg {
                    fill: #7c7c7c;
                    cursor: pointer;
                    width: 15px;
                    height: 15px;
                    transition: all 0.3s ease 0s;
                    &:hover {
                        fill: #343434;
                    }
                }
                &:before {
                    content: "";
                    position: absolute;
                    left: 0;
                    height: 100%;
                    width: 1px;
                    background: #eff2f6;
                }
            }
        }

        // .slider__nav-slides
        &-slides {
            display: flex;
            height: 100%;
            align-items: center;
            gap: 16px;
            margin-left: auto;
            @media (max-width: 767.98px) {
                gap: 13px;
            }
            @media (max-width: 479.98px) {
                width: 100%;
            }
        }
    }
    // .slider__button
    &__button {
        background: #ffffff;
        border-radius: 13px;
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        svg {
            stroke: #131a29;
        }
        &:hover {
            background: rgba(#c2d5f2, 0.61);
        }
        @media (max-width: 479.98px) {
            min-width: 32px;
            width: 32px;
            height: 32px;
            svg {
                width: 19px;
                height: 19px;
            }
        }
    }
    // .slider__slides
    &__slides {
        max-width: 245px;
        display: flex;
        height: 100%;
        align-items: center;
        font-family: AmpleSoftPro, serif;
        font-style: normal;
        font-weight: 500;
        font-size: 18px;
        line-height: 22px;
        gap: 16px;
        @media (max-width: 767.98px) {
            gap: 20px;
        }
        @media (max-width: 479.98px) {
            max-width: 100%;
            justify-content: space-between;
            gap: 12px;
        }
        &-full {
            @media (max-width: 479.98px) {
                width: 100%;
                gap: 0;
            }
        }
        a,
        span {
            user-select: none;
            color: #331a38;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: underline;
            text-decoration-color: transparent;
            @media (max-width: 479.98px) {
                font-size: 16px;
                line-height: 17px;
            }
        }
        .active {
            color: #3f7bdd !important;
        }
    }
}
</style>

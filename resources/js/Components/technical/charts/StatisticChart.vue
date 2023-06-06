<template>
    <div class="graph">
        <div class="graph__main">
            <div class="graph__head">
                <main-title tag="h3">{{ graphs[0].title[0] }}</main-title>
                <!--                <div class="graph__buttons">-->
                <!--                    <button class="graph__button graph__button-active">-->
                <!--                        1 день-->
                <!--                    </button>-->
                <!--                    <button class="graph__button">7 дней</button>-->
                <!--                    <button class="graph__button">30 дней</button>-->
                <!--                </div>-->
            </div>
            <div class="graph__list">
                <div
                    v-for="graph in graphs"
                    :key="graph.id"
                    class="graph__item"
                >
                    <div class="graph__con">
                        <div class="graph__title">{{ graph.title[0] }}</div>
                        <line-graph-statistic
                            :graphData="graph"
                            :height="height"
                            :viewportWidth="viewportWidth"
                        ></line-graph-statistic>
                        <div class="graph__title graph__title-second">
                            {{ graph.title[1] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import LineGraphStatistic from "@/Components/technical/LineGraphStatistic.vue";
export default {
    props: {
        graphs: {
            type: Array,
            required: true,
        },
        viewportWidth: {
            type: Number,
            default: 1980,
        },
        val: {
            type: Number,
            default: 24,
        },
    },
    data() {
        return {
            height: 300,
        };
    },
    watch: {
        viewportWidth() {
            if (this.viewportWidth >= 1270.98) {
                this.height = 300;
            }
            if (this.viewportWidth < 1270.98) {
                this.height = 260;
            }
            if (this.viewportWidth < 991.98) {
                this.height = 240;
            }
            if (this.viewportWidth < 767.98) {
                this.height = 200;
            }
            if (this.viewportWidth < 479.98) {
                this.height = 180;
            }
        },
    },
    components: {
        MainTitle,
        LineGraphStatistic,
    },
    computed: {
        hint_label_workers() {
            return this.$t("chart.hint_label");
        },
    },
};
</script>

<style lang="scss" scoped>
.popup_graph {
    .graph {
        &__item {
            padding: 25px 0 0;
        }
    }
    #myChart {
        @media (min-width: 991.98px) {
            height: 470px !important;
            width: 100% !important;
        }
        @media (min-width: 768.98px) {
            height: 370px !important;
            width: 100% !important;
        }
    }
}
#myChart {
    @media (min-width: 1270.98px) {
        height: 430px !important;
    }
    @media (min-width: 768.98px) {
        height: 330px !important;
        width: 100% !important;
    }
}
.graph {
    @media (max-width: 991.98px) {
        padding-bottom: 30px;
    }
    // .graph__main
    &__main {
        background: rgba(255, 255, 255, 0.29);
        border-radius: 21px;
        //padding: 21px 17px 17px;
        //@media (max-width: 767.98px) {
        //    margin: 0 -15px 20px;
        //    width: 105%;
        //}
        //@media (max-width: 479.98px) {
        //    margin: 0 -20px 20px;
        //    width: 110%;
        //    border-radius: 10px;
        //}
        //@media (max-width: 380.98px) {
        //    width: 115%;
        //}
    }
    // .grapth__head
    &__head {
        width: 100%;
        display: flex;
        justify-content: space-between;
        margin-bottom: 14px;
        @media (max-width: 479.98px) {
            flex-direction: column;
            margin-bottom: 10px;
        }
    }
    // .graph__buttons
    &__buttons {
        display: flex;
        justify-content: flex-end;
        @media (min-width: 479.98px) {
            margin-right: 32px;
        }
        @media (max-width: 479.98px) {
            justify-content: flex-start;
        }
    }
    //.graph__button
    &__button {
        width: 77px;
        height: 35px;
        border-radius: 16px;
        margin-right: 8px;
        color: #99acd3;
        background-color: transparent;
        font-weight: 400;
        font-size: 17px;
        line-height: 20px;
        @media (max-width: 479.98px) {
            border-radius: 8px;
            margin-right: 1px;
            font-size: 16px;
            line-height: 16px;
            width: 83px;
            height: 28px;
        }
        &:last-child {
            margin-right: 0;
        }
        // .grapth__button-active
        &-active {
            background-color: #fff;
            color: #181847;
        }
    }
    // .graph__con
    &__con {
        display: flex;
        align-items: center;
        position: relative;
        @media (max-width: 767.98px) {
            //padding: 20px 10px;
            flex-direction: column;
        }
        @media (max-width: 478.98px) {
            align-items: flex-start;
            overflow-x: scroll;
            overflow-y: hidden;
            padding: 0 0 15px;
            &::-webkit-scrollbar {
                height: 5px;

                &-thumb {
                    /* плашка-бегунок */
                    background: #4282ec;
                    border-radius: 4px;
                }
            }
        }
    }
    // .graph__graph
    &__graph {
        flex: 1 1 auto;
        @media (max-width: 767.98px) {
            width: 100%;
        }
        @media (max-width: 478.98px) {
            width: 200%;
        }
    }
    // .graph__title
    &__title {
        font-style: normal;
        font-weight: 400;
        font-size: 13px;
        line-height: 20px;
        color: #606060;
        writing-mode: vertical-lr;
        transform: rotate(180deg);
        @media (max-width: 767.98px) {
            writing-mode: horizontal-tb;
            transform: rotate(0deg);
            display: none;
        }
        @media (max-width: 479.98px) {
            font-size: 16px;
            width: 200%;
            text-align: center;
        }
        &-second {
            position: absolute;
            bottom: -45px;
            writing-mode: horizontal-tb;
            left: 50%;
            transform: translateX(-50%);
            @media (max-width: 767.98px) {
                position: relative;
                left: 0;
                transform: translateX(0);
            }
        }
    }
    // .graph__list
    &__list {
        display: flex;
        gap: 17px;
        @media (max-width: 991.98px) {
            flex-direction: column;
        }
        @media (max-width: 767.98px) {
            gap: 35px;
        }
    }
    // .graph__item
    &__item {
        flex: 0 1 100%;
    }
}
.graph-ia {
    margin-top: 24px;
    @media (max-width: 767.98px) {
        margin-top: 9px;
    }
    // .graph-ia__list
    &__list {
        display: flex;
        flex-direction: column;
        gap: 16px;
        @media (max-width: 767.98px) {
            padding: 0 23px 25px;
        }
        @media (max-width: 479.98px) {
            gap: 12px;
        }
    }
    // .graph-ia__item
    &__item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 7px;
        @media (max-width: 479.98px) {
            flex-direction: column;
            align-items: start;
        }
        // .graph-ia__item_title
        &_title {
            flex: 1 0 50%;
            font-style: normal;
            font-weight: 300;
            font-size: 16px;
            line-height: 158.1%;
            color: #000000;
            max-width: 230px;
            @media (max-width: 767.98px) {
                font-size: 15px;
                line-height: 158.1%;
            }
        }
        // .graph-ia__item_text
        &_text {
            font-family: "AmpleSoftPro";
            font-style: normal;
            font-weight: 500;
            font-size: 17px;
            line-height: 143.1%;
            color: #000034;
            display: flex;
            column-gap: 8px;
            flex-wrap: wrap;
            justify-content: end;
            @media (max-width: 767.98px) {
                font-size: 15px;
                line-height: 158.1%;
            }

            & span {
                font-family: "AmpleSoftPro";
                color: #e9c058;
                white-space: nowrap;
            }
        }
    }
}
</style>

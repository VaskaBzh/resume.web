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
                        <!--                        <div class="graph__title">{{ graph.title[0] }}</div>-->
                        <line-graph-statistic
                            :graphData="graph"
                            :height="height"
                            :redraw="redraw"
                            :viewportWidth="viewportWidth"
                            :tooltip="tooltip"
                        ></line-graph-statistic>
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
        heightVal: Number,
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
        redraw: {
            type: Boolean,
            default: true,
        },
        tooltip: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            height: 360,
        };
    },
    watch: {
        viewportWidth() {
            this.height = this.getHeight;
        },
    },
    mounted() {
        this.height = this.getHeight;
    },
    components: {
        MainTitle,
        LineGraphStatistic,
    },
    computed: {
        getHeight() {
            if (!this.heightVal) {
                if (this.viewportWidth < 479.98) return 260;
                else if (this.viewportWidth < 767.98) return 280;
                else if (this.viewportWidth < 991.98) return 300;
                else if (this.viewportWidth < 1320.98) return 320;
                else return 360;
            } else {
                return this.heightVal;
            }
        },
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
}
.graph {
    @media (max-width: 991.98px) {
        padding-bottom: 12px;
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
        margin: 0 0 23px;
        @media (max-width: 991.98px) {
            margin: 0 0 calc(34px - 24px);
        }
        @media (max-width: 767.98px) {
            //padding: 20px 10px;
            flex-direction: column;
        }
        @media (max-width: 478.98px) {
            align-items: flex-start;
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
        line-height: 20px;
        position: absolute;
        left: 0;
        font-size: 14px;
        font-family: "AmpleSoftPro", serif;
        color: rgba(0, 0, 0, 0.6196078431);
        top: -20px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        &:after {
            content: "";
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background-color: #417fe5;
        }
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

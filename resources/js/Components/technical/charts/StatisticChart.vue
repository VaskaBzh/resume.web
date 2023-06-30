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
            <div class="graph__list" ref="graph">
                <line-graph-statistic
                    :graphData="graphs[0]"
                    :height="height"
                    :redraw="redraw"
                    :viewportWidth="viewportWidth"
                    :tooltip="tooltip"
                    lineColor="#3F7BDD"
                    :lineWidth="2.5"
                    mouseLineColor="#3F7BDD"
                    circleColor="#79A3E8"
                    circleBorder="#3F7BDD"
                    :bandColor="bandColor"
                    graphType="statistic"
                ></line-graph-statistic>
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import LineGraphStatistic from "@/Components/technical/LineGraphStatistic.vue";
import { mapGetters } from "vuex";

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
    beforeUpdate() {
        if (this.$refs.graph && this.viewportWidth <= 767.98) {
            this.$refs.graph.scrollLeft = this.$refs.graph.scrollWidth;
        }
    },
    mounted() {
        this.height = this.getHeight;
        if (this.$refs.graph && this.viewportWidth <= 767.98) {
            this.$refs.graph.scrollLeft = this.$refs.graph.scrollWidth;
        }
    },
    components: {
        MainTitle,
        LineGraphStatistic,
    },
    computed: {
        ...mapGetters(["isDark"]),
        bandColor() {
            let color = "#E6EAF0";
            if (this.isDark) {
                color = "#262626";
            }
            return color;
        },
        getHeight() {
            if (!this.heightVal) {
                if (this.viewportWidth < 479.98) return 338;
                else if (this.viewportWidth < 767.98) return 338;
                else if (this.viewportWidth < 991.98) return 338;
                else if (this.viewportWidth < 1320.98) return 338;
                else return 338;
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
        margin: 0 0 12px;
        @media (max-width: 767.98px) {
            overflow-x: scroll;
            overflow-y: visible;
            margin-left: 38px;
            padding: 48px 24px 36px 12px;
        }
    }
}
</style>

<template>
    <div class="wrap">
        <div
            v-for="graph in graphs"
            :key="graph.id"
            class="wrap__block wrap__column"
        >
            <div class="graph" v-show="graph.values">
                <div class="graph_title">{{ graph.title }}</div>
                <line-graph
                    :graphData="graph"
                    :height="height"
                    :viewportWidth="viewportWidth"
                ></line-graph>
            </div>
            <div class="graph__item_about graph-ia">
                <ul class="graph-ia__list">
                    <li
                        v-for="(aboutItem, i) in graph.about"
                        :key="aboutItem.id"
                        class="graph-ia__item"
                    >
                        <div class="text text-black">
                            {{ aboutItem.title }}
                        </div>
                        <div class="graph-ia__item_text">
                            <span>{{ text[aboutItem.id] }}</span>
                            <span>{{ span[aboutItem.id] }}</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from "lodash";
import LineGraph from "@/Components/technical/LineGraph.vue";

export default {
    components: {
        LineGraph,
    },
    props: {
        graphs: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            viewportWidth: 0,
            height: 300,
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
        },
    },
    computed: {
        text() {
            let str = {};
            this.graphs.forEach((graph) => {
                graph.about.forEach((el) => {
                    el.text
                        ? Vue.set(str, el.id, el.text)
                        : Vue.set(str, el.id, "");
                });
            });
            return str;
        },
        span() {
            let str = {};
            this.graphs.forEach((graph) => {
                graph.about.forEach((el) => {
                    el.span
                        ? Vue.set(str, el.id, el.span)
                        : Vue.set(str, el.id, "");
                });
            });
            return str;
        },
    },
};
</script>

<style lang="scss" scoped>
#myChart {
    @media (max-width: 479.98px) {
        width: 240px;
    }
}
.wrap {
    flex-wrap: nowrap;
    @media (max-width: 991.98px) {
        flex-wrap: wrap;
    }
    &__block {
        width: 100%;
        gap: 20px;
        @media (max-width: 767.98px) {
            padding: 15px;
            gap: 10px;
            &-graph {
                order: 3;
                padding: 24px !important;
                display: flex;
                align-items: center;
                justify-content: center;
                .propeller {
                    margin: auto auto auto auto !important;
                }
            }
        }
        @media (max-width: 479.98px) {
            min-height: 100px;
        }
    }
}
.graph {
    display: flex;
    align-items: center;
    padding: 0 0 15px;
    @media (max-width: 767.98px) {
        padding: 0 0px 30px 0;
        overflow-x: hidden;
    }
    // .graph__graph
    &__graph {
        flex: 1 1 auto;
    }
    // .graph__title
    &_title {
        font-style: normal;
        font-weight: 400;
        font-size: 15px;
        line-height: 143.1%;
        color: rgba(0, 0, 0, 0.4);
        writing-mode: vertical-lr;
        transform: rotate(180deg);
        @media (max-width: 479.98px) {
            font-size: 16px;
        }
    }
    // .graph__item
    &__item {
        background: #ffffff;
        border-radius: 21px;
        flex: 0 1 50%;
        padding: 28px 36px;

        @media (max-width: 767.98px) {
            padding: 0;
            flex: auto;
        }
        @media (max-width: 479.98px) {
            border-radius: 10px;
        }
    }
}
.graph-ia {
    // .graph-ia__list
    &__list {
        display: flex;
        flex-direction: column;
        gap: 16px;
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
        .text {
            flex: 1 0 50%;
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
            @media (max-width: 479.98px) {
                justify-content: flex-start;
            }

            & span {
                &:last-child {
                    font-family: "AmpleSoftPro";
                    color: #e9c058;
                    white-space: nowrap;
                }
            }
        }
    }
}
</style>

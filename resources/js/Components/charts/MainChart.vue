<template>
    <div class="graph">
        <div class="graph__main">
            <div class="graph__list">
                <div
                    v-for="graph in graphs"
                    :key="graph.id"
                    class="graph__item"
                >
                    <div class="graph__con">
                        <div class="graph__title">{{ graph.title }}</div>
                        <div class="graph__graph">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                    <div class="graph__item_about graph-ia">
                        <ul class="graph-ia__list">
                            <li
                                v-for="aboutItem in graph.about"
                                :key="aboutItem.id"
                                class="graph-ia__item"
                            >
                                <div class="graph-ia__item_title">
                                    {{ aboutItem.title }}
                                </div>
                                <div class="graph-ia__item_text">
                                    {{ aboutItem.text
                                    }}<span>{{ aboutItem.span }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Chart from "chart.js/auto";
export default {
    props: {
        graphs: {
            type: Array,
            required: true,
        },
    },
    methods: {
        graphInit() {
            const graphsList = this.graphs;
            for (let i = 0; i < graphsList.length; i++) {
                const ctr = document.querySelectorAll("#myChart");
                const ctx = ctr[i].getContext("2d");

                const gradientBg = ctx.createLinearGradient(0, 0, 0, 400);
                gradientBg.addColorStop(0, "rgba(63,123,221,1)");
                gradientBg.addColorStop(1, "rgba(255,255,255,0)");

                new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: [
                            "2010",
                            "2012",
                            "2014",
                            "2016",
                            "2018",
                            "2020",
                            "2022",
                        ],
                        datasets: [
                            {
                                label: graphsList[i].title,
                                data: graphsList[i].values,
                                borderColor: "#3f7bdd",
                                backgroundColor: gradientBg,
                                tension: 0.4,
                                radius: 0,
                            },
                        ],
                    },
                    options: {
                        fill: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    z: 2,
                                },
                            },
                            x: {
                                grid: {
                                    display: false,
                                },
                            },
                        },
                        plugins: {
                            tooltip: {
                                mode: "index",
                                intersect: false,
                            },
                            legend: {
                                // position: "left",
                                // onClick: false,
                                display: false,
                            },
                        },
                        hover: {
                            mode: "nearest",
                            intersect: false,
                        },
                    },
                });
            }
        },
    },
    mounted() {
        this.graphInit();
    },
};
</script>

<style lang="scss" scoped>
#myChart {
    @media (max-width: 479.98px) {
        width: 240px;
    }
}
.graph {
    // .graph__main
    &__main {
        background: rgba(255, 255, 255, 0.29);
        border-radius: 21px;
        padding: 17px;
        @media (max-width: 1270px) {
            padding: 20px;
        }
        @media (max-width: 479.98px) {
            margin: 0 -15px;
            border-radius: 10px;
        }
    }
    // .graph__con
    &__con {
        display: flex;
        align-items: center;
        @media (max-width: 767.98px) {
            padding: 15px 9px;
        }
        @media (max-width: 479.98px) {
        }
    }
    // .graph__graph
    &__graph {
        flex: 1 1 auto;
    }
    // .graph__title
    &__title {
        font-style: normal;
        font-weight: 400;
        font-size: 15px;
        line-height: 143.1%;
        color: rgba(0, 0, 0, 0.4);
        writing-mode: vertical-lr;
        transform: rotate(180deg);
        @media (max-width: 479.98px) {
            font-size: 12px;
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
        background: #ffffff;
        border-radius: 21px;
        flex: 0 1 50%;
        padding: 28px 36px;

        @media (max-width: 767.98px) {
            padding: 0;
        }
        @media (max-width: 479.98px) {
            border-radius: 10px;
        }
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

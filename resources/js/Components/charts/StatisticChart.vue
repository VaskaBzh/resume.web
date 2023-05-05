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
                        <div class="graph__graph">
                            <canvas id="myChart"></canvas>
                        </div>
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
import Chart from "chart.js/auto";
import MainTitle from "@/Components/UI/MainTitle.vue";
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
            default: 6,
        },
    },
    components: {
        MainTitle,
    },
    methods: {
        renderChart() {
            const graphsList = this.graphs;
            for (let i = 0; i < graphsList.length; i++) {
                const ctr = document.querySelectorAll("#myChart");
                const ctx = ctr[i].getContext("2d");

                const gradientBg = ctx.createLinearGradient(0, 0, 0, 400);
                gradientBg.addColorStop(0, "rgba(63,123,221,1)");
                gradientBg.addColorStop(1, "rgba(255,255,255,0)");

                let interval = 1; // Интервал между метками времени
                let hours = () => {
                    let arr = [];
                    let time = "";

                    switch (this.val) {
                        case 6:
                            interval = 1;
                            break;
                        case 24:
                            interval = 4;
                            break;
                        case 168:
                            interval = 24;
                            break;
                    }

                    for (let i = this.val; i >= 0; i -= interval) {
                        let currentHour = new Date().getHours() - i;
                        let currentDate = new Date();
                        currentDate.setHours(currentHour);

                        let hour = currentDate.getHours();
                        let day =
                            String(currentDate.getDate()).length !== 2
                                ? `0${currentDate.getDate()}`
                                : currentDate.getDate();
                        let mounth =
                            String(currentDate.getUTCMonth() + 1).length !== 2
                                ? `0${currentDate.getUTCMonth() + 1}`
                                : currentDate.getUTCMonth() + 1;

                        if (this.val === 168) {
                            time = `${day}.${mounth}`;
                        } else {
                            time = `${hour}:00`;
                        }
                        arr.push(time);
                    }
                    return arr;
                };

                let calculateAverage = (data, interval) => {
                    let averages = [];

                    for (let i = 0; i < data.length; i += interval) {
                        let sum = 0;
                        let count = 0;

                        for (
                            let j = i;
                            j < i + interval && j < data.length;
                            j++
                        ) {
                            sum += Number(data[j]);
                            count++;
                        }

                        let average = Number(sum) / count;
                        averages.push(average);
                    }

                    return averages;
                };

                new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: hours(),
                        datasets: [
                            {
                                label: graphsList[0].title[0],
                                data: calculateAverage(
                                    graphsList[i].values,
                                    interval
                                ),
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
                                ticks: {
                                    stepSize: 50,
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
        this.renderChart();
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
            font-size: 14px;
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
            align-items: center;
        }
        @media (max-width: 479.98px) {
        }
    }
    // .graph__graph
    &__graph {
        flex: 1 1 auto;
        @media (max-width: 767.98px) {
            margin: 12px 0;
            width: 100%;
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
        }
        @media (max-width: 479.98px) {
            font-size: 12px;
        }
        &-second {
            position: absolute;
            bottom: -16px;
            writing-mode: horizontal-tb;
            left: 50%;
            transform: translateX(-50%);
            @media (max-width: 767.98px) {
                position: relative;
                left: 0;
                bottom: 0;
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
        background: #ffffff;
        border-radius: 21px;
        flex: 0 1 100%;
        padding: 28px 36px 33px;

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

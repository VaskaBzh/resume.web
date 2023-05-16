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
            default: 24,
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
                            interval = 1;
                            break;
                        case 168:
                            interval = 24;
                            break;
                    }

                    for (let i = this.val - interval; i >= 0; i -= interval) {
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

                    for (let i = interval; i < data.length; i += interval) {
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

                let calculateMaxAverage = (data, interval) => {
                    let averages = [];

                    for (let i = interval; i < data.length; i += interval) {
                        let sum = 0;

                        for (
                            let j = i;
                            j < i + interval && j < data.length;
                            j++
                        ) {
                            if (sum <= Number(data[j])) {
                                sum = Number(data[j]);
                            }
                        }

                        let average = sum;
                        averages.push(average);
                    }

                    return averages;
                };

                let changeVal =
                    graphsList[i].values[graphsList[i].values.length - 1] /
                        1000 /
                        1000 >
                    1
                        ? "E"
                        : graphsList[i].values[
                              graphsList[i].values.length - 1
                          ] /
                              1000 >
                          1
                        ? "P"
                        : null;

                let values = graphsList[i].values.map((val) => {
                    let newVal = val;
                    if (changeVal === "E") {
                        newVal = val / 1000 / 1000;
                    }
                    if (changeVal === "P") {
                        newVal = val / 1000;
                    }
                    return newVal;
                });

                let yLabel =
                    graphsList[i].values[graphsList[i].values.length - 1] /
                        1000 /
                        1000 >
                    1
                        ? "Eh/s"
                        : graphsList[i].values[
                              graphsList[i].values.length - 1
                          ] /
                              1000 >
                          1
                        ? "Ph/s"
                        : "Th/s";

                let dates = hours();

                dates = [...new Set(dates)];

                const customLinesPlugin = {
                    id: "custom_lines_plugin",
                    afterDraw: (chart, args, options) => {
                        const yAxis = chart.scales["y"];
                        const xAxis = chart.scales["x"];

                        const dataset = chart.data.datasets[0];
                        const minValue = Math.min(...dataset.data);
                        const maxValue = Math.max(...dataset.data);

                        const minYPos = yAxis.getPixelForValue(minValue);
                        const maxYPos = yAxis.getPixelForValue(maxValue);

                        chart.ctx.save();
                        chart.ctx.strokeStyle = "#818c99";
                        chart.ctx.setLineDash([5, 5]);

                        // Draw min line
                        chart.ctx.beginPath();
                        chart.ctx.moveTo(xAxis.left, minYPos);
                        chart.ctx.lineTo(xAxis.right, minYPos);
                        chart.ctx.stroke();

                        // Draw max line
                        chart.ctx.beginPath();
                        chart.ctx.moveTo(xAxis.left, maxYPos);
                        chart.ctx.lineTo(xAxis.right, maxYPos);
                        chart.ctx.stroke();

                        chart.ctx.restore();
                    },
                };

                Chart.register(customLinesPlugin);

                new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: dates,
                        datasets: [
                            {
                                label: graphsList[0].title[0],
                                data: calculateAverage(values, interval),
                                borderColor: "#3f7bdd",
                                backgroundColor: gradientBg,
                                tension: 0.4,
                                radius: 0,
                            },
                        ],
                    },
                    options: {
                        interaction: {
                            mode: "index",
                            intersect: false,
                        },
                        fill: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    z: 2,
                                },
                                ticks: {
                                    callback: function (value, index, values) {
                                        return value + " " + yLabel; // Добавьте единицу измерения к каждой метке на оси Y
                                    },
                                },
                            },
                            x: {
                                grid: {
                                    display: false,
                                },
                            },
                        },
                        plugins: {
                            custom_lines_plugin: {},
                            tooltip: {
                                mode: "index",
                                intersect: false,
                                callbacks: {
                                    label: function (tooltipItem) {
                                        let label =
                                            tooltipItem.dataset.label || "";
                                        let value = tooltipItem.parsed.y;
                                        let amount = "";
                                        if (graphsList[0].amount) {
                                            amount = `; Активные воркеры: ${
                                                calculateMaxAverage(
                                                    graphsList[0].amount,
                                                    interval
                                                )[tooltipItem.parsed.x]
                                            }`;
                                        }

                                        if (label) {
                                            label += ": ";
                                        }

                                        label += `${value.toFixed(
                                            2
                                        )} ${yLabel}${amount}`;

                                        return label;
                                    },
                                },
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
        }
        @media (max-width: 478.98px) {
            align-items: flex-start;
            overflow-x: scroll;
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
        }
        @media (max-width: 479.98px) {
            font-size: 12px;
            width: 200%;
            text-align: center;
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

<template>
    <div class="table-block" v-if="this.visualType === 'block'">
        <div class="table-block_block">
            <div class="table-block_column">
                <span
                    class="main__name table-block_title"
                    v-for="(title, index) in this.table.shortTitles"
                    :key="index"
                >
                    {{ title }}
                </span>
            </div>
            <div
                class="table-block_column"
                v-scroll="'opacity transition--fast'"
            >
                <span>
                    <span class="legend_elem legend_elem-active">
                        {{ this.workers.active }}
                    </span>
                    <span class="legend_elem legend_elem-unstable">
                        {{ this.workers.unStable }}
                    </span>
                    <span class="legend_elem legend_elem-unActive">
                        {{ this.workers.inActive }}
                    </span>
                    <span class="main__number legend_elem legend_elem-all">
                        Все: {{ this.workers.all }}
                    </span>
                </span>
                <span class="main__number">{{ this.hashRate }} TH/s</span>
                <span class="main__number">{{ this.hashAvarage24 }} TH/s</span>
                <span class="main__number">{{ this.rejectRate }} %</span>
            </div>
        </div>
        <div
            class="table-block_block"
            v-for="(row, i) in this.table.rows"
            :key="i"
        >
            <div
                class="table-block_column"
                v-scroll="'opacity transition--fast'"
            >
                <span
                    class="main__name table-block_title"
                    v-for="(title, index) in this.table.shortTitles"
                    :key="index"
                >
                    {{ title }}
                </span>
            </div>
            <table-workers-row
                class="table-block_column"
                :visualType="this.visualType"
                :columns="row"
                :key="i"
                @click="this.indexChanger(row.graphId)"
                :class="row.hashClass"
            />
        </div>
    </div>
    <table ref="table" class="table" v-else>
        <thead>
            <tr v-if="this.viewportWidth > 991.98">
                <th
                    class="main__name"
                    v-for="(title, i) in this.table.titles"
                    :key="i"
                >
                    {{ title }}
                </th>
            </tr>
            <tr v-else>
                <th
                    class="main__name"
                    v-for="(title, i) in this.table.shortTitles"
                    :key="i"
                >
                    {{ title }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-if="this.viewportWidth > 767.98"
                class="row-main"
                :key="mainRow"
            >
                <td class="main__number">{{ this.mainRow.hash }}</td>
                <td class="main__number">{{ this.hashRate }} TH/s</td>
                <td class="main__number">{{ this.hashAvarage24 }} TH/s</td>
                <td class="main__number">{{ this.rejectRate }} %</td>
            </tr>
            <tr v-else class="row-main" :key="mainRow">
                <td>
                    <div class="row-main_elem row-main_elem-active">
                        {{ this.workers.active }}
                    </div>
                    <div class="row-main_elem row-main_elem-unstable">
                        {{ this.workers.unStable }}
                    </div>
                    <div class="row-main_elem row-main_elem-unActive">
                        {{ this.workers.inActive }}
                    </div>
                    <div class="main__number row-main_elem row-main_elem-all">
                        Все: {{ this.workers.all }}
                    </div>
                </td>
                <td class="main__number">{{ this.hashRate }} TH/s</td>
                <td class="main__number">{{ this.hashAvarage24 }} TH/s</td>
                <td class="main__number">{{ this.rejectRate }} %</td>
            </tr>
            <table-workers-row
                v-for="(row, i) in rows"
                :columns="row"
                :key="i"
                :class="row.hashClass"
                data-popup="#seeChart"
                @click="this.indexChanger(row.graphId)"
            />
        </tbody>
        <teleport to="body">
            <main-popup
                id="seeChart"
                ref="chart"
                typePopup="graph"
                @closed="dropIndex"
                @opened="setIndex"
                :animationEnd="animationEnd"
            >
                <transition name="chart">
                    <statistic-chart
                        class="graph"
                        :graphs="graphs"
                        v-if="indexWorker !== -1"
                        :redraw="redraw"
                        :viewportWidth="viewportWidth"
                        :heightVal="height"
                        :key="graphs[0].values[graphs[0].values.length - 1]"
                    />
                </transition>
            </main-popup>
        </teleport>
    </table>
</template>
<script>
import TableWorkersRow from "@/Components/tables/row/TableWorkersRow.vue";
import { mapGetters } from "vuex";
import MainPopup from "@/Components/technical/MainPopup.vue";
import StatisticChart from "@/Components/technical/charts/StatisticChart.vue";

export default {
    components: { MainPopup, TableWorkersRow, StatisticChart },
    props: {
        table: Object,
        visualType: {
            type: String,
            default: "table",
        },
    },
    data() {
        return {
            viewportWidth: 0,
            rows: this.table.rows,
            mainRow: this.table.mainRow,
            mainTable: this.table,
            indexWorker: -1,
            safeIndex: -1,
            height: 360,
            redraw: true,
            animationEnd: 1250,
            graphs: [
                {
                    id: 1,
                    title: [
                        this.$t("chart.labels[0]"),
                        this.$t("chart.labels[1]"),
                    ],
                    values: [],
                },
            ],
        };
    },
    watch: {
        viewportWidth() {
            if (this.viewportWidth >= 1270.98) {
                this.height = 360;
            }
            if (this.viewportWidth < 1270.98) {
                this.height = 360;
            }
            if (this.viewportWidth < 991.98) {
                this.height = 360;
            }
            if (this.viewportWidth < 767.98) {
                this.height = 260;
            }
            if (this.viewportWidth < 479.98) {
                this.height = 220;
            }
        },
        async indexWorker(newVal, oldVal) {
            if (newVal !== oldVal && newVal !== -1) {
                await setTimeout(() => (this.redraw = true), 1700);
            }
        },
    },
    computed: {
        ...mapGetters(["allHistoryMiner", "getActive"]),
        workers() {
            let workers = {
                active: 0,
                unStable: 0,
                inActive: 0,
                all: 0,
            };
            if (this.allAccounts[this.getActive]) {
                workers.active = this.allAccounts[this.getActive].workersActive;
                workers.unStable = this.allAccounts[this.getActive].workersDead;
                workers.inActive =
                    this.allAccounts[this.getActive].workersInActive;
                workers.all = this.allAccounts[this.getActive].workersAll;
            }
            return workers;
        },
        hashRate() {
            return Number(this.mainRow.hashRate).toFixed(2);
        },
        hashAvarage24() {
            return Number(this.mainRow.hashAvarage24).toFixed(2);
        },
        rejectRate() {
            return Number(this.mainRow.rejectRate).toFixed(2);
        },
        ...mapGetters(["allHistory", "allAccounts"]),
    },
    methods: {
        setIndex() {
            this.indexWorker = this.safeIndex;
        },
        dropIndex() {
            setTimeout(() => {
                this.indexWorker = -1;
            }, 100);
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        indexChanger(key) {
            setTimeout(() => {
                if (this.indexWorker !== key) {
                    this.graphs = [
                        {
                            id: 1,
                            title: [
                                this.$t("chart.labels[0]"),
                                this.$t("chart.labels[1]"),
                            ],
                            values: [],
                        },
                    ];

                    this.renderChart(key);
                }
            }, 10);
        },
        async renderChart(index) {
            const interval = 60 * 60 * 1000;
            const currentTime = new Date().getTime();
            const historyValues = this.allHistoryMiner[index];

            this.graphs[0].dates = Array.from({ length: 24 }, (_, i) => {
                const date = new Date(currentTime - (24 - 1 - i) * interval);
                return date.getTime();
            });

            if (historyValues) {
                const [values, amount, unit] = historyValues
                    .slice(-24)
                    .reverse()
                    .reduce(
                        (acc, el) => {
                            let hash = el.hash ?? 0;
                            if (el.unit === "P") hash *= 1000;
                            else if (el.unit === "E") hash *= 1000000;
                            acc[0].push(Number(hash));
                            el.amount ? acc[1].push(el.amount) : acc[1].push(0);
                            acc[2].push(el.unit ?? "T");

                            return acc;
                        },
                        [[], [], []]
                    );

                while (values.length < 24) {
                    values.push(0);
                    amount.push(0);
                    unit.push("T");
                }

                await Object.assign(this.graphs[0], {
                    values: values.reverse(),
                    amount: amount.map(String).reverse(),
                    unit: unit.reverse(),
                });

                this.safeIndex = index;
            }
        },
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
};
</script>
<style lang="scss" scoped>
.chart-enter-active,
.chart-leave-active {
    transition: all 0.5s ease 0s;
    transform: translateY(0);
    opacity: 1;
    max-height: fit-content;
}
.chart-enter-from,
.chart-leave-to {
    transform: translateY(200px);
    opacity: 0;
}
@keyframes opacity {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
.table {
    width: 100%;
    border-spacing: 0 8px;
    text-indent: 0;
    border-collapse: separate;
    position: relative;
    transition: all 0.3s ease 10ms;
    .graph {
        width: 100%;
        min-height: auto;
    }
    @media (max-width: 767.98px) {
        overflow-x: scroll;
        width: 120%;
    }
    &-block {
        display: flex;
        flex-direction: column;
        gap: 10px;
        &_block {
            padding: 10px;
            background: #ffffff;
            border-radius: 12px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            gap: 8px;
        }
        &_column {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: flex-start;
            &:last-child {
                align-items: flex-end;
                span {
                    text-align: right;
                    &:first-child {
                        span {
                            &:not(:last-child) {
                                color: #ffffff;
                                margin-right: 6px;
                                display: inline-flex;
                                align-items: center;
                                justify-content: center;
                                font-size: 16px;
                                line-height: 12px;
                                width: 16px;
                                height: 16px;
                                border-radius: 50%;
                            }
                            &:last-child {
                                margin-left: 0;
                            }
                        }
                    }
                }
            }
            span {
                height: 17px;
            }
        }
    }
    tr {
        th,
        td {
            white-space: nowrap;
            &:first-child {
                padding-left: 10px;
                @media (max-width: 767.98px) {
                    padding: 0 10px 0 0;
                }
            }
            &:last-child {
                @media (max-width: 479.98px) {
                    padding: 0;
                }
            }
        }
    }
    thead {
        tr {
            background: transparent;
            height: 23px;
            @media (max-width: 767.98px) {
                height: 18px;
            }
            @media (max-width: 479.98px) {
                height: 14px;
            }
            th {
                color: rgba(0, 0, 0, 0.62);
                font-weight: 400;
                font-size: 16px;
                line-height: 23px;
                text-align: left;
                padding-right: 10px;
            }
        }
    }
    tbody {
        tr {
            height: 48px;
            @media (max-width: 767.98px) {
                height: 34px;
            }
            @media (max-width: 479.98px) {
                border: 0.5px solid rgba(0, 0, 0, 0.08);
            }
            &:last-child {
                margin-bottom: 0;
            }
            td {
                color: #000034;
                font-weight: 500;
                font-size: 18px;
                line-height: 26px;
                @media (max-width: 767.98px) {
                    font-size: 16px;
                    line-height: 22px;
                }
            }
        }
    }
    .row {
        &-main {
            height: 42px !important;
            &_elem {
                display: inline-flex;
                font-weight: 500;
                font-size: 16px;
                line-height: 23px;
                &:not(:last-child) {
                    width: 16px;
                    height: 16px;
                    border-radius: 50%;
                    align-items: center;
                    justify-content: center;
                    margin-right: 6px;
                    color: #fff;
                    @media (max-width: 767.98px) {
                        font-size: 16px;
                        line-height: 17px;
                    }
                }
                &-active {
                    background: #13d60e;
                }
                &-unstable {
                    background: #f7931a;
                }
                &-unActive {
                    background: #ff0000;
                }
            }
            @media (max-width: 767.98px) {
                height: 34px !important;
            }
            @media (max-width: 479.98px) {
                border: none;
            }
            td {
                @media (max-width: 991.98px) {
                    background-color: #fff;
                }
                &:first-child {
                    border-radius: 12px 0 0 12px;
                    padding: 9px 10px;
                }
                &:last-child {
                    border-radius: 0 12px 12px 0;
                }
            }
        }
    }
}
</style>

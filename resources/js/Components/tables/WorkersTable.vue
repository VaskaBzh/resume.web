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
            <div class="table-block_column">
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
            <div class="table-block_column">
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
                data-popup="#seeChart"
                v-for="(row, i) in rows"
                :columns="row"
                :key="i"
                :class="row.hashClass"
                @click="this.indexChanger(row.graphId)"
            />
        </tbody>
        <popup-view id="seeChart" typePopup="graph">
            <statistic-chart
                v-if="this.indexWorker !== -1"
                :graphs="graphs"
                :key="this.graphs[0].values[this.graphs[0].values.length - 1]"
            />
        </popup-view>
    </table>
</template>
<script>
import TableWorkersRow from "@/Components/tables/row/TableWorkersRow.vue";
import StatisticChart from "@/Components/charts/StatisticChart.vue";
import { mapGetters } from "vuex";
import PopupView from "@/Components/technical/PopupView.vue";

export default {
    components: { PopupView, TableWorkersRow, StatisticChart },
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
            graphs: [
                {
                    id: 1,
                    title: ["Хешрейт", "Время"],
                    values: [],
                },
            ],
        };
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
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        indexChanger(key) {
            setTimeout(() => {
                if (this.indexWorker !== key) {
                    this.indexWorker = key;
                    this.renderChart(key);
                }
            }, 10);
        },
        renderChart(index) {
            let history;
            if (this.allHistoryMiner && this.allHistoryMiner[index]) {
                history = this.allHistoryMiner[index];
                console.log(history);
            }
            this.graphs[0].values = [];

            for (let i = 1; i <= 25; i++) {
                if (history) {
                    let timeStamp = history[history.length - i];
                    if (timeStamp) {
                        this.graphs[0].values.unshift(
                            Number(timeStamp[1]).toFixed(0)
                        );
                    } else {
                        this.graphs[0].values.unshift(String(0));
                    }
                } else {
                    this.graphs[0].values.unshift(String(0));
                }
            }
        },
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    mounted() {
        document.addEventListener("mousedown", this.closeGraph);
    },
    unmounted() {
        document.removeEventListener("mousedown", this.closeGraph);
    },
};
</script>
<style lang="scss" scoped>
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
                                font-size: 12px;
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
                @media (max-width: 320.98px) {
                    font-size: 12px;
                    line-height: 17px;
                }
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
                @media (max-width: 320.98px) {
                    font-size: 12px;
                    line-height: 17px;
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
                @media (max-width: 320.98px) {
                    font-size: 12px;
                    line-height: 17px;
                }
                &:not(:last-child) {
                    width: 16px;
                    height: 16px;
                    border-radius: 50%;
                    align-items: center;
                    justify-content: center;
                    margin-right: 6px;
                    color: #fff;
                    @media (max-width: 767.98px) {
                        font-size: 12px;
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

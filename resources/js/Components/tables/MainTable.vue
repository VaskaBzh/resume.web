<template>
    <table class="table">
        <thead class="table__head">
            <tr class="table__row">
                <th
                    class="table_column"
                    v-for="(title, i) in table.titles"
                    :key="i"
                >
                    {{ title }}
                </th>
            </tr>
        </thead>
        <tbody class="table__body">
            <table-row
                v-for="(row, i) in showRows"
                :columns="row"
                :titles="table.titles"
                :key="i"
                :viewportWidth="viewportWidth"
                :class="row.class || ''"
                @openGraph="getUser"
                :data-popup="row.data || ''"
            />
        </tbody>
    </table>
    <teleport to="body">
        <main-popup
            v-if="Object.values(allHistoryMiner).length > 0"
            class="popup-graph"
            id="seeChart"
            ref="chart"
            typePopup="graph"
            @closed="dropUser"
        >
            <div class="popup__head">
                <main-title tag="h4" class="title-blue">
                    {{ activeWorker.hash }}
                </main-title>
                <span class="status popup_status" :class="activeWorker.class">
                    {{
                        activeWorker.class === "active"
                            ? $t("workers.statuses[0]")
                            : activeWorker.class === "inactive"
                            ? $t("workers.statuses[1]")
                            : $t("workers.statuses[2]")
                    }}
                </span>
            </div>
            <div class="popup__main">
                <div class="popup__info">
                    <div class="popup__info_block">
                        <span class="label popup__info_block_label">
                            {{ $t("workers.table.thead[1]") }}</span
                        >
                        <span class="text text-black">
                            <b> {{ activeWorker.hashRate }}</b>
                        </span>
                    </div>
                    <div class="popup__info_block">
                        <span class="label popup__info_block_label">{{
                            $t("workers.table.thead[2]")
                        }}</span>
                        <span class="text text-black">
                            <b> {{ activeWorker.hashRate }}</b></span
                        >
                    </div>
                    <div class="popup__info_block">
                        <span class="label popup__info_block_label">{{
                            $t("workers.table.thead[3]")
                        }}</span>
                        <span class="text text-black">
                            <b> {{ activeWorker.hashRate24 }}</b></span
                        >
                    </div>
                    <div class="popup__info_block">
                        <span class="label popup__info_block_label">{{
                            $t("workers.table.thead[4]")
                        }}</span>
                        <span class="text text-black">
                            <b> {{ activeWorker.rejectRate }}</b></span
                        >
                    </div>
                </div>
                <statistic-chart
                    class="popup-graph__graph"
                    :graphs="graphs"
                    :redraw="redraw"
                    :viewportWidth="viewportWidth"
                    :heightVal="height"
                    :tooltip="true"
                    :key="graphs[0].values[graphs[0].values.length - 1]"
                />
            </div>
        </main-popup>
        <main-popup
            v-if="
                viewportWidth <= 767.98 && table.rows[0] && table.rows[0].status
            "
            class="popup-card"
            id="fullpage"
        >
            <div class="table__row" :class="activeWorker.class">
                <div class="table_column">
                    <span class="label">{{
                        activeWorker.wallet !== "..."
                            ? activeWorker.wallet
                            : activeWorker.txid
                    }}</span>
                    <span>{{ activeWorker.status }}</span>
                </div>
                <div class="table_column">
                    <span class="label">
                        {{ this.$t("income.table.thead[0]") }}</span
                    >
                    <span>{{ activeWorker.date }}</span>
                </div>
                <div class="table_column">
                    <span class="label">
                        {{ this.$t("income.table.thead[1]") }}</span
                    >
                    <span>{{ activeWorker.payDate }}</span>
                </div>
                <div class="table_column">
                    <span class="label">
                        {{ this.$t("income.table.thead[2]") }}</span
                    >
                    <span>{{ activeWorker.hash }}</span>
                </div>
                <div class="table_column">
                    <span class="label">
                        {{ this.$t("income.table.thead[3]") }}</span
                    >
                    <span>{{ activeWorker.earn }}</span>
                </div>
                <div class="table_column">
                    <span class="label">
                        {{ this.$t("income.table.thead[5]") }}</span
                    >
                    <span> {{ activeWorker.percent }}</span>
                </div>
                <div
                    class="table_column table_column-margin"
                    v-show="activeWorker.message"
                >
                    <span>{{ activeWorker.message }}</span>
                </div>
            </div>
        </main-popup>
    </teleport>
</template>

<script>
import TableRow from "@/Components/tables/row/TableRow.vue";
import MainPopup from "@/Components/technical/MainPopup.vue";
import StatisticChart from "@/Components/technical/charts/StatisticChart.vue";
import { mapGetters } from "vuex";
import MainTitle from "@/Components/UI/MainTitle.vue";

export default {
    name: "main-table",
    props: {
        viewportWidth: Number,
        table: Object,
        first: Number,
        rowsVal: {
            type: Number,
            default: 1,
        },
    },
    components: { MainPopup, StatisticChart, TableRow, MainTitle },
    computed: {
        ...mapGetters(["allHistoryMiner"]),
        showRows() {
            let showInfo = {};
            if (this.rowsVal > this.table.rows.length) {
                for (let i = this.first; i < this.table.rows.length; i++) {
                    Reflect.set(
                        showInfo,
                        Reflect.ownKeys(this.table.rows)[i],
                        Reflect.get(
                            this.table.rows,
                            Reflect.ownKeys(this.table.rows)[i]
                        )
                    );
                }
            } else {
                for (let i = this.first; i < this.rowsVal; i++) {
                    Reflect.set(
                        showInfo,
                        Reflect.ownKeys(this.table.rows)[i],
                        Reflect.get(
                            this.table.rows,
                            Reflect.ownKeys(this.table.rows)[i]
                        )
                    );
                }
            }
            return showInfo;
        },
    },
    data() {
        return {
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
            redraw: true,
            height: 360,
            indexWorker: 0,
            activeWorker: {},
        };
    },
    watch: {
        viewportWidth() {
            if (this.viewportWidth >= 991.98) {
                this.height = 360;
            }
            if (this.viewportWidth < 991.98) {
                this.height = 352;
            }
        },
        async indexWorker(newVal, oldVal) {
            if (newVal !== oldVal && newVal !== -1) {
                await setTimeout(() => (this.redraw = true), 1700);
            }
        },
    },
    methods: {
        getUser(data) {
            this.indexChanger(data.id);
            this.activeWorker = data.info;
        },
        indexChanger(key) {
            setTimeout(() => {
                if (this.indexWorker !== key && key) {
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

                    this.setIndex(key);

                    this.renderChart(key);
                }
            }, 10);
        },
        setIndex(index) {
            this.indexWorker = index;
        },
        dropUser() {
            setTimeout(() => {
                this.indexWorker = -1;
            }, 100);
            this.activeWorker = {};
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
                const [values, unit] = historyValues
                    .slice(-24)
                    .reverse()
                    .reduce(
                        (acc, el) => {
                            let hash = el.hash ?? 0;
                            if (el.unit === "P") hash *= 1000;
                            else if (el.unit === "E") hash *= 1000000;
                            acc[0].push(Number(hash));
                            acc[2].push(el.unit ?? "T");

                            return acc;
                        },
                        [[], [], []]
                    );

                while (values.length < 24) {
                    values.push(0);
                    unit.push("T");
                }

                await Object.assign(this.graphs[0], {
                    values: values.reverse(),
                    unit: unit.reverse(),
                });

                this.safeIndex = index;
            }
        },
    },
};
</script>

<style lang="scss">
.table {
    width: 100%;
    border-spacing: 0 8px;
    text-indent: 0;
    border-collapse: separate;
    @media (max-width: 767.98px) {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    &__body {
        @media (max-width: 767.98px) {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
    }
    &_column {
        @media (min-width: 767.98px) {
            height: 48px;
            padding-right: 16px;
        }
        &:first-child {
            border-radius: 8px 0 0 8px;
        }
        &:last-child {
            border-radius: 0 8px 8px 0;
        }
    }
    &__head {
        @media (max-width: 767.98px) {
            display: none;
        }
        .table {
            &_column {
                color: #818c99;
                font-size: 14px;
                font-weight: 400;
                line-height: 130%;
                text-align: left;
                background: transparent;
            }
        }
    }
    &_column {
        @media (max-width: 767.98px) {
            display: inline-flex;
            width: 100%;
            justify-content: space-between;
            span {
                &:last-child {
                    font-weight: 500;
                }
            }
            &-margin {
                margin-top: 8px;
            }
        }
    }
}
</style>

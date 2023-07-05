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
                v-for="(row, i) in table.rows"
                :columns="row"
                :key="i"
                :class="row.class || ''"
                @openGraph="indexChanger"
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
            @closed="dropIndex"
            @opened="setIndex"
            :animationEnd="10300"
        >
            <statistic-chart
                class="graph"
                :graphs="graphs"
                :redraw="redraw"
                :viewportWidth="viewportWidth"
                :heightVal="height"
                :tooltip="true"
                :key="graphs[0].values[graphs[0].values.length - 1]"
            />
        </main-popup>
    </teleport>
</template>

<script>
import TableRow from "@/Components/tables/row/TableRow.vue";
import MainPopup from "@/Components/technical/MainPopup.vue";
import StatisticChart from "@/Components/technical/charts/StatisticChart.vue";
import { mapGetters } from "vuex";

export default {
    name: "main-table",
    props: {
        viewportWidth: Number,
        table: Object,
    },
    components: { MainPopup, StatisticChart, TableRow },
    computed: {
        ...mapGetters(["allHistoryMiner"]),
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
            height: 287,
        };
    },
    watch: {
        viewportWidth() {
            if (this.viewportWidth >= 991.98) {
                this.height = 287;
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
        indexChanger(key) {
            setTimeout(() => {
                console.log(key);
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

                    this.setIndex(key);

                    this.renderChart(key);
                }
            }, 10);
        },
        setIndex(index) {
            this.indexWorker = index;
        },
        dropIndex() {
            setTimeout(() => {
                this.indexWorker = -1;
            }, 100);
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
};
</script>

<style lang="scss">
.table {
    width: 100%;
    border-spacing: 0 8px;
    text-indent: 0;
    border-collapse: separate;
    &_column {
        height: 48px;
        padding-right: 16px;
        &:first-child {
            border-radius: 8px 0 0 8px;
        }
        &:last-child {
            border-radius: 0 8px 8px 0;
        }
    }
    &__head {
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
}
</style>

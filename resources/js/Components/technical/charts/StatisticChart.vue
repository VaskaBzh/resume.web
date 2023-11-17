<template>
    <div class="graph" ref="graph">
        <main-line-graph :graphData="graph" :height="height" />

        <!--                :key="graph ? Object.values(graph)?.length : 1"-->
        <!--                :graphData="graph"-->
        <!--                :height="height"-->
        <!--                :redraw="redraw"-->
        <!--                :viewportWidth="viewportWidth"-->
        <!--                :tooltip="tooltip"-->
        <!--                lineColor="#3F7BDD"-->
        <!--                :lineWidth="2.5"-->
        <!--                mouseLineColor="#3F7BDD"-->
        <!--                circleColor="#79A3E8"-->
        <!--                circleBorder="#3F7BDD"-->
        <!--                :bandColor="bandColor"-->
        <!--                graphType="statistic"-->
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import MainLineGraph from "@/modules/graphs/Components/MainLineGraph.vue";

export default {
    props: {
        heightVal: Number,
        graph: {
            type: Object,
            required: true,
        },
        viewportWidth: {
            type: Number,
            default: 1980,
        },
        offset: {
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
            height: 448,
            bandColor: "#E6EAF0",
        };
    },
    watch: {
        viewportWidth() {
            this.height = this.getHeight;
        },
        isDark(newVal) {
            this.bandColor = "#E6EAF0";
            if (newVal) {
                this.bandColor = "#262626";
            }
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
        MainLineGraph,
    },
    computed: {
        ...mapGetters(["isDark"]),
        getHeight() {
            if (!this.heightVal) {
                if (this.viewportWidth < 479.98) return 246;
                else if (this.viewportWidth < 767.98) return 246;
                else if (this.viewportWidth < 991.98) return 246;
                else if (this.viewportWidth < 1320.98) return 246;
                else return 448;
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

<style lang="scss" scoped></style>

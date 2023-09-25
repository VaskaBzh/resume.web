<template>
    <div class="cabinet__block cabinet__block-graph cabinet__block-light">
        <div class="cabinet__head">
            <main-title tag="h3">
                {{ $t("statistic.chart.title") }}
            </main-title>
            <main-tabs
                @getValue="$emit('getValue', $event)"
                :tabs="buttons"
                :active="offset"
            />
        </div>
        <wait-preloader :wait="waitGraphChange" />
        <main-line-graph
            v-if="!waitGraphChange"
            :graphData="graph"
            :height="height"
        />
    </div>
</template>

<script>
import MainTitle from "../../common/Components/UI/MainTitle.vue";
import MainTabs from "../../common/Components/UI/MainTabs.vue";
import NoInfoWait from "../../../Components/technical/blocks/NoInfoWait.vue";
import { mapGetters } from "vuex";
import MainLineGraph from "../../graphs/Components/MainLineGraph.vue";
import WaitPreloader from "@/modules/preloader/Components/WaitPreloader.vue";

export default {
    name: "statistic-line-graph",
    props: {
        waitGraphChange: Boolean,
        offset: Number,
        graph: Object,
        buttons: Object,
    },
    components: {
        WaitPreloader,
        MainTitle,
        MainTabs,
        MainLineGraph,
    },
    computed: {
        ...mapGetters(["viewportWidth"]),
        height() {
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
    },
};
</script>

<style scoped></style>

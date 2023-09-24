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
        <main-preloader
            :wait="waitGraphChange"
            :end="!waitGraphChange"
            :empty="false"
        />
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
import MainPreloader from "@/modules/preloader/Components/MainPreloader.vue";

export default {
    name: "statistic-line-graph",
    props: {
        waitGraphChange: Boolean,
        offset: Number,
        graph: Object,
        buttons: Object,
    },
    components: {
        MainPreloader,
        MainTitle,
        MainTabs,
        NoInfoWait,
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

<template>
    <div class="card">
        <div class="card__content">
            <div class="card__head">
                <h3 class="card_title">{{ target_worker.name }}</h3>
                <span class="card_status">{{ target_worker.class }}</span>
            </div>
            <svg
                class="card_close"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M19 5L5 19M5 5L19 19"
                    stroke="#D0D5DD"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
            <!--            <main-tabs-->
            <!--                @getValue="$emit('getValue', $event)"-->
            <!--                :tabs="buttons"-->
            <!--                :active="offset"-->
            <!--            />-->
            <main-line-graph
                class="card_graph"
                :graphData="graph"
                :height="height"
            />
            <div class="card__block">
                <cabinet-card
                    :title="$t('statistic.info_blocks.hash.titles[0]')"
                    :value="hashPerDay"
                    unit="TH/s"
                    :page="'worker'"
                />
                <cabinet-card
                    :title="$t('statistic.info_blocks.hash.titles[1]')"
                    :value="hashPerMin"
                    unit="TH/s"
                    :page="'worker'"
                />
            </div>
        </div>
    </div>
</template>

<script>
import MainTabs from "@/modules/common/Components/UI/MainTabs.vue";
import MainLineGraph from "@/modules/graphs/Components/MainLineGraph.vue";
import CabinetCard from "@/modules/common/Components/UI/CabinetCard.vue";

export default {
    name: "worker-card",
    components: {
        MainTabs,
        MainLineGraph,
        CabinetCard,
    },
    props: {
        target_worker: Object,
        graph: Object,
    },
    data() {
        return {
            height: 190,
        };
    },
    computed: {
        hashPerDay() {
            return this.target_worker.hashrate.split(" ")[[1]];
        },
        hashPerMin() {
            return this.target_worker.hashrate_per_day.split(" ")[[1]];
        },
    },
};
</script>

<style scoped>
.card {
    border-radius: 24px;
    background: var(--main-gohan, #fff);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    padding: 24px;
}
.card__content {
    position: relative;
    display: flex;
    flex-direction: column;
    gap: 24px;
}
.card__head {
    display: flex;
    gap: 16px;
}
.card_title {
    color: var(--text-primary-80-day, rgba(29, 41, 57, 0.8));
    font-family: Unbounded, serif;
    font-size: 18px;
    font-weight: 400;
    line-height: 28px;
}
.card_status {
    border-radius: 8px;
    min-height: 32px;
    padding: 0 8px;
    text-align: center;
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
}
.card_status-active {
    color: var(--status-succesfull, #1fb96c);
    background: var(--background-success-day, #e9f8f1);
}
.card_status-in-active {
    color: var(--status-failed, #f1404a);
    background: var(--background-failed-day, #feeced);
}
</style>

<template>
    <div class="card">
        <div class="card__wrapper">
            <div class="card__content">
                <div class="card__head">
                    <h3 class="card_title">{{ target_worker.name }}</h3>
                    <span
                        class="card_status"
                        :class="{
                            'card_status-active':
                                target_worker.class === 'ACTIVE',
                            'card_status-in-active':
                                target_worker.class === 'INACTIVE',
                        }"
                        >{{ target_worker.class }}</span
                    >
                </div>
                <svg
                    class="card_close"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    @click="$emit('closeCard')"
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
                <div class="card_graph">
                    <main-line-graph :graphData="graph" :height="height" />
                </div>
                <div class="card__block">
                    <cabinet-card
                        class="card__elem"
                        :title="$t('statistic.info_blocks.hash.titles[0]')"
                        :value="hashPerDay"
                        unit="TH/s"
                        :page="'worker'"
                    />
                    <cabinet-card
                        class="card__elem"
                        :title="$t('statistic.info_blocks.hash.titles[1]')"
                        :value="hashPerMin"
                        unit="TH/s"
                        :page="'worker'"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MainTabs from "@/modules/common/Components/UI/MainTabs.vue";
import MainLineGraph from "@/modules/graphs/Components/MainLineGraph.vue";
import CabinetCard from "@/modules/common/Components/UI/CabinetCard.vue";
import { mapGetters } from "vuex";

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
    mounted() {
        const interval = setInterval(async () => {
            await this.height++;
            this.height--;
        }, 10);
        setTimeout(
            () => clearInterval(interval),
            this.viewportWidth < 500 ? 3501 : 501
        );
    },
    computed: {
        ...mapGetters(["viewportWidth"]),
        hashPerDay() {
            return this.target_worker.hashrate.split(" ")[0];
        },
        hashPerMin() {
            return this.target_worker.hashrate_per_day.split(" ")[0];
        },
    },
};
</script>

<style scoped>
@keyframes fade {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
.card {
    border-radius: 24px;
    background: var(--background-island, #fff);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    overflow: hidden;
    position: relative;
}
.card-watchers {
    min-height: 505px;
}
.card__wrapper {
    position: absolute;
    top: 0;
    left: 0;
    padding: 24px;
    width: 100%;
}
@media (max-width: 500px) {
    .card {
        border-radius: 0;
    }
    .card_close {
        display: none;
    }
    .card__wrapper {
        padding: 0;
    }
}
.card__content {
    position: relative;
    display: flex;
    flex-direction: column;
    gap: 24px;
}
.card_close {
    position: absolute;
    right: -8px;
    top: 0;
    height: 32px;
    width: 32px;
    cursor: pointer;
    padding: 8px;
}
.card__head {
    display: flex;
    gap: 16px;
}
.card_title {
    color: var(--text-primary, rgba(29, 41, 57, 0.8));
    font-family: Unbounded, serif;
    font-size: 18px;
    font-weight: 400;
    line-height: 28px;
}
.card_graph {
    height: 190px;
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
    display: inline-flex;
    align-items: center;
}
.card_status-active {
    color: var(--status-succesfull, #1fb96c);
    background: var(--background-success-day, #e9f8f1);
}
.card__block {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 8px;
    margin-top: 24px;
}
@media (max-width: 800px) {
    .card__block {
        display: flex;
        width: 100%;
        justify-content: space-between;
    }
}
.card__elem {
    width: 100%;
    border-radius: 24px;
    background: var(--background-island-inner-3, #f8fafd);
    box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.01);
}
.card_status-in-active {
    color: var(--status-failed, #f1404a);
    background: var(--background-failed-day, #feeced);
}
@media (max-width: 410px) {
    .card__block {
        display: flex;
        flex-direction: column;
        width: 100%;
        justify-content: space-between;
    }
    .card__elem {
        width: 100%;
    }
    .card__head {
        gap: 8px;
    }
}
</style>

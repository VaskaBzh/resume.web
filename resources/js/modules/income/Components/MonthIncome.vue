<template>
    <div class="month-income-card">
        <div class="income-card">
            <MainIncomeCardRow>
                <template v-slot:title>Доход за месяц</template>
                <template v-slot:num>{{ this.yesterdayProfit }}</template>
            </MainIncomeCardRow>
        </div>
        <div class="month__content">
            <!--            <wait-preloader-->
            <!--                class="month__block-no-padding"-->
            <!--                :wait="wait"-->
            <!--                :interval="35"-->
            <!--            />-->
            <main-bar-graph v-if="!wait" :height="height" :graphData="graph" />
        </div>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
import MainIncomeCardRow from "@/modules/income/Components/MainIncomeCardRow.vue";
import MainPreloader from "@/modules/preloader/Components/MainPreloader.vue";
import MainBarGraph from "@/modules/graphs/Components/MainBarGraph.vue";
import WaitPreloader from "@/modules/preloader/Components/WaitPreloader.vue";

export default {
    components: {
        MainIncomeCardRow,
        WaitPreloader,
        MainBarGraph,
    },
    props: {
        wait: Boolean,
        graph: Object,
    },
    data() {
        return {
            height: 135,
        };
    },
    computed: {
        ...mapGetters(["getAccount"]),
        yesterdayProfit() {
            let sum = 0;
            if (Object.values(this.getAccount).length > 0) {
                sum = this.getAccount.yesterday_amount;
            }
            return Number(sum).toFixed(8);
        },
    },
};
</script>
<style scoped>
.month__block-no-padding {
    padding: 0;
}
.month-income-card {
    display: flex;
    height: 300px;
    padding: 16px 24px 24px 24px;
    flex-direction: column;
    align-items: flex-start;
    gap: 32px;
    flex: 1 0 0;
    border-radius: 24px;
    background: var(--background-island, #fff);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
}
.income-card {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 16px;
    align-self: stretch;
    border-radius: 24px;
    background: var(--background-island, #fff);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
}
.flex-jc {
    display: flex;
    width: 100%;
    justify-content: space-between;
    align-items: baseline;
}
.icome-container {
    width: 100%;
}
.title {
    color: var(--gray-400, #98a2b3);
    font-family: Nunito Sans 10pt;
    font-size: 14px;
    font-weight: 600;
    line-height: 145%; /* 20.3px */
    margin-bottom: 4px;
}
.data-num {
    color: var(--text-primary-80, #1d2939);
    font-family: Unbounded;
    font-size: 27px;
    font-style: normal;
    font-weight: 400;
    line-height: 147%; /* 39.69px */
}
.btc-gray-text {
    color: var(--gray-300, #d0d5dd);
    font-family: Unbounded;
    font-size: 20px;
    font-style: normal;
    font-weight: 400;
    line-height: 160%; /* 32px */
    margin-left: 8px;
}
.rub-counter-text {
    color: var(--gray-300, #d0d5dd);
    font-family: Unbounded;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 145%; /* 20.3px */
}
.month__content {
    width: 100%;
}
@media(max-width:500px){
  .flex-jc{
    align-items: center;
  }
  .month-income-card{
    padding: 16px;
  }
  .title{
    margin-bottom: 0px;
  }
}
</style>

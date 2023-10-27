<template>
  <div class="income-card">
    <MainIncomeCardRow>
        <template v-slot:title>{{ $t("income.income_info.titles[2]") }}</template>
        <template v-slot:num>{{ this.yesterdayProfit }}</template>
      </MainIncomeCardRow>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import MainIncomeCardRow from "@/modules/income/Components/MainIncomeCardRow.vue"
export default {
  components: {
      MainIncomeCardRow
    },
  computed: {
      ...mapGetters([
          "getAccount",
      ]),
      yesterdayProfit() {
        let sum = 0;
        if (Object.values(this.getAccount).length > 0) {
          sum = this.getAccount.yesterday_amount;
        }
        return Number(sum).toFixed(8);
      },
  },
}
</script>
<style scoped>
.income-card{
  display: flex;
  padding: 16px 24px;
  flex-direction: column;
  align-items: flex-start;
  gap: 16px;
  align-self: stretch;
  border-radius: 24px;
  background: var(--background-island, #FFF);
  box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
}
.flex-jc{
  display: flex;
  width: 100%;
  justify-content: space-between;
  align-items: baseline;
}
@media(max-width:500px){
  .flex-jc{
    align-items: center;
  }
  .income-card{
    padding: 16px;
  }
}
.icome-container{
  width: 100%;
}
.title{
  color: var(--gray-400, #98A2B3);
  font-family: NunitoSans;
  font-size: 14px;
  font-weight: 600;
  line-height: 145%; /* 20.3px */
  margin-bottom: 4px;
}
.data-num{
  color: var(--text-primary, #1D2939);
  font-family: Unbounded;
  font-size: 27px;
  font-style: normal;
  font-weight: 400;
  line-height: 147%; /* 39.69px */
}
.btc-gray-text{
  color: var(--gray-300, #D0D5DD);
  font-family: Unbounded;
  font-size: 20px;
  font-style: normal;
  font-weight: 400;
  line-height: 160%; /* 32px */
  margin-left: 8px;
}
.rub-counter-text{
  color: var(--gray-300, #D0D5DD);
  font-family: Unbounded;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 145%; /* 20.3px */
}
</style>
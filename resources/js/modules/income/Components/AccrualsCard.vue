<template>
    <div class="accrual-card">
        <div class="accrual-all-time">
            <MainIncomeCardRow :bitcoinValue="total_incomes">
                <template v-slot:title>{{ $t("income.income_info.card[0]") }}</template>
            </MainIncomeCardRow>
        </div>
        <main-progress-bar
            :title="$t('income.income_info.card[1]')"
            hint="На вашем субаккаунте 0.00051380 BTC Автовыплата происходит при  балансе > 0.005 BTC"
            :progress="pendingAmount"
            :final="0.005"
            unit="BTC"
        />
    </div>

</template>
<script>
import { mapGetters } from "vuex";
import MainIncomeCardRow from "@/modules/income/Components/MainIncomeCardRow.vue"
import MainProgressBar from "../../common/Components/UI/MainProgressBar.vue";

export default {
    components: {
        MainIncomeCardRow,
        MainProgressBar,
    },
    computed: {
        ...mapGetters([
            "getAccount",
        ]),
        pendingAmount() {
            let sum = 0;
            if (Object.values(this.getAccount).length > 0) {
                sum = this.getAccount.pending_amount;
            }
            return Number(sum).toFixed(8);
        },
        total_incomes() {
            let sum = 0;
            if (Object.values(this.getAccount).length > 0) {
                sum = this.getAccount.total_incomes;
            }
            return Number(sum).toFixed(8);
        },
    },
}
</script>
<style scoped>
.accrual-card{
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
.accrual-all-time, .accrual-today{
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
  color: var(--text-primary-80, #1D2939);
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
.today-data-num{
  color: var(--secondary-black, #101828);
  font-family: Unbounded;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  opacity: 0.7;
  line-height: 145%; /* 20.3px */
}
.accrual-today{
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.progress-bar{
  width: 100%;
  height: 16px;
  flex-shrink: 0;
  border-radius: 16px;
  background: var(--primary-4007, rgba(83, 177, 253, 0.07));
}
.current-accrual{
  /* Динамически изменяется ширина */
  width: 50px;

  height: 16px;
  flex-shrink: 0;
  border-radius: 16px;
  opacity: 0.8;
  background: var(--primary-500, #2E90FA);
}
@media(max-width:500px){
  .flex-jc{
    align-items: center;
  }
  .accrual-card{
    padding: 16px;
  }
  .title{
    margin-bottom: 0px;
  }
}
</style>

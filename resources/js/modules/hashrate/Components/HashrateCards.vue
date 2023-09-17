<template>
    <InfoCard :currentPage="currentPage">
        <template v-slot:svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64" fill="none">
                <path d="M24.501 2V8" stroke="#53B1FD" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M39.5 2V8" stroke="#53B1FD" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M24.501 56V62" stroke="#53B1FD" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M39.5 56V62" stroke="#53B1FD" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M62 39.5L56 39.5" stroke="#53B1FD" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M8 24.5L2 24.5" stroke="#53B1FD" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M8 39.5L2 39.5" stroke="#53B1FD" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M62 24.5L56 24.5" stroke="#53B1FD" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M34.0826 21.5L27.8096 29.112C27.1373 29.9277 27.6192 31.1014 28.7154 31.3186L35.2866 32.6204C36.4553 32.852 36.9011 34.1513 36.0839 34.9446L28.3007 42.5" stroke="#53B1FD" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M8 32C8 20.6863 8 15.0294 11.5147 11.5147C15.0294 8 20.6863 8 32 8C43.3137 8 48.9706 8 52.4853 11.5147C56 15.0294 56 20.6863 56 32C56 43.3137 56 48.9706 52.4853 52.4853C48.9706 56 43.3137 56 32 56C20.6863 56 15.0294 56 11.5147 52.4853C8 48.9706 8 43.3137 8 32Z" stroke="#53B1FD" stroke-width="2.52" stroke-linejoin="round"/>
            </svg>
        </template>
        <template v-slot:title>
            {{ $t("statistic.info_blocks.hash.titles[0]") }}
        </template>
        <template v-slot:num>
            {{ Number(this.workers.hash).toFixed(2) }}
        </template>
        <template v-slot:unit>
            TH/s
        </template>
    </InfoCard>
    <InfoCard :currentPage="currentPage">
        <template v-slot:svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64" fill="none">
                <path d="M56 25.9995C55.8923 18.5608 55.3403 14.3435 52.5095 11.5142C48.9928 7.99951 43.3329 7.99951 32.013 7.99951C20.6932 7.99951 15.0333 7.99951 11.5166 11.5142C8 15.0289 8 20.6858 8 31.9995C8 43.3132 8 48.9701 11.5166 52.4848C14.7063 55.6728 19.6594 55.9691 29 55.9967" stroke="#98A2B3" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M24.5 2V8" stroke="#98A2B3" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M39.5 1.99976V7.99976" stroke="#98A2B3" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M24.5 56V62" stroke="#98A2B3" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M8 24.4998L2 24.4998" stroke="#98A2B3" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M8 39.4995L2 39.4995" stroke="#98A2B3" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M62 24.4998L56 24.4998" stroke="#98A2B3" stroke-width="2.52" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </template>
        <template v-slot:title>
            {{ $t("statistic.info_blocks.hash.titles[1]") }}
        </template>
        <template v-slot:num>
            {{ Number(this.workers.hash24).toFixed(2) }}
        </template>
        <template v-slot:unit>
            TH/s
        </template>
    </InfoCard>

</template>
<script>
import { mapGetters } from "vuex";
import InfoCard from "../../common/Components/InfoCard.vue";

export default {
    props: ["currentPage"],
    computed: {
        endHistory() {
            return !!this.hashrates;
        },
        endAccounts() {
            return !!this.getAccount;
        },
        clearProfitDay() {
            if (this.btcInfo) {
                if (this.getAccount) {
                    return Number(this.clearProfit) / 30;
                }
            }
            return 0;
        },
        clearBTCMounth() {
            if (this.btcInfo) {
                if (this.getAccount) {
                    return this.todayEarn * 30;
                }
            }
            return 0;
        },
        workers() {
            return {
                hash: this.getAccount.hash_per_min ?? 0,
                hash24: this.getAccount.hash_per_day ?? 0,
                active: this.getAccount.workers_count_active ?? 0,
                unStable: this.getAccount.workers_count_unstable ?? 0,
                inActive: this.getAccount.workers_count_in_active ?? 0,
                all: this.getAccount.workersAll ?? 0,
            };
        },
        todayEarn() {
            let val = this.getAccount?.today_forecast || 0;
            return Number(val).toFixed(8);
        },
        yesterdayEarn() {
            let val = this.getAccount?.yesterday_amount || 0;
            return Number(val).toFixed(8);
        },
        ...mapGetters([
            "getAccount",
            "btcInfo",
        ]),
    },
    components: { InfoCard }
};
</script>
<style scoped>
.statistic-card{
    border-radius: 24px;
    background: var(--light-secondary-wb, #FFF);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.05);
    padding: 16px 24px;
    min-width: 349px;
}
@media (max-width: 1860px) {
    .statistic-card{
         min-width: 120px;
    }
    .hashrate-card{
        min-width: 349px;
    }
}
.max-width{
    min-width: 49%;
}
.statistic-card-title{
    color: var(--light-gray-400, #98A2B3);
    font-family: NunitoSans;
    font-size: 14px;
    font-style: normal;
    font-weight: 600;
    line-height: 145%; /* 20.3px */
}
.color-main{
    color: var(--light-gray-800, #1D2939);
}
.flex-row{
    display: flex;
    gap: 24px;
    align-items: center;
}
.color-gray{
    color: var(--light-gray-300, var(--gray-3100, #D0D5DD));
    font-family: Unbounded;
    font-size: 27px;
    font-style: normal;
    font-weight: 400;
    line-height: 147%; /* 39.69px */
}
.statistic-card-num{
    font-family: Unbounded;
    font-size: 41px;
    font-style: normal;
    font-weight: 400;
    line-height: 137%; /* 56.17px */
}
</style>
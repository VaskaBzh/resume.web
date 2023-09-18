<template>
    <cabinet-card
        :title="$t('statistic.info_blocks.hash.titles[0]')"
        :value="hashPerMin"
        unit="TH/s"
    >
        <template v-slot:svg>
            <hashrate-icon />
        </template>
    </cabinet-card>
    <cabinet-card
        :title="$t('statistic.info_blocks.hash.titles[1]')"
        :value="hashPerDay"
        unit="TH/s"
    >
        <template v-slot:svg>
            <hashrate-icon24 />
        </template>
    </cabinet-card>
</template>
<script>
import { mapGetters } from "vuex";
import CabinetCard from "@/modules/common/Components/UI/CabinetCard.vue";
import HashrateIcon from "@/modules/common/icons/HashrateIcon.vue";
import HashrateIcon24 from "@/modules/common/icons/HashrateIcon24.vue";

export default {
    computed: {
        ...mapGetters([
            "getAccount",
        ]),
        hashPerDay() {
            return this.getAccount.hash_per_day ? Number(this.getAccount.hash_per_day).toFixed(2) : "0.00";
        },
        hashPerMin() {
            return this.getAccount.hash_per_min ? Number(this.getAccount.hash_per_min).toFixed(2) : "0.00";
        },
    },
    components: {
        CabinetCard,
        HashrateIcon,
        HashrateIcon24
    }
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

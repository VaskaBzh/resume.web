<template>
    <div class="cards">
        <cabinet-card
            :title="$t('statistic.info_blocks.hash.titles[0]')"
            :value="hashPerMin"
            unit="TH/s"
            :page="'worker'"
        >
            <template v-slot:svg>
                <minute-hashrate-icon />
            </template>
        </cabinet-card>
        <cabinet-card
            :title="$t('statistic.info_blocks.hash.titles[1]')"
            :value="hashPerDay"
            unit="TH/s"
            :page="'worker'"
        >
            <template v-slot:svg>
                <day-hashrate-icon />
            </template>
        </cabinet-card>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
import CabinetCard from "@/modules/common/Components/UI/CabinetCard.vue";
import DayHashrateIcon from "@/modules/common/icons/DayHashrateIcon.vue";
import MinuteHashrateIcon from "@/modules/common/icons/MinuteHashrateIcon.vue";

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
        MinuteHashrateIcon,
        DayHashrateIcon
    }
};
</script>
<style scoped>
.cards {
    display: flex;
    gap: 12px;
    align-items: center;
    width: 100%;
}
</style>

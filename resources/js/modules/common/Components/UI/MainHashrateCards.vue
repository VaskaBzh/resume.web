<template>
    <div class="cards">
        <cabinet-card
            :title="$t('statistic.info_blocks.hash.titles[0]')"
            :value="getAccount.hash_per_min ?? 0"
            :unit="`${getAccount.hash_per_min_unit ?? 'T'}H/s`"
            :page="'worker'"
        >
            <template #svg>
                <minute-hashrate-icon />
            </template>
        </cabinet-card>
        <cabinet-card
            :title="$t('statistic.info_blocks.hash.titles[1]')"
            :value="getAccount.hash_per_day ?? 0"
            :unit="`${getAccount.hash_per_day_unit ?? 'T'}H/s`"
            :page="'worker'"
        >
            <template #svg>
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
    components: {
        CabinetCard,
        MinuteHashrateIcon,
        DayHashrateIcon,
    },
    computed: {
        ...mapGetters(["getAccount"]),
    },
};
</script>
<style scoped>
.cards {
    display: flex;
    gap: 12px;
    align-items: center;
    width: 100%;
}
@media (max-width: 767.98px) {
    .cards {
        flex-direction: column;
    }
}
</style>

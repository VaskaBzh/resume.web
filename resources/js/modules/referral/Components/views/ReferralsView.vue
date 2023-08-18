<template>
    <div class="referral__content">
        <div class="referral__head">
            <main-search placeholder="Поиск реферала" />
            <percent-card
                :percent="service.percent"
                :percentSvg="service.percentSvg"
                :percentList="service.gradeList"
                class="referral_card"
            />
        </div>
        <!--        <main-slider-->
        <!--            :wait="service.waitTable"-->
        <!--            :empty="service.rows"-->
        <!--            :table="service.table"-->
        <!--            :rowsNum="per_page"-->
        <!--            :errors="errors"-->
        <!--            :meta="service.meta"-->
        <!--            :key="getActive"-->
        <!--            @changePerPage="changePerPage"-->
        <!--            @changePage="page = $event"-->
        <!--        />-->
    </div>
</template>

<script>
import MainSearch from "@/Components/UI/inputs/MainSearch.vue";
import PercentCard from "@/modules/referral/Components/UI/PercentCard.vue";
// import MainSlider from "@/Components/technical/MainSlider.vue";

import { ReferralsService } from "@/modules/referral/services/ReferralsService";

export default {
    name: "referrals-view",
    props: {
        errors: Object,
    },
    components: {
        MainSearch,
        // MainSlider,
        PercentCard,
    },
    data() {
        return {
            service: new ReferralsService(this.$t, [0, 1, 2, 3, 4]),
        };
    },
    mounted() {
        this.service.getGradeList();
        this.service.getPercent();
    },
};
</script>

<style scoped lang="scss">
.referral {
    &__head {
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        @media (max-width: $mobile) {
            flex-direction: column;
            gap: 24px;
        }
    }
    &_card {
        max-width: fit-content;
        @media (max-width: $mobile) {
            max-width: 100%;
        }
    }
}
</style>

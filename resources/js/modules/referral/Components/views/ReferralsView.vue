<template>
    <div class="referral__content">
        <div class="referral__head">
<!--            <main-search class="referral_search" :placeholder="$t('search.placeholder')" />-->
            <percent-card
                :percent="service.percent"
                :percentSvg="service.percentSvg"
                :percentList="service.gradeList"
                class="referral__card referral__card-percent"
            />
        </div>
        <wrap-table
            :table="service.table"
            :wait="!service.rows?.length > 0"
            :empty="service.table?.get('rows')"
            :errors="errors"
            :rowsVal="1000"
        />
    </div>
</template>

<script>
import MainSearch from "@/Components/UI/inputs/MainSearch.vue";
import PercentCard from "@/modules/referral/Components/UI/PercentCard.vue";
import WrapTable from "@/Components/tables/WrapTable.vue";

import { ReferralsService } from "@/modules/referral/services/ReferralsService";
import { ReferralsMessage } from "@/modules/referral/lang/ReferralsMessage";

export default {
    name: "referrals-view",
    i18n: {
        sharedMessages: ReferralsMessage,
    },
    props: {
        errors: Object,
        user: Object,
    },
    components: {
        MainSearch,
        PercentCard,
        WrapTable,
    },
    data() {
        return {
            service: new ReferralsService(
                this.user.id,
                this.$t,
                [0, 1, 2, 3, 4]
            ),
        };
    },
    mounted() {
        this.service.getGradeList();
        this.service.getPercent();

        this.service.setTable();
    },
};
</script>

<style scoped lang="scss">
.referral {
    &__head {
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        //justify-content: space-between;
        justify-content: flex-end;
        @media (max-width: $mobile) {
            flex-direction: column;
            gap: 24px;
        }
    }
    &__card {
        max-width: fit-content;
        @media (max-width: $mobile) {
            max-width: 100%;
        }
    }
}
</style>

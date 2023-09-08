<template>
    <referrals-layout-view>
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
                :wait="service.waitTable"
                :empty="service.rows"
                :errors="errors"
                :rowsVal="1000"
            />
        </div>
    </referrals-layout-view>
</template>

<script>
import MainSearch from "@/Components/UI/inputs/MainSearch.vue";
import PercentCard from "@/modules/referral/Components/UI/PercentCard.vue";
import WrapTable from "@/Components/tables/WrapTable.vue";

import { ReferralsService } from "@/modules/referral/services/ReferralsService";
import { ReferralsMessage } from "@/modules/referral/lang/ReferralsMessage";
import ReferralsLayoutView from "@/layouts/ReferralsLayoutView.vue";
import { mapGetters } from "vuex";

export default {
    name: "referrals-view",
    i18n: {
        sharedMessages: ReferralsMessage,
    },
    computed: {
        ...mapGetters(["user"]),
    },
    components: {
        MainSearch,
        PercentCard,
        WrapTable,
        ReferralsLayoutView,
    },
    data() {
        return {
            service: new ReferralsService(this.$t, [0, 1, 2, 3, 4]),
        };
    },
    watch: {
        user(newUser) {
            this.service.setUser(newUser);
        },
    },
    async mounted() {
        this.service.getGradeList();
        this.service.getPercent();

        await this.service.setTable();
    },
};
</script>

<style scoped lang="scss">
.referral {
    &__head {
        display: flex;
        align-items: center;
        //justify-content: space-between;
        justify-content: flex-end;
        @media (max-width: $mobile) {
            margin-bottom: 24px;
            flex-direction: column;
            gap: 24px;
        }
    }
    &__card {
        max-width: fit-content;
        margin-top: -9.5%;
        @media (max-width: $pc) {
            margin-top: -14%;
        }
        @media (max-width: $tablet) {
            margin-top: -13%;
        }
        @media (max-width: $mobile) {
            margin-top: 0;
            max-width: 100%;
        }
    }
}
</style>

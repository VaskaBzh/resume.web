<template>
    <div class="referral__content">
        <!--        <div class="referral__head">-->
        <!--            &lt;!&ndash;            <main-search class="referral_search" :placeholder="$t('search.placeholder')" />&ndash;&gt;-->
        <!--            <percent-card-->
        <!--                :percent="service.percent"-->
        <!--                :percentSvg="service.percentSvg"-->
        <!--                :percentList="service.gradeList"-->
        <!--                class="referral__card referral__card-percent"-->
        <!--            />-->
        <!--        </div>-->
        <main-slider
            class="referral__slider"
            :wait="service.waitTable"
            :empty="service.emptyTable"
            rowsNum="1000"
            :haveNav="false"
        >
            <main-table :table="service.table"></main-table>
        </main-slider>
    </div>
</template>

<script>
import MainSearch from "@/modules/common/Components/inputs/MainSearch.vue";
import PercentCard from "@/modules/referral/Components/UI/PercentCard.vue";

import { ReferralsService } from "@/modules/referral/services/ReferralsService";
import { ReferralsMessage } from "@/modules/referral/lang/ReferralsMessage";
import ReferralsLayoutView from "@/layouts/ReferralsLayoutView.vue";
import { mapGetters } from "vuex";
import MainTable from "@/Components/tables/MainTable.vue";
import MainSlider from "@/modules/slider/Components/MainSlider.vue";

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
        ReferralsLayoutView,
        MainSlider,
        MainTable,
    },
    data() {
        return {
            service: new ReferralsService(this.$t, [0, 1, 2, 3, 4]),
        };
    },
    watch: {
        user: {
            async handler(newUser) {
                this.service.setUser(newUser);

                await this.service.setTable();
            },
            deep: true,
        },
        "$i18n.locale"() {
            this.service.getGradeList();
        },
    },
    async mounted() {
        if (this.user?.id) {
            this.service.setUser(this.user);

            await this.service.setTable();
        }
        this.service.getGradeList();
        this.service.getPercent();
    },
};
</script>

<style scoped lang="scss">
.referral {
    &__slider {
        flex: 1 1 auto;
    }
    &__content {
        flex: 1 1 auto;
        display: flex;
        flex-direction: column;
    }
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

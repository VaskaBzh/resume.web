<template>
    <div class="referral__content">
        <!--        <div class="referral__head">-->
        <!--            <main-search class="referral_search" :placeholder="$t('search.placeholder')" />-->
        <!--            <referral-select class="referral_select referral_select-cabinet" />-->
        <!--        </div>-->
        <!--            <main-slider-->
        <!--                :wait="service.waitTable"-->
        <!--                :empty="service.rows"-->
        <!--                :table="service.table"-->
        <!--                :rowsNum="per_page"-->
        <!--                :errors="errors"-->
        <!--                :meta="service.meta"-->
        <!--                @changePerPage="changePerPage"-->
        <!--                @changePage="page = $event"-->
        <!--            />-->
        <wrap-table
            :table="service.table"
            :wait="service.waitTable"
            :empty="service.rows"
            :errors="errors"
            :rowsVal="1000"
        />
    </div>
</template>

<script>
import ReferralSelect from "@/modules/referral/Components/UI/ReferralSelect.vue";
import MainSearch from "@/Components/UI/inputs/MainSearch.vue";
import MainSlider from "@/Components/technical/MainSlider.vue";

import { PaymentService } from "@/modules/referral/services/PaymentService";
import { ReferralsMessage } from "@/modules/referral/lang/ReferralsMessage";
import ReferralsLayoutView from "@/layouts/ReferralsLayoutView.vue";
import WrapTable from "@/Components/tables/WrapTable.vue";
import { mapGetters } from "vuex";
import PercentCard from "@/modules/referral/Components/UI/PercentCard.vue";
import { ReferralsService } from "@/modules/referral/services/ReferralsService";

export default {
    name: "payment-view",
    i18n: {
        sharedMessages: ReferralsMessage,
    },
    computed: {
        ...mapGetters(["user"]),
    },
    components: {
        ReferralSelect,
        MainSearch,
        MainSlider,
        WrapTable,
        ReferralsLayoutView,
    },
    data() {
        return {
            service: new PaymentService(this.$t, [0, 1, 2, 3, 4]),
            per_page: 10,
            page: 1,
        };
    },
    watch: {
        user(newUser) {
            this.service.setUser(newUser);
        },
        page() {
            this.initIncomes();
        },
        filter() {
            this.initIncomes();
        },
        per_page() {
            this.initIncomes();
        },
    },
    methods: {
        initIncomes() {
            this.service.setTable(this.page, this.per_page);
        },
        changePerPage($event) {
            this.per_page = $event;
            this.page = 1;
        },
    },
    mounted() {
        this.initIncomes();
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
    &_select {
        max-width: 340px;
        @media (max-width: $mobile) {
            max-width: 100%;
        }
    }
}
</style>

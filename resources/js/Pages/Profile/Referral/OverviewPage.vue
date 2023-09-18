<template>
    <div class="referral_content">
        <div class="grid-column">
            <div class="card__block">
                <InfoCard>
                <template v-slot:svg>
                    <img src="../../../../assets/img/percent-icon.png">
                </template>
                <template v-slot:title>
                    {{ $t("stats.cards[0]") }}
                </template>
                <template v-slot:num>
                    {{ percent }}
                </template>
            </InfoCard>
            <InfoCard>
                <template v-slot:svg>
                    <img src="../../../../assets/img/hashrate-icon.png">
                </template>
                <template v-slot:title>
                    {{ $t("stats.cards[1]") }}
                </template>
                <template v-slot:num>
                    {{ percent }}
                </template>
                <template v-slot:unit>
                    PH/s
                </template>
            </InfoCard>
            </div>
                <InfoCard :currentPage="'worker'">
                <template v-slot:svg>
                    <img src="../../../../assets/img/income-icon.png">
                </template>
                <template v-slot:title>
                    {{ $t("stats.cards[4]") }}
                </template>
                <template v-slot:num>
                    {{ percent }}
                </template>
                <template v-slot:unit>
                    BTC
                </template>
            </InfoCard>
            <div class="cabinet__block cabinet__block-light referral__block">
                <main-title tag="h4" class="title referral_title">
                    {{ $t("referral.title") }}
                </main-title>
                <p class="text text-gray referral_text referral_text-mb">
                    {{ $t("referral.text") }}
                </p>
                <div class="referral__row">
                    <main-copy class="referral_code" :code="service.code" />
                </div>
            </div>
            <div class="cabinet__block cabinet__block-light referral__block">
                <main-title tag="h4" class="title referral_title">
                    {{ $t("incomes.title") }}
                </main-title>
                <p class="text text-gray referral_text">
                    {{ $t("incomes.text") }}
                </p>
                <referral-select
                    class="referral_select-cabinet"
                    :rows="service.accounts"
                    :activeSubId="service.activeSubId"
                    @changeSub="service.generateCode($event)"
                />
            </div>

        </div>
        <div class="grid-column">
            <div class="card__block">
                <InfoCard>
                    <template v-slot:svg>
                        <img src="../../../../assets/img/invite-icon.png">
                    </template>
                    <template v-slot:title>
                        {{ $t("stats.cards[2]") }}
                    </template>
                    <template v-slot:num>
                        {{ percent }}
                    </template>
                </InfoCard>
                <InfoCard>
                    <template v-slot:svg>
                        <img src="../../../../assets/img/active-icon.png">
                    </template>
                    <template v-slot:title>
                        {{ $t("stats.cards[3]") }}
                    </template>
                    <template v-slot:num>
                        {{ percent }}
                    </template>
                </InfoCard>
            </div>
        <div
            class="cabinet__block cabinet__block-light referral__block referral__block-full"
        >
            <main-title tag="h4" class="title referral_title">
                {{ $t("grade.title") }}
            </main-title>
            <p class="text text-gray referral_text">
                {{ $t("grade.text") }}
            </p>
            <info-list :gradeList="service.gradeList" />
        </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainCopy from "@/modules/common/Components/UI/MainCopy.vue";
import PercentCard from "@/modules/referral/Components/UI/PercentCard.vue";
import StatsCard from "@/modules/referral/Components/UI/StatsCard.vue";
import ReferralSelect from "@/modules/referral/Components/UI/ReferralSelect.vue";
import InfoList from "@/modules/referral/Components/blocks/InfoList.vue";

import { CabinetService } from "@/modules/referral/services/CabinetService";
import { mapGetters } from "vuex";
import { ReferralsMessage } from "@/modules/referral/lang/ReferralsMessage";
import ReferralsLayoutView from "@/layouts/ReferralsLayoutView.vue";
import InfoCard from "../../../modules/common/Components/UI/CabinetCard.vue";
export default {
    name: "cabinet-view",
    components: {
        MainTitle,
        MainCopy,
        PercentCard,
        StatsCard,
        ReferralSelect,
        InfoList,
        ReferralsLayoutView,
        InfoCard
    },
    i18n: {
        sharedMessages: ReferralsMessage,
    },
    props: {
        message: String,
    },
    computed: {
        ...mapGetters(["allAccounts", "user"]),
    },
    data() {
        return {
            percent: 0.8,
            service: new CabinetService(this.$t, this.$route),
        };
    },
    watch: {
        user(newUser) {
            this.service.setUser(newUser);
        },
        async allAccounts(newValue) {
            if (newValue) {
                await this.service.getSelectAccounts();
            }
        },
        user(newUserProp) {
            this.service.setUser(newUserProp);
            this.service.setCode();
        },
    },
    async mounted() {
        this.service.setUser(this.user);
        this.service.getGradeList();

        this.service.getStatsCards({});
        this.service.setCode();
        await this.service.index();
        if (this.allAccounts) this.service.getSelectAccounts();
    },
};
</script>

<style scoped lang="scss">
.card__block{
    display: flex;
    width: 100%;
    justify-content: space-between;
    gap: 16px;
}
.grid-column{
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.referral {
    &_content {

        display: grid;
        grid-template-columns: repeat(2, 49%);
        // grid-template-rows: repeat(2, auto);
        gap: 16px;
        // @media (max-width: $pc) {
        //     grid-template-columns: repeat(3, 1fr);
        //     grid-template-rows: repeat(4, auto);
        // }
        // @media (max-width: $mobile) {
        //     display: flex;
        //     flex-direction: column;
        //     gap: 8px;
        // }
    }
    &__block {
        &:first-child {
            @media (max-width: $pc) {
                grid-column: 1/4;
            }
        }
        &:nth-child(2) {
            @media (max-width: $pc) {
                grid-row: 2/4;
            }
        }
        &:nth-child(3) {
            @media (max-width: $pc) {
                grid-row: 4/5;
                grid-column: 1/4;
            }
        }
        &-full {
            grid-row: 1/3;
            grid-column: 2/3;
            @media (max-width: $pc) {
                grid-row: 2/4;
                grid-column: 2/4;
            }
        }
    }
    &_title {
        margin-bottom: 12px;
        @media (max-width: $pc) {
            margin-bottom: 24px;
        }
    }
    &_text {
        margin-bottom: 24px;
        font-size: 14px;
        &-mb {
            margin-bottom: 32px;
        }
    }
    &_code {
        @media (max-width: $pc) {
            max-width: 394px;
        }
        @media (max-width: $tablet) {
            min-width: 394px;
        }
        @media (max-width: $mobile) {
            max-width: 100%;
            min-width: 0;
        }
    }
    &__row {
        display: flex;
        align-items: center;
        gap: 16px;
        width: 100%;
        @media (max-width: $mobileSmall) {
            flex-direction: column;
        }
        &-bet {
            justify-content: space-around;
            flex-wrap: wrap;
            @media (max-width: $pc) {
                flex-direction: column;
                gap: 16px;
            }
        }
    }
}
</style>

<template>
    <div class="referral__content">
        <div class="grid-column">
            <div class="card__block">
                <InfoCard
                    class="referral__card-info"
                    :title="$t('stats.cards[0]')"
                    :value="percent"
                >
                    <template #svg>
                        <img src="../../../../assets/img/percent-icon.png" />
                    </template>
                </InfoCard>
<!--                <InfoCard-->
<!--                    class="referral__card-info"-->
<!--                    :title="$t('stats.cards[1]')"-->
<!--                    :value="percent"-->
<!--                >-->
<!--                    <template #svg>-->
<!--                        <img src="../../../../assets/img/hashrate-icon.png" />-->
<!--                    </template>-->
<!--                </InfoCard>-->
            </div>
            <InfoCard
                class="referral__card-info referal__general-profit"
                :current-page="'worker'"
                :title="$t('stats.cards[4]')"
                :value="service.statsCards[1]?.value ?? 0"
                unit="BTC"
            >
                <template #svg>
                    <img src="../../../../assets/img/income-icon.png" />
                </template>
            </InfoCard>
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
                    :active-sub-id="service.activeSubId"
                    @changeSub="service.generateCode($event)"
                />
            </div>
            <div class="cabinet__block cabinet__block-light referral__block">
                <main-title tag="h4" class="title referral_title">
                    {{ $t("referral.title") }}
                </main-title>
                <p class="text text-gray referral_text referral_text-mb">
                    {{ $t("referral.text") }}
                </p>
                <div class="referral__row">
                    <main-copy
                        class="referral_code"
                        :cut-value="50"
                        :code="service.code"
                    />
                </div>
            </div>

        </div>
        <div class="grid-column">
            <div class="card__block">
                <InfoCard
                    class="referral__card-info"
                    :title="$t('stats.cards[2]')"
                    :value="service.statsCards[0]?.value ?? 0"
                >
                    <template #svg>
                        <img src="../../../../assets/img/invite-icon.png" />
                    </template>
                </InfoCard>
                <InfoCard
                    class="referral__card-info"
                    :title="$t('stats.cards[3]')"
                    :value="service.statsCards[2]?.value ?? 0"
                >
                    <template #svg>
                        <img src="../../../../assets/img/active-icon.png" />
                    </template>
                </InfoCard>
            </div>
            <div
                class="cabinet__block cabinet__block-grid cabinet__block-light referral__block referral__block-full"
            >
                <main-title tag="h4" class="title referral_title">
                    {{ $t("grade.title") }}
                </main-title>
                <p class="text text-gray referral_text">
                    {{ $t("grade.text") }}
                </p>
                <info-list :grade-list="service.gradeList" />
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
    name: "CabinetView",
    components: {
        MainTitle,
        MainCopy,
        PercentCard,
        StatsCard,
        ReferralSelect,
        InfoList,
        ReferralsLayoutView,
        InfoCard,
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
        user: {
            async handler(newUser) {
                this.service.setUser(newUser);
                await this.service.index();
                this.service.setCode();
            },
            deep: true,
        },
        async allAccounts(newValue) {
            if (newValue) {
                await this.service.getSelectAccounts(newValue);
            }
        },
        "$i18n.locale"() {
            this.service.getGradeList();
        },
    },
     mounted() {
        if (this.user.id) {
            this.service.setUser(this.user);

            this.service.index();
        }
        this.service.getGradeList();

        this.service.getStatsCards({});
        if (this.allAccounts) this.service.getSelectAccounts(this.allAccounts);
    },
};
</script>

<style scoped lang="scss">
.card__block {
    display: flex;
    width: 100%;
    justify-content: space-between;
    gap: 16px;
    max-height: 108px;
}
.grid-column {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;

    .cabinet__block-grid {
        grid-column: 1/3;
        border-radius: 24px;
    }

    .referal__general-profit {
        grid-row: 2;
        grid-column: 1/3;
    }
}
.referral {
    &__content {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        @media (max-width: 768px) {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        @media screen and (max-width: 1320px) {
            display: grid;
            grid-template-rows: repeat(2, 1fr);
            grid-template-columns: unset;
        }
    }

    &__card {
        &-info {
            width: 100%;
        }
    }

    .card__block {
        grid-column: 1/3;
    }

    &__block {
        grid-column: 1/3;
        border-radius: 24px;
        &:first-child {
            @media (max-width: $pc) {
                grid-column: 1/3;
            }
        }
        &:nth-child(2) {
            @media (max-width: $pc) {
            }
        }
        &:nth-child(3) {
            @media (max-width: $pc) {
                grid-row: 4/5;
                grid-column: 1/3;
            }
        }
        &-full {
            grid-row: 2/20;
            @media (max-width: $pc) {
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

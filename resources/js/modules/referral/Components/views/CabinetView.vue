<template>
    <div class="referral_content">
        <div class="cabinet__block cabinet__block-light referral__block">
            <main-title tag="h4" class="title referral_title">
                Реферальный код
            </main-title>
            <p class="text text-gray referral_text referral_text-mb">
                Данный промокод необходимо указать рефералу при регистрации или
                в настройках аккаунта. Ваши активные рефералы будут появляться
                во вкладке “Мои рефералы”.
            </p>
            <div class="referral__row">
                <main-copy class="referral_code" :code="service.code" />
                <percent-card :percent="percent" />
            </div>
        </div>
        <div class="cabinet__block cabinet__block-light referral__block">
            <main-title tag="h4" class="title referral_title">
                Общая статистика
            </main-title>
            <div class="referral__row referral__row-bet">
                <stats-card
                    v-for="(card, i) in service.statsCards"
                    :content="card"
                    :key="i"
                />
            </div>
        </div>
        <div class="cabinet__block cabinet__block-light referral__block">
            <main-title tag="h4" class="title referral_title">
                Начисления за рефералов
            </main-title>
            <p class="text text-gray referral_text">
                Укажите субаккаут на который будут начисляться вознаграждения за
                рефералов.
            </p>
            <referral-select
                :rows="service.accounts"
                :activeSubId="service.activeSubId"
                @changeSub="service.generateCode($event)"
            />
        </div>
        <div
            class="cabinet__block cabinet__block-light referral__block referral__block-full"
        >
            <main-title tag="h4" class="title referral_title">
                Грейд-лист
            </main-title>
            <p class="text text-gray referral_text">
                Получаемый вами процент равен сумме хешрейта всех ваших
                рефералов.
            </p>
            <info-list :gradeList="service.gradeList" />
        </div>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import MainCopy from "@/Components/UI/MainCopy.vue";
import PercentCard from "@/modules/referral/Components/UI/PercentCard.vue";
import StatsCard from "@/modules/referral/Components/UI/StatsCard.vue";
import ReferralSelect from "@/modules/referral/Components/UI/ReferralSelect.vue";
import InfoList from "@/modules/referral/Components/blocks/InfoList.vue";

import { CabinetService } from "@/modules/referral/services/CabinetService";
import { mapGetters } from "vuex";

export default {
    name: "cabinet-view",
    components: {
        MainTitle,
        MainCopy,
        PercentCard,
        StatsCard,
        ReferralSelect,
        InfoList,
    },
    props: {
        user: Object,
        errors: Object,
        message: String,
    },
    computed: {
        ...mapGetters(["allAccounts"]),
    },
    data() {
        return {
            percent: 0.8,
            service: new CabinetService(this.user.id),
        };
    },
    watch: {
        allAccounts(newValue) {
            if (newValue) {
                this.service.getSelectAccounts();
            }
        },
    },
    mounted() {
        this.service.getGradeList();
        this.service.index();
        if (this.allAccounts) this.service.getSelectAccounts();
    },
};
</script>

<style scoped lang="scss">
.referral {
    &_content {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(3, 1fr);
        gap: 16px;
        @media (max-width: $pc) {
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(4, 1fr);
        }
        @media (max-width: $mobile) {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
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
        max-width: 190px;
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
            justify-content: space-between;
            @media (max-width: $pc) {
                flex-direction: column;
                gap: 16px;
            }
        }
    }
}
</style>

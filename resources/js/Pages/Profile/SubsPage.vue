<template>
    <div class="subs">
        <div class="subs__wrapper">
            <main-title class="subs_title">{{ $t("title") }} </main-title>

            <div v-if="!!overall.total_hash_per_day" class="subs__cards">
                <cabinet-card
                    class="subs__card-first"
                    :title="$t('info_blocks.hash.titles[0]')"
                    :value="overallCurrentHashRate.hashRate"
                    :unit="`${overallCurrentHashRate.unit}H/s`"
                    hint_position="right"
                    :hint="$t('info_blocks.hash.hints[0]')"
                >
                    <template #svg>
                        <minute-hashrate-icon />
                    </template>
                </cabinet-card>
                <cabinet-card
                    class="subs__card-second"
                    :title="$t('info_blocks.hash.titles[1]')"
                    :value="overall.total_hash_per_day"
                    :unit="`${overall.per_day_unit}H/s`"
                    hint_position="right"
                    :hint="$t('info_blocks.hash.hints[1]')"
                >
                    <template #svg>
                        <day-hashrate-icon />
                    </template>
                </cabinet-card>
                <cabinet-card
                    class="card-active subs__card-third"
                    :title="$t('info_blocks.workers.types[0]')"
                    :value="overall.total_active_workers"
                    :hint="$t('info_blocks.workers.hints.active')"
                />
                <cabinet-card
                    class="card-in-active subs__card-fourth"
                    :title="$t('info_blocks.workers.types[2]')"
                    :value="overall.total_inactive_workers"
                    :hint="$t('info_blocks.workers.hints.inactive')"
                />
            </div>
            <div
                v-if="!service.waitSubs && !service.emptySubs"
                class="subs__wrapper_two"
            >
                <sub-header
                    class="subs__header"
                    :subs-type="service.subsType"
                    @changeType="toggleIsTable($event)"
                    @searched="service.searchSub($event)"
                />
                <sub-list
                    :subs-type="service.subsType"
                    :table="service.subsTable"
                    :empty="service.emptyTableSubs"
                />
            </div>
            <main-preloader
                class="cabinet__preloader"
                :wait="service.waitSubs"
                :interval="50"
                :end="!service.waitSubs"
                :empty="service.emptySubs"
            />
        </div>
    </div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainPreloader from "@/modules/preloader/Components/MainPreloader.vue";
import SubHeader from "@/modules/subs/Components/SubHeader.vue";
import SubList from "@/modules/subs/Components/SubList.vue";
import CabinetCard from "@/modules/common/Components/UI/CabinetCard.vue";
import DayHashrateIcon from "@/modules/common/icons/DayHashrateIcon.vue";
import MinuteHashrateIcon from "@/modules/common/icons/MinuteHashrateIcon.vue";

import { UnitMultiplierEnum } from "@/modules/subs/enums/UnitMultiplierEnum";
import { mapGetters } from "vuex";
import { SubMessages } from "@/modules/subs/lang/SubMessages";
import { SubService } from "@/modules/subs/services/SubService";

export default {
    components: {
        SubList,
        SubHeader,
        MainTitle,
        MainPreloader,
        CabinetCard,
        DayHashrateIcon,
        MinuteHashrateIcon,
    },
    i18n: {
        sharedMessages: SubMessages,
    },
    data() {
        return {
            service: new SubService(),
        };
    },
    watch: {
        allAccounts(newAccountsList) {
            this.service
                .setSubList(newAccountsList)
                .statesProcess()
                .tableProcess()
                .tableStatesProcess();
        },
        "$i18n.locale"() {
            this.service.setDocumentTitle(this.$t("title"));

            this.service
                .setSubList(this.allAccounts)
                .statesProcess()
                .tableProcess()
                .tableStatesProcess();
        },
    },
    computed: {
        ...mapGetters([
            "allAccounts",
            "allHistoryForDays",
            "btcInfo",
            "getActive",
            "getAccount",
            "overall",
        ]),
        overallCurrentHashRate() {
            const currentHashRate = this.getSumAccountsStatistic(
                "hash_per_min",
                "hash_per_min_unit"
            );

            return {
                hashRate: currentHashRate,
                unit: "T",
            };
        },
    },
    mounted() {
        this.service.setDocumentTitle(this.$t("title"));

        this.service
            .setSubList(this.allAccounts)
            .statesProcess()
            .tableStatesProcess()
            .tableProcess();
    },
    methods: {
        toggleIsTable(subsTypeState = null) {
            this.service.toggleSubsType(subsTypeState);
        },
        getSumAccountsStatistic(accountStatisticKey, accountUnitKey = null) {
            const initialValue = 0;

            return this.allAccounts.reduce((accumulator, currentAccount) => {
                let currentAccountValue = Number(
                    currentAccount[accountStatisticKey]
                );

                if (accountUnitKey) {
                    const hashRateUnit = currentAccount[accountUnitKey];

                    currentAccountValue =
                        currentAccountValue * UnitMultiplierEnum[hashRateUnit];
                }

                return accumulator + currentAccountValue;
            }, initialValue);
        },
    },
};
</script>

<style scoped>
.subs {
    display: flex;
    flex: 1 1 auto;
    flex-direction: column;
}

.subs__cards {
    width: 100%;
    grid-column: 1 / 5;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
}
@media (max-width: 2100px) {
    .subs__cards {
        grid-template-columns: repeat(6, 1fr);
        grid-column: 1 / 7;
    }
}
@media (max-width: 1100px) {
    .subs__cards {
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(2, 1fr);
    }
}
@media (max-width: 998px) {
    .subs__cards {
        display: flex;
        flex-direction: column;
    }
}

.subs__card-first {
    grid-column: 1 / 2;
}
@media (max-width: 2100px) {
    .subs__card-first {
        grid-column: 1 / 3;
    }
}
@media (max-width: 1100px) {
    .subs__card-first {
        grid-column: 1 / 2;
    }
}

.subs__card-second {
    grid-column: 2 / 3;
}
@media (max-width: 2100px) {
    .subs__card-second {
        grid-column: 3 / 5;
    }
}
@media (max-width: 1100px) {
    .subs__card-second {
        grid-column: 2 / 3;
    }
}

.subs__card-third {
    grid-column: 3 / 4;
}
@media (max-width: 2100px) {
    .subs__card-third {
        grid-column: 5 / 6;
    }
}
@media (max-width: 1100px) {
    .subs__card-third {
        grid-column: 1 / 2;
        grid-row: 2 / 3;
    }
}

.subs__card-fourth {
    grid-column: 4 / 5;
}
@media (max-width: 2100px) {
    .subs__card-fourth {
        grid-column: 6 / 7;
    }
}
@media (max-width: 1100px) {
    .subs__card-fourth {
        grid-column: 2 / 3;
        grid-row: 2 / 3;
    }
}

.subs_title {
    display: none;
}

@media (max-width: 500px) {
    .subs_title {
        display: inline-flex;
    }
}

.subs__wrapper {
    width: 100%;
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.subs__wrapper_two {
    width: 100%;
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

@media (max-width: 767.98px) {
    .subs__wrapper {
        gap: 16px;
    }

    .subs__wrapper_two {
        gap: 12px;
    }
}
</style>

<template>
    <div class="subs">
        <div class="subs__wrapper">
            <main-title class="subs_title">{{ $t("title") }} </main-title>

            <div
                class="subs__cards"
            >
                <cabinet-card
                    class="subs__card-first"
                    :title="$t('info_blocks.hash.titles[0]')"
                    :value="Number(accountsStatistic.hash_per_min).toFixed(2)"
                    unit="TH/s"
                >
                    <template #svg>
                        <minute-hashrate-icon />
                    </template>
                </cabinet-card>
                <cabinet-card
                    class="subs__card-second"
                    :title="$t('info_blocks.hash.titles[1]')"
                    :value="Number(accountsStatistic.hash_per_day).toFixed(2)"
                    unit="TH/s"
                >
                    <template #svg>
                        <day-hashrate-icon />
                    </template>
                </cabinet-card>
                <cabinet-card
                    class="card-active subs__card-third"
                    :title="$t('info_blocks.workers.types[0]')"
                    :value="accountsStatistic.workers_count_active"
                />
                <cabinet-card
                    class="card-in-active subs__card-fourth"
                    :title="$t('info_blocks.workers.types[2]')"
                    :value="accountsStatistic.workers_count_in_active"
                />
            </div>
            <div
                v-if="!service.waitSubs && !service.emptySubs"
                class="subs__wrapper"
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
import { mapGetters } from "vuex";
import SubHeader from "@/modules/subs/Components/SubHeader.vue";
import SubList from "@/modules/subs/Components/SubList.vue";
import { SubMessages } from "@/modules/subs/lang/SubMessages";
import { SubService } from "@/modules/subs/services/SubService";
import CabinetCard from "@/modules/common/Components/UI/CabinetCard.vue";
import DayHashrateIcon from "@/modules/common/icons/DayHashrateIcon.vue";
import MinuteHashrateIcon from "@/modules/common/icons/MinuteHashrateIcon.vue";

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
        ]),
        accountsStatistic() {
            const accountsStatistic = {
                hash_per_min: this.getSumAccountsStatistic("hash_per_min") ?? 0,
                hash_per_day: this.getSumAccountsStatistic("hash_per_day") ?? 0,
                workers_count_active: this.getSumAccountsStatistic("workers_count_active") ?? 0,
                workers_count_in_active: this.getSumAccountsStatistic("workers_count_in_active") ?? 0,
            };

            return accountsStatistic;
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
        getSumAccountsStatistic(accountStatisticKey) {
            const initialValue = 0;

            return this.allAccounts.reduce((accumulator, currentAccount) => accumulator + Number(currentAccount[accountStatisticKey]), initialValue);
        },
        toggleIsTable(subsTypeState = null) {
            this.service.toggleSubsType(subsTypeState);
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

@media (max-width: 998px) {
    .subs {
        padding: 24px 12px 24px;
    }
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
    gap: 16px;
}
</style>

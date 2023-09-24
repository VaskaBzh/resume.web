<template>
    <table class="table">
        <thead class="table__head">
            <tr class="table__row">
                <th class="table_column" v-for="(title, i) in titles" :key="i">
                    <span>{{ title }}</span>
                </th>
            </tr>
        </thead>
        <tbody class="table__body">
            <table-row
                v-for="(row, i) in rows"
                :columns="row"
                :titles="titles"
                :key="i"
                :viewportWidth="viewportWidth"
                :class="row.class ?? null"
                :data-popup="row.data"
                @openGraph="getUser"
            />
        </tbody>
    </table>
    <!--    <teleport to="body">-->
    <!--        <main-popup-->
    <!--            v-if="!!worker_service"-->
    <!--            :errors="errors"-->
    <!--            class="popup-graph"-->
    <!--            id="seeChart"-->
    <!--            ref="chart"-->
    <!--            typePopup="graph"-->
    <!--            @closed="dropUser"-->
    <!--        >-->
    <!--            <div class="popup__head">-->
    <!--                <main-title tag="h4" class="title-blue">-->
    <!--                    {{ worker_service.target_worker?.name }}-->
    <!--                </main-title>-->
    <!--                <span-->
    <!--                    class="status popup_status"-->
    <!--                    :class="worker_service.target_worker?.class"-->
    <!--                >-->
    <!--                    {{-->
    <!--                        worker_service.target_worker?.class === "ACTIVE"-->
    <!--                            ? $t("workers.statuses[0]")-->
    <!--                            : worker_service.target_worker?.class === "INACTIVE"-->
    <!--                            ? $t("workers.statuses[1]")-->
    <!--                            : $t("workers.statuses[2]")-->
    <!--                    }}-->
    <!--                </span>-->
    <!--            </div>-->
    <!--            <div class="popup__main">-->
    <!--                <div class="popup__info">-->
    <!--                    <div class="popup__info_block">-->
    <!--                        <span class="label popup__info_block_label">-->
    <!--                            {{ $t("workers.table.thead[1]") }}</span-->
    <!--                        >-->
    <!--                        <span class="text text-black">-->
    <!--                            <b> {{ worker_service.target_worker?.hashrate }}</b>-->
    <!--                        </span>-->
    <!--                    </div>-->
    <!--                    <div class="popup__info_block">-->
    <!--                        <span class="label popup__info_block_label">{{-->
    <!--                            $t("workers.table.thead[3]")-->
    <!--                        }}</span>-->
    <!--                        <span class="text text-black">-->
    <!--                            <b>-->
    <!--                                {{-->
    <!--                                    worker_service.target_worker-->
    <!--                                        ?.hashrate_per_day-->
    <!--                                }}</b-->
    <!--                            ></span-->
    <!--                        >-->
    <!--                    </div>-->
    <!--                    <div class="popup__info_block">-->
    <!--                        <span class="label popup__info_block_label">{{-->
    <!--                            $t("workers.table.thead[4]")-->
    <!--                        }}</span>-->
    <!--                        <span class="text text-black">-->
    <!--                            <b>-->
    <!--                                {{-->
    <!--                                    worker_service.target_worker?.reject_percent-->
    <!--                                }}</b-->
    <!--                            ></span-->
    <!--                        >-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <statistic-chart-->
    <!--                    class="popup-graph__graph"-->
    <!--                    :graph="worker_service.graph"-->
    <!--                    :redraw="redraw"-->
    <!--                    :viewportWidth="viewportWidth"-->
    <!--                    :heightVal="height"-->
    <!--                    :tooltip="true"-->
    <!--                />-->
    <!--            </div>-->
    <!--        </main-popup>-->
    <!--    </teleport>-->
</template>

<script>
import TableRow from "@/Components/tables/row/TableRow.vue";
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import StatisticChart from "@/Components/technical/charts/StatisticChart.vue";
import { mapGetters } from "vuex";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";

export default {
    name: "main-table",
    props: {
        viewportWidth: Number,
        table: Object,
        errors: Object,
        worker_service: {
            type: Object,
        },
    },
    components: { MainPopup, StatisticChart, TableRow, MainTitle },
    computed: {
        ...mapGetters(["allHistoryMiner"]),
        rows() {
            return this.table?.get("rows");
        },
        titles() {
            return this.table?.get("titles");
        },
    },
    data() {
        return {
            redraw: true,
            height: 360,
            indexWorker: 0,
        };
    },
    watch: {
        "worker_service.graph"() {
            this.redraw = false;
            setTimeout(() => (this.redraw = true), 1700);
        },
        viewportWidth() {
            if (this.viewportWidth >= 991.98) {
                this.height = 360;
            }
            if (this.viewportWidth < 991.98) {
                this.height = 352;
            }
        },
        async indexWorker(newVal, oldVal) {
            if (newVal !== oldVal && newVal !== -1) {
                await setTimeout(() => (this.redraw = true), 1700);
            }
        },
    },
    methods: {
        async getUser(data) {
            this.$emit("getData", data);
            // data.id ? await this.worker_service?.getPopup(data.id) : null;
        },
        dropUser() {
            Object.values(this.worker_service).length > 0
                ? this.worker_service.clearWorkerId()
                : null;
        },
    },
};
</script>

<style lang="scss">
.table {
    width: 100%;
    border-spacing: 0 8px;
    text-indent: 0;
    border-collapse: separate;
    @media (max-width: 767.98px) {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    &__body {
        @media (max-width: 767.98px) {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
    }
    &_column {
        position: relative;
        -moz-user-select: -moz-none;
        -o-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        user-select: none;
        @media (min-width: 767.98px) {
            height: 48px;
            padding-left: 16px;
        }
        &:first-child {
            border-radius: 8px 0 0 8px;
        }
        &:last-child {
            border-radius: 0 8px 8px 0;
        }
        span {
            -moz-user-select: -moz-text;
            -o-user-select: text;
            -khtml-user-select: text;
            -webkit-user-select: text;
            user-select: text;
            display: inline-flex;
        }
    }
    &__head {
        @media (max-width: 767.98px) {
            display: none;
        }
        .table {
            &_column {
                position: relative;
                color: var(--text-teritary-day, #98a2b3);
                font-family: NunitoSans;
                font-size: 14px;
                font-style: normal;
                font-weight: 400;
                line-height: 20px; /* 142.857% */
                background: transparent;
            }
        }
    }
    &__row {
        text-align: left;
        &[data-popup="#seeChart"] {
            td {
                transition: all 0.3s ease 0s;
                &:nth-child(4) {
                    border-radius: 0 8px 8px 0;
                }
            }
            svg {
                @media (min-width: 767.98px) {
                    display: inline;
                }
            }
            &:hover,
            &:active {
                @media (max-width: 767.98px) {
                    background: #c6d8f5;
                }
                @media (min-width: 767.98px) {
                    td {
                        background: #c6d8f5;
                    }
                    svg {
                        stroke: #343434;
                    }
                }
            }
        }
        svg {
            transition: all 0.3s ease 0s;
            // display: none;
            stroke: #818c99;
            position: absolute;
            right: 40px;
            margin-top: 25px;
            transform: translateY(-50%);
        }
    }
    &_column {
        @media (max-width: 767.98px) {
            display: inline-flex;
            width: 100%;
            justify-content: space-between;
            span {
                &:last-child {
                    font-weight: 500;
                }
            }
            &-margin {
                margin-top: 8px;
            }
        }
    }
}
</style>

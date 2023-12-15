<template>
    <table class="table">
        <thead class="table__head">
            <table-titles class="table__row-income" :titles="titles" />
        </thead>
        <tbody class="table__body" @click="deligateProcess">
            <component
                :is="component"
                v-for="(row, i) in table?.rows"
                :key="i"
                :columns="row"
                :titles="titles"
                :viewport-width="viewportWidth"
                :class="row.class ?? null"
                :data-popup="row.data"
            />
        </tbody>
    </table>
</template>

<script>
import TableRow from "@/modules/table/Components/TableRow.vue";
import TableTitles from "@/modules/table/Components/TableTitles.vue";

import { mapGetters } from "vuex";

export default {
    name: "MainTable",
    components: {
        TableTitles,
        TableRow,
    },
    props: {
        viewportWidth: Number,
        table: Object,
        errors: Object,
        component: {
            default: TableRow,
        },
    },
    methods: {
        deligateProcess(event) {
            if (event.target.closest("[data-copy]")) {
                navigator.clipboard.writeText(
                    event.target.closest("[data-copy]").dataset.copy
                );
            }
        },
    },
    computed: {
        ...mapGetters(["allHistoryMiner"]),
        titles() {
            if (this.table?.titles) {
                return this.table?.titles;
            }

            return null;
        },
    },
    data() {
        return {
            redraw: true,
        };
    },
};
</script>

<style lang="scss">
.table {
    text-indent: 0;
    border-collapse: separate;
    border-spacing: 0 8px;
    width: 100%;
    &_column {
        position: relative;
        -moz-user-select: -moz-none;
        -o-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        user-select: none;
        white-space: nowrap;
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
        .table {
            &_column {
                position: relative;
                color: var(--text-table-title);
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
        position: relative;
        &[data-popup="#seeChart"] {
            border-width: 1px;
            border-style: solid;
            td {
                transition: all 0.3s ease 0s;
                &:nth-child(4) {
                    border-radius: 0 8px 8px 0;
                }
                border-bottom-width: 1px;
                border-top-width: 1px;
                border-color: transparent;
                border-style: solid;
                &:first-child {
                    border-left-width: 1px;
                }
                &:last-child {
                    border-right-width: 1px;
                }
            }
        }
    }
}
</style>

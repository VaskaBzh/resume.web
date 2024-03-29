<template>
    <table class="table">
        <thead class="table__head">
            <table-titles
                :titles="titles"
            />
        </thead>
        <tbody class="table__body" v-if="!$slots.is">
            <table-row
                v-for="(row, i) in rows"
                :columns="row"
                :titles="titles"
                :key="i"
                :viewportWidth="viewportWidth"
                :class="row.class ?? ''"
                :data-popup="row.data"
                :removePercent="removePercent"
            />
        </tbody>
        <tbody class="table__body" v-else>
            <slot name="is" />
        </tbody>
    </table>
</template>

<script>
import TableRow from "@/modules/table/Components/TableRow.vue";
import TableTitles from "@/modules/table/Components/TableTitles.vue";

import { mapGetters } from "vuex";

export default {
    name: "main-table",
    props: {
        viewportWidth: Number,
        table: Object,
        errors: Object,
        removePercent: Boolean,
    },
    components: {
        TableTitles,
        TableRow,
    },
    computed: {
        ...mapGetters(["allHistoryMiner"]),
        rows() {
            return this.table?.get("rows");
        },
        titles() {
            if (this.table?.get("titles")) {
                const titles = [...this.table?.get("titles")];
                if (this.removePercent) {
                    titles.pop();
                }
                return titles;
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
    width: 100%;
    text-indent: 0;
    border-collapse: separate;
    border-spacing: 0 8px;
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
            svg {
                @media (min-width: 767.98px) {
                    display: inline;
                }
            }
            //&:before {
            //    content: "";
            //    border-radius: 0 4px 4px 0;
            //    background: #2E90FA;
            //    position: absolute;
            //    left: 0;
            //    top: 50%;
            //    transform: translateX(-50%);
            //    transition: all 0.3s ease 0s;
            //}
            //&:active {
            //    position: relative;
            //    &:before {
            //        opacity: 1;
            //    }
            //}
            &:hover {
                @media (max-width: 767.98px) {
                    border-color: var(--states-broder-hover, #43474E);
                }
                @media (min-width: 767.98px) {
                    td {
                        border-color: var(--states-broder-hover, #43474E);
                    }
                }
            }
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

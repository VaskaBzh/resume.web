<template>
    <tr
        class="table__row"
        :class="{ 'table__row-cursor': columns?.graphId }"
        @click="openPopup"
    >
        <td
            class="table_column"
            :key="i"
            v-for="(column, i) in renderColumns"
            v-tooltip="
                viewportWidth >= 767.98
                    ? column[0] === 'wallet'
                        ? {
                              mode: 'interactive: true',
                              message: `${this.columns.txid}`,
                          }
                        : column[0] === 'status'
                        ? { message: this.columns.message }
                        : null
                    : null
            "
        >
            <span class="label" v-show="viewportWidth <= 767.98">{{
                titles[i]
            }}</span>
            <span>{{ column[1] }}</span>
        </td>
    </tr>
</template>

<script>
export default {
    name: "table-row",
    props: {
        viewportWidth: Number,
        columns: Array,
        titles: Array,
    },
    computed: {
        updatedColumns() {
            if (this.columns) {
                let obj = this.columns;
                if (
                    this.columns.unit24 &&
                    !new RegExp("h/s").test(obj.hashRate)
                ) {
                    obj.hashRate = ` ${obj.hashRate} ${this.columns.unit}h/s`;
                    obj.hashRate24 = `${obj.hashRate24} ${this.columns.unit24}h/s`;
                }
                return obj;
            }
            return {};
        },
        renderColumns() {
            if (this.columns) {
                return Object.entries(this.updatedColumns).filter(
                    (col) =>
                        col[0] !== "class" &&
                        col[0] !== "graphId" &&
                        col[0] !== "data" &&
                        col[0] !== "unit" &&
                        col[0] !== "unit24" &&
                        col[0] !== "payment" &&
                        col[0] !== "message" &&
                        col[0] !== "txid"
                );
            }
            return {};
        },
    },
    methods: {
        openPopup() {
            if (this.columns?.graphId)
                this.$emit("openGraph", {
                    id: this.columns.graphId,
                    info: this.updatedColumns,
                });
        },
    },
};
</script>

<style scoped lang="scss">
.table {
    &_column {
        font-size: 18px;
        font-weight: 400;
        line-height: 135%;
        color: #343434;
        white-space: nowrap;
        @media (max-width: 991.98px) {
            font-size: 14px;
        }
        @media (max-width: 767.98px) {
            display: inline-flex;
            justify-content: space-between;
            span {
                &:last-child {
                    font-weight: 500;
                }
            }
        }
        @media (min-width: 767.98px) {
            background: #fafafa;
        }
        &:first-child {
            @media (min-width: 767.98px) {
                padding-left: 16px;
            }
        }
    }
    &__row {
        @media (max-width: 767.98px) {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 8px 0;
            &:not(.main) {
                padding: 16px;
                background: #fafafa;
                border-radius: 16px;
                box-shadow: 0 4px 10px 0 rgba(85, 85, 85, 0.1);
            }
        }
        &-cursor {
            cursor: pointer;
        }
        &.main {
            .table_column {
                background: transparent;
                color: #5389e1;
                &:first-child {
                    padding-left: 0;
                    @media (max-width: 767.98px) {
                        span {
                            font-size: 18px;
                            font-style: normal;
                            font-weight: 400;
                            line-height: 135%;
                            &:first-child {
                                display: none;
                            }
                        }
                    }
                }
            }
        }
        &.active,
        &.inactie,
        &.unstable {
            .table_column:first-child span:last-child::before {
                display: inline-flex;
                content: "";
                width: 12px;
                height: 12px;
                border-radius: 50%;
                margin-right: 8px;
                background: transparent;
                transition: all 0.5s ease 0s;
            }
        }
        &.rejected,
        &.fullfill,
        &.pending {
            .table_column:last-child span:last-child::before {
                display: inline-flex;
                content: "";
                width: 12px;
                height: 12px;
                border-radius: 50%;
                margin-right: 8px;
                background: transparent;
                transition: all 0.5s ease 0s;
            }
        }
        &.active {
            .table_column:first-child span:last-child:before {
                background: #13d60e;
            }
        }
        &.fullfill {
            .table_column:last-child span:last-child:before {
                background: #13d60e;
            }
        }
        &.inactive {
            .table_column:first-child span:last-child:before {
                background: #ff0000;
            }
        }
        &.rejected {
            .table_column:last-child span:last-child:before {
                background: #ff0000;
            }
        }
        &.unstable {
            .table_column:first-child span:last-child:before {
                background: #e9c058;
            }
        }
        &.pending {
            .table_column:last-child span:last-child:before {
                background: #e9c058;
            }
        }
    }
}
</style>

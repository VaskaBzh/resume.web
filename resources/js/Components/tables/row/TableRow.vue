<template>
    <tr
        class="table__row"
        :class="{ 'table__row-cursor': columns?.graphId }"
        @mousedown="openPopup"
    >
        <td
            class="table_column"
            :key="i"
            v-for="(column, i) in renderColumns"
            v-tooltip="
                viewportWidth >= 767.98
                    ? column[0] === 'status'
                        ? { message: this.columns.message }
                        : null
                    : null
            "
        >
            <span class="label" v-show="viewportWidth <= 767.98">{{
                renderTitles[i]
            }}</span>
            <span v-hash>{{ column[1] }}</span>
        </td>
        <span class="more" v-if="viewportWidth <= 767.98">{{
            $t("more")
        }}</span>
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            v-if="!!this.columns.graphId"
        >
            <path
                d="M10 6L16 12L10 18"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
        </svg>
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
        renderTitles() {
            if (this.titles) {
                if (
                    this.viewportWidth <= 767.98 &&
                    this.updatedColumns.wallet
                ) {
                    return [
                        this.updatedColumns.wallet !== "..."
                            ? this.updatedColumns.wallet
                            : this.updatedColumns.txid,
                        this.titles[0],
                        this.titles[2],
                        this.titles[3],
                    ];
                }
                return this.titles;
            }
            return [];
        },
        renderColumns() {
            let obj = {};
            if (this.columns) {
                obj = Object.entries(this.updatedColumns).filter(
                    (col) =>
                        col[0] !== "class" &&
                        col[0] !== "graphId" &&
                        col[0] !== "data" &&
                        col[0] !== "unit" &&
                        col[0] !== "unit24" &&
                        col[0] !== "message" &&
                        col[0] !== "validate" &&
                        col[0] !== "status"
                );
                console.log(obj);
                if (
                    this.viewportWidth <= 767.98 &&
                    this.updatedColumns.status
                ) {
                    obj = obj.filter(
                        (col) =>
                            col[0] !== "wallet" &&
                            col[0] !== "payDate" &&
                            col[0] !== "percent"
                    );
                    obj.unshift(obj[3]);
                    obj.pop();
                }
            }
            return obj;
        },
    },
    methods: {
        openPopup() {
            this.$emit("openGraph", {
                id: this.columns.graphId || null,
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
        // text-align: center;
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
        &:nth-last-child(-n+2){
            @media (min-width: 767.98px) {
                border-radius: 0 8px 8px 0;
            }
        }

    }
    &__row {
        border-radius: 8px;
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
                .more {
                    margin-top: 11px;
                    font-size: 14px;
                    font-weight: 400;
                    color: #3f7bdd;
                    line-height: 135%;
                }
            }
        }
        
        // &-cursor {
        //    cursor: pointer;
        // }
        &.main {
            .more {
                display: none;
            }
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
        &.inactive,
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
        &.completed,
        &.pending {
            .table_column {
                @media (min-width: 767.98px) {
                    &:last-child span:last-child::before {
                        display: inline-flex;
                        content: "";
                        width: 12px;
                        height: 12px;
                        border-radius: 50%;
                        margin-right: 8px;
                        transition: all 0.5s ease 0s;
                    }
                }
                @media (max-width: 767.98px) {
                    &:first-child span:last-child::before {
                        display: inline-flex;
                        content: "";
                        width: 12px;
                        height: 12px;
                        border-radius: 50%;
                        margin-right: 8px;
                        transition: all 0.5s ease 0s;
                    }
                }
            }
        }
        &.active {
            .table_column:first-child span:last-child:before {
                background: #13d60e;
            }
        }
        &.completed {
            .table_column {
                @media (min-width: 767.98px) {
                    &:last-child span:last-child:before {
                        background: #13d60e;
                    }
                }
                @media (max-width: 767.98px) {
                    &:first-child span:last-child:before {
                        background: #13d60e;
                    }
                }
            }
        }
        &.inactive {
            .table_column:first-child span:last-child:before {
                background: #ff0000;
            }
        }
        &.rejected {
            .table_column {
                @media (min-width: 767.98px) {
                    &:last-child span:last-child:before {
                        background: #ff0000;
                    }
                }
                @media (max-width: 767.98px) {
                    &:first-child span:last-child:before {
                        background: #ff0000;
                    }
                }
            }
        }
        &.unstable {
            .table_column:first-child span:last-child:before {
                background: #e9c058;
            }
        }
        &.pending {
            .table_column {
                @media (min-width: 767.98px) {
                    &:last-child span:last-child:before {
                        background: #e9c058;
                    }
                }
                @media (max-width: 767.98px) {
                    &:first-child span:last-child:before {
                        background: #e9c058;
                    }
                }
            }
        }
    }
}
</style>

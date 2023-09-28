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
            <span v-hash ref="row_content" :class="column[0]">{{
                column[1]
            }}</span>
        </td>
        <!--        <span class="more" v-if="viewportWidth <= 767.98">{{-->
        <!--            $t("more")-->
        <!--        }}</span>-->
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            v-if="!!this.columns.graphId && !removePercent"
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
import {mapGetters} from "vuex";

export default {
    name: "table-row",
    props: {
        columns: Array,
        titles: Array,
        removePercent: Boolean,
    },
    computed: {
        ...mapGetters(["viewportWidth"]),
        getWorkersStats() {
            return this.$refs?.row_content?.find(
                (el) => el.className === "workers_stats"
            );
        },
        updatedColumns() {
            if (this.columns) {
                let obj = this.columns;
                if (
                    this.columns.unit24 &&
                    !new RegExp("h/s").test(obj.hashRate)
                ) {
                    obj.hashRate = ` ${obj.hashRate} ${this.columns.unit}h/s`;
                    // obj.hashRate24 = `${obj.hashRate24} ${this.columns.unit24}h/s`;
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
                            : "...",
                        this.titles[0],
                        this.titles[1],
                        this.titles[2],
                        this.titles[3],
                        this.titles[4],
                    ];
                }
                return this.titles;
            }
            return [];
        },
        renderColumns() {
            let obj = {};
            if (this.columns) {
                obj = Object.entries(this.updatedColumns).filter((col) => {
                    return (
                        col[0] !== "class" &&
                        col[0] !== "graphId" &&
                        col[0] !== "data" &&
                        col[0] !== "unit" &&
                        col[0] !== "unit24" &&
                        col[0] !== "message" &&
                        col[0] !== "validate" &&
                        col[0] !== (this.removePercent ? "reject_percent" : "")
                    );
                });
                if (
                    this.viewportWidth <= 767.98 &&
                    this.updatedColumns.status
                ) {
                    obj = obj.filter(
                        (col) => col[0] !== "wallet" && col[0] !== "txid"
                    );
                    obj.unshift(obj[5]);
                    obj.pop();
                }
            }
            return obj;
        },
    },
    methods: {
        setWorkersStats() {
            if (this.getWorkersStats) {
                const splitedText = this.getWorkersStats.textContent.split("/");

                const firstSpan = `<span class="workers-active">${splitedText[0]}</span>`;
                const secondSpan = `<span class="workers-inactive">${splitedText[1]}</span>`;

                const joinedRow = [firstSpan, secondSpan].join("/");

                this.getWorkersStats.innerHTML = joinedRow;
            }
        },
        openPopup() {
            this.$emit("tableProcess", {
                id: this.columns.graphId,
            });
        },
    },
    mounted() {
        this.setWorkersStats();
    },
};
</script>

<style scoped lang="scss">
.table {
    &_column {
        font-family: NunitoSans;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 20px;
        color: var(--text-teritary);
        white-space: nowrap;
        // text-align: center;
        -moz-user-select: -moz-none;
        -o-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        user-select: none;
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
            background: var(--background-island);
        }
        &:first-child {
            @media (min-width: 767.98px) {
                padding-left: 16px;
            }
        }
        &:nth-last-child(-n + 2):has(+ svg) {
            @media (min-width: 767.98px) {
                border-radius: 0 8px 8px 0;
            }
        }
        span {
            -moz-user-select: -moz-text;
            -o-user-select: text;
            -khtml-user-select: text;
            -webkit-user-select: text;
            user-select: text;
            display: inline-flex;
            align-items: center;
            &.workers {
                color: #13d60e;
                &_stats {
                    display: inline-flex;
                    gap: 6px;
                }
            }
            .workers {
                &-active {
                    color: #13d60e;
                }
                &-inactive {
                    color: #eb5757;
                }
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
                background: var(--background-island);
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
        &-cursor {
            cursor: pointer;
        }
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
        &.unstable,
        &.ACTIVE,
        &.INACTIVE,
        &.UNSTABLE {
            span {
                &.status,
                &.name {
                    &::before {
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
        &.error,
        &.complete,
        &.completed,
        &.pending,
        &.rejected {
            span {
                &.status,
                &.name {
                    &::before {
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
            span.status:before {
                background: #13d60e;
            }
        }
        &.ACTIVE {
            span.name:before {
                background: #13d60e;
            }
        }
        &.complete,
        &.completed {
            span.status:before {
                background: #13d60e;
            }
        }
        &.inactive {
            span.status:before {
                background: #ff0000;
            }
        }
        &.INACTIVE {
            span.name:before {
                background: #ff0000;
            }
        }
        &.error,
        &.rejected {
            span.status:before {
                background: #ff0000;
            }
        }
        &.unstable {
            span.status:before {
                background: #e9c058;
            }
        }
        &.UNSTABLE {
            span.name:before {
                background: #e9c058;
            }
        }
        &.pending {
            span.status:before {
                background: #e9c058;
            }
        }
    }
}
</style>

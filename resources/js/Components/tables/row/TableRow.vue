<template>
    <tr
        class="table__row"
        :class="{ 'table__row-cursor': this.columns?.graphId }"
        @click="openGraph"
    >
        <td class="table_column" :key="i" v-for="(column, i) in renderRows">
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
    },
    computed: {
        renderRows() {
            if (this.columns)
                return Object.entries(this.columns).filter(
                    (col) => col[0] !== "class" && col[0] !== "graphId" && col[0] !== "data"
                );
            return {};
        },
    },
    methods: {
        openGraph() {
            if (this.columns?.graphId)
                this.$emit("openGraph", this.columns.graphId);
        },
    },
};
</script>

<style scoped lang="scss">
.table {
    &_column {
        background: #fafafa;
        font-size: 18px;
        font-weight: 400;
        line-height: 135%;
        color: #343434;
        &:first-child {
            padding-left: 16px;
        }
    }
    &__row {
        &-cursor {
            cursor: pointer;
        }
        &.main {
            .table_column {
                background: transparent;
                color: #5389e1;
                &:first-child {
                    padding-left: 0;
                }
            }
        }
        &.active,
        &.inactive,
        &.unstable {
            .table_column:first-child span::before {
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
            .table_column:first-child span:before {
                background: #13d60e;
            }
        }
        &.inactive {
            .table_column:first-child span:before {
                background: #ff0000;
            }
        }
        &.unstable {
            .table_column:first-child span:before {
                background: #e9c058;
            }
        }
    }
}
</style>

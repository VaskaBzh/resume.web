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
                :removePercent="removePercent"
                @tableProcess="getUser"
            />
        </tbody>
    </table>
</template>

<script>
import TableRow from "@/Components/tables/row/TableRow.vue";
import { mapGetters } from "vuex";
export default {
    name: "main-table",
    props: {
        viewportWidth: Number,
        table: Object,
        errors: Object,
        removePercent: Boolean,
    },
    components: { TableRow },
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
            height: 360,
            indexWorker: 0,
        };
    },
    watch: {
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
                    background: var(
                        --background-island-inner-1,
                        rgba(83, 177, 253, 0.07)
                    );
                }
                @media (min-width: 767.98px) {
                    td {
                        background: var(
                            --background-island-inner-1,
                            rgba(83, 177, 253, 0.07)
                        );
                    }
                    svg {
                        stroke: #343434;
                    }
                }
            }
        }
        svg {
            transition: all 0.3s ease 0s;
            stroke: #818c99;
            position: absolute;
            right: 40px;
            margin-top: 25px;
            transform: translateY(-50%);
            @media (max-width: 900px) {
                display: none;
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

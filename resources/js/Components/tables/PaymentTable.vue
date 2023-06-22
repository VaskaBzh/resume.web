<template>
    <div
        class="table-block"
        v-if="this.visualType === 'block' && this.rowsVal !== 0"
    >
        <div
            class="table-block_block"
            v-for="(row, i) in this.showRows"
            :key="i"
        >
            <div class="table-block_column" v-if="this.table.shortTitles">
                <span
                    class="description description-xs"
                    v-for="(title, index) in this.table.shortTitles"
                    :key="index"
                >
                    {{ title }}
                </span>
            </div>
            <div class="table-block_column" v-else>
                <span
                    class="description description-xs"
                    v-for="(title, index) in this.table.titles"
                    :key="index"
                >
                    {{ title }}
                </span>
            </div>
            <table-payment-row
                class="table-block_column"
                :visualType="this.visualType"
                :columns="row"
                :key="i"
            />
        </div>
    </div>
    <div class="table-block" v-else-if="this.visualType === 'block'">
        <div
            class="table-block_block"
            v-for="(row, i) in this.table.rows"
            :key="i"
        >
            <div class="table-block_column" v-if="this.table.shortTitles">
                <span
                    class="table-block_title"
                    v-for="(title, index) in this.table.shortTitles"
                    :key="index"
                >
                    {{ title }}
                </span>
            </div>
            <div class="table-block_column" v-else>
                <span
                    class="table-block_title"
                    v-for="(title, index) in this.table.titles"
                    :key="index"
                >
                    {{ title }}
                </span>
            </div>
            <table-payment-row
                class="table-block_column"
                :visualType="this.visualType"
                :columns="row"
                :key="i"
            />
        </div>
    </div>
    <table class="table" v-else-if="this.table.rows">
        <thead class="history__thead" v-if="this.table.rows[0].img">
            <tr v-if="this.viewportWidth > 991.98">
                <th
                    class="description description-xs"
                    v-for="(title, i) in this.table.titles"
                    :key="i"
                >
                    {{ title }}
                </th>
            </tr>
            <tr v-else>
                <th
                    class="description description-xs"
                    v-for="(title, i) in this.table.shortTitles"
                    :key="i"
                >
                    {{ title }}
                </th>
            </tr>
        </thead>
        <thead
            class="ref-list__thead"
            v-else-if="this.table.titles.length === 4"
        >
            <tr v-if="this.viewportWidth > 991.98">
                <th
                    class="description description-xs"
                    v-for="(title, i) in this.table.titles"
                    :key="i"
                >
                    {{ title }}
                </th>
            </tr>
            <tr v-else>
                <th
                    class="description description-xs"
                    v-for="(title, i) in this.table.shortTitles"
                    :key="i"
                >
                    {{ title }}
                </th>
            </tr>
        </thead>

        <thead v-else-if="this.table.titles.length === 3">
            <tr>
                <th
                    class="description description-xs"
                    v-for="(title, i) in this.table.titles"
                    :key="i"
                >
                    {{ title }}
                </th>
            </tr>
        </thead>
        <thead class="ref__thead" v-else-if="this.table.titles.length === 2">
            <tr>
                <th
                    class="description description-xs"
                    v-for="(title, i) in this.table.titles"
                    :key="i"
                >
                    {{ title }}
                </th>
            </tr>
        </thead>
        <thead class="accruals__thead" v-else>
            <tr v-if="this.viewportWidth > 991.98">
                <th
                    class="description description-xs"
                    v-for="(title, i) in this.table.titles"
                    :key="i"
                >
                    {{ title }}
                </th>
            </tr>
            <tr v-else>
                <th
                    class="description description-xs"
                    v-for="(title, i) in this.table.shortTitles"
                    :key="i"
                >
                    {{ title }}
                </th>
            </tr>
        </thead>
        <tbody v-if="!this.table.rows">
            <div class="no-info">
                <img src="../../../assets/img/img_no-info.png" alt="no_info" />
                <span>Нет данных</span>
            </div>
        </tbody>
        <tbody v-else-if="this.rowsVal !== 0">
            <table-payment-row
                v-for="(row, i) in this.showRows"
                :columns="row"
                :key="i"
            />
        </tbody>
        <tbody v-else>
            <table-payment-row
                v-for="(row, i) in this.table.rows"
                :columns="row"
                :key="i"
            />
        </tbody>
    </table>
</template>
<script>
import TablePaymentRow from "@/Components/tables/row/TablePaymentRow.vue";

export default {
    components: { TablePaymentRow },
    props: {
        table: Object,
        first: Number,
        rowsVal: {
            type: Number,
            default: 0,
        },
        visualType: {
            type: String,
            default: "table",
        },
    },
    data() {
        return {
            viewportWidth: 0,
        };
    },
    computed: {
        showRows() {
            let showInfo = {};
            if (this.rowsVal > this.table.rows.length) {
                for (let i = this.first; i < this.table.rows.length; i++) {
                    Reflect.set(
                        showInfo,
                        Reflect.ownKeys(this.table.rows)[i],
                        Reflect.get(
                            this.table.rows,
                            Reflect.ownKeys(this.table.rows)[i]
                        )
                    );
                }
            } else {
                for (let i = this.first; i < this.rowsVal; i++) {
                    Reflect.set(
                        showInfo,
                        Reflect.ownKeys(this.table.rows)[i],
                        Reflect.get(
                            this.table.rows,
                            Reflect.ownKeys(this.table.rows)[i]
                        )
                    );
                }
            }
            return showInfo;
        },
    },
    methods: {
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
};
</script>
<style lang="scss" scoped>
.table {
    width: 100%;
    border-spacing: 0 8px;
    text-indent: 0;
    border-collapse: separate;
    &-block {
        display: flex;
        flex-direction: column;
        gap: 10px;
        &_block {
            padding: 10px;
            background: #ffffff;
            border-radius: 12px;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        &_column {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: flex-start;
            &:last-child {
                align-items: flex-end;
                span {
                    text-align: right;
                    font-weight: 500;
                    font-size: 16px;
                    line-height: 17px;
                    color: #000034;
                }
            }
            span {
                font-size: 16px;
                line-height: 17px;
                color: rgba(0, 0, 0, 0.62);
            }
        }
    }
    tr {
        th,
        td {
            white-space: nowrap;
            &:first-child {
                padding-left: 16px;
                @media (max-width: 767.98px) {
                    padding: 0 10px 0 0;
                }
            }
            &:last-child {
                padding-right: 16px;
                @media (max-width: 767.98px) {
                    padding: 0;
                }
            }
        }
    }
    thead {
        tr {
            background: transparent;
            height: 23px;
            @media (max-width: 767.98px) {
                height: 18px;
            }
            @media (max-width: 479.98px) {
                height: 14px;
            }
            th {
                padding-right: 10px;
                color: #5389e1;
                font-weight: 400;
                font-size: 16px;
                line-height: 23px;
                text-align: left;
                &:last-child {
                    text-align: right;
                }
            }
        }
    }
    .history__thead {
        th {
            &:last-child {
                text-align: left;
            }
        }
    }
    .accruals__thead {
        tr {
            th {
                &:last-child {
                    text-align: right;
                }
            }
        }
    }
    tbody {
        tr {
            height: 48px;
            @media (max-width: 767.98px) {
                height: 34px;
            }
            @media (max-width: 479.98px) {
                border: 0.5px solid rgba(0, 0, 0, 0.08);
            }
            &:last-child {
                margin-bottom: 0;
            }
        }
    }
}
</style>

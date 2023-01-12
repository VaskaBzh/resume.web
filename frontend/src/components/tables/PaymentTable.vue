<template>
    <table class="table">
        <thead class="history__thead" v-if="this.table.rows[0].img">
            <tr>
                <th v-for="(title, i) in this.table.titles" :key="i">
                    {{ title }}
                </th>
            </tr>
        </thead>
        <thead
            class="ref-list__thead"
            v-else-if="this.table.titles.length == 4"
        >
            <tr>
                <th v-for="(title, i) in this.table.titles" :key="i">
                    {{ title }}
                </th>
            </tr>
        </thead>

        <thead v-else-if="this.table.titles.length == 3">
            <tr>
                <th v-for="(title, i) in this.table.titles" :key="i">
                    {{ title }}
                </th>
            </tr>
        </thead>
        <thead class="ref__thead" v-else-if="this.table.length == 2">
            <tr>
                <th v-for="(title, i) in this.table.titles" :key="i">
                    {{ title }}
                </th>
            </tr>
        </thead>
        <thead class="accruals__thead" v-else>
            <tr>
                <th v-for="(title, i) in this.table.titles" :key="i">
                    {{ title }}
                </th>
            </tr>
        </thead>
        <tbody v-if="this.rowsVal != 0">
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
export default {
    props: {
        table: Object,
        first: Number,
        rowsVal: {
            type: Number,
            default: 0,
        },
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
};
</script>
<style lang="scss" scoped>
.table {
    width: 100%;
    border-spacing: 0;
    text-indent: 0;
    tr {
        display: flex;
        width: 100%;
    }
    thead {
        tr {
            background: transparent;
            height: 23px;
            margin: 16px 0;
            border-radius: 0;
            padding: 0 16px;
            th {
                color: rgba(0, 0, 0, 0.62);
                font-weight: 400;
                font-size: 16px;
                line-height: 23px;
                text-align: left;
                width: 100%;
                max-width: 224px;
                &:first-child {
                    margin-right: 0;
                }
                &:last-child {
                    max-width: 173px;
                    margin-left: auto;
                    color: rgba(0, 0, 0, 0.62);
                }
            }
        }
    }
    .history__thead {
        th {
            max-width: 273px;
            width: 100%;
            &:first-child {
                max-width: 245px;
            }
            &:nth-child(3) {
                max-width: 295px;
            }
            &:last-child {
                min-width: 120px;
                text-align: left;
                width: auto;
                margin-left: auto;
            }
        }
    }
    .ref-list__thead {
        th {
            max-width: 290px;
            width: 100%;
            &:first-child {
                max-width: 338px;
            }
            &:last-child {
                min-width: 166px;
                width: auto;
                margin-left: auto;
            }
        }
    }
    .accruals__thead {
        tr {
            th {
                max-width: 135px;
                &:nth-child(2) {
                    max-width: 252px;
                }
                &:nth-child(3) {
                    max-width: 172px;
                }
                &:last-child {
                    max-width: 150px;
                    text-align: right;
                }
                &:first-child {
                    max-width: 156px;
                }
            }
        }
    }
    tbody {
        tr {
            background: #ffffff;
            margin-bottom: 8px;
            height: 48px;
            border-radius: 21px;
            padding: 11px 16px;
            &:last-child {
                margin-bottom: 0;
            }
            td {
                width: 100%;
                color: #000034;
                font-weight: 500;
                font-size: 18px;
                line-height: 26px;
                display: inline-flex;
                align-items: center;
            }
        }
    }
}
</style>

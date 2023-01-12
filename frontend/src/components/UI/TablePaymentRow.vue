<template>
    <tr class="row-history" v-if="columns.status">
        <td>
            {{ this.columns.date }}
            <span v-if="this.columns.time"> {{ this.columns.time }}</span>
        </td>
        <td>
            <img :src="require(`@/assets/img/${this.columns.img}`)" />{{
                this.columns.wallet
            }}
        </td>
        <td>{{ this.columns.type }}</td>
        <td>{{ this.BTCVal }} BTC</td>
        <td>{{ this.columns.status }}</td>
    </tr>
    <tr class="row-accruals" v-else-if="columns.type">
        <td>
            {{ this.columns.date }}
            <span v-if="this.columns.time"> {{ this.columns.time }}</span>
        </td>
        <td>{{ this.columns.type }}</td>
        <td>{{ this.columns.hash }} TH/s</td>
        <td>{{ this.BTCVal }} BTC</td>
        <td>{{ this.columns.complexity }}</td>
    </tr>
    <tr class="row-payment" v-else-if="columns.link">
        <td>
            {{ this.columns.date }}
            <span v-if="this.columns.time"> {{ this.columns.time }}</span>
        </td>
        <td>{{ this.BTCVal }} BTC</td>
        <td ref="link" @click="this.copy" class="main__link">
            {{ this.columns.link }}
        </td>
    </tr>
    <tr class="row-ref-list" v-else-if="columns.email">
        <td>{{ this.columns.email }}</td>
        <td>{{ this.columns.hash }} TH/s</td>
        <td>{{ this.columns.middleHash }} TH/s</td>
        <td>
            {{ this.columns.date }}
            <span v-if="this.columns.time"> {{ this.columns.time }}</span>
        </td>
    </tr>
    <tr class="row-ref" v-else>
        <td>
            {{ this.columns.date }}
            <span v-if="this.columns.time"> {{ this.columns.time }}</span>
        </td>
        <td>{{ this.BTCVal }} BTC</td>
    </tr>
</template>
<script>
export default {
    name: "table-payment-row",
    props: {
        columns: Object,
    },
    data() {
        return {
            columnsArr: this.columns,
        };
    },
    computed: {
        BTCVal() {
            return Number(this.columnsArr.BTC).toFixed(8);
        },
    },
    methods: {
        copy() {
            navigator.clipboard.writeText(this.$refs.link.innerText);
        },
    },
};
</script>
<style lang="scss" scoped>
td {
    width: 100%;
    color: #000034;
    font-weight: 500;
    font-size: 18px;
    line-height: 26px;
    display: inline-flex;
    align-items: center;
}
.row-payment {
    td {
        max-width: 224px;
        &:last-child {
            max-width: 365px;
            margin-left: auto;
        }
        span {
            margin-left: 5px;
            color: rgba(#000034, 0.64);
        }
    }
}
.row-history {
    td {
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
        img {
            margin-right: 12px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
        }
    }
}
.row-ref {
    td {
        span {
            color: #0000009e;
            font-weight: 400;
            margin-left: 5px;
        }
        &:last-child {
            min-width: 135px;
            width: auto;
        }
    }
    &-list {
        td {
            max-width: 290px;
            width: 100%;
            &:first-child {
                max-width: 338px;
            }
            span {
                color: #0000009e;
                font-weight: 400;
                margin-left: 5px;
            }
            &:last-child {
                min-width: 166px;
                width: auto;
                margin-left: auto;
            }
        }
    }
}
.row-accruals {
    td {
        max-width: 135px;
        &:nth-child(2) {
            max-width: 252px;
            cursor: pointer;
            &::after {
                content: "!";
                line-height: 7px;
                font-size: 10px;
                width: 12px;
                height: 12px;
                border-radius: 50%;
                background-color: #99b7e8;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                transform: rotate(180deg);
                color: #fff;
                margin: auto 0 auto 6px;
            }
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
</style>

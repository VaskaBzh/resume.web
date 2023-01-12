<template>
    <tr ref="tr" class="row-workers">
        <td>{{ this.columns.hash }}</td>
        <td>{{ this.hashRate }} TH/s</td>
        <td>{{ this.hashAvarage }} TH/s</td>
        <td>{{ this.hashAvarage24 }} TH/s</td>
        <td>{{ this.rejectRate }} %</td>
    </tr>
</template>
<script>
export default {
    name: "table-workers-row",
    props: {
        columns: Object,
    },
    data() {
        return {
            columnsArr: this.columns,
        };
    },
    computed: {
        hashRate() {
            return Number(this.columnsArr.hashRate).toFixed(2);
        },
        hashAvarage() {
            return Number(this.columnsArr.hashAvarage).toFixed(2);
        },
        hashAvarage24() {
            return Number(this.columnsArr.hashAvarage24).toFixed(2);
        },
        rejectRate() {
            return Number(this.columnsArr.rejectRate).toFixed(2);
        },
    },
};
</script>
<style lang="scss" scoped>
.row-workers {
    position: relative;
    padding: 11px 16px 11px 36px !important;
    &::before {
        content: "";
        position: absolute;
        background-color: transparent;
        border-radius: 50%;
        width: 12px;
        height: 12px;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
    }
    td {
        max-width: 165px;
        width: 100%;
        color: #000034;
        font-weight: 500;
        font-size: 18px;
        line-height: 26px;
        display: inline-flex;
        align-items: center;
    }
}
.active {
    &::before {
        background-color: #13d60e;
    }
}
.unstable {
    &::before {
        background-color: #e9c058;
    }
}
.unactive {
    &::before {
        background-color: #ff0000;
    }
}
</style>

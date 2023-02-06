<template>
    <tr v-if="this.viewportWidth > 991.98" ref="tr" class="row-workers">
        <td class="main__number">{{ this.columns.hash }}</td>
        <td class="main__number">{{ this.hashRate }} TH/s</td>
        <td class="main__number">{{ this.hashAvarage }} TH/s</td>
        <td class="main__number">{{ this.hashAvarage24 }} TH/s</td>
        <td class="main__number">{{ this.rejectRate }} %</td>
    </tr>
    <tr v-else-if="this.visualType === 'table'" class="row-workers">
        <td class="main__number">
            <div :class="this.columns.hashClass">{{ this.columns.hash }}</div>
        </td>
        <td class="main__number">{{ this.hashRate }} TH/s</td>
        <td class="main__number">{{ this.hashAvarage }} TH/s</td>
        <td class="main__number">{{ this.rejectRate }} %</td>
    </tr>
    <div v-else class="block-workers">
        <span class="main__number">
            <span :class="this.columns.hashClass">{{ this.columns.hash }}</span>
        </span>
        <span class="main__number">{{ this.hashRate }} TH/s</span>
        <span class="main__number">{{ this.hashAvarage }} TH/s</span>
        <span class="main__number">{{ this.rejectRate }} %</span>
    </div>
</template>
<script>
export default {
    name: "table-workers-row",
    props: {
        columns: Object,
        visualType: {
            type: String,
            default: "table",
        },
    },
    data() {
        return {
            columnsArr: this.columns,
            viewportWidth: 0,
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
.block-workers {
    span {
        text-align: right;
        height: 17px;
        &:first-child {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
    }
    .active {
        background-color: #13d60e !important;
    }
    .unstable {
        background-color: #e9c058 !important;
    }
    .unactive {
        background-color: #ff0000 !important;
    }
}
.row-workers {
    td {
        white-space: nowrap;
        background: #ffffff;
        padding-right: 10px;
        &:first-child {
            padding-left: 36px;
            position: relative;
            border-radius: 21px 0 0 21px;
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
                display: inline-flex;
                @media (max-width: 991.98px) {
                    content: none;
                }
            }
            div {
                @media (max-width: 991.98px) {
                    width: 18px;
                    height: 18px;
                    color: #fff;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 50%;
                    font-size: 14px;
                    line-height: 14px;
                    font-weight: 500;
                }
                @media (max-width: 767.98px) {
                    width: 16px;
                    height: 16px;
                    font-size: 12px;
                    line-height: 12px;
                }
            }
            @media (max-width: 767.98px) {
                border-radius: 12px 0 0 12px;
                padding-left: 10px;
            }
        }
        &:last-child {
            border-radius: 0 21px 21px 0;
            @media (max-width: 767.98px) {
                justify-content: flex-end;
                border-radius: 0 12px 12px 0;
            }
        }
    }
}
.active {
    td::before {
        background-color: #13d60e !important;
    }
    div {
        background-color: #13d60e !important;
    }
}
.unstable {
    td::before {
        background-color: #e9c058 !important;
    }
    div {
        background-color: #e9c058 !important;
    }
}
.unactive {
    td::before {
        background-color: #ff0000 !important;
    }
    div {
        background-color: #ff0000 !important;
    }
}
</style>

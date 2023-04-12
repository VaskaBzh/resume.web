<template>
    <div
        v-scroll="'opacity'"
        class="block block-payment"
        v-if="this.visualType === 'block' && columns.link"
    >
        <span class="main__number">
            {{ this.columns.date }}
        </span>
        <span class="main__number">{{ this.BTCVal }} BTC</span>
        <span ref="link" @click="this.copy" class="main__link">
            {{ this.columns.link }}
        </span>
    </div>
    <tr v-scroll="'opacity'" class="row-income" v-else-if="columns.status">
        <td class="main__number">
            {{ this.columns.date }}
        </td>
        <!--        <td class="main__number">-->
        <!--            {{ this.columns.wallet }}-->
        <!--        </td>-->
        <td class="main__number">
            <div>FPPS+ начисления</div>
        </td>
        <td class="main__number">{{ this.columns.percent }} %</td>
        <td class="main__number">
            {{ this.columns.hash }} {{ this.columns.unit }}
        </td>
        <td class="main__number">{{ this.BTCVal }} BTC</td>
        <td class="main__number" v-if="this.viewportWidth > 991.98">
            {{ Number(this.columns.diff / 1000000000000).toFixed(2) }} T
        </td>
        <td class="main__number" v-if="this.viewportWidth <= 991.98">
            {{ this.columns.message }}
        </td>
        <td class="main__number main__number-status">
            <div v-if="this.viewportWidth > 991.98">
                {{ this.columns.message }}
            </div>
            <span
                :class="this.columns.status"
                v-if="this.viewportWidth > 991.98"
            >
                {{
                    this.columns.status === "rejected"
                        ? "Отклонено"
                        : "Выполнено"
                }}
            </span>
            <span :class="this.columns.status" v-else></span>
        </td>
    </tr>
    <tr v-scroll="'opacity'" class="row-ref-list" v-else-if="columns.email">
        <td class="main__number">{{ this.columns.email }}</td>
        <td class="main__number">{{ this.columns.hash }} TH/s</td>
        <td class="main__number" v-if="this.viewportWidth > 991.98">
            {{ this.columns.middleHash }} TH/s
        </td>
        <td class="main__number" v-if="this.viewportWidth > 991.98">
            {{ this.columns.date }}
        </td>
    </tr>
    <tr v-scroll="'opacity'" class="row-ref" v-else>
        <td class="main__number">
            {{ this.columns.date }}
        </td>
        <td class="main__number">{{ this.BTCVal }} BTC</td>
    </tr>
</template>
<script>
export default {
    name: "table-payment-row",
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
            type: this.columns.type,
            status: this.columns.status,
        };
    },
    computed: {
        BTCVal() {
            return Number(this.columnsArr.earn).toFixed(8);
        },
    },
    methods: {
        copy() {
            navigator.clipboard.writeText(this.$refs.link.innerText);
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        handleInfoChanger() {
            if (this.viewportWidth < 767.98 && this.columns.type) {
                if (this.columns.hash) {
                    this.type = this.type.split(" ").splice(0, 1)[0];
                } else if (this.columns.status) {
                    if (this.type === "Поступление") {
                        this.type = "img-icon-enter.svg";
                    }
                    if (this.status === "Успешно") {
                        this.status = "img-icon-accept.svg";
                    }
                }
            }
        },
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        window.addEventListener("resize", this.handleInfoChanger);
        this.handleResize();
        this.handleInfoChanger();
    },
};
</script>
<style lang="scss" scoped>
.table-block_column {
    td {
        padding: 0 !important;
        height: 17px;
        img {
            left: -18px !important;
            @media (max-width: 320.98px) {
                left: 0 !important;
            }
        }
        div {
            padding: 0 !important;
            img {
                left: 50% !important;
            }
        }
    }
}
.block {
    span {
        text-align: right;
        height: 17px;
    }
}
td {
    background: #ffffff;
    white-space: nowrap;
    padding: 0 10px 0 0;
    div {
        @media (max-width: 767.98px) {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 3px 0 0;
        }
    }
    @media (max-width: 767.98px) {
        padding-right: 10px;
    }
    &:first-child {
        border-radius: 21px 0 0 21px;
        padding-left: 16px;
        @media (max-width: 767.98px) {
            padding: 0 10px;
            border-radius: 12px 0 0 12px;
        }
        @media (max-width: 479.98px) {
            padding: 1px 10px;
        }
    }
    &:last-child {
        text-align: right;
        border-radius: 0 21px 21px 0;
        padding-right: 16px;
        @media (max-width: 767.98px) {
            border-radius: 0 12px 12px 0;
            padding-right: 10px;
        }
    }
    .main__link {
        max-width: 150px;
    }
    span {
        margin-left: 5px;
        @media (max-width: 767.98px) {
            margin: 0;
        }
    }
    img {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        @media (max-width: 479.98px) {
            width: 15px;
            height: 15px;
        }
    }
}
.row-income {
    &_wrap {
        display: inline-flex;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: #dae5f7;
        position: relative;
        @media (max-width: 479.98px) {
            width: 15px;
            height: 15px;
        }
        img {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 10px !important;
            height: 10px !important;
            @media (max-width: 479.98px) {
                width: auto !important;
                height: auto !important;
            }
        }
    }
    td {
        &.main__number-status {
            position: relative;
            cursor: pointer;
            &:hover {
                div {
                    overflow: visible;
                    opacity: 1;
                    z-index: 12;
                    &:after {
                        overflow: visible;
                        opacity: 1;
                    }
                }
            }
            div {
                overflow: hidden;
                opacity: 0;
                z-index: -1;
                transition: all 0.3s ease 0s;
                position: absolute;
                max-width: 200%;
                bottom: 100%;
                right: 0;
                color: #fff;
                white-space: break-spaces;
                padding: 14px 16px;
                background-color: rgba(0, 0, 0, 0.8);
                border-radius: 6px;
                &:after {
                    overflow: hidden;
                    opacity: 0;
                    transition: all 0.3s ease 0s;
                    position: absolute;
                    content: "";
                    clip-path: path(
                        "M 9.849242404917499 24.091883092036785 A 5 5 0 0 1 13.384776310850237 22.627416997969522 L 20.627416997969522 22.627416997969522 A 2 2 0 0 0 22.627416997969522 20.627416997969522 L 22.627416997969522 13.384776310850237 A 5 5 0 0 1 24.091883092036785 9.849242404917499 L 23.091883092036785 9.849242404917499 L 9.849242404917499 23.091883092036785 Z"
                    );
                    background-image: linear-gradient(
                        to right bottom,
                        rgba(0, 0, 0, 0.65),
                        rgba(0, 0, 0, 0.75)
                    );
                    position: absolute;
                    background-repeat: no-repeat;
                    background-position: -10px -10px;
                    //content: url("data:image/svg+xml,%3Csvg width='30' height='15' viewBox='0 0 30 15' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0.85791 0H15H29.1422L15 14.1421L0.85791 0Z' fill='black' fill-opacity='0.5'/%3E%3C/svg%3E%0A");
                    width: 33.9411255px;
                    height: 33.9411255px;
                    top: calc(100% - 5px);
                    left: 50%;
                    z-index: 10;
                    transform: translateX(-50%) translateY(-12px) rotate(45deg);
                }
            }
        }
        &:last-child {
            text-align: left;
        }
        span {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: flex-end;
            font-weight: 500 !important;
            color: #000034 !important;
            font-size: 18px !important;
            line-height: 26px !important;
            &:before {
                content: "";
                position: relative;
                width: 10px;
                height: 10px;
                border-radius: 50%;
            }
            &.completed {
                &:before {
                    background: #13d60e;
                }
            }
            &.rejected {
                &:before {
                    background: #ff0000;
                }
            }
        }
        //&:nth-child(2) {
        //    position: relative;
        //    @media (min-width: 767.98px) {
        //        padding-left: 28px;
        //    }
        //    @media (max-width: 479.98px) {
        //        padding-left: 18px;
        //    }
        //    @media (max-width: 320.98px) {
        //        padding-left: 0;
        //    }
        //    img {
        //        @media (min-width: 767.98px) {
        //            position: absolute;
        //            left: 0;
        //            top: 50%;
        //            transform: translateY(-50%);
        //        }
        //        @media (max-width: 479.98px) {
        //            position: absolute;
        //            left: 0;
        //            top: 50%;
        //            transform: translateY(-50%);
        //        }
        //        @media (max-width: 320.98px) {
        //            position: relative;
        //            transform: none;
        //            left: auto;
        //            top: auto;
        //        }
        //    }
        //}
    }
}

.row-ref {
    &-list {
        td {
            &:last-child {
                text-align: right;
            }
        }
    }
}
</style>

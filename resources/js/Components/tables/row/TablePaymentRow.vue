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
    <tr v-scroll="'opacity'" class="row-history" v-else-if="columns.status">
        <td class="main__number">
            {{ this.columns.date }}
        </td>
        <td class="main__number">
            <img
                :src="
                    'http://127.0.0.1:5173' +
                    `/resources/assets/img/${this.columns.img}`
                "
                alt=""
            />
            {{ this.columns.wallet }}
        </td>
        <td class="main__number">
            <div>
                <div
                    class="row-history_wrap"
                    v-if="this.viewportWidth < 767.98"
                >
                    <img
                        :src="
                            'http://127.0.0.1:5173' +
                            `/resources/assets/img/${this.type}`
                        "
                        :alt="this.type"
                    />
                </div>
                {{ this.columns.type }}
            </div>
        </td>
        <td class="main__number">{{ this.BTCVal }} BTC</td>
        <td class="main__number">
            <div>
                <div
                    class="row-history_wrap"
                    v-if="this.viewportWidth < 767.98"
                >
                    <img
                        :src="
                            'http://127.0.0.1:5173' +
                            `/resources/assets/img/${this.status}`
                        "
                        :alt="this.type"
                    />
                </div>
                {{ this.columns.status }}
            </div>
        </td>
    </tr>
    <tr v-scroll="'opacity'" class="row-accruals" v-else-if="columns.mode">
        <td class="main__number">
            {{ this.columns.date }}
        </td>
        <td class="main__number">{{ this.columns.mode }}</td>
        <td class="main__number">
            {{ this.columns.hash }} {{ this.columns.unit }}H/s
        </td>
        <td class="main__number">{{ this.BTCVal }} BTC</td>
        <td class="main__number" v-if="this.viewportWidth > 991.98">
            {{ Number(this.columns.diff).toFixed(2) }}
        </td>
    </tr>
    <tr v-scroll="'opacity'" class="row-payment" v-else-if="columns.link">
        <td class="main__number">
            {{ this.columns.date }}
        </td>
        <!--        <td class="main__number">{{ this.columns.percent }} %</td>-->
        <td class="main__number">{{ this.columns.earn }} BTC</td>
        <td class="main__number">
            <span :class="this.columns.infoClass">{{ this.columns.info }}</span>
        </td>
        <!--        <td ref="link" @click="this.copy" class="main__link">-->
        <!--            {{ this.columns.link }}-->
        <!--        </td>-->
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
.block-payment {
    span {
        &:last-child {
            margin: 0;
            padding: 0;
            max-width: 136px;
            overflow: hidden;
            text-overflow: ellipsis;
            @media (max-width: 320.98px) {
                max-width: 101px;
            }
        }
    }
}
.row-payment {
    position: relative;
    td {
        &:last-child {
            @media (max-width: 991.98px) {
                text-align: left;
                max-width: 200px;
                overflow-x: hidden;
                text-overflow: ellipsis;
            }
            @media (max-width: 767.98px) {
                max-width: 100%;
                text-align: right;
                text-overflow: clip;
                overflow: visible;
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
                &.pending {
                    &:before {
                        background: #e9c058;
                    }
                }
            }
        }
    }
    span {
        margin-left: 5px;
        @media (max-width: 767.98px) {
            margin: 0;
        }
    }
}
.row-history {
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
        &:last-child {
            text-align: left;
        }
        &:nth-child(2) {
            position: relative;
            @media (min-width: 767.98px) {
                padding-left: 28px;
            }
            @media (max-width: 479.98px) {
                padding-left: 18px;
            }
            @media (max-width: 320.98px) {
                padding-left: 0;
            }
            img {
                @media (min-width: 767.98px) {
                    position: absolute;
                    left: 0;
                    top: 50%;
                    transform: translateY(-50%);
                }
                @media (max-width: 479.98px) {
                    position: absolute;
                    left: 0;
                    top: 50%;
                    transform: translateY(-50%);
                }
                @media (max-width: 320.98px) {
                    position: relative;
                    transform: none;
                    left: auto;
                    top: auto;
                }
            }
        }
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

.row-accruals {
    td {
        &:nth-child(2) {
            cursor: pointer;
            position: relative;
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
                color: #fff;
                position: absolute;
                top: 43%;
                transform: rotate(180deg);
                margin-left: 6px;
                @media (max-width: 767.98px) {
                    content: none;
                }
            }
        }

        &:last-child {
            text-align: right;
        }
    }
}
</style>

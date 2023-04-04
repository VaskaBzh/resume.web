<template>
    <Head title="Воркеры" />
    <div class="hidden">{{ this.allAccounts }}</div>
    <div class="workers">
        <div class="workers__wrapper">
            <main-title tag="h2" enter-class="workers__title">
                Воркеры
            </main-title>
            <div class="workers__filter">
                <div class="workers__filter_wrapper">
                    <!--                    <div class="workers__filter_block">-->
                    <!--                        <div class="workers__filter_label">Отображение</div>-->
                    <!--                        <main-select-->
                    <!--                            class="workers__select"-->
                    <!--                            :options="workersOptions"-->
                    <!--                        >-->
                    <!--                        </main-select>-->
                    <!--                    </div>-->
                    <div class="workers__filter_block">
                        <div class="workers__filter_label">Статус</div>
                        <main-select
                            class="workers__select"
                            :options="statuses"
                        >
                        </main-select>
                    </div>
                </div>
                <span class="workers__button" data-popup="#connect">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="21"
                        height="21"
                        viewBox="0 0 21 21"
                        fill="none"
                    >
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M1.07129 10.0703C1.07129 9.51803 1.519 9.07031 2.07129 9.07031H18.0713C18.6236 9.07031 19.0713 9.51803 19.0713 10.0703C19.0713 10.6226 18.6236 11.0703 18.0713 11.0703H2.07129C1.519 11.0703 1.07129 10.6226 1.07129 10.0703Z"
                        />
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M10.0708 1.0708C10.6231 1.0708 11.0708 1.51852 11.0708 2.0708V18.0708C11.0708 18.6231 10.6231 19.0708 10.0708 19.0708C9.51852 19.0708 9.0708 18.6231 9.0708 18.0708V2.0708C9.0708 1.51852 9.51852 1.0708 10.0708 1.0708Z"
                        />
                    </svg>
                </span>
            </div>
            <wrap-table
                :table="this.table"
                :key="Object.values(this.allAccounts).length"
                type="Воркеры"
                :wait="this.allAccounts"
            />
            <popup-view id="connect" typePopup="connect">
                <form class="form form-popup popup__form">
                    <main-title
                        tag="h2"
                        titleName="Подключиться к allbtc pool"
                    ></main-title>
                    <div class="connecting__block">
                        <div class="connecting__row">
                            1. Настройте ваше устройство согласно представленным
                            ниже данным:
                        </div>
                        <div class="connecting__row connecting__row-copy">
                            Address:
                            <div
                                class="connecting__block-copy copy"
                                ref="linkAddress"
                            >
                                {{ this.linkAddress }}
                                <svg
                                    class="copy-button"
                                    @click="this.copyLink(1)"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >
                                    <path
                                        d="M15 3V6.4C15 6.96005 15 7.24008 15.109 7.45399C15.2049 7.64215 15.3578 7.79513 15.546 7.89101C15.7599 8 16.0399 8 16.6 8H20M10 8H6C4.89543 8 4 8.89543 4 10V19C4 20.1046 4.89543 21 6 21H12C13.1046 21 14 20.1046 14 19V16M16 3H13.2C12.0799 3 11.5198 3 11.092 3.21799C10.7157 3.40973 10.4097 3.71569 10.218 4.09202C10 4.51984 10 5.0799 10 6.2V12.8C10 13.9201 10 14.4802 10.218 14.908C10.4097 15.2843 10.7157 15.5903 11.092 15.782C11.5198 16 12.0799 16 13.2 16H16.8C17.9201 16 18.4802 16 18.908 15.782C19.2843 15.5903 19.5903 15.2843 19.782 14.908C20 14.4802 20 13.9201 20 12.8V7L16 3Z"
                                        stroke-width="2"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </div>
                        </div>
                        <div class="connecting__row connecting__row-copy">
                            Address 1:
                            <div
                                class="connecting__block-copy copy"
                                ref="linkAddress1"
                            >
                                {{ this.linkAddress1 }}
                                <svg
                                    class="copy-button"
                                    @click="this.copyLink(2)"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >
                                    <path
                                        d="M15 3V6.4C15 6.96005 15 7.24008 15.109 7.45399C15.2049 7.64215 15.3578 7.79513 15.546 7.89101C15.7599 8 16.0399 8 16.6 8H20M10 8H6C4.89543 8 4 8.89543 4 10V19C4 20.1046 4.89543 21 6 21H12C13.1046 21 14 20.1046 14 19V16M16 3H13.2C12.0799 3 11.5198 3 11.092 3.21799C10.7157 3.40973 10.4097 3.71569 10.218 4.09202C10 4.51984 10 5.0799 10 6.2V12.8C10 13.9201 10 14.4802 10.218 14.908C10.4097 15.2843 10.7157 15.5903 11.092 15.782C11.5198 16 12.0799 16 13.2 16H16.8C17.9201 16 18.4802 16 18.908 15.782C19.2843 15.5903 19.5903 15.2843 19.782 14.908C20 14.4802 20 13.9201 20 12.8V7L16 3Z"
                                        stroke-width="2"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </div>
                        </div>
                        <div class="connecting__row connecting__row-copy">
                            Address 2:
                            <div
                                class="connecting__block-copy copy"
                                ref="linkAddress2"
                            >
                                {{ this.linkAddress2 }}
                                <svg
                                    class="copy-button"
                                    @click="this.copyLink(3)"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >
                                    <path
                                        d="M15 3V6.4C15 6.96005 15 7.24008 15.109 7.45399C15.2049 7.64215 15.3578 7.79513 15.546 7.89101C15.7599 8 16.0399 8 16.6 8H20M10 8H6C4.89543 8 4 8.89543 4 10V19C4 20.1046 4.89543 21 6 21H12C13.1046 21 14 20.1046 14 19V16M16 3H13.2C12.0799 3 11.5198 3 11.092 3.21799C10.7157 3.40973 10.4097 3.71569 10.218 4.09202C10 4.51984 10 5.0799 10 6.2V12.8C10 13.9201 10 14.4802 10.218 14.908C10.4097 15.2843 10.7157 15.5903 11.092 15.782C11.5198 16 12.0799 16 13.2 16H16.8C17.9201 16 18.4802 16 18.908 15.782C19.2843 15.5903 19.5903 15.2843 19.782 14.908C20 14.4802 20 13.9201 20 12.8V7L16 3Z"
                                        stroke-width="2"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>
                </form>
            </popup-view>
        </div>
    </div>
</template>
<script>
import { Head } from "@inertiajs/vue3";
import MainSelect from "@/Components/UI/MainSelect.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import PopupView from "@/Components/technical/PopupView.vue";
import WrapTable from "@/Components/tables/WrapTable.vue";
import { mapGetters } from "vuex";

export default {
    components: { WrapTable, MainTitle, MainSelect, Head, PopupView },
    layout: profileLayoutView,
    data() {
        return {
            workersActive: 0,
            workersInActive: 0,
            workersDead: 0,
            viewportWidth: 0,
            linkAddress: "btc.all-btc.com:4444",
            linkAddress1: "btc.all-btc.com:3333",
            linkAddress2: "btc.all-btc.com:2222",
            table: {
                titles: [
                    "Имя воркера",
                    "Текущий",
                    // "Ср.хешрейт /1ч",
                    "Ср.хешрейт /24ч",
                    "Частота отказов /24ч",
                ],
                shortTitles: ["Имя", "Текущий", "Ср.хешрейт/1д", "Отказы/1д"],
                rows: [],
                mainRow: {
                    hash: "Общий хешрейт",
                    hashRate: 0,
                    // hashAvarage: 0,
                    hashAvarage24: 0,
                    rejectRate: 0,
                },
                mainShortRow: {
                    hash: "Общий",
                    hashRate: 0,
                    // hashAvarage: 0,
                    hashAvarage24: 0,
                    rejectRate: 0,
                },
            },
            statuses: [
                { title: "Все", value: 1 },
                { title: "Активные", value: 2 },
                { title: "Нестабильные", value: 3 },
                { title: "Неактивные", value: 4 },
            ],
        };
    },
    methods: {
        copyLink(i) {
            if (i === 1) {
                navigator.clipboard.writeText(this.linkAddress);
                this.$refs.linkAddress.classList.add("active");
                setTimeout(() => {
                    this.$refs.linkAddress.classList.remove("active");
                }, 1000);
            } else if (i === 2) {
                navigator.clipboard.writeText(this.linkAddress1);
                this.$refs.linkAddress1.classList.add("active");
                setTimeout(() => {
                    this.$refs.linkAddress1.classList.remove("active");
                }, 1000);
            } else if (i === 3) {
                navigator.clipboard.writeText(this.linkAddress2);
                this.$refs.linkAddress2.classList.add("active");
                setTimeout(() => {
                    this.$refs.linkAddress2.classList.remove("active");
                }, 1000);
            }
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        getWorker() {
            this.table.rows.length = 0;
            if (this.allHash[this.getActive]) {
                Object.values(this.allHash[this.getActive]).forEach((el) => {
                    let workersRowModel = {
                        hashClass: el.status.toLowerCase(),
                        hash: el.name,
                        hashRate: el.shares1m,
                        // hashAvarage: el.shares1h,
                        hashAvarage24: el.shares1d,
                        rejectRate: el.persent,
                        graphId: el.workerId,
                    };
                    this.table.rows.push(workersRowModel);
                });
            }
            if (this.allAccounts[this.getActive]) {
                this.table.mainRow.hashRate =
                    this.allAccounts[this.getActive].shares1m;
                // this.table.mainRow.hashAvarage = acc.shares1h;
                this.table.mainRow.hashAvarage24 =
                    this.allAccounts[this.getActive].shares1d;
                this.table.mainRow.rejectRate =
                    this.allAccounts[this.getActive].rejectRate;
                this.table.mainShortRow.hashRate =
                    this.allAccounts[this.getActive].shares1m;
                // this.table.mainShortRow.hashAvarage = acc.shares1h;
                this.table.mainShortRow.hashAvarage24 =
                    this.allAccounts[this.getActive].shares1d;
                this.table.mainShortRow.rejectRate =
                    this.allAccounts[this.getActive].rejectRate;
            }
        },
    },
    computed: {
        ...mapGetters([
            "getActive",
            "allAccounts",
            "allHash",
            "allHistoryMiner",
        ]),
    },
    updated() {
        this.getWorker();
    },
    mounted() {
        document.title = "Воркеры";
        this.getWorker();
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
};
</script>
<style lang="scss" scoped>
.workers {
    width: 100%;
    @media (min-width: 1271px) {
        padding-left: 330px;
    }
    &__button {
        width: 60px;
        height: 44px;
        border-radius: 13px;
        background-color: #4182ec;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-left: auto;
        transition: all 0.3s ease;
        position: relative;
        @media (max-width: 767.98px) {
            position: absolute;
            top: -96%;
            right: 0;
        }
        @media (max-width: 479.98px) {
            top: -90%;
        }
        &::before {
            content: "";
            position: absolute;
            z-index: -1;
            background: linear-gradient(
                84.14deg,
                rgba(63, 123, 221, 0.27) 8.75%,
                rgba(66, 130, 236, 0.27) 92.01%
            );
            border-radius: 10px;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            transition: all 0.3s ease 0s;
        }
        @media (any-hover: hover) {
            &:hover {
                transform: translate(-4px, -4px);
                &::before {
                    top: 4px;
                    left: 4px;
                }
            }
        }
        &:active {
            @media (min-width: 479.89px) {
                transform: translate(0, 0);
                box-shadow: inset 0px 4px 4px rgba(0, 0, 0, 0.25);
                &::before {
                    top: 0px;
                    left: 0px;
                }
            }
        }
        svg {
            width: 14px;
            height: 14px;
            fill: #fff;
        }
        @media (max-width: 479.89px) {
            background-color: transparent;
            width: 20px;
            height: 20px;

            svg {
                fill: #4182ec;
                width: 18px;
                height: 18px;
            }
        }
    }
    &__filter {
        margin: 16px 0 24px;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        width: 100%;
        gap: 16px;
        @media (max-width: 767.98px) {
            margin: 24px 0 20px;
            justify-content: space-between;
            position: relative;
        }
        &_wrapper {
            display: flex;
            gap: 16px;
            width: 100%;
        }
        &_block {
            max-width: 230px;
            width: 100%;
            @media (max-width: 767.98px) {
                max-width: 100%;
            }
        }
        &_label {
            font-weight: 400;
            font-size: 16px;
            line-height: 23px;
            color: rgba(0, 0, 0, 0.62);
            margin-bottom: 8px;
            @media (max-width: 767.98px) {
                font-size: 14px;
                line-height: 20px;
                color: #818c99;
                margin-bottom: 6px;
            }
        }
    }
    &__select {
        height: 48px;
        @media (max-width: 767.98px) {
            max-width: 100% !important;
        }
        @media (max-width: 479.98px) {
            height: 28px;
        }
        .select_title {
            font-weight: 500;
            font-size: 18px;
            line-height: 26px;
            color: #000034;
            z-index: 2;
        }
    }
}
</style>

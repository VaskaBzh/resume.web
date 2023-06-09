<template>
    <Head :title="$t('workers.title')" />
    <div class="workers profile">
        <div class="workers__wrapper">
            <main-title tag="h2" class="workers__title">
                {{ $t("workers.title") }}
                <Link :href="route('connecting')">
                    <blue-button class="workers__button">
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
                    </blue-button>
                </Link>
            </main-title>
            <!--            <div class="workers__filter">-->
            <!--                <div class="workers__filter_wrapper">-->
            <!--                    <div class="workers__filter_block">-->
            <!--                        <div class="workers__filter_label">Отображение</div>-->
            <!--                        <main-select-->
            <!--                            class="workers__select"-->
            <!--                            :options="workersOptions"-->
            <!--                        >-->
            <!--                        </main-select>-->
            <!--                    </div>-->
            <!--                    <div class="workers__filter_block">-->
            <!--                        <div class="workers__filter_label">-->
            <!--                            {{ $t("workers.select_label") }}-->
            <!--                        </div>-->
            <!--                        <main-select-->
            <!--                            class="workers__select"-->
            <!--                            :options="statuses"-->
            <!--                            @getCoin="useFilter"-->
            <!--                        >-->
            <!--                        </main-select>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <wrap-table
                :table="this.table"
                :key="Object.values(this.allAccounts).length + this.getActive"
                type="Воркеры"
                :wait="this.allAccounts"
                :empty="this.table.rows"
            />
        </div>
    </div>
</template>
<script>
import { Link, router } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import MainSelect from "@/Components/UI/MainSelect.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import WrapTable from "@/Components/tables/WrapTable.vue";
import { mapGetters } from "vuex";
import Vue from "lodash";
import BlueButton from "@/Components/UI/BlueButton.vue";

export default {
    components: {
        WrapTable,
        MainTitle,
        MainSelect,
        Head,
        BlueButton,
        Link,
    },
    layout: profileLayoutView,
    props: ["errors", "message", "user", "auth_user"],
    data() {
        return {
            workersActive: 0,
            workersInActive: 0,
            workersDead: 0,
            viewportWidth: 0,
        };
    },
    methods: {
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        // useFilter(data) {
        //     this.table.rows.length = 0;
        //     if (data !== "all") {
        //         Object.values(this.allHash[this.getActive]).forEach((el) => {
        //             if (el.status.toLowerCase() === data) {
        //                 let workersRowModel = {
        //                     hashClass: el.status.toLowerCase(),
        //                     hash: el.name,
        //                     hashRate: el.shares1m,
        //                     // hashAvarage: el.shares1h,
        //                     hashAvarage24: el.shares1d,
        //                     rejectRate: el.persent,
        //                     graphId: el.workerId,
        //                 };
        //                 this.table.rows.push(workersRowModel);
        //             }
        //         });
        //     } else {
        //         this.getWorker();
        //     }
        // },
    },
    computed: {
        ...mapGetters([
            "getActive",
            "allAccounts",
            "allHash",
            "allHistoryMiner",
        ]),
        copyObject() {
            return [
                {
                    title: this.$t("connection.block.title"),
                    copyObject: [
                        { link: "btc.all-btc.com:4444", title: "Port" },
                        { link: "btc.all-btc.com:3333", title: "Port 1" },
                        { link: "btc.all-btc.com:2222", title: "Port 2" },
                    ],
                },
            ];
        },
        statuses() {
            return [
                { title: this.$t("workers.select[0]"), value: "all" },
                { title: this.$t("workers.select[1]"), value: "active" },
                { title: this.$t("workers.select[2]"), value: "unstable" },
                // { title: "Неактивные", value: "instable" },
            ];
        },
        table() {
            let obj = {
                titles: [
                    this.$t("workers.table.thead[0]"),
                    this.$t("workers.table.thead[1]"),
                    // "Ср.хешрейт /1ч",
                    this.$t("workers.table.thead[2]"),
                    this.$t("workers.table.thead[3]"),
                ],
                shortTitles: [
                    this.$t("workers.table.thead_short[0]"),
                    this.$t("workers.table.thead_short[1]"),
                    this.$t("workers.table.thead_short[2]"),
                    this.$t("workers.table.thead_short[3]"),
                ],
                rows: [],
                mainRow: {
                    hash: this.$t("workers.table.sub_thead"),
                    hashRate: 0,
                    // hashAvarage: 0,
                    hashAvarage24: 0,
                    rejectRate: 0,
                },
                mainShortRow: {
                    hash: this.$t("workers.table.sub_thead"),
                    hashRate: 0,
                    // hashAvarage: 0,
                    hashAvarage24: 0,
                    rejectRate: 0,
                },
            };

            if (this.allHash[this.getActive]) {
                Object.values(this.allHash[this.getActive]).forEach((el, i) => {
                    let workersRowModel = {
                        hashClass: el.status.toLowerCase(),
                        hash: el.name,
                        hashRate: el.shares1m,
                        // hashAvarage: el.shares1h,
                        hashAvarage24: el.shares1d,
                        rejectRate: el.persent,
                        graphId: el.workerId,
                    };
                    Vue.set(obj.rows, i, workersRowModel);
                });
            }

            if (this.allAccounts[this.getActive]) {
                obj.mainRow.hashRate =
                    this.allAccounts[this.getActive].shares1m;
                // this.table.mainRow.hashAvarage = acc.shares1h;
                obj.mainRow.hashAvarage24 =
                    this.allAccounts[this.getActive].shares1d;
                obj.mainRow.rejectRate =
                    this.allAccounts[this.getActive].rejectRate;
                obj.mainShortRow.hashRate =
                    this.allAccounts[this.getActive].shares1m;
                // this.table.mainShortRow.hashAvarage = acc.shares1h;
                obj.mainShortRow.hashAvarage24 =
                    this.allAccounts[this.getActive].shares1d;
                obj.mainShortRow.rejectRate =
                    this.allAccounts[this.getActive].rejectRate;
            }
            return obj;
        },
    },
    mounted() {
        document.title = "Воркеры";
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
};
</script>
<style lang="scss" scoped>
.workers {
    .title {
        display: flex;
        width: 100%;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        position: relative;
    }
    .form .title {
        margin-bottom: 0;
    }
    &__button {
        min-width: 60px;
        min-height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        @media (max-width: 767.98px) {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: -10px;
            &:before {
                content: none;
            }
            &:active {
                transform: translateY(-50%);
            }
        }
        svg {
            width: 14px;
            height: 14px;
            fill: #fff;
        }
        @media (max-width: 479.89px) {
            background: transparent;
            min-width: 40px;
            min-height: 40px;

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
                font-size: 16px;
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

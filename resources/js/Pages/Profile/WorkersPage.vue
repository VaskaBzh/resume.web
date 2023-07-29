<template>
    <Head :title="$t('workers.title')" />
    <div class="workers profile">
        <div class="workers__wrapper">
            <main-title tag="h3" class="cabinet_title">
                {{ $t("workers.title") }}
                <Link :href="route('connecting')">
                    <blue-button class="add">
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M3.07031 12.0706C3.07031 11.5183 3.51803 11.0706 4.07031 11.0706H20.0703C20.6226 11.0706 21.0703 11.5183 21.0703 12.0706C21.0703 12.6229 20.6226 13.0706 20.0703 13.0706H4.07031C3.51803 13.0706 3.07031 12.6229 3.07031 12.0706Z"
                            />
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M12.0703 3.07098C12.6226 3.07098 13.0703 3.5187 13.0703 4.07098V20.071C13.0703 20.6233 12.6226 21.071 12.0703 21.071C11.518 21.071 11.0703 20.6233 11.0703 20.071V4.07098C11.0703 3.5187 11.518 3.07098 12.0703 3.07098Z"
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
                :table="table"
                :key="Object.values(allAccounts).length + getActive"
                type="Воркеры"
                :wait="allAccounts"
                :empty="table.rows"
                :errors="errors"
                :rowsVal="1000"
            />
        </div>
    </div>
</template>
<script>
import { Link } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
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
                    this.$t("workers.table.thead[3]"),
                    this.$t("workers.table.thead[4]"),
                ],
                rows: [{}],
            };

            if (this.allAccounts[this.getActive]) {
                obj.rows[0] = {
                    class: "main",
                    hash: this.$t("workers.table.sub_thead"),
                    hashRate: this.allAccounts[this.getActive].shares1m,
                    unit: this.allAccounts[this.getActive].unit,
                    hashRate24: this.allAccounts[this.getActive].shares1d,
                    unit24: this.allAccounts[this.getActive].unit,
                    rejectRate: this.allAccounts[this.getActive].rejectRate,
                };
            }

            if (this.allHash[this.getActive]) {
                Object.values(this.allHash[this.getActive]).forEach((el, i) => {
                    let workersRowModel = {
                        class: el.status.toLowerCase(),
                        hash: el.name,
                        hashRate: el.shares1m,
                        hashRate24: el.shares1d,
                        unit: el.unit,
                        unit24: el.unit1d,
                        rejectRate: el.persent,
                        graphId: el.workerId,
                        data: "#seeChart",
                    };
                    Vue.set(obj.rows, i + 1, workersRowModel);
                });
            }
            return obj;
        },
    },
    mounted() {
        document.title = this.$t("header.links.workers");
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
};
</script>
<style lang="scss" scoped>
.workers {
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

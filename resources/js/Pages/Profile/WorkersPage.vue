<template>
    <Head title="Воркеры" />
    <div class="workers">
        <div class="workers__wrapper">
            <main-title tag="h2" enter-class="workers__title">
                Воркеры
            </main-title>
            <div class="workers__filter">
                <div class="workers__filter_wrapper">
                    <div class="workers__filter_block">
                        <div class="workers__filter_label">Отображение</div>
                        <main-select
                            class="workers__select"
                            :options="workersOptions"
                        >
                        </main-select>
                    </div>
                    <div class="workers__filter_block">
                        <div class="workers__filter_label">Статус</div>
                        <main-select
                            class="workers__select"
                            :options="statuses"
                        >
                        </main-select>
                    </div>
                </div>
                <span class="workers__button">
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
            <wrap-table :table="this.table" type="Воркеры" />
        </div>
    </div>
</template>
<script>
import { Head } from "@inertiajs/vue3";
import MainSelect from "@/Components/UI/MainSelect.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import WrapTable from "@/Components/tables/WrapTable.vue";

export default {
    components: { WrapTable, MainTitle, MainSelect, Head },
    layout: profileLayoutView,
    data() {
        return {
            viewportWidth: 0,
            table: {
                titles: [
                    "Имя воркера",
                    "Текущий",
                    "Ср.хешрейт /1ч",
                    "Ср.хешрейт /24ч",
                    "Частота отказов /24ч",
                ],
                shortTitles: ["Имя", "Текущий", "Ср.хешрейт/1д", "Отказы/1д"],
                rows: [
                    {
                        hashClass: "active",
                        hash: 1,
                        hashRate: 171.7,
                        hashAvarage: 171.7,
                        hashAvarage24: 171.7,
                        rejectRate: 0.16,
                    },
                    {
                        hashClass: "unstable",
                        hash: 4,
                        hashRate: 171.7,
                        hashAvarage: 171.7,
                        hashAvarage24: 171.7,
                        rejectRate: 0.16,
                    },
                    {
                        hashClass: "unactive",
                        hash: 8,
                        hashRate: 171.7,
                        hashAvarage: 171.7,
                        hashAvarage24: 171.7,
                        rejectRate: 0.16,
                    },
                ],
                mainRow: {
                    hash: "Общий хешрейт",
                    hashRate: 171.7,
                    hashAvarage: 171.7,
                    hashAvarage24: 171.7,
                    rejectRate: 0,
                },
                mainShortRow: {
                    hash: "Общий",
                    hashRate: 171.7,
                    hashAvarage: 171.7,
                    hashAvarage24: 171.7,
                    rejectRate: 0,
                },
            },
            workersOptions: [
                { title: "По одиночке", value: 1 },
                { title: "Bitcoin Cash", value: 2 },
                { title: "Litecoin", value: 3 },
                { title: "Dash", value: 4 },
            ],
            statuses: [
                { title: "Все", value: 1 },
                { title: "Активные", value: 2 },
                { title: "Нестабильные", value: 3 },
                { title: "Неактивные", value: 4 },
            ],
        };
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
    mounted() {
        document.title = "Воркеры";
    },
};
</script>
<style lang="scss" scoped>
.workers {
    width: 100%;
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

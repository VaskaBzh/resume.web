<template>
    <div class="workers">
        <div class="workers__wrapper">
            <div class="cards-container">
                <main-hashrate-cards />
            </div>
            <wrap-table
                :table="worker_service.table"
                :key="changedActive"
                :wait="worker_service.waitWorkers"
                :empty="worker_service.rows"
                :worker_service="worker_service"
                :rowsVal="1000"
            />
        </div>
    </div>
</template>
<script>
import WrapTable from "@/Components/tables/WrapTable.vue";
import { mapGetters } from "vuex";
import { WorkerService } from "@/services/WorkerService";
import MainHashrateCards from "@/modules/common/Components/UI/MainHashrateCards.vue";

export default {
    components: {
    WrapTable,
    MainHashrateCards
},
    data() {
        return {
            workersActive: 0,
            workersInActive: 0,
            workersDead: 0,
            viewportWidth: 0,
            changedActive: -1,
            worker_service: new WorkerService(this.$t, [0, 1, 3, 4]),
        };
    },
    watch: {
        getActive(newActive, oldActive) {
            this.changedActive = oldActive === -1 ? -1 : newActive;
            this.initWorkers();
        },
    },
    methods: {
        async initWorkers() {
            await this.worker_service.fillTable();
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
    },
    computed: {
        ...mapGetters([
            "getActive",
            "allAccounts",
            "allHash",
            "allHistoryMiner",
            "getAccount",
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
    },
    mounted() {
        this.initWorkers();

        document.title = this.$t("header.links.workers");
    },
    created() {
        window.addEventListener("resize", this.handleResize);

        this.handleResize();
    },
};
</script>
<style lang="scss" scoped>
.cards-container{
    display: flex;
    justify-content: space-between;
    margin-bottom: 32px;
}
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

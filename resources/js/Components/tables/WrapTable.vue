<template>
    <div class="wrap wrap-no-padding">
        <div class="wrap__head">
            <main-title tag="h3" v-if="this.title"
                >{{ this.title }}
            </main-title>
            <span
                v-else-if="
                    this.viewportWidth < 767.98 && this.type !== 'Платежи'
                "
                class="wrap__head_elem"
                >Отображать в виде</span
            >
            <div
                class="legend"
                v-if="this.viewportWidth > 767.98 && this.legend"
            >
                <div class="legend_elem legend_elem-active">
                    {{ $t("worker_statuses.active") }}: {{ this.active }}
                </div>
                <div class="legend_elem legend_elem-unstable">
                    {{ $t("worker_statuses.unstable") }}: {{ this.unstable }}
                </div>
                workers
                <div class="legend_elem legend_elem-unActive">
                    {{ $t("worker_statuses.inactive") }}: {{ this.unActive }}
                </div>
                <div class="legend_elem legend_elem-all">
                    {{ $t("worker_statuses.all") }}: {{ this.all }}
                </div>
            </div>
            <div
                class="wrap__head-usability"
                v-if="this.viewportWidth < 767.98 && this.type !== 'Платежи'"
            >
                <div
                    ref="block"
                    @click="this.visualType = 'block'"
                    class="wrap__head-usability_elem"
                >
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div
                    ref="table"
                    @click="this.visualType = 'table'"
                    class="wrap__head-usability_elem"
                >
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="no-info" v-if="this.bool">
            <div class="propeller"></div>
        </div>
        <div class="no-info" v-else-if="this.boolFalse">
            <img src="../../../assets/img/img_no-info.png" alt="no_info" />
            <span>{{ $t("no_info") }}</span>
        </div>
        <div
            class="wrap-overflow wrap-overflow-scrollY"
            v-else-if="
                (this.title === 'Воркеры' && this.visualType === 'block') ||
                (this.type === 'Воркеры' && this.visualType === 'block')
            "
        >
            <workers-table
                :key="this.boolFalse + this.allIncomeHistory"
                :table="this.table"
                :visualType="this.visualType"
                @graph_render="this.graphRender"
            />
        </div>
        <div
            class="wrap-overflow"
            v-else-if="this.title === 'Воркеры' || this.type === 'Воркеры'"
        >
            <workers-table
                :key="this.boolFalse + this.allIncomeHistory"
                :table="this.table"
                :visualType="this.visualType"
                @graph_render="this.graphRender"
            />
        </div>
        <div
            class="wrap-overflow wrap-overflow-scrollY"
            v-else-if="this.first >= 0 && this.visualType === 'block'"
        >
            <payment-table
                :key="this.boolFalse + this.allIncomeHistory"
                :table="this.table"
                :visualType="this.visualType"
                :first="this.first"
                :rows-val="this.rowsVal"
            />
        </div>
        <div class="wrap-overflow" v-else-if="this.first >= 0">
            <payment-table
                :key="this.boolFalse + this.allIncomeHistory"
                :table="this.table"
                :visualType="this.visualType"
                :first="this.first"
                :rows-val="this.rowsVal"
            />
        </div>
        <div
            class="wrap-overflow wrap-overflow-scrollY"
            v-else-if="this.visualType === 'block'"
        >
            <payment-table :table="this.table" :visualType="this.visualType" />
        </div>
        <div class="wrap-overflow" v-else>
            <payment-table :table="this.table" :visualType="this.visualType" />
        </div>
        <Link
            class="main__link"
            v-if="!this.table.rows"
            :href="route(`${this.link}`)"
        >
        </Link>
        <Link
            class="main__link"
            v-else-if="this.link"
            :href="route(`${this.link}`)"
        >
            Расширенная страница {{ this.linkText }}
        </Link>
    </div>
</template>
<script>
import { Link, router } from "@inertiajs/vue3";
import PaymentTable from "@/Components/tables/PaymentTable.vue";
import MainTitle from "@/components/UI/MainTitle.vue";
import WorkersTable from "@/Components/tables/WorkersTable.vue";
import { mapGetters } from "vuex";

export default {
    emits: ["graph_render"],
    components: { WorkersTable, MainTitle, PaymentTable, Link },
    props: {
        table: Object,
        legend: Boolean,
        legendVal: Array,
        title: String,
        type: String,
        link: String,
        linkText: String,
        first: Number,
        rowsVal: Number,
        wait: Object,
        empty: Object,
    },
    data() {
        return {
            visualType: "table",
            viewportWidth: 0,
            index: localStorage.active,
            accounts: [],
        };
    },
    computed: {
        ...mapGetters(["allIncomeHistory"]),
        bool() {
            if (!this.boolFalse) {
                return this.table.rows.length === 0;
            }
            return false;
        },
        boolFalse() {
            if (
                this.table.rows.length === 0 &&
                this.wait &&
                Object.keys(this.wait).length
            ) {
                return Object.keys(this.wait).length > 0;
            }
            return false;
        },
        active() {
            let val = 0;
            if (this.legendVal.length > 0) {
                this.accounts.forEach((acc) => {
                    if (acc.indexWorker == this.index) {
                        val = acc.workersActive;
                    }
                });
            }
            return val;
        },
        unActive() {
            let val = 0;
            if (this.legendVal.length > 0) {
                this.accounts.forEach((acc) => {
                    if (acc.indexWorker == this.index) {
                        val = acc.workersInActive;
                    }
                });
            }
            return val;
        },
        unstable() {
            let val = 0;
            if (this.legendVal.length > 0) {
                this.accounts.forEach((acc) => {
                    if (acc.indexWorker == this.index) {
                        val = acc.workersDead;
                    }
                });
            }
            return val;
        },
        all() {
            let val = 0;
            if (this.legendVal.length > 0) {
                this.accounts.forEach((acc) => {
                    if (acc.indexWorker == this.index) {
                        val = acc.workersAll;
                    }
                });
            }
            return val;
        },
    },
    methods: {
        graphRender(key) {
            this.$emit("graph_render", key);
        },
        router() {
            return router;
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        vsType() {
            if (this.viewportWidth < 767.98 && this.type !== "Платежи") {
                if (this.visualType === "block") {
                    this.$refs.block.classList.add("active");
                    this.$refs.table.classList.remove("active");
                } else {
                    this.$refs.table.classList.add("active");
                    this.$refs.block.classList.remove("active");
                }
            }
        },
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    mounted() {
        this.vsType();
    },
    updated() {
        this.vsType();
    },
};
</script>
<style lang="scss" scoped>
.wrap {
    transition: all 0.3s ease 0s;
    .no-info {
        margin-top: 12px;
    }
}
</style>

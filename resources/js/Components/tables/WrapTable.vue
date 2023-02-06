<template>
    <div class="wrap wrap-no-padding">
        <div class="wrap_head">
            <main-title tag="h3" v-if="this.title"
                >{{ this.title }}
            </main-title>
            <span v-else-if="this.viewportWidth < 767.98" class="wrap_head_elem"
                >Отображать в виде</span
            >
            <div
                class="legend"
                v-if="this.viewportWidth > 767.98 && this.legend"
            >
                <div class="legend_elem legend_elem-active">
                    Активные: {{ this.active }}
                </div>
                <div class="legend_elem legend_elem-unstable">
                    Ы Нестабильные: {{ this.unstable }}
                </div>
                <div class="legend_elem legend_elem-unActive">
                    Неактивные: {{ this.unActive }}
                </div>
                <div class="legend_elem legend_elem-all">
                    Все: {{ this.all }}
                </div>
            </div>
            <div class="wrap_head-usability" v-if="this.viewportWidth < 767.98">
                <div
                    ref="block"
                    @click="this.visualType = 'block'"
                    class="wrap_head-usability_elem"
                >
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div
                    ref="table"
                    @click="this.visualType = 'table'"
                    class="wrap_head-usability_elem"
                >
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <div
            class="wrap-overflow wrap-overflow-scrollY"
            v-if="
                (this.title === 'Воркеры' && this.visualType === 'block') ||
                (this.type === 'Воркеры' && this.visualType === 'block')
            "
        >
            <workers-table :table="this.table" :visualType="this.visualType" />
        </div>
        <div
            class="wrap-overflow"
            v-else-if="this.title === 'Воркеры' || this.type === 'Воркеры'"
        >
            <workers-table :table="this.table" :visualType="this.visualType" />
        </div>
        <div
            class="wrap-overflow wrap-overflow-scrollY"
            v-else-if="this.first >= 0 && this.visualType === 'block'"
        >
            <payment-table
                :table="this.table"
                :visualType="this.visualType"
                :first="this.first"
                :rows-val="this.rowsVal"
            />
        </div>
        <div class="wrap-overflow" v-else-if="this.first >= 0">
            <payment-table
                :table="this.table"
                :visualType="this.visualType"
                :first="this.first"
                :rows-val="this.rowsVal"
            />
        </div>
        <div class="wrap-overflow" v-else-if="this.visualType === 'block'">
            <payment-table :table="this.table" :visualType="this.visualType" />
        </div>
        <div class="wrap-overflow wrap-overflow-scrollY" v-else>
            <payment-table :table="this.table" :visualType="this.visualType" />
        </div>
        <Link class="main__link" v-if="this.link" :to="`/${this.link}`">
            Расширенная страница {{ this.linkText }}
        </Link>
    </div>
</template>
<script>
import PaymentTable from "@/Components/tables/PaymentTable.vue";
import WorkersTable from "@/Components/tables/WorkersTable.vue";

export default {
    components: { WorkersTable, PaymentTable },
    props: {
        table: Object,
        legend: Boolean,
        title: String,
        type: String,
        link: String,
        linkText: String,
        first: Number,
        rowsVal: Number,
    },
    data() {
        return {
            visualType: "table",
            viewportWidth: 0,
        };
    },
    computed: {
        active() {
            let val = 0;
            for (let i = 0; i < this.table.rows.length; i++) {
                if (this.table.rows[i].hashClass === "active") {
                    val = this.table.rows[i].hash;
                }
            }
            return val;
        },
        unActive() {
            let val = 0;
            for (let i = 0; i < this.table.rows.length; i++) {
                if (this.table.rows[i].hashClass === "unactive") {
                    val = this.table.rows[i].hash;
                }
            }
            return val;
        },
        unstable() {
            let val = 0;
            for (let i = 0; i < this.table.rows.length; i++) {
                if (this.table.rows[i].hashClass === "unstable") {
                    val = this.table.rows[i].hash;
                }
            }
            return val;
        },
        all() {
            return this.active + this.unActive + this.unstable;
        },
    },
    methods: {
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        vsType() {
            if (this.viewportWidth < 767.98) {
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
<style lang="scss" scoped></style>

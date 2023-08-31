<template>
    <div>
        <div class="cabinet__head" v-if="title">
            <main-title tag="h3" v-if="title">{{ title }}</main-title>
        </div>
        <no-info
            :wait="waitTable"
            :interval="35"
            :end="!waitTable"
            :empty="emptyTable"
        ></no-info>
        <div class="cabinet__block-scroll" v-if="!waitTable && !emptyTable">
            <main-table
                :viewportWidth="viewportWidth"
                :table="table"
                :worker_service="worker_service"
            ></main-table>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import { mapGetters } from "vuex";
import NoInfo from "@/Components/technical/blocks/NoInfo.vue";
import MainTable from "@/Components/tables/MainTable.vue";

export default {
    components: { MainTitle, NoInfo, MainTable },
    emits: ["graph_render"],
    props: {
        table: Object,
        title: String,
        first: Number,
        rowsVal: Number,
        wait: Boolean,
        empty: Array,
        worker_service: {
            type: Object,
            default: {},
        },
    },
    data() {
        return {
            viewportWidth: 0,
            accounts: [],
            waitTable: true,
        };
    },
    computed: {
        ...mapGetters(["getActive"]),
        emptyTable() {
            if (this.empty && this.empty[0]?.class === "main") {
                return this.empty ? this.empty?.length === 1 && !this.waitTable : !this.waitTable;
            }

            return this.empty ? this.empty?.length === 0 && !this.waitTable : !this.waitTable;
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
    watch: {
        wait(newValue) {
            this.waitTable = newValue ?? true;
        }
    },
    mounted() {
        if (!this.wait) this.waitTable = this.wait;
    },
};
</script>
<style lang="scss" scoped>
.cabinet__head {
    margin-bottom: 16px;
    .usability_elem {
        display: grid;
        grid-template-rows: repeat(2, 1fr);
        width: 19px;
        height: 19px;
        gap: 1px;
        box-sizing: border-box;
        &:first-child {
            grid-template-columns: repeat(2, 1fr);
        }
        span {
            width: 100%;
            height: 100%;
            border-radius: 2px;
            box-sizing: border-box;
            border: 2px solid #818c99;
            transition: all 0.3s ease 0s;
        }
        &.active {
            span {
                border: 2px solid #4182ec;
            }
        }
    }
}
.wrap {
    &_row {
        display: flex;
        gap: 8px;
    }
}
</style>

<template>
    <div>
        <div class="cabinet__head" v-if="title">
            <main-title tag="h3" v-if="title">{{ title }}</main-title>
        </div>
        <no-info
            :wait="waitTable"
            :interval="35"
            :end="endTable"
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
        empty: Object,
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
        endTable() {
            return !this.wait;
        },
        emptyTable() {
            if (this.empty && this.empty[0]?.class === "main") {
                return this.empty ? this.empty?.length === 1 : !this.wait;
            }
            return this.empty ? this.empty?.length === 0 : !this.wait;
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
    mounted() {
        if (!this.wait) this.waitTable = false;
    },
    watch: {
        endTable(val) {
            if (val) setTimeout(() => (this.waitTable = false), 300);
        },
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

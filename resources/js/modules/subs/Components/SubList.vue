<template>
    <div class="sub">
        <div class="sub__list" v-show="subsType">
            <sub-block
                v-for="(subData, i) in allAccounts"
                :key="i"
                :subData="subData"
            />
<!--            <add-block />-->
        </div>
        <div class="sub__table" v-show="!subsType">
            <main-slider
                class="income__slider"
                :wait="wait"
                :empty="empty"
                rowsNum="1000"
                :haveNav="false"
            >
                <main-table
                    :table="table"
                />
            </main-slider>
        </div>
    </div>
</template>

<script>
import MainSlider from "@/modules/slider/Components/MainSlider.vue";
import MainTable from "@/Components/tables/MainTable.vue";
import SubBlock from "@/modules/subs/Components/SubBlock.vue";
import { mapGetters } from "vuex";
import AddBlock from "@/modules/subs/Components/AddBlock.vue";

export default {
    name: "sub-list",
    computed: {
        ...mapGetters(["allAccounts"]),
    },
    props: {
        table: Object,
        wait: Boolean,
        empty: Boolean,
        subsType: Boolean,
    },

    components: {
        AddBlock,
        SubBlock,
        MainSlider,
        MainTable,
    }
}
</script>

<style scoped>
.sub {
    width: 100%;
}
.sub__list {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    width: 100%;
}
.sub__table {
    width: 100%;
}
</style>

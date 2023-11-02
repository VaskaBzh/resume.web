<template>
    <div class="sub">
        <subs-no-info
            v-show="empty"
        />
        <div class="sub__list" v-show="subsType && table.get('rows').length > 0">
            <sub-block
                v-for="(subData, i) in table.get('rows')"
                :key="i"
                :subData="subData"
            />
        </div>
        <div class="sub__table" v-show="!subsType && table.get('rows').length > 0">
            <main-slider
                class="sub__slider"
                :wait="false"
                :empty="false"
                rowsNum="1000"
                :haveNav="false"
            >
                <main-table
                    :table="table"
                >
                    <template v-slot:is>
                        <subs-row
                            v-for="(row, i) in table.get('rows')"
                            :columns="row"
                            :titles="table.get('titles')"
                            :key="i"
                            :class="row.class ?? null"
                        ></subs-row>
                    </template>
                </main-table>
            </main-slider>
        </div>
    </div>
</template>

<script>
import MainSlider from "@/modules/slider/Components/MainSlider.vue";
import MainTable from "@/modules/table/Components/blocks/MainTable.vue";
import SubsRow from "@/modules/table/Components/SubsRow.vue";
import TableTitles from "@/modules/table/Components/TableTitles.vue";
import SubBlock from "@/modules/subs/Components/SubBlock.vue";
import AddBlock from "@/modules/subs/Components/AddBlock.vue";
import SubsNoInfo from "@/modules/subs/Components/SubsNoInfo.vue";

export default {
    name: "sub-list",
    props: {
        table: Object,
        empty: Boolean,
        subsType: Boolean,
    },
    components: {
        AddBlock,
        SubBlock,
        MainSlider,
        MainTable,
        TableTitles,
        SubsRow,
        SubsNoInfo,
    }
}
</script>

<style scoped>
.sub {
    width: 100%;
    display: flex;
    flex-direction: column;
    flex: 1 1 auto;
}
.sub__list {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    width: 100%;
}
.sub__table {
    width: 100%;
    flex: 1 1 auto;
}

@media(max-width: 1000px) {
    .sub__list {
        display: flex;
        flex-flow: column nowrap;
    }
}

@media(max-width: 1200px) {
    .sub__list {
        display: flex;
        grid-template-columns: unset;
        flex-flow: row wrap;
    }
}


</style>

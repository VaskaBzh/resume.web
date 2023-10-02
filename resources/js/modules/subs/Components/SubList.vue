<template>
    <div class="sub">
        <div class="sub__list">

        </div>
        <div class="sub__list">
            <main-slider
                class="income__slider"
                :wait="wait"
                :empty="empty"
                rowsNum="1000"
                :haveNav="false"
            >
                <main-table
                    :table="table"
                ></main-table>
            </main-slider>
        </div>
    </div>
</template>

<script>
import MainSlider from "@/modules/slider/Components/MainSlider.vue";
import MainTable from "@/Components/tables/MainTable.vue";

export default {
    name: "sub-list",
    props: {
        table: Object,
        wait: Boolean,
        empty: Boolean,
    },
    components: {
        MainSlider,
        MainTable,
    }
}
</script>

<style scoped>
.sub {
    width: 100%;
}
</style>

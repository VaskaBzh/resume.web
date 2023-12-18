<template>
    <tr class="table__row">
        <row-column
            v-for="(column, i) in service.filteredColumns"
            :value="column"
            :title="service.filteredTitles[i]"
        />
    </tr>
</template>

<script>
import RowColumn from "@/modules/table/Components/UI/RowColumn.vue";
import { RowService } from "@/modules/table/services/RowService";
import { mapGetters } from "vuex";

export default {
    name: "TableRow",
    components: {
        RowColumn,
    },
    props: {
        columns: Array,
        titles: Array,
        removePercent: Boolean,
    },
    computed: {
        ...mapGetters(["viewportWidth"]),
    },
    data() {
        return {
            service: new RowService(),
        };
    },
    watch: {
        columns(newColumns) {
            this.service.rowProcess(newColumns, this.titles);
        },
        titles(newTitles) {
            this.service.rowProcess(this.columns, newTitles);
        },
    },
    mounted() {
        this.service.rowProcess(this.columns, this.titles);
    },
};
</script>

<style scoped></style>

<template>
    <tr class="table__row">
        <title-column
            v-for="(title, i) in titles"
            :key="i"
            class="column"
            :title="title"
            :title-index="i"
            :title-length="titles.length"
        />
    </tr>
</template>

<script>
import TitleColumn from "@/modules/table/Components/UI/TitleColumn.vue";

export default {
    name: "TableTitles",
    components: {
        TitleColumn,
    },
    props: {
        titles: Array,
    },
};
</script>

<style scoped lang="scss">
.table {
    &__row {
        &-income {
            .column {
                padding-right: 24px;
            }
        }
    }
}
</style>

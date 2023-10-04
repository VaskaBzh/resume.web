<template>
    <th class="column">
        <span class="column_value">{{ title }}</span>
        <span class="column__block" v-show="$slots">
            <slot />
        </span>
    </th>
</template>

<script>
export default {
    name: "title-column",
    props: {
        title: String,
    }
}
</script>

<style scoped>
.column {
    height: 40px;
}
.column:first-child .column_value {
    padding-left: 12px;
}
.column_value {
    color: var(--text-table-title, #43474E);
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
    padding-top: 8px;
}
.column__block {
    margin-left: 8px;
    display: inline-flex;
}
</style>

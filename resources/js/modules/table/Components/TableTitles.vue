<template>
	<tr class="table__row">
		<title-column v-for="(title, i) in titles" :title="title" :key="i">

		</title-column>
	</tr>
</template>

<script>
import TitleColumn from "@/modules/table/Components/UI/TitleColumn.vue";

export default {
	name: "table-titles",
	props: {
		titles: Array,
	},
	components: {
		TitleColumn,
	},
}
</script>

<style scoped>

</style>

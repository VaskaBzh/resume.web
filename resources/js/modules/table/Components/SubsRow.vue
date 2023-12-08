<template>
	<tr
		class="table__row"
		:class="{
			'table__row-active': getActive === columns.group_id,
			'table__row-cursor': !!columns.group_id,
		}"
		@click="$store.dispatch('set_active_in_list', { index: service.group_id[1] })"
	>
		<row-column
			v-for="(column, i) in service.filteredColumns"
            :key="i"
			:value="column[1]"
			:columnKey="column[0]"
		/>
	</tr>
</template>

<script>
import RowColumn from "@/modules/table/Components/UI/RowColumn.vue";
import OpenListIcon from "@/modules/common/icons/OpenListIcon.vue";
import { RowService } from "@/modules/table/services/RowService";
import { mapGetters } from "vuex";

export default {
	name: "subs-row",
	components: {
		OpenListIcon,
		RowColumn
	},
	props: {
		columns: Array,
		titles: Array,
		removePercent: Boolean,
	},
	computed: {
		...mapGetters(["viewportWidth", "getActive"]),
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
        console.log(ge)
		this.service.rowProcess(this.columns, this.titles);
	},
};
</script>

<style>
.table__row tbody .column:first-child .column_value {
	position: relative;
	cursor: pointer;
}
.table__row .column:first-child .column_value:before {
	content: '';
	position: absolute;
	left: 0;
	top: 50%;
	transform: translateY(-50%);
	transition: all 0.5s ease 0s;
	width: 3px;
	height: 28px;
	border-radius: 0 4px 4px 0;
	background: var(--text-focus, #2E90FA);
	opacity: 0;
}
.table__row-cursor {
	cursor: pointer;
}
@media (max-width: 767.98px) {
	.table__row-cursor {
		border-color: transparent;
		border-style: solid;
		border-width: 1px;
	}
	.table__row-cursor:hover {
		border-color: var(--states-broder-hover, #43474E);
	}
}
@media (min-width: 767.98px) {
	.table__row-cursor:hover .column {
		border-color: var(--states-broder-hover, #43474E);
	}
}
.table__row-active .column:first-child .column_value {
	color: var(--text-focus, #2E90FA);
}
.table__row-active .column:first-child .column_value:before {
	opacity: 1;
}
</style>

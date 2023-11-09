<template>
	<div class="buttons" v-if="viewportWidth > 768">
        <button
            class="buttons_button"
            :class="{
				'buttons_button-active': !subsType
			}"
            @click.prevent="$emit('changeType', false)"
        >
            <table-icon class="button_icon" />

        </button>
		<button
			class="buttons_button"
			:class="{
				'buttons_button-active': subsType
			}"
			@click.prevent="$emit('changeType', true)"
		>
			<block-icon class="button_icon" />
		</button>
	</div>
</template>

<script>
import BlockIcon from "@/modules/subs/icons/BlockIcon.vue";
import TableIcon from "@/modules/subs/icons/TableIcon.vue";
import {mapGetters} from "vuex";

export default {
	name: "sub-type-buttons",
	components: {
		TableIcon,
		BlockIcon
	},
	props: {
		subsType: Boolean,
	},
    computed: {
        ...mapGetters(["viewportWidth"]),
    },
    watch: {
       viewportWidth(newVal, newOld) {
           if(newVal <= 768) {
               this.$emit('changeType', true)
           }
       }
    }
}
</script>

<style scoped>
.buttons {
    height: 40px;
	display: flex;
	align-items: center;
	border-radius: var(--surface-border-radius-radius-s-md, 12px);
	background: var(--buttons-fourth-fill-border-default, #F2F4F7);
	box-shadow: 0 2px 12px -5px rgba(16, 24, 40, 0.02);
}
.buttons_button {
	transition: all 0.5s ease 0s;
	background: transparent;
	display: inline-flex;
	min-height: 100%;
	min-width: 78px;
	align-items: center;
	justify-content: center;
	border-radius: var(--surface-border-radius-radius-s-md, 12px);
	padding: 0 8px;
}
.buttons_button-active {
	background: var(--background-island, #FFF);
	box-shadow: 0 2px 12px -5px rgba(16, 24, 40, 0.02);
}
.buttons_button-active .button_icon {
	stroke: var(--buttons-tabs-text-focus, #2E90FA);
}
.button_icon {
	transition: all 0.5s ease 0s;
	width: 24px;
	height: 24px;
	stroke: var(--icons-secondary, #D0D5DD);
}
</style>

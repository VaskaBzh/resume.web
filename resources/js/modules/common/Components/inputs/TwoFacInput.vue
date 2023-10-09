<template>
	<div class="row">
		<label class="row_label">
			{{ inputLabel }}
		</label>
		<div class="row_input">
			<input-section
				v-for="(section, i) in sections"
				:key="i"
				:index="i"
				:length="sections.length - 1"
				:focus="section.focus"
				@setNumber="getValue($event)"
				@getBack="setFocus($event)"
			/>
		</div>
	</div>
</template>

<script>
import InputSection from "@/modules/common/Components/inputs/UI/InputSection.vue";

export default {
	name: "two-fac-input",
	props: {
		inputLabel: String,
	},
	components: {
		InputSection
	},
	data() {
		return {
			sections: [
				{
					focus: true,
				},
				{
					focus: false,
				},
				{
					focus: false,
				},
				{
					focus: false,
				},
				{
					focus: false,
				},
				{
					focus: false,
				},
				{
					focus: false,
				},
			],
			form: {
				two_fa_secret: "",
			},
		};
	},
	methods: {
		setFocus(index) {
			this.sections.forEach(section => section.focus = false);

      if (index >= 0 && index <= this.sections.length - 1) {
        this.sections[index].focus = true;
      }
		},
    getValue(data) {
      this.setFocus(data.index);

      if (data.index !== this.sections.length - 1) {
        this.form.two_fa_secret += data.value;
        console.log(this.form.two_fa_secret)
      }
    }
	},
	watch: {
		two_fa_secret(newValue) {
      console.log(newValue)
			this.$emit("getSecret", newValue);
		},
	},
}
</script>

<style scoped>
.row {
	display: flex;
	flex-direction: column;
	gap: 8px;
}
.row_input {
	display: flex;
	align-items: center;
	min-height: 56px;
	gap: 12px;
}
.row_label {
	color: var(--text-teritary, #98A2B3);
	font-family: NunitoSans, serif;
	font-size: 12px;
	font-weight: 400;
	line-height: 16px;
}
</style>

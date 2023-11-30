<template>
  <input
  	type="text"
  	class="input_section"
  	ref="input"
  	v-model="number"
    :class="{
      'input-opacity': length === index,
    }"
  />
</template>

<script>
export default {
	name: "input-section",
	props: {
		index: Number,
    length: Number,
		focus: Number,
	},
	data() {
		return {
			number: "",
		};
	},
	watch: {
		focus(newFocusState) {
			if (newFocusState) {
				this.$refs.input.focus();
			}
		},
		number(newNumberValue, oldNumberValue) {
			if (
          newNumberValue.length === 0
          && oldNumberValue.length > 0
      ) {
        return;
			}

			if (newNumberValue.length <= 1) {
				this.$emit("setNumber", {
					index: this.index + 1,
					value: newNumberValue,
				});
			} else {
				this.number = oldNumberValue;
			}
		}
	},
  methods: {
    keyHandler(e) {
      if (e.keyCode === 8) {
        this.$emit("getBack", this.index - 1);
      }
    }
  },
  mounted() {
    this.$refs.input.addEventListener("keydown", this.keyHandler);
  },
  unmounted() {
    if (this.$refs.input) {
      this.$refs.input.removeEventListener("keydown", this.keyHandler);
    }
  }
}
</script>

<style scoped lang="scss">
.input-opacity {
  opacity: 0;
}
.input_section {
	width: 56px;
	height: 56px;
	border-radius: 8px;
	font-family: NunitoSans, serif;
	font-size: 26px;
	font-weight: 400;
	line-height: 24px;
	transition: all 0.5s ease 0s;
	border-color: transparent;
	background: var(--background-modal-input, #FFF);
	padding: 4px 16px;
	min-height: 56px;
	color: var(--text-secondary, #475467);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  text-align: center;

	&::placeholder {
		color: var(--select-text-no-value, #D0D5DD);
	}

	&:active,
	&:focus {
		border-color: var(--select-border-focus, #2E90FA);
		box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
	}
}
</style>

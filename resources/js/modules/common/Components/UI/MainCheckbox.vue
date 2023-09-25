<template>
    <span
        ref="checkbox"
        class="checkbox"
        @click="checkboxer"
        :class="{ checked: isChecked }"
    >
        <slot></slot>
    </span>
</template>
<script>
export default {
    name: "main-checkbox",
    props: {
        is_checked: {
            type: Boolean,
            default: false,
        },
        editable: {
            default: true,
            type: Boolean,
        },
    },
    data() {
        return {
            isChecked: this.is_checked,
        };
    },
    methods: {
        checkboxer() {
            if (this.editable) {
                this.isChecked = !this.isChecked;
                this.$emit("is_checked", this.isChecked);
            }
        },
    },
    watch: {
        is_checked(newCheckState) {
            this.isChecked = newCheckState;
        },
    },
};
</script>
<style lang="scss" scoped>
.checkbox {
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: var(--text-teritary-day, #98a2b3);
    background: transparent !important;
    font-family: NunitoSans, serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 24px;
    position: relative;
    user-select: none;
    cursor: pointer;
    gap: 16px;
    &::after {
        content: "";
        display: inline-block;
        width: 60px;
        height: 32px;
        background: #f2f4f7;
        transition: all 0.3s ease;
        border-radius: 32px;
    }
    &::before {
        content: "";
        display: inline-block;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 28px;
        width: 24px;
        height: 24px;
        filter: drop-shadow(0px 10px 10px rgba(0, 0, 0, 0.1));
        border-radius: 50%;
        background: #fff;
        transition: all 0.3s ease;
    }
    &.checked {
        &::before {
            right: 4px;
        }
        &:after {
            background: #53b1fd;
        }
    }
    &-sm {
        &::after {
            width: 44px;
            height: 24px;
        }
        &::before {
            width: 16px;
            height: 16px;
            right: 24px;
        }
    }
}
</style>

<template>
    <span
        ref="checkbox"
        class="checkbox"
        @click="this.checkboxer"
        :class="{ checked: this.isChecked }"
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
    },
    data() {
        return {
            isChecked: this.is_checked,
        };
    },
    methods: {
        checkboxer() {
            this.isChecked = !this.isChecked;
            this.$emit("is_checked", this.isChecked);
        },
    },
    updated() {
        if (this.is_checked) {
            setTimeout(() => {
                this.$refs.checkbox.classList.add("checked");
                this.isChecked = true;
            }, 1);
        }
    },
    mounted() {
        if (this.is_checked) {
            setTimeout(() => {
                this.$refs.checkbox.classList.add("checked");
                this.isChecked = true;
            }, 1);
        }
    },
};
</script>
<style lang="scss" scoped>
.checkbox {
    display: flex;
    align-items: center;
    font-weight: 400;
    font-size: 14px;
    line-height: 130%;
    color: #99acd3;
    position: relative;
    user-select: none;
    cursor: pointer;
    gap: 16px;
    @media (max-width: 479.98px) {
        justify-content: space-between;
    }
    &::after {
        content: "";
        display: inline-block;
        width: 48px;
        height: 24px;
        background: #d2dff3;
        transition: all 0.3s ease;
        border-radius: 32px;
        @media (max-width: 479.98px) {
            width: 37px;
            height: 20px;
        }
    }
    &::before {
        content: "";
        display: inline-block;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 28px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.75);
        transition: all 0.3s ease;
        @media (max-width: 479.98px) {
            width: 15px;
            height: 15px;
            right: 19px;
        }
    }
    &.checked {
        &::before {
            right: 4px;
            background: #5389e1;
        }
        &:after {
            background: #bcd0f1;
        }
    }
}
</style>

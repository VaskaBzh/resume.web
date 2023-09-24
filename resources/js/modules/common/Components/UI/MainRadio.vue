<template>
    <div
        class="radio"
        :class="{ active: options.value === getActive }"
        @click="checked"
    >
        {{ options.title }}
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "main-radio",
    props: {
        options: Array,
        getActive: Number,
    },
    methods: {
        ...mapGetters(["getActive"]),
        checked() {
            this.$store.dispatch("set_active", this.options.value);
        },
    },
};
</script>
<style lang="scss" scoped>
.radio {
    width: 100%;
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
    padding: 4px 8px;
    border-radius: 8px;
    background: transparent;
    transition: all 0.3s ease 0s;
    color: var(--text-secondary);
    font-size: 16px;
    line-height: 150%;
    min-height: 40px;
    &.active {
        border-radius: var(--surface-border-radius-radius-s-md, 12px);
background: var(--background-island-inner-1, rgba(83, 177, 253, 0.07));
        color: var(--text-focus)
    }
    &_button {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        border: 1px solid #5389e1;
        transition: all 0.3s ease 0s;
        position: relative;
        &:after {
            content: "";
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 14px;
            height: 14px;
            border-radius: 50%;
            transition: all 0.3s ease 0s;
            background: transparent;
        }
    }
}
</style>

<template>
    <div
        class="radio"
        :class="{ active: options.value === getActive }"
        @click="checked"
    >
        {{ options.title }}
        <div class="radio_button"></div>
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
            this.$store.commit("updateActive", this.options.value);
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
    background: #fafafa;
    transition: all 0.3s ease 0s;
    color: #818c99;
    font-size: 16px;
    line-height: 150%;
    min-height: 40px;
    &.active {
        background: #ecf2fc;
        .radio_button {
            background: #5389e1;
            &:after {
                width: 8px;
                height: 8px;
                background: #ecf2fc;
            }
        }
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

<template>
    <div class="menu" :class="{ opened: opened }">
        <button
            @click="
                option.class === 'remove'
                    ? this.$emit('remove')
                    : this.$emit('clicked')
            "
            class="menu_elem"
            v-for="(option, i) in options"
            :key="i"
            :class="option.class"
            :data-popup="option.attr"
        >
            <span class="icon" v-if="option.svg" v-html="option.svg"></span>
            {{ option.name }}
        </button>
    </div>
</template>

<script>
export default {
    name: "main-menu",
    props: {
        options: Object,
        opened: Boolean,
    },
};
</script>

<style lang="scss">
.menu {
    cursor: default;
    position: absolute;
    min-width: 255px;
    background: #ffffff;
    height: fit-content;
    display: flex;
    visibility: hidden;
    flex-direction: column;
    align-items: center;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    border-radius: 21px;
    width: fit-content;
    z-index: 5;
    transition: all 0.5s ease 0s;
    opacity: 0;
    @media (max-width: 991.98px) {
        right: 0;
        left: auto;
        top: 0;
        max-width: 225px;
    }
    @media (max-width: 767.98px) {
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        background: #ffffff;
        width: calc(100% - 20px);
        max-height: 50vh;
        height: fit-content;
        z-index: 350;
        padding: 10px;
        top: auto;
        transition: all 0.8s ease 0s;
    }
    &.opened {
        visibility: visible;
        opacity: 1;
    }
    &_elem {
        &-remove {
            color: #ff3b30;
        }
        .icon,
        svg {
            width: 24px;
            height: 24px;
        }
        font-weight: 400;
        font-size: 17px;
        line-height: 143.1%;
        color: #000034;
        display: flex;
        height: 48px;
        gap: 12px;
        padding: 12px;
        align-items: center;
        width: 100%;
        background: transparent;
        transition: all 0.3s ease 0s;
        &:not(:first-child) {
            border-top: 1px solid rgba(214, 214, 214, 0.3);
        }
        &:hover {
            background: #f6f8fa;
        }
        svg {
            width: 24px;
            height: 24px;
            stroke: transparent !important;
        }
        svg:not(.stroke) {
            fill: #417fe5 !important;
        }
        svg.stroke {
            stroke: #417fe5 !important;
        }
    }
    &_column {
        display: flex;
        flex-direction: column;
        span {
            width: 100%;
        }
    }
    &_title {
        font-weight: 400;
        font-size: 16px;
        line-height: 143.1%;
        color: rgba(0, 0, 0, 0.62);
    }
    &_val {
        font-weight: 500;
        font-size: 18px;
        line-height: 143.1%;
        color: #000034;
    }
}
</style>

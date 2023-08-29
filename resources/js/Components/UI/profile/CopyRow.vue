<template>
    <div class="text">
        <b>{{ this.copyObject.title }}:</b>
        <div
            class="copy_row text text-light"
            :class="{ active: active }"
            @click="this.copyLink"
        >
            {{ this.copyObject.link }}
            <copy-icon
                class="copy_button"
                :class="{ hide: active }"
            />
        </div>
    </div>
</template>

<script>
import CopyIcon from "../../../modules/common/icons/CopyIcon.vue";

export default {
    name: "copy-row",
    props: {
        copyObject: Object,
    },
    components: {
        CopyIcon,
    },
    data() {
        return {
            active: false,
        };
    },
    methods: {
        copyLink() {
            navigator.clipboard.writeText(this.copyObject.link);
            this.active = true;
            setTimeout(() => {
                this.active = false;
            }, 800);
        },
    },
};
</script>

<style scoped lang="scss">
.text {
    display: flex;
    justify-content: space-between;
    gap: 4px;
    align-items: center;
    position: relative;
}
.copy {
    &_button {
        width: 28px;
        height: 28px;
        cursor: pointer;
        position: absolute;
        right: 24px;
        top: 50%;
        transform: translateY(-50%);
        transition: all 0.3s ease 0s;
        opacity: 1;
        stroke: #343434;
        @media (max-width: 478.98px) {
            right: 7px;
            width: 20px;
            height: 20px;
        }
        &.hide {
            opacity: 0;
        }
    }
    &_row {
        width: 100%;
        min-height: 48px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(85, 85, 85, 0.1);
        background: #fafafa;
        padding: 5px 24px;
        outline: none;
        margin-left: auto;
        cursor: pointer;
        display: inline-flex;
        justify-content: space-between;
        transition: all 0.3s ease 0s;
        overflow: hidden;
        max-width: calc(100% - 70px) !important;
        border: 1px solid transparent;
        @media (max-width: 479.98px) {
            padding: 2px 8px;
            min-height: 40px;
            max-width: calc(100% - 55px) !important;
        }
        &:hover {
            .copy {
                &_button {
                    stroke: #4182ec !important;
                }
            }
        }
        &.active {
            .copy-button {
                opacity: 0;
            }
            &:before {
                opacity: 1;
                transform: translate(0, -50%);
            }
        }
        &:before {
            content: "";
            background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M9.27283 18.0269L9.44961 18.2037L9.62639 18.0269L20.3014 7.35187L20.4782 7.1751L20.3014 6.99832L19.2264 5.92332L19.0496 5.74654L18.8728 5.92332L9.44961 15.3465L5.10139 10.9983L4.92461 10.8215L4.74783 10.9983L3.67283 12.0733L3.49606 12.2501L3.67283 12.4269L9.27283 18.0269Z' fill='%233F7BDD' stroke='%233F7BDD' stroke-width='0.5'/%3E%3C/svg%3E%0A");
            background-position: center;
            background-size: cover;
            position: absolute;
            right: 21px;
            top: 50%;
            cursor: pointer;
            transform: translate(100%, -50%);
            transition: all 0.3s ease 0s;
            height: 28px;
            max-width: 28px;
            width: 28px;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            opacity: 0;
            @media (max-width: 478.98px) {
                right: 8px;
                width: 20px;
                height: 20px;
            }
        }
    }
}
</style>

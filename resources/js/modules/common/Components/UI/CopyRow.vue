<template>
    <div
        class="copy"
        :class="{ active: active }"
        @click="this.copyLink"
    >
        <span class="copy_label">{{ this.copyObject.title }}:</span>
        <span class="copy_link">{{ this.copyObject.link }}</span>
        <copy-icon
            class="copy_icon"
            :class="{ 'copy_icon-hide': active }"
        />
        <slot
            name="instruction"
        />
    </div>
</template>

<script>
import CopyIcon from "@/modules/common/icons/CopyIcon.vue";

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
.onboarding_block {
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
}
.copy {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
    position: relative;
    min-height: 56px;
    padding: 4px 16px;
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--background-island-inner-3, #F8FAFD);
    &:hover {
        .copy {
            &_button {
                stroke: var(--text-focus);
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
        height: 24px;
        max-width: 24px;
        width: 24px;
        overflow: hidden;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        opacity: 0;
    }
    &_icon {
        width: 24px;
        height: 24px;
        cursor: pointer;
        position: absolute;
        right: 24px;
        top: 50%;
        transform: translateY(-50%);
        transition: all 0.3s ease 0s;
        opacity: 1;
        stroke: var(--icons-secondary);
        &-hide {
            opacity: 0;
        }
    }
    &_label {
        color: var(--text-teritary-night, #6F7682);
        font-family: NunitoSans, serif;
        font-size: 12px;
        font-weight: 400;
        line-height: 16px;
    }
    &_link {
        color: var(--text-secondary-night, #C5C8CD);
        font-family: NunitoSans, serif;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 24px;
    }
}
</style>

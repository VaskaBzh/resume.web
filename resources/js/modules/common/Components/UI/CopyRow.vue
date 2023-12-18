<template>
    <div class="copy" :class="{ active: active }" @click="copyLink">
        <span class="copy_label">{{ copyObject.title }}:</span>
        <span class="copy_link">{{ copyObject.link }}</span>
        <transition name="copy">
            <copy-icon v-show="!active" class="copy_icon" />
        </transition>
        <transition name="tick">
            <tick-icon v-show="active" class="copy_tick" />
        </transition>
        <slot name="instruction" />
    </div>
</template>

<script>
import CopyIcon from "@/modules/common/icons/CopyIcon.vue";
import TickIcon from "@/modules/common/icons/TickIcon.vue";

export default {
    name: "CopyRow",
    components: {
        CopyIcon,
        TickIcon,
    },
    props: {
        copyObject: Object,
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
.copy-enter-active,
.copy-leave-active {
    transition: all 0.3s ease;
}
.tick-enter-active,
.tick-leave-active {
    transition: all 0.3s ease;
}
.copy-enter-from,
.copy-leave-to {
    opacity: 0;
}
.tick-enter-from,
.tick-leave-to {
    transform: translate(100%, -50%) !important;
    opacity: 0;
}
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
    background: var(--background-island-inner-3, #f8fafd);
    cursor: pointer;
    &:hover {
        .copy {
            &_icon {
                stroke: #2e90faff;
            }
        }
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
        stroke: var(--icons-secondary);
    }
    &_tick {
        width: 24px;
        height: 24px;
        cursor: pointer;
        position: absolute;
        right: 24px;
        top: 50%;
        transform: translate(0, -50%);
        transition: all 0.3s ease 0s;
    }
    &_label {
        color: var(--text-teritary-night, #6f7682);
        font-family: NunitoSans, serif;
        font-size: 12px;
        font-weight: 400;
        line-height: 16px;
    }
    &_link {
        color: var(--text-secondary-night, #c5c8cd);
        font-family: NunitoSans, serif;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 24px;
    }
}
</style>

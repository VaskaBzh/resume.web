<template>
    <div class="copy" :class="{ 'copy-active': hasCopy }" @click="copy">
        <p class="copy_label" v-show="label">{{ label }}</p>
        <p class="copy_input">{{ cuttedCode }}</p>
        <transition name="copy">
            <copy-icon class="copy_icon" v-show="!hasCopy" />
        </transition>
        <transition name="tick">
            <tick-icon class="copy_tick" v-show="hasCopy" />
        </transition>
    </div>
</template>

<script>
import CopyIcon from "../../icons/CopyIcon.vue";
import TickIcon from "../../icons/TickIcon.vue";

export default {
    name: "main-copy",
    props: {
        code: String,
        label: String,
        cutValue: {
            type: Number,
            default: 16,
        },
    },
    components: {
        CopyIcon,
        TickIcon,
    },
    data() {
        return {
            hasCopy: false,
        };
    },
    computed: {
        cuttedCode() {
            if (this.code)
                if (this.cutValue !== -1)
                    return this.code.length >= this.cutValue
                        ? `${this.code.substr(0, this.cutValue)}...`
                        : this.code;
                else return this.code;
            return "...";
        },
    },
    methods: {
        copy() {
            if (this.code && this.code !== "...") {
                navigator.clipboard.writeText(this.code);

                this.copyAnimation();
            }
        },
        copyAnimation() {
            this.hasCopy = true;
            setTimeout(() => {
                this.hasCopy = false;
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
.copy {
    min-height: 48px;
    width: 100%;
    display: flex;
    justify-content: center;
    padding: var(--py-4, 16px) var(--px-4, 16px);
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--background-modal-input, #ffffff);
    cursor: pointer;
    position: relative;
    transition: all 0.5s ease 0s;
    overflow: hidden;
    flex-direction: column;
    &:hover {
        .copy {
            &_tick,
            &_icon {
                stroke: #4182ec;
            }
            &_tick {
                fill: #4182ec;
            }
        }
        //&-active {
        //}
    }
    &_label {
        color: var(--text-teritary-day, #98a2b3);
        font-family: NunitoSans, serif;
        font-size: 12px;
        font-weight: 400;
        line-height: 16px;
    }
    &_input {
        width: 100%;
        height: 100%;
        outline: none;
        border: none;
        background: transparent;
        text-overflow: ellipsis;
        font-family: NunitoSans, serif;
        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
        color: var(--text-secondary, #475467);
    }
    &_tick {
        stroke: #4182ec;
        fill: #4182ec;
        width: 24px;
        height: 24px;
        position: absolute;
        top: 50%;
        right: 16px;
        transform: translateY(-50%);
        transition: all 0.3s ease;
    }
    &_icon {
        stroke: #aeaeb2;
        width: 24px;
        height: 24px;
        position: absolute;
        top: 50%;
        right: 16px;
        transform: translateY(-50%);
        transition: all 0.3s ease;
    }
}
</style>

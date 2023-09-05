<template>
    <div class="copy" :class="{ 'copy-active': hasCopy }" @click="copy">
        <p class="copy_input">{{ catedCode }}</p>
        <transition name="copy">
            <copy-icon class="copy_icon" v-show="!hasCopy" />
        </transition>
        <transition name="tick">
            <tick-icon class="copy_tick" v-show="hasCopy" />
        </transition>
    </div>
</template>

<script>
import CopyIcon from "../../modules/common/icons/CopyIcon.vue";
import TickIcon from "../../modules/common/icons/TickIcon.vue";

export default {
    name: "main-copy",
    props: {
        code: String,
    },
    components: {
        CopyIcon,
        TickIcon,
    },
    data() {
        return  {
            hasCopy: false,
        };
    },
    computed: {
        catedCode() {
            return this.code.length >= 16
                ? `${this.code.substr(0, 16)}...`
                : this.code;
        }
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
            setTimeout(() => {this.hasCopy = false}, 800)
        }
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
    align-items: center;
    border-radius: 8px;
    background: #ededed;
    cursor: pointer;
    position: relative;
    transition: all 0.5s ease 0s;
    overflow: hidden;
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
    &_input {
        width: 100%;
        height: 100%;
        color: #818c99;
        font-size: 16px;
        font-weight: 400;
        line-height: 150%;
        outline: none;
        border: none;
        background: transparent;
        padding: 0 0 0 16px;
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

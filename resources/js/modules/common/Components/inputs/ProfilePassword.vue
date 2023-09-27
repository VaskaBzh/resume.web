<template>
    <div class="row">
        <input
            :type="type"
            class="row_input input"
            v-model="value"
            :placeholder="placeholder"
        />
        <transition name="fade">
            <opened-eye-icon
                class="row_icon"
                @click="changeType"
                v-if="type === 'password'"
            />
            <closed-eye-icon
                class="row_icon"
                @click="changeType"
                v-else
            />
        </transition>
    </div>
</template>

<script>
import OpenedEyeIcon from "@/modules/common/icons/OpenedEyeIcon.vue";
import ClosedEyeIcon from "@/modules/common/icons/ClosedEyeIcon.vue";

export default {
    name: "profile-password",
    components: {
        OpenedEyeIcon,
        ClosedEyeIcon
    },
    props: {
        model: String,
        placeholder: String,
    },
    data() {
        return {
            value: "",
            type: "password",
        };
    },
    methods: {
        changeType() {
            this.type === "password"
                ? (this.type = "text")
                : (this.type = "password");
        },
    },
    watch: {
        model(newModelValue) {
            this.value = newModelValue;
        },
        value(newValue) {
            this.$emit("change", newValue);
        },
    },
};
</script>

<style scoped lang="scss">
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
.error {
    input {
        color: #e5403f;
        border-color: #e5403f;
        &::placeholder {
            color: rgba(124, 124, 124, 0.7);
        }
    }
    svg,
    svg path {
        fill: #e5403f;
    }
}
.row {
    position: relative;
    width: 100%;
    &_input {
        font-family: NunitoSans, serif;
        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
        border-width:  1px;
        border-style:  solid;
        transition: all 0.5s ease 0s;
        border-color: transparent;
        border-radius: var(--surface-border-radius-radius-s-md, 12px);
        background: var(--main-gohan, #FFF);
        padding: 4px 16px;
        min-height: 56px;
        width: 100%;

        &::placeholder {
            color: var(--select-text-no-value-day, #D0D5DD);
        }

        &:active,
        &:focus {
            border-color: var(--select-border-focus, #2E90FA);
            box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
        }
    }
    &_icon {
        width: 24px;
        height: 24px;
        stroke: var(--select-text-no-value-day, #D0D5DD);
        transition: all 0.5s ease 0s;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 16px;
    }
}
</style>

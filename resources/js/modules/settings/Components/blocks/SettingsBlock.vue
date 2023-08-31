<template>
    <div class="cabinet__block cabinet__block-light">
        <span class="text text-black text-b settings_text"
            >{{ title }}
            <span class="settings_success" v-show="success">
                <svg
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M9.99935 1.66663C5.40435 1.66663 1.66602 5.40496 1.66602 9.99996C1.66602 14.595 5.40435 18.3333 9.99935 18.3333C14.5943 18.3333 18.3327 14.595 18.3327 9.99996C18.3327 5.40496 14.5943 1.66663 9.99935 1.66663ZM9.99935 16.6666C6.32352 16.6666 3.33268 13.6758 3.33268 9.99996C3.33268 6.32413 6.32352 3.33329 9.99935 3.33329C13.6752 3.33329 16.666 6.32413 16.666 9.99996C16.666 13.6758 13.6752 16.6666 9.99935 16.6666Z"
                    />
                    <path
                        d="M8.33273 11.3226L6.4169 9.41006L5.24023 10.5901L8.3344 13.6776L13.9227 8.08922L12.7444 6.91089L8.33273 11.3226Z"
                    />
                </svg>
                Успешно</span
            ></span
        >
        <span v-show="text" class="text text-light text-md">{{ text }}</span>
        <div class="settings__block-row">
            <div class="settings__block-column">
                <input
                    type="text"
                    :placeholder="placeholder"
                    v-model="valueModel"
                    class="settings_input input"
                    :disabled="disabled"
                />
                <span v-show="currency">$</span>
            </div>
            <blue-button
                class="settings_button"
                :disabled="disabled"
                @click="
                    !disabled ? $emit('clicked', valueModel) : console.log()
                "
            >
                <a href="#" class="all-link">{{ button }}</a>
            </blue-button>
        </div>
    </div>
</template>

<script>
import BlueButton from "@/Components/UI/BlueButton.vue";

export default {
    name: "settings-block",
    props: {
        success: String,
        value: String,
        title: String,
        text: String,
        button: String,
        placeholder: {
            type: String,
            default: "200",
        },
        currency: {
            type: Boolean,
            default: false,
        },
        disabled: Boolean,
    },
    components: {
        BlueButton,
    },
    data() {
        return {
            valueModel: this.value,
        };
    },
    watch: {
        value(newValue) {
            this.valueModel = newValue;
        },
    },
};
</script>

<style scoped lang="scss">
.cabinet__block {
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.settings {
    &_input {
        &:disabled {
            pointer-events: none;
        }
    }
    &__block {
        &-column {
            width: 100%;
            position: relative;

            span {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                right: 16px;
            }
        }

        &-row {
            width: 100%;
            gap: 12px;
            display: flex;
            @media (max-width: $mobileSmall) {
                flex-direction: column;
            }
        }
    }
    &_button {
        border-radius: 8px;
        max-width: 140px;
        width: 100%;
        padding: 0;
        @media (max-width: $mobileSmall) {
            max-width: 100%;
        }
        &:disabled {
            pointer-events: none;
            opacity: 0.5;
        }
    }
    &_text {
        &:first-child {
            display: flex;
            justify-content: space-between;
            width: 100%;
            align-items: center;
            @media (max-width: 479.98px) {
                font-size: 16px;
            }
        }
    }
    &_success {
        display: inline-flex;
        gap: 8px;
        align-items: center;
        color: #0fb468;
        font-weight: 500;
        font-size: 16px;
        line-height: 140%;
        svg {
            fill: #0fb468;
        }
    }
}
</style>

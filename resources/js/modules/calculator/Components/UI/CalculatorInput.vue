<template>
    <div class="row" @mousedown="$refs.input.focus()">
        <label :for="inputName" class="row__label"
            >{{ $t(inputLabel) }}
            <svg
                width="14"
                height="15"
                viewBox="0 0 14 15"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                v-show="inputHint"
            >
                <g clip-path="url(#clip0_37_1433)">
                    <path
                        d="M7 13.625C3.61812 13.625 0.875 10.8819 0.875 7.5C0.875 4.11812 3.61812 1.375 7 1.375C10.3819 1.375 13.125 4.11812 13.125 7.5C13.125 10.8819 10.3819 13.625 7 13.625ZM7 14.5C10.8658 14.5 14 11.3658 14 7.5C14 3.63425 10.8658 0.5 7 0.5C3.13425 0.5 0 3.63425 0 7.5C0 11.3658 3.13425 14.5 7 14.5Z"
                        fill="white"
                        fill-opacity="0.5"
                    />
                    <path
                        d="M7.81375 6.2645L5.81043 6.51562L5.73868 6.849L6.13199 6.92075C6.39012 6.982 6.43956 7.07431 6.38487 7.33069L5.73868 10.3661C5.56806 11.1505 5.82924 11.5197 6.44437 11.5197C6.92124 11.5197 7.47687 11.2993 7.72624 10.9965L7.805 10.6325C7.62912 10.7865 7.37406 10.8478 7.20343 10.8478C6.96281 10.8478 6.87531 10.6789 6.93831 10.3814L7.81375 6.2645ZM7.87499 4.4375C7.87499 4.66956 7.78281 4.89212 7.61871 5.05622C7.45462 5.22031 7.23206 5.3125 6.99999 5.3125C6.76793 5.3125 6.54537 5.22031 6.38128 5.05622C6.21718 4.89212 6.125 4.66956 6.125 4.4375C6.125 4.20544 6.21718 3.98288 6.38128 3.81878C6.54537 3.65469 6.76793 3.5625 6.99999 3.5625C7.23206 3.5625 7.45462 3.65469 7.61871 3.81878C7.78281 3.98288 7.87499 4.20544 7.87499 4.4375Z"
                        fill="white"
                        fill-opacity="0.5"
                    />
                </g>
                <defs>
                    <clipPath id="clip0_37_1433">
                        <rect
                            width="14"
                            height="14"
                            fill="white"
                            transform="translate(0 0.5)"
                        />
                    </clipPath>
                </defs>
            </svg>
        </label>
        <input
            ref="input"
            type="text"
            :disabled="disabled"
            :id="inputName"
            :name="inputName"
            v-model="value"
            class="row__input"
            :placeholder="inputPlaceholder"
        />
        <span class="row_unit" v-show="inputUnit">{{ inputUnit }}</span>
    </div>
</template>

<script>
export default {
    name: "CalculatorInput",
    props: {
        inputName: String,
        inputLabel: String,
        inputValue: String,
        inputPlaceholder: String,
        inputUnit: String,
        inputHint: String,
        disabled: Boolean,
    },
    data() {
        return {
            value: this.inputValue,
        };
    },
    watch: {
        value(newVal, oldVal) {
            let regExp = /[a-zа-яё]|[!$()№";'@#&_%$*+,~`:=<>?[|\]/\-^{|}]/gi;
            if (newVal.length > 9 || regExp.test(newVal)) {
                this.value = oldVal;
                return;
            }
            this.$emit("getValue", newVal);
        },
        inputValue(newVal) {
            this.value = newVal;
        },
    },
};
</script>

<style scoped lang="scss">
.row {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    position: relative;
    width: 100%;
    border-radius: 16px;
    border: 0.5px solid var(--gray-240, rgba(228, 231, 236, 0.4));
    padding: 0 16px;
    min-height: 48px;
    gap: 12px;
    cursor: text;

    &__label {
        color: var(--gray-160, rgba(245, 250, 255, 0.6));
        text-align: justify;
        text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
        font-family: NunitoSans;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: 110%; /* 22px */
        display: inline-flex;
        gap: 4px;
        align-items: center;
        margin-right: auto;
        cursor: text;
        white-space: nowrap;
        @media (max-width: 890px) {
            font-size: 18px;
        }
        @media (max-width: 450px) {
            font-size: 14px;
        }

        svg {
            margin-bottom: auto;
            cursor: pointer;
        }
    }

    &_unit {
        color: rgba(255, 255, 255, 0.7);
        text-align: right;
        font-size: 16px;
        font-weight: 400;
        line-height: 28px;
        letter-spacing: 0.35px;
        white-space: nowrap;
        @media (max-width: 890px) {
            font-size: 18px;
        }
        @media (max-width: 450px) {
            font-size: 14px;
        }
    }

    &__input {
        color: var(--gray-3100, #d0d5dd);
        text-align: right;
        font-family: Unbounded;
        font-size: 18px;
        font-style: normal;
        font-weight: 600;
        line-height: 120%; /* 21.6px */
        text-transform: uppercase;
        width: 100%;
        outline: none;
        border: none;
        background: transparent;
        cursor: text;
        @media (max-width: 890px) {
            font-size: 16px;
        }
        @media (max-width: 450px) {
            font-size: 12px;
        }

        &::placeholder {
            color: #ffffff;
        }
    }
}
</style>

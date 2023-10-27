<template>
    <transition name="validate">
        <ul class="validate" v-if="Object.entries(validate).length > 0">
            <li
                class="validate_val"
                :class="
                    !validate.length
                        ? 'validate_val-complete'
                        : 'validate_val-reject'
                "
            >
                {{ this.$t("validate[0]") }}
            </li>
            <ul class="validate__list">
                <span
                    class="validate_val"
                    :class="
                        !(
                            validate.lower ||
                            validate.upper ||
                            validate.symbol ||
                            validate.number
                        )
                            ? 'validate_val-complete'
                            : 'validate_val-reject'
                    "
                >
                    {{ this.$t("validate[1]") }}
                </span>
                <li
                    class="validate_val"
                    :class="!validate.lower ? 'validate_val-complete' : ''"
                >
                    {{ this.$t("validate[2]") }}
                </li>
                <li
                    class="validate_val"
                    :class="!validate.upper ? 'validate_val-complete' : ''"
                >
                    {{ this.$t("validate[3]") }}
                </li>
                <li
                    class="validate_val"
                    :class="!validate.symbol ? 'validate_val-complete' : ''"
                >
                    {{ this.$t("validate[4]") }}
                </li>
                <li
                    class="validate_val"
                    :class="!validate.number ? 'validate_val-complete' : ''"
                >
                    {{ this.$t("validate[5]") }}
                </li>
            </ul>
        </ul>
    </transition>
</template>

<script>
import { ValidateMessage } from "@/modules/validate/lang/ValidateMessage";

export default {
    name: "main-validate",
    props: {
        validate: Object,
    },
    i18n: {
        sharedMessages: ValidateMessage,
    },
};
</script>

<style scoped lang="scss">
.validate-enter-active,
.validate-leave-active {
    transition: all 0.5s ease;
    max-height: 230px;
}
.validate-enter-from,
.validate-leave-to {
    max-height: 0;
    visibility: hidden;
    opacity: 0;
    padding: 0 16px !important;
}
.validate-leave-to {
    margin: -8px 0;
}
.validate {
    width: 100%;
    padding: 16px;
    min-height: 0;
    border-radius: 12px;
    overflow: hidden;
    background: var(--background-island);;
    box-shadow: 0px 4px 10px 0px rgba(85, 85, 85, 0.1);
    &.validate,
    &__list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    &_val {
        color: rgba(124, 124, 124, 0.7);
        font-size: 18px;
        font-weight: 400;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        line-height: 135%;
        transition: all 0.5s ease 0s;
        @media (max-width: 479.98px) {
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
        }
        &:before {
            content: "";
            background-image: linear-gradient(
                179deg,
                #e6eaf0 0%,
                #e6eaf1 20.89%,
                #e7ebf1 42.88%,
                #eaeef4 76.04%,
                #e8ecf2 100%
            );
            background-repeat: no-repeat;
            background-size: cover;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            transition: all 0.5s ease 0s;
            @media (max-width: 479.98px) {
                width: 16px;
                height: 16px;
            }
        }
        &-complete {
            color: #0fb468;
            &:before {
                background-color: transparent !important;
                background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10.525 16.55L17.6 9.475L16.45 8.35L10.525 14.275L7.525 11.275L6.4 12.4L10.525 16.55ZM12 22C10.6333 22 9.34167 21.7375 8.125 21.2125C6.90833 20.6875 5.84583 19.9708 4.9375 19.0625C4.02917 18.1542 3.3125 17.0917 2.7875 15.875C2.2625 14.6583 2 13.3667 2 12C2 10.6167 2.2625 9.31667 2.7875 8.1C3.3125 6.88333 4.02917 5.825 4.9375 4.925C5.84583 4.025 6.90833 3.3125 8.125 2.7875C9.34167 2.2625 10.6333 2 12 2C13.3833 2 14.6833 2.2625 15.9 2.7875C17.1167 3.3125 18.175 4.025 19.075 4.925C19.975 5.825 20.6875 6.88333 21.2125 8.1C21.7375 9.31667 22 10.6167 22 12C22 13.3667 21.7375 14.6583 21.2125 15.875C20.6875 17.0917 19.975 18.1542 19.075 19.0625C18.175 19.9708 17.1167 20.6875 15.9 21.2125C14.6833 21.7375 13.3833 22 12 22ZM12 20.5C14.3667 20.5 16.375 19.6708 18.025 18.0125C19.675 16.3542 20.5 14.35 20.5 12C20.5 9.63333 19.675 7.625 18.025 5.975C16.375 4.325 14.3667 3.5 12 3.5C9.65 3.5 7.64583 4.325 5.9875 5.975C4.32917 7.625 3.5 9.63333 3.5 12C3.5 14.35 4.32917 16.3542 5.9875 18.0125C7.64583 19.6708 9.65 20.5 12 20.5Z' fill='%230FB468'/%3E%3C/svg%3E%0A") !important;

                @media (max-width: 479.98px) {
                    background-image: url("data:image/svg+xml,%3Csvg width='16' height='16' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7.01634 11.0335L11.733 6.31683L10.9663 5.56683L7.01634 9.51683L5.01634 7.51683L4.26634 8.26683L7.01634 11.0335ZM7.99967 14.6668C7.08856 14.6668 6.22745 14.4918 5.41634 14.1418C4.60523 13.7918 3.8969 13.3141 3.29134 12.7085C2.68579 12.1029 2.20801 11.3946 1.85801 10.5835C1.50801 9.77238 1.33301 8.91127 1.33301 8.00016C1.33301 7.07794 1.50801 6.21127 1.85801 5.40016C2.20801 4.58905 2.68579 3.8835 3.29134 3.2835C3.8969 2.6835 4.60523 2.2085 5.41634 1.8585C6.22745 1.5085 7.08856 1.3335 7.99967 1.3335C8.9219 1.3335 9.78856 1.5085 10.5997 1.8585C11.4108 2.2085 12.1163 2.6835 12.7163 3.2835C13.3163 3.8835 13.7913 4.58905 14.1413 5.40016C14.4913 6.21127 14.6663 7.07794 14.6663 8.00016C14.6663 8.91127 14.4913 9.77238 14.1413 10.5835C13.7913 11.3946 13.3163 12.1029 12.7163 12.7085C12.1163 13.3141 11.4108 13.7918 10.5997 14.1418C9.78856 14.4918 8.9219 14.6668 7.99967 14.6668ZM7.99967 13.6668C9.57745 13.6668 10.9163 13.1141 12.0163 12.0085C13.1163 10.9029 13.6663 9.56683 13.6663 8.00016C13.6663 6.42238 13.1163 5.0835 12.0163 3.9835C10.9163 2.8835 9.57745 2.3335 7.99967 2.3335C6.43301 2.3335 5.0969 2.8835 3.99134 3.9835C2.88579 5.0835 2.33301 6.42238 2.33301 8.00016C2.33301 9.56683 2.88579 10.9029 3.99134 12.0085C5.0969 13.1141 6.43301 13.6668 7.99967 13.6668Z' fill='%2313D60E'/%3E%3C/svg%3E%0A") !important;
                }
            }
        }
        &-reject {
            color: #e5403f;
            &:before {
                background-color: transparent !important;
                background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M8.25 16.8L12 13.05L15.75 16.8L16.8 15.75L13.05 12L16.8 8.25L15.75 7.2L12 10.95L8.25 7.2L7.2 8.25L10.95 12L7.2 15.75L8.25 16.8ZM12 22C10.6333 22 9.34167 21.7375 8.125 21.2125C6.90833 20.6875 5.84583 19.9708 4.9375 19.0625C4.02917 18.1542 3.3125 17.0917 2.7875 15.875C2.2625 14.6583 2 13.3667 2 12C2 10.6167 2.2625 9.31667 2.7875 8.1C3.3125 6.88333 4.02917 5.825 4.9375 4.925C5.84583 4.025 6.90833 3.3125 8.125 2.7875C9.34167 2.2625 10.6333 2 12 2C13.3833 2 14.6833 2.2625 15.9 2.7875C17.1167 3.3125 18.175 4.025 19.075 4.925C19.975 5.825 20.6875 6.88333 21.2125 8.1C21.7375 9.31667 22 10.6167 22 12C22 13.3667 21.7375 14.6583 21.2125 15.875C20.6875 17.0917 19.975 18.1542 19.075 19.0625C18.175 19.9708 17.1167 20.6875 15.9 21.2125C14.6833 21.7375 13.3833 22 12 22ZM12 20.5C14.3667 20.5 16.375 19.6708 18.025 18.0125C19.675 16.3542 20.5 14.35 20.5 12C20.5 9.63333 19.675 7.625 18.025 5.975C16.375 4.325 14.3667 3.5 12 3.5C9.65 3.5 7.64583 4.325 5.9875 5.975C4.32917 7.625 3.5 9.63333 3.5 12C3.5 14.35 4.32917 16.3542 5.9875 18.0125C7.64583 19.6708 9.65 20.5 12 20.5Z' fill='%23E5403F'/%3E%3C/svg%3E%0A") !important;
                @media (max-width: 479.98px) {
                    background-image: url("data:image/svg+xml,%3Csvg width='16' height='16' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.49967 11.2002L7.99967 8.70016L10.4997 11.2002L11.1997 10.5002L8.69967 8.00016L11.1997 5.50016L10.4997 4.80016L7.99967 7.30016L5.49967 4.80016L4.79967 5.50016L7.29967 8.00016L4.79967 10.5002L5.49967 11.2002ZM7.99967 14.6668C7.08856 14.6668 6.22745 14.4918 5.41634 14.1418C4.60523 13.7918 3.8969 13.3141 3.29134 12.7085C2.68579 12.1029 2.20801 11.3946 1.85801 10.5835C1.50801 9.77238 1.33301 8.91127 1.33301 8.00016C1.33301 7.07794 1.50801 6.21127 1.85801 5.40016C2.20801 4.58905 2.68579 3.8835 3.29134 3.2835C3.8969 2.6835 4.60523 2.2085 5.41634 1.8585C6.22745 1.5085 7.08856 1.3335 7.99967 1.3335C8.9219 1.3335 9.78856 1.5085 10.5997 1.8585C11.4108 2.2085 12.1163 2.6835 12.7163 3.2835C13.3163 3.8835 13.7913 4.58905 14.1413 5.40016C14.4913 6.21127 14.6663 7.07794 14.6663 8.00016C14.6663 8.91127 14.4913 9.77238 14.1413 10.5835C13.7913 11.3946 13.3163 12.1029 12.7163 12.7085C12.1163 13.3141 11.4108 13.7918 10.5997 14.1418C9.78856 14.4918 8.9219 14.6668 7.99967 14.6668ZM7.99967 13.6668C9.57745 13.6668 10.9163 13.1141 12.0163 12.0085C13.1163 10.9029 13.6663 9.56683 13.6663 8.00016C13.6663 6.42238 13.1163 5.0835 12.0163 3.9835C10.9163 2.8835 9.57745 2.3335 7.99967 2.3335C6.43301 2.3335 5.0969 2.8835 3.99134 3.9835C2.88579 5.0835 2.33301 6.42238 2.33301 8.00016C2.33301 9.56683 2.88579 10.9029 3.99134 12.0085C5.0969 13.1141 6.43301 13.6668 7.99967 13.6668Z' fill='%23E5403F'/%3E%3C/svg%3E%0A") !important;
                }
            }
        }
    }
    .validate__list {
        li {
            padding-left: 27px;
        }
    }
}
</style>

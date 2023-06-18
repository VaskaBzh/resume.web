<template>
    <button class="blue-button">
        <slot></slot>
    </button>
</template>

<script>
export default {
    name: "blue-button",
};
</script>

<style lang="scss">
.blue-button {
    display: flex;
    justify-content: center;
    align-items: center;
    width: fit-content;
    font-style: normal;
    font-weight: 500;
    font-size: 18px;
    line-height: 107.6%;
    color: #ffffff;
    min-height: 40px;
    background: linear-gradient(84.14deg, #3f7bdd 8.75%, #4282ec 92.01%);
    border-radius: 12px;
    position: relative;
    transition: all 0.3s ease 0s;
    cursor: pointer;
    &.big {
        border-radius: 5px;
        min-width: 260px;
        min-height: 48px;
        font-weight: 500;
        font-size: 18px;
        line-height: 20px;
    }
    &.small {
        @media (max-width: 479.89px) {
            min-height: 34px;
        }
    }
    &.add {
        width: 60px;
        border-radius: 8px;
        svg {
            width: 24px;
            height: 24px;
            fill: #fafafa;
        }
        &:before {
            content: none;
        }
        @media (max-width: 479.89px) {
            border: none;
            background: transparent;
            padding: 0;
            width: 24px;
            height: 24px;

            svg {
                fill: #4182ec;
            }
        }
    }
    &::before {
        content: "";
        position: absolute;
        z-index: 0;
        background: linear-gradient(
            84.14deg,
            rgba(63, 123, 221, 0.27) 8.75%,
            rgba(66, 130, 236, 0.27) 92.01%
        );
        border-radius: 12px;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        transition: all 0.3s ease 0s;
    }
    &:active {
        transform: translate(0, 0);
        box-shadow: inset 0 4px 4px rgba(0, 0, 0, 0.25);
        &::before {
            top: 0;
            left: 0;
        }
    }
    @media (max-width: 479.98px) {
        font-size: 16px;
        line-height: 20px;
        min-height: 40px;
    }
}
.button {
    min-width: 256px;
    width: fit-content;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    font-weight: 500;
    font-size: 18px;
    cursor: pointer;
    line-height: 140%;

    &-md {
        min-height: 61px;
    }

    &-lg {
        min-height: 85px;
        border-radius: 10px;
        min-width: 347px;
        font-size: 22px;
        line-height: 107.6%;
        @media (max-width: 767.98px) {
            min-height: 65px;
            border-radius: 7px;
            min-width: 266px;
            font-size: 16px;
            line-height: 107%;
        }
        @media (max-width: 767.98px) {
            left: 7px;
            top: 6px;
        }

        &::before {
            content: "";
            position: absolute;
            z-index: 0;
            background: linear-gradient(
                84.14deg,
                rgba(63, 123, 221, 0.27) 8.75%,
                rgba(66, 130, 236, 0.27) 92.01%
            );
            border-radius: 10px;
            width: 100%;
            height: 100%;
            top: 10px;
            left: 10px;
            transition: all 0.3s ease 0s;
            @media (max-width: 767.98px) {
                left: 7px;
                top: 6px;
            }
        }
    }

    &-with-propeller {
        gap: 36px;
        a {
            display: flex;
            justify-content: center;
            align-items: center;
            font-style: normal;
            font-weight: 500;
            font-size: 22px;
            line-height: 107.6%;
            padding: 0;
            color: #ffffff;
            gap: 36px;
            @media (max-width: 767.98px) {
                gap: 32px;
                font-size: 16px;
            }
        }

        @media (any-hover: hover) {
            &:hover {
                box-shadow: inset 0px 4px 4px rgba(0, 0, 0, 0.25);
                transform: translate(10px, 10px);

                &::before {
                    top: 0;
                    left: 0;
                }
            }
        }
    }
}
</style>

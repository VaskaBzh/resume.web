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

<style scoped lang="scss">
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
    min-height: 48px;
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
        svg {
            width: 14px;
            height: 14px;
            fill: #fff;
        }
        @media (max-width: 479.89px) {
            border: none;
            background: transparent;
            padding: 0;
            width: 20px;
            height: 20px;

            svg {
                fill: #4182ec;
                width: 18px;
                height: 18px;
            }
        }
    }
    &::before {
        content: "";
        position: absolute;
        z-index: -1;
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
        @media (max-width: 767.98px) {
            min-height: 65px;
            border-radius: 7px;
            min-width: 266px;
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

        &::before {
            content: "";
            position: absolute;
            z-index: -1;
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
        }
    }
}
</style>

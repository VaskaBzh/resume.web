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
        font-size: 14px;
        line-height: 20px;
        min-height: 40px;
    }
}
</style>

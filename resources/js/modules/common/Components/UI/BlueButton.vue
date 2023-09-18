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
    background: var(--primary-500, #2E90FA);
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
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: var(--light-background-first, #F8FAFD);
        box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.01);
        svg {
            width: 24px;
            height: 24px;
            fill: #3f7bdd;
        }
        &:before {
            content: none;
        }
        @media (max-width: 479.89px) {
            padding: 0;
            width: 40px;
            height: 24px;
            min-height: 32px;

            svg {
                width: 16px;
                height: 16px;
            }
        }
        &:hover {
            background: #3f7bdd;
            svg {
                fill: #e6eaf0;
            }
        }
    }
    //&::before {
    //    content: "";
    //    position: absolute;
    //    z-index: 0;
    //    background: linear-gradient(
    //        84.14deg,
    //        rgba(63, 123, 221, 0.27) 8.75%,
    //        rgba(66, 130, 236, 0.27) 92.01%
    //    );
    //    border-radius: 12px;
    //    width: 100%;
    //    height: 100%;
    //    top: 0;
    //    left: 0;
    //    transition: all 0.3s ease 0s;
    //}

    &:active {
        box-shadow: 0px 4px 5px 0px rgba(39, 39, 39, 0.2) inset;
    }
    @media (max-width: 479.98px) {
        font-size: 16px;
        line-height: 20px;
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

    &:active {
        box-shadow: 0px 4px 5px 0px rgba(39, 39, 39, 0.2) inset;
    }

    &-md {
        min-height: 56px;
    }
    &-light {
        background: #d2def2;
        color: #5389e1;
    }

    &-reverce {
        filter: drop-shadow(0px 10px 10px rgba(112, 165, 236, 0.2));
        background: transparent;
        border: 1px solid #4282ec;
        color: #4282ec;
        gap: 10px;
        transition: all 0.5s ease 0s;
        &-border {
            border: 1px solid #5389e1;
            filter: none;
            color: #5389e1;
        }
        svg {
            fill: #4282ec !important;
            transition: all 0.5s ease 0s;
        }
        &:before {
            content: none !important;
        }
        &:hover {
            background: linear-gradient(
                84.14deg,
                #3f7bdd 8.75%,
                #4282ec 92.01%
            );
            color: #e8ecf2;
            svg {
                fill: #e8ecf2 !important;
            }
        }
        .all-link {
            padding: 0 32px;
            min-height: 56px;
            svg {
                max-width: 100%;
                max-height: 100%;
                overflow: visible;
                visibility: visible;
                opacity: 1;
            }
        }

        &:active {
            box-shadow: 0px 4px 5px 0px rgba(39, 39, 39, 0.2) inset;
            background: linear-gradient(
                84.14deg,
                #3f7bdd 8.75%,
                #4282ec 92.01%
            );
            color: #e8ecf2;
            svg {
                fill: #e8ecf2 !important;
            }
        }
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

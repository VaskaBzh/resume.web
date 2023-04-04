<template>
    <div
        class="list"
        @mouseenter="this.openList"
        @mouseout="this.hideList"
        :class="{ open: list_is_open }"
    >
        <div class="list_head">
            <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M16.4998 14.1502H16.5088M18.999 4.00098H6.19902C5.07892 4.00098 4.51887 4.00098 4.09104 4.21896C3.71472 4.41071 3.40876 4.71667 3.21701 5.093C2.99902 5.52082 2.99902 6.08087 2.99902 7.20098V16.801C2.99902 17.9211 2.99902 18.4811 3.21701 18.909C3.40876 19.2853 3.71472 19.5912 4.09104 19.783C4.51887 20.001 5.07892 20.001 6.19902 20.001H17.799C18.9191 20.001 19.4792 20.001 19.907 19.783C20.2833 19.5912 20.5893 19.2853 20.781 18.909C20.999 18.4811 20.999 17.9211 20.999 16.801V11.201C20.999 10.0809 20.999 9.52082 20.781 9.093C20.5893 8.71667 20.2833 8.41071 19.907 8.21896C19.4792 8.00098 18.9191 8.00098 17.799 8.00098H6.99902M16.9498 14.1502C16.9498 14.3987 16.7483 14.6002 16.4998 14.6002C16.2513 14.6002 16.0498 14.3987 16.0498 14.1502C16.0498 13.9017 16.2513 13.7002 16.4998 13.7002C16.7483 13.7002 16.9498 13.9017 16.9498 14.1502Z"
                    stroke="#7A7A94"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
            <slot name="head"></slot>
        </div>
        <div class="list_body">
            <slot class="list_body" name="body"></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "main-list",
    data() {
        return {
            list_is_open: false,
        };
    },
    methods: {
        openList() {
            this.list_is_open === false
                ? (this.list_is_open = true)
                : (this.list_is_open = false);
        },
        hideList(e) {
            if (!e.target.closest(".list")) {
                this.list_is_open = false;
            }
        },
    },
};
</script>

<style lang="scss">
.list {
    position: relative;
    max-width: 320px;
    width: 100%;
    min-height: 36px;
    cursor: pointer;
    height: fit-content;
    transition: all 0.3s ease 0s;
    overflow: hidden;
    background: #ffffff;
    border: 1px solid #d6d6d6;
    border-radius: 12px;
    padding: 6px 12px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    &_head {
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        line-height: 24px;
        font-size: 17px;
    }
    &_body {
        max-height: 0;
        display: flex;
        flex-direction: column;
        visibility: hidden;
        opacity: 0;
        transition: all 0.3s ease 0s;
        margin-top: -12px;
        gap: 12px;
    }
    &_row {
        display: inline-flex;
        justify-content: space-between;
        font-weight: 500;
        font-size: 15px;
        color: rgba(0, 0, 0, 0.62);
        line-height: 21px;
        span:first-child {
            color: #7a7a94;
        }
    }
    &_button {
        min-height: 32px !important;
        border-radius: 13px !important;
        width: 100% !important;
    }
    &.open {
        .list {
            &_body {
                max-height: 300px;
                visibility: visible;
                opacity: 1;
                margin-top: 0;
            }
        }
    }
}
</style>

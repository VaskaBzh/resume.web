<template>
    <div class="text-b">
        {{ this.copyObject.title }}:
        <div
            class="copy_row text-b"
            :class="{ active: active }"
            @click="this.copyLink"
        >
            {{ this.copyObject.link }}
            <svg
                width="28"
                height="28"
                viewBox="0 0 28 28"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                class="copy_button"
                :class="{ hide: active }"
            >
                <path
                    d="M13.125 4.375V13.125H4.375V14.875H13.125V23.625H14.875V14.875H23.625V13.125H14.875V4.375H13.125Z"
                />
            </svg>
        </div>
    </div>
</template>

<script>
export default {
    name: "copy-row",
    props: {
        copyObject: Object,
    },
    data() {
        return {
            active: false,
        };
    },
    methods: {
        copyLink() {
            navigator.clipboard.writeText(this.copyObject.link);
            this.active = true;
            setTimeout(() => {
                this.active = false;
            }, 1000);
        },
    },
};
</script>

<style scoped lang="scss">
.text-b {
    display: flex;
    justify-content: space-between;
    gap: 4px;
    align-items: center;
    position: relative;
}
.copy {
    &_button {
        width: 28px;
        height: 28px;
        cursor: pointer;
        position: absolute;
        right: 24px;
        top: 50%;
        transform: translateY(-50%);
        transition: all 0.3s ease 0s;
        opacity: 1;
        fill: #343434;
        @media (max-width: 478.98px) {
            right: 7px;
            width: 20px;
            height: 20px;
        }
        &.hide {
            opacity: 0;
        }
    }
    &_row {
        width: 100%;
        min-height: 56px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(85, 85, 85, 0.1);
        background: #fafafa;
        padding: 5px 24px;
        outline: none;
        margin-left: auto;
        cursor: pointer;
        display: inline-flex;
        justify-content: space-between;
        transition: all 0.3s ease 0s;
        overflow: hidden;
        max-width: calc(100% - 90px) !important;
        border: 1px solid transparent;
        @media (max-width: 767.98px) {
            padding: 2px 12px;
            min-height: 36px;
            max-width: calc(100% - 60px) !important;
        }
        &:hover {
            .copy {
                &_button {
                    fill: #4182ec !important;
                }
            }
        }
        @media (max-width: 320.98px) {
            max-width: calc(100% - 55px) !important;
        }
        &.active {
            border: 1px solid #4182ec;
            .copy-button {
                opacity: 0;
            }
            &:before {
                opacity: 1;
                transform: translate(0, -50%);
            }
        }
        &:before {
            content: "";
            background-image: url("data:image/svg+xml,%3Csvg width='756' height='756' viewBox='0 0 756 756' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M607.729 166.729L283.5 490.959L148.27 355.729C135.954 343.413 116.014 343.413 103.729 355.729C91.4445 368.046 91.413 387.985 103.729 400.27L261.229 557.771C273.546 570.087 293.485 570.087 305.77 557.771L652.271 211.27C664.587 198.954 664.587 179.014 652.271 166.729C639.954 154.444 620.014 154.413 607.729 166.729Z' fill='%234181EA'/%3E%3C/svg%3E%0A");
            background-position: center;
            background-size: cover;
            position: absolute;
            right: 21px;
            top: 50%;
            cursor: pointer;
            transform: translate(100%, -50%);
            transition: all 0.3s ease 0s;
            height: 28px;
            max-width: 28px;
            width: 28px;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            opacity: 0;
            @media (max-width: 478.98px) {
                right: 24px;
                width: 20px;
                height: 20px;
            }
        }
    }
}
</style>

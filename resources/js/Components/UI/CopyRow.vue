<template>
    <div class="copy">
        {{ this.copyObject.title }}:
        <div class="copy_row" @click="this.copyLink" ref="link">
            {{ this.copyObject.link }}
            <svg
                class="copy-button"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
            >
                <path
                    d="M15 3V6.4C15 6.96005 15 7.24008 15.109 7.45399C15.2049 7.64215 15.3578 7.79513 15.546 7.89101C15.7599 8 16.0399 8 16.6 8H20M10 8H6C4.89543 8 4 8.89543 4 10V19C4 20.1046 4.89543 21 6 21H12C13.1046 21 14 20.1046 14 19V16M16 3H13.2C12.0799 3 11.5198 3 11.092 3.21799C10.7157 3.40973 10.4097 3.71569 10.218 4.09202C10 4.51984 10 5.0799 10 6.2V12.8C10 13.9201 10 14.4802 10.218 14.908C10.4097 15.2843 10.7157 15.5903 11.092 15.782C11.5198 16 12.0799 16 13.2 16H16.8C17.9201 16 18.4802 16 18.908 15.782C19.2843 15.5903 19.5903 15.2843 19.782 14.908C20 14.4802 20 13.9201 20 12.8V7L16 3Z"
                    stroke-width="2"
                    stroke-linejoin="round"
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
    methods: {
        copyLink() {
            navigator.clipboard.writeText(this.copyObject.link);
            this.$refs.link.classList.add("active");
            setTimeout(() => {
                this.$refs.link.classList.remove("active");
            }, 1000);
        },
    },
};
</script>

<style scoped lang="scss">
.copy {
    display: inline-flex;
    align-items: center;
    font-weight: 400;
    font-size: 18px;
    line-height: 18px;
    color: rgba(0, 0, 0, 0.62);
    position: relative;
    cursor: pointer;
    @media (max-width: 767.98px) {
        color: rgba(0, 0, 0, 0.62);
    }
    @media (max-width: 767.98px) {
        align-items: center;
        font-size: 16px;
        line-height: 23px;
        color: #818c99;
    }
    &-button {
        width: 24px;
        height: 24px;
        cursor: pointer;
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        transition: all 0.3s ease 0s;
        stroke: rgba(#5b5c5e, 0.33) !important;
        opacity: 1;
        @media (max-width: 767.98px) {
            //transform: translateY(-35%);
            width: 22px;
            height: 22px;
            stroke: #000034 !important;
        }
        @media (max-width: 478.98px) {
            right: 7px;
        }
        &:hover {
            stroke: #4182ec !important;
        }
    }
    &_row {
        width: 100%;
        min-height: 40px;
        border-radius: 21px;
        background: linear-gradient(0deg, #ffffff, #ffffff),
            linear-gradient(
                179.87deg,
                #e6eaf0 1.02%,
                #e6eaf1 4.79%,
                #e7ebf1 8.76%,
                #eaeef4 14.75%,
                #e8ecf2 19.07%
            );
        padding: 7px 20px;
        outline: none;
        margin-left: auto;
        font-weight: 400;
        font-size: 18px;
        line-height: 26px;
        display: inline-flex;
        justify-content: space-between;
        transition: all 0.3s ease 0s;
        color: #5b5c5e;
        overflow: hidden;
        max-width: calc(100% - 60px) !important;
        border: 0.5px solid rgba(0, 0, 0, 0.08);
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
            height: 24px;
            max-width: 24px;
            width: 24px;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            opacity: 0;
            @media (max-width: 478.98px) {
                right: 5px;
            }
        }
        @media (max-width: 767.98px) {
            border: 0.5px solid rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            padding: 7px 10px;
            min-height: 36px;
        }
        @media (max-width: 478.98px) {
            font-size: 14px;
            color: #000034;
            line-height: 20px;
        }
        @media (max-width: 380.98px) {
            font-size: 12px;
            line-height: 17px;
            min-height: 34px;
        }
    }
}
</style>

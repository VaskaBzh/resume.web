<template>
    <div
        class="no-info cabinet__block cabinet__block-light"
        v-scroll="'opacity transition--fast'"
        v-if="wait"
    >
        <div class="propeller">
            <svg
                width="80"
                height="65"
                viewBox="0 0 80 65"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <g>
                    <path
                        d="M79.9996 54.0179C79.9996 57.3108 78.422 60.5404 75.4708 62.5246C70.773 65.6979 64.3988 64.4666 61.2152 59.7664L54.6509 50.0425H54.6438L54.6157 49.9932L54.3339 49.5781C53.3408 48.1146 52.1505 46.8269 50.7982 45.7575C50.7771 45.7363 50.77 45.7223 50.7419 45.7012C50.7207 45.6801 50.7066 45.673 50.6855 45.666C47.9245 43.4988 44.5297 42.2042 40.9658 42.0001C40.6488 41.979 40.3319 41.972 40.0009 41.972C39.3106 41.972 38.6133 42.0072 37.9301 42.0986H37.9231C36.0637 42.3308 34.0775 42.9289 32.4082 43.717C32.5491 43.6185 32.8942 43.4566 33.0491 43.3722C38.6274 40.2622 47.6851 38.074 58.1373 38.074H58.9825C66.6949 38.074 73.9213 41.9016 78.2318 48.2975C79.4291 50.0425 79.9996 52.0407 79.9996 54.0179Z"
                        fill="url(#paint0_linear_117_1027)"
                    />
                    <path
                        d="M58.1376 38.0529C47.6924 38.0529 38.6277 40.2482 33.0494 43.3511C32.8945 43.4356 32.0986 43.8718 31.8943 43.9773C29.9574 45.0046 28.2178 46.4048 26.788 48.1076C26.633 48.2624 26.4922 48.4172 26.3513 48.572C24.034 51.105 18.7798 59.7594 18.7798 59.7594C15.6032 64.4666 9.21499 65.6979 4.51712 62.5176C4.11565 62.2502 3.73532 61.9477 3.38315 61.631C1.67868 60.0901 0.586974 58.0778 0.185507 55.9388C-0.15257 54.1868 -0.032836 52.3504 0.579929 50.6195C0.868704 49.8103 1.25608 49.0223 1.75616 48.2835L4.92563 43.5904L6.02438 41.965L8.66561 38.06L31.3379 4.51162C33.3523 1.5283 36.6626 -0.0548384 40.0082 0.00145072C41.9451 0.0225591 43.8891 0.585452 45.6006 1.73938C48.5447 3.72357 50.1294 6.95317 50.1294 10.2531C50.1294 12.2373 49.5589 14.2285 48.3756 15.9876L40.0082 28.3712L33.458 38.06H58.1376V38.0529Z"
                        fill="url(#paint1_linear_117_1027)"
                    />
                </g>
                <defs>
                    <linearGradient
                        id="paint0_linear_117_1027"
                        x1="20.1476"
                        y1="36.7256"
                        x2="81.3618"
                        y2="56.316"
                        gradientUnits="userSpaceOnUse"
                    >
                        <stop offset="0.2624" stop-color="#000034" />
                        <stop offset="1" stop-color="#3F7BDD" />
                    </linearGradient>
                    <linearGradient
                        id="paint1_linear_117_1027"
                        x1="47.8408"
                        y1="16.7451"
                        x2="18.5451"
                        y2="59.6879"
                        gradientUnits="userSpaceOnUse"
                    >
                        <stop stop-color="#3F7BDD" />
                        <stop offset="0.3617" stop-color="#3F6FC6" />
                        <stop offset="0.7059" stop-color="#3F68B8" />
                        <stop offset="1" stop-color="#3F65B3" />
                    </linearGradient>
                </defs>
            </svg>

            <span>{{ progressPercentage }}%</span>
            <svg
                class="preloader"
                width="75"
                height="75"
                viewBox="0 0 75 75"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <animateTransform
                    attributeName="transform"
                    type="rotate"
                    from="0 0 0"
                    to="360 0 0"
                    dur="1.2s"
                    repeatCount="indefinite"
                ></animateTransform>
                <mask id="path-1-inside-1_117_1032" fill="white">
                    <path
                        d="M75 0C65.1509 0 55.3982 1.93993 46.2987 5.70903C37.1993 9.47813 28.9314 15.0026 21.967 21.967C15.0026 28.9314 9.47814 37.1993 5.70903 46.2987C1.93993 55.3982 -4.3052e-07 65.1509 0 75H3.75C3.75 65.6433 5.59294 56.3783 9.17358 47.7338C12.7542 39.0894 18.0025 31.2348 24.6186 24.6186C31.2348 18.0025 39.0894 12.7542 47.7338 9.17358C56.3783 5.59294 65.6433 3.75 75 3.75L75 0Z"
                    />
                </mask>
                <path
                    d="M75 0C65.1509 0 55.3982 1.93993 46.2987 5.70903C37.1993 9.47813 28.9314 15.0026 21.967 21.967C15.0026 28.9314 9.47814 37.1993 5.70903 46.2987C1.93993 55.3982 -4.3052e-07 65.1509 0 75H3.75C3.75 65.6433 5.59294 56.3783 9.17358 47.7338C12.7542 39.0894 18.0025 31.2348 24.6186 24.6186C31.2348 18.0025 39.0894 12.7542 47.7338 9.17358C56.3783 5.59294 65.6433 3.75 75 3.75L75 0Z"
                    fill="#E8ECF3"
                    stroke="url(#paint0_linear_117_1032)"
                    stroke-width="16"
                    mask="url(#path-1-inside-1_117_1032)"
                ></path>
                <defs>
                    <linearGradient
                        id="paint0_linear_117_1032"
                        x1="0"
                        y1="75"
                        x2="150"
                        y2="75"
                        gradientUnits="userSpaceOnUse"
                    >
                        <stop stop-color="#407CDE" stop-opacity="0" />
                        <stop offset="1" stop-color="#407CDE" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
    </div>
    <div v-scroll="'opacity'" class="no-info" v-if="empty && !wait">
        <img src="../../../../assets/img/img_no-info.webp" alt="no_info" />
        <span>{{ $t("no_info") }}</span>
    </div>
</template>

<script>
export default {
    name: "no-info",
    props: {
        wait: Boolean,
        end: Boolean,
        empty: {
            type: Boolean,
            default: false,
        },
        interval: {
            type: Number,
            default: 15,
        },
    },
    data() {
        return {
            progressPercentage: 0,
            intervalId: null,
        };
    },
    watch: {
        end: {
            deep: true,
            handler(val) {
                if (val) {
                    clearInterval(this.intervalId);
                    this.intervalId = setInterval(() => {
                        if (this.progressPercentage < 100) {
                            this.progressPercentage += 1;
                        } else {
                            clearInterval(this.intervalId);
                        }
                    }, 200 / (100 - this.progressPercentage));
                }
            },
        },
        progressPercentage: {
            deep: true,
            handler(val) {
                if (this.progressPercentage >= 79) {
                    this.intervalId = setInterval(() => {
                        if (this.progressPercentage < 98) {
                            this.progressPercentage += 1;
                        }
                    }, 500);
                }
            },
        },
    },
    created() {
        this.intervalId = setInterval(() => {
            if (this.progressPercentage < 80) {
                this.progressPercentage += 1;
            } else {
                clearInterval(this.intervalId);
            }
        }, this.interval);
    },
    beforeUnmount() {
        clearInterval(this.intervalId);
    },
};
</script>

<style lang="scss">
.no-info {
    display: flex;
    flex-direction: column;
    gap: 28px;
    align-items: center;
    transition: all 1.5s ease 0s;
    &.no-bg {
        background: transparent !important;
    }
    img {
        width: 150px;
        height: 150px;
    }
}
</style>

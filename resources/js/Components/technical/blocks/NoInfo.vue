<template>
    <div
        v-scroll="'opacity'"
        class="no-info no-bg"
        v-if="!wait && empty && Object.entries($slots).length > 0"
    >
        <slot />
    </div>
    <div
        class="no-info cabinet__block cabinet__block-light"
        v-scroll="'opacity transition--fast'"
        v-else-if="wait || empty"
    >
        <div
            class="propeller"
            :class="{ 'propeller-end': typeof progressPercentage === 'string' }"
        >
            <svg
                width="150"
                height="152"
                viewBox="0 0 150 152"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <mask
                    id="path-1-inside-1_1006_37019"
                    fill="white"
                >
                    <path
                        d="M129.609 126.409C141.845 113.411 149.044 96.4754 149.911 78.6458C150.779 60.8162 145.259 43.2616 134.343 29.1373C123.427 15.0131 107.832 5.24527 90.3594 1.58958C72.887 -2.0661 54.6836 0.630035 39.0209 9.19341C23.3583 17.7568 11.2636 31.6258 4.91057 48.3078C-1.44243 64.9898 -1.63709 83.3908 4.36157 100.203C10.3602 117.016 22.1589 131.138 37.6368 140.031C53.1148 148.924 71.2571 152.004 88.8029 148.719L88.1128 145.033C71.4442 148.154 54.209 145.227 39.505 136.779C24.8009 128.331 13.5922 114.915 7.89349 98.9433C2.19476 82.9712 2.37969 65.4903 8.41504 49.6424C14.4504 33.7945 25.9404 20.6189 40.8199 12.4837C55.6994 4.34853 72.9926 1.7872 89.5914 5.26011C106.19 8.73301 121.006 18.0124 131.376 31.4305C141.746 44.8485 146.99 61.5253 146.166 78.4635C145.341 95.4017 138.503 111.49 126.879 123.838L129.609 126.409Z"
                    />
                </mask>
                <path
                    class="propeller_preloader"
                    :class="{ 'propeller_preloader-scale': typeof progressPercentage === 'string' }"
                    ref="preloader_line"
                    stroke-dasharray="0"
                    stroke-dashoffset="0"
                    d="M129.609 126.409C141.845 113.411 149.044 96.4754 149.911 78.6458C150.779 60.8162 145.259 43.2616 134.343 29.1373C123.427 15.0131 107.832 5.24527 90.3594 1.58958C72.887 -2.0661 54.6836 0.630035 39.0209 9.19341C23.3583 17.7568 11.2636 31.6258 4.91057 48.3078C-1.44243 64.9898 -1.63709 83.3908 4.36157 100.203C10.3602 117.016 22.1589 131.138 37.6368 140.031C53.1148 148.924 71.2571 152.004 88.8029 148.719L88.1128 145.033C71.4442 148.154 54.209 145.227 39.505 136.779C24.8009 128.331 13.5922 114.915 7.89349 98.9433C2.19476 82.9712 2.37969 65.4903 8.41504 49.6424C14.4504 33.7945 25.9404 20.6189 40.8199 12.4837C55.6994 4.34853 72.9926 1.7872 89.5914 5.26011C106.19 8.73301 121.006 18.0124 131.376 31.4305C141.746 44.8485 146.99 61.5253 146.166 78.4635C145.341 95.4017 138.503 111.49 126.879 123.838L129.609 126.409Z"
                    fill="#E8ECF3"
                    stroke="url(#paint0_linear_1006_37019)"
                    stroke-width="16"
                    mask="url(#path-1-inside-1_1006_37019)"
                >
                    <animateTransform
                        id="preloader_rotate"
                        calcMode="linear"
                        attributeName="transform"
                        type="rotate"
                        begin="0s"
                        fill="freeze"
                        from="0"
                        to="360"
                        dur="1.2s"
                        repeatCount="indefinite"
                    />
                    <animate
                        id="preloader_width"
                        attributeName="stroke-dashoffset"
                        values="208; 0"
                        calcMode="linear"
                        begin="0s"
                        fill="freeze"
                        dur="0.5s"
                        repeatCount="1"
                    />
                </path>
                <g
                    opacity="0.5"
                >
                    <path
                        d="M115 97.0181C115 100.311 113.422 103.541 110.471 105.525C105.773 108.698 99.3988 107.467 96.2152 102.767L89.6509 93.0427H89.6438L89.6157 92.9934L89.3339 92.5783C88.3408 91.1148 87.1505 89.8272 85.7982 88.7577C85.7771 88.7366 85.77 88.7225 85.7419 88.7014C85.7207 88.6803 85.7066 88.6733 85.6855 88.6662C82.9245 86.4991 79.5297 85.2044 75.9658 85.0004C75.6488 84.9793 75.3319 84.9722 75.0009 84.9722C74.3106 84.9722 73.6133 85.0074 72.9301 85.0989H72.9231C71.0637 85.3311 69.0775 85.9292 67.4082 86.7172C67.5491 86.6187 67.8942 86.4569 68.0491 86.3724C73.6274 83.2625 82.6851 81.0742 93.1373 81.0742H93.9825C101.695 81.0742 108.921 84.9019 113.232 91.2977C114.429 93.0427 115 95.041 115 97.0181Z"
                        fill="url(#paint1_linear_1006_37019)"
                    />
                    <path
                        d="M93.1376 81.0529C82.6924 81.0529 73.6277 83.2482 68.0494 86.3511C67.8945 86.4356 67.0986 86.8718 66.8943 86.9773C64.9574 88.0046 63.2178 89.4048 61.788 91.1076C61.633 91.2624 61.4922 91.4172 61.3513 91.572C59.034 94.105 53.7798 102.759 53.7798 102.759C50.6032 107.467 44.215 108.698 39.5171 105.518C39.1157 105.25 38.7353 104.948 38.3832 104.631C36.6787 103.09 35.587 101.078 35.1855 98.9388C34.8474 97.1868 34.9672 95.3504 35.5799 93.6195C35.8687 92.8103 36.2561 92.0223 36.7562 91.2835L39.9256 86.5904L41.0244 84.965L43.6656 81.06L66.3379 47.5116C68.3523 44.5283 71.6627 42.9452 75.0082 43.0015C76.9451 43.0226 78.8891 43.5855 80.6006 44.7394C83.5447 46.7236 85.1294 49.9532 85.1294 53.2531C85.1294 55.2373 84.5589 57.2285 83.3756 58.9876L75.0082 71.3712L68.458 81.06H93.1376V81.0529Z"
                        fill="url(#paint2_linear_1006_37019)"
                    />
                </g>
                <path
                    v-show="typeof progressPercentage === 'string'"
                    d="M97.6465 148.799C97.5527 148.893 97.5 149.02 97.5 149.152C97.5 149.285 97.5527 149.412 97.6465 149.506L99.4926 151.352C99.6879 151.547 100.004 151.547 100.2 151.352L110 141.552L119.8 151.352C119.996 151.547 120.312 151.547 120.507 151.352L122.354 149.506C122.447 149.412 122.5 149.285 122.5 149.152C122.5 149.02 122.447 148.893 122.354 148.799L112.553 138.999L122.354 129.2C122.447 129.106 122.5 128.979 122.5 128.846C122.5 128.713 122.447 128.586 122.354 128.492L120.507 126.646C120.312 126.451 119.996 126.451 119.8 126.646L110 136.446L100.2 126.646C100.004 126.451 99.6879 126.451 99.4926 126.646L97.6465 128.492C97.5527 128.586 97.5 128.713 97.5 128.846C97.5 128.979 97.5527 129.106 97.6465 129.2L107.447 138.999L97.6465 148.799Z"
                    fill="url(#paint3_linear_1006_37019)"
                    stroke="url(#paint4_linear_1006_37019)"
                    stroke-linejoin="round"
                />
                <defs>
                    <linearGradient
                        id="paint0_linear_1006_37019"
                        x1="75"
                        y1="0"
                        x2="75"
                        y2="150"
                        gradientUnits="userSpaceOnUse"
                    >
                        <stop
                            stop-color="#407CDE"
                            stop-opacity="0"
                        />
                        <stop
                            offset="1"
                            stop-color="#407CDE"
                        />
                    </linearGradient>
                    <linearGradient
                        id="paint1_linear_1006_37019"
                        x1="55.1476"
                        y1="79.7258"
                        x2="116.362"
                        y2="99.3162"
                        gradientUnits="userSpaceOnUse"
                    >
                        <stop
                            offset="0.2624"
                            stop-color="#000034"
                        />
                        <stop
                            offset="1"
                            stop-color="#3F7BDD"
                        />
                    </linearGradient>
                    <linearGradient
                        id="paint2_linear_1006_37019"
                        x1="82.8408"
                        y1="59.7451"
                        x2="53.5451"
                        y2="102.688"
                        gradientUnits="userSpaceOnUse"
                    >
                        <stop
                            stop-color="#3F7BDD"
                        />
                        <stop
                            offset="0.3617"
                            stop-color="#3F6FC6"
                        />
                        <stop
                            offset="0.7059"
                            stop-color="#3F68B8"
                        />
                        <stop
                            offset="1"
                            stop-color="#3F65B3"
                        />
                    </linearGradient>
                    <linearGradient
                        id="paint3_linear_1006_37019"
                        x1="101.735"
                        y1="164.833"
                        x2="123.537"
                        y2="162.596"
                        gradientUnits="userSpaceOnUse"
                    >
                        <stop
                            stop-color="#3F7BDD"
                        />
                        <stop
                            offset="1"
                            stop-color="#4282EC"
                        />
                    </linearGradient>
                    <linearGradient
                        id="paint4_linear_1006_37019"
                        x1="101.735"
                        y1="164.833"
                        x2="123.537"
                        y2="162.596"
                        gradientUnits="userSpaceOnUse"
                    >
                        <stop
                            stop-color="#3F7BDD"
                        />
                        <stop
                            offset="1"
                            stop-color="#4282EC"
                        />
                    </linearGradient>
                </defs>
            </svg>

            <span
                class="propeller_value"
                :class="{ 'propeller_value-end': typeof progressPercentage === 'string' }"
            >
                {{ progressPercentage }}
                <span
                    class="propeller_unit"
                    v-show="typeof progressPercentage === 'number'"
                >
                    %
                </span>
            </span>
        </div>
<!--        <transition name="no_info">-->
<!--            <img v-if="!wait && empty" src="../../../../assets/img/img_no-info.svg" alt="no_info" />-->
<!--        </transition>-->
<!--        <transition name="no_info">-->
<!--            <span v-if="!wait && empty">{{ $t("no_info") }}</span>-->
<!--        </transition>-->
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
        empty(newValue) {
            if (!this.wait && newValue) {
                clearInterval(this.intervalId);

                this.progressPercentage = this.$t("no_info");
            }
        },
        end: {
            deep: true,
            handler(newVal) {
                if (newVal) {
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
            handler(newVal, oldVal) {
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
    mounted() {
        this.intervalId = setInterval(() => {
            if (this.progressPercentage < 80) {
                this.progressPercentage += 1;
            } else {
                clearInterval(this.intervalId);
            }
        }, this.interval);

        console.log(this.$refs.preloader_line.getTotalLength());
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
    gap: 8px;
    align-items: center;
    justify-content: center;
    padding: 24px;
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

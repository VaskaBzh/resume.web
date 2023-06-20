<template>
    <div class="control section" ref="asics" :class="{ animated: animated }">
        <div class="control__container">
            <div class="control__content">
                <div class="control__head">
                    <main-title tag="h2" class="title-blue"
                        >Безупречный контроль доходов <br />
                        в реальном времени в течении
                        <span class="title-span"
                            ><span>дня</span> <span>и</span> <span>ночи</span>
                        </span></main-title
                    >
                    <transition name="sun-moon">
                        <img
                            v-show="!getTheme"
                            src="../../../../assets/img/light.png"
                            alt="light"
                            class="light"
                        />
                    </transition>
                    <transition name="sun-moon">
                        <img
                            v-show="getTheme"
                            src="../../../../assets/img/dark.png"
                            alt="dark"
                            class="dark"
                        />
                    </transition>
                </div>
                <div class="control__asics" ref="asic_container">
                    <div class="asic">
                        <img src="../../../../assets/img/ASIC.png" alt="asic" />
                        <div class="blinks blinks-red">
                            <div class="red"></div>
                            <div class="red"></div>
                            <div class="red"></div>
                        </div>
                        <div class="blinks blinks-green">
                            <div class="green"></div>
                            <div class="green"></div>
                            <div class="green"></div>
                        </div>
                        <transition name="asic-shadow">
                            <img
                                v-show="!getTheme"
                                src="../../../../assets/img/asic-sun.png"
                                alt="asic"
                                class="asic-shadow"
                            />
                        </transition>
                        <transition name="asic-shadow">
                            <img
                                v-show="getTheme"
                                src="../../../../assets/img/asic-moon.png"
                                alt="asic"
                                class="asic-shadow"
                            />
                        </transition>
                    </div>
                    <div class="asic">
                        <img src="../../../../assets/img/ASIC.png" alt="asic" />
                        <div class="blinks blinks-red">
                            <div class="red"></div>
                            <div class="red"></div>
                            <div class="red"></div>
                        </div>
                        <div class="blinks blinks-green">
                            <div class="green"></div>
                            <div class="green"></div>
                            <div class="green"></div>
                        </div>
                        <transition name="asic-shadow">
                            <img
                                v-show="!getTheme"
                                src="../../../../assets/img/asic-sun.png"
                                alt="asic"
                                class="asic-shadow"
                            />
                        </transition>
                        <transition name="asic-shadow">
                            <img
                                v-show="getTheme"
                                src="../../../../assets/img/asic-moon.png"
                                alt="asic"
                                class="asic-shadow"
                            />
                        </transition>
                    </div>
                    <div class="asic">
                        <img src="../../../../assets/img/ASIC.png" alt="asic" />
                        <div class="blinks blinks-red">
                            <div class="red"></div>
                            <div class="red"></div>
                            <div class="red"></div>
                        </div>
                        <div class="blinks blinks-green">
                            <div class="green"></div>
                            <div class="green"></div>
                            <div class="green"></div>
                        </div>
                        <transition name="asic-shadow">
                            <img
                                v-show="!getTheme"
                                src="../../../../assets/img/asic-sun.png"
                                alt="asic"
                                class="asic-shadow"
                            />
                        </transition>
                        <transition name="asic-shadow">
                            <img
                                v-show="getTheme"
                                src="../../../../assets/img/asic-moon.png"
                                alt="asic"
                                class="asic-shadow"
                            />
                        </transition>
                    </div>
                    <div class="asic">
                        <img src="../../../../assets/img/ASIC.png" alt="asic" />
                        <div class="blinks blinks-red">
                            <div class="red"></div>
                            <div class="red"></div>
                            <div class="red"></div>
                        </div>
                        <div class="blinks blinks-green">
                            <div class="green"></div>
                            <div class="green"></div>
                            <div class="green"></div>
                        </div>
                        <transition name="asic-shadow">
                            <img
                                v-show="!getTheme"
                                src="../../../../assets/img/asic-sun.png"
                                alt="asic"
                                class="asic-shadow"
                            />
                        </transition>
                        <transition name="asic-shadow">
                            <img
                                v-show="getTheme"
                                src="../../../../assets/img/asic-moon.png"
                                alt="asic"
                                class="asic-shadow"
                            />
                        </transition>
                    </div>
                    <div class="asic">
                        <img src="../../../../assets/img/ASIC.png" alt="asic" />
                        <div class="blinks blinks-red">
                            <div class="red"></div>
                            <div class="red"></div>
                            <div class="red"></div>
                        </div>
                        <div class="blinks blinks-green">
                            <div class="green"></div>
                            <div class="green"></div>
                            <div class="green"></div>
                        </div>
                        <transition name="asic-shadow">
                            <img
                                v-show="!getTheme"
                                src="../../../../assets/img/asic-sun.png"
                                alt="asic"
                                class="asic-shadow"
                            />
                        </transition>
                        <transition name="asic-shadow">
                            <img
                                v-show="getTheme"
                                src="../../../../assets/img/asic-moon.png"
                                alt="asic"
                                class="asic-shadow"
                            />
                        </transition>
                    </div>
                    <div class="asic">
                        <img src="../../../../assets/img/ASIC.png" alt="asic" />
                        <div class="blinks blinks-red">
                            <div class="red"></div>
                            <div class="red"></div>
                            <div class="red"></div>
                        </div>
                        <div class="blinks blinks-green">
                            <div class="green"></div>
                            <div class="green"></div>
                            <div class="green"></div>
                        </div>
                        <transition name="asic-shadow">
                            <img
                                v-show="!getTheme"
                                src="../../../../assets/img/asic-sun.png"
                                alt="asic"
                                class="asic-shadow"
                            />
                        </transition>
                        <transition name="asic-shadow">
                            <img
                                v-show="getTheme"
                                src="../../../../assets/img/asic-moon.png"
                                alt="asic"
                                class="asic-shadow"
                            />
                        </transition>
                    </div>
                    <div class="asic">
                        <img src="../../../../assets/img/ASIC.png" alt="asic" />
                        <div class="blinks blinks-red">
                            <div class="red"></div>
                            <div class="red"></div>
                            <div class="red"></div>
                        </div>
                        <div class="blinks blinks-green">
                            <div class="green"></div>
                            <div class="green"></div>
                            <div class="green"></div>
                        </div>
                        <transition name="asic-shadow">
                            <img
                                v-show="!getTheme"
                                src="../../../../assets/img/asic-sun.png"
                                alt="asic"
                                class="asic-shadow"
                            />
                        </transition>
                        <transition name="asic-shadow">
                            <img
                                v-show="getTheme"
                                src="../../../../assets/img/asic-moon.png"
                                alt="asic"
                                class="asic-shadow"
                            />
                        </transition>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import { mapGetters } from "vuex";

export default {
    name: "control-view",
    components: {
        MainTitle,
    },
    data() {
        return {
            animated: false,
        };
    },
    computed: {
        ...mapGetters(["getTheme"]),
    },
    watch: {
        animated(newBool) {
            if (newBool) {
                const asics =
                    this.$refs.asic_container.querySelectorAll(".asic");
                let leftPos = [
                    asics[0].offsetLeft,
                    asics[1].offsetLeft,
                    asics[2].offsetLeft,
                    asics[3].offsetLeft,
                    asics[4].offsetLeft,
                    asics[5].offsetLeft,
                    asics[6].offsetLeft,
                ];
                let topPos = [
                    asics[0].offsetTop,
                    asics[1].offsetTop,
                    asics[2].offsetTop,
                    asics[3].offsetTop,
                    asics[4].offsetTop,
                    asics[5].offsetTop,
                    asics[6].offsetTop,
                ];
                asics.forEach((asic) => {
                    this.$refs.asic_container.style.minHeight =
                        asics[3].clientHeight + topPos[3] + "px";
                    asic.style.position = "absolute";
                    asic.style.left = "50%";
                    asic.style.top = topPos[3] + "px";
                    asic.style.marginTop = "65px";
                    asic.style.marginLeft = -asics[3].clientHeight / 2 + "px";
                });
                setTimeout(() => {
                    asics[0].style.marginLeft = "0";
                    asics[1].style.marginLeft = "0";
                    asics[2].style.marginLeft = "0";
                    asics[4].style.marginLeft = "0";
                    asics[5].style.marginLeft = "0";
                    asics[6].style.marginLeft = "0";
                    asics[0].style.left = leftPos[2] + 30 + "px";
                    asics[1].style.left = leftPos[2] + 30 + "px";
                    asics[2].style.left = leftPos[2] + "px";
                    asics[4].style.left = leftPos[4] + "px";
                    asics[5].style.left = leftPos[4] + 30 + "px";
                    asics[6].style.left = leftPos[4] + 30 + "px";
                    asics[0].style.marginTop = topPos[2] + "px";
                    asics[1].style.marginTop = topPos[2] + "px";
                    asics[2].style.marginTop = topPos[2] + "px";
                    asics[4].style.marginTop = topPos[4] + "px";
                    asics[5].style.marginTop = topPos[4] + "px";
                    asics[6].style.marginTop = topPos[4] + "px";
                }, 1000);
                setTimeout(() => {
                    asics[0].style.left = leftPos[1] + 30 + "px";
                    asics[1].style.left = leftPos[1] + "px";
                    asics[5].style.left = leftPos[5] + "px";
                    asics[6].style.left = leftPos[5] + 30 + "px";
                    asics[0].style.marginTop = topPos[1] + "px";
                    asics[1].style.marginTop = topPos[1] + "px";
                    asics[5].style.marginTop = topPos[5] + "px";
                    asics[6].style.marginTop = topPos[5] + "px";
                }, 1500);
                setTimeout(() => {
                    asics[0].style.left = leftPos[0] + "px";
                    asics[6].style.left = leftPos[6] + "px";
                    asics[0].style.marginTop = topPos[0] + "px";
                    asics[6].style.marginTop = topPos[6] + "px";
                }, 2000);
                // setTimeout(() => {
                //     asics.forEach((asic) => {
                //         asic.removeAttribute("style");
                //     });
                // }, 3000);
            }
        },
    },
    methods: {
        animationInit() {
            let bool = true;
            const animationObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (
                        entry.isIntersecting &&
                        entry.boundingClientRect.bottom >
                            entry.boundingClientRect.height &&
                        bool
                    ) {
                        this.animated = true;
                        bool = false;
                        setTimeout(() => {
                            this.$store.dispatch("theme", !this.getTheme);
                            this.$store.dispatch("SetThemeVal", this.getTheme);
                        }, 2000);
                    }
                    // else if (entry.isIntersecting) {
                    //     this.animated = false;
                    // }
                });
            });
            animationObserver.observe(this.$refs.asics);
        },
    },
    mounted() {
        this.animationInit();
    },
};
</script>

<style scoped lang="scss">
.asic-shadow-enter-active,
.asic-shadow-leave-active {
    transition: opacity 0.8s ease;
}
.asic-shadow-enter-from,
.asic-shadow-leave-to {
    opacity: 0 !important;
}
.sun-moon {
    &-enter-active {
        animation: inAnim 0.8s ease forwards 0s;
    }
    &-leave-active {
        animation: outAnim 0.8s ease forwards 0s;
    }
}
@keyframes outAnim {
    from {
        transform: translate(-50%, 0);
        opacity: 1;
    }
    to {
        transform: translate(-100vw, 300px);
        opacity: 0;
    }
}
@keyframes inAnim {
    from {
        transform: translate(100vw, 300px);
        opacity: 0;
    }
    to {
        transform: translate(-50%, 0);
        opacity: 1;
    }
}
@keyframes fadeGreen {
    0% {
        opacity: 0;
    }
    20% {
        opacity: 1;
    }
    80% {
        opacity: 1;
    }
    100% {
        opacity: 0;
    }
}
@keyframes fadeRed {
    0% {
        opacity: 0;
    }
    20% {
        opacity: 1;
    }
    40% {
        opacity: 0;
    }
    90% {
        opacity: 1;
    }
    100% {
        opacity: 0;
    }
}
@keyframes fade {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
.control {
    &__content {
        display: flex;
        flex-direction: column;
        gap: 80px;
        align-items: center;
        @media (max-width: 479.98px) {
            gap: 64px;
        }
    }
    .title.title-blue {
        opacity: 0;
        transform: translateX(-200px);
        transition: all 0.3s ease 0.3s;
        .title-span {
            span {
                opacity: 0;
            }
        }
    }
    &.animated {
        .title.title-blue {
            opacity: 1;
            transform: translateX(0);
            .title-span {
                span {
                    animation: fade forwards 0.3s ease 1s;

                    &:nth-child(2) {
                        animation: fade forwards 0.3s ease 4.6s;
                    }

                    &:nth-child(3) {
                        animation: fade forwards 0.3s ease 2.6s;
                    }
                }
            }
        }
        .asic {
            .blinks {
                .green {
                    animation: fadeGreen linear forwards 3s 4.9s;
                }

                .red {
                    animation: fadeRed linear forwards 2s 2.9s;
                }
            }
            &:nth-child(2) {
                .blinks {
                    .green {
                        animation: fadeGreen linear forwards 3s 4.2s;
                    }

                    .red {
                        animation: fadeRed linear forwards 2s 2.4s;
                    }
                }
            }
            &:nth-child(6) {
                .blinks {
                    .green {
                        animation: fadeGreen linear forwards 3s 4.1s;
                    }

                    .red {
                        animation: fadeRed linear forwards 2s 2.1s;
                    }
                }
            }
            &:nth-child(3) {
                .blinks {
                    .green {
                        animation: fadeGreen linear forwards 3s 4.5s;
                    }

                    .red {
                        animation: fadeRed linear forwards 2s 2.5s;
                    }
                }
            }
            &:nth-child(5) {
                .blinks {
                    .green {
                        animation: fadeGreen linear forwards 3s 4.7s;
                    }

                    .red {
                        animation: fadeRed linear forwards 2s 2.7s;
                    }
                }
            }
            &:nth-child(4) {
                .blinks {
                    .green {
                        animation: fadeGreen linear forwards 3s 4.2s;
                    }

                    .red {
                        animation: fadeRed linear forwards 2s 2.2s;
                    }
                }
            }
            &:nth-child(7) {
                .blinks {
                    .green {
                        animation: fadeGreen linear forwards 3s 4s;
                    }

                    .red {
                        animation: fadeRed linear forwards 2s 2s;
                    }
                }
            }
        }
    }
    &__head {
        display: flex;
        flex-direction: column;
        padding-bottom: 260px;
        position: relative;
        align-items: center;
        @media (max-width: 479.98px) {
            gap: 32px;
        }
        .title {
            @media (min-width: 991.98px) {
                margin-bottom: 16px;
            }
            text-align: center;
        }
        img {
            width: 120px;
            height: 120px;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translate(-50%, 0);
            transition: all 1.3s ease 0s;
        }
    }
    &__asics {
        display: flex;
        justify-content: space-between;
        width: 100%;
        position: relative;
        @media (min-width: 1320.98px) {
            gap: 24px;
        }
        .asic {
            height: fit-content;
            width: 8%;
            filter: drop-shadow(0px 5.94951px 47.5961px rgba(27, 27, 27, 0.25));
            position: relative;
            transition: all 0.5s ease 0s;
            z-index: 0;
            img {
                width: 100%;
            }
            &-shadow {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                opacity: 0.2;
            }
            .blinks {
                position: absolute;
                right: 4.6%;
                top: 11.6%;
                min-height: 77%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                width: 4.6%;
                div {
                    width: 100%;
                    height: 4.7px;
                    border-radius: 50%;
                    mix-blend-mode: hard-light;
                    opacity: 0;
                    transition: all 0.3s ease 0s;
                }
                &-green {
                    right: 10.7%;
                }
                .green {
                    box-shadow: 0px 0px 65.5847px #4af2ba,
                        0px 0px 37.477px #4af2ba, 0px 0px 21.8616px #4af2ba,
                        0px 0px 10.9308px #4af2ba, 0px 0px 3.12308px #4af2ba,
                        0px 0px 1.56154px #4af2ba;
                }
                .red {
                    box-shadow: 0px 0px 65.5847px #eb0000,
                        0px 0px 37.477px #eb0000, 0px 0px 21.8616px #eb0000,
                        0px 0px 10.9308px #eb0000, 0px 0px 3.12308px #eb0000,
                        0px 0px 1.56154px #eb0000;
                }
            }
            &:nth-child(2),
            &:nth-child(6) {
                margin-top: 16px;
                width: 11%;
                z-index: 1;
                @media (max-width: 767.98px) {
                    margin-top: 8px;
                }
                @media (max-width: 479.98px) {
                    margin-top: 8px;
                }
                .blinks {
                    div {
                        height: 6.5px;
                    }
                }
            }
            &:nth-child(3),
            &:nth-child(5) {
                margin-top: 43px;
                width: 15%;
                z-index: 2;
                @media (max-width: 767.98px) {
                    margin-top: 23px;
                }
                @media (max-width: 479.98px) {
                    margin-top: 10px;
                }
                .blinks {
                    div {
                        height: 8.8px;
                    }
                }
            }
            &:nth-child(4) {
                margin-top: 65px;
                width: 21%;
                z-index: 3;
                @media (max-width: 767.98px) {
                    margin-top: 35px;
                }
                @media (max-width: 479.98px) {
                    margin-top: 16px;
                }
                .blinks {
                    div {
                        height: 12px;
                    }
                }
            }
        }
    }
}
</style>

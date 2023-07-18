<template>
    <div class="control section" :class="{ animated: animated || !setTheme }">
        <div class="control__container">
            <div class="control__content">
                <div class="control__head">
                    <main-title tag="h2" class="title-blue"
                        >{{ this.$t("hosting.control.title") }}
                        <span class="title-span"
                            ><span>{{
                                this.$t("hosting.control.spans[0]")
                            }}</span>
                            <span>
                                {{ this.$t("hosting.control.spans[1]") }}</span
                            >
                            <span>
                                {{ this.$t("hosting.control.spans[2]") }}</span
                            >
                        </span></main-title
                    >
                    <transition name="sun-moon">
                        <img
                            v-show="!getTheme"
                            src="../../../../assets/img/light.svg"
                            alt="light"
                            class="light"
                        />
                    </transition>
                    <transition name="sun-moon">
                        <img
                            v-show="getTheme"
                            src="../../../../assets/img/dark.svg"
                            alt="dark"
                            class="dark"
                        />
                    </transition>
                </div>
                <div class="control__asics" ref="asic_container">
                    <div
                        :key="i"
                        class="asic"
                        :class="{ 'asic-dark': getTheme }"
                        v-for="(_, i) in [1, 1, 1, 1, 1, 1, 1]"
                    >
                        <img
                            src="../../../../assets/img/ASIC.webp"
                            alt="asic"
                        />
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
                                src="../../../../assets/img/asic-sun.webp"
                                alt="asic"
                                class="asic-shadow"
                            />
                        </transition>
                        <transition name="asic-shadow">
                            <img
                                v-show="getTheme"
                                src="../../../../assets/img/asic-moon.webp"
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
            animationObserver: null,
            setTheme: true,
            asics: null,
            timeouts: [],
        };
    },
    computed: {
        ...mapGetters(["getTheme"]),
    },
    watch: {
        animated(newBool) {
            if (newBool) {
                let leftPos = [
                    this.asics[0].offsetLeft,
                    this.asics[1].offsetLeft,
                    this.asics[2].offsetLeft,
                    this.asics[3].offsetLeft,
                    this.asics[4].offsetLeft,
                    this.asics[5].offsetLeft,
                    this.asics[6].offsetLeft,
                ];
                let topPos = [
                    this.asics[0].offsetTop,
                    this.asics[1].offsetTop,
                    this.asics[2].offsetTop,
                    this.asics[3].offsetTop,
                    this.asics[4].offsetTop,
                    this.asics[5].offsetTop,
                    this.asics[6].offsetTop,
                ];
                this.$refs.asic_container.style.minHeight =
                    this.asics[3].clientHeight + topPos[3] + "px";
                this.asics.forEach((asic) => {
                    asic.style.transition = "all 0s ease 0s";
                    asic.style.position = "absolute";
                    asic.style.left = "50%";
                    // asic.style.top = topPos[3] + "px";
                    asic.style.marginTop = topPos[3] + "px";
                    asic.style.transform = "translateX(-50%)";
                    setTimeout(
                        () => (asic.style.transition = "all 0.5s ease 0s"),
                        300
                    );
                });
                this.timeouts.push(
                    setTimeout(() => {
                        this.asics[0].style.transform = "none";
                        this.asics[1].style.transform = "none";
                        this.asics[2].style.transform = "none";
                        this.asics[4].style.transform = "none";
                        this.asics[5].style.transform = "none";
                        this.asics[6].style.transform = "none";
                        this.asics[0].style.left =
                            leftPos[2] + this.asics[0].scrollWidth / 4 + "px";
                        this.asics[1].style.left =
                            leftPos[2] + this.asics[1].scrollWidth / 4 + "px";
                        this.asics[2].style.left = leftPos[2] + "px";
                        this.asics[4].style.left = leftPos[4] + "px";
                        this.asics[5].style.left =
                            leftPos[4] + this.asics[5].scrollWidth / 4 + "px";
                        this.asics[6].style.left =
                            leftPos[4] + this.asics[6].scrollWidth / 4 + "px";
                        this.asics[0].style.marginTop = topPos[2] + "px";
                        this.asics[1].style.marginTop = topPos[2] + "px";
                        this.asics[2].style.marginTop = topPos[2] + "px";
                        this.asics[4].style.marginTop = topPos[4] + "px";
                        this.asics[5].style.marginTop = topPos[4] + "px";
                        this.asics[6].style.marginTop = topPos[4] + "px";
                    }, 1000)
                );
                this.timeouts.push(
                    setTimeout(() => {
                        this.asics[0].style.left =
                            leftPos[1] + this.asics[0].scrollWidth / 4 + "px";
                        this.asics[1].style.left = leftPos[1] + "px";
                        this.asics[5].style.left = leftPos[5] + "px";
                        this.asics[6].style.left =
                            leftPos[5] + this.asics[6].scrollWidth / 4 + "px";
                        this.asics[0].style.marginTop = topPos[1] + "px";
                        this.asics[1].style.marginTop = topPos[1] + "px";
                        this.asics[5].style.marginTop = topPos[5] + "px";
                        this.asics[6].style.marginTop = topPos[5] + "px";
                    }, 1500)
                );
                this.timeouts.push(
                    setTimeout(() => {
                        this.asics[0].style.left = leftPos[0] + "px";
                        this.asics[6].style.left = leftPos[6] + "px";
                        this.asics[0].style.marginTop = topPos[0] + "px";
                        this.asics[6].style.marginTop = topPos[6] + "px";
                    }, 2000)
                );
                this.timeouts.push(
                    setTimeout(() => {
                        this.asics.forEach((asic) => {
                            asic.style.transition = "none";
                            asic.removeAttribute("style");
                        });
                    }, 3000)
                );
            }
        },
    },
    methods: {
        animationInit() {
            let bool = true;
            this.animationObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting && bool) {
                        this.animated = true;
                        bool = false;
                        setTimeout(() => {
                            if (this.setTheme) {
                                this.$store.dispatch("theme", !this.getTheme);
                                this.$store.dispatch(
                                    "SetThemeVal",
                                    this.getTheme
                                );
                            }
                        }, 2000);
                    }
                    if (!bool && !entry.isIntersecting) {
                        this.stopAnimation();
                    }
                });
            });
            this.animationObserver.observe(this.$refs.asic_container);
        },
        stopAnimation() {
            this.setTheme = false;
            this.asics.forEach((asic) => {
                asic.style.transition = "all 0s linear 0s";
                asic.removeAttribute("style");
            });
            this.$refs.asic_container?.removeAttribute("style");
            this.animationObserver.disconnect();
            this.timeouts.forEach((timeoutId) => clearTimeout(timeoutId));
            this.timeouts = [];
        },
    },
    mounted() {
        this.animationInit();
        this.asics = this.$refs.asic_container.querySelectorAll(".asic");
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
        animation: inAnim 2s ease forwards 0s, opacityIn 0.5s ease forwards 0s;
    }
    &-leave-active {
        animation: outAnim 2s ease forwards 0s, opacityOut 0.5s ease forwards 0s;
    }
}
@keyframes outAnim {
    from {
        transform: translate(-50%, 0);
        opacity: 1;
    }
    to {
        transform: translate(-100vw, 385px);
        opacity: 0;
    }
}
@media (max-width: 767.98px) {
    @keyframes outAnim {
        from {
            transform: translate(-50%, 0);
            opacity: 1;
        }
        to {
            transform: translate(-100vw, 200px);
            opacity: 0;
        }
    }
}
@keyframes opacityIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
@keyframes opacityOut {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
    }
}
@keyframes inAnim {
    from {
        transform: translate(100vw, 385px);
        opacity: 0;
    }
    to {
        transform: translate(-50%, 0);
        opacity: 1;
    }
}
@media (max-width: 767.98px) {
    @keyframes inAnim {
        from {
            transform: translate(100vw, 200px);
            opacity: 0;
        }
        to {
            transform: translate(-50%, 0);
            opacity: 1;
        }
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
            display: inline-flex;
            gap: 12px;
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
                        animation: fade forwards 0.3s ease 1.5s;
                    }

                    &:nth-child(3) {
                        animation: fade forwards 0.3s ease 2s;
                    }
                }
            }
        }
        @media (min-width: 767.98px) {
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
    }
    &__head {
        display: flex;
        flex-direction: column;
        padding-bottom: 260px;
        position: relative;
        align-items: center;
        @media (max-width: 767.98px) {
            padding-bottom: 136px;
        }
        @media (max-width: 479.98px) {
            padding-bottom: 88px;
        }
        .title {
            @media (min-width: 991.98px) {
                margin-bottom: 16px;
            }
            text-align: center;
        }
        img {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translate(-50%, 0);
            transition: all 1.3s ease 0s;
            @media (max-width: 767.98px) {
                width: 96px;
                height: 96px;
            }
            @media (max-width: 479.98px) {
                width: 56px;
                height: 56px;
            }
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
            position: relative;
            box-shadow: 0 8.499305725097656px 67.99444580078125px 0
                rgba(27, 27, 27, 0.15);
            z-index: 0;
            &-dark {
                box-shadow: none;
            }
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

<template>
    <div class="system__section system__section-wrap" ref="view">
        <div class="system-card-inf">
            <p class="system-card-title">
                {{ $t("system_monitoring.title[0]") }} <br />
                {{ $t("system_monitoring.title[1]") }} <br />
                {{ $t("system_monitoring.title[2]") }}
            </p>
            <p class="system-card-text">{{ $t("system_monitoring.text") }}</p>
        </div>
        <div class="system-card-img">
            <img
                src="../assets/img/Mockup-mac.png"
                class="img-mac img-system web"
            />
            <img
                src="../assets/img/Mockup-monitoring.png"
                class="img-monitoring img-system web"
            />

            <img
                src="../assets/img/Mockup-iphone.png"
                class="img-mac img-system mobile"
            />
            <img
                src="../assets/img/Mockup-monitoring-iphone.png"
                class="img-monitoring img-system mobile"
            />
        </div>
        <p class="get-consultation">{{ $t("system_monitoring.button") }}</p>
    </div>
</template>
<script>
import { HostingMessage } from "@/modules/hosting/lang/HostingMessage";

export default {
    i18n: {
        sharedMessages: HostingMessage,
    },
    data() {
        return {
            validScroll: false,
            startY: null,
            touchY: null,
        };
    },
    props: {
        start: Boolean,
    },
    methods: {
        handleTouchStart(e) {
            this.startY = e.touches[0].clientY;
        },
        handleTouchMove(e) {
            this.touchY = e.touches[0].clientY;
            this.handleWheel();
        },
        handleWheel(e) {
            if (this.startY ? this.startY - this.touchY > 110 : e.deltaY > 10) {
                this.remove();
                setTimeout(this.scroll, 650);

                if (
                    this.$refs.view.offsetHeight -
                        document.scrollingElement.clientHeight >
                        20 &&
                    !this.validScroll
                ) {
                    this.$refs.view.style.transform = `translateY(-${
                        this.$refs.view.offsetHeight -
                        document.scrollingElement.clientHeight
                    }px)`;

                    this.validScroll = true;
                } else {
                    this.$emit("next");
                }
            }
            if (
                this.startY ? this.touchY - this.startY > 110 : e.deltaY < -10
            ) {
                this.remove();
                setTimeout(this.scroll, 650);

                if (
                    this.$refs.view.offsetHeight -
                        document.scrollingElement.clientHeight >
                        20 &&
                    this.validScroll
                ) {
                    this.$refs.view.style.transform = `translateY(0px)`;

                    this.validScroll = false;
                } else {
                    this.$emit("prev");
                }
            }
        },
        scroll() {
            if (this.$refs.view) {
                this.$refs.view.focus();
                this.$refs.view.addEventListener("wheel", this.handleWheel);
                this.$refs.view.addEventListener(
                    "touchstart",
                    this.handleTouchStart
                );
                this.$refs.view.addEventListener(
                    "touchmove",
                    this.handleTouchMove
                );
            }
        },
        remove() {
            if (this.$refs.view) {
                this.$refs.view.removeEventListener("wheel", this.handleWheel);
                this.$refs.view.removeEventListener(
                    "touchstart",
                    this.handleTouchStart
                );
                this.$refs.view.removeEventListener(
                    "touchmove",
                    this.handleTouchMove
                );
            }
        },
    },
    watch: {
        start(newStartState) {
            if (newStartState) {
                this.scroll();
            } else {
                this.remove();
            }
        },
    },
    mounted() {
        this.scroll();
    },
    unmounted() {
        this.remove();
    },
};
</script>
<style scoped>

.system-card-inf {
    width: 100%;
    max-width: 399px;
    margin-bottom: 50px;
}

.system-card-title {
    color: var(--gray-1100, #f5faff);
    font-family: Unbounded;
    font-size: 36px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 43.2px */
    text-transform: uppercase;
    margin-bottom: 20px;
}

.system-card-text {
    color: var(--gray-170, rgba(245, 250, 255, 0.7));
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 110%; /* 19.8px */
}

.system-card-img {
    position: relative;
    max-width: 1428px;
    width: 100%;
    height: 820px;
    margin-bottom: clamp(40px, 5vw, 50px);
}

.img-system {
    position: absolute;
}

.img-monitoring {
    max-width: 80%;
    transform: translateX(-50%);
    left: 50%;
    top: 34px;
}

.get-consultation {
    color: var(--gray-1100, #f5faff);
    text-align: center;
    font-family: Unbounded;
    font-size: 14px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 16.8px */
    text-transform: uppercase;
    border-radius: 40px;
    border: 1px solid rgba(192, 228, 255, 0.6);
    background: var(--gray-480, rgba(13, 13, 13, 0.8));
    padding: 8px 20px;
    width: 100%;
    max-width: 400px;
}

.img-mac {
    z-index: 10;
}

.mobile {
    display: none;
    max-width: 80%;
    transform: translateX(-50%);
    left: 50%;
}

@media (max-width: 1450px) {
    .system-card-img,
    .img-mac {
        width: 100%;
        height: 423px;
    }

    .img-monitoring {
        width: 100%;
        height: 365px;
    }

    .get-consultation {
        width: 100%;
        max-width: 80%;
    }

    .system-card-title {
        font-size: 24px;
    }
}

@media (max-width: 450px) {
    .mobile {
        display: inline-block;
    }

    .web {
        display: none;
    }

    .system-card-img,
    .img-mac {
        width: 100%;
        height: 497px;
    }

    .img-monitoring {
        height: 482px;
        top: 9px;
        width: 65%;
    }

    .system-card-inf {
        width: 100%;
    }

    .system-card-title {
        font-size: 18px;
    }

    .system-card-text {
        font-size: 14px;
    }

    .get-consultation {
        width: 100%;
        max-width: 328px;
        font-size: 12px;
    }
}
</style>

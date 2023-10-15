<template>
    <a href="https://t.me/allbtc_support" target="_blank" class="connect-withus" ref="view">
        <div class="connect-withus__run">
            <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
            <button-blue class="connect-withus_btn" />
        </div>
        <div class="connect-withus__run">
            <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
            <button-blue class="connect-withus_btn" />
        </div>
        <div class="connect-withus__run">
            <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
            <button-blue class="connect-withus_btn" />
        </div>
        <div class="connect-withus__run">
            <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
            <button-blue class="connect-withus_btn" />
        </div>
        <div class="connect-withus__run">
            <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
            <button-blue class="connect-withus_btn" />
        </div>
        <div class="connect-withus__run">
            <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
            <button-blue class="connect-withus_btn" />
        </div>
        <div class="connect-withus__run">
            <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
            <button-blue class="connect-withus_btn" />
        </div>
        <div class="connect-withus__run">
            <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
            <button-blue class="connect-withus_btn" />
        </div>
    </a>
</template>

<script>
import ButtonBlue from "../../../common/Components/UI/ButtonBlue.vue";
import { HomeMessage } from "@/modules/home/lang/HomeMessage";

export default {
    name: "ConnectWithUsView",
    components: { ButtonBlue },
    i18n: {
        sharedMessages: HomeMessage,
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
            if (this.$refs.view) {
                // if (this.startY ? this.startY - this.touchY > 110 : e.deltaY > 10) {
                //     this.remove();
                //     setTimeout(this.scroll, 300);
                //     if (
                //         this.$refs.view.offsetHeight -
                //             document.scrollingElement.clientHeight >
                //             20 &&
                //         !this.validScroll
                //     ) {
                //         this.$refs.view.style.transform = `translateY(-${
                //             this.$refs.view.offsetHeight -
                //             document.scrollingElement.clientHeight
                //         }px)`;
                //
                //         this.validScroll = true;
                //     } else {
                //         this.$emit("next");
                //     }
                // }
                if (
                    this.startY
                        ? this.touchY - this.startY > 110
                        : e.deltaY < -10
                ) {
                    this.remove();
                    setTimeout(this.scroll, 300);

                    if (
                        this.$refs.view.offsetHeight -
                            document.scrollingElement.clientHeight >
                            20 &&
                        this.validScroll
                    ) {
                        this.$refs.view.style.transform =
                            window.innerHeight >= 1100 || window.innerWidth < 991
                                ? `translateY(0px)`
                                : `translateY(0px) scale(0.8)`;

                        this.validScroll = false;
                    } else {
                        this.remove();
                        this.$emit("prev");
                    }
                }
            }
        },
        scroll() {
            // if (this.$refs.view) {
            //     this.$refs.view.focus();
            document.body.addEventListener("wheel", this.handleWheel);
            document.body.addEventListener("touchstart", this.handleTouchStart);
            document.body.addEventListener("touchmove", this.handleTouchMove);
            // }
        },
        remove() {
            // console.log(this.$refs.view);
            // if (this.$refs.view) {
            //     this.$refs.view.style.minHeight = `100vh`;
            // }
            document.body.removeEventListener("wheel", this.handleWheel);
            document.body.removeEventListener(
                "touchstart",
                this.handleTouchStart
            );
            document.body.removeEventListener(
                "touchmove",
                this.handleTouchMove
            );
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
        setTimeout(this.scroll, 500);

        this.$refs.view.style.minHeight = `100vh`;

        setTimeout(() => {
            this.$refs.view.style.minHeight = `calc(100vh - ${
                document.querySelector(".footer-content").offsetHeight +
                document.querySelector(".all-content").offsetHeight
            }px)`;
        }, 800);
    },
    unmounted() {
        this.remove();
    },
};
</script>

<style scoped lang="scss">
.connect-withus {
    display: flex;
    min-height: 100vh;
    align-items: center;
    font-size: 0;
    justify-content: center;
    animation: scroll 7s linear 1s infinite;
    transition: all 0.5s ease 0s;
    outline: none;
    border: none;

    @keyframes scroll {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(35%);
        }
    }

    &_text {
        color: #f5faff;
        font-family: Unbounded, serif;
        font-size: 55px;
        font-style: normal;
        font-weight: 600;
        line-height: 120%;
        text-transform: uppercase;
        white-space: nowrap;
    }
}

.connect-withus__run {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    margin-left: 70px;
}
</style>

<template>
    <div class="connect-withus connect-withus__section" ref="view">
        <a
            href="https://t.me/allbtc_support"
            class="connect-withus__content"
            target="_blank"
        >
            <div class="connect-withus__run">
                <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
                <button-blue class="connect-withus_btn"/>
            </div>
            <div class="connect-withus__run">
                <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
                <button-blue class="connect-withus_btn"/>
            </div>
            <div class="connect-withus__run">
                <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
                <button-blue class="connect-withus_btn"/>
            </div>
            <div class="connect-withus__run">
                <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
                <button-blue class="connect-withus_btn"/>
            </div>
            <div class="connect-withus__run">
                <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
                <button-blue class="connect-withus_btn"/>
            </div>
            <div class="connect-withus__run">
                <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
                <button-blue class="connect-withus_btn"/>
            </div>
            <div class="connect-withus__run">
                <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
                <button-blue class="connect-withus_btn"/>
            </div>
            <div class="connect-withus__run">
                <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
                <button-blue class="connect-withus_btn"/>
            </div>
        </a>
    </div>
</template>

<script>
import ButtonBlue from "../../../common/Components/UI/ButtonBlue.vue";
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import {mapGetters} from "vuex";

export default {
    name: "ConnectWithUsView",
    components: {ButtonBlue},
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
    computed: {
        ...mapGetters(["viewportWidth"]),
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
                if (
                    this.startY
                        ? this.startY - this.touchY > 110
                        : e.deltaY > 10
                ) {
                    this.remove();
                    setTimeout(this.scroll, 650);

                    if (
                        this.$refs.view.offsetHeight -
                        document.scrollingElement.clientHeight >
                        20 &&
                        !this.validScroll
                    ) {
                        this.validScroll = true;
                    } else {
                        this.$emit("next");
                    }
                }
                if (
                    this.startY
                        ? this.touchY - this.startY > 110
                        : e.deltaY < -10
                ) {
                    this.remove();
                    setTimeout(this.scroll, 650);

                    if (
                        this.$refs.view.offsetHeight -
                        document.scrollingElement.clientHeight >
                        20 &&
                        this.validScroll
                    ) {
                        this.validScroll = false;
                    } else {
                        this.$emit("prev");
                    }
                }
            }
        },
        scroll() {
            document.body.addEventListener("wheel", this.handleWheel);
            document.body.addEventListener("touchstart", this.handleTouchStart);
            document.body.addEventListener("touchmove", this.handleTouchMove);
        },
        remove() {
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
        document.querySelector(
            ".footer-content"
        ).style.transform = `translateY(100%)`;
        document.querySelector(
            ".layout__container"
        ).style.transform = `translateY(0)`;
        document.querySelector(".layout__container").style.minHeight = `100vh`;
        document.querySelector(
            ".all-content"
        ).style.transform = `translateY(100%)`;
        setTimeout(() => {
            document.querySelector(
                ".footer-content"
            ).style.transform = `translateY(-${
                document.querySelector(".all-content").offsetHeight +
                80 +
                (this.viewportWidth < 768.98
                    ? document.querySelector(".footer-content").offsetHeight
                    : 0)
            }px)`;
            document.querySelector(
                ".layout__container"
            ).style.transform = `translateY(-${
                document.querySelector(".all-content").offsetHeight +
                80 +
                (this.viewportWidth < 768.98
                    ? document.querySelector(".footer-content").offsetHeight
                    : 0)
            }px)`;
            document.querySelector(
                ".all-content"
            ).style.transform = `translateY(-${
                document.querySelector(".all-content").offsetHeight +
                80 +
                (this.viewportWidth < 768.98
                    ? document.querySelector(".footer-content").offsetHeight
                    : 0)
            }px)`;

            this.$refs.view.style.minHeight = "100vh";
            setTimeout(this.scroll, 500);
        }, 1600);
    },
    unmounted() {
        this.remove();
        document.querySelector(
            ".footer-content"
        ).style.transform = `translateY(100%)`;
        document.querySelector(
            ".layout__container"
        ).style.transform = `translateY(0)`;
        document.querySelector(".layout__container").style.minHeight = `auto`;
        document.querySelector(
            ".all-content"
        ).style.transform = `translateY(100%)`;
        setTimeout(this.scroll, 500);
    },
};
</script>

<style scoped lang="scss">
.connect-withus {
    min-height: 300px;
    justify-content: flex-end;

    &__content {
        display: flex;
        align-items: center;
        font-size: 0;
        justify-content: center;
        flex-direction: row;
        animation: scroll 3s linear 0s infinite;
        outline: none;
        border: none;
    }

    @keyframes scroll {
        0% {
            transform: translateX(0%);
        }
        100% {
            transform: translateX(12.5%);
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

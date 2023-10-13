<template>
    <div class="connect-withus" ref="view">
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
    </div>
</template>

<script>
import ButtonBlue from "../../../common/Components/UI/ButtonBlue.vue";
import {HomeMessage} from "@/modules/home/lang/HomeMessage";

export default {
    name: "ConnectWithUsView",
    components: {ButtonBlue},
    i18n: {
        sharedMessages: HomeMessage,
    },
    data() {
        return {
            validScroll: false,
        };
    },
    props: {
        start: Boolean,
    },
    methods: {
        handleWheel(e) {
            if (e.deltaY > 50) {
                if (!this.validScroll) {
                    this.$refs.view.style.transform = `translateY(-${
                        this.$refs.view.offsetHeight -
                        document.scrollingElement.clientHeight
                    }px)`;

                    this.validScroll = true;
                } else {
                    this.$emit("next");
                }
            }
            if (e.deltaY < -50) {
                if (this.validScroll) {
                    this.$refs.view.style.transform = `translateY(0px)`;

                    this.validScroll = false;
                } else {
                    this.$emit("prev");
                }
            }
        },
        scroll() {
            this.$refs.view.addEventListener("wheel", this.handleWheel);
        },
        remove() {
            if (this.$refs.view) {
                this.$refs.view.removeEventListener("wheel", this.handleWheel);
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

<style scoped lang="scss">
.connect-withus {
    height: 20vh;
    display: flex;
    align-items: center;
    font-size: 0;
    justify-content: center;
    animation: scroll 7s linear 1s infinite;

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

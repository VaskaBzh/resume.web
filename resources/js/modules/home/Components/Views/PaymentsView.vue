<template>
    <div class="payments payments__section" ref="view">
        <faq-view :faq="faq" :headline="$t('payments.button')"/>
    </div>
</template>

<script>
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import FaqView from "@/modules/home/Components/Views/FaqView.vue";
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";

export default {
    name: "payments-view",
    components: {
        LandingTitle,
        FaqView,
    },
    computed: {
        faq() {
            return [
                {
                    title: "fPPS+",
                    preTitle: this.$t("payments.title[0]"),
                    text: this.$t("payments.text[0]"),
                },
                {
                    title: "(msk) 12:00-13:00",
                    preTitle: this.$t("payments.title[1]"),
                    text: this.$t("payments.text[1]"),
                },
                {
                    title: "fPPS+",
                    preTitle: this.$t("payments.title[2]"),
                    text: this.$t("payments.text[2]"),
                },
            ];
        },
    },
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
            if (this.startY
                ? this.startY - this.touchY > 110
                : e.deltaY > 10) {
                this.remove();
                setTimeout(this.scroll, 300);
                if (
                    this.$refs.view.offsetHeight -
                    document.scrollingElement.clientHeight >
                    20 && !this.validScroll) {
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
                setTimeout(this.scroll, 300);

                if (
                    this.$refs.view.offsetHeight -
                    document.scrollingElement.clientHeight >
                    20 && this.validScroll) {
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

<style scoped lang="scss">
.payments {
    &__content {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    &_title {
        max-width: 300px;
        display: flex;
        flex-direction: column;
        margin-bottom: clamp(70px, 5vw, 140px);

        &_elem {
            white-space: nowrap;

            &-left {
                transform: translateX(-180px);
            }
        }
    }
}
</style>

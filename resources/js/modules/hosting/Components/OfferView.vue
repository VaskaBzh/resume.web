<template>
    <article class="third-text hosting__section" ref="view">
        <landing-headline class="how-are-we">{{
            $t("offer.button")
        }}</landing-headline>
        <div class="offer-content">
            <span class="text-offer">{{ $t("offer.title[0]") }}</span>
            <div class="text-offer-column">
                <span class="text-offer">{{ $t("offer.title[1]") }}<br /></span>
                <span class="text-offer">{{ $t("offer.title[2]") }}<br /></span>
            </div>
            <span class="text-offer text-end"
                >{{ $t("offer.title[3]") }}<br
            /></span>
        </div>
        <div class="offer-card-container">
            <div class="offer-card" v-for="offer in offers">
                <div>
                    <p class="offer-title">{{ offer.percent }}</p>
                    <p class="offer-title">{{ offer.title }}</p>
                </div>
                <p class="offer-text">{{ offer.text }}</p>
            </div>
        </div>
    </article>
</template>

<script>
import LandingHeadline from "@/modules/common/Components/UI/LandingHeadline.vue";
import { HostingMessage } from "@/modules/hosting/lang/HostingMessage";
export default {
    name: "offer-view",
    components: { LandingHeadline },
    i18n: {
        sharedMessages: HostingMessage,
    },
    data() {
        return {
            offers: [
                {
                    percent: this.$t("offer.cards.title[0]"),
                    title: this.$t("offer.cards.title[1]"),
                    text: this.$t("offer.cards.text[0]"),
                },
                {
                    percent: this.$t("offer.cards.title[2]"),
                    title: this.$t("offer.cards.title[3]"),
                    text: this.$t("offer.cards.text[1]"),
                },
            ],
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
.text-end {
    display: flex;
    justify-content: end;
}
.offer-text {
    color: var(--gray-170, rgba(245, 250, 255, 0.7));
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 110%; /* 19.8px */
    width: 280px;
}
.offer-title {
    color: var(--gray-3100, #d0d5dd);
    font-family: Unbounded;
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 19.2px */
    text-transform: uppercase;
}
.offer-content {
    color: var(--gray-1100, #f5faff);
    text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
    font-family: Unbounded;
    font-size: 55px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 66px */
    text-transform: uppercase;
}
.text-offer-column {
    margin-left: 195px;
}
.offer-card-container {
    display: flex;
    justify-content: flex-end;
    margin-right: 137px;
    gap: 20px;
}
.offer-card {
    border-radius: 40px;
    border-top: 2px solid #555353;
    border-bottom: 0.5px solid #555353;
    background: var(--gray-480, rgba(13, 13, 13, 0.8));
    display: inline-flex;
    padding: 30px;
    flex-direction: column;
    align-items: flex-start;
    gap: 30px;
    width: 385px;
}
@media (max-width: 850px) {
    .offer-card-container {
        margin-right: 0px;
        justify-content: center;
    }
    .offer-content {
        font-size: 36px;
    }
}
@media (max-width: 768px) {
    .offer-card-container {
        margin-right: 0px;
        justify-content: center;
        align-items: center;
        flex-flow: column nowrap;
    }
}
@media (max-width: 450px) {
    .offer-card-container {
        flex-direction: column;
    }
    .offer-content {
        font-size: 22px;
        padding: 0 16px;
        margin-top: 30px;
    }
    .offer-text {
        font-size: 14px;
        width: auto;
    }
    .offer-card {
        width: 328px;
        padding: 20px;
    }
    .text-offer-column {
        margin-left: 75px;
    }
    .offer-title {
        font-size: 14px;
    }
}
</style>

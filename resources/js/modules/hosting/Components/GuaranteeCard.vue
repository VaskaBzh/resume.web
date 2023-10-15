<template>
    <div class="guarantee__section guarantee__section-blue" ref="view">
        <div class="guarantee-card">
            <p class="title-card">{{ $t("guarantees.title") }}</p>
            <p class="text-card">{{ $t("guarantees.text") }}</p>
        </div>
        <faq-view :faq="faq"> </faq-view>
    </div>
</template>
<script>
import { HostingMessage } from "@/modules/hosting/lang/HostingMessage";
import FaqView from "../../home/Components/Views/FaqView.vue";

export default {
    i18n: {
        sharedMessages: HostingMessage,
    },
    components: {
        FaqView,
    },
    data() {
        return {
            isOpenAccordion: false,
            validScroll: false,
            startY: null,
            touchY: null,
        };
    },
    computed: {
        faq() {
            return [
                {
                    title: this.$t("guarantees.list.title[0]"),
                    text: this.$t("guarantees.list.text[0]"),
                },
                {
                    title: this.$t("guarantees.list.title[1]"),
                    text: this.$t("guarantees.list.text[1]"),
                },
                {
                    title: this.$t("guarantees.list.title[2]"),
                    text: this.$t("guarantees.list.text[2]"),
                },
            ];
        },
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
                    this.$refs.view.style.transform =
                        window.innerHeight >= 900 || window.innerWidth < 991
                            ? `translateY(-${
                                  this.$refs.view.offsetHeight -
                                  document.scrollingElement.clientHeight
                              }px)`
                            : `translateY(-${
                                  this.$refs.view.offsetHeight -
                                  document.scrollingElement.clientHeight
                              }px) scale(0.8)`;

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
                    this.$refs.view.style.transform =
                        window.innerHeight >= 900 || window.innerWidth < 991
                            ? `translateY(0px)`
                            : `translateY(0px) scale(0.8)`;

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
.guarantee-block {
    display: flex;
    flex-direction: column;
    width: 100%;
}

.title-card {
    color: var(--gray-1100, #f5faff);
    font-family: Unbounded;
    font-size: 36px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 43.2px */
    text-transform: uppercase;
    margin-bottom: 20px;
}

.text-system {
    width: 380px;
}

.text-card {
    color: var(--gray-170, rgba(245, 250, 255, 0.7));
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 110%; /* 19.8px */
}

.title-hosting {
    color: var(--gray-1100, #f5faff);
    text-align: right;
    font-family: Unbounded;
    font-size: 55px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 66px */
    text-transform: uppercase;
}

.guarantee-card {
    width: 464px;
    margin: 0 auto;
    margin-bottom: 100px;
}

.income-system-card {
    display: flex;
    justify-content: space-between;
}

.gray-line {
    padding: 32px 100px;
    border-bottom: 0.5px solid var(--gray-240, rgba(228, 231, 236, 0.4));
}

.gray-line-top {
    border-top: 0.5px solid var(--gray-240, rgba(228, 231, 236, 0.4));
}

.accordion-button {
    display: none;
}

.card-row {
    display: flex;
    justify-content: space-between;
    width: 100%;
}

@media (max-width: 950px) {
    .title-card {
        font-size: 24px;
    }

    .guarantee-card {
        width: 354px;
        margin-bottom: 80px;
        margin-top: 100px;
    }

    .card-row {
        flex-direction: column-reverse;
        align-items: flex-start;
    }

    .title-hosting {
        text-align: inherit;
        width: 100%;
        font-size: 44px;
    }

    .accordion-button {
        display: inline-block;
        height: 30px;
        margin-top: 32px;
        /* align-self: center; */
    }

    .guarantee-block {
        padding: 0;
    }

    .text-system {
        width: 590px;
    }

    .gray-line {
        padding: 30px 32px;
    }

    .text-web {
        display: none;
    }
}

@media (max-width: 450px) {
    .title-card {
        font-size: 18px;
    }

    .text-card {
        font-size: 14px;
    }

    .title-hosting {
        font-size: 22px;
    }

    .guarantee-card {
        width: 244px;
        margin-bottom: 70px;
    }

    .gray-line {
        padding: 20px 16px;
    }

    .text-system {
        width: 328px;
    }

    .card-row {
        gap: 10px;
    }

    .accordion-button {
        margin-top: 12px;
    }
}
</style>

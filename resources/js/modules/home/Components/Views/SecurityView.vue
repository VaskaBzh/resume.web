<template>
    <div class="security security__section" ref="view">
        <div class="security__wrapper">
            <landing-headline class="security__headline">{{
                    $t("safety.button")
                }}
            </landing-headline>
            <landing-wrap :title="infoCards[key].title">
                <template v-slot:content>
                    <landing-text
                        class="security_text animation-up animation-opacity"
                    >
                        {{ infoCards[key].text }}
                    </landing-text>
                </template>
            </landing-wrap>
        </div>
        <div class="security__hidden"></div>
    </div>
</template>

<script>
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import LandingHeadline from "@/modules/common/Components/UI/LandingHeadline.vue";
import LandingWrap from "@/modules/common/Components/blocks/LandingWrap.vue";
import LandingText from "@/modules/common/Components/UI/LandingText.vue";

export default {
    name: "SecurityView",
    components: {
        LandingText,
        LandingWrap,
        LandingHeadline,
    },
    props: {
        start: Boolean,
    },
    i18n: {
        sharedMessages: HomeMessage,
    },
    computed: {
        infoCards() {
            return {
                encryption: {
                    title: this.$t("safety.encryption.title"),
                    text: this.$t("safety.encryption.text"),
                },
                updates: {
                    title: this.$t("safety.updates.title"),
                    text: this.$t("safety.updates.text"),
                },
                DDoS: {
                    title: this.$t("safety.DDoS.title"),
                    text: this.$t("safety.DDoS.text"),
                },
            };
        },
    },
    data() {
        return {
            key: "encryption",
            keys: ["encryption", "updates", "DDoS"],
            validScroll: false,
            startY: null,
            touchY: null,
            progress: 0,
        };
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
                if (this.progress === 0) {
                    this.key = "encryption";
                    this.progress++;
                } else if (this.progress === 1) {
                    this.key = "updates";
                    this.progress++;
                } else if (this.progress === 2) {
                    this.key = "DDoS";

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
            }
            if (
                this.startY ? this.touchY - this.startY > 110 : e.deltaY < -10
            ) {
                this.remove();
                setTimeout(this.scroll, 650);

                if (this.progress === 2) {
                    this.key = "DDoS";
                    this.progress--;
                } else if (this.progress === 1) {
                    this.key = "updates";
                    this.progress--;
                } else if (this.progress === 0) {
                    this.key = "encryption";

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
.security {
    width: 100%;
}

@media (max-width: 767.87px) {
    .security {
        min-width: calc(100% - 64px);
    }
}

.security__hidden {
    opacity: 0;
    height: 0;
    max-width: 860px;
    width: 100%;
}

@media (max-width: 767.87px) {
    .security__headline {
        margin-bottom: 135px;
    }
}

.security__wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
}

@media (max-width: 1500.87px) {
    .security__wrapper {
        gap: 50px;
    }
}
</style>

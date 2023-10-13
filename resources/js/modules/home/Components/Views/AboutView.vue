<template>
    <div class="about about__section" ref="view">
        <div class="about__wrapper">
            <landing-headline>{{ $t("who_we_are.button") }}</landing-headline>
            <landing-wrap :title="infoCards[key].title">
                <template v-slot:content>
                    <div class="about__cards animation-up animation-opacity">
                        <about-info
                            class="about__card"
                            v-for="(card, i) in infoCards[key].cards"
                            :key="i"
                            :title="card.title"
                            :text="card.text"
                            :hint="card.hint"
                            :prefix="card.prefix"
                        />
                    </div>
                </template>
                <template v-slot:link>
                    <a href="#" class="about_link">
                        {{ $t("who_we_are.card_private.button[0]") }}
                        <landing-arrow-right class="about_icon"/>
                    </a>
                </template>
            </landing-wrap>
            <landing-button>
                <template v-slot:text
                >{{ $t("who_we_are.card_private.button[1]") }}
                </template>
            </landing-button>
        </div>
    </div>
</template>

<script>
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import LandingHeadline from "@/modules/common/Components/UI/LandingHeadline.vue";
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";
import AboutInfo from "@/modules/home/Components/blocks/AboutInfo.vue";
import LandingButton from "@/modules/common/Components/UI/LandingButton.vue";
import LandingWrap from "@/modules/common/Components/blocks/LandingWrap.vue";
import LandingArrowRight from "@/modules/common/icons/LandingArrowRight.vue";

export default {
    name: "about-view",
    components: {
        LandingArrowRight,
        LandingWrap,
        LandingButton,
        AboutInfo,
        LandingTitle,
        LandingHeadline,
    },
    i18n: {
        sharedMessages: HomeMessage,
    },
    computed: {
        infoCards() {
            return {
                hostings: {
                    title: this.$t("who_we_are.card_private.title[0]"),
                    cards: [
                        {
                            title: ">3",
                            text: this.$t("who_we_are.card_private.text[1]"),
                        },
                        {
                            title: "1.7",
                            text: this.$t("who_we_are.card_private.text[2]"),
                        },
                        {
                            title: "30",
                            text: this.$t("who_we_are.card_private.text[3]"),
                        },
                        {
                            prefix: this.$t("who_we_are.card_private.text[3]"),
                            title: "50%",
                            text: this.$t("who_we_are.card_private.text[4]"),
                        },
                    ],
                },
                miners: {
                    title: this.$t("who_we_are.card_community.title[0]"),
                    cards: [
                        {
                            title: "№1",
                            text: this.$t("who_we_are.card_community.text[1]"),
                        },
                        {
                            title: "24/7",
                            text: this.$t("who_we_are.card_community.text[2]"),
                        },
                        {
                            title: "1",
                            text: this.$t("who_we_are.card_community.text[3]"),
                        },
                        {
                            title: "4%",
                            text: this.$t("who_we_are.card_community.text[4]"),
                            hint: this.$t("who_we_are.card_community.tooltip"),
                        },
                    ],
                },
            };
        },
    },
    data() {
        return {
            key: "hostings",
            keys: ["hostings", "miners"],
            validScroll: false,
            progress: 0,
        };
    },
    props: {
        start: Boolean,
    },
    methods: {
        handleWheel(e) {
            if (e.deltaY > 50) {
                this.remove();
                setTimeout(this.scroll, 500);
                if (this.progress === 0) {
                    this.key = "miners";
                    this.progress++;
                } else if (this.progress === 1) {
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
            }
            if (e.deltaY < -50) {
                this.remove();
                setTimeout(this.scroll, 500);

                if (this.progress === 1) {
                    this.key = "hostings";
                    this.progress--;
                } else if (this.progress === 0) {
                    if (this.validScroll) {
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
                this.$refs.view.addEventListener("wheel", this.handleWheel);
            }
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
.about {
    width: 100%;

    &__cards {
        display: flex;
        flex-direction: column;
        gap: clamp(50px, 10vw, 30px);
    }

    &__wrapper {
        display: flex;
        flex-direction: column;
        width: 100%;
        align-items: center;
    }

    &_link {
        width: 100%;
        height: 100%;
        white-space: pre-wrap;
    }
}
</style>

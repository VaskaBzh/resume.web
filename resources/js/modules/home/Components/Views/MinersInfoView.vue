<template>
    <div class="miners miners__section" ref="view">
        <faq-view :faq="faq" :headline="$t('why_allbtc.button')">
            <template v-slot:title>
                <landing-title tag="h3" class="faq_title miners_title">
                    <span class="miners_title_elem">{{
                            $t("why_allbtc.title[0]")
                        }}</span>
                    <span class="miners_title_elem miners_title_elem-left">{{
                            $t("why_allbtc.title[1]")
                        }}</span>
                    <span class="miners_title_elem">{{
                            $t("why_allbtc.title[2]")
                        }}</span>
                    <span class="miners_title_elem">{{
                            $t("why_allbtc.title[3]")
                        }}</span>
                </landing-title>
            </template>
        </faq-view>
    </div>
</template>

<script>
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import FaqView from "@/modules/home/Components/Views/FaqView.vue";
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";

export default {
    name: "MinersInfoView",
    components: {
        LandingTitle,
        FaqView,
    },
    computed: {
        faq() {
            return [
                {
                    title: this.$t("why_allbtc.list.title[0]"),
                    text: this.$t("why_allbtc.list.text[0]"),
                },
                {
                    title: this.$t("why_allbtc.list.title[1]"),
                    text: this.$t("why_allbtc.list.text[1]"),
                },
                {
                    title: this.$t("why_allbtc.list.title[2]"),
                    text: this.$t("why_allbtc.list.text[2]"),
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
                this.remove();
                setTimeout(this.scroll, 500);

                if (this.validScroll) {
                    this.$refs.view.style.transform = `translateY(0px)`;

                    this.validScroll = false;
                } else {
                    this.$emit("prev");
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
.miners {
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

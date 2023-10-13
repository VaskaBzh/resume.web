<template>
    <div class="mission-view mission__section" ref="view">
        <div class="mission-view__container">
            <head-line class="mission-view_btn">{{ $t("main.button") }}</head-line>
            <div class="mission-view_items">
                <div class="mission-view_item">
                    <h3 class="mission-view_item_transparent-one">{{ $t("main.title[0]") }}</h3>
                    <h3 class="mission-view_item_title">{{ $t("main.title[0]") }}</h3>
                    <p class="mission-view_item_text">{{ $t("main.text[0]") }}</p>
                </div>
                <div class="mission-view_item">
                    <h3 class="mission-view_item_transparent-two">{{ $t("main.title[1]") }}</h3>
                    <h3 class="mission-view_item_title-two">{{ $t("main.title[1]") }}</h3>
                    <p class="mission-view_item_text-two">{{ $t("main.text[1]") }}.</p>
                </div>
                <div class="mission-view_item">
                    <h3 class="mission-view_item_transparent-three">{{ $t("main.title[2]") }}</h3>
                    <h3 class="mission-view_item_title-three">{{ $t("main.title[2]") }}</h3>
                    <p class="mission-view_item_text-three">{{ $t("main.text[2]") }}</p>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import HeadLine from "../../../common/Components/UI/HeadLine.vue";
import {HomeMessage} from "@/modules/home/lang/HomeMessage";

export default {
    name: "MissionView",
    components: {HeadLine},
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
}
</script>


<style scoped lang="scss">

.mission-view {
    height: 100vh;
    display: flex;
    flex-flow: column nowrap;
    align-items: center;
    justify-content: center;

    &_items {
        width: 50vw;
        height: 40vh;
        border-radius: 40px;
        border-top: 2px solid #555353;
        border-bottom: 0.5px solid #555353;
        background: rgba(13, 13, 13, 0.5);
        backdrop-filter: blur(10px);
        display: flex;
        flex-flow: column nowrap;
        justify-content: center;
        gap: 10px;
    }

    &_item {
        width: 115%;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        justify-content: space-between;
        overflow: hidden;
        position: relative;
        left: -327px;
        top: 0;

        &_transparent-one {
            color: #f5faff;
            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
            font-family: Unbounded, serif;
            font-size: 110px;
            font-style: normal;
            font-weight: 600;
            line-height: 100%;
            text-transform: uppercase;
            width: 50%;
            position: absolute;
            top: 0;
            left: 0;
            transform: translate(0%, 110%);
        }

        &_transparent-two {
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text;
            -webkit-text-stroke: 0.5px rgb(255, 255, 255, 0.5);
            color: transparent;
            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
            font-family: Unbounded, serif;
            font-size: 110px;
            font-style: normal;
            font-weight: 600;
            line-height: 100%;
            text-transform: uppercase;
            width: 50%;
            position: absolute;
            top: 0;
            left: 0;
            transform: translate(0%, -100%);
        }

        &_transparent-three {
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text;
            -webkit-text-stroke: 0.5px rgb(255, 255, 255, 0.5);
            color: transparent;
            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
            font-family: Unbounded, serif;
            font-size: 110px;
            font-style: normal;
            font-weight: 600;
            line-height: 100%;
            text-transform: uppercase;
            width: 50%;
            position: absolute;
            top: 0;
            left: 0;
            transform: translate(0%, -100%);
        }

        &_title {
            color: #F5FAFF;
            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
            font-family: Unbounded, serif;
            font-size: 110px;
            font-style: normal;
            font-weight: 600;
            line-height: 100%;
            text-transform: uppercase;
            width: 50%;

        }

        &_title-two {
            color: #f5faff;
            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
            font-family: Unbounded, serif;
            font-size: 110px;
            font-style: normal;
            font-weight: 600;
            line-height: 100%;
            text-transform: uppercase;
            width: 50%;
        }

        &_title-three {
            color: #F5FAFF;
            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
            font-family: Unbounded, serif;
            font-size: 110px;
            font-style: normal;
            font-weight: 600;
            line-height: 100%;
            text-transform: uppercase;
            width: 50%;
        }

        &_text {
            width: 380px;
            color: rgba(245, 250, 255, 0.70);
            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
            font-family: NunitoSans, serif;
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            line-height: 110%;
        }

        &_text-two {
            width: 380px;
            color: rgba(245, 250, 255, 0.70);
            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
            font-family: NunitoSans, serif;
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            line-height: 110%;
        }

        &_text-three {
            width: 380px;
            color: rgba(245, 250, 255, 0.70);
            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
            font-family: NunitoSans, serif;
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            line-height: 110%;
        }
    }
}

</style>

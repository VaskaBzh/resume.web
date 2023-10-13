<template>
    <div class="wrap">
        <landing-title tag="h2" class="wrap_title" ref="title"></landing-title>
        <div class="wrap__content">
            <slot name="content"/>
        </div>
        <div class="wrap_link" v-if="$slots.link">
            <slot name="link"/>
        </div>
    </div>
</template>

<script>
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";
import {LineUp, LineUpBack, opacity,} from "../../../home/services/AnimationService.js";

export default {
    name: "landing-wrap",
    components: {
        LandingTitle,
    },
    props: {
        title: String,
    },
    methods: {
        splitUpTitle() {
            if (this.$refs.title) {
                this.$refs.title.$el.innerHTML = "";

                this.title.split(" ").forEach((titleElem) => {
                    this.$refs.title.$el.innerHTML += `<span class="animation-up_line"><span class="animation-up">${titleElem}</span></span>`;
                });
            }
        },
        splitOpacityTitle() {
            if (this.$refs.title) {
                this.$refs.title.$el.innerHTML = "";

                this.title.split(" ").forEach((titleElem) => {
                    this.$refs.title.$el.innerHTML += `<span class="animation-up_line"><span class="animation-opacity animation-up">${titleElem}</span></span>`;
                });
            }
        },
    },
    watch: {
        title() {
            LineUpBack();

            setTimeout(() => {
                this.splitUpTitle();
                LineUp();
            }, 450);
        },
    },
    mounted() {
        this.splitOpacityTitle();
        setTimeout(opacity, 500);
    },
};
</script>

<style scoped>
.wrap {
    border-radius: 40px;
    border-top: 2px solid #555353;
    border-bottom: 0.5px solid #555353;
    background: var(--gray-480, rgba(13, 13, 13, 0.8));
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    gap: 50px;
    width: 100%;
    max-width: clamp(860px, 10vw, 100%);
    height: clamp(680px, 10vw, 444px);
    margin-bottom: clamp(20px, 10vw, 30px);
    position: relative;
}

.wrap__content {
    position: absolute;
    overflow: hidden;
    left: 50%;
    max-width: 380px;
}

.wrap_link {
    border-radius: 50%;
    background: var(--gray-320, rgba(208, 213, 221, 0.2));
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    flex-direction: column;
    gap: 6px;
    width: 170px;
    height: 170px;
    position: absolute;
    right: -85px;
    top: 54px;
    color: var(--gray-3100, #d0d5dd);
    font-family: Unbounded, serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 120%;
    text-transform: uppercase;
    visibility: hidden;
}

.wrap_title {
    transform: translateX(-50%);
    max-width: 600px;
    display: flex;
    flex-wrap: wrap;
    gap: 0 10px;
}
</style>

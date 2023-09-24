<template>
    <div class="progress">
        <div class="progress__head">
            <main-title class="headline">
                {{ title }}
            </main-title>
            <div class="progress_icon">
                <!-- <TooltipCard></TooltipCard> -->
            </div>
        </div>
        <div class="progress__block">
            <div class="progress__row">
                <span class="progress_value">{{ progress }} {{ unit }}</span>
                <span class="progress_value">{{ final }} {{ unit }}</span>
            </div>
            <div class="progress__bar">
                <span class="progress_line" ref="progress_line"></span>
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "./MainTitle.vue";
import anime from "animejs/lib/anime.es.js";
// import TooltipCard from "@/modules/common/Components/UI/TooltipCard.vue"
export default {
    name: "main-progress-bar",
    props: {
        title: String,
        hint: String,
        progress: Number,
        final: Number,
        unit: String,
    },
    components: {
        MainTitle,
        // TooltipCard
    },
    computed: {
        percent() {
            const onePercent = this.final / 100;

            return this.progress / onePercent;
        }
    },
    watch: {
        progress() {
            this.initProgress();
        }
    },
    methods: {
        initProgress() {
            anime({
                targets: this.$refs.progress_line,
                width: `${this.percent}%`,
                easing: 'easeInOutQuad',
            });
        }
    },
    mounted() {
        this.initProgress();
    },
}
</script>

<style scoped>
.progress {
    width: 100%;
}
.progress__head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
}
.progress_icon {
    width: 20px;
    height: 20px;
}
.progress__block {
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.progress__row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.progress_value {
    color: var(--text-primary-80);
    font-family: Unbounded, serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 145%;
}
.progress__bar {
    min-height: 16px;
    border-radius: 16px;
    background: var(--primary-4007, rgba(83, 177, 253, 0.07));
    position: relative;
    width: 100%;
}
.progress_line {
    border-radius: 16px;
    opacity: 0.8;
    background: var(--primary-500, #2E90FA);
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 0;
    max-width: 100%;
}
</style>

<template>
    <div class="layout">
        <main-background/>
        <header-component/>
        <div class="layout__container">
            <slot/>
        </div>
        <FooterHosting></FooterHosting>
    </div>
</template>

<script>
import HeaderComponent from "@/modules/common/Components/HeaderComponent.vue";
import FooterHosting from "../modules/hosting/Components/FooterHosting.vue";
import MainBackground from "../modules/background/Components/MainBackground.vue";

export default {
    components: {
        MainBackground,
        FooterHosting,
        HeaderComponent,
    },

    async created() {
        await this.$store.dispatch("getMiningStat");
        await this.$store.dispatch("getGraph");
    },

    mounted() {
        const canvasBackgroundWorker = new Worker("/resources/js/modules/background/animationWorkers/canvasBackground.js?t=1697532300239");

        canvasBackgroundWorker.postMessage('startAnimation');

        canvasBackgroundWorker.onmessage = (e) => {
            if (e.data === 'animationFrame') {
                this.drawAnimationFrame();
            }
        }

        // canvasBackgroundWorker.postMessage('stopAnimation');
    },

    methods: {
        drawAnimationFrame() {
        },
    },
};
</script>

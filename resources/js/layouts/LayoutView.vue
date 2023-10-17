<template>
    <div class="layout">
        <main-background ref="mainBackground"/>
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
        const canvasBackgroundWorker = new Worker("../modules/background/animationWorkers/canvasBackground.js");

        canvasBackgroundWorker.postMessage('startAnimation');

        // Обработка сообщений от веб-воркера
        canvasBackgroundWorker.onmessage = (e) => {
            // Обработка сообщений (если необходимо)
            // Например, можно проверить e.data и выполнять какие-либо действия на основе полученных данных
        }

        // canvasBackgroundWorker.postMessage('stopAnimation');
    },
};
</script>

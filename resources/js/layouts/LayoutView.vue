<template>
    <div class="layout">
        <main-background :canvas="canvas"/>
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
import {startAnimation} from "../modules/background/animationWorkers/canvasBackground";

export default {
    components: {
        MainBackground,
        FooterHosting,
        HeaderComponent,
    },

    data() {
        return {
            canvas: null,
            ctx: null,
            particles: [],
        };
    },

    async created() {
        await this.$store.dispatch("getMiningStat");
        await this.$store.dispatch("getGraph");
    },

    mounted() {
        this.canvas = this.$refs.mainBackgroundCanvas;
        // this.ctx = this.canvas.getContext('2d');
        console.log(this.$refs, "pfsad")
        startAnimation(this.canvas, this.ctx, this.particles);
    },
};
</script>

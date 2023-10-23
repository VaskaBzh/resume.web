<template>
    <div class="background">
        <div class="background_filter"></div>
        <canvas ref="canvas" width="100%" height="100%">
        </canvas>
    </div>
</template>

<script>

import {BackgroundService} from "../services/BackgroundService";

export default {
    name: "main-background",

    mounted() {
        this.initBackgroundService();
    },
    methods: {
        initBackgroundService() {
            const canvas = this.$refs.canvas;
            BackgroundService(canvas);
        }
    }

};
</script>

<style scoped>
.background {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 0;
}

canvas {
    filter: blur(70px) brightness(0.5);
}


.background_filter {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 0;
    pointer-events: none;
}
</style>

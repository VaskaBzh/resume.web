<template>
    <div class="background">
        <div class="background_filter"></div>
        <canvas ref="canvas" width="100%" height="100%">
            Oh no! Your browser doesn't support canvas!
        </canvas>
    </div>
</template>

<script>
import {BackgroundService} from "../services/BackgroundService";

export default {
    name: "main-background",
    data() {
        return {
            service: new BackgroundService(),
        };
    },
    mounted() {
        this.service.canvas.setElement(this.$refs.canvas);
        this.service.getContext();
        this.service.resizeEvent();
        this.service.startProcess();
        this.service.mouseEvent();
    },
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

.background_filter {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 0;
    -webkit-backdrop-filter: blur(70px) brightness(0.5);
    pointer-events: none;
}
</style>

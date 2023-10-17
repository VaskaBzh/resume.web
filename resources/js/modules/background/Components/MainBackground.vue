<template>
    <div class="background">
        <div class="background_filter"></div>
        <canvas ref="mainBackgroundCanvas" width="100%" height="100%">
        </canvas>
    </div>
</template>

<script>
export default {
    name: "main-background",
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

<template>
    <Teleport to="body">
        <div class="un-click" v-if="wait === true"></div>
    </Teleport>
</template>

<script>
export default {
    name: "in-click-view",
    props: {
        wait: Boolean,
    }
}
</script>

<style scoped>
.un-click {
	position: fixed;
	z-index: 9999;
	left: 0;
	top: 0;
	width: 100vw;
	height: 100vh;
}
</style>

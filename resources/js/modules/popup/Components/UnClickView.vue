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

</style>

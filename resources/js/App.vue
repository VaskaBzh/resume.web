<template>
    <app-layout-view>
        <router-view />
    </app-layout-view>
</template>

<script>
import AppLayoutView from "./AppLayoutView.vue";

export default {
    name: "app",
    components: {
        AppLayoutView,
    }
}
</script>

<style scoped lang="scss">

</style>

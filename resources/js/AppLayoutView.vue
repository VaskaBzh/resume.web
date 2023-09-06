<template>
    <component :is="route.meta.layoutComponent">
        <slot />
    </component>
</template>

<script>
import { useRoute } from "vue-router";

export default {
    name: "app-layout-view",
    computed: {
        route() {
            return useRoute();
        }
    }
}
</script>

<style scoped lang="scss">

</style>

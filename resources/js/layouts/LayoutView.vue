<template>
    <div class="app_back">
        <slot />
    </div>
</template>

<script>

import HomaPage from "../Pages/HomePage.vue";

export default {
    data() {
        return {
            show: false
        }
    },
    components: {HomaPage},

    async created() {
        await this.$store.dispatch("getMiningStat");
        await this.$store.dispatch("getGraph");
    },
}

</script>

<style lang="scss" scoped>
</style>

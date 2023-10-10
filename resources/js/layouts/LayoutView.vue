<template>
    <div class="app_back">
        <slot />
    </div>
</template>

<script>

import HomaPage from "../Pages/HomePage.vue";
import gsap from 'gsap';
export default {
    data() {
        return {
            show: false
        }
    },
    components: {HomaPage},
    methods: {


    },
    async created() {
        await this.$store.dispatch("getMiningStat");
        await this.$store.dispatch("getGraph");
    },
}

</script>

<style lang="scss" scoped>
</style>

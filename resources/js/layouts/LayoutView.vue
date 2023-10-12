<template>
    <div class="app_back">
        <slot/>
    </div>
</template>

<script>
export default {
    async created() {
        await this.$store.dispatch("getMiningStat");
        await this.$store.dispatch("getGraph");
    },
};
</script>

<style lang="scss" scoped>
.app_back {
    background: #0d0d0d;
}
</style>

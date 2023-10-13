<template>
    <div class="layout">
        <header-component/>
        <div class="layout__container">
            <slot/>
        </div>
        <FooterHosting></FooterHosting>
    </div>
</template>

<script>
import HeaderComponent from "@/modules/common/Components/HeaderComponent.vue";
import FooterHosting from "../modules/hosting/Components/FooterHosting.vue";

export default {
    components: {
        FooterHosting,
        HeaderComponent,
    },

    async created() {
        await this.$store.dispatch("getMiningStat");
        await this.$store.dispatch("getGraph");
    },
};
</script>

<style scoped>
.layout {
    background: #0d0d0d;
    display: flex;
    width: 100vw;
    flex-direction: column;
    overflow-x: hidden;
}

.layout__container {
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    max-width: 1920px;
    width: 100%;
    padding: 0 clamp(16px, 5vw, 100px);
    margin: 0 auto;
    z-index: 10;
}

@media (max-width: 1920px) {
    .layout__container {
        margin: 0;
        width: auto;
    }
}
</style>

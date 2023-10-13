<template>
    <div class="layout">
        <header-component/>
        <div class="layout__container">
            <slot/>
        </div>
        <footer-component-land/>
    </div>
</template>

<script>
import HeaderComponent from "@/modules/common/Components/HeaderComponent.vue";
import FooterComponentLand from "@/modules/common/Components/FooterComponentLand.vue";

export default {
    components: {
        FooterComponentLand,
        HeaderComponent,
    },
    // mounted() {
    //     paralaxLayot();
    // },
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
    margin: 0 auto;
    z-index: 10;
}

@media (max-width: 1920px) {
    .layout__container {
        margin: 0;
    }
}

@media (max-width: 991.98px) {
    .layout__container {
        padding: 0 32px;
        width: auto;
    }
}

@media (max-width: 479.98px) {
    .layout__container {
        padding: 0 16px;
    }
}
</style>

<template>
    <div class="layout">
	    <header-component/>
	    <div class="layout__container">
		    <slot />
	    </div>
	    <footer-component-land/>
    </div>
</template>

<script>
import HeaderComponent from "@/modules/common/Components/HeaderComponent.vue";
import FooterComponentLand from "@/modules/common/Components/FooterComponentLand.vue";

export default {
    components: {
		HeaderComponent,
		FooterComponentLand,
    },
    async created() {
        await this.$store.dispatch("getMiningStat");
        await this.$store.dispatch("getGraph");
    },
}

</script>

<style lang="scss" scoped>
</style>

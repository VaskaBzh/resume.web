<template>
    <div class="layout">
        <main-background/>
        <header-component/>
        <div class="layout__container">
            <slot/>
            <div class="layout__block layout__block-fixed">
                <a href="#header" class="layout_button">
                    <arrow-up-icon class="layout_icon"/>
                </a>
                <a href="https://t.me/allbtc_support" class="layout_button">
                    ?
                </a>
            </div>
        </div>
        <FooterHosting></FooterHosting>
    </div>
</template>

<script>
import HeaderComponent from "@/modules/common/Components/HeaderComponent.vue";
import FooterHosting from "@/modules/hosting/Components/FooterHosting.vue";
import MainBackground from "@/modules/background/Components/MainBackground.vue";
import ArrowUpIcon from "@/modules/common/icons/ArrowUpIcon.vue";

export default {
    components: {
        MainBackground,
        FooterHosting,
        HeaderComponent,
        ArrowUpIcon,
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

.layout__block {
    display: flex;
    flex-direction: column;
    gap: 16px;
    align-items: flex-end;
}

.layout_button {
    border: 0.5px solid rgba(192, 228, 255, 0.60);
    background: var(--gray-470, rgba(13, 13, 13, 0.70));
    backdrop-filter: blur(10px);
    width: clamp(40px, 5vw, 80px);
    height: clamp(40px, 5vw, 80px);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: var(--gray-2100, #E4E7EC);
    font-family: Unbounded, serif;
    font-size: clamp(20px, 5vw, 32px);
    font-weight: 400;
    line-height: 120%;
    text-transform: uppercase;
}

.layout_icon {
    width: clamp(20px, 5vw, 32px);
    height: clamp(20px, 5vw, 32px);
}

.layout__block-fixed {
    position: fixed;
    right: clamp(16px, 5vw, 100px);
    bottom: clamp(16px, 5vw, 100px);
    z-index: 12;
    max-width: 100%;
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
    transition: all 1.2s ease 0s;
}

@media (max-width: 1920px) {
    .layout__container {
        margin: 0;
        width: auto;
    }
}
</style>

<template>
<main class="faq__main">

</main>
</template>



<script>
import HeroView from "@/modules/home/Components/Views/HeroView.vue";
import FaqTabs from "@/modules/faq/Components/UI/FaqTabs.vue";
import MainTabs from "@/modules/common/Components/UI/MainTabs.vue";
import FaqNavsTabs from "@/modules/faq/Components/UI/FaqNavsTabs.vue";
import FaqImagesComponent from "@/modules/faq/Components/UI/FaqImagesComponent.vue";
import FaqPage from "@/Pages/Profile/FaqPage.vue";

export default {
    name: "FaqPage",
    components: {FaqImagesComponent, FaqNavsTabs, MainTabs, FaqTabs, HeroView},
    data() {
        return {
            tabs: ['FAQ', 'Функционал']
        }
    }
}
</script>


<style scoped>
.faq__main {
    display: flex;
    flex: 1 1 auto;
    align-items: flex-start;
    flex-flow: row nowrap;
    gap: clamp(122px, 1vw, 50px);
    padding: 44px 24px;
    height: calc(100vh - 116px);
}



@media (max-width: 768px) {
    .faq__main {
        padding: 22px 12px;
    }
}
</style>

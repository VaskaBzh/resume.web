<template>
    <div class="wallets">
        <main-preloader />
        <div class="wallets__block"></div>
    </div>
</template>

<script>
import MainPreloader from "@/modules/preloader/Components/MainPreloader.vue";
import { WalletsService } from "@/modules/wallets/services/WalletsService";

export default {
    name: "WalletsPage",
    components: {
        MainPreloader,
    },
    data() {
        return {
            service: new WalletsService(),
        };
    },
};
</script>

<style scoped>
.wallets {
    flex: 1 1 auto;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>

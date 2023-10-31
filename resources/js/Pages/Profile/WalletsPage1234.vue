<template>
    <div class="wallets">
        <!--        <main-preloader />-->
        <div class="wallets__block">
            <no-wallets-block
                time="23.32.33"
                @addWallet="service.openAddPopup()"
            />
        </div>
        <add-wallet-popup
            :is-opened="service.isAddPopupOpened.state"
            @closed="closeAddPopup"
            @addWallet="console.log(123)"
        />
    </div>
</template>

<script>
// import MainPreloader from "@/modules/preloader/Components/MainPreloader.vue";
import NoWalletsBlock from "@/modules/wallets/Components/NoWalletsBlock.vue";
import AddWalletPopup from "@/modules/wallets/Components/AddWalletPopup.vue";

import { WalletsService } from "@/modules/wallets/services/WalletsService";

export default {
    name: "WalletsPage",
    components: {
        // MainPreloader,
        NoWalletsBlock,
        AddWalletPopup,
    },
    data() {
        return {
            service: new WalletsService(),
        };
    },
    methods: {
        closeAddPopup() {
            this.service.closeAddPopup().setForm().closeAddEmailForm();
        },
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

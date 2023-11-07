<template>
    <div class="wallets">
        <!--        <main-preloader />-->
        <div class="wallets__block">
<!--            time="23.32.33"-->
            <no-wallets-block
                @addWallet="openAddPopup"
            />
        </div>
        <add-wallet-popup
            :is-opened="isAddPopupOpened"
            :is-closed="isAddPopupClosed"
            @closed="closeAddPopup"
            @addWallet="addWallet"
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
    computed: {
        isAddPopupOpened() {
            return this.service.addPopup.isPopupOpened.state;
        },
        isAddPopupClosed() {
            return this.service.addPopup.isPopupClosed.state;
        },
    },
    methods: {
        addWallet() {
            // console.log(123)
        },
        closeAddPopup() {
            this.service.addPopup.closePopup();
            this.service.addVerifyForm.closeVerifyForm();
            this.service.setForm();
        },
        closeChangePopup() {
            this.service.changePopup.closePopup();
            this.service.changeVerifyForm.closeVerifyForm();
            this.service.setForm();
        },
        openAddPopup() {
            this.service.addPopup.openPopup();
        },
        openChangePopup() {
            this.service.changePopup.openPopup();
        },
    },
    mounted() {
        this.service.setFormData();
    },
};
</script>

<style scoped>
.wallets {
    flex: 1 1 auto;
    display: flex;
    padding: 24px;
    align-items: center;
    justify-content: center;
}
</style>

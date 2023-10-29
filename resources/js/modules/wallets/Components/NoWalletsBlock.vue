<template>
    <div
        class="no-wallets cabinet__block cabinet__block-light cabinet__block-md"
    >
        <div class="no-wallets__block">
            <img
                src="../images/img_no-wallets.png"
                alt="wallet image"
                class="no-wallets_image"
            />
            <p class="no-wallets_text"></p>
        </div>
        <div class="no-wallets__block">
            <main-button class="no-wallets_button button-blue">
                <template #text> </template>
            </main-button>
        </div>
    </div>
</template>

<script>
import MainButton from "@/modules/common/Components/UI/MainButton.vue";

export default {
    name: "NoWalletsBlock",
    components: {
        MainButton,
    },
};
</script>

<style scoped>
.no-wallets {
    display: flex;
    flex-direction: column;
    gap: clamp(40px, 5vw, 80px);
}
.no-wallets__block {
    display: flex;
    flex-direction: column;
    gap: clamp(12px, 5vw, 24px);
}
</style>

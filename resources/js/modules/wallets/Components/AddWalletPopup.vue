<template>
    <main-popup :closed="isClosed" :opened="isOpened" @closed="$emit('closed')">
        <form-popup @submitEvent="$emit('addWallet', form)">
            <template #head>
                <main-title class="title-popup">
                    {{ $t("add_popup.title") }}
                </main-title>
            </template>
            <template #content>
                <form-popup-input
                    class="form_input"
                    input-name="walletAddress"
                    :input-label="$t('add_popup.labels.address')"
                    :input-value="form.walletAddress"
                    @inputChange="form.walletAddress = $event"
                />
                <form-popup-input
                    class="form_input"
                    input-name="name"
                    :input-label="$t('add_popup.labels.name')"
                    :input-value="form.name"
                    @inputChange="form.name = $event"
                />
            </template>
            <template #buttons>
                <main-button type="submit" class="button-full button-xl">
                    <template #text>{{ $t("add_popup.button") }}</template>
                </main-button>
            </template>
        </form-popup>
    </main-popup>
</template>

<script>
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import FormPopupInput from "@/modules/form/Components/UI/FormPopupInput.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import FormPopup from "@/modules/form/Components/FormPopup.vue";

import { WalletsMessages } from "@/modules/wallets/lang/WalletsMessages";

export default {
    name: "AddWalletPopup",
    components: {
        FormPopup,
        FormPopupInput,
        MainPopup,
        MainTitle,
        MainButton,
    },
    i18n: {
        sharedMessages: WalletsMessages,
    },
    props: {
        isOpened: {
            type: Boolean,
            default: false,
        },
        isClosed: {
            type: Boolean,
            default: false,
        },
        isEmailForm: {
            type: Boolean,
            default: false,
        },
        addForm: {
            type: Object,
            default: {
                wallet_address: "",
                name: "",
            },
        },
    },
    emits: ["closed"],
    data() {
        return {
            form: this.addForm,
        };
    },
};
</script>

<style scoped></style>

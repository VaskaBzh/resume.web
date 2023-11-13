<template>
    <main-popup
        id="2fac_disable"
        ref="fac"
        :opened="opened"
        :wait="wait"
        :closed="closed"
    >
        <form-popup @submitForm="closePopup">
            <template #head>
                <main-head>
                    <template #title>{{ $t("fac_popup.disable.title") }}</template>
                    <template #text>{{ $t("fac_popup.disable.text") }}</template>
                </main-head>
            </template>
            <template #content>
                <form-popup-input
                    input-name="code"
                    :input-placeholder="$t('fac_popup.disable.placeholder')"
                    :input-value="form.code"
                    @inputChange="form.code = $event"
                />
            </template>
            <template #buttons>
                <main-button
                    class="button-blue button-full fac_button"
                    type="submit"
                >
                    <template #text>{{ $t("fac_popup.disable.button") }}</template>
                </main-button>
            </template>
        </form-popup>
    </main-popup>
</template>

<script>
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import MainCopy from "@/modules/common/Components/UI/MainCopy.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import MainInput from "@/modules/common/Components/inputs/MainInput.vue";
import MainHead from "@/modules/common/Components/UI/MainHead.vue";
import FormPopup from "@/modules/form/Components/FormPopup.vue";
import FormPopupInput from "@/modules/form/Components/UI/FormPopupInput.vue";

import { SettingsMessage } from "@/modules/settings/lang/SettingsMessage";

export default {
    name: "FacDisablePopup",
    props: {
        opened: Boolean,
        closed: Boolean,
        wait: Boolean,
    },
    i18n: {
        sharedMessages: SettingsMessage,
    },
    data() {
        return {
            form: {
                code: "",
            },
        };
    },
    components: {
        FormPopupInput,
        FormPopup,
        MainHead,
        MainPopup,
        MainCopy,
        MainButton,
        MainInput,
    },
    methods: {
        closePopup() {
            this.$emit("sendDisable", this.form);
        },
    },
};
</script>

<style scoped>
.fac_qrcode {
    width: 200px;
    margin: 0 auto 40px;
}

.fac_code,
.fac_input {
    margin-bottom: 80px;
}

.fac_input {
    background: var(--background-modal-input, #2c2f34);
}

.fac_button {
    min-height: 56px;
}

.fac__buttons {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}
</style>

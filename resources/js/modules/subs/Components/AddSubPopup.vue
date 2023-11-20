<template>
    <main-popup :opened="opened" :wait="wait" :closed="closed">
        <form-popup @submitForm="addSubaccount">
            <template #head>
                <main-head>
                    <template #title>{{ $t("popup.add.title") }}</template>
                    <template #text>{{ $t("popup.add.text") }}</template>
                </main-head>
            </template>
            <template #content>
                <form-popup-input
                    input-name="name"
                    :input-placeholder="$t('popup.add.placeholder.name')"
                    :input-value="formModel.name"
                    @inputChange="formModel.name = $event"
                />
            </template>
            <template #buttons>
                <main-button
                    class="button-blue button-full button-xl sub_button"
                    type="submit"
                    :wait="wait"
                >
                    <template #text>{{ $t("popup.add.button") }}</template>
                </main-button>
            </template>
        </form-popup>
    </main-popup>
</template>

<script>
import MainHead from "@/modules/common/Components/UI/MainHead.vue";
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import FormPopup from "@/modules/form/Components/FormPopup.vue";
import FormPopupInput from "@/modules/form/Components/UI/FormPopupInput.vue";

import { SubMessages } from "@/modules/subs/lang/SubMessages";

export default {
    name: "AddSubPopup",
    components: {
        MainPopup,
        MainHead,
        MainButton,
        FormPopup,
        FormPopupInput,
    },
    props: {
        opened: {
            type: Boolean,
            default: false,
        },
        wait: {
            type: Boolean,
            default: false,
        },
        closed: {
            type: Boolean,
            default: false,
        },
        form: {
            type: Object,
            default: {
                name: "",
            },
        },
    },
    emits: ["add_subaccount"],
    data() {
        return {
            formModel: this.form,
        };
    },
    watch: {
        form(newFormData) {
            this.formModel = newFormData;
        },
    },
    methods: {
        addSubaccount() {
            if (!this.wait) {
                this.$emit("add_subaccount", this.formModel);
            }
        },
    },
    i18n: {
        sharedMessages: SubMessages,
    },
};
</script>

<style scoped lang="scss"></style>

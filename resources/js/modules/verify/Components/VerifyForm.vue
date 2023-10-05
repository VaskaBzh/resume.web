<template>
    <div class="verify__head">
        <main-title tag="h3">{{ $t("popup.title") }}</main-title>
        <main-description>{{ $t("popup.description") }}</main-description>
    </div>
    <div class="verify__content">
        <main-input
            class="verify_input"
            inputName="code"
            :inputLabel="$t('popup.label[0]')"
            :inputValue="service.form.code"
            @getValue="service.form.code = $event"
        />
        <main-button
            class="button-blue verify_button button-full"
            @click="sendFormWithCode"
        >
            <template v-slot:text>
                {{ $t("popup.button") }}
            </template>
        </main-button>
    </div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescription.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import MainInput from "@/modules/common/Components/inputs/MainInput.vue";
import { VerifyMessages } from "@/modules/verify/lang/VerifyMessages";
import { VerifyService } from "@/modules/verify/services/VerifyService";

export default {
    name: "verify-form",
    props: {
        closed: Boolean,
        wait: Boolean,
    },
    i18n: {
        sharedMessages: VerifyMessages,
    },
    components: {
        MainInput,
        MainTitle,
        MainDescription,
        MainButton,
    },
    data() {
        return {
            service: new VerifyService(),
        };
    },
    methods: {
        sendFormWithCode() {
            this.$emit("sendForm", this.service.form.code);
        },
    },
}
</script>

<style scoped>

</style>

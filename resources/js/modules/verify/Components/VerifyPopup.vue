<template>
    <main-popup id="verify" :wait="wait" :closed="closed" :opened="opened">
        <slot />
        <!--		<div class="verify__head">-->
        <!--			<main-title>{{ $t("popup.title") }}</main-title>-->
        <!--			<main-description>{{ $t("popup.description") }}</main-description>-->
        <!--		</div>-->
        <!--		<div class="verify__content">-->
        <!--            <main-input-->
        <!--                class="verify_input"-->
        <!--                inputName="code"-->
        <!--                :inputLabel="$t('popup.label[0]')"-->
        <!--                :inputValue="service.form.code"-->
        <!--                @getValue="service.form.code = $event"-->
        <!--            />-->
        <!--			<main-button-->
        <!--				class="button-blue verify_button button-full"-->
        <!--				@click="sendEmailMessage"-->
        <!--			>-->
        <!--				<template v-slot:text>-->
        <!--                    {{ $t("popup.button") }}-->
        <!--                </template>-->
        <!--			</main-button>-->
        <!--		</div>-->
    </main-popup>
</template>

<script>
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import MainValidate from "@/modules/validate/Components/MainValidate.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescriptionOld.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import MainInput from "@/modules/common/Components/inputs/MainInput.vue";
import { VerifyMessages } from "@/modules/verify/lang/VerifyMessages";
import { VerifyService } from "@/modules/verify/services/VerifyService";

export default {
    name: "VerifyPopup",
    components: {
        MainInput,
        MainValidate,
        MainPopup,
        MainTitle,
        MainDescription,
        MainButton,
    },
    props: {
        wait: Boolean,
        closed: Boolean,
        opened: Boolean,
    },
    i18n: VerifyMessages,
    data() {
        return {
            service: new VerifyService(),
        };
    },
    methods: {
        sendEmailMessage() {},
    },
};
</script>

<style scoped></style>

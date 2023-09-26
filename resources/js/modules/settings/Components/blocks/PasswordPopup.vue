<template>
    <main-popup
        id="password"
        ref="password"
        :opened="opened"
        :wait="wait"
        :closed="closed"
        :makeResize="makeResize"
    >
        <div class="password__head">
            <main-title tag="h3">{{ $t("password_popup.title") }}</main-title>
            <main-description>{{ $t("popup.text[4]") }}</main-description>
        </div>
        <div class="password__content" v-show="!hasCode">
            <div class="password_qrcode" v-html="qrCode"></div>
            <main-copy
                class="password_code"
                :cutValue="-1"
                :code="code"
                :label="$t('password_popup.label[0]')"
            />
            <main-button
                class="button-blue password_button button-full"
                @click.prevent="hasCode = true"
            >
                <template v-slot:text>{{
                    $t("password_popup.button[0]")
                }}</template>
            </main-button>
        </div>
        <div class="password__content" v-show="hasCode">
            <main-input
                class="password_input"
                inputName="twopasswordtorSecret"
                :inputLabel="$t('password_popup.label[1]')"
                :inputValue="form.twopasswordtorSecret"
                :error="errorsExpired.error"
                @getValue="form.twopasswordtorSecret = $event"
            />
            <div class="password__buttons">
                <main-button
                    class="button-reverse password_button button-full"
                    @click.prevent="hasCode = false"
                >
                    <template v-slot:text>{{
                        $t("password_popup.button[1]")
                    }}</template>
                </main-button>
                <main-button
                    class="button-blue password_button button-full"
                    @click="closePopup"
                >
                    <template v-slot:text>{{
                        $t("password_popup.button[2]")
                    }}</template>
                </main-button>
            </div>
        </div>
    </main-popup>
</template>

<script>
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescription.vue";
import MainCopy from "@/modules/common/Components/UI/MainCopy.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import MainInput from "@/modules/common/Components/inputs/MainInput.vue";
import { mapGetters } from "vuex";
import { SettingsMessage } from "@/modules/settings/lang/SettingsMessage";

export default {
    name: "password-popup",
    props: {
        opened: Boolean,
        closed: Boolean,
        wait: Boolean,
        qrCode: String,
        code: String,
    },
    i18n: {
        sharedMessages: SettingsMessage,
    },
    data() {
        return {
            form: {
                old_password: "",
                password: "",
                "password-confirmation": "",
            },
        };
    },
    watch: {
    },
    computed: {
        ...mapGetters(["errorsExpired"]),
    },
    components: {
        MainDescription,
        MainPopup,
        MainTitle,
        MainCopy,
        MainButton,
        MainInput,
    },
    methods: {
        closePopup() {
            this.$emit("sendPassword", this.form);
        },
    },
};
</script>

<style scoped>
.password__head {
    display: flex;
    flex-direction: column;
    gap: 4px;
    margin-bottom: 40px;
}
.password_qrcode {
    width: 200px;
    margin: 0 auto 40px;
}
.password_code,
.password_input {
    margin-bottom: 80px;
}
.password_input {
    background: var(--background-modal-input, #2c2f34);
}
.password_button {
    min-height: 56px;
}
.password__buttons {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}
</style>

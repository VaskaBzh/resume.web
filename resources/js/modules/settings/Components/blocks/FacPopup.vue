<template>
    <main-popup
        id="2fac"
        ref="fac"
        :opened="opened"
        :wait="wait"
        :closed="closed"
        :makeResize="makeResize"
    >
        <div class="fac__head">
            <main-title tag="h3">{{ $t("fac_popup.title") }}</main-title>
            <main-description
                >{{ $t("popup.text[4]") }}</main-description
            >
        </div>
        <div class="fac__content" v-show="!hasCode">
            <div class="fac_qrcode" v-html="qrCode"></div>
            <main-copy
                class="fac_code"
                :cutValue="-1"
                :code="code"
                :label="$t('fac_popup.label[0]')"
            />
            <main-button
                class="button-blue fac_button button-full"
                @click.prevent="hasCode = true"
            >
                <template v-slot:text>{{ $t("fac_popup.button[0]") }}</template>
            </main-button>
        </div>
        <div class="fac__content" v-show="hasCode">
            <main-input
                class="fac_input"
                inputName="twoFactorSecret"
                :inputLabel="$t('fac_popup.label[1]')"
                :inputValue="form.twoFactorSecret"
                :error="errorsExpired.error"
                @getValue="form.twoFactorSecret = $event"
            />
            <div class="fac__buttons">
                <main-button
                    class="button-reverce fac_button button-full"
                    @click.prevent="hasCode = false"
                >
                    <template v-slot:text>{{ $t("fac_popup.button[1]") }}</template>
                </main-button>
                <main-button
                    class="button-blue fac_button button-full"
                    @click="closePopup"
                >
                    <template v-slot:text>{{ $t("fac_popup.button[2]") }}</template>
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
    name: "fac-popup",
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
            hasCode: false,
            makeResize: false,
            form: {
                twoFactorSecret: "",
            },
        };
    },
    watch: {
        errorsExpired() {
        },

        hasCode() {
            this.makeResize = true;

            setTimeout(() => (this.makeResize = false), 300);
        },
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
            this.$emit("sendVerify", this.form);
        },
    },
};
</script>

<style scoped>
.fac__head {
    display: flex;
    flex-direction: column;
    gap: 4px;
    margin-bottom: 40px;
}
.fac_qrcode {
    width: 200px;
    height: 160px;
    margin: 0 auto 40px;
}
.fac_code {
    margin-bottom: 80px;
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--main-gohan, #fff);
}
.fac_input {
    margin-bottom: 80px;
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--main-gohan, #fff);
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

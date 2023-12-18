<template>
    <main-popup
        id="2fac"
        ref="fac"
        :opened="opened"
        :closed="closed"
        :make-resize="makeResize"
    >
        <div class="fac__head">
            <main-title>{{ $t("fac_popup.title") }}</main-title>
            <main-description v-if="hasCode">{{ $t("popup.text[7]") }}</main-description>
            <main-description v-if="!hasCode">{{ $t("popup.text[4]") }}</main-description>
        </div>
        <div v-if="!hasCode" class="fac__content">
            <div class="fac_qrcode" v-html="qrCode"></div>
            <main-copy
                class="fac_code"
                :cut-value="-1"
                :code="code"
                :label="$t('fac_popup.label[0]')"
            />
            <warning-block :text="$t('fac_popup.warning.title')" class="fac_warning"/>
            <main-button
                class="button-blue fac_button button-full"
                @click.prevent="hasCode = true"
            >
                <template #text>{{ $t("fac_popup.button[0]") }}</template>
            </main-button>
        </div>
        <form v-else class="fac__content" @submit.prevent="closePopup">
            <main-input
                class="fac_input"
                input-name="twoFactorSecret"
                :input-label="$t('fac_popup.label[1]')"
                :input-value="form.code"
                :error="errorsExpired.error"
                @get-value="form.code = $event"
            />
            <div class="fac__buttons">
                <main-button
                    class="button-reverse fac_button button-full"
                    @click="returnNoCodeForm"
                >
                    <template #text>{{ $t("fac_popup.button[1]") }} </template>
                </main-button>
                <main-button
                    class="button-blue fac_button button-full"
                    type="submit"
                    :wait="wait"
                >
                    <template #text>{{ $t("fac_popup.button[2]") }} </template>
                </main-button>
            </div>
        </form>
    </main-popup>
</template>

<script>
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescriptionOld.vue";
import MainCopy from "@/modules/common/Components/UI/MainCopy.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import MainInput from "@/modules/common/Components/inputs/MainInput.vue";
import { SettingsMessage } from "@/modules/settings/lang/SettingsMessage";
import { mapGetters } from "vuex";
import WarningBlock from "@/modules/common/Components/UI/WarningBlock.vue";

export default {
    name: "FacPopup",
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
    emits: ["sendVerify"],
    data() {
        return {
            hasCode: false,
            makeResize: false,
            form: {
                code: "",
            },
        };
    },
    watch: {
        errorsExpired() {},
        hasCode() {
            this.makeResize = true;

            setTimeout(() => (this.makeResize = false), 300);
        },
    },
    computed: {
        ...mapGetters(["errorsExpired"]),
    },
    components: {
        WarningBlock,
        MainDescription,
        MainPopup,
        MainTitle,
        MainCopy,
        MainButton,
        MainInput,
    },
    methods: {
        returnNoCodeForm(event) {
            if (event.pointerType === "touch") {
                this.hasCode = false;
            }
        },
        closePopup() {
            if (!this.wait) {
                this.$emit("sendVerify", this.form);
            }
        },
    },

    mounted() {
        console.log(this.wait)
    }
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
    margin: 0 auto 40px;
}

.fac_code {
    margin-bottom: 12px;
}

.fac_warning {
    margin-bottom: 80px;
}

.fac_input {
    margin-bottom: 80px;
    height: 50px;
    background: var(--background-modal-input, #2c2f34);
}

.fac_button {
    min-height: 56px;
    font-weight: 600;
}

.fac__buttons {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}
</style>

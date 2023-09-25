<template>
    <main-popup
        id="changes"
        class="popup-changes"
        :wait="wait"
        :closed="closed"
        :key="form.key"
    >
        <form
            @submit.prevent="
                form.type === $t('inputs.password')
                    ? getValue(true)
                    : getValue(false)
            "
            class="form form-popup popup__form"
        >
            <div class="header_card">
                <main-title tag="h3">{{
                    `${
                        form.type !== "почту"
                            ? $t("popup.title")
                            : $t("popup.title_email")
                    } ${form.type}`
                }}</main-title>
                <p class="popup-text">
                    {{
                        form.key == "email"
                            ? $t("popup.text[0]")
                            : $t("popup.text[2]")
                    }}
                </p>
                <!--                <p class="popup-text" v-else>-->
                <!--                {{-->
                <!--                    form.key == "email"-->
                <!--                        ? $t("popup.text[1]")-->
                <!--                        : $t("popup.text[3]")-->
                <!--                }}-->
                <!--                </p>-->
            </div>
            <input
                :placeholder="placeholder"
                class="input popup__input"
                v-model="inputValue"
                v-if="form.key !== 'phone'"
            />
            <div v-if="form.key == 'phone'">
                <!--                <SelectCountry />-->
                <input
                    v-model="inputValue"
                    autofocus
                    :type="
                        form.type === $t('inputs.password')
                            ? 'password'
                            : 'text'
                    "
                    class="input popup__input"
                    :placeholder="placeholder"
                    @input="phoneInput"
                    maxlength="18"
                    @keydown="phoneKeyDown"
                    @paste="phonePaste"
                    id="inputTel"
                />
            </div>
            <!--            :placeholder="`${$t(-->
            <!--            'settings.block.settings_block.popup.placeholders.placeholder'-->
            <!--            )} ${form.type}`"-->
            <!--            <settings-password-->
            <!--                v-if="form.type === $t('inputs.password')"-->
            <!--                name="password"-->
            <!--                :placeholder="`${$t('popup.placeholders.password_new')} ${-->
            <!--                    form.type-->
            <!--                }`"-->
            <!--                :model="password"-->
            <!--                :errors="errors"-->
            <!--                @change="$emit('validate', $event)"-->
            <!--            />-->
            <!--            <main-validate :validate="validate" />-->
            <!--            <settings-password-->
            <!--                v-if="form.type === $t('inputs.password')"-->
            <!--                name="password"-->
            <!--                :placeholder="`${$t(-->
            <!--                    'popup.placeholders.password_confirmation'-->
            <!--                )} ${form.type}`"-->
            <!--                :model="password_confirmation"-->
            <!--                :errors="errors"-->
            <!--                @change="password_confirmation = $event"-->
            <!--            />-->
            <div>
                <!--                <input :placeholder="placeholder" class="input popup__input" />-->
                <!--                <p class="blue-text">{{ $t("popup.text[6]") }}</p>-->
                <div class="btn__block">
                    <!--                    <button class="btn-back" @click="stepTwo = !stepTwo">-->
                    <!--                        {{ $t("popup.button[0]") }}-->
                    <!--                    </button>-->
                    <button type="submit" class="btn-send-code">
                        <!-- <popup-loading-icon /> -->
                        {{ $t("popup.button[1]") }}
                        {{ form.type }}
                    </button>
                </div>
            </div>
            <!--            <div class="btn__block">-->
            <!--                <button class="btn-send-code" @click="stepTwo = !stepTwo">-->
            <!--                    {{ $t("popup.button[2]") }}-->
            <!--                </button>-->
            <!--            </div>-->
        </form>
    </main-popup>
</template>

<script>
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import MainValidate from "@/modules/validate/Components/MainValidate.vue";
import PopupLoadingIcon from "@/modules/common/icons/PopupLoadingIcon.vue";
import SettingsPassword from "@/modules/settings/Components/SettingsPassword.vue";
import { SettingsMessage } from "@/modules/settings/lang/SettingsMessage";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import SelectCountry from "@/modules/settings/Components/SelectCountry.vue";
import { mapGetters } from "vuex";
export default {
    name: "settings-popup",
    i18n: {
        sharedMessages: SettingsMessage,
    },
    props: {
        form: Object,
        validate: Object,
        wait: Boolean,
        closed: Boolean,
    },
    computed: {
        ...mapGetters(["errors"]),
    },
    components: {
        MainPopup,
        MainTitle,
        SettingsPassword,
        MainButton,
        MainValidate,
        PopupLoadingIcon,
        SelectCountry,
    },
    data() {
        return {
            item: "+7",
            placeholder: this.form.item,
            password_confirmation: this.form.password_confirmation,
            password: this.form.password,
            opened: false,
            stepTwo: false,
            inputValue: "",
        };
    },
    methods: {
        getValue(bool) {
            this.$emit("ajaxChange", {
                password: bool,
                value: this.inputValue,
            });
        },
        phoneInput(e) {
            let inputNumbersValue = e.target.value.replace(/\D/g, ""); //Хранятся только числа из инпута
            let formattedInputValue = ""; //Хранится результат из инпута
            let selectionStart = inputTel.selectionStart;
            if (!inputNumbersValue) {
                return (inputTel.value = "");
            } else if (inputTel.value.length != selectionStart) {
                if (e.data && /\D/g.test(e.data)) {
                    inputTel.value = inputNumbersValue;
                }
                return;
            } else if (["7", "8"].indexOf(inputNumbersValue[0]) > -1) {
                let firstSymbols = inputNumbersValue[0] == "8" ? "8" : "+7";
                formattedInputValue = firstSymbols + " ";
                if (inputNumbersValue.length > 1) {
                    formattedInputValue +=
                        "(" + inputNumbersValue.substring(1, 4);
                }
                if (inputNumbersValue.length >= 5) {
                    formattedInputValue +=
                        ") " + inputNumbersValue.substring(4, 7);
                }
                if (inputNumbersValue.length >= 8) {
                    formattedInputValue +=
                        "-" + inputNumbersValue.substring(7, 9);
                }
                if (inputNumbersValue.length >= 10) {
                    formattedInputValue +=
                        "-" + inputNumbersValue.substring(9, 11);
                }
            } else if (inputNumbersValue[0] == "9") {
            } else {
                formattedInputValue = "+" + inputNumbersValue.substring(0, 16);
            }
            inputTel.value = formattedInputValue;
        },
        phoneKeyDown(e) {
            if (
                e.keyCode == 8 &&
                e.target.value.replace(/\D/g, "").length == 1
            ) {
                inputTel.value = "";
            }
        },
        phonePaste(e) {
            let pasted = e.clipboardData || window.clipboardData;
            let inputNumbersValue = e.target.value.replace(/\D/g, "");
            if (pasted) {
                let pastedText = pasted.getData("Text");
                if (/\D/g.test(pastedText)) {
                    inputTel.value = inputNumbersValue;
                }
            }
        },
    },
    watch: {
        "form.item"(newValue) {
            this.placeholder = newValue;
        },
    },
};
</script>

<style scoped lang="scss">
.header_card {
    margin-bottom: 40px;
}
.btn__block {
    display: flex;
    width: 100%;
    justify-content: space-between;
    margin-top: 80px;
    gap: 12px;
}
.btn-send-code {
    width: 100%;
    border-radius: 12px;
    background: var(--buttons-primary-fill-border-default, #2e90fa);
    box-shadow: 0px 10px 10px -6px rgba(0, 0, 0, 0.1);
    padding: 12px 16px;
    color: var(--buttons-primary-text, var(--background-island, #fff));
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: 32px; /* 177.778% */
}
.btn-active {
    width: 49%;
    border-radius: 12px;
    background: var(--buttons-primary-fill-border-default, #2e90fa);
    box-shadow: 0px 10px 10px -6px rgba(0, 0, 0, 0.1);
    color: var(--buttons-primary-text, var(--background-island, #fff));
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: 32px; /* 177.778% */
}
.btn-back {
    border-radius: 12px;
    width: 49%;
    border: 1px solid var(--light-gray-400, #98a2b3);
    padding: 12px 16px;
    background: inherit;
    color: var(--text-secondary, #475467);
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: 175%; /* 31.5px */
}
.popup-text {
    color: var(--light-gray-400, #98a2b3);
    font-family: NunitoSans;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%; /* 24px */
}
.form_wrapper-message {
    position: relative;
    left: 0;
    top: 0;
    opacity: 1;
    width: 100%;
    .form_message {
        opacity: 1;
        width: 100%;
    }
}
.blue-text {
    color: var(--buttons-ghost-text-default, #53b1fd);
    font-family: NunitoSans, serif;
    font-size: 14px;
    cursor: pointer;
    font-style: normal;
    font-weight: 600;
    margin-top: 18px;
    line-height: 20px; /* 142.857% */
}
.popup__input {
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    padding: var(--py-4, 16px) var(--px-4, 16px);
    width: 100%;
    height: 56px;
    outline: none;
    background: var(--background-modal-input, #2c2f34);
    color: var(--text-secondary, #c5c8cd);
}
.popup__input::placeholder {
    font-family: NunitoSans, serif;
    color: var(--select-text-no-value, #43474E);;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px; /* 150% */
}
</style>

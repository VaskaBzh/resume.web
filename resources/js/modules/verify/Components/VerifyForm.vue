<template>
    <div class="verify__head">
        <main-title>{{ $t(title) }}</main-title>
        <main-description>{{ $t(text) }}</main-description>
    </div>
    <form class="verify__content" @submit.prevent="sendFormWithCode">
        <main-input
            class="verify_input"
            input-name="code"
            :input-label="$t(placeholder)"
            :input-value="service.form.code"
            @get-value="service.form.code = $event"
        />
        <verify-link
            class="verify_link"
            :verify-text="$t(re_verify_text)"
            :verify-url="`/send/code/${user.id}`"
        />
        <div class="verify__buttons">
            <main-button
                class="button-reverse verify_button button-full"
                @click="backHandler"
            >
                <template #text>
                    {{ $t("back") }}
                </template>
            </main-button>
            <main-button
                class="button-blue verify_button button-full"
                type="submit"
                :wait="wait"
            >
                <template #text>
                    {{ $t(button_text) }}
                </template>
            </main-button>
        </div>
    </form>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescriptionOld.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import MainInput from "@/modules/common/Components/inputs/MainInput.vue";
import VerifyLink from "@/modules/verify/Components/UI/VerifyLink.vue";

import { mapGetters } from "vuex";
import { VerifyMessages } from "@/modules/verify/lang/VerifyMessages";
import { VerifyService } from "@/modules/verify/services/VerifyService";

export default {
    name: "VerifyForm",
    props: {
        title: Boolean,
        text: Boolean,
        placeholder: Boolean,
        re_verify_text: Boolean,
        button_text: Boolean,
        wait: {
            type: Boolean,
            default: false,
        },
    },
    emits: ["back", "sendForm"],
    computed: {
        ...mapGetters(["user"]),
    },
    i18n: {
        sharedMessages: VerifyMessages,
    },
    components: {
        VerifyLink,
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
            if (!this.wait) {
                if (this.service.form.code?.length > 0) {
                    this.$emit("sendForm", this.service.form.code);
                }
            }
        },
        backHandler(event) {
            if (event.pointerType === "touch" || event.pointerType === "mouse") {
                this.$emit("back");
            }
        },
    },
};
</script>

<style scoped>
.verify__head {
    display: flex;
    flex-direction: column;
    gap: 4px;
    margin-bottom: 40px;
}

.verify__content {
    display: flex;
    flex-direction: column;
}

.verify__buttons {
    display: grid;
    gap: 8px;
    width: 100%;
    grid-template-columns: repeat(2, 1fr);
}

.verify_input {
    margin-bottom: 18px;
    background: var(--background-modal-input, #2c2f34);
}

.verify_link {
    padding-bottom: 10px;
    margin-bottom: 64px;
}

.verify_button {
    min-height: 56px;
}
</style>

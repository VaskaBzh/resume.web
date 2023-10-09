<template>
    <div class="verify__head">
        <main-title tag="h3">{{ $t(title) }}</main-title>
        <main-description>{{ $t(text) }}</main-description>
    </div>
    <div class="verify__content">
        <main-input
            class="verify_input"
            inputName="code"
            :inputLabel="$t(placeholder)"
            :inputValue="service.form.code"
            @getValue="service.form.code = $event"
        />
<!--        <verify-link-->
<!--	        class="verify_link"-->
<!--            :verifyText="$t(re_verify_text)"-->
<!--            :verifyUrl="`/send/code/${user.id}`"-->
<!--        />-->
<!--	    <div class="verify__buttons">-->
<!--		    <main-button-->
<!--			    class="button-reverse verify_button button-full"-->
<!--			    @click="$emit('back')"-->
<!--		    >-->
<!--			    <template v-slot:text>-->
<!--				    {{ $t("back") }}-->
<!--			    </template>-->
<!--		    </main-button>-->
		    <main-button
			    class="button-blue verify_button button-full"
			    @click="sendFormWithCode"
		    >
			    <template v-slot:text>
				    {{ $t(button_text) }}
			    </template>
		    </main-button>
<!--	    </div>-->
    </div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescription.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import MainInput from "@/modules/common/Components/inputs/MainInput.vue";
// import VerifyLink from "@/modules/verify/Components/UI/VerifyLink.vue";

import { mapGetters } from "vuex";
import { VerifyMessages } from "@/modules/verify/lang/VerifyMessages";
import { VerifyService } from "@/modules/verify/services/VerifyService";

export default {
    name: "two-fac-form",
    props: {
        title: Boolean,
        text: Boolean,
        placeholder: Boolean,
        button_text: Boolean,
    },
	computed: {
		...mapGetters(["user"]),
	},
    i18n: {
        sharedMessages: VerifyMessages,
    },
    components: {
        // VerifyLink,
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

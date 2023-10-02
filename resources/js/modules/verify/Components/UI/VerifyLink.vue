<template>
	<a href="#" @click.prevent="sendVerifyMessage(verifyUrl)" class="verify">
		{{ service.text }}
	</a>
</template>

<script>
import { VerifyMessages } from "@/modules/verify/lang/VerifyMessages";
import { VerifyService } from "@/modules/verify/services/VerifyService";

export default {
	props: {
		verifyText: String,
		data: Object,
		verifyUrl: {
            type: String,
            default: "/email/reverify",
        },
	},
    i18n: {
        sharedMessages: VerifyMessages,
    },
	name: "verify-link",
	data() {
		return {
			service: new VerifyService(),
		};
	},
	watch: {
		"$t"(newT) {
			if (newT) {
				this.service.setTranslate(newT);
			}
		}
	},
	methods: {
		sendVerifyMessage(verifyUrl) {
            const status = this.service.sendEmailVerification(verifyUrl, this.data);
            this.$emit("sendVerification", status)
            this.service.setTimer(60000);
		},
	},
	mounted() {
		this.service.setVerifyText(this.verifyText ?? this.$t("verify_link"));
		this.service.setText();
		if (this.$t) {
			this.service.setTranslate(this.$t);
		}
	},
}
</script>

<style scoped>
.verify {
    color: var(--icons-accent, #53B1FD);
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
}
</style>

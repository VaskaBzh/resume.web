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
		verifyUrl: String,
	},
	i18n: VerifyMessages,
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
		async sendVerifyMessage(verifyUrl) {
			this.service.setTimer(60000);
			await this.service.sendEmailVerification(verifyUrl);
		},
	},
	mounted() {
		this.service.setVerifyText(!!this.verifyText ? this.verifyText : this.$t("verify_link"));
		this.service.setText();
		if (this.$t) {
			this.service.setTranslate(this.$t);
		}
	},
}
</script>

<style scoped>

</style>

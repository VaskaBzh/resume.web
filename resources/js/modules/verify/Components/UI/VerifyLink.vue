<template>
	<a href="#" @click.prevent="sendVerifyMessage" class="verify">
		{{ service.text }}
	</a>
</template>

<script>
import { VerifyMessages } from "@/modules/verify/lang/VerifyMessages";
import { VerifyService } from "@/modules/verify/services/VerifyService";

export default {
	props: {
		verifyText: {
			type: String,
			default: this.$t("verify_link"),
		},
	},
	i18n: VerifyMessages,
	name: "verify-link",
	data() {
		return {
			service: new VerifyService(this.verifyText),
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
		async sendVerifyMessage() {
			this.service.setTimer(60000);
			await this.service.sendEmailVerification();
		}
	},
	mounted() {
		this.service.setText();
		if (this.$t) {
			this.service.setTranslate(this.$t);
		}
	},
}
</script>

<style scoped>

</style>

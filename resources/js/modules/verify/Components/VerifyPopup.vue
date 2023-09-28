<template>
	<main-popup
		id="verify"
		:wait="wait"
		:closed="closed"
	>
		<div class="password__head">
			<main-title tag="h3">{{ $t("password_popup.title") }}</main-title>
			<main-description>{{ $t("password_popup.description") }}</main-description>
		</div>
		<div class="password__content">
			<!--            :errors="errorsExpired"-->
			<main-button
				class="button-blue password_button button-full"
				@click="sendEmailMessage"
			>
				<template v-slot:text>{{
						$t("password_popup.button")
					}}</template>
			</main-button>
		</div>
	</main-popup>
</template>

<script>
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import MainValidate from "@/modules/validate/Components/MainValidate.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescription.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import { VerifyMessages } from "@/modules/verify/lang/VerifyMessages";
import { VerifyService } from "@/modules/verify/services/VerifyService";

export default {
	name: "verify-popup",
	props: {
		wait: Boolean,
		closed: Boolean,
	},
	i18n: VerifyMessages,
	components: {
		MainValidate,
		MainPopup,
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
		sendEmailMessage() {

		}
	}
}
</script>

<style scoped>

</style>

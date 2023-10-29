<template>
	<div class="sub">
		<img src="../images/img_subs-no-info.png" alt="no_info" class="sub_img">
		<main-description>{{ $t('no_information') }}</main-description>
	</div>
</template>

<script>
import MainDescription from "@/modules/common/Components/UI/MainDescriptionOld.vue";
import { SubMessages } from "@/modules/subs/lang/SubMessages";

export default {
	name: "subs-no-info",
	components: {MainDescription},
	i18n: {
		sharedMessages: SubMessages,
	}
}
</script>

<style scoped>
.sub {
	width: 100%;
	flex: 1 1 auto;
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
	gap: 24px;
}
.sub_img {
	width: 160px;
	height: 160px;
}
</style>

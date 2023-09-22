<template>
	<div class="card">
		<main-title tag="h2">Настройка наблюдателя</main-title>
		<div class="card__block">
			<img src="../imgs/img_workers-block.png" alt="no-content" class="card_img">
			<main-description>Для начала выберете наблюдателя из списка</main-description>
		</div>
		<div class="card__block card__block-content"></div>
	</div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "../../common/Components/UI/MainDescription.vue";

export default {
	name: "watcher-card",
	components: {
		MainDescription,
		MainTitle
	},
	props: {
		card: Object,
	},
}
</script>

<style scoped>
.card {
	min-height: 680px;
}
.card__block {
	display: flex;
	flex-direction: column;
	gap: 8px;
	align-items: center;
	justify-content: center;
	padding: 12px;
}
.card__block-content {
	padding-top: 40px;
}
</style>

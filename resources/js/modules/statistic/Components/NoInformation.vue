<template>
  <div class="no-information">
	  <div class="no-information__block">
		  <img src="/resources/assets/img/img_no-statistic.png" class="no-information_img" alt="no-statistic-info">
		  <p class="no-information_text">Чтобы появилась статистика необходимо подключить воркеры</p>
	  </div>
	  <button-blue>Подключить</button-blue>
  </div>
</template>

<script>
import ButtonBlue from "@/modules/common/Components/UI/ButtonBlue.vue";

export default {
	name: "no-information",
	components: {
		ButtonBlue,
	}
}
</script>

<style scoped>
.no-information {
	display: flex;
	flex-direction: column;
	justify-content: space-between;
}
.no-information__block {
	display: flex;
	flex-direction: column;
	gap: 24px;
	align-items: center;
}
.no-information_text {
	color: var(--light-gray-400, #98A2B3);
	text-align: center;
	font-family: NunitoSans, serif;
	font-size: 16px;
	font-weight: 400;
	line-height: 24px;
}
.no-information_img {
	width: 160px;
	height: 160px;
}
</style>

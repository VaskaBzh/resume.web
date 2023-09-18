<template>
  <div class="card__subcontainer" >
    <img :src="img">
    <div>
      <p class="card__title">{{ card.title }}</p >
      <p class="card__text"> {{ card.text }} </p>
    </div>
  </div>
    <div class="btn_container">
        
      <button class="btn_content" data-popup="#changes">{{ card.button }}</button>
    </div>
</template>
<script>
import { SettingsMessage } from "@/modules/settings/lang/SettingsMessage";
export default {
    name: "safety-card",
    i18n: {
        sharedMessages: SettingsMessage,
    },
    props: {
        card: Object,
    },
    computed: {
        img() {
            return new URL(
                `/resources/assets/img/${this.card.src}`,
                import.meta.url
            );
        },
    },
};
</script>
<style scoped>
.card__text{
    color: var(--light-gray-400, #98A2B3);
    font-family: NunitoSans;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 145%; /* 20.3px */
}
.card__title{
    color: var(--light-gray-600, #475467);
    font-family: Unbounded;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%; /* 24px */
}
.card__subcontainer{
    display: flex;
    align-items: center;
    gap: 12px;
    width: 62%;
}
.btn_container{
    display: flex;
    align-items: center;
}
.btn_content{
  width: 163px;
  padding: 8px 16px;
  border-radius: 12px;
  border: 1px solid var(--primary-500, #2E90FA);
  background: var(--primary-500, #2E90FA);
  box-shadow: 0px 0px 1px 0px rgba(0, 0, 0, 0.40), 0px 8px 12px -6px rgba(0, 0, 0, 0.05);
  color: var(--light-secondary-wb, #FFF);
  font-family: NunitoSans;
  font-size: 18px;
  font-style: normal;
  font-weight: 600;
  line-height: 175%; /* 31.5px */
}
</style>
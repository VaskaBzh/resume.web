<template>
  <div class="system-card-inf">
    <p class="system-card-title">удобный личный кабинет</p>
    <p class="system-card-text">С вами будет работать персональный менеджер, который поможет решить любые вопросы, в том числе вопросы ваших клиентов мы ценим наших клиентов и стремимся обеспечить лучший опыт работы с allbtc pool</p>
  </div>
  <div class="system-card-img">
    <img src="../assets/img/Mockup-mac.png" class="img-mac img-system">
    <img src="../assets/img/Mockup-statistic.png" class="img-statistic img-system">
  </div>
  <p class="get-consultation">попробовать демо версию</p>
</template>
<script>
</script>
<style scoped>
.system-card-inf{
  width: 464px;
}
.system-card-title{
  color: var(--gray-1100, #F5FAFF);
  font-family: Unbounded;
  font-size: 36px;
  font-style: normal;
  font-weight: 600;
  line-height: 120%; /* 43.2px */
  text-transform: uppercase;
  margin-bottom: 20px;
}
.system-card-text{
  color: var(--gray-170, rgba(245, 250, 255, 0.70));
  font-family: NunitoSans;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 110%; /* 19.8px */
}
.system-card-img{
  position: relative;
  width: 1428px;
  height: 820px;
}
.img-system{
  position: absolute;
}
.img-statistic{
  left: 148px;
  top: 36px;
}
.get-consultation{
  color: var(--gray-1100, #F5FAFF);
  text-align: center;
  font-family: Unbounded;
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 120%; /* 16.8px */
  text-transform: uppercase;
  border-radius: 40px;
  border: 1px solid rgba(192, 228, 255, 0.60);
  background: var(--gray-480, rgba(13, 13, 13, 0.80));
  backdrop-filter: blur(10px);
  padding: 8px 20px;
  width: 400px;
}
.img-mac{
  z-index: 10;
}
</style>
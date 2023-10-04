<template>
  <div class="system-card-inf">
    <p class="system-card-title">мобильное приложение</p>
    <p class="system-card-text">С вами будет работать персональный менеджер, который поможет решить любые вопросы, в том числе вопросы ваших клиентов мы ценим наших клиентов и стремимся обеспечить лучший опыт работы с allbtc pool</p>
  </div>
  <div class="system-card-img">
    <img src="../assets/img/Mockup-iphone.png" class="img-iphone img-system">
    <img src="../assets/img/Mockup-mobile-app.png" class="img-support img-system">
  </div>
</template>
<script>
</script>
<style scoped>
.system-card-inf{
  width: 399px;
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
  width: 408px;
  height: 722px;
}
.img-system{
  position: absolute;
}
.img-support{
  left: 42px;
  top: 12px;
}
.img-iphone{
  z-index: 10;
}
</style>
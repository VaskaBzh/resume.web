<template>
  <div class="system-card-inf">
    <p class="system-card-title">{{ $t("personal_account.title") }}</p>
    <p class="system-card-text">{{ $t("personal_account.text") }}</p>
  </div>
  <div class="system-card-img">
    <img src="../assets/img/Mockup-mac.png" class="img-mac img-system web">
    <img src="../assets/img/Mockup-statistic.png" class="img-statistic img-system web">

    <img src="../assets/img/Mockup-iphone.png" class="img-mac img-system mobile">
    <img src="../assets/img/Mockup-mobile-statistic.png" class="img-monitoring img-system mobile">
  </div>
  <p class="get-consultation">{{ $t("personal_account.button") }}</p>
</template>
<script>
import { HostingMessage } from "@/modules/hosting/lang/HostingMessage";

export default {
  i18n: {
          sharedMessages: HostingMessage,
        },
}
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
  padding: 8px 20px;
  width: 400px;
}
.img-mac{
  z-index: 10;
}
.mobile{
  display: none;
}
@media(max-width: 1450px){
  .system-card-img,  .img-mac{
    width: 736px;
    height: 423px;
  }
  .img-statistic{
    width: 584px;
    height: 365px;
    left: 80px;
    top: 20px;
  }
  .get-consultation{
    width: 704px;
  }
  .system-card-title{
    font-size: 24px;
  }
}
@media(max-width:450px){
  .mobile{
    display: inline-block;
  }
  .web{
    display: none;
  }
  .system-card-img, .img-mac{
    width: 281px;
    height: 497px;
  }
  .img-monitoring {
    width: 224px;
    height: 482px;
    left: 29px;
    top: 9px;
  }
  .system-card-inf{
    width: 244px;
  }
  .system-card-title{
    font-size: 18px;
  }
  .system-card-text{
    font-size: 14px;
  }
  .get-consultation{
    width: 328px;
    font-size: 12px;

  }
}
</style>
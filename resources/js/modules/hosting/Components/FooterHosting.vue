<template>
  <div class="footer-content">
    <p class="footer-title">{{ $t("footer.button") }}</p>
    <div class="footer-inf">
      <ul class="footer-links">
        <li v-for="link in links">{{ link.title }}</li>
      </ul>
      <div class="footer-location">
        <p><a href="#">support@all-btc.com</a></p>
        <p>BDubai Silicon Oasis, DDP, Building A2, <br> Dubai, United Arab Eirates</p>
        <div class="connect-buttons">
          <button class="connect-button">
            <a href="#">TELEGRAM</a>
          </button>
          <button class="connect-button">
            <a href="#">instagram</a>
          </button>
          <button class="connect-button">
            <a href="#">youtube</a>
          </button>
        </div>
      </div>
    </div>
  </div>
  <div>
    <p class="allbtc-pool">allbtc pool</p>
    <div class="police-conf">
      <span class="pointer">{{ $t("footer.text") }}</span>
      <span>© 2023 allbtc pool</span>
    </div>
  </div>
</template>
<script>
import { HostingMessage } from "@/modules/hosting/lang/HostingMessage";

export default {
  i18n: {
          sharedMessages: HostingMessage,
        },
  data() {
    return {
      links: [
        {
          title: this.$t("footer.list[0]"),
          url: '',
        },
        {
          title: this.$t("footer.list[1]"),
          url: '',
        },
        {
          title: this.$t("footer.list[2]"),
          url: '',
        },
        // {
        //   title: 'FAQ',
        //   url: '',
        // },
        // {
        //   title: 'Новости',
        //   url: '',
        // },
        // {
        //   title: 'Контакты',
        //   url: '',
        // },
      ]
    }
  },
}
</script>
<style scoped>
.allbtc-pool{
  font-feature-settings: 'clig' off, 'liga' off;
  font-family: Unbounded;
  font-size: 263px;
  font-style: normal;
  font-weight: 600;
  line-height: 120%; /* 315.6px */
  -webkit-text-stroke: 0.1px #222222;
  -webkit-text-fill-color: transparent;
  color: transparent;
}
.footer-content{
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
}
.footer-title{
  cursor: pointer;
  color: var(--gray-2100, #E4E7EC);
  font-family: Unbounded;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 120%; /* 16.8px */
  text-transform: uppercase;
  padding: 8px 20px;
  border-radius: 40px;
  border: 0.5px solid rgba(192, 228, 255, 0.60);
  background: var(--gray-470, rgba(13, 13, 13, 0.70));
  width: 253px;
  text-align: center;
}
.pointer{
  cursor: pointer;
}
.footer-inf{
  color: var(--gray-170, rgba(245, 250, 255, 0.70));
  text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
  font-family: NunitoSans;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 110%; /* 19.8px */
  width: 50%;
  display: flex;
  justify-content: space-between;
}
.footer-links{
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.footer-location{
  display: flex;
  flex-direction: column;
  gap: 20px;
}
.connect-buttons{
  display: flex;
  gap: 13px;
  margin-top: 30px;
}
.police-conf{
  display: flex;
  align-items: center;
  justify-content: space-between;
  color: var(--gray-120, rgba(245, 250, 255, 0.20));
  text-align: right;
  text-shadow: 0px 4.8px 8.5px rgba(14, 14, 14, 0.05);
  font-family: NunitoSans;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 120%; /* 21.6px */
}
.connect-button{
  border-radius: 20px;
  border: 1px solid var(--secondary-gray-2, rgba(152, 162, 179, 0.50));
  padding: 10px;
  color: var(--gray-170, rgba(245, 250, 255, 0.70));
  text-align: center;
  font-family: NunitoSans;
  font-size: 12px;
  font-style: normal;
  font-weight: 600;
  line-height: 120%; /* 14.4px */
  width: 108px;
  text-transform: uppercase;
  cursor: pointer;
}
li{
  cursor: pointer;
}
@media(max-width:1900px){
  .allbtc-pool{
    font-size: 214px;
  }
}
@media(max-width:1600px){
  .allbtc-pool{
    font-size: 106px;
  }
}
@media(max-width:1100px){
  .footer-content{
    flex-direction: column;
  }
  .footer-inf{
    width: 100%;
  }
  .footer-title{
    width: 30%;
    min-width: 229px;
    margin: 0 auto 50px;
  }
}
@media(max-width:858px){
  .allbtc-pool{
    font-size: 80px;
  }
}

@media (max-width: 650px) {
  .footer-inf {
    width: 100%;
    justify-content: space-between;
    flex-flow: column nowrap;
    gap: 30px;
  }
}
@media(max-width: 450px){
  .footer-inf{
    flex-direction: column;
  }
  .footer-links{
    height: 84px;
    flex-wrap: wrap;
    font-size: 14px;
    margin-bottom: 50px;
  }
  .footer-location{
    font-size: 14px;
  }
  .connect-buttons{
    margin-top: 0px;
    margin-bottom: 50px;
  }
  .allbtc-pool{
    font-size: 50px;
  }
  .police-conf{
    font-size: 12px;
    flex-direction: column;
    align-items: flex-start;
    gap: 5px;
  }
  .footer-hosting{
    height: auto;
  }
}
</style>

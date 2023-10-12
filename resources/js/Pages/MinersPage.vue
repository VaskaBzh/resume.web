
<template>
      <main class="main-miners">
        <article class="article-miners first-text">
            <div class="miners-content">
                <span class="">{{ $t("title[0]") }} <br></span>
                <span class="">{{ $t("title[1]") }}<br></span>
                <span class="text-mining">{{ $t("title[2]") }} <br></span>
                <span class="text-bitcoin">{{ $t("title[3]") }} <br></span>
            </div>
            <button-blue class="get-consultation">{{ $t("button") }}</button-blue>
        </article>
        <article class="article-hosting test-color second-text">
            <AboutView :facts="factsMiners" :title="titleMiners"></AboutView>
        </article>
        <article class="article-hosting article-work-with-us">
            <BlueView :inf="ourOffer"></BlueView>
        </article>
        <article class="article-hosting black-block">
            <PersonalAreaCard></PersonalAreaCard>
        </article>
        <article class="article-hosting black-block">
            <MobileAppCard></MobileAppCard>
        </article>
        <article class="article-hosting article-work-with-us">
            <GuaranteeCard></GuaranteeCard>
        </article>
        <article class="article-hosting black-block">
            <CommunityCard></CommunityCard>
        </article>
        <article class="article-hosting second-text">
            <ConnectCard></ConnectCard>
        </article>
        <footer class="footer-hosting">
            <FooterHosting></FooterHosting>
        </footer>
      </main>
</template>
<script>
import AboutView from '../modules/common/landing/Components/AboutView.vue';
import BlueView from "../modules/common/landing/Components/BlueView.vue";
import PersonalAreaCard from "../modules/hosting/Components/PersonalAreaCard.vue";
import MobileAppCard from "../modules/hosting/Components/MobileAppCard.vue";
import GuaranteeCard from "../modules/hosting/Components/GuaranteeCard.vue";
import ConnectCard from "../modules/hosting/Components/ConnectCard.vue";
import FooterHosting from "../modules/hosting/Components/FooterHosting.vue";
import CommunityCard from "../modules/miners/Components/CommunityCard.vue";
import { MinersMessage } from "@/modules/miners/lang/MinersMessage";


export default {
    name: 'miners-page',
    components: {
      AboutView,
      BlueView,
      PersonalAreaCard,
      MobileAppCard,
      GuaranteeCard,
      ConnectCard,
      FooterHosting,
      CommunityCard
    },
    i18n: {
            sharedMessages: MinersMessage,
    },
    data() {
        return {
            factsMiners: [
                {
                    num: '>3',
                    grayText: this.$t("who_are_we.column.gray_text[0]"),
                    mainText: [ this.$t("who_are_we.column.main_text[0]"),  this.$t("who_are_we.title[1]")],
                },
                {
                    num: '4%',
                    grayText: '',
                    mainText: [ this.$t("who_are_we.title[2]"),  this.$t("who_are_we.title[3]")],
                },
                {
                    num: '>1,7',
                    grayText: 'EH /s',
                    mainText: [ this.$t("who_are_we.title[4]"),  this.$t("who_are_we.title[5]")],
                },
            ],
            titleMiners: [ this.$t("who_are_we.title[0]"),  this.$t("who_are_we.title[1]"),  this.$t("who_are_we.title[2]")],
            ourOffer: {
              title:  this.$t("offer.title"),
              text:  this.$t("offer.text")
            }
        }
    },
}

</script>
<style scoped>
*{
    transition: all 0.3s linear;
}
.first-text{
    flex-direction: column;
}
.article-miners{
    width: 100vw;
    height: 120vh;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
}
.black-block{
    flex-direction: column;
    gap: 50px;
    border-radius: 70px;
    border-top: 1px solid #585757;
    border-bottom: 1px solid #585757;
    background: var(--gray-4100, #0D0D0D);
    box-shadow: 0px -4px 4px 0px rgba(18, 31, 78, 0.25), 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
    /* margin-top: -120px; */
}
.miners-content{
    width: 660px;
    height: 381px;
    color: var(--gray-1100, #F5FAFF);
    font-family: Unbounded;
    font-size: 55px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 66px */
    text-transform: uppercase;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.footer-hosting{
    width: 100vw;
    /* height: 673px; */
    flex-shrink: 0;
    border-radius: 70px 70px 0px 0px;
    border-top: 1px solid #585757;
    border-bottom: 1px solid #585757;
    background: var(--gray-4100, #0D0D0D);
    box-shadow: 0px -4px 4px 0px rgba(18, 31, 78, 0.25), 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
    padding: 100px 100px 50px;
}
.text-mining{
  margin-right: 130px;
}
.text-bitcoin{
  margin-left: 211px;
}
.get-consultation{
  display: flex;
  width: 480px;
  height: 56px;
  padding: 8px 20px;
  justify-content: center;
  align-items: center;
  gap: 10px;
  padding: 8px 20px;
  color: var(--gray-1100, #F5FAFF);
  font-family: Unbounded;
  font-size: 18px;
  font-style: normal;
  font-weight: 600;
  line-height: 120%; /* 21.6px */
  text-transform: uppercase;
  border-radius: 40px;
  border: 1px solid rgba(192, 228, 255, 0.60);
  background: var(--gray-480, rgba(13, 13, 13, 0.80));
  cursor: pointer;
}
.article-hosting{
    width: 100vw;
    height: 100vh;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
}
.second-text{
    background: var(--gray-4100, #0D0D0D);
    flex-direction: column;
    gap: 100px;
}
.article-work-with-us{
    border-radius: 70px;
    box-shadow: -5px 4px 15px 10px rgba(9, 36, 68, 0.10);
}
@media(max-width: 768px){
    .miners-content{
        font-size: 36px;
        line-height: 120%; /* 43.2px */
        width: 400px;
    }
    .get-consultation{
        width: 400px;
    }
}
@media(max-width: 450px){
    .miners-content{
        font-size: 22px;
        width: 322px;
        height: auto;
    }
    .get-consultation{
        width: 90vw;
        font-size: 12px;
        font-style: normal;
        font-weight: 600;
        margin-top: 70px;
        line-height: 120%; /* 14.4px */
        padding: 8px 20px;
        height: 40px;
    }
    .black-block{
        gap: 40px;
        padding: 15px 0;
    }
    .footer-hosting{
        padding: 40px 16px;
    }
    .text-mining{
      margin-right: 52px;
    }
    .text-bitcoin{
      margin-left: 84px;
    }
}
</style>

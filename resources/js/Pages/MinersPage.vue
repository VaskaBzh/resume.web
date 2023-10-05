
<template>
      <main class="main-miners">
        <article class="article-miners first-text">
            <div class="miners-content">
                <span class="">прозрачный <br></span>
                <span class="">и эффективный<br></span>
                <span class="text-mining">майнинг <br></span>
                <span class="text-bitcoin">bitcoin <br></span>
            </div>
            <button-blue class="get-consultation">получить консультацию</button-blue>
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
import CommunityCard from "../modules/hosting/Components/CommunityCard.vue";

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
    data() {
        return {
            factsMiners: [
                {
                    num: '>3',
                    grayText: 'лет',
                    mainText: ['Работаем на рынке', 'цифровых активов'],
                },
                {
                    num: '4%',
                    grayText: '',
                    mainText: ['постоянная', 'комиссия'],
                },
                {
                    num: '>1,7',
                    grayText: 'EH /s',
                    mainText: ['Общий хешрейт', 'Allbtc Pool'],
                },
            ],
            titleMiners: ['майнинг пул и ', 'комьюнити для', 'майнеров'],
            ourOffer: {
              title: 'что мы предлагаем',
              text: 'Эффективный и стабильный майнинг-пул с персональной комиссией, оптимизированный под добычу Bitcoin. А также комплекс инструментов для прозрачного и удобного анализа ваших активов.'
            }
        }
    },
}

</script>
<style scoped>
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
    height: 120vh;
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
    background: linear-gradient(165deg, #002195 8.98%, #007AF3 122.43%);
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
        width: 328px;
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
<template>
    <!-- <header-component/> -->
    <main class="main-hosting">
        <article class="article-hosting first-text">
            <div class="hosting-content">
                <span class="text-on">на</span>
                <span class="text-fifty">50% <br></span>
                <span class="text-increase">Увеличьте <br></span>
                <span class="text-income">ваш доход <br></span>
                <span class="text-cvt">за каждый квт</span>
            </div>
            <button-blue class="get-consultation">получить консультацию</button-blue>

        </article>
        <article class="article-hosting test-color second-text">
            <div class="how-are-we">кто мы</div>
            <div class="hosting-content how-we-are-content">
                <p class="who-we-are-text">
                    Эффективный пул <br>  
                    для добычи Bitcoin, <br>
                    оптимизированный <br>
                    для работы <br>
                    дата-центров <br>
                </p>
            </div>
            <div class="facts-container">
                <div class="help-button">?</div>
                <div class="fact-item" v-for="fact in facts">
                    <div class="item-content">
                        <div class="fact-row">
                            <span class="fact-num">{{ fact.num }}</span>
                            <span class="fact-gray-text">{{ fact.grayText }}</span>
                        </div>
                        <span class="fact-main-text">{{ fact.mainText }}</span>
                    </div>
  
                </div>
            </div>
        </article>
        <article class="article-hosting third-text">
            <div class="how-are-we">что мы предлагаем</div>
            <div class="offer-content">
                <span class="text-offer">увеличим</span>
                <div class="text-offer-column">
                    <span class="text-offer">ваш доход<br></span>
                    <span class="text-offer">за каждый квт<br></span>
                </div>
                <span class="text-offer text-end">на 50%<br></span>
            </div>
            <div class="offer-card-container">
                <div class="offer-card" v-for="offer in offers">
                    <div>
                        <p class="offer-title">{{ offer.percent }}</p>
                        <p class="offer-title">{{ offer.title }}</p>
                    </div>
                    <p class="offer-text">{{ offer.text }}</p>
                </div>
            </div>
        </article>
        <article class="article-hosting article-work-with-us">
            <WorkingWithUsCard></WorkingWithUsCard>
        </article>
        <article class="article-hosting black-block">
            <MonitoringSystemCard></MonitoringSystemCard>
        </article>
        <article class="article-hosting black-block">
            <SupportSystemCard></SupportSystemCard>
        </article>
        <article class="article-hosting article-work-with-us">
            <ForClientsCard></ForClientsCard>
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
        <article class="article-hosting second-text">
            <ConnectCard></ConnectCard>
        </article>
        <footer class="footer-hosting">
            <FooterHosting></FooterHosting>
        </footer>
    </main>
</template>
<script>
import HeaderComponent from "../modules/common/Components/HeaderComponent.vue";
import ButtonBlue from "../modules/common/Components/UI/ButtonBlue.vue";
import WorkingWithUsCard from "../modules/hosting/Components/WorkingWithUsCard.vue";
import MonitoringSystemCard from "../modules/hosting/Components/MonitoringSystemCard.vue";
import SupportSystemCard from "../modules/hosting/Components/SupportSystemCard.vue";
import ForClientsCard from "../modules/hosting/Components/ForClientsCard.vue";
import PersonalAreaCard from "../modules/hosting/Components/PersonalAreaCard.vue";
import MobileAppCard from "../modules/hosting/Components/MobileAppCard.vue";
import GuaranteeCard from "../modules/hosting/Components/GuaranteeCard.vue";
import ConnectCard from "../modules/hosting/Components/ConnectCard.vue";
import FooterHosting from "../modules/hosting/Components/FooterHosting.vue";


export default {
    name: 'hosting-page',
    components: {
         HeaderComponent,
         ButtonBlue,
         WorkingWithUsCard,
         MonitoringSystemCard,
         SupportSystemCard,
         ForClientsCard,
         PersonalAreaCard,
         MobileAppCard,
         GuaranteeCard,
         ConnectCard,
         FooterHosting
    },
    data() {
        return {
            facts: [
                {
                    num: '>3',
                    grayText: 'лет',
                    mainText: 'Работаем на рынке цифровых активо',
                },
                {
                    num: '5',
                    grayText: 'крупнейших дата-центров РФ',
                    mainText: 'Успешно работают с нами',
                },
                {
                    num: '>1,7',
                    grayText: 'EH /s',
                    mainText: 'Общий хешрейт Allbtc Pool',
                },
            ],
            offers:[
                {
                    percent: 'до 4% ',
                    title: 'персональная комиссия  для ваших клиентов',
                    text: 'С вами будет работать персональный менеджер, который поможет решить любые вопросы, в том числе вопросы ваших клиентов мы ценим наших клиентов и стремимся обеспечить лучший опыт работы с allbtc pool'
                },
                {
                    percent: 'до 75% ',
                    title: 'ваши вознаграждения  по партнерской программе',
                    text: 'С вами будет работать персональный менеджер, который поможет решить любые вопросы, в том числе вопросы ваших клиентов мы ценим наших клиентов и стремимся обеспечить лучший опыт работы с allbtc pool'
                }
            ]
        }
    },
}
</script>
<style scoped>
.offer-content{
    color: var(--gray-1100, #F5FAFF);
    text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
    font-family: Unbounded;
    font-size: 55px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 66px */
    text-transform: uppercase;
}
.text-offer-column{
    margin-left: 195px;
}
.text-end{
    display: flex;
    justify-content: end;
}
.facts-container{
    display: flex;
    position: relative;
}
.fact-item{
    border-left: 0.5px solid var(--gray-240, rgba(228, 231, 236, 0.40));
    padding: 82px 143px 0 30px;
}
.fact-item:last-child{
    border-right: 0.5px solid var(--gray-240, rgba(228, 231, 236, 0.40));
    padding: 82px 144px 0 30px;
}
.item-content{
    width: 431px;
    display: flex;
    flex-direction: column;
    gap: 150px;
    height: 90%;
}
.fact-row{
    display: flex;
    gap: 10px;
    align-items: end;
}
.first-text{
    flex-direction: column;
}
.offer-card-container{
    display: flex;
    align-items: center;
    justify-content: flex-end;
    width: 100%;
    margin-right: 137px;
    gap: 20px;
}
.offer-card{
    border-radius: 40px;
    border-top: 2px solid #555353;
    border-bottom: 0.5px solid #555353;
    background: var(--gray-480, rgba(13, 13, 13, 0.80));
    display: inline-flex;
    padding: 30px;
    flex-direction: column;
    align-items: flex-start;
    gap: 30px;
    width: 385px;
}
.offer-title{
    color: var(--gray-3100, #D0D5DD);
    font-family: Unbounded;
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 19.2px */
    text-transform: uppercase;
}
.offer-text{
    color: var(--gray-170, rgba(245, 250, 255, 0.70));
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 110%; /* 19.8px */
}
.fact-num{
    color: var(--gray-2100, #E4E7EC);
    font-family: Unbounded;
    font-size: 110px;
    font-style: normal;
    font-weight: 600;
    line-height: 100%; /* 110px */
    text-transform: uppercase;
}
.fact-gray-text{
    color: var(--gray-370, rgba(208, 213, 221, 0.70));
    font-family: Unbounded;
    font-size: 22px;
    font-style: normal;
    font-weight: 400;
    line-height: 120%; /* 26.4px */
    margin-bottom: 4px;
}
.fact-main-text{
    color: var(--gray-2100, #E4E7EC);
    font-family: Unbounded;
    font-size: 24px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 28.8px */
    text-transform: uppercase;
}
.main-hosting{
    width: 100vw;
    height: 100vh;
    margin: 0 auto;
    overflow-y: scroll;
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
.third-text{
    flex-direction: column;
    gap: 110px;
}
.hosting-content{
    width: 607px;
    height: 317px;
    color: var(--gray-1100, #F5FAFF);
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Unbounded;
    font-size: 44px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 52.8px */
    text-transform: uppercase;
}
.text-fifty{
    font-size: 156px;
}
.text-income{
    display: flex;
    align-items: end;
    justify-content: end;
}
.get-consultation{
    margin-top: 50px;
    padding: 8px 20px;
    width: 100%;
    color: var(--gray-1100, #F5FAFF);
    border-radius: 40px;
    border: 1px solid rgba(192, 228, 255, 0.60);
    width: 607px;
    background: var(--gray-480, rgba(13, 13, 13, 0.80));
    font-family: Unbounded;
    font-size: 14px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 16.8px */
    text-transform: uppercase;
}
.how-are-we{
    border-radius: 30px;
    border: 0.5px solid var(--secondary-gray, #98A2B3);
    padding: 14px 24px;
    color: var(--gray-3100, #D0D5DD);
    font-family: Unbounded;
    font-size: 20px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 24px */
    text-transform: uppercase;
}
.help-button{
    border-radius: 40px;
    border: 0.5px solid rgba(192, 228, 255, 0.60);
    background: var(--gray-470, rgba(13, 13, 13, 0.70));
    position: absolute;
    color: var(--gray-2100, #E4E7EC);
    font-family: Unbounded;
    font-size: 27px;
    font-style: normal;
    font-weight: 400;
    line-height: 120%; /* 32.4px */
    text-transform: uppercase;
    top: -76px;
    right: -56px;
    width: 60px;
    height: 60px;
    padding: 8px 20px;
    display: flex;
    align-items: center;
    cursor: pointer;
}
.article-work-with-us{
    border-radius: 70px;
    background: linear-gradient(165deg, #002195 8.98%, #007AF3 122.43%);
    box-shadow: -5px 4px 15px 10px rgba(9, 36, 68, 0.10);
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
@media(max-width:1800px){
    .item-content{
        width: 400px;
    }
    .fact-item{
        padding: 82px 35.5px 0 30px;
    }
    .fact-item:last-child{
        padding: 82px 36.5px 0 30px;
    }
}
@media(max-width:1500px){
    .item-content{
        width: 172px;
    }
    .fact-item{
        padding: 82px 40px 0 30px;
    }
    .fact-item:last-child{
        padding: 82px 41px 0 30px;
    }
    .fact-num{
        font-size: 60px;
    }
    .fact-gray-text{
        font-size: 12px;
    }
    .fact-main-text{
        font-size: 12px;
    }
    .who-we-are-text{
        /* font-size: 30px; */
    }
}
@media(max-width: 850px){
    .help-button{
        display: none;
    }
    .offer-content{
        font-size: 36px;
    }
    .how-are-we{
        font-size: 14px;
    }
    .offer-card-container{
        margin-right: 0px;
        justify-content: center;
    }
}
@media(max-width: 768px){
    .hosting-content{
        font-size: 36px;
        line-height: 120%; /* 43.2px */
        width: 400px;
    }
    .text-fifty{
        font-size: 106px;
    }
    .get-consultation{
        width: 400px;
    }
    .who-we-are-text{
        font-size: 20px;
        line-height: 120%; /* 24px */
    }
    .how-we-are-content{
        width: 304px;
        height: 120px;
    }
    .fact-item{
        padding: 33px 20px 0 20px;
    }
    .fact-item:last-child{
        padding: 33px 21px 0 20px;
    }
    .item-content{
        gap: 70px;
    }
}
@media(max-width: 450px){
    .hosting-content{
        font-size: 22px;
        width: 244px;
        height: auto;
    }
    .text-fifty{
        font-size: 60px;
    }
    .get-consultation{
        width: 328px;
        font-size: 12px;
        font-style: normal;
        font-weight: 600;
        margin-top: 70px;
        line-height: 120%; /* 14.4px */
    }
    .black-block{
        gap: 40px;
    }
    .who-we-are-text{
        font-size: 18px;
    }
    .how-we-are-content{
        width: 273px;
        height: 118px;
    }
    .facts-container{
        flex-direction: column;
        width: 100%;

    }
    .fact-item{
        border-top: 0.5px solid var(--gray-240, rgba(228, 231, 236, 0.40));
        border-left: none;
        padding: 20px 0 44px 0;
        display: flex;
        width: 100%;
        justify-content: center;
    }
    .fact-item:last-child{
        border-right: none;
        padding: 20px 0 44px 0;
    }
    .item-content{
        gap: 20px;
    }
    .how-are-we{
        font-size: 12px;
        padding: 8px 10px;
    }
    .second-text{
        gap: 50px;
    }
    .offer-content{
        font-size: 22px;
        padding: 0 16px;
        margin-top: 30px;
    }
    .text-offer-column{
        margin-left: 75px;
    }
    .offer-card-container{
        flex-direction: column;
    }
    .offer-card{
        width: 328px;
        padding: 20px;
    }
    .offer-title{
        font-size: 14px;
    }
    .offer-text{
        font-size: 14px;
    }
    .third-text{
        gap: 50px;
    }
    .footer-hosting{
        padding: 40px 16px;
    }
}
</style>
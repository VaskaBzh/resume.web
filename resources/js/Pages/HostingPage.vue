<template>
    <header-component/>
    <main class="main-hosting">
        <article class="article-hosting first-text">
            <div class="hosting-content">
                <span class="text-on">на</span>
                <span class="text-fifty">50% <br></span>
                <span class="text-increase">Увеличьте <br></span>
                <span class="text-income">ваш доход <br></span>
                <span class="text-cvt">за каждый квт</span>
                <button-blue class="get-consultation">получить консультацию</button-blue>
            </div>
        </article>
        <article class="article-hosting test-color second-text">
            <div class="how-are-we">кто мы</div>
            <div class="hosting-content">
                <p>
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
                            <span class="fact-num" :class="[fact.num == '5' ? 'orange-text' : '']">{{ fact.num }}</span>
                            <span class="fact-gray-text">{{ fact.grayText }}</span>
                        </div>
                        <span class="fact-main-text">{{ fact.mainText }}</span>
                    </div>
  
                </div>
            </div>
        </article>
    </main>
</template>
<script>
import HeaderComponent from "../modules/common/Components/HeaderComponent.vue";
import ButtonBlue from "../modules/common/Components/UI/ButtonBlue.vue";

export default {
    name: 'hosting-page',
    components: {
         HeaderComponent,
         ButtonBlue
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
            ]
        }
    },
}
</script>
<style scoped>
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
.fact-num{
    color: var(--gray-2100, #E4E7EC);
    font-family: Unbounded;
    font-size: 110px;
    font-style: normal;
    font-weight: 600;
    line-height: 100%; /* 110px */
    text-transform: uppercase;
}
.orange-text{
    color: #E1941F;
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
    border-radius: 40px;
    border: 1px solid rgba(192, 228, 255, 0.60);
    background: var(--gray-480, rgba(13, 13, 13, 0.80));
    backdrop-filter: blur(10px);
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
    backdrop-filter: blur(10px);
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
}
</style>
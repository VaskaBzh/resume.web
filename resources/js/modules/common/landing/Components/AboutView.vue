<template>
      <div class="who-are-we">{{ $t("who_are_we.button") }}</div>
      <div class="hosting-content who-we-are-content">
          <p class="who-we-are-text">
              {{ title[0] }} <br>  
              {{ title[1] }} <br>
              {{ title[2] }} <br v-if="title.length > 3">
              {{ title[3] }} <br v-if="title.length > 3">
              {{ title[4] }} <br v-if="title.length > 3">
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
                   <div>
                    <p class="fact-main-text">{{ fact.mainText[0] }}</p>
                    <p class="fact-main-text">{{ fact.mainText[1] }}</p>
                   </div>

               </div>
  
          </div>
      </div>
</template>
<script>
import { HostingMessage } from "@/modules/hosting/lang/HostingMessage";

export default {
  i18n: {
          sharedMessages: HostingMessage,
        },
  props: {
        facts: {
            type: Object,
            default: () => {},
        },
        title: {
            type: Array,
            default: () => []
        }
  }
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
    width: 400px;
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
.hosting-content{
    width: 607px;
    /* height: 317px; */
    color: var(--gray-1100, #F5FAFF);
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Unbounded;
    font-size: 44px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 52.8px */
    text-transform: uppercase;
}
.who-are-we{
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
    .who-are-we{
        font-size: 14px;
    }
}
@media(max-width: 768px){
    .hosting-content{
        font-size: 36px;
        line-height: 120%; /* 43.2px */
        width: 400px;
    }
    .who-we-are-text{
        font-size: 20px;
        line-height: 120%; /* 24px */
    }
    .who-we-are-content{
        width: 304px;
        /* height: 120px; */
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
    .who-we-are-text{
        font-size: 18px;
    }
    .who-we-are-content{
        width: 273px;
        /* height: 118px; */
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
    .who-are-we{
        font-size: 12px;
        padding: 8px 10px;
    }

}
</style>
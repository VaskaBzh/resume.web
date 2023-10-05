<template>
  <div class="card-community">
    <p class="card-title card-web">Большое комьюнити майнеров и новости индустрии</p>
    <p class="card-title card-mobile">Большое <br> комьюнити <br>  майнеров и <br> новости индустрии</p>

    <p class="card-text">Присоединяйтесь к комьюнити профессионалов- единомышленников и подписывайтесь на наши блоги для русскоязычной аудитории.</p>
  </div>
  <div class="lists">
    <div>
      <p class="list-title">вступайте в комьюнити</p>
      <div class="list-items">
        <button class="list-item-tg">
          Telegram комьюнити
        </button>
        <button class="list-item-tg">
          telegram канал
        </button>
      </div>
    </div>
    <div>
      <p class="list-title">читайте наши блоги</p>
      <div class="list-items">
        <button class="list-item-blog">
        <img src="../assets/img/yandex.png" class="img-community-web">
        <img src="../assets/img/yandex-mini.png" class="img-community-mobile">
        </button>
        <button class="list-item-blog">
          <img src="../assets/img/tinkoff.svg" class="img-community-web">
          <img src="../assets/img/tinkoff-mini.svg" class="img-community-mobile">
          
        </button>
        <button class="list-item-blog">
          <img src="../assets/img/vc.svg" class="img-community-web">
          <img src="../assets/img/vc-mini.svg" class="img-community-mobile">
        </button>
        <button class="list-item-blog">
          <img src="../assets/img/habr.svg" class="img-community-web">
          <img src="../assets/img/habr-mini.svg" class="img-community-mobile">

        </button>
      </div>
    </div>
  </div>
</template>
<style scoped>
.card-title{
  color: var(--gray-1100, #F5FAFF);
  /* Text Web/Headline 5 */
  font-family: Unbounded;
  font-size: 36px;
  font-style: normal;
  font-weight: 600;
  line-height: 120%; /* 43.2px */
  text-transform: uppercase;
  margin-bottom: 20px;
}
.card-text{
  color: var(--gray-170, rgba(245, 250, 255, 0.70));
  font-family: NunitoSans;
  font-size: 20px;
  font-style: normal;
  font-weight: 400;
  line-height: 110%; /* 22px */
  margin-bottom: 50px;
}
.card-community{
  width: 589px;
}
.list-title{
  color: var(--gray-1100, #F5FAFF);
  /* Text Web/Subtitle 3 */
  font-family: Unbounded;
  font-size: 24px;
  font-style: normal;
  font-weight: 600;
  line-height: 120%; /* 28.8px */
  text-transform: uppercase;
}
.list-items{
  display: flex;
  gap: 10px;
  margin-top: 30px;
}
.list-item-tg{
  color: var(--gray-3100, #D0D5DD);
  font-family: Unbounded;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 120%; /* 21.6px */
  text-transform: uppercase;
  border-radius: 30px;
  border: 0.5px solid var(--gray-320, rgba(208, 213, 221, 0.20));
  background: var(--gray-320, rgba(208, 213, 221, 0.20));
  box-shadow: 0px 4px 7px 0px rgba(14, 14, 14, 0.05);
  padding: 10px 25px;
  cursor: pointer;
}
.list-item-blog{
  border-radius: 30px;
  border: 0.5px solid var(--gray-320, rgba(208, 213, 221, 0.20));
  background: var(--gray-3100, #D0D5DD);
  box-shadow: 0px 4px 7px 0px rgba(14, 14, 14, 0.05);
  padding: 10px 25px;
  cursor: pointer;
}
.lists{
  display: flex;
  flex-direction: column;
  gap: 100px;
}
.img-community-mobile, .card-mobile{
    display: none;
}
@media(max-width: 768px){
  .card-title{
    font-size: 24px;
  }
  .card-text{
    font-size: 18px;
  }
  .list-title{
    font-size: 16px;
  }
  .card-community{
    width: 386px;
  }
  .lists{
    width: 386px;
  }
  .list-items{
    flex-wrap: wrap;
  }
  .list-item-blog{
    width: 122px;
    height: 40px;

  }
  .img-community-web{
    display: none;
  }
  .img-community-mobile{
    display: inline;
  }
}
@media(max-width: 450px){
  .card-web{
    display: none;
  }
  .card-mobile{
    display: inline;
  }
  .card-title{
    font-size: 18px;
  }
  .card-text{
    font-size: 14px;
    margin: 30px 0;
  }
  .list-title{
    font-size: 14px;
  }
  .card-community{
    width: 282px;  }
  .lists{
    width: 282px;
  }
  .list-item-tg{
    font-size: 14px;
    padding: var(--gap-2, 8px) 10px;
  }
  .list-item-blog{
    width: 106px;
    height: 32px;
    padding: 0;
  }
  .lists{
    gap: 40px;
  }
  .list-items{
    margin-top: 20px;
  }
}
</style>
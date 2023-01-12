<template>
  <div class="ref">
    <div class="ref__container">
      <div class="ref__section">
        <main-title tag="h2" titleName="Реферальная программа"></main-title>
        <div class="ref__block">
          <div class="ref__wrap">
            <span class="ref__subtitle">Баланс:</span>
            <span class="ref__balance"
              ><span>{{ this.bitcoins.toFixed(8) }}</span> BTC</span
            >
            <p class="ref__text">
              Ваш реферальный баланс невыплаченных средств, выплата происходит
              один раз в неделю по пятницвм.
            </p>
            <div class="ref__wrap_block">
              <div class="ref__link">
                Ваша ссылка:
                <span
                  >{{ this.link }}
                  <div class="ref__link-copy" @click="this.copy(1)"></div
                ></span>
              </div>
              <span class="ref__percent"
                >Текущий процент: <span>{{ this.percent }}%</span></span
              >
            </div>
          </div>
          <div class="ref__wrap ref__wrap-back">
            <main-title
              tag="h3"
              titleName="Приглашайте людей и зарабатывайте"
            ></main-title>
            <p class="ref__text">
              Зарабатывайте до <span>0,5%</span> с майнинга приглашенных
              пользователей
            </p>
            <router-link class="main__link main__link-underline" to="/faqview"
              >Подбробнее в FAQ</router-link
            >
          </div>
        </div>
        <div class="ref__wrap ref__wrap-level">
          <div class="ref__wrap_row">
            <span class="ref__subtitle"
              >Ваш уровень: <span>{{ this.level }}</span></span
            >
            <button class="ref__button">Подробнее об уровнях</button>
            <span class="ref__subtitle ref__subtitle-next"
              >До следующего уровня: <span>862.87 <span>TH/s</span></span></span
            >
          </div>
          <div class="ref__progress">
            <div class="ref__line"></div>
          </div>
          <div class="ref__wrap_row">
            <router-link
              class="main__link main__link-underline"
              to="/refcalcview"
              >Реферальный калькулятор</router-link
            >
            <div class="ref__info">
              <span>137,13 TH/s</span> из <span>1000 TH/s</span>
            </div>
          </div>
        </div>
      </div>
      <div class="ref__section">
        <main-title class="ref__title" tag="h2" titleName="Статистика и прогноз"
          ><button class="ref__title_button ref__title_button-active">
            Текущий месяц</button
          ><button class="ref__title_button">
            Прогнозируемый следующий месяц
          </button></main-title
        >
        <div class="ref__wrap ref__wrap-statistic">
          <div class="ref__wrap_column">
            <span class="ref__subtitle">Реферальный хешрейт</span>
            <span class="ref__value"><span>137.13</span> TH/s</span>
          </div>
          <div class="ref__wrap_column">
            <span class="ref__subtitle">Ваш уровень</span>
            <span class="ref__value"
              ><span>{{ this.level }}</span></span
            >
          </div>
          <div class="ref__wrap_column">
            <span class="ref__subtitle">Процент вознаграждения</span>
            <span class="ref__value"
              ><span>{{ this.percent }}</span> %</span
            >
          </div>
          <div class="ref__wrap_column">
            <span class="ref__subtitle">Количество активных рефералов</span>
            <span class="ref__value"><span>1</span></span>
          </div>
          <div class="ref__wrap_column">
            <span class="ref__subtitle">Доход за месяц</span>
            <span class="ref__value"><span>0.00000681</span> BTC</span>
          </div>
        </div>
      </div>
      <div class="ref__section">
        <main-title
          tag="h2"
          titleName="Реферальные начисления"
          class="ref__title"
        >
          <div class="ref__filter">Фильтровать по дате</div>
        </main-title>
        <main-slider :table="this.refAccrualsInfo"></main-slider>
      </div>
      <div class="ref__section">
        <main-title tag="h2" titleName="Реферальные выплаты" class="ref__title">
          <div class="ref__filter">Фильтровать по дате</div>
        </main-title>
        <main-slider :table="this.refPaymentInfo"></main-slider>
      </div>
      <div class="ref__section">
        <main-title
          tag="h2"
          titleName="Список приглашаемых пользователей"
          class="ref__title"
        ></main-title>
        <main-slider :table="this.refList"></main-slider>
      </div>
    </div>
  </div>
</template>
<script>
import MainSlider from "@/components/account/MainSlider";

export default {
  components: { MainSlider },
  data() {
    return {
      bitcoins: 0,
      link: "https://allbtc.com/pool?r=258656424",
      refAccrualsInfo: {
        titles: ["Дата", "Сумма"],
        rows: [
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
        ],
      },
      refPaymentInfo: {
        titles: ["Дата", "Сумма"],
        rows: [
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
          {
            date: "29.11.2022",
            time: "15:10:45",
            BTC: 0,
          },
        ],
      },
      refList: {
        titles: [
          "Элекстронная почта",
          "Текущий хешрейт",
          "Средний хешрейт за текущий месяц",
          "Дата регистрации",
        ],
        rows: [
          {
            email: "р*******@gmail.com",
            hash: 137.13,
            middleHash: 137.13,
            date: "29.11.2022",
            time: "15:10:45",
          },
          {
            email: "р*******@gmail.com",
            hash: 137.13,
            middleHash: 137.13,
            date: "29.11.2022",
            time: "15:10:45",
          },
          {
            email: "р*******@gmail.com",
            hash: 137.13,
            middleHash: 137.13,
            date: "29.11.2022",
            time: "15:10:45",
          },
        ],
      },
    };
  },
  methods: {
    copy() {
      navigator.clipboard.writeText(this.link);
    },
  },
  computed: {
    percent() {
      return 0.05;
    },
    level() {
      let lvl = 1;
      return lvl;
    },
  },
  mounted() {
    document.title = "Реферальная программа";
  },
};
</script>
<style lang="scss" scoped>
.ref {
  width: 100%;
  margin-top: 42px;
  &__section {
    &:not(:last-child) {
      margin-bottom: 64px;
    }
  }
  &__title {
    width: 100%;
    display: inline-flex;
    align-items: center;
    margin-bottom: 24px;
    &_button {
      margin-left: 20px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      height: 32px;
      padding: 12px;
      border-radius: 16px;
      background-color: transparent;
      font-size: 17px;
      line-height: 20px;
      color: #99acd3;
      &-active {
        color: #181847;
        background-color: #fff;
      }
      &:first-child {
        margin-left: auto;
      }
    }
  }
  &__filter {
    cursor: pointer;
    margin-left: auto;
    font-style: normal;
    font-size: 18px;
    line-height: 26px;
    color: rgba(0, 0, 0, 0.62);
    display: inline-flex;
    align-items: center;
    &::before {
      content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'%3E%3Cpath d='M3 10H21M7 3V5M17 3V5M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z' stroke='%23000034' stroke-opacity='0.62' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
      width: 24px;
      height: 24px;
      margin-right: 8px;
    }
    &::after {
      content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'%3E%3Cpath d='M18 10L12 16L6 10' stroke='black' stroke-opacity='0.62' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
      margin-left: 8px;
      width: 24px;
      height: 24px;
    }
  }
  // .ref__block
  &__block {
    width: 100%;
    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
    margin-top: 23px;
    gap: 30px;
    margin-bottom: 30px;
    .ref__wrap {
      min-height: 315px;
    }
  }
  // .ref__wrap
  &__wrap {
    width: 100%;
    padding: 24px;
    background: rgba(255, 255, 255, 0.29);
    border-radius: 21px;
    display: flex;
    flex-direction: column;
    &-back {
      background: rgba(255, 255, 255, 0.29)
        url("../../assets/img/ref_img_back.png") no-repeat right center;
      .ref__text {
        max-width: 280px;
      }
      .title {
        max-width: 265px;
        margin-bottom: 10px;
      }
    }
    &-level {
      padding: 24px 24px 40px;
    }
    &-statistic {
      display: flex;
      width: 100%;
      justify-content: space-between;
      align-items: flex-start;
      padding: 24px;
      flex-direction: row;
    }
    &_column {
      display: flex;
      flex-direction: column;
      gap: 4px;
      .ref__subtitle {
        font-size: 16px;
        line-height: 23px;
      }
    }
    &_row {
      display: flex;
      align-items: center;
      width: 100%;
    }
    // .ref__wrap_block
    &_block {
      padding: 16px 16px 24px;
      background-color: #fff;
      border-radius: 21px;
      display: flex;
      flex-direction: column;
      gap: 24px;
    }
  }
  &__progress {
    margin: 24px 0;
    width: 100%;
    position: relative;
    height: 10px;
    border-radius: 10px;
    background-color: #e8ecf2;
  }
  &__line {
    position: absolute;
    left: 0;
    top: 0;
    height: 10px;
    width: 25%;
    background: linear-gradient(84.14deg, #3f7bdd 8.75%, #4282ec 92.01%);
    border-radius: 21px;
  }
  &__info {
    margin-left: auto;
    font-weight: 400;
    font-size: 20px;
    line-height: 28px;
    color: #0000349e;
    span {
      font-weight: 700;
      color: #000034;
    }
  }
  &__value {
    font-weight: 500;
    font-size: 28px;
    line-height: 40px;
    color: #0000349e;
    span {
      font-weight: 700;
      color: #000034;
    }
  }
  // .ref__subtitle
  &__subtitle {
    font-weight: 500;
    font-size: 18px;
    line-height: 26px;
    color: rgba(0, 0, 0, 0.62);
    display: inline-flex;
    align-items: center;
    span {
      font-weight: 700;
      line-height: 40px;
      font-size: 28px;
      color: #000034;
      margin-left: 4px;
      span {
        font-size: 20px;
        line-height: 28px;
        margin-left: 0;
      }
    }
    &-next {
      span {
        margin-left: 12px;
        span {
          margin-left: 0;
        }
      }
    }
  }
  &__button {
    margin: 0 auto 0 20px;
    background-color: rgba(194, 213, 242, 0.61);
    border-radius: 13px;
    padding: 0 18px;
    display: inline-flex;
    align-items: center;
    height: 28px;
    min-width: 190px;
    transition: all 0.3s ease;
    &:hover {
      background-color: #4282ec;
      color: #fff;
    }
  }
  // .ref__balance
  &__balance {
    margin: 1px 0 8px;
    font-weight: 500;
    font-size: 28px;
    line-height: 40px;
    color: #0000349e;
    span {
      color: #000034;
      font-weight: 700;
    }
  }
  // .ref__text
  &__text {
    margin-bottom: 24px;
    font-weight: 400;
    font-size: 13px;
    line-height: 18px;
    color: rgba(0, 0, 0, 0.62);
    span {
      font-weight: 700;
    }
  }
  // .ref__link
  &__link {
    font-weight: 500;
    font-size: 18px;
    line-height: 26px;
    color: rgba(0, 0, 0, 0.62);
    display: inline-flex;
    align-items: center;
    span {
      padding: 7px 14px;
      border-radius: 21px;
      background: linear-gradient(
        179.87deg,
        #e6eaf0 1.02%,
        #e6eaf1 4.79%,
        #e7ebf1 8.76%,
        #eaeef4 14.75%,
        #e8ecf2 19.07%
      );
      font-size: 18px;
      line-height: 143.1%;
      color: rgba(0, 0, 52, 0.62);
      position: relative;
      margin-left: 8px;
      max-width: 399px;
      width: 100%;
      height: 40px;
    }
  }
  // .ref__link-copy
  &__link-copy {
    width: 24px;
    height: 24px;
    cursor: pointer;
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'%3E%3Cpath d='M15 3V6.4C15 6.96005 15 7.24008 15.109 7.45399C15.2049 7.64215 15.3578 7.79513 15.546 7.89101C15.7599 8 16.0399 8 16.6 8H20M10 8H6C4.89543 8 4 8.89543 4 10V19C4 20.1046 4.89543 21 6 21H12C13.1046 21 14 20.1046 14 19V16M16 3H13.2C12.0799 3 11.5198 3 11.092 3.21799C10.7157 3.40973 10.4097 3.71569 10.218 4.09202C10 4.51984 10 5.0799 10 6.2V12.8C10 13.9201 10 14.4802 10.218 14.908C10.4097 15.2843 10.7157 15.5903 11.092 15.782C11.5198 16 12.0799 16 13.2 16H16.8C17.9201 16 18.4802 16 18.908 15.782C19.2843 15.5903 19.5903 15.2843 19.782 14.908C20 14.4802 20 13.9201 20 12.8V7L16 3Z' stroke='%23000034' stroke-opacity='0.33' stroke-width='2' stroke-linejoin='round'/%3E%3C/svg%3E");
  }
  // .ref__percent
  &__percent {
    font-weight: 500;
    font-size: 18px;
    line-height: 26px;
    color: rgba(0, 0, 0, 0.62);
    span {
      font-weight: 700;
    }
  }
}
</style>

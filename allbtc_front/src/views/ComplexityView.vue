<template>
  <div class="complexity">
    <div class="complexity__container">
      <div class="complexity__main">
        <div class="complexity__content">
          <main-title tag="h1" class="complexity__title"
            >Сложность сети</main-title
          >
          <div class="complexity__text main__text">
            Сложность корректируется каждые 2016 блоков (примерно каждые 2
            недели), чтобы среднее время между каждым блоком оставалось в
            размере 10 минут.
          </div>
        </div>
        <div class="complexity__image">
          <img src="../assets/img/compl-main-img.png" alt="" />
        </div>
      </div>
      <BarChart :graphs="graphs" />
      <statistics-view :table="table" />
    </div>
  </div>
</template>

<script>
import BarChart from "@/components/BarChart";
import StatisticsView from "@/components/tables/StatisticsView";

export default {
  components: { BarChart, StatisticsView },
  data() {
    return {
      graphs: [
        {
          id: 1,
          title: "Сложность",
          values: [48, 30, 50, 48, 56, 57, 40],
          about: [
            {
              id: 11,
              title: "Хэшрейт",
              text: "201.67 EH/s",
            },
            {
              id: 12,
              title: "Сложность",
              text: "28,174,668,481,289",
              span: "28.17 T",
            },
          ],
        },
        {
          id: 2,
          title: "Сложность (Шкала)",
          values: [0, 0.9, 3, 7, 4, 9, 8, 16],
          about: [
            {
              id: 21,
              title: "Ожидаемая следующая сложность",
              text: "28,452,668,782,523",
              span: "(+0.99%) 28.45 T",
            },
            {
              id: 22,
              title: "Дата следующей сложности",
              text: "1 Дни 1 Часы",
            },
          ],
        },
      ],
      table: {
        titles: [
          "Высота блока",
          "Время блока",
          "Сложность",
          "Изменение",
          "Bits",
          "В среднем на блок",
          "Средний хэшрейт",
        ],
        rows: [
          {
            id: 1000,
            height: "747,936",
            time: "2022-08-04 17:54:43",
            complexity: { main: "28,174,668,481,289 - ", span: "28.17 T" },
            change: "+ 1.74 %",
            bits: "0x1709fd7e",
            average: "09 мин 50 с",
            hashrate: "201.43 EH/s",
          },
          {
            id: 1001,
            height: "747,936",
            time: "2022-08-04 17:54:43",
            complexity: { main: "28,174,668,481,289 - ", span: "28.17 T" },
            change: "+ 1.74 %",
            bits: "0x1709fd7e",
            average: "09 мин 50 с",
            hashrate: "201.43 EH/s",
          },
          {
            id: 1002,
            height: "747,936",
            time: "2022-08-04 17:54:43",
            complexity: { main: "28,174,668,481,289 - ", span: "28.17 T" },
            change: "+ 1.74 %",
            bits: "0x1709fd7e",
            average: "09 мин 50 с",
            hashrate: "201.43 EH/s",
          },
          {
            id: 1003,
            height: "747,936",
            time: "2022-08-04 17:54:43",
            complexity: { main: "28,174,668,481,289 - ", span: "28.17 T" },
            change: "+ 1.74 %",
            bits: "0x1709fd7e",
            average: "09 мин 50 с",
            hashrate: "201.43 EH/s",
          },
          {
            id: 1004,
            height: "747,936",
            time: "2022-08-04 17:54:43",
            complexity: { main: "28,174,668,481,289 - ", span: "28.17 T" },
            change: "+ 1.74 %",
            bits: "0x1709fd7e",
            average: "09 мин 50 с",
            hashrate: "201.43 EH/s",
          },
          {
            id: 1005,
            height: "747,936",
            time: "2022-08-04 17:54:43",
            complexity: { main: "28,174,668,481,289 - ", span: "28.17 T" },
            change: "+ 1.74 %",
            bits: "0x1709fd7e",
            average: "09 мин 50 с",
            hashrate: "201.43 EH/s",
          },
        ],
      },
    };
  },
};
</script>

<style lang="scss" scoped>
.complexity {
  // .complexity__main
  &__main {
    display: flex;
    align-items: center;
    @media (max-width: 767.98px) {
      flex-direction: column;
    }
  }
  // .complexity__content
  &__content {
    flex: 1 0 40%;
    position: relative;
    @media (max-width: 991.98px) {
      flex: 1 0 60%;
    }
  }
  // .complexity__title
  &__title {
    margin-bottom: 24px;
    @media (max-width: 767.98px) {
      margin-top: 32px;
      text-align: center;
      margin-bottom: 10px;
    }
  }
  // .complexity__text
  &__text {
    @media (max-width: 767.98px) {
      text-align: center;
      font-size: 16px;
      line-height: 148.6%;
    }
  }
  // .complexity__image
  &__image {
    position: relative;
    & img {
      max-width: 1050px;
      @media (max-width: 1270px) {
        max-width: 770px;
      }
      @media (max-width: 767.98px) {
        position: relative;
        left: 20vw;
        max-width: unset;
        width: 140vw;
        object-fit: cover;
      }
    }
  }
}
.graph {
  margin-bottom: 50px;
  @media (max-width: 767.98px) {
    margin-bottom: 35px;
  }
}
</style>

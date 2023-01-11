<template>
  <div v-if="table" class="statistics">
    <div class="statistics__main">
      <table
        v-if="viewportWidth >= 1270"
        border="0"
        cellspacing="0"
        cellpadding="0"
      >
        <tr class="statistics__titles">
          <th v-for="(title, i) in table.titles" :key="i">{{ title }}</th>
        </tr>
        <tr
          class="odd"
          v-for="(row, i) in table.rows"
          :key="row.id"
          :data-index="i"
        >
          <td class="statistics__height">
            <a href="#">{{ row.height }}</a>
          </td>
          <td class="statistics__text">{{ row.time }}</td>
          <td class="statistics__text statistics__complexity">
            {{ row.complexity.main }} <span> {{ row.complexity.span }} </span>
          </td>
          <td class="statistics__text statistics__change">{{ row.change }}</td>
          <td class="statistics__text statistics__bits">{{ row.bits }}</td>
          <td class="statistics__text">{{ row.average }}</td>
          <td class="statistics__text">{{ row.hashrate }}</td>
        </tr>
      </table>
      <div v-else class="statistics__list_con">
        <ul class="statistics__list">
          <li
            v-for="(row, i) in table.rows"
            :key="row.id"
            :data-index="i"
            class="statistics__item"
          >
            <div
              v-for="(title, j) in table.titles"
              :key="j"
              class="statistics__item_inner"
            >
              <div class="statistics__item_title">{{ title }}</div>
              <p v-if="j == 0" class="statistics__height">
                <a href="#">{{ row.height }}</a>
              </p>
              <p v-else-if="j == 1" class="statistics__text">
                {{ row.time }}
              </p>
              <p
                v-else-if="j == 2"
                class="statistics__text statistics__complexity"
              >
                {{ row.complexity.main }}
                <span> {{ row.complexity.span }} </span>
              </p>
              <p v-else-if="j == 3" class="statistics__text statistics__change">
                {{ row.change }}
              </p>
              <p v-else-if="j == 4" class="statistics__text statistics__bits">
                {{ row.bits }}
              </p>
              <p v-else-if="j == 5" class="statistics__text">
                {{ row.average }}
              </p>
              <p v-else-if="j == 6" class="statistics__text">
                {{ row.hashrate }}
              </p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      viewportWidth: 0,
    };
  },
  created() {
    window.addEventListener("resize", this.handleResize);
    this.handleResize();
  },
  methods: {
    handleResize() {
      this.viewportWidth = window.innerWidth;
    },
  },
  props: {
    table: {},
  },
};
</script>

<style lang="scss" scoped>
.statistics {
  background: rgba(255, 255, 255, 0.29);
  border-radius: 21px;
  padding: 17px;
  @media (max-width: 1270px) {
    padding: 0;
    background-color: transparent;
    border-radius: unset;
  }
  // .statistics__main
  &__main {
    background: #ffffff;
    border-radius: 21px;
    @media (max-width: 1270px) {
      background-color: transparent;
      border-radius: unset;
    }
    & table {
      width: 100%;
      border-collapse: unset;
    }
    & tr.odd {
      &[data-index="0"] td {
        padding-top: 24px;
      }
      &:nth-child(2n + 1) {
        background: rgba(235, 238, 245, 0.6);
      }
    }
    & th {
      font-family: "AmpleSoftPro";
      font-style: normal;
      font-weight: 500;
      font-size: 17px;
      line-height: 143.1%;
      color: #000000;
      padding: 22px 0 18px;
      text-align: left;
      border-bottom: 1px solid rgba(0, 0, 0, 0.17);
      &:first-child {
        padding-left: 44px;
      }
      &:last-child {
        padding-right: 44px;
      }
      &:nth-child(4),
      &:nth-child(5),
      &:nth-child(6),
      &:nth-child(7) {
        text-align: center;
      }
    }
    & td {
      padding-top: 7px;
      padding-bottom: 7px;
      &:first-child {
        padding-left: 44px;
      }
      &:last-child {
        padding-right: 44px;
      }
      &:nth-child(4),
      &:nth-child(5),
      &:nth-child(6),
      &:nth-child(7) {
        text-align: center;
      }
    }
  }
  // .statistics__title
  &__titles {
  }
  // .statistics__height
  &__height {
    font-family: "Ubuntu";
    font-style: normal;
    font-weight: 500;
    font-size: 15px;
    line-height: 143.1%;
    text-decoration-line: underline;
    color: #4182eb;
  }
  // .statistics__time
  &__text {
    font-family: "Ubuntu";
    font-style: normal;
    font-weight: 400;
    font-size: 15px;
    line-height: 143.1%;
    color: rgba(0, 0, 0, 0.7);
  }
  // .statistics__complexity
  &__complexity {
    & span {
      color: #e9c058;
    }
  }

  // .statistics__change
  &__change {
    color: #e9c058;
  }

  // .statistics__list
  &__list {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    @media (max-width: 991.98px) {
      grid-template-columns: repeat(2, 1fr);
    }
    @media (max-width: 520px) {
      grid-template-columns: 1fr;
    }
    &_con {
      background: rgba(255, 255, 255, 0.29);
      border-radius: 10px;
      padding: 17px;
      @media (max-width: 479.98px) {
        margin: 0 -15px;
      }
    }
  }
  // .statistics__item
  &__item {
    background: #ffffff;
    border-radius: 10px;
    padding: 30px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    // .statistics__item_inner
    &_inner {
    }
    // .statistics__item_title
    &_title {
      font-style: normal;
      font-weight: 500;
      font-size: 17px;
      line-height: 143.1%;
      color: #000000;
      margin-bottom: 3px;
    }
    // .
    &_text {
    }
  }
}
</style>

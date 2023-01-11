<template lang="">
  <div class="workers">
    <div class="workers__wrapper">
      <main-title tag="h2" enter-class="workers__title">Воркеры</main-title>
      <div class="workers__filter">
        <div class="workers__filter_block">
          <div class="workers__filter_label">Отображение</div>
          <main-select class="workers__select" :options="workersOptions">
          </main-select>
        </div>
        <div class="workers__filter_block">
          <div class="workers__filter_label">Статус</div>
          <main-select class="workers__select" :options="statuses">
          </main-select>
        </div>
        <span class="workers__button">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="21"
            height="21"
            viewBox="0 0 21 21"
            fill="none"
          >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M1.07129 10.0703C1.07129 9.51803 1.519 9.07031 2.07129 9.07031H18.0713C18.6236 9.07031 19.0713 9.51803 19.0713 10.0703C19.0713 10.6226 18.6236 11.0703 18.0713 11.0703H2.07129C1.519 11.0703 1.07129 10.6226 1.07129 10.0703Z"
              fill="white"
            />
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M10.0708 1.0708C10.6231 1.0708 11.0708 1.51852 11.0708 2.0708V18.0708C11.0708 18.6231 10.6231 19.0708 10.0708 19.0708C9.51852 19.0708 9.0708 18.6231 9.0708 18.0708V2.0708C9.0708 1.51852 9.51852 1.0708 10.0708 1.0708Z"
              fill="white"
            />
          </svg>
        </span>
      </div>
      <div class="workers__wrap">
        <workers-table :table="table" />
      </div>
    </div>
  </div>
</template>
<script>
import WorkersTable from "@/components/tables/WorkersTable";

export default {
  components: { WorkersTable },
  data() {
    return {
      table: {
        titles: [
          "Имя воркера",
          "Текущий",
          "Ср.хешрейт /1ч",
          "Ср.хешрейт /24ч",
          "Частота отказов /24ч",
        ],
        rows: [
          {
            hashClass: "active",
            hash: 1,
            hashRate: 171.7,
            hashAvarage: 171.7,
            hashAvarage24: 171.7,
            rejectRate: 0.16,
          },
          {
            hashClass: "unstable",
            hash: 4,
            hashRate: 171.7,
            hashAvarage: 171.7,
            hashAvarage24: 171.7,
            rejectRate: 0.16,
          },
          {
            hashClass: "unactive",
            hash: 8,
            hashRate: 171.7,
            hashAvarage: 171.7,
            hashAvarage24: 171.7,
            rejectRate: 0.16,
          },
        ],
        mainRow: {
          hash: "Общий хешрейт",
          hashRate: 171.7,
          hashAvarage: 171.7,
          hashAvarage24: 171.7,
          rejectRate: 0,
        },
      },
      workersOptions: [
        { title: "По одиночке", value: 1 },
        { title: "Bitcoin Cash", value: 2 },
        { title: "Litecoin", value: 3 },
        { title: "Dash", value: 4 },
      ],
      statuses: [
        { title: "Все", value: 1 },
        { title: "Активные", value: 2 },
        { title: "Нестабильные", value: 3 },
        { title: "Неактивные", value: 4 },
      ],
    };
  },
};
</script>
<style lang="scss" scoped>
.workers {
  width: 100%;
  &__wrap {
    width: 100%;
    padding: 8px 16px 24px;
    background: rgba(255, 255, 255, 0.29);
    border-radius: 21px;
    display: flex;
    flex-wrap: wrap;
  }
  &__button {
    width: 60px;
    height: 44px;
    border-radius: 13px;
    background-color: #4182ec;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    margin-left: auto;
    svg {
      width: 14px;
      height: 14px;
    }
  }
  &__filter {
    margin: 16px 0 24px;
    display: flex;
    align-items: flex-end;
    &_block {
      margin-right: 30px;
      max-width: 230px;
      width: 100%;
      &:last-child {
        margin-right: 0;
      }
    }
    &_label {
      font-weight: 400;
      font-size: 16px;
      line-height: 23px;
      color: rgba(0, 0, 0, 0.62);
      margin-bottom: 8px;
    }
  }
  &__select {
    height: 48px;
    .select_title {
      font-weight: 500;
      font-size: 18px;
      line-height: 26px;
      color: #000034;
    }
  }
}
</style>

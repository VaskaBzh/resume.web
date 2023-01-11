<template>
  <div class="BTC__block">
    <span class="BTC__title">{{ title }}</span>
    <div class="BTC__value">
      <span>{{ BTC }} BTC</span><span>{{ dollarCalc }} $</span
      ><span>{{ rubleCalc }} ₽</span>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    BTC: {
      type: String,
      default: "0.00000000",
    },
    title: String,
  },
  data() {
    return {
      dollar: 0,
      ruble: 0,
    };
  },
  computed: {
    dollarCalc() {
      return (this.BTC * 16850.02).toFixed(2);
    },
    rubleCalc() {
      return (this.BTC * 1153637.03).toFixed(2);
    },
  },
  name: "btc-calculator",
};
</script>
<style lang="scss">
.BTC {
  &__block {
    display: flex;
    flex-direction: column;
    margin-bottom: 24px;
    &:last-child {
      margin-bottom: 0;
    }
  }
  &__title {
    font-size: 16px;
    line-height: 22px;
    color: rgba(0, 0, 0, 0.62);
  }
  &__value {
    font-weight: 400;
    font-size: 16px;
    line-height: 22px;
    color: rgba(0, 0, 0, 0.62);
    display: inline-flex;
    align-items: center;
    flex-wrap: wrap;
    span {
      white-space: nowrap;
      margin: 0 5px 0 0;
      &::before {
        content: "≈";
        margin: 0 5px 0 0;
      }
      &:first-child {
        font-weight: 500;
        font-size: 18px;
        line-height: 26px;
        color: #331a38;
        &::before {
          content: none;
        }
      }
      &:last-child {
        margin-right: 0;
      }
    }
  }
}
</style>

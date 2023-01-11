<template>
  <div class="payment-card">
    <btc-calculator :title="titleFirst" :BTC="BTCValueFirst" />
    <btc-calculator :title="titleSecond" :BTC="BTCValueSecond" />
  </div>
</template>
<script>
export default {
  props: {
    titleFirst: String,
    titleSecond: String,
    BTCValueFirst: String,
    BTCValueSecond: String,
  },
};
</script>
<style lang="scss" scoped>
.payment-card {
  width: calc(50% - 15px);
  margin-right: auto;
  background: #ffffff;
  border-radius: 21px;
  padding: 24px;
  &:last-child {
    margin-right: 0;
  }
}
</style>

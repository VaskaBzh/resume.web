<template>
  <h1 v-if="this.tag == 'h1'" class="title">
    {{ this.titleName }}
    <slot></slot>
  </h1>
  <h2 v-else-if="this.tag == 'h2'" class="title">
    {{ this.titleName }}
    <slot></slot>
  </h2>
  <h3 v-else-if="this.tag == 'h3'" class="title">
    {{ this.titleName }}
    <slot></slot>
  </h3>
  <div v-else class="title">
    {{ this.titleName }}
    <slot></slot>
  </div>
</template>
<script>
export default {
  name: "main-title",
  props: {
    titleName: String,
    tag: String,
  },
};
</script>
<style lang="scss" scoped>
.title {
  font-family: AmpleSoftPro;
  font-style: normal;
}
h1 {
  color: #000034;
  font-weight: 500;
  font-size: 64px;
  line-height: 107.6%;
  @media (max-width: 1270px) {
    font-size: 48px;
    line-height: 52px;
  }
}
h2 {
  font-weight: 700;
  font-size: 40px;
  line-height: 50px;
  color: #000000;
}
h3 {
  font-weight: 700;
  font-size: 24px;
  line-height: 30px;
  color: #000034;
}
</style>

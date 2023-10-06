<template>
  <div class="tooltip-card" :class="position == 'up' ? 'position-up' : position == 'down' ? 'position-down' : 'position-right'">
    {{ firstRow }} <br>
    {{ secondRow }}
  </div>
</template>
<script>
export default {
  props: {
    firstRow: {
      type: String
    },
    secondRow: {
      type: String
    },
    position: {
      type: String
    },
  }
}
</script>
<style scoped>
.tooltip-card{
  border-radius: 20px;
  background: var(--primary-700, #175CD3);
  padding: 16px;
  position: absolute;
  color: var(--gray-3100, #D0D5DD);
  text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
  font-family: NunitoSans;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 110%; /* 19.8px */
  text-wrap: nowrap;
  text-align: left;
}
.position-up{
  transform: translate(-82px, -84px);
}
.position-down{
  transform: translate(-116px, 11px);
}
.position-right{
  transform: translate(46px, -42px);
}
</style>
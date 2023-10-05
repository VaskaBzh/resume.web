<template>
  <div class="working-card">
    <p class="working-title">{{ inf.title }}</p>
    <p class="working-text">{{ inf.text }}</p>
  </div>
</template>
<script>
export default {
  props: {
        inf: {
            type: Object,
            default: () => {}
        },
  }
}
</script>
<style scoped>
.working-card{
  width: 432px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 30px;
}
.working-title{
  color: var(--gray-3100, #D0D5DD);
  font-family: Unbounded;
  font-size: 16px;
  font-style: normal;
  font-weight: 600;
  line-height: 120%; /* 19.2px */
  text-transform: uppercase;
  border-radius: 20px;
  border: 0.5px solid var(--secondary-gray, #98A2B3);
  padding: 10px 20px;
  display: inline-flex;
}
.working-text{
  color: var(--gray-170, rgba(245, 250, 255, 0.70));
  font-family: NunitoSans;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 110%; /* 19.8px */
}
@media(max-width:450px){
  .working-title{
    font-size: 12px;
    padding: 8px 10px;
    }
  .working-text{
    font-size: 14px;
  }
  .working-card{
    width: 266px;
    gap: 20px;
  }
}
</style>
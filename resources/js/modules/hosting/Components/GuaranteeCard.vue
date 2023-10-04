<template>
  <div class="guarantee-block">
    <div class="guarantee-card">
      <p class="title-card">Гарантии надежности и безопасности</p>
      <p class="text-card">С вами будет работать персональный менеджер, который поможет решить любые вопросы, в том числе вопросы ваших клиентов мы ценим наших клиентов и стремимся обеспечить лучший опыт работы с allbtc pool</p>
  </div>
  <div class="income-system-card gray-line">
    <p class="text-card text-system">Самый современный метод вознаграждения с наибольшей выплатой, поскольку объединяет вознаграждение за блок и выплаты комиссий за транзакции в одно значение. Пул выплачивает вознаграждение независимо от нахождения блока.</p>
    <p class="title-hosting">система выплаты<br> FPPS+</p>
  </div>
  <p class="title-hosting gray-line">гарантия безопасности</p>
  <p class="title-hosting gray-line">автовыплаты</p>
  <p class="title-hosting gray-line">оперативная техподдержка</p>
  </div>
</template>
<script>
</script>
<style scoped>
.guarantee-block{
  display: flex;
  flex-direction: column;
  width: 100%;
  padding: 0 100px;
}
.title-card{
  color: var(--gray-1100, #F5FAFF);
  font-family: Unbounded;
  font-size: 36px;
  font-style: normal;
  font-weight: 600;
  line-height: 120%; /* 43.2px */
  text-transform: uppercase;
  margin-bottom: 20px;
}
.text-system{
  width: 380px;
}
.text-card{
  color: var(--gray-170, rgba(245, 250, 255, 0.70));
  font-family: NunitoSans;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 110%; /* 19.8px */
}
.title-hosting{
  color: var(--gray-1100, #F5FAFF);
  text-align: right;
  font-family: Unbounded;
  font-size: 55px;
  font-style: normal;
  font-weight: 600;
  line-height: 120%; /* 66px */
  text-transform: uppercase;
}
.guarantee-card{
  width: 464px;
  margin: 0 auto;
  margin-bottom: 100px;
}
.income-system-card{
  display: flex;
  justify-content: space-between;
}
.gray-line{
  padding: 32px;
  border-bottom: 0.5px solid var(--gray-240, rgba(228, 231, 236, 0.40));
  /* border-top: 0.5px solid var(--gray-240, rgba(228, 231, 236, 0.40)); */

}
</style>
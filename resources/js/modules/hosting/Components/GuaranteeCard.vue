<template>
  <div class="guarantee-block">
    <div class="guarantee-card">
      <p class="title-card">Гарантии надежности и безопасности</p>
      <p class="text-card">С вами будет работать персональный менеджер, который поможет решить любые вопросы, в том числе вопросы ваших клиентов мы ценим наших клиентов и стремимся обеспечить лучший опыт работы с allbtc pool</p>
  </div>
  <div class="income-system-card gray-line gray-line-top">
    <div class="card-row">
      <p class="text-card text-system text-web">Самый современный метод вознаграждения с наибольшей выплатой, поскольку объединяет вознаграждение за блок и выплаты комиссий за транзакции в одно значение. Пул выплачивает вознаграждение независимо от нахождения блока.</p>
      <p class="text-card text-system" v-if="isOpenAccordion">Самый современный метод вознаграждения с наибольшей выплатой, поскольку объединяет вознаграждение за блок и выплаты комиссий за транзакции в одно значение. Пул выплачивает вознаграждение независимо от нахождения блока.</p>
      <p class="title-hosting">система выплаты<br> FPPS+</p>
    </div>

    <button class="accordion-button" @click="isOpenAccordion = !isOpenAccordion">
      <svg xmlns="http://www.w3.org/2000/svg" width="29" height="30" viewBox="0 0 29 30" fill="none" v-if="!isOpenAccordion">
        <rect width="26.9622" height="1.07849" rx="0.539243" transform="matrix(0.00871668 -0.999962 0.999962 -0.00871668 14.3242 28.6074)" fill="#D0D5DD" fill-opacity="0.6"/>
        <rect width="26.9622" height="1.07849" rx="0.539243" transform="matrix(0.999962 -0.00871668 -0.00871668 0.999962 1.25781 14.457)" fill="#D0D5DD" fill-opacity="0.6"/>
      </svg>
      <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none" v-else>
        <rect width="26.9622" height="1.07849" rx="0.539243" transform="matrix(0.999962 -0.00871668 -0.00871668 0.999962 1.50391 14.0801)" fill="#D0D5DD" fill-opacity="0.6"/>
      </svg>
    </button>
  </div>
  <p class="title-hosting gray-line">гарантия безопасности</p>
  <p class="title-hosting gray-line">автовыплаты</p>
  <p class="title-hosting gray-line">оперативная техподдержка</p>
  </div>
</template>
<script>
export default {
  data() {
    return {
      isOpenAccordion: false
    }
  },
}
</script>
<style scoped>
.guarantee-block{
  display: flex;
  flex-direction: column;
  width: 100%;
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
  padding: 32px 100px;
  border-bottom: 0.5px solid var(--gray-240, rgba(228, 231, 236, 0.40));
}
.gray-line-top{
  border-top: 0.5px solid var(--gray-240, rgba(228, 231, 236, 0.40));
}
.accordion-button{
  display: none;
}
.card-row{
  display: flex;
  justify-content: space-between;
  width: 100%;
}

@media(max-width:950px){
  .title-card{
    font-size: 24px;
  }
  .guarantee-card{
    width: 354px;
    margin-bottom: 80px;
    margin-top: 100px;
  }
  .card-row{
    flex-direction: column-reverse;
    align-items: flex-start;
  }
  .title-hosting{
    text-align:inherit;
    width: 100%;
    font-size: 44px;
  }
  .accordion-button{
    display: inline-block;
    height: 30px;
    margin-top: 32px;
  }
  .guarantee-block{
    padding: 0;
  }
  .text-system{
    width: 590px;
  }
  .gray-line{
    padding: 30px 32px;
  }
  .text-web{
    display: none;
  }
}
@media(max-width:450px){
  .title-card{
    font-size: 18px;
  }
  .text-card{
    font-size: 14px;
  }
  .title-hosting{
    font-size: 22px;
  }
  .guarantee-card{
    width: 244px;
    margin-bottom: 70px;
  }
  .gray-line{
    padding: 20px 16px;
  }
  .text-system{
    width: 328px;
  }
  .card-row{
    gap: 10px;
  }
  .accordion-button{
    margin-top: 12px;
  }
}
</style>
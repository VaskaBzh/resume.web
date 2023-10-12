<template>
    <h2 class="head-line_title">
        <slot/>
    </h2>
</template>


<script>
export default {
    name: "HeadLine"
}
</script>

<style scoped lang="scss">
.head-line {
    padding: 14px 24px;
    width: 155px;
    text-align: center;
    display: block;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    border-radius: 30px;
    border: 0.5px solid #98A2B3;

    &_title {
        font-family: Unbounded, serif;
        font-size: 20px;
        font-style: normal;
        font-weight: 600;
        line-height: 120%;
        text-transform: uppercase;
        color: #D0D5DD;
    }
}

.calculator-land_title_default {
    width: 40%;
    height: 40px;
    margin: 0 auto 100px;
    backdrop-filter: unset;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #F5FAFF;
    font-family: Unbounded, serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 21.6px */
    text-transform: uppercase;
    border-radius: 40px;
    border: 1px solid rgba(192, 228, 255, 0.60);
    background: rgba(13, 13, 13, 0.80);
    @media(max-width:850px){
        font-size: 14px;
    }
    @media(max-width:450px){
        font-size: 12px;
        width: 70%;
    }
}

.miners-info-view_title {
    padding: 14px 24px;
    width: 340px;
    text-align: center;
    display: block;
    align-items: center;
    justify-content: center;
    margin: 0 auto 100px;
    border-radius: 30px;
    border: 0.5px solid #98A2B3;
    font-family: Unbounded, serif;
    font-size: 20px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%;
    text-transform: uppercase;
    color: #D0D5DD;
}

.about_title {
  padding: 14px 24px;
  width: 340px;
  text-align: center;
  display: block;
  align-items: center;
  justify-content: center;
  margin: 0 auto 50px;
  border-radius: 30px;
  border: 0.5px solid #98A2B3;
  font-family: Unbounded, serif;
  font-size: 20px;
  font-style: normal;
  font-weight: 600;
  line-height: 120%;
  text-transform: uppercase;
  color: #D0D5DD;
}

.make-up-cab_title {
    padding: 14px 24px;
    width: 293px;
    text-align: center;
    display: block;
    align-items: center;
    justify-content: center;
    margin: 0 auto 100px;
    border-radius: 30px;
    border: 0.5px solid #98A2B3;
    font-family: Unbounded, serif;
    font-size: 20px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%;
    text-transform: uppercase;
    color: #D0D5DD;
}

.security-view_btn {
    padding: 14px 24px;
    width: 293px;
    text-align: center;
    display: block;
    align-items: center;
    justify-content: center;
    margin: 0 auto 100px;
    border-radius: 30px;
    border: 0.5px solid #98A2B3;
    font-family: Unbounded, serif;
    font-size: 20px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%;
    text-transform: uppercase;
    color: #D0D5DD;
}

.history-pool__btn {
    padding: 14px 24px;
    width: 412px;
    text-align: center;
    display: block;
    align-items: center;
    justify-content: center;
    margin: 0 auto 411px;
    border-radius: 30px;
    border: 0.5px solid #98A2B3;
    font-family: Unbounded, serif;
    font-size: 20px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%;
    text-transform: uppercase;
    color: #D0D5DD;
}

.mobile-view__title {
    padding: 14px 24px;
    width: 412px;
    text-align: center;
    display: block;
    align-items: center;
    justify-content: center;
    margin: 0 auto 100px;
    border-radius: 30px;
    border: 0.5px solid #98A2B3;
    font-family: Unbounded, serif;
    font-size: 20px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%;
    text-transform: uppercase;
    color: #D0D5DD;
}

.payments-view_title {
    padding: 14px 24px;
    width: 293px;
    text-align: center;
    display: block;
    align-items: center;
    justify-content: center;
    margin: 0 auto 100px;
    border-radius: 30px;
    border: 0.5px solid #98A2B3;
    font-family: Unbounded, serif;
    font-size: 20px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%;
    text-transform: uppercase;
    color: #D0D5DD;
}


.mission-view_btn {
    padding: 14px 24px;
    width: 293px;
    text-align: center;
    display: block;
    align-items: center;
    justify-content: center;
    margin: 0 auto 100px;
    border-radius: 30px;
    border: 0.5px solid #98A2B3;
    font-family: Unbounded, serif;
    font-size: 20px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%;
    text-transform: uppercase;
    color: #D0D5DD;
}
</style>

<template>
  <div class="faq">
    <div class="faq__container">
      <div class="faq__main">
        <main-title tag="h1" class="faq__title">Help center</main-title>

        <div class="faq__search">
          <label class="faq__label">
            <input
              type="text"
              class="faq__search_input"
              placeholder="Search..." />
            <button class="faq__button" type="button">
              <img src="../assets/img/search-icon.svg" alt="" /></button
          ></label>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    document.title = "FAQ";
  },
};
</script>

<style lang="scss" scoped>
.faq {
  // .faq__title
  &__title {
    margin-bottom: 26px;
  }
  // .faq__label
  &__label {
    flex: 1 1 auto;
    position: relative;
  }
  // .faq__search
  &__search {
    background: rgba(255, 255, 255, 0.29);
    border-radius: 21px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 17px;
    &_input {
      background: #ffffff;
      border-radius: 21px;
      width: 100%;
      padding: 27px 44px;
      font-style: normal;
      font-weight: 300;
      font-size: 18px;
      line-height: 143.1%;
      color: #000000;
      &:active,
      &:focus {
        border: none;
        outline: none;
      }
    }
  }
  // .faq__button
  &__button {
    position: absolute;
    background: linear-gradient(84.14deg, #3f7bdd 8.75%, #4282ec 92.01%),
      #ffffff;
    border-radius: 13px;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 80px;
    height: 63px;
    top: 50%;
    right: 10px;
    transition: all 0.3s ease 0s;
    transform: translate(0, -50%);
  }
}
</style>

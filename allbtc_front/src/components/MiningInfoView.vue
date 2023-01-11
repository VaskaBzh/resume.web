<template>
  <div class="mining-info">
    <div class="mining-info__container">
      <div class="mining-info__main mining-im">
        <div class="mining-im__con">
          <div class="mining-im__general" v-scroll="'left delay--lg'">
            <div class="mining-im__general_content">
              <div class="mining-im__general_title">
                Начните майнинг c allbtc pool
              </div>
              <a href="#" class="mining-im__general_link">
                Начать майнинг
                <svg
                  width="14"
                  height="14"
                  viewBox="0 0 14 14"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M4.83882 3.08785C5.06663 2.86004 5.43598 2.86004 5.66378 3.08785L9.16378 6.58785C9.39159 6.81565 9.39159 7.185 9.16378 7.4128L5.66378 10.9128C5.43598 11.1406 5.06663 11.1406 4.83882 10.9128C4.61102 10.685 4.61102 10.3157 4.83882 10.0878L7.92634 7.00033L4.83882 3.9128C4.61102 3.685 4.61102 3.31565 4.83882 3.08785Z"
                    fill="white"
                  />
                </svg>
              </a>
            </div>
            <div class="mining-im__general_image_con">
              <img
                src="../assets/img/more-coins.png"
                alt=""
                class="mining-im__general_image"
              />
            </div>
          </div>

          <ul class="mining-im__list">
            <li class="mining-im__item" v-scroll="'left delay--md'">
              <div class="mining-im__item_top">
                <img
                  src="../assets/img/static-propeller.svg"
                  alt=""
                  class="mining-im__item_icon"
                />
                <div class="mining-im__item_title">Высокая надежность</div>
              </div>
              <div class="mining-im__item_text">
                Сервера находятся в одном из крупнейших датацентров в Европе.
              </div>
            </li>
            <li class="mining-im__item" v-scroll="'left'">
              <div class="mining-im__item_top">
                <img
                  src="../assets/img/static-propeller.svg"
                  alt=""
                  class="mining-im__item_icon"
                />
                <div class="mining-im__item_title">
                  Частые и настраиваемые выплаты
                </div>
              </div>
              <div class="mining-im__item_text">
                Контролируйте каждую деталь ваших финансовых потоков с помощью
                нашей настраиваемой системы выплат
              </div>
            </li>
            <li class="mining-im__item" v-scroll="'left delay'">
              <div class="mining-im__item_top">
                <img
                  src="../assets/img/static-propeller.svg"
                  alt=""
                  class="mining-im__item_icon"
                />
                <div class="mining-im__item_title">
                  Управление воркерами и мониторинг
                </div>
              </div>
              <div class="mining-im__item_text">
                Сервера находятся в одном из крупнейших датацентров в Европе.
              </div>
            </li>
            <li class="mining-im__item" v-scroll="'left delay--md'">
              <div class="mining-im__item_top">
                <img
                  src="../assets/img/static-propeller.svg"
                  alt=""
                  class="mining-im__item_icon"
                />
                <div class="mining-im__item_title">
                  Постоянный мониторинг прибыли
                </div>
              </div>
              <div class="mining-im__item_text">
                Мы постоянно мониторим прибыль наших пользователей и сраниваем
                ее с прибылью на других пулах, чтобы обеспечить
                конкурентоспособность.
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.mining-info {
  // .mining-info__container
  &__container {
  }
  // .mining-info__main
  &__main {
  }
}
.mining-im {
  background: rgba(255, 255, 255, 0.29);
  border-radius: 21px;
  padding: 17px;
  @media (max-width: 767.98px) {
    margin: 0 -15px;
    background-color: transparent;
  }
  // .mining-im__con
  &__con {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 17px;
    @media (max-width: 1270px) {
      grid-template-columns: 1fr;
    }
  }
  // .mining-im__general
  &__general {
    background: #3f65b3;
    border-radius: 21px;
    display: flex;
    flex-direction: column;
    @media (max-width: 1270px) {
      flex-direction: row;
      align-items: center;
    }
    @media (max-width: 767.98px) {
      border-radius: 10px;
      position: relative;
      &::before {
        content: "";
        position: absolute;
        width: 105%;
        height: 122%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(255, 255, 255, 0.29);
        border-radius: 10px;
        z-index: -1;
      }
    }
    @media (max-width: 550px) {
      flex-direction: column;
    }
    // .mining-im__general_content
    &_content {
      padding: 35px 48px 0;
      flex: 1 1 auto;
      @media (max-width: 1270px) {
        padding: 33px 30px;
      }
    }
    // .mining-im__general_title
    &_title {
      font-family: "AmpleSoftPro";
      font-style: normal;
      font-weight: 500;
      font-size: 31px;
      line-height: 100%;
      color: #ffffff;
      margin-bottom: 16px;
    }
    // .mining-im__general_link
    &_link {
      font-style: normal;
      font-weight: 500;
      font-size: 15px;
      line-height: 107.6%;
      color: #fff;
      display: flex;
      align-items: center;
      gap: 10px;
      & svg {
        position: relative;
        transition: all 0.3s ease 0s;
        & path {
          stroke: #fff;
        }
      }
      @media (any-hover: hover) {
        &:hover {
          & svg {
            transform: translate(4px, 0);
          }
          text-decoration: underline;
        }
      }
    }
    // .mining-im__general_image
    &_image {
      max-width: 400px;
      @media (max-width: 1270px) {
        max-width: 300px;
      }
      @media (max-width: 767.98px) {
        max-width: 235px;
      }
      @media (max-width: 550px) {
        max-width: 280px;
        margin-top: -22px;
      }

      // .mining-im__general_image_con
      &_con {
        display: flex;
        justify-content: center;
      }
    }
  }
  // .mining-im__list
  &__list {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 17px;
    @media (max-width: 767.98px) {
      display: flex;
      flex-direction: column;
    }
  }
  // .mining-im__item
  &__item {
    background: #ffffff;
    border-radius: 21px;
    padding: 34px 45px;
    @media (max-width: 767.98px) {
      padding: 26px 30px;
      border-radius: 10px;
    }

    // .mining-im__item_top
    &_top {
      display: flex;
      align-items: start;
      gap: 15px;
      margin-bottom: 12px;
      @media (max-width: 1270px) {
        align-items: center;
      }
    }
    // .mining-im__item_icon
    &_icon {
    }
    // .mining-im__item_title
    &_title {
      font-family: "AmpleSoftPro";
      font-style: normal;
      font-weight: 500;
      font-size: 22px;
      line-height: 107.6%;
      color: #000034;
    }
    // .mining-im__item_text
    &_text {
      font-style: normal;
      font-weight: 300;
      font-size: 16px;
      line-height: 148.1%;
      color: rgba(0, 0, 0, 0.62);
    }
  }
}
</style>

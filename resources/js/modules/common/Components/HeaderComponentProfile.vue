<template>
  <nav
      class="header-content onboarding_block"
      :class="{
            'onboarding_block-target':
                instructionConfig.isVisible && instructionConfig.step === 2,
        }"
  >
    <instruction-step
        @next="endCommonInstruction"
        @prev="instructionConfig.prevStep()"
        @close="endCommonInstruction"
        :step_active="2"
        :steps_count="instructionConfig.steps_count"
        :step="instructionConfig.step"
        :isVisible="instructionConfig.isVisible"
        text="texts.common[1]"
        title="titles.common[1]"
        className="onboarding__card-top"
    />
    <router-link :to="{ name: 'home' }" class="svg-mobile">
      <svg
          xmlns="http://www.w3.org/2000/svg"
          width="40"
          height="32"
          viewBox="0 0 40 32"
          fill="none"
      >
        <path
            d="M28.8143 18.963C23.6098 18.963 19.0956 20.0535 16.318 21.598C16.2412 21.6411 16.0719 21.7232 16 21.7709C16.8299 21.3789 17.8194 21.0815 18.7454 20.9668H18.7504C19.0909 20.9237 19.4362 20.9046 19.7817 20.9046C19.9446 20.9046 20.1029 20.9094 20.2613 20.9189C22.0362 21.0194 23.7247 21.6649 25.1016 22.7409C25.111 22.7457 25.1207 22.7505 25.1303 22.7601C25.1447 22.7697 25.1495 22.7793 25.1592 22.7887C25.8307 23.3196 26.4255 23.9603 26.9197 24.6873L27.0587 24.8928L27.073 24.9168H27.078L30.3495 29.7517C31.9324 32.0901 35.1082 32.7023 37.4491 31.1242C38.9173 30.139 39.7037 28.5321 39.7037 26.8967C39.7037 25.9164 39.421 24.9216 38.8259 24.0465C36.6768 20.8664 33.0791 18.963 29.2367 18.963H28.8143Z"
            fill="url(#paint0_linear_881_27955)"
        />
        <path
            d="M15.6499 2.24664L4.32603 18.945L3.00786 20.8893L2.45946 21.6987L0.877116 24.0356C0.626812 24.4042 0.43426 24.7969 0.289958 25.1992C-0.0179454 26.0611 -0.0753944 26.9758 0.0927313 27.8473C0.294784 28.9154 0.838516 29.9161 1.69 30.6824C1.86808 30.8405 2.05535 30.9888 2.25741 31.123C4.60513 32.7033 7.79425 32.0902 9.38171 29.7486C9.38171 29.7486 12.0036 25.4386 13.1627 24.1791C13.2301 24.1025 13.3023 24.0259 13.3792 23.9492C14.091 23.1017 14.962 22.4074 15.9287 21.8949C16.03 21.8422 16.429 21.6268 16.506 21.5837C19.2913 20.037 23.8181 18.945 29.037 18.945H16.7081L19.9794 14.1227L24.1594 7.95951C24.7511 7.08335 25.0349 6.09205 25.0349 5.10555C25.0349 3.46309 24.246 1.85396 22.7742 0.86746C21.9177 0.292854 20.946 0.0103588 19.9794 0.000751495C19.9498 0.000152588 19.9207 0 19.8912 0C18.252 0 16.6374 0.788359 15.6499 2.24664Z"
            fill="url(#paint1_linear_881_27955)"
        />
        <defs>
          <linearGradient
              id="paint0_linear_881_27955"
              x1="21.9259"
              y1="25.4815"
              x2="37.4556"
              y2="13.7367"
              gradientUnits="userSpaceOnUse"
          >
            <stop offset="0.158705" stop-color="#1B3867"/>
            <stop offset="0.566881" stop-color="#1C70DC"/>
            <stop offset="0.977621" stop-color="#3565B5"/>
          </linearGradient>
          <linearGradient
              id="paint1_linear_881_27955"
              x1="-2.66667"
              y1="35.8518"
              x2="36.7523"
              y2="13.7755"
              gradientUnits="userSpaceOnUse"
          >
            <stop offset="0.158705" stop-color="#024BC0"/>
            <stop offset="0.977621" stop-color="#3597F9"/>
          </linearGradient>
        </defs>
      </svg>
    </router-link>
    <div>
      <current-exchange-rate/>
    </div>
    <div
        @click="$emit('changeBurger', !isOpenBurger)"
        class="burger-svg-mobile"
    >
      <svg
          xmlns="http://www.w3.org/2000/svg"
          width="25"
          height="24"
          viewBox="0 0 25 24"
          fill="none"
      >
        <path
            d="M4.70312 5L20.7031 5M4.70312 12L20.7031 12M4.70312 19L20.7031 19"
            stroke="#2E90FA"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
        />
      </svg>
    </div>
    <div class="header-select-container">
      <select-theme
          v-if="viewportWidth >= 900"
          :viewportWidth="viewportWidth"
      ></select-theme>
      <select-language
          v-if="viewportWidth >= 900"
          :viewportWidth="viewportWidth"
      ></select-language>
    </div>
  </nav>
</template>

<script>
import SelectLanguage from "@/Components/technical/language/SelectLanguage.vue";
import SelectTheme from "@/Components/technical/theme/SelectTheme.vue";
import CurrentExchangeRate from "@/Components/technical/blocks/CurrentExchangeRate.vue";
import InstructionStep from "@/modules/instruction/Components/InstructionStep.vue";
import "swiper/css";
import "swiper/css/pagination";
import {defineComponent, ref} from "vue";
import {mapGetters} from "vuex";

export default defineComponent({
  components: {
    SelectLanguage,
    SelectTheme,
    CurrentExchangeRate,
    InstructionStep,
  },
  data() {
    return {
      is_open: false,
      viewportWidth: 0,
    };
  },
  props: {
    is_auth: {
      type: Boolean,
      default: false,
    },
    user: {
      type: Object,
    },
    errors: {
      type: Object,
    },
    isOpenBurger: {
      type: Boolean,
    },
    instructionConfig: Object,
  },
  created() {
    window.addEventListener("resize", this.handleResize);
    this.handleResize();
  },
  setup() {
    let message = ref("");
    let noInfo = ref(false);
    let closed = ref(false);

    return {
      runCallbacksOnInit: {},
      message,
      noInfo,
      closed,
    };
  },
  computed: {
    ...mapGetters(["getIncome", "allAccounts", "getActive", "isDark"]),
    accountLink() {
      let url = this.$route.fullPath.startsWith("http")
          ? new URL(this.$route.fullPath).pathname
          : this.$route.fullPath;
      return url.startsWith("/profile");
    },
  },
  methods: {
    endCommonInstruction() {
      this.instructionConfig.nextStep(6);

      this.$router.push({
        name: "statistic",
      });
    },
    handleResize() {
      this.viewportWidth = window.innerWidth;
    },
    burgerAction() {
      if (this.viewportWidth < 991.98) {
        this.is_open = !this.is_open;
        this.is_open
            ? (document.querySelector("body").style.overflowY =
                "hidden")
            : (document.querySelector("body").style.overflowY = "auto");
      }
    },
    burgerClose() {
      if (this.viewportWidth < 991.98) {
        this.is_open = false;
        document.querySelector("body").style.overflowY = "auto";
      }
    },
  },
});
</script>

<!-- <style lang="scss" scoped>
.nav {
    &__container {
        display: flex;
        align-items: center;
        gap: 5px;
        height: 100%;
    }

    &__buttons {
        display: flex;
        gap: 12px;
        align-items: center;
        margin-left: auto;

        &_mobile {
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            margin-left: auto;
            @media (max-width: 991.98px) {
                z-index: 100;
            }
        }
    }

    &__button {
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%;
        color: #3f7bdd;
        border-radius: 8px;
        border: 1px solid #3f7bdd;
        background: transparent;
        min-height: 40px;
        padding: 0 24px;
        display: inline-flex;
        align-items: center;
        white-space: nowrap;
        transition: all 0.3s ease 0s;
        cursor: pointer;
        margin-left: 40px;
        @media (any-hover: hover) {
            &:hover {
                border: 1px solid #c6d8f5;
                background: #c6d8f5;
            }
        }

        &_mobile {
            background: rgba(194, 213, 242, 0.61);
            border-radius: 14px;
            min-width: 65px;
            width: 60px;
            height: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
            white-space: nowrap;
            transition: all 0.3s ease 0s;

            &:hover {
                background: rgba(194, 213, 242);
            }
        }

        &_link {
            padding: 0 20px;
            width: 100%;
            height: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
    }

    &__burger {
        background: transparent;
        gap: 4px;
        width: 48px;
        height: 48px;
        transition: all 0.3s ease 0s;
        margin-left: 40px;

        &:active {
            box-shadow: inset 0 4px 4px rgba(0, 0, 0, 0.25);
        }

        &_con {
            margin: 0 auto;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 4px;
            width: 18px;
            overflow: hidden;
        }

        & span {
            display: block;
            width: 18px;
            height: 2px;
            flex: 0 0 2px;
            background-color: #4182ec;
            border-radius: 5px;
            position: relative;
            right: 0;
            transition: all 0.3s ease 0.3s;

            &:nth-child(2) {
                transition: all 0.3s ease 0s;

                &::before {
                    transition: all 0.3s ease 0s;
                    content: "";
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    background-color: #4182ec;
                }
            }
        }

        &.active {
            & span {
                &:nth-child(1) {
                    transition: all 0.3s ease 0s;
                    right: 100%;
                }

                &:nth-child(2) {
                    transition: all 0.3s ease 0.3s;
                    transform: rotate(45deg);

                    &::before {
                        transition: all 0.3s ease 0.3s;
                        transform: rotate(-90deg);
                    }
                }

                &:nth-child(3) {
                    transition: all 0.3s ease 0s;
                    right: -100%;
                }
            }
        }
    }
}
</style> -->
<style scoped>
.onboarding_block-target {
  background: var(--background-island);
}

.header-content {
  padding: 0 24px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  z-index: 100;
}

.header-select-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 16px;
}

.svg-mobile,
.burger-svg-mobile {
  display: none;
}

@media (max-width: 900px) {
  .svg-mobile {
    display: inline-block;
  }

  .header-select-container {
    display: none;
  }

  .burger-svg-mobile {
    display: inline-block;
  }
}
</style>

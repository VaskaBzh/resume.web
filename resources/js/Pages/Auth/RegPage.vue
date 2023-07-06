<template>
  <form
    @submit.prevent="account_create"
    class="form form-auth"
  >
    <main-title tag="h3">{{ this.$t("auth.reg.title") }}</main-title>
    <div
      class="form_wrapper-message"
      v-if="Object.values(errors).length > 0"
    >
      <div
        class="form_message form_message-error"
        :key="i"
        v-for="(error, i) in Object.values(errors)"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="25"
          height="24"
          viewBox="0 0 25 24"
          fill="none"
        >
          <path d="M12.5 16C12.3022 16 12.1088 16.0587 11.9444 16.1686C11.7799 16.2784 11.6518 16.4346 11.5761 16.6173C11.5004 16.8001 11.4806 17.0011 11.5192 17.1951C11.5578 17.3891 11.653 17.5673 11.7929 17.7071C11.9327 17.847 12.1109 17.9422 12.3049 17.9808C12.4989 18.0194 12.6999 17.9996 12.8827 17.9239C13.0654 17.8482 13.2216 17.72 13.3314 17.5556C13.4413 17.3911 13.5 17.1978 13.5 17C13.5 16.7348 13.3946 16.4805 13.2071 16.2929C13.0195 16.1054 12.7652 16 12.5 16ZM23.17 17.47L15.12 3.47003C14.8598 3.00354 14.4798 2.61498 14.0192 2.3445C13.5586 2.07401 13.0341 1.9314 12.5 1.9314C11.9658 1.9314 11.4414 2.07401 10.9808 2.3445C10.5202 2.61498 10.1402 3.00354 9.87997 3.47003L1.87997 17.47C1.61076 17.924 1.46611 18.441 1.46061 18.9688C1.45511 19.4966 1.58897 20.0166 1.84865 20.4761C2.10834 20.9356 2.48467 21.3185 2.93965 21.5861C3.39463 21.8536 3.91215 21.9964 4.43997 22H20.56C21.092 22.0053 21.6159 21.8689 22.0779 21.6049C22.5399 21.341 22.9233 20.9589 23.1889 20.4978C23.4546 20.0368 23.5928 19.5134 23.5895 18.9814C23.5861 18.4493 23.4414 17.9277 23.17 17.47ZM21.44 19.47C21.3523 19.626 21.2244 19.7556 21.0697 19.8453C20.9149 19.935 20.7389 19.9815 20.56 19.98H4.43997C4.26108 19.9815 4.08507 19.935 3.93029 19.8453C3.7755 19.7556 3.64762 19.626 3.55997 19.47C3.4722 19.318 3.42599 19.1456 3.42599 18.97C3.42599 18.7945 3.4722 18.622 3.55997 18.47L11.56 4.47003C11.6439 4.30623 11.7714 4.16876 11.9284 4.07277C12.0854 3.97678 12.2659 3.92599 12.45 3.92599C12.634 3.92599 12.8145 3.97678 12.9715 4.07277C13.1286 4.16876 13.2561 4.30623 13.34 4.47003L21.39 18.47C21.4892 18.6199 21.5462 18.7937 21.555 18.9732C21.5638 19.1527 21.5241 19.3312 21.44 19.49V19.47ZM12.5 8.00003C12.2348 8.00003 11.9804 8.10538 11.7929 8.29292C11.6053 8.48046 11.5 8.73481 11.5 9.00003V13C11.5 13.2652 11.6053 13.5196 11.7929 13.7071C11.9804 13.8947 12.2348 14 12.5 14C12.7652 14 13.0195 13.8947 13.2071 13.7071C13.3946 13.5196 13.5 13.2652 13.5 13V9.00003C13.5 8.73481 13.3946 8.48046 13.2071 8.29292C13.0195 8.10538 12.7652 8.00003 12.5 8.00003Z" />
        </svg>
        {{ error }}
      </div>
    </div>
    <div class="form__content">
      <div
        class="form_row"
        :class="{ error: errs.email }"
      >
        <input
          name="email"
          v-model="form.email"
          type="text"
          class="input"
          :placeholder="this.$t('auth.reg.placeholders[0]')"
        />
      </div>
      <div
        class="form_row"
        :class="{ error: errs.name }"
      >
        <input
          name="name"
          v-model="form.name"
          type="text"
          class="input"
          :placeholder="this.$t('auth.reg.placeholders[1]')"
        />
      </div>
      <div
        class="form_row"
        :class="{ error: errs.password }"
      >
        <main-password
          name="password"
          :placeholder="this.$t('auth.reg.placeholders[2]')"
          :model="form.password"
          :errors="errors"
          @change="passwordProcess($event)"
        ></main-password>
      </div>
      <transition name="validate">
        <ul
          class="form_row validate"
          v-if="Object.entries(validate).length > 0"
        >
          <li
            class="validate_val"
            :class="
                            !validate.length
                                ? 'validate_val-complete'
                                : 'validate_val-reject'
                        "
          >
            {{ this.$t("auth.reg.validate[0]") }}
          </li>
          <ul class="validate__list">
            <span
              class="validate_val"
              :class="
                                !(
                                    validate.lower ||
                                    validate.upper ||
                                    validate.symbol ||
                                    validate.number
                                )
                                    ? 'validate_val-complete'
                                    : 'validate_val-reject'
                            "
            >
              {{ this.$t("auth.reg.validate[1]") }}
            </span>
            <li
              class="validate_val"
              :class="
                                !validate.lower ? 'validate_val-complete' : ''
                            "
            >
              {{ this.$t("auth.reg.validate[2]") }}
            </li>
            <li
              class="validate_val"
              :class="
                                !validate.upper ? 'validate_val-complete' : ''
                            "
            >
              {{ this.$t("auth.reg.validate[3]") }}
            </li>
            <li
              class="validate_val"
              :class="
                                !validate.symbol ? 'validate_val-complete' : ''
                            "
            >
              {{ this.$t("auth.reg.validate[4]") }}
            </li>
            <li
              class="validate_val"
              :class="
                                !validate.number ? 'validate_val-complete' : ''
                            "
            >
              {{ this.$t("auth.reg.validate[5]") }}
            </li>
          </ul>
        </ul>
      </transition>
      <div
        class="form_row"
        :class="{ error: errs.password }"
      >
        <main-password
          name="password_confirmation"
          :placeholder="this.$t('auth.reg.placeholders[3]')"
          :model="form.password_confirmation"
          @change="form.password_confirmation = $event"
        ></main-password>
      </div>
    </div>
    <input
      type="checkbox"
      id="checkbox"
      v-model="form.checkbox"
    />
    <label
      for="checkbox"
      :class="{ error: checkbox }"
    >
      <div class="fake">
        <svg
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M9.50538 18L4 12.2809L5.05684 11.183L9.50538 15.8043L18.9432 6L20 7.09787L9.50538 18Z"
            fill="#7C7C7C"
          />
          <rect
            x="0.5"
            y="0.5"
            width="23"
            height="23"
            rx="3.5"
            stroke="#7C7C7C"
          />
        </svg>
      </div>
      <span>{{ this.$t("auth.reg.checkbox[0]") }}
        <a
          :href="pdf"
          class="form_link"
        >
          {{ this.$t("auth.reg.checkbox[1]") }}
        </a>
      </span>
    </label>
    <blue-button
      class="auth"
      type="submit"
    ><a class="all-link">{{
                this.$t("auth.reg.button")
            }}</a></blue-button>
    <p class="text text-light">
      {{ this.$t("auth.reg.link[0]") }}
      <Link
        :href="route('login')"
        class="form_link"
      >{{
                this.$t("auth.reg.link[1]")
            }}</Link>
    </p>
  </form>
</template>

<script>
import pdf from "@/../assets/files/policy.pdf";
import authLayoutView from "@/Shared/AuthLayoutView.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import { Link, useForm } from "@inertiajs/vue3";
import MainPassword from "@/Components/UI/MainPassword.vue";
import { ref } from "vue";

export default {
  layout: authLayoutView,
  name: "reg-page",
  props: ["errors"],
  components: {
    MainTitle,
    BlueButton,
    Link,
    MainPassword,
  },
  data() {
    return {
      pdf,
      errs: {},
    };
  },
  setup() {
    let checkbox = ref(false);
    let validate = ref({});
    let form = useForm({
      email: "",
      name: "",
      password: "",
      ["password_confirmation"]: "",
      checkbox: false,
    });
    const account_create = () => {
      checkbox.value = false;
      if (form.checkbox) {
        if (Object.entries(validate.value).length === 0) {
          form.post("/register", {});
        }
      } else {
        checkbox.value = true;
      }
    };
    const passwordProcess = (event) => {
      form.password = event;
      validate.value = {};

      if (form.password?.length <= 10 || form.password?.length >= 50)
        validate.value.length = true;

      if (!/[a-z]/.test(form.password)) validate.value.lower = true;

      if (!/[A-Z]/.test(form.password)) validate.value.upper = true;

      if (!/[0-9]/.test(form.password)) validate.value.number = true;

      if (!/[!@#\$%\^&\*]/.test(form.password)) validate.value.symbol = true;

      if (form.password.length === 0) validate.value = {};
    };

    return {
      form,
      account_create,
      checkbox,
      passwordProcess,
      validate,
    };
  },
  watch: {
    errors(newVal) {
      this.errs = newVal;
      setTimeout(() => {
        this.errs = {};
      }, 1500);
    },
  },
  mounted() {
    document.title = "Регистрация";
  },
};
</script>

<style scoped lang="scss">
.validate-enter-active,
.validate-leave-active {
  transition: all 0.5s ease;
  max-height: 230px;
}
.validate-enter-from,
.validate-leave-to {
  max-height: 0;
  visibility: hidden;
  opacity: 0;
  padding: 0 16px !important;
}
.validate-leave-to {
  margin: -8px 0;
}
.validate {
  width: 100%;
  padding: 16px;
  min-height: 0;
  border-radius: 12px;
  overflow: hidden;
  background: #fafafa;
  box-shadow: 0px 4px 10px 0px rgba(85, 85, 85, 0.1);
  &.validate,
  &__list {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }
  &_val {
    color: rgba(124, 124, 124, 0.7);
    font-size: 18px;
    font-weight: 400;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    line-height: 135%;
    transition: all 0.5s ease 0s;
    @media (max-width: 479.98px) {
      font-size: 14px;
      font-style: normal;
      font-weight: 400;
    }
    &:before {
      content: "";
      background-image: linear-gradient(
        179deg,
        #e6eaf0 0%,
        #e6eaf1 20.89%,
        #e7ebf1 42.88%,
        #eaeef4 76.04%,
        #e8ecf2 100%
      );
      background-repeat: no-repeat;
      background-size: cover;
      width: 24px;
      height: 24px;
      border-radius: 50%;
      transition: all 0.5s ease 0s;
      @media (max-width: 479.98px) {
        width: 16px;
        height: 16px;
      }
    }
    &-complete {
      color: #0fb468;
      &:before {
        background-color: transparent !important;
        background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10.525 16.55L17.6 9.475L16.45 8.35L10.525 14.275L7.525 11.275L6.4 12.4L10.525 16.55ZM12 22C10.6333 22 9.34167 21.7375 8.125 21.2125C6.90833 20.6875 5.84583 19.9708 4.9375 19.0625C4.02917 18.1542 3.3125 17.0917 2.7875 15.875C2.2625 14.6583 2 13.3667 2 12C2 10.6167 2.2625 9.31667 2.7875 8.1C3.3125 6.88333 4.02917 5.825 4.9375 4.925C5.84583 4.025 6.90833 3.3125 8.125 2.7875C9.34167 2.2625 10.6333 2 12 2C13.3833 2 14.6833 2.2625 15.9 2.7875C17.1167 3.3125 18.175 4.025 19.075 4.925C19.975 5.825 20.6875 6.88333 21.2125 8.1C21.7375 9.31667 22 10.6167 22 12C22 13.3667 21.7375 14.6583 21.2125 15.875C20.6875 17.0917 19.975 18.1542 19.075 19.0625C18.175 19.9708 17.1167 20.6875 15.9 21.2125C14.6833 21.7375 13.3833 22 12 22ZM12 20.5C14.3667 20.5 16.375 19.6708 18.025 18.0125C19.675 16.3542 20.5 14.35 20.5 12C20.5 9.63333 19.675 7.625 18.025 5.975C16.375 4.325 14.3667 3.5 12 3.5C9.65 3.5 7.64583 4.325 5.9875 5.975C4.32917 7.625 3.5 9.63333 3.5 12C3.5 14.35 4.32917 16.3542 5.9875 18.0125C7.64583 19.6708 9.65 20.5 12 20.5Z' fill='%230FB468'/%3E%3C/svg%3E%0A") !important;

        @media (max-width: 479.98px) {
          background-image: url("data:image/svg+xml,%3Csvg width='16' height='16' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7.01634 11.0335L11.733 6.31683L10.9663 5.56683L7.01634 9.51683L5.01634 7.51683L4.26634 8.26683L7.01634 11.0335ZM7.99967 14.6668C7.08856 14.6668 6.22745 14.4918 5.41634 14.1418C4.60523 13.7918 3.8969 13.3141 3.29134 12.7085C2.68579 12.1029 2.20801 11.3946 1.85801 10.5835C1.50801 9.77238 1.33301 8.91127 1.33301 8.00016C1.33301 7.07794 1.50801 6.21127 1.85801 5.40016C2.20801 4.58905 2.68579 3.8835 3.29134 3.2835C3.8969 2.6835 4.60523 2.2085 5.41634 1.8585C6.22745 1.5085 7.08856 1.3335 7.99967 1.3335C8.9219 1.3335 9.78856 1.5085 10.5997 1.8585C11.4108 2.2085 12.1163 2.6835 12.7163 3.2835C13.3163 3.8835 13.7913 4.58905 14.1413 5.40016C14.4913 6.21127 14.6663 7.07794 14.6663 8.00016C14.6663 8.91127 14.4913 9.77238 14.1413 10.5835C13.7913 11.3946 13.3163 12.1029 12.7163 12.7085C12.1163 13.3141 11.4108 13.7918 10.5997 14.1418C9.78856 14.4918 8.9219 14.6668 7.99967 14.6668ZM7.99967 13.6668C9.57745 13.6668 10.9163 13.1141 12.0163 12.0085C13.1163 10.9029 13.6663 9.56683 13.6663 8.00016C13.6663 6.42238 13.1163 5.0835 12.0163 3.9835C10.9163 2.8835 9.57745 2.3335 7.99967 2.3335C6.43301 2.3335 5.0969 2.8835 3.99134 3.9835C2.88579 5.0835 2.33301 6.42238 2.33301 8.00016C2.33301 9.56683 2.88579 10.9029 3.99134 12.0085C5.0969 13.1141 6.43301 13.6668 7.99967 13.6668Z' fill='%2313D60E'/%3E%3C/svg%3E%0A") !important;
        }
      }
    }
    &-reject {
      color: #e5403f;
      &:before {
        background-color: transparent !important;
        background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M8.25 16.8L12 13.05L15.75 16.8L16.8 15.75L13.05 12L16.8 8.25L15.75 7.2L12 10.95L8.25 7.2L7.2 8.25L10.95 12L7.2 15.75L8.25 16.8ZM12 22C10.6333 22 9.34167 21.7375 8.125 21.2125C6.90833 20.6875 5.84583 19.9708 4.9375 19.0625C4.02917 18.1542 3.3125 17.0917 2.7875 15.875C2.2625 14.6583 2 13.3667 2 12C2 10.6167 2.2625 9.31667 2.7875 8.1C3.3125 6.88333 4.02917 5.825 4.9375 4.925C5.84583 4.025 6.90833 3.3125 8.125 2.7875C9.34167 2.2625 10.6333 2 12 2C13.3833 2 14.6833 2.2625 15.9 2.7875C17.1167 3.3125 18.175 4.025 19.075 4.925C19.975 5.825 20.6875 6.88333 21.2125 8.1C21.7375 9.31667 22 10.6167 22 12C22 13.3667 21.7375 14.6583 21.2125 15.875C20.6875 17.0917 19.975 18.1542 19.075 19.0625C18.175 19.9708 17.1167 20.6875 15.9 21.2125C14.6833 21.7375 13.3833 22 12 22ZM12 20.5C14.3667 20.5 16.375 19.6708 18.025 18.0125C19.675 16.3542 20.5 14.35 20.5 12C20.5 9.63333 19.675 7.625 18.025 5.975C16.375 4.325 14.3667 3.5 12 3.5C9.65 3.5 7.64583 4.325 5.9875 5.975C4.32917 7.625 3.5 9.63333 3.5 12C3.5 14.35 4.32917 16.3542 5.9875 18.0125C7.64583 19.6708 9.65 20.5 12 20.5Z' fill='%23E5403F'/%3E%3C/svg%3E%0A") !important;
        @media (max-width: 479.98px) {
          background-image: url("data:image/svg+xml,%3Csvg width='16' height='16' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.49967 11.2002L7.99967 8.70016L10.4997 11.2002L11.1997 10.5002L8.69967 8.00016L11.1997 5.50016L10.4997 4.80016L7.99967 7.30016L5.49967 4.80016L4.79967 5.50016L7.29967 8.00016L4.79967 10.5002L5.49967 11.2002ZM7.99967 14.6668C7.08856 14.6668 6.22745 14.4918 5.41634 14.1418C4.60523 13.7918 3.8969 13.3141 3.29134 12.7085C2.68579 12.1029 2.20801 11.3946 1.85801 10.5835C1.50801 9.77238 1.33301 8.91127 1.33301 8.00016C1.33301 7.07794 1.50801 6.21127 1.85801 5.40016C2.20801 4.58905 2.68579 3.8835 3.29134 3.2835C3.8969 2.6835 4.60523 2.2085 5.41634 1.8585C6.22745 1.5085 7.08856 1.3335 7.99967 1.3335C8.9219 1.3335 9.78856 1.5085 10.5997 1.8585C11.4108 2.2085 12.1163 2.6835 12.7163 3.2835C13.3163 3.8835 13.7913 4.58905 14.1413 5.40016C14.4913 6.21127 14.6663 7.07794 14.6663 8.00016C14.6663 8.91127 14.4913 9.77238 14.1413 10.5835C13.7913 11.3946 13.3163 12.1029 12.7163 12.7085C12.1163 13.3141 11.4108 13.7918 10.5997 14.1418C9.78856 14.4918 8.9219 14.6668 7.99967 14.6668ZM7.99967 13.6668C9.57745 13.6668 10.9163 13.1141 12.0163 12.0085C13.1163 10.9029 13.6663 9.56683 13.6663 8.00016C13.6663 6.42238 13.1163 5.0835 12.0163 3.9835C10.9163 2.8835 9.57745 2.3335 7.99967 2.3335C6.43301 2.3335 5.0969 2.8835 3.99134 3.9835C2.88579 5.0835 2.33301 6.42238 2.33301 8.00016C2.33301 9.56683 2.88579 10.9029 3.99134 12.0085C5.0969 13.1141 6.43301 13.6668 7.99967 13.6668Z' fill='%23E5403F'/%3E%3C/svg%3E%0A") !important;
        }
      }
    }
  }
  .validate__list {
    li {
      padding-left: 27px;
    }
  }
}
</style>

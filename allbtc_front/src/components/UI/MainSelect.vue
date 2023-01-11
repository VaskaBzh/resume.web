<template>
  <div
    v-if="selectType == 'mini'"
    class="select_con select_con-mini"
    :class="{ open: select_is_open }"
  >
    <div
      @click="this.select_is_open = !this.select_is_open"
      class="select_title"
    >
      <img :src="this.baseImg" />
      {{ this.baseOption }}
    </div>
    <div class="select_options">
      <div
        v-for="(option, i) in this.options"
        :key="option.value"
        class="select_option"
      >
        <p @click="selectOptions(option.title, option.img)">
          <img :src="this.optionsImgs[i]" />
          {{ option.title }}
        </p>
      </div>
    </div>
  </div>
  <div v-else class="select_con" :class="{ open: select_is_open }">
    <div
      @click="this.select_is_open = !this.select_is_open"
      class="select_title"
    >
      {{ this.baseOption }}
    </div>
    <div class="select_options">
      <div
        v-for="option in this.options"
        :key="option.value"
        class="select_option"
      >
        <p @click="selectOption(option.title)">{{ option.title }}</p>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "main-select",
  props: {
    options: Array,
    selectType: {
      type: String,
      default: "normal",
    },
  },
  data() {
    return {
      select_is_open: false,
      baseOption: "",
      baseImg: "",
    };
  },
  computed: {
    optionsImgs() {
      let obj = [];
      for (let i = 0; i < this.options.length; i++) {
        obj.push(require(`@/assets/img/${this.options[i].img}`));
      }
      return obj;
    },
  },
  methods: {
    selectOption(option) {
      this.baseOption = option;
    },
    selectOptions(optionTitle, optionImg) {
      this.baseOption = optionTitle;
      this.baseImg = require(`@/assets/img/${optionImg}`);
    },
    hideSelect() {
      this.select_is_open = false;
    },
  },
  mounted() {
    document.addEventListener("click", this.hideSelect.bind(this), true);
    this.baseOption = this.options[0].title;
    if (this.options[0].img) {
      this.baseImg = require(`@/assets/img/${this.options[0].img}`);
    }
  },
};
</script>
<style lang="scss" scoped>
.select {
  // .select_con
  &_con {
    position: relative;
    max-width: 320px;
    width: 100%;
    &.open {
      & .select_title {
        pointer-events: none;
        @media (min-width: 991.98px) {
          transform: scale(1.05);
        }
        &::after {
          transform: rotate(-180deg);
        }
      }
      & .select_options {
        pointer-events: all;
        opacity: 1;
        visibility: visible;
        top: 0px;
        @media (min-width: 991.98px) {
          transform: scale(1.05);
        }
      }
    }
    &-mini {
      .select {
        &_title {
          border-radius: 21px;
          font-weight: 500;
          color: #000034;
          height: 40px;
          padding: 0 10px;
          &::after {
            background-image: url("../../assets/img/arrow-down-icon-dark.svg");
            height: 15px;
            width: 15px;
          }
        }
        &_options {
          border-radius: 21px;
          max-height: calc(38.1px * 5);
        }
        &_option {
          color: #000034;
          font-weight: 500;
          height: 38.1px;
          padding: 0 10px;
          p {
            height: 40px;
          }
        }
      }
    }
  }
  // .select_title
  &_title {
    cursor: pointer;
    background: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.16);
    border-radius: 10px;
    font-style: normal;
    font-weight: 400;
    font-size: 18px;
    line-height: 181.1%;
    color: #000000;
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 0 20px;
    position: relative;
    transition: all 0.3s ease 0s, pointer-events 0s;
    &:hover {
      border: 1px solid rgba(0, 0, 0, 0.32);
    }
    @media (max-width: 991.98px) {
      padding: 14px 20px;
      width: 100%;
    }
    &::after {
      content: "";
      background-image: url("../../assets/img/arrow-down-icon-blue.svg");
      background-position: center;
      background-size: contain;
      background-repeat: no-repeat;
      width: 18px;
      height: 18px;
      transition: all 0.3s ease 0s;
      margin-left: auto;
    }
  }
  // .select_options
  &_options {
    overflow-y: scroll;
    overflow-x: hidden;
    pointer-events: none;
    position: absolute;
    z-index: 2;
    background: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.16);
    border-radius: 10px;
    width: 100%;
    opacity: 0;
    visibility: hidden;
    top: -10px;
    transition: all 0.3s ease 0s, pointer-events 0s 0.3s;
    &::-webkit-scrollbar {
      width: 0;
    }
  }
  // .select_option
  &_option {
    cursor: pointer;
    font-style: normal;
    font-weight: 400;
    font-size: 18px;
    line-height: 181.1%;
    color: #000000;
    display: flex;
    flex-direction: column;
    padding: 0 20px;
    & p {
      display: inline-flex;
      justify-content: flex-start;
      align-items: center;
      padding: 8px 0;
      line-height: 25.76px;
    }
    &:not(:last-child) {
      &::after {
        content: "";
        width: 100%;
        height: 1px;
        background: rgba(0, 0, 0, 0.09);
      }
    }
    transition: all 0.3s ease 0s;
    &:hover,
    &:active {
      color: #fff !important;
      background: #3f7bdd;
    }
  }
}
.workers__select,
.accruals__select,
.history__filter_select {
  .select_title,
  .select_option {
    font-weight: 500;
    font-size: 18px;
    color: #000034;
  }
}
.connecting__select {
  max-width: 158px;
  img {
    width: 20px;
    height: 20px;
    margin: auto 8px auto 0;
  }
}
</style>

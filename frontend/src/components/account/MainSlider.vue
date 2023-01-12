<template>
  <div class="slider">
    <div class="slider__wrap">
      <payment-table :table="this.table" :first="firstRow" :rowsVal="rows" />
    </div>
    <div class="slider__nav">
      <span class="slider__nav_info" v-if="this.rows > this.table.rows.length">
        {{ this.startRow }}-{{ this.table.rows.length }} из
        {{ this.table.rows.length }}
      </span>
      <span class="slider__nav_info" v-else>
        {{ this.startRow }}-{{ this.rows }} из {{ this.table.rows.length }}
      </span>
      <div class="slider__nav-slides">
        <button class="slider__button" @click="slider(false, 1)">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
          >
            <path
              d="M14 18L8 12L14 6"
              stroke="#131A29"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </button>
        <div class="slider__slides" v-if="this.pages <= 8">
          <a
            ref="page"
            v-for="(page, index) in this.pages"
            :key="index"
            @click="pagination(page)"
            >{{ page }}</a
          >
        </div>
        <div class="slider__slides" v-else-if="this.booler">
          <a
            @click="pagination(page)"
            ref="page"
            v-for="(page, index) in this.overPages"
            :key="index"
            >{{ page }}</a
          >
        </div>
        <div class="slider__slides" v-else>
          <a
            @click="pagination(page)"
            ref="page"
            v-for="(page, index) in this.firstPages"
            :key="index"
            >{{ page }}</a
          >
          <span>...</span>
          <a
            @click="pagination(page)"
            ref="page"
            v-for="(page, index) in this.lastPages"
            :key="index"
            >{{ page }}</a
          >
        </div>
        <button class="slider__button" @click="slider(true, 1)">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
          >
            <path
              d="M10 6L16 12L10 18"
              stroke="#131A29"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </button>
      </div>
      <div class="slider__nav-skip">
        <input type="text" v-model="this.skip" placeholder="1" maxlength="2" />
        <button class="slider__nav-arrows">
          <svg
            @click="slider(true, this.skip)"
            xmlns="http://www.w3.org/2000/svg"
            width="15"
            height="15"
            viewBox="0 0 15 15"
            fill="none"
          >
            <path
              d="M8.20711 5.20711L11.2929 8.29289C11.9229 8.92286 11.4767 10 10.5858 10H4.41421C3.52331 10 3.07714 8.92286 3.70711 8.29289L6.79289 5.20711C7.18342 4.81658 7.81658 4.81658 8.20711 5.20711Z"
              fill="#000034"
            />
          </svg>
          <svg
            @click="slider(false, this.skip)"
            xmlns="http://www.w3.org/2000/svg"
            width="15"
            height="15"
            viewBox="0 0 15 15"
            fill="none"
          >
            <path
              d="M6.79289 9.79289L3.70711 6.70711C3.07714 6.07714 3.52331 5 4.41421 5H10.5858C11.4767 5 11.9229 6.07714 11.2929 6.70711L8.20711 9.79289C7.81658 10.1834 7.18342 10.1834 6.79289 9.79289Z"
              fill="#000034"
            />
          </svg>
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import PaymentTable from "@/components/tables/PaymentTable";

export default {
  components: { PaymentTable },
  props: {
    table: Object,
  },
  data() {
    return {
      firstRow: 0,
      rows: 10,
      slides: 1,
      slide: 1,
      skip: 2,
      firstPages: [1, 2, 3, 4, 5],
    };
  },
  computed: {
    startRow() {
      return this.firstRow + 1;
    },
    pages() {
      return Math.ceil(this.table.rows.length / 10);
    },
    lastPages() {
      let obj = [
        Math.ceil(this.table.rows.length / 10 - 1),
        Math.ceil(this.table.rows.length / 10),
      ];
      return obj;
    },
    overPages() {
      let obj = [
        Math.ceil(this.table.rows.length / 10 - 7),
        Math.ceil(this.table.rows.length / 10 - 6),
        Math.ceil(this.table.rows.length / 10 - 5),
        Math.ceil(this.table.rows.length / 10 - 4),
        Math.ceil(this.table.rows.length / 10 - 3),
        Math.ceil(this.table.rows.length / 10 - 2),
        Math.ceil(this.table.rows.length / 10 - 1),
        Math.ceil(this.table.rows.length / 10),
      ];
      return obj;
    },
    booler() {
      let bool = false;
      for (let i = 0; i < this.firstPages.length; i++) {
        if (this.firstPages[i] == this.lastPages[0]) {
          bool = true;
        }
      }
      if (this.rows / 10 >= this.lastPages[0]) {
        bool = true;
      }
      return bool;
    },
  },
  methods: {
    slider(event, skip) {
      if (
        event &&
        this.rows < this.table.rows.length &&
        this.firstRow < this.table.rows.length - Number(skip + "0")
      ) {
        if (
          skip < 3 &&
          this.rows < 30 &&
          this.rows + Number(skip + "0") != 40
        ) {
          this.firstPages = [1, 2, 3, 4, 5];
        } else if (this.rows < this.table.rows.length) {
          if (
            this.$refs.page[0].innerText != String(this.rows).slice(0, -1) &&
            this.$refs.page[1].innerText != String(this.rows).slice(0, -1)
          ) {
            this.firstPages = this.firstPages.map(
              (elem) => elem + Number(skip)
            );
          } else if (
            this.$refs.page[0].innerText == String(this.rows).slice(0, -1)
          ) {
            this.firstPages = this.firstPages.map(
              (elem) => elem + Number(skip) - 2
            );
          } else if (
            this.$refs.page[1].innerText == String(this.rows).slice(0, -1)
          ) {
            this.firstPages = this.firstPages.map(
              (elem) => elem + Number(skip) - 1
            );
          }
        }
        this.firstRow = this.firstRow + Number(skip + "0");
        this.rows = this.rows + Number(skip + "0");
      } else if (
        !event &&
        this.firstRow > 0 &&
        this.rows > Number(skip + "0")
      ) {
        if (this.rows > 40 && this.rows > Number(skip + "0") + 30) {
          this.firstPages = this.firstPages.map(
            (elem) => elem - Math.abs(Number(skip))
          );
        } else {
          this.firstPages = [1, 2, 3, 4, 5];
        }
        this.firstRow = this.firstRow - Math.abs(Number(skip + "0"));
        this.rows = this.rows - Math.abs(Number(skip + "0"));
      }
      this.slideNumber();
    },
    pagination(skip) {
      if (Number(skip + "0") > this.rows) {
        this.slider(true, skip - String(this.rows).slice(0, -1));
      } else {
        this.slider(false, skip - String(this.rows).slice(0, -1));
      }
    },
    slideNumber() {
      setTimeout(() => {
        for (let i = 0; i < this.$refs.page.length; i++) {
          if (this.$refs.page[i].innerText == String(this.rows).slice(0, -1)) {
            this.$refs.page[i].classList.add("active");
          } else {
            this.$refs.page[i].classList.remove("active");
          }
        }
      }, 10);
    },
  },
  mounted() {
    this.slideNumber();
  },
};
</script>
<style lang="scss" scoped>
.slider {
  // .slider__wrap
  &__wrap {
    width: 100%;
    padding: 24px 16px;
    background: rgba(255, 255, 255, 0.29);
    border-radius: 21px;
    margin-bottom: 16px;
  }
  // .slider__nav
  &__nav {
    width: 100%;
    display: flex;
    align-items: center;
    min-height: 40px;
    // .slider__nav_info
    &_info {
      font-weight: 500;
      font-size: 18px;
      font-family: AmpleSoftPro;
      line-height: 22px;
    }
    // .slider__nav-slides
    &-slides {
      display: flex;
      height: 100%;
      margin: 0 16px 0 auto;
      align-items: center;
    }
    // .slider__nav-skip
    &-skip {
      width: 98px;
      height: 40px;
      padding: 0 17px;
      display: flex;
      background: #ffffff;
      border-radius: 13px;
      align-items: center;
      font-family: AmpleSoftPro;
      font-style: normal;
      font-weight: 500;
      font-size: 18px;
      line-height: 22px;
      position: relative;
      input {
        max-width: 32px;
        background-color: transparent;
        outline: none;
        user-select: none;
        cursor: pointer;
      }
    }
    // .slider__nav-arrows
    &-arrows {
      display: flex;
      flex-direction: column;
      align-items: center;
      height: 32px;
      margin-left: 16px;
      svg {
        width: 15px;
        height: 15px;
        cursor: pointer;
        &:first-child {
          margin-bottom: 2px;
        }
      }
      &::before {
        content: "";
        position: absolute;
        top: 0;
        height: 100%;
        width: 1px;
        background-color: #eff2f6;
        left: 50%;
        transform: translateX(-50%);
      }
    }
  }
  // .slider__button
  &__button {
    background: #ffffff;
    border-radius: 13px;
    width: 40px;
    height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    &:hover {
      background: rgba(#c2d5f2, 0.61);
    }
  }
  // .slider__slides
  &__slides {
    max-width: 245px;
    display: flex;
    height: 100%;
    align-items: center;
    margin: 0 16px;
    font-family: AmpleSoftPro;
    font-style: normal;
    font-weight: 500;
    font-size: 18px;
    line-height: 22px;
    a,
    span {
      margin-right: 16px;
      user-select: none;
      color: #331a38;
      transition: all 0.3s ease;
      cursor: pointer;
      &:last-child {
        margin-right: 0;
      }
    }
    .active {
      color: #4182ec;
      text-decoration: underline;
    }
  }
}
</style>

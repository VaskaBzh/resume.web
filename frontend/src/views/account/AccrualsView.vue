<template>
  <div class="accruals">
    <div class="accruals__wrapper">
      <main-title tag="h2" titleName="Начисления"></main-title>
      <div class="accruals__filter">
        <div class="accruals__filter_block">
          <div class="accruals__filter_label">Сумма всех выплат</div>
          <div class="accruals__filter_sum">
            <span>{{ this.bitcoins }}</span> BTC
          </div>
        </div>
        <div class="accruals__filter_block accruals__filter_block-type">
          <div class="accruals__filter_label">Тип начислений</div>
          <main-select class="accruals__select" :options="types"></main-select>
        </div>
        <div class="accruals__filter_block">
          <div class="accruals__filter_label">Дата</div>
          <Datepicker
            v-model="date"
            range
            placeholder="За все время"
            auto-apply
            locale="ru"
            position="center"
            :hide-navigation="['time']"
            :enable-time-picker="false"
          >
            <template #input-icon>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
              >
                <path
                  d="M3 10H21M7 3V5M17 3V5M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z"
                  stroke="#000034"
                  stroke-opacity="0.62"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
            </template>
          </Datepicker>
        </div>
        <blue-button class="accruals__button"
          ><a href="">Выгрузить</a></blue-button
        >
      </div>
      <main-slider :table="this.accrualsInfo"></main-slider>
    </div>
  </div>
</template>
<script>
import MainSlider from "@/components/account/MainSlider";
import Datepicker from "@vuepic/vue-datepicker";

export default {
  components: { MainSlider, Datepicker },
  data() {
    return {
      types: [
        { title: "Любой", value: 1 },
        { title: "FPPS+ начисление", value: 2 },
      ],
      accrualsInfo: {
        titles: ["Дата", "Тип наисления", "Ср. хешрейт", "Доходы", "Сложность"],
        rows: [
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
          {
            date: "29.11.2022",
            type: "FPPS+ начисление",
            hash: "164.78",
            BTC: 0,
            complexity: "",
          },
        ],
      },
    };
  },
  computed: {
    bitcoins() {
      let sum = 0;
      return sum.toFixed(8);
    },
  },
  mounted() {
    document.title = "Начисления";
  },
};
</script>
<style lang="scss" scoped>
.accruals {
  width: 100%;
  &__select {
    height: 48px;
    .select_title {
      font-weight: 500;
      font-size: 18px;
      line-height: 26px;
      color: #000034;
    }
  }
  &__wrapper {
    width: 100%;
  }
  &__filter {
    display: flex;
    width: 100%;
    align-items: flex-end;
    margin-bottom: 24px;
    &_block {
      display: flex;
      flex-direction: column;
      max-width: 243px;
      width: 100%;
      margin-right: 16px;
      &:first-child {
        margin-right: auto;
      }
      &-type {
        max-width: 220px;
      }
    }
    &_label {
      margin-bottom: 8px;
      font-weight: 400;
      font-size: 16px;
      line-height: 23px;
      color: rgba(0, 0, 0, 0.62);
    }
    &_sum {
      color: rgba(#000034, 0.62);
      font-style: normal;
      font-weight: 500;
      font-size: 28px;
      line-height: 40px;
      span {
        font-weight: 700;
        color: #000034;
      }
    }
  }
  &__button {
    padding: 11px 24px;
    border-radius: 13px;
    font-size: 18px;
    max-width: 141px;
    width: 100%;
    height: 48px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }
}
</style>

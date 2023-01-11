<template>
  <table class="table">
    <thead>
      <tr>
        <th v-for="(title, i) in this.table.titles" :key="i">
          {{ title }}
        </th>
      </tr>
    </thead>
    <tbody>
      <tr class="row-main" :key="mainRow">
        <td>{{ this.mainRow.hash }}</td>
        <td>{{ this.hashRate }} TH/s</td>
        <td>{{ this.hashAvarage }} TH/s</td>
        <td>{{ this.hashAvarage24 }} TH/s</td>
        <td>{{ this.rejectRate }} %</td>
      </tr>
      <table-workers-row
        v-for="(row, i) in this.table.rows"
        :columns="row"
        :key="i"
        :class="row.hashClass"
      />
    </tbody>
  </table>
</template>
<script>
export default {
  props: {
    table: Object,
  },
  data() {
    return {
      mainRow: this.table.mainRow,
    };
  },
  computed: {
    hashRate() {
      return Number(this.mainRow.hashRate).toFixed(2);
    },
    hashAvarage() {
      return Number(this.mainRow.hashAvarage).toFixed(2);
    },
    hashAvarage24() {
      return Number(this.mainRow.hashAvarage24).toFixed(2);
    },
    rejectRate() {
      return Number(this.mainRow.rejectRate).toFixed(2);
    },
  },
};
</script>
<style lang="scss" scoped>
.table {
  width: 100%;
  border-spacing: 0;
  text-indent: 0;
  tr {
    display: flex;
    width: 100%;
  }
  thead {
    tr {
      background: transparent;
      height: 23px;
      margin: 16px 0;
      border-radius: 0;
      padding: 0 16px;
      th {
        color: rgba(0, 0, 0, 0.62);
        font-weight: 400;
        font-size: 16px;
        line-height: 23px;
        text-align: left;
        width: 100%;
        &:first-child {
          margin-right: 20px;
        }
      }
    }
  }
  tbody {
    tr {
      background: #ffffff;
      margin-bottom: 8px;
      height: 48px;
      border-radius: 21px;
      padding: 11px 16px;
      &:last-child {
        margin-bottom: 0;
      }
      td {
        width: 100%;
        color: #000034;
        font-weight: 500;
        font-size: 18px;
        line-height: 26px;
        display: inline-flex;
        align-items: center;
      }
    }
  }
  .row {
    &-main {
      background-color: transparent !important;
      padding: 0 16px !important;
      height: 26px !important;
      border-radius: 0 !important;
      margin: 0 0 16px !important;
      td {
        max-width: 165px;
        &:first-child {
          margin-right: 20px;
        }
        &:last-child {
          max-width: 125px;
        }
      }
    }
  }
}
</style>

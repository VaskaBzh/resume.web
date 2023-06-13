<template>
    <Head :title="$t('complexity.title')" />
    <div class="complexity">
        <div class="complexity__container">
            <div class="page__main">
                <div class="page__content">
                    <main-title tag="h1" class="page__title">
                        {{ $t("complexity.title") }}
                    </main-title>
                    <div class="description">
                        {{ $t("complexity.text") }}
                    </div>
                </div>
                <div class="page__image">
                    <img src="../../assets/img/compl-main-img.png" alt="" />
                </div>
            </div>
            <MainChart :graphs="graphs" :key="this.time" />
        </div>
    </div>
</template>

<script>
import { Head } from "@inertiajs/vue3";
import MainChart from "@/Components/technical/charts/MainChart.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import { mapGetters } from "vuex";

export default {
    components: {
        MainTitle,
        MainChart,
        Head,
    },
    computed: {
        ...mapGetters(["btcInfo", "btcHistory"]),
        changeDiff() {
            let string = "...";
            if (this.btcInfo.btc) {
                string = `(${this.btcInfo.btc.diff_change})`;
                string += ` /  ${(
                    (Number(this.btcInfo.btc.nextDiff) -
                        Number(this.btcInfo.btc.diff)) /
                    1000000000000
                ).toFixed(2)} T`;
            }
            return string;
        },
        network() {
            let string = "...";
            if (this.btcInfo.btc) {
                string = this.btcInfo.btc.network.toFixed(2);
                string += ` ${this.btcInfo.btc.networkUnit}H/s`;
            }
            return string;
        },
        diff() {
            let string = "...";
            if (this.btcInfo.btc) {
                string = this.btcInfo.btc.diff;
            }
            return string;
        },
        nextDiff() {
            let string = "...";
            if (this.btcInfo.btc) {
                string = this.btcInfo.btc.nextDiff;
            }
            return string;
        },
        time() {
            let string = "...";
            if (this.btcInfo.btc) {
                this.btcInfo.btc.time % 24 !== 0
                    ? (string = `${String(this.btcInfo.btc.time / 24).substr(
                          0,
                          1
                      )} ${this.$t("days")} ${
                          this.btcInfo.btc.time % 24
                      } ${this.$t("hours")}`)
                    : (string = `${String(this.btcInfo.btc.time / 24).substr(
                          0,
                          1
                      )} ${this.$t("days")}`);
            }
            return string;
        },
        graphs() {
            let arr = [
                {
                    id: 1,
                    title: this.$t("complexity.blocks.chart_label"),
                    values: [],
                    dates: [],
                    about: [
                        {
                            id: 11,
                            title: this.$t("complexity.blocks.subtitles[0]"),
                            text: this.network,
                        },
                        {
                            id: 12,
                            title: this.$t("complexity.blocks.subtitles[1]"),
                            text: this.diff,
                        },
                    ],
                },
                {
                    about: [
                        {
                            id: 21,
                            title: this.$t("complexity.blocks.subtitles[2]"),
                            text: this.nextDiff,
                            span: this.changeDiff,
                        },
                        {
                            id: 22,
                            title: this.$t("complexity.blocks.subtitles[3]"),
                            text: this.time,
                        },
                    ],
                },
            ];
            Object.values(this.btcHistory).forEach((el) => {
                arr[0].values.push(el["y"]);
                arr[0].dates.push(el["x"] * 1000);
            });
            return arr;
        },
    },
    mounted() {
        document.title = "Сложность";
    },
};
</script>

<style lang="scss" scoped>
.complexity {
    &__main {
        align-items: center;
    }
}
.graph {
    margin-bottom: 50px;
    @media (max-width: 767.98px) {
        margin-bottom: 35px;
    }
}
</style>

<template>
    <Head title="Сложность сети" />
    <div class="complexity">
        <div class="complexity__container">
            <div class="complexity__main">
                <div class="complexity__content">
                    <main-title tag="h1" class="complexity__title">
                        Сложность сети
                    </main-title>
                    <div class="complexity__text main__text">
                        Сложность корректируется каждые 2016 блоков (примерно
                        каждые 2 недели), чтобы среднее время между каждым
                        блоком оставалось в размере 10 минут.
                    </div>
                </div>
                <div class="complexity__image">
                    <img src="../../assets/img/compl-main-img.png" alt="" />
                </div>
            </div>
            <MainChart :graphs="graphs" :key="this.time" />
        </div>
    </div>
</template>

<script>
import { Head } from "@inertiajs/vue3";
import MainChart from "@/Components/charts/MainChart.vue";
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
                      )} Дни ${this.btcInfo.btc.time % 24} Часы`)
                    : (string = `${String(this.btcInfo.btc.time / 24).substr(
                          0,
                          1
                      )} Дни`);
            }
            return string;
        },
        graphs() {
            let arr = [
                {
                    id: 1,
                    title: "Сложность",
                    values: [],
                    dates: [],
                    about: [
                        {
                            id: 11,
                            title: "Хэшрейт",
                            text: this.network,
                        },
                        {
                            id: 12,
                            title: "Сложность",
                            text: this.diff,
                        },
                    ],
                },
                {
                    about: [
                        {
                            id: 21,
                            title: "Ожидаемая следующая сложность",
                            text: this.nextDiff,
                            span: this.changeDiff,
                        },
                        {
                            id: 22,
                            title: "Дата следующей сложности",
                            text: this.time,
                        },
                    ],
                },
            ];
            Object.values(this.btcHistory).forEach((el) => {
                arr[0].values.push(el["y"]);
                arr[0].dates.push(
                    new Date(Number(el["x"]).toFixed(0) * 1000).getFullYear()
                );
            });
            return arr;
        },
    },
};
</script>

<style lang="scss" scoped>
.complexity {
    // .complexity__main
    &__main {
        display: flex;
        align-items: center;
        @media (max-width: 767.98px) {
            flex-direction: column;
        }
    }
    // .complexity__content
    &__content {
        flex: 1 0 40%;
        position: relative;
        @media (max-width: 991.98px) {
            flex: 1 0 60%;
        }
    }
    // .complexity__title
    &__title {
        margin-bottom: 24px;
        @media (max-width: 767.98px) {
            margin-top: 32px;
            text-align: center;
            margin-bottom: 10px;
        }
    }
    // .complexity__text
    &__text {
        @media (max-width: 767.98px) {
            text-align: center;
            font-size: 16px;
            line-height: 148.6%;
        }
    }
    // .complexity__image
    &__image {
        position: relative;
        & img {
            max-width: 1050px;
            @media (max-width: 1270px) {
                max-width: 770px;
            }
            @media (max-width: 767.98px) {
                position: relative;
                left: 20vw;
                max-width: unset;
                width: 140vw;
                object-fit: cover;
            }
        }
    }
}
.graph {
    margin-bottom: 50px;
    @media (max-width: 767.98px) {
        margin-bottom: 35px;
    }
}
</style>

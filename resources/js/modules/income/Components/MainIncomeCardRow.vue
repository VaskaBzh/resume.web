<template>
    <div class="icome-container">
        <p class="title">
            <slot name="title"></slot>
        </p>
        <div class="flex-jc">
            <div class="data-container">
                <span class="data-num">
                    {{ converter?.btc }}
                </span>
                <span class="btc-gray-text">BTC</span>
            </div>
            <div class="flex-column">
                <span class="rub-counter-text"> ≈ {{ converter?.usd }} $ </span>
                <span class="rub-counter-text" v-if="$i18n.locale === 'ru'">
                    ≈ {{ converter?.rub }} ₽
                </span>
            </div>
        </div>
    </div>
</template>
<script>
import {mapGetters} from "vuex";
import {Converter} from "@/Scripts/converter";

export default {
    computed: {
        ...mapGetters([
            "btcInfo",
        ]),
    },
    props: {
        bitcoinValue: {
            type: Number,
            default: 0,
        },
    },
    data() {
        return {
            converter: null,
            BTC: this.bitcoinValue,
        };
    },
    methods: {
        async updateConversion() {
            this.converter = new Converter(
                this.BTC,
                this.btcInfo?.btc ? this.btcInfo.btc.price : 0
            );
            await this.converter.convert();
        },
    },
    mounted() {
        this.updateConversion();
    },
    watch: {
        btcInfo: {
            immediate: true,
            handler() {
                this.updateConversion();
            },
        },
        bitcoinValue: {
            immediate: true,
            handler(newBitcoinValue) {
                this.BTC = newBitcoinValue;

                this.updateConversion();
            },
        },
    },
}
</script>
<style scoped>
.flex-jc {
    display: flex;
    width: 100%;
    justify-content: space-between;
    align-items: baseline;
    flex-wrap: wrap;
    gap: 8px;
}

.flex-column {
    display: flex;
    gap: 8px;
}

@media (max-width: 500px) {
    .flex-jc {
        align-items: center;
    }

    .title {
        margin-bottom: 0;
    }
}

.icome-container {
    width: 100%;
}

.title {
    color: var(--text-teritary);
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 600;
    line-height: 142%;
    margin-bottom: 4px;
}

.data-num {
    color: var(--text-primary);
    font-family: Unbounded, serif;
    font-size: 27px;
    font-weight: 400;
    line-height: 147%;
}

@media (max-width: 998px) {
    .data-num {
        font-size: 20px;
    }
}

.btc-gray-text {
    color: var(--text-fourth);
    font-family: Unbounded, serif;
    font-size: 20px;
    font-weight: 400;
    line-height: 160%;
    margin-left: 8px;
}

@media (max-width: 500px) {
    .btc-gray-text {
        font-size: 14px;
    }

    .title {
        font-size: 12px;
        margin-bottom: 0;

    }
}

.rub-counter-text {
    color: var(--text-fourth);
    font-family: Unbounded, serif;
    font-size: 14px;
    align-self: center;
    font-weight: 400;
    line-height: 20px;
}

@media (max-width: 998px) {
    .rub-counter-text {
        font-size: 10px;
    }
}
</style>

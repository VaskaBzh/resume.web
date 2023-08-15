<template>
    <transition name="newResult">
        <div class="result" v-if="setted">
            <span class="result_value"> {{ converter.btc }} </span>
            <span class="result_value result_value-converted">
                ≈ ${{ converter.usd }}
            </span>
            <span class="result_value result_value-converted">
                ≈ ₽{{ converter.rub }}
            </span>
        </div>
    </transition>
</template>

<script>
import { Converter } from "../../../../Scripts/converter";
import { mapGetters } from "vuex";

export default {
    name: "converted-result",
    props: {
        bitcoinValue: Number,
    },
    data() {
        return {
            converter: null,
            setted: false,
        };
    },
    computed: {
        ...mapGetters(["btcInfo"]),
    },
    watch: {
        bitcoinValue(newValue) {
            if (newValue) this.initConverter();
        },
    },
    methods: {
        async initConverter() {
            this.setted = false;
            this.converter = new Converter(
                this.bitcoinValue,
                this.btcInfo.btc.price
            );

            await this.converter.convert();

            setTimeout(() => (this.setted = true), 300);
        },
    },
    mounted() {
        if (this.bitcoinValue) this.initConverter();
    },
};
</script>

<style scoped lang="scss">
.newResult-enter-active,
.newResult-leave-active {
    transition: all 0.3s ease;
}
.newResult-enter-from,
.newResult-leave-to {
    opacity: 0;
    transform: translateY(15px);
}
.result {
    display: flex;
    align-items: center;
    gap: 8px;
    justify-content: center;
    &_value {
        color: #fff;
        font-feature-settings: "case" on;
        font-size: 18px;
        font-weight: 600;
        line-height: 110%;
        letter-spacing: 0.35px;
        &-converted {
            color: rgba(255, 255, 255, 0.5);
            font-size: 16px;
            font-weight: 400;
            line-height: 110%;
            letter-spacing: 0.35px;
        }
    }
}
</style>

<template>
    <transition name="newResult">
        <div class="result" v-if="setted">
            <p class="result_value"> {{ converter.btc }} BTC</p>
            <div>
                <span class="result_value result_value-converted">
                    ≈ ${{ converter.usd }}
                </span>
                <span class="result_value result_value-converted">
                    ≈ ₽{{ converter.rub }}
                </span>
            </div>

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
    align-items: flex-start;
    flex-direction: column;
    gap: 8px;
    justify-content: center;
    @media(max-width:550px){
        align-items: center;
    }
    &_value {
        color: var(--gray-3100, #D0D5DD);
        text-align: center;
        font-family: Unbounded;
        font-size: 41px;
        font-style: normal;
        font-weight: 600;
        line-height: 120%; /* 49.2px */
        text-transform: uppercase;
        @media(max-width:890px){
            font-size: 24px;
        }
        @media(max-width:550px){
            font-size: 16px;
        }
        &-converted {
            color: var(--gray-170, rgba(245, 250, 255, 0.70));
            font-size: 20px;
            font-weight: 400;
            @media(max-width:890px){
            font-size: 18px;
        }
            @media(max-width:550px){
            font-size: 12px;
        }
        }
    }
}
</style>

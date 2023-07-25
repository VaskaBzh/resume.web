<template>
    <div class="btc__block">
        <span class="text text-md">{{ title }}</span>
        <div class="btc__value text text-md text-blue">
            <b>{{ converter.btc }} BTC</b>
            <span class="text text-md">{{ converter.usd }} $</span>
            <span class="text text-md" v-if="$i18n.locale === 'ru'"
                >{{ converter.rub }} ₽</span
            >
        </div>
    </div>
</template>
<script>
import { Converter } from "@/Scripts/converter";
import { mapGetters } from "vuex";
export default {
    name: "btc-calculator",
    props: {
        BTC: {
            type: Number,
            default: 0,
        },
        title: String,
        clearProfit: Number,
    },
    computed: {
        ...mapGetters(["btcInfo"]),
    },
    data() {
        return {
            converter: null,
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
    created() {
        this.updateConversion();
    },
    watch: {
        btcInfo: {
            immediate: true,
            handler() {
                this.updateConversion();
            },
        },
        BTC: {
            immediate: true,
            handler() {
                this.updateConversion();
            },
        },
    },
};
</script>
<style lang="scss" scoped>
.btc {
    &__block {
        display: flex;
        flex-direction: column;
        position: relative;
        gap: 4px;
    }

    &__value {
        display: inline-flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 5px;
        @media (max-width: 479.98px) {
            gap: 0 5px;
        }

        span {
            white-space: nowrap;
            display: inline-flex;
            gap: 5px;
            @media (max-width: 479.98px) {
                gap: 0 5px;
                font-weight: 500;
            }

            &::before {
                content: "≈";
            }

            &:last-child {
                margin-right: 0;
            }
        }
    }
}
</style>

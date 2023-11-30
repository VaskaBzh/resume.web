<template>
    <div class="row">
        <div class="row__content">
            <p class="row_title">
                {{ $t(`home.calculator.img_title[${titleIndex}]`) }}
            </p>
            <span class="row_value">{{ Number(converted?.btc) || "0.00000000" }} BTC</span>
        </div>
        <div class="row__converter" v-show="!fixRender">
            <span class="row_value row_value-converter"
                >${{ Number(converted?.usd).toFixed(2) }}
            </span>
            <span v-show="$i18n.locale === 'ru'" class="row_value row_value-converter"> ≈</span>
            <span v-show="$i18n.locale === 'ru'" class="row_value row_value-converter">
                ₽{{ Number(converted?.rub).toFixed(2) }}</span
            >
        </div>
    </div>
</template>

<script>
import { Converter } from "@/Scripts/converter";

import { mapGetters } from "vuex";

export default {
    name: "calculator-row",
    props: {
        titleIndex: Number,
        bitcoinValue: Number,
    },
    data() {
        return {
            converted: null,
            fixRender: false,
        };
    },
    computed: {
        ...mapGetters(["btcInfo"]),
    },
    watch: {
        bitcoinValue(newValue) {
            this.initConverter(newValue);
        },
    },
    mounted() {
        this.initConverter(this.bitcoinValue);
    },
    methods: {
        needFixRender() {
            this.fixRender = true;
        },
        dropFixRender() {
            this.fixRender = false;
        },
        async initConverter(bitcoinValue) {
            if (this.btcInfo.btc && bitcoinValue?.length < 23) {
                bitcoinValue.length > 12 ? this.needFixRender() : this.dropFixRender();

                this.converted = new Converter(
                    bitcoinValue,
                    this.btcInfo.btc.price
                );

                await this.converted.convert();
            }
        },
    },
};
</script>

<style scoped lang="scss">
.row {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    @media (max-width: $pc) {
        min-width: fit-content;
        gap: 40px;
    }
    @media (max-width: $mobile) {
        min-width: 100%;
    }
    &_title {
        color: var(--dark-bg, #fff);
        font-size: 16px;
        font-weight: 400;
        line-height: 135%;
        @media (max-width: $pc) {
            color: var(--light-theme-text, #7c7c7c);
        }
    }
    &_value {
        color: var(--dark-bg, #fff);
        font-size: 18px;
        font-weight: 500;
        line-height: 135%;
        @media (max-width: $pc) {
            color: var(--light-theme-text, #7c7c7c);
        }
        &-converter {
            color: var(--blue-10, #ecf2fc);
            text-align: right;
            font-size: 14px;
            font-weight: 400;
            line-height: 135%;
            height: fit-content;
            @media (max-width: $pc) {
                color: var(--dark-theme-gray, #989898);
            }
            &:last-child {
                width: 100%;
            }
        }
    }
    &__content {
        display: flex;
        flex-direction: column;
        gap: 8px;
        width: fit-content;
        &:first-child {
            width: 100%;
        }
    }
    &__converter {
        display: flex;
        flex-wrap: wrap;
        width: fit-content;
        align-items: flex-end;
        justify-content: flex-end;
        @media (max-width: $pc) {
            flex-direction: row;
            align-items: flex-end;
            gap: 4px;
        }
    }
}
</style>

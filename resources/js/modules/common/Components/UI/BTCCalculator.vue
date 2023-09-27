<template>
    <div class="btc__block">
        <main-title class="headline">
            {{ title }}
        </main-title>
        <div class="btc__value btc-calc-num">
            <div class="btc_num">
                {{ converter.btc }}
                <div class="btc_unit">
                    BTC
                </div>
            </div>
            <div class="convertor-container is-web">
                <span class="convertor-calc">{{ converter.usd }} $</span>
                <span class="convertor-calc" v-if="$i18n.locale === 'ru'">{{ converter.rub }} ₽</span>
            </div>
            <tooltip-card class="is-mobile"
                            :text="'$' + converter.usd + ' ≈ ' + converter.rub + ' ₽'"
            ></tooltip-card>
        </div>
    </div>
</template>
<script>
import { Converter } from "@/Scripts/converter";
import { mapGetters } from "vuex";
import MainTitle from "./MainTitle.vue";
import TooltipCard from "@/modules/common/Components/UI/TooltipCard.vue"
export default {
    name: "btc-calculator",
    components: {
        MainTitle,
        TooltipCard
    },
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
.is-web{
    display: inline-block
}
.is-mobile{
    display: none
}
@media(max-width:500px){
    .is-web{
        display: none
    } 
    .is-mobile{
        display: inline-block
}
}
.btn-about{
    margin-left: 8px;
    height: fit-content;
}
.btc-calc-num{
    color: var(--text-primary-80);
    font-family: Unbounded, serif;
    font-size: 27px;
    font-style: normal;
    font-weight: 400;
    line-height: 147%;
}
.convertor-calc{
    color: var(--light-gray-300, var(--gray-3100, #D0D5DD));
    font-family: Unbounded, serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 145%;
}
.converter-container {
    display: flex;
    align-items: center;
}
.btc {
    &__block {
        display: flex;
        flex-direction: column;
        position: relative;
        gap: 4px;
        @media(max-width:500px){
            gap: 0px;
        }
    }

    &_unit {
        color: var(--light-gray-300, #D0D5DD);
        font-family: Unbounded, serif;
        font-size: 20px;
        font-weight: 400;
        line-height: 32px;
        @media(max-width: 500px){
            line-height: 34px;
            color: var(--text-fourth-night, #595E68);
            font-family: Unbounded;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
        }
        @media(max-width: 900px){
            line-height: 39px;
        }
    }

    &_num {
        display: flex;
        gap: 8px;
        color: var(--text-primary-80);
        font-family: Unbounded, serif;
        font-size: 27px;
        font-weight: 400;
        line-height: 40px;
        align-items: flex-end;
        @media(max-width: 1450px){
         font-size: 25x;
        }
        @media(max-width: 1350px){
                font-size: 23px;
            }
        @media(max-width:1200px){
            font-size: 20px;
        }
    }

    &__value {
        display: flex;
        align-items: center;
        justify-content: space-between;
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

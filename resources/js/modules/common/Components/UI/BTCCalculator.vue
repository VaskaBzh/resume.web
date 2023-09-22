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
            <div class="convertor-container">
                <span class="convertor-calc">{{ converter.usd }} $</span>
                <span class="convertor-calc" v-if="$i18n.locale === 'ru'">{{ converter.rub }} ₽</span>
<!--                <svg class="btn-about" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">-->
<!--                    <path d="M7.66074 11.333C7.66074 11.6092 7.8846 11.833 8.16074 11.833C8.43688 11.833 8.66074 11.6092 8.66074 11.333H7.66074ZM7.49408 6.83304C7.21793 6.83304 6.99408 7.0569 6.99408 7.33304C6.99408 7.60918 7.21793 7.83304 7.49408 7.83304V6.83304ZM8.06311 7.43067L8.41666 7.07712L8.06311 7.43067ZM7.99395 4.83304C7.7178 4.83304 7.49395 5.0569 7.49395 5.33304C7.49395 5.60918 7.7178 5.83304 7.99395 5.83304V4.83304ZM7.99993 5.83304C8.27608 5.83304 8.49993 5.60918 8.49993 5.33304C8.49993 5.0569 8.27608 4.83304 7.99993 4.83304V5.83304ZM7.99935 13.8332C6.49243 13.8332 5.41254 13.8321 4.59128 13.7217C3.7844 13.6132 3.30243 13.4075 2.94706 13.0521L2.23996 13.7592C2.81209 14.3314 3.54026 14.5894 4.45803 14.7128C5.36142 14.8342 6.5207 14.8332 7.99935 14.8332V13.8332ZM1.16602 7.99984C1.16602 9.47848 1.16495 10.6378 1.28641 11.5412C1.4098 12.4589 1.66783 13.1871 2.23996 13.7592L2.94706 13.0521C2.5917 12.6968 2.38598 12.2148 2.27749 11.4079C2.16708 10.5866 2.16602 9.50675 2.16602 7.99984H1.16602ZM13.8327 7.99984C13.8327 9.50675 13.8316 10.5866 13.7212 11.4079C13.6127 12.2148 13.407 12.6968 13.0516 13.0521L13.7587 13.7592C14.3309 13.1871 14.5889 12.4589 14.7123 11.5412C14.8337 10.6378 14.8327 9.47848 14.8327 7.99984H13.8327ZM7.99935 14.8332C9.47799 14.8332 10.6373 14.8342 11.5407 14.7128C12.4584 14.5894 13.1866 14.3314 13.7587 13.7592L13.0516 13.0521C12.6963 13.4075 12.2143 13.6132 11.4074 13.7217C10.5862 13.8321 9.50626 13.8332 7.99935 13.8332V14.8332ZM7.99935 2.1665C9.50626 2.1665 10.5862 2.16757 11.4074 2.27798C12.2143 2.38646 12.6963 2.59219 13.0516 2.94755L13.7587 2.24045C13.1866 1.66831 12.4584 1.41029 11.5407 1.2869C10.6373 1.16544 9.47799 1.1665 7.99935 1.1665V2.1665ZM14.8327 7.99984C14.8327 6.52119 14.8337 5.36191 14.7123 4.45852C14.5889 3.54075 14.3309 2.81258 13.7587 2.24045L13.0516 2.94755C13.407 3.30292 13.6127 3.78488 13.7212 4.59177C13.8316 5.41303 13.8327 6.49292 13.8327 7.99984H14.8327ZM7.99935 1.1665C6.5207 1.1665 5.36142 1.16544 4.45803 1.2869C3.54026 1.41029 2.81209 1.66831 2.23996 2.24045L2.94706 2.94755C3.30243 2.59219 3.7844 2.38646 4.59128 2.27798C5.41254 2.16757 6.49243 2.1665 7.99935 2.1665V1.1665ZM2.16602 7.99984C2.16602 6.49292 2.16708 5.41303 2.27749 4.59177C2.38598 3.78488 2.5917 3.30292 2.94706 2.94755L2.23996 2.24045C1.66783 2.81258 1.4098 3.54075 1.28641 4.45852C1.16495 5.36191 1.16602 6.52119 1.16602 7.99984H2.16602ZM7.66074 7.99971V11.333H8.66074V7.99971H7.66074ZM7.49408 7.83304C7.5745 7.83304 7.63638 7.83307 7.68923 7.83441C7.74233 7.83575 7.7739 7.83819 7.79321 7.84079C7.8122 7.84334 7.80582 7.84438 7.78697 7.83662C7.76413 7.82723 7.73546 7.81012 7.70956 7.78422L8.41666 7.07712C8.25946 6.91992 8.07267 6.86936 7.92646 6.8497C7.79462 6.83198 7.63707 6.83304 7.49408 6.83304V7.83304ZM8.66074 7.99971C8.66074 7.85671 8.6618 7.69916 8.64408 7.56733C8.62442 7.42111 8.57386 7.23432 8.41666 7.07712L7.70956 7.78422C7.68366 7.75833 7.66656 7.72966 7.65716 7.70681C7.6494 7.68796 7.65044 7.68159 7.653 7.70057C7.65559 7.71988 7.65804 7.75146 7.65938 7.80456C7.66071 7.8574 7.66074 7.91928 7.66074 7.99971H8.66074ZM7.99395 5.83304H7.99993V4.83304H7.99395V5.83304Z" fill="#D0D5DD"/>-->
<!--                </svg>-->
            </div>
        </div>
    </div>
</template>
<script>
import { Converter } from "@/Scripts/converter";
import { mapGetters } from "vuex";
import MainTitle from "./MainTitle.vue";
export default {
    name: "btc-calculator",
    components: {
        MainTitle
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
.btn-about{
    margin-left: 8px;
    height: fit-content;
}
.btc-calc-num{
    color: var(--light-gray-800, #1D2939);
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
    }

    &_unit {
        color: var(--light-gray-300, #D0D5DD);
        font-family: Unbounded, serif;
        font-size: 20px;
        font-weight: 400;
        line-height: 32px;
    }

    &_num {
        opacity: 0.8;
        display: flex;
        gap: 8px;
        color: var(--light-gray-800, #1D2939);
        font-family: Unbounded, serif;
        font-size: 27px;
        font-weight: 400;
        line-height: 40px;
        align-items: flex-end;
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

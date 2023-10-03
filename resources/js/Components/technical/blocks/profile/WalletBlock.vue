<template>
    <div class="wallets__block wallets__block-wallet">
        <div class="wallets__block_name">
            <div class="wallet-inf">
                <span class="wallet-fullname">{{ wallet.fullName}}</span>
                <span class="wallet-wallet_address">{{ wallet.wallet_address }}</span>
            </div>
            <div class="wallets__block_doths" @click="toggleOpen">
                <div></div>
                <div></div>
                <div></div>
                <main-menu
                    className="wallets__block_doths_menu"
                    :options="options"
                    :opened="opened"
                    @remove="$emit('remove', wallet)"
                    @clicked="changeWalletObj(wallet)"
                ></main-menu>
            </div>
        </div>

    </div>
</template>

<script>
import { mapGetters } from "vuex";
import MainMenu from "@/modules/common/Components/UI/MainMenu.vue";
import { Converter } from "@/Scripts/converter";

export default {
    name: "wallet-block",
    props: {wallet: Object },
    data() {
        return {
            opened: false,
            converter: null,
        };
    },
    components: { MainMenu },
    computed: {
        ...mapGetters(["getActive", "btcInfo"]),
        options() {
            return [
                {
                    name: this.$t("wallets.block.wallet_block.menu[0]"),
                    svg: `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <g clip-path="url(#clip0_427_17514)">
                                <path d="M2.17708 14.6415L2.19015 14.1417H2.19015L2.17708 14.6415ZM1.35755 13.7114L1.85604 13.7503L1.35755 13.7114ZM3.19311 9.29699L2.82569 8.95786L3.19311 9.29699ZM1.37555 13.4804L0.877057 13.4416H0.877057L1.37555 13.4804ZM7.16725 12.7702L6.82039 12.4101L7.16725 12.7702ZM2.36374 14.6464L2.35067 15.1462H2.35067L2.36374 14.6464ZM14.4108 3.58793L14.8522 3.35309L14.4108 3.58793ZM13.4364 6.73199L13.0895 6.37187L13.4364 6.73199ZM14.3804 5.70112L13.946 5.45355L14.3804 5.70112ZM12.4604 1.59553L12.2177 2.03268L12.4604 1.59553ZM9.38264 2.59095L9.75005 2.93007L9.38264 2.59095ZM10.3918 1.6266L10.1362 1.19686L10.3918 1.6266ZM9.02038 2.31376C8.82512 2.1185 8.50854 2.1185 8.31328 2.31376C8.11801 2.50903 8.11801 2.82561 8.31328 3.02087L9.02038 2.31376ZM12.9799 7.68754C13.1752 7.8828 13.4918 7.8828 13.687 7.68754C13.8823 7.49228 13.8823 7.17569 13.687 6.98043L12.9799 7.68754ZM9.3335 14.1673C9.05735 14.1673 8.8335 14.3912 8.8335 14.6673C8.8335 14.9435 9.05735 15.1673 9.3335 15.1673V14.1673ZM14.6668 15.1673C14.943 15.1673 15.1668 14.9435 15.1668 14.6673C15.1668 14.3912 14.943 14.1673 14.6668 14.1673V15.1673ZM13.0895 6.37187L6.82039 12.4101L7.51411 13.1303L13.7832 7.09211L13.0895 6.37187ZM3.56053 9.63611L9.75005 2.93007L9.01521 2.25183L2.82569 8.95786L3.56053 9.63611ZM2.37681 14.1465L2.19015 14.1417L2.16401 15.1413L2.35067 15.1462L2.37681 14.1465ZM1.85604 13.7503L1.87404 13.5193L0.877057 13.4416L0.85906 13.6726L1.85604 13.7503ZM2.19015 14.1417C2.08381 14.1389 1.99957 14.1366 1.92725 14.1329C1.85462 14.1291 1.80703 14.1243 1.77433 14.1188C1.71284 14.1085 1.75878 14.1051 1.80436 14.1568L1.05408 14.8179C1.22104 15.0074 1.43209 15.0755 1.60978 15.1052C1.77194 15.1322 1.97001 15.1362 2.16401 15.1413L2.19015 14.1417ZM0.85906 13.6726C0.843591 13.8711 0.827019 14.0702 0.836209 14.2351C0.846145 14.4134 0.888608 14.6301 1.05408 14.8179L1.80436 14.1568C1.84844 14.2068 1.8385 14.2483 1.83466 14.1794C1.83008 14.0972 1.83836 13.9772 1.85604 13.7503L0.85906 13.6726ZM2.82569 8.95786C2.04177 9.80721 1.56603 10.3132 1.29071 10.9469L2.20789 11.3454C2.40021 10.9027 2.73114 10.5347 3.56053 9.63611L2.82569 8.95786ZM1.87404 13.5193C1.96994 12.2882 2.01519 11.7889 2.20789 11.3454L1.29071 10.9469C1.01577 11.5797 0.967727 12.2778 0.877057 13.4416L1.87404 13.5193ZM6.82039 12.4101C5.79203 13.4005 5.37283 13.7919 4.86363 13.9907L5.22745 14.9222C5.96617 14.6337 6.54546 14.0633 7.51411 13.1303L6.82039 12.4101ZM2.35067 15.1462C3.68131 15.181 4.48761 15.2112 5.22745 14.9222L4.86363 13.9907C4.35554 14.1892 3.78995 14.1835 2.37681 14.1465L2.35067 15.1462ZM13.1396 2.87893C13.6763 3.42728 13.8659 3.62818 13.9694 3.82278L14.8522 3.35309C14.6641 2.99942 14.3415 2.67723 13.8542 2.17939L13.1396 2.87893ZM13.7832 7.09211C14.2846 6.60917 14.6164 6.2967 14.8148 5.94869L13.946 5.45355C13.837 5.64481 13.6419 5.83983 13.0895 6.37187L13.7832 7.09211ZM13.9694 3.82278C14.2408 4.33296 14.2318 4.952 13.946 5.45355L14.8148 5.94869C15.2705 5.14902 15.2846 4.16583 14.8522 3.35309L13.9694 3.82278ZM13.8542 2.17939C13.3675 1.68226 13.0513 1.35169 12.7031 1.15838L12.2177 2.03268C12.4062 2.13735 12.6021 2.32987 13.1396 2.87893L13.8542 2.17939ZM9.75005 2.93007C10.2715 2.36516 10.4618 2.16671 10.6474 2.05634L10.1362 1.19686C9.79386 1.40046 9.48739 1.74025 9.01521 2.25183L9.75005 2.93007ZM12.7031 1.15838C11.8999 0.712465 10.9259 0.727184 10.1362 1.19686L10.6474 2.05634C11.1314 1.76846 11.7259 1.75962 12.2177 2.03268L12.7031 1.15838ZM8.31328 3.02087L12.9799 7.68754L13.687 6.98043L9.02038 2.31376L8.31328 3.02087ZM9.3335 15.1673H14.6668V14.1673H9.3335V15.1673Z" fill="#98A2B3"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_427_17514">
                                <rect width="16" height="16" fill="white"/>
                                </clipPath>
                            </defs>
                            </svg>`,
                    attr: "#changeWallet",
                }
            ];
        },
    },
    async mounted() {
        document.addEventListener("click", this.close.bind(this), true);
        document.addEventListener("keydown", (e) => {
            if (e.keyCode === 27) {
                this.close();
            }
        });
    },
    unmounted() {
        // document.removeEventListener("click", this.hideSelect.bind(this), true);
        document.removeEventListener("keydown", (e) => {
            if (e.keyCode === 27) {
                this.close();
            }
        });
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
        "wallet.value": {
            immediate: true,
            handler() {
                this.updateConversion();
            },
        },
    },
    methods: {
        async updateConversion() {
            this.converter = new Converter(
                this.wallet.total_payout,
                this.btcInfo?.btc ? this.btcInfo.btc.price : 0
            );
            await this.converter.convert();
        },
        toggleOpen() {
            this.opened = !this.opened;
        },
        close(e) {
            if (!e?.target.closest(".wallets__block_doths")) {
                this.opened = false;
            }
        },
        changeWalletObj(wallet) {
            this.$emit("getWallet", wallet);
        },
    },
};
</script>

<style scoped lang="scss">
.wallet-inf{
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.wallet-wallet_address{
    color: var(--text-teritary, #98A2B3);
    font-family: NunitoSans;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 145%; /* 20.3px */
}
.wallet-fullname{
    color: var(--light-gray-500, #667085);
    font-family: Unbounded;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%; /* 24px */
}
.wallets {
    // .wallets__block
    &__block {
        border-radius: 24px;
        background: var(--background-island-inner-3);
        box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.01);
        .main__number {
            padding: 16px 16px 0;
            margin-bottom: 8px;
            font-size: 20px;
            line-height: 28px;
            width: 100%;
            display: flex;
            gap: 4px;
            flex-wrap: wrap;
            font-weight: 500;
            color: var(--text-secondary);
            .unit {
                font-weight: 500;
            }
            @media (max-width: 767.98px) {
                font-size: 18px;
                padding: 10px 10px 0;
                line-height: 23px;
                margin-bottom: 0;
                .unit {
                    font-weight: 500;
                }
            }
            span {
                padding: 0 16px;
            }
        }

        &-wallet {
            transition: all 0.5s ease;

            &.top {
                &-before-enter {
                    opacity: 0;
                }

                &-enter {
                    opacity: 1;
                }
            }
        }

        &_name {
            width: 100%;
            padding: 16px 24px;
            display: inline-flex;
            align-items: center;
            gap: 16px;
            @media (max-width: 767.98px) {
                padding: 0 10px 10px;
            }

            img {
                margin-right: 16px;
                width: 24px;
                height: 24px;
                border-radius: 50%;
                @media (max-width: 767.98px) {
                    margin-right: 6px;
                }
            }

            span {
                font-weight: 500;
                font-size: 18px;
                line-height: 26px;
                @media (max-width: 991.98px) {
                    font-size: 16px;
                    line-height: 23px;
                }
            }
        }

        &_i {
            position: absolute;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            right: 12px;
            bottom: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #eff2f7;
            cursor: pointer;
            svg {
                width: 4px;
                height: 12px;
            }
        }

        &_doths {
            margin-left: auto;
            margin-bottom: 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 24px;
            gap: 3px;
            cursor: pointer;
            position: relative;
            @media (max-width: 767.98px) {
                width: 20px;
                gap: 2.5px;
            }

            div {
                width: 4px;
                height: 4px;
                border-radius: 50%;
                background-color: rgba(0, 0, 0, 0.62);
                transition: all 0.3s ease;
            }
        }
    }
}
</style>

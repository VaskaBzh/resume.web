<template>
    <div class="wallets__block wallets__block-wallet">
        <div class="wallets__block_name">
            <span v-if="wallet.fullName === '' && wallet.name === ''">{{
                wallet.wallet
            }}</span>
            <span v-else-if="wallet.fullName === '' && wallet.name !== ''">{{
                wallet.name
            }}</span>
            <span
                v-else-if="wallet.fullName !== '' && wallet.name !== ''"
                v-tooltip="{ message: wallet.fullName }"
                >{{ wallet.name }}</span
            >
            <div class="wallets__block_doths" @click="toggleOpen">
                <div></div>
                <div></div>
                <div></div>
                <main-menu
                    className="wallets__block_doths_menu"
                    :options="options"
                    :opened="opened"
                    @remove="remove(wallet)"
                    @clicked="changeWalletObj(wallet)"
                ></main-menu>
            </div>
        </div>
        <div class="main__number">
            {{ Number(val?.BTC).toFixed(8) || "0.00000000" }}
            <div class="unit">{{ wallet.shortName }}</div>
            <div class="row">
                <span> ≈ {{ val?.usd.toFixed(2) || "0.00" }} $</span>
                <span v-if="$i18n.locale === 'ru'">
                    ≈ {{ val?.rub.toFixed(2) || "0.00" }} ₽</span
                >
            </div>
        </div>
        <div
            class="wallets__block_i"
            v-tooltip="{
                message: `${$t(
                    'wallets.block.wallet_block.i_info_titles[0]'
                )}: ${wallet.percent}%. ${$t(
                    'wallets.block.wallet_block.i_info_titles[1]'
                )}: ${wallet.minWithdrawal} BTC`,
            }"
        >
            <svg
                width="3"
                height="10"
                viewBox="0 0 3 10"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M0.861318 3.95998C0.867851 3.44565 1.26175 3.18848 1.75002 3.18848C2.25129 3.18848 2.63539 3.44565 2.64844 3.95998L2.64844 9.12598C2.65494 9.37338 2.5752 9.57845 2.40922 9.74121C2.24315 9.90397 2.02665 9.98535 1.75972 9.98535C1.49932 9.98535 1.28285 9.90234 1.11032 9.73633C0.937785 9.57031 0.854784 9.3636 0.861318 9.11621L0.861318 3.95998Z"
                    fill="#969797"
                />
                <path
                    d="M1.01272 0.307582C1.22432 0.112315 1.47009 0.0146817 1.75002 0.0146817C2.03649 0.0146817 2.28389 0.113949 2.49222 0.312482C2.70053 0.511082 2.80469 0.750349 2.80469 1.03028C2.80469 1.31021 2.70053 1.54948 2.49222 1.74808C2.28389 1.94661 2.03649 2.04588 1.75002 2.04588C1.46355 2.04588 1.21615 1.94825 1.00782 1.75298C0.799486 1.55765 0.695319 1.31675 0.695319 1.03028C0.695319 0.743815 0.801119 0.502915 1.01272 0.307582Z"
                    fill="#969797"
                />
            </svg>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import MainMenu from "@/Components/UI/MainMenu.vue";
import { Converter } from "@/Scripts/converter";
import { useForm } from "@inertiajs/vue3";
import store from "@/store";
import { ref } from "vue";

export default {
    name: "wallet-block",
    props: { wallet: Object },
    data() {
        return {
            opened: false,
            val: null,
        };
    },
    setup() {
        let removeForm = ref(
            useForm({
                name: "",
                wallet: "",
                percent: "",
                minWithdrawal: "",
                group_id: store.getters.getActive,
            })
        );

        const remove = async (wallet) => {
            removeForm.value.wallet = wallet.wallet;
            await removeForm.value.post("/wallet_delete", {
                onSuccess() {
                    store.dispatch("getWallets", removeForm.value);
                },
            });
        };
        return {
            remove,
        };
    },
    components: { MainMenu },
    computed: {
        ...mapGetters(["getActive", "btcInfo"]),
        options() {
            return [
                {
                    name: this.$t("wallets.block.wallet_block.menu[0]"),
                    svg: `<svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <g clip-path="url(#clip0_1063_956)">
                                <path
                                    d="M5.40577 20.9698H16.8706C17.7495 20.9698 18.4315 20.7175 18.9165 20.2129C19.4015 19.7083 19.6441 18.9515 19.6441 17.9424V7.50293L18.0718 9.0752V17.8643C18.0718 18.3721 17.9513 18.7546 17.7105 19.0118C17.4696 19.2689 17.1831 19.3975 16.8511 19.3975H5.43506C4.94678 19.3975 4.5708 19.2689 4.30713 19.0118C4.04346 18.7546 3.91163 18.3721 3.91163 17.8643V6.78028C3.91163 6.27247 4.04346 5.88835 4.30713 5.62793C4.5708 5.36752 4.94678 5.23731 5.43506 5.23731H14.3316L15.9039 3.66504H5.40577C4.39014 3.66504 3.62516 3.91732 3.11084 4.42188C2.59652 4.92644 2.33936 5.68328 2.33936 6.69239V17.9424C2.33936 18.9515 2.59652 19.7083 3.11084 20.2129C3.62516 20.7175 4.39014 20.9698 5.40577 20.9698ZM8.96045 14.6416L10.8647 13.8116L19.9859 4.7002L18.648 3.38184L9.53663 12.4932L8.65772 14.3291C8.61866 14.4137 8.63656 14.4968 8.71143 14.5782C8.7863 14.6595 8.86931 14.6806 8.96045 14.6416ZM20.7085 3.98731L21.4117 3.26465C21.5744 3.08887 21.6574 2.89519 21.6607 2.6836C21.6639 2.47201 21.5809 2.28484 21.4117 2.12208L21.1871 1.8877C21.0373 1.73796 20.8566 1.6696 20.6451 1.68262C20.4335 1.69564 20.2463 1.78028 20.0835 1.93653L19.3706 2.63965L20.7085 3.98731Z"
                                />
                            </g>
                            <defs>
                                <clipPath id="clip0_1063_956">
                                    <rect
                                        width="19.3214"
                                        height="20.6379"
                                        fill="white"
                                        transform="translate(2.33936 1.68106)"
                                    />
                                </clipPath>
                            </defs>
                        </svg>`,
                    attr: "#changeWallet",
                },
                {
                    name: this.$t("wallets.block.wallet_block.menu[1]"),
                    svg: `<svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <g clip-path="url(#clip0_1073_213)">
                                <path
                                    d="M4.51031 19.4951C4.62749 19.6058 4.76096 19.6806 4.9107 19.7197C5.06044 19.7588 5.21018 19.7588 5.35992 19.7197C5.50966 19.6806 5.63986 19.6058 5.75054 19.4951L12.0005 13.2451L18.2505 19.4951C18.3612 19.6058 18.4914 19.6806 18.6411 19.7197C18.7909 19.7588 18.9422 19.7604 19.0952 19.7246C19.2482 19.6888 19.3801 19.6123 19.4907 19.4951C19.6015 19.3844 19.6747 19.2542 19.7105 19.1045C19.7463 18.9548 19.7463 18.805 19.7105 18.6553C19.6747 18.5056 19.6015 18.3753 19.4907 18.2646L13.2408 12.0049L19.4907 5.75487C19.6015 5.64419 19.6764 5.51398 19.7154 5.36425C19.7545 5.2145 19.7545 5.06476 19.7154 4.91502C19.6764 4.76528 19.6015 4.63508 19.4907 4.5244C19.3736 4.40721 19.2402 4.33071 19.0904 4.29491C18.9406 4.2591 18.7909 4.2591 18.6411 4.29491C18.4914 4.33071 18.3612 4.40721 18.2505 4.5244L12.0005 10.7744L5.75054 4.5244C5.63986 4.40721 5.50803 4.33071 5.35504 4.29491C5.20204 4.2591 5.05067 4.2591 4.90093 4.29491C4.75119 4.33071 4.62098 4.40721 4.51031 4.5244C4.39963 4.63508 4.32639 4.76528 4.29058 4.91502C4.25477 5.06476 4.25477 5.2145 4.29058 5.36425C4.32639 5.51398 4.39963 5.64419 4.51031 5.75487L10.7603 12.0049L4.51031 18.2646C4.39963 18.3753 4.32476 18.5056 4.2857 18.6553C4.24664 18.805 4.24501 18.9548 4.28081 19.1045C4.31662 19.2542 4.39312 19.3844 4.51031 19.4951Z"
                                    fill="#FF3B30"
                                />
                            </g>
                            <defs>
                                <clipPath id="clip0_1073_213">
                                    <rect
                                        width="15.4896"
                                        height="15.5006"
                                        fill="white"
                                        transform="translate(4.25513 4.24969)"
                                    />
                                </clipPath>
                            </defs>
                        </svg>`,
                    class: "remove",
                },
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

        this.val = await this.getVal();
    },
    unmounted() {
        // document.removeEventListener("click", this.hideSelect.bind(this), true);
        document.removeEventListener("keydown", (e) => {
            if (e.keyCode === 27) {
                this.close();
            }
        });
    },
    methods: {
        async getVal() {
            if (this.btcInfo?.btc) {
                let converter = new Converter(
                    this.wallet.value,
                    this.btcInfo.btc.price
                );
                return await converter.coverted();
            }
            return {};
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
.wallets {
    // .wallets__block
    &__block {
        padding: 16px;
        background-color: #fff;
        border-radius: 13px;
        width: 100%;

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
            color: #343434;
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
            width: 100%;
            padding: 12px 0;
            transition: all 0.5s ease;
            @media (max-width: 767.98px) {
                padding: 14px 0;
            }

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
            display: inline-flex;
            align-items: center;
            padding: 0 16px 16px;
            border-bottom: 1px solid #e8ecf2;
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
                color: #343434;
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
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 23.5px;
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

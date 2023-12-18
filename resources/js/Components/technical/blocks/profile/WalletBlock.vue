<template>
    <div
        class="wallets__block wallets__block-wallet"
        @click="changeWalletObj(wallet)"
    >
        <div class="wallets__block_name">
            <div class="wallet-inf">
                <span class="wallet-wallet_address">{{
                    wallet.wallet_address
                }}</span>
            </div>
            <div class="wallets__block_doths">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                >
                    <path
                        d="M12 3C11.1716 3 10.5 3.67157 10.5 4.5C10.5 5.32843 11.1716 6 12 6C12.8284 6 13.5 5.32843 13.5 4.5C13.5 3.67157 12.8284 3 12 3Z"
                        stroke="#D0D5DD"
                        stroke-width="1.5"
                    />
                    <path
                        d="M12 10.5C11.1716 10.5 10.5 11.1716 10.5 12C10.5 12.8284 11.1716 13.5 12 13.5C12.8284 13.5 13.5 12.8284 13.5 12C13.5 11.1716 12.8284 10.5 12 10.5Z"
                        stroke="#D0D5DD"
                        stroke-width="1.5"
                    />
                    <path
                        d="M12 18C11.1716 18 10.5 18.6716 10.5 19.5C10.5 20.3284 11.1716 21 12 21C12.8284 21 13.5 20.3284 13.5 19.5C13.5 18.6716 12.8284 18 12 18Z"
                        stroke="#D0D5DD"
                        stroke-width="1.5"
                    />
                </svg>
                <!--                <main-menu-->
                <!--                    className="wallets__block_doths_menu"-->
                <!--                    :options="options"-->
                <!--                    :opened="opened"-->
                <!--                    @remove="$emit('remove', wallet)"-->
                <!--                    @clicked="changeWalletObj(wallet)"-->
                <!--                ></main-menu>-->
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import MainMenu from "@/modules/common/Components/UI/MainMenu.vue";
import { Converter } from "@/Scripts/converter";

export default {
    name: "WalletBlock",
    components: { MainMenu },
    props: { wallet: Object },
    data() {
        return {
            opened: false,
            converter: null,
        };
    },
    computed: {
        ...mapGetters(["getActive", "btcInfo"]),
    },
    methods: {
        changeWalletObj(wallet) {
            this.$emit("getWallet", wallet);
        },
    },
};
</script>

<style scoped lang="scss">
.wallet-inf {
    display: flex;
    flex-direction: column;
    gap: 8px;
    width: 100%;
}
.wallet-wallet_address {
    color: var(--text-teritary, #98a2b3);
    font-family: NunitoSans, serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
    word-break: break-all;
}

.wallets {
    // .wallets__block
    &__block {
        border-radius: 12px;
        background: var(--background-island-inner-3, #f8fafd);
        box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.01);
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
            color: var(--text-secondary);
            .unit {
                font-weight: 500;
            }
            span {
                padding: 0 16px;
            }
        }
        // .wallets__block-wallet
        &-wallet {
            cursor: pointer;
            &:hover {
                .wallets__block_doths svg path {
                    stroke: var(--svg-hover);
                    //div {
                    //    background-color: var(--text-focus);
                    //}
                }
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
        // .wallets__block_name
        &_name {
            width: 100%;
            padding: 16px;
            display: inline-flex;
            align-items: center;
            gap: 16px;

            img {
                margin-right: 16px;
                width: 24px;
                height: 24px;
                border-radius: 50%;
                @media (max-width: 767.98px) {
                    margin-right: 6px;
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
        // .wallets__block_doths
        &_doths {
            margin-left: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 24px;
            gap: 3px;
            cursor: pointer;
            position: relative;
            & svg path {
                transition: all 0.3s ease 0s;
                stroke: var(--svg-fill);
            }

            @media (max-width: 767.98px) {
                width: 20px;
                gap: 2.5px;
            }

            div {
                width: 4px;
                height: 4px;
                border-radius: 50%;
                background-color: var(--icons-secondary);
                transition: all 0.3s ease;
            }
        }
    }
}
</style>

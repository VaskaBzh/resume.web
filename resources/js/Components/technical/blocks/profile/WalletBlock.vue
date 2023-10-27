<template>
    <div class="wallets__block wallets__block-wallet" @click="changeWalletObj(wallet)">
        <div class="wallets__block_name">
            <div class="wallet-inf">
                <span class="wallet-fullname">{{ wallet.fullName}}</span>
                <span class="wallet-wallet_address">{{ wallet.wallet_address }}</span>
            </div>
            <div class="wallets__block_doths">
                <div></div>
                <div></div>
                <div></div>
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
    },
    methods: {
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
    width: 100%;
}
.wallet-wallet_address{
    color: var(--text-teritary, #98A2B3);
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 145%;
    width: 100%;
    word-break: break-all;
}
.wallet-fullname{
    color: var(--light-gray-500, #667085);
    font-family: Unbounded, serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 150%;
}
.wallets {
    // .wallets__block
    &__block {
        border-radius: 24px;
        background: var(--background-island-inner-3, #F8FAFD);
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
            cursor: pointer;
            &:hover {
                .wallets__block_doths {
                    div {
                        background-color: var(--text-focus);
                    }
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
                background-color: var(--icons-secondary);
                transition: all 0.3s ease;
            }
        }
    }
}
</style>

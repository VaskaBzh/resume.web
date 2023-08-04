<template>
    <div class="wallets" ref="page">
        <main-title class="profile cabinet_title" tag="h3"
            >{{ $t("wallets.title") }}
            <!--                <blue-button class="wallets__button wallets__button-history">-->
            <!--                    <Link :href="route('income')"> Доходы </Link>-->
            <!--                </blue-button>-->
            <!--            <main-checkbox class="wallets__filter" @is_checked="wallets.filter">-->
            <!--                {{ $t("wallets.block.filter") }}-->
            <!--            </main-checkbox>-->
            <blue-button class="add" data-popup="#addWallet">
                <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M3.07031 12.0706C3.07031 11.5183 3.51803 11.0706 4.07031 11.0706H20.0703C20.6226 11.0706 21.0703 11.5183 21.0703 12.0706C21.0703 12.6229 20.6226 13.0706 20.0703 13.0706H4.07031C3.51803 13.0706 3.07031 12.6229 3.07031 12.0706Z"
                    />
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M12.0703 3.07098C12.6226 3.07098 13.0703 3.5187 13.0703 4.07098V20.071C13.0703 20.6233 12.6226 21.071 12.0703 21.071C11.518 21.071 11.0703 20.6233 11.0703 20.071V4.07098C11.0703 3.5187 11.518 3.07098 12.0703 3.07098Z"
                    />
                </svg>
            </blue-button>
        </main-title>
        <div ref="wallets" class="wrap">
            <no-info
                :wait="wallets.waitWallets"
                :interval="70"
                :end="endWallet"
                :empty="emptyWallet"
            >
                <div class="wallets__list">
                    <div class="wallets__block" data-popup="#addWallet">
                        <svg
                            width="40"
                            height="40"
                            viewBox="0 0 40 40"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M11.0703 20.0703C11.0703 19.518 11.518 19.0703 12.0703 19.0703H28.0703C28.6226 19.0703 29.0703 19.518 29.0703 20.0703C29.0703 20.6226 28.6226 21.0703 28.0703 21.0703H12.0703C11.518 21.0703 11.0703 20.6226 11.0703 20.0703Z"
                                fill="url(#paint0_linear_1243_39061)"
                            />
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M20.0703 11.0703C20.6226 11.0703 21.0703 11.518 21.0703 12.0703V28.0703C21.0703 28.6226 20.6226 29.0703 20.0703 29.0703C19.518 29.0703 19.0703 28.6226 19.0703 28.0703V12.0703C19.0703 11.518 19.518 11.0703 20.0703 11.0703Z"
                                fill="url(#paint1_linear_1243_39061)"
                            />
                            <defs>
                                <linearGradient
                                    id="paint0_linear_1243_39061"
                                    x1="13.8715"
                                    y1="22.2233"
                                    x2="22.7908"
                                    y2="13.9877"
                                    gradientUnits="userSpaceOnUse"
                                >
                                    <stop stop-color="#3F7BDD" />
                                    <stop offset="1" stop-color="#4282EC" />
                                </linearGradient>
                                <linearGradient
                                    id="paint1_linear_1243_39061"
                                    x1="17.9174"
                                    y1="13.8715"
                                    x2="26.1529"
                                    y2="22.7908"
                                    gradientUnits="userSpaceOnUse"
                                >
                                    <stop stop-color="#3F7BDD" />
                                    <stop offset="1" stop-color="#4282EC" />
                                </linearGradient>
                            </defs>
                        </svg>

                        {{ $t("wallets.no_info") }}
                    </div>
                </div>
            </no-info>
            <div ref="list" class="wallets__list" v-if="!wallets.waitWallets">
                <wallet-block
                    v-for="(wallet, i) in wallets.wallets"
                    :key="i"
                    v-scroll="'top'"
                    :wallet="wallet"
                    @getWallet="wallets.setForm(wallet)"
                    @remove="wallets.removeWallet(wallet)"
                ></wallet-block>
            </div>
        </div>
    </div>
    <teleport to="body">
        <main-popup
            id="changeWallet"
            :wait="wallets.wait"
            :closed="wallets.closed"
            :errors="errors"
            @closed="wallets.clearForm(wallets.form)"
            v-if="wallets.form"
        >
            <form
                @submit.prevent="wallets.changeWallet"
                class="form form-popup popup__form"
            >
                <main-title tag="h3">
                    {{ $t("wallets.popups.change.title") }}
                </main-title>
                <input
                    v-model="wallets.form.wallet"
                    autofocus
                    disabled
                    type="text"
                    class="input popup__input"
                    :placeholder="
                        $t('wallets.popups.change.placeholders.wallet')
                    "
                />
                <input
                    v-model="wallets.form.name"
                    autofocus
                    type="text"
                    class="input popup__input"
                    :placeholder="$t('wallets.popups.change.placeholders.name')"
                />
                <div class="form_row form_row-non-height">
                    <div class="form_column">
                        <label for="percent" class="main__label">{{
                            $t("wallets.popups.change.labels.percent")
                        }}</label>
                        <input
                            name="percent"
                            v-model="wallets.form.percent"
                            id="percent"
                            autofocus
                            type="text"
                            class="input popup__input"
                            placeholder="100"
                        />
                    </div>
                    <div class="form_column">
                        <label for="min" class="main__label">{{
                            $t("wallets.popups.change.labels.minWithdrawal")
                        }}</label>
                        <input
                            name="minWithdrawal"
                            v-model="wallets.form.minWithdrawal"
                            id="min"
                            autofocus
                            type="text"
                            class="input popup__input"
                            placeholder="0.005"
                        />
                    </div>
                </div>
                <blue-button>
                    <button type="submit" class="all-link">
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 9.64 2 7.4 3.42 5.52C3.67 5.19 4.14 5.13 4.47 5.38C4.8 5.63 4.87 6.1 4.62 6.43C3.4 8.04 2.75 9.97 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75C11.59 2.75 11.25 2.41 11.25 2C11.25 1.59 11.59 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75Z"
                            />
                            <path
                                d="M12 19.75C7.73 19.75 4.25 16.27 4.25 12C4.25 11.59 4.59 11.25 5 11.25C5.41 11.25 5.75 11.59 5.75 12C5.75 15.45 8.55 18.25 12 18.25C15.45 18.25 18.25 15.45 18.25 12C18.25 8.55 15.45 5.75 12 5.75C11.59 5.75 11.25 5.41 11.25 5C11.25 4.59 11.59 4.25 12 4.25C16.27 4.25 19.75 7.73 19.75 12C19.75 16.27 16.27 19.75 12 19.75Z"
                            />
                            <path
                                d="M12 16.75C11.59 16.75 11.25 16.41 11.25 16C11.25 15.59 11.59 15.25 12 15.25C13.79 15.25 15.25 13.79 15.25 12C15.25 10.21 13.79 8.75 12 8.75C11.59 8.75 11.25 8.41 11.25 8C11.25 7.59 11.59 7.25 12 7.25C14.62 7.25 16.75 9.38 16.75 12C16.75 14.62 14.62 16.75 12 16.75Z"
                            />
                        </svg>
                        {{ $t("wallets.popups.change.button") }}
                    </button>
                </blue-button>
            </form>
        </main-popup>
        <main-popup
            id="addWallet"
            :wait="wallets.wait"
            :closed="wallets.closed"
            :errors="errors"
            @closed="wallets.clearForm(wallets.form)"
            v-if="wallets.form"
        >
            <form
                @submit.prevent="wallets.addWallet"
                class="form form-popup popup__form"
            >
                <main-title tag="h3">{{
                    $t("wallets.popups.add.title")
                }}</main-title>
                <input
                    v-model="wallets.form.wallet"
                    required
                    autofocus
                    type="text"
                    class="input popup__input"
                    :placeholder="$t('wallets.popups.add.placeholders.wallet')"
                />
                <input
                    v-model="wallets.form.name"
                    autofocus
                    type="text"
                    class="input popup__input"
                    :placeholder="$t('wallets.popups.add.placeholders.name')"
                />
                <div class="form_row form_row-non-height">
                    <div class="form_column">
                        <label for="percent" class="main__label">{{
                            $t("wallets.popups.add.labels.percent")
                        }}</label>
                        <input
                            name="percent"
                            v-model="wallets.form.percent"
                            id="percentChg"
                            autofocus
                            type="text"
                            class="input popup__input"
                            placeholder="100"
                        />
                    </div>
                    <div class="form_column">
                        <label for="min" class="main__label">{{
                            $t("wallets.popups.add.labels.minWithdrawal")
                        }}</label>
                        <input
                            name="minWithdrawal"
                            v-model="wallets.form.minWithdrawal"
                            id="minChg"
                            autofocus
                            type="text"
                            class="input popup__input"
                            placeholder="0.005"
                        />
                    </div>
                </div>
                <blue-button>
                    <button type="submit" class="all-link">
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 9.64 2 7.4 3.42 5.52C3.67 5.19 4.14 5.13 4.47 5.38C4.8 5.63 4.87 6.1 4.62 6.43C3.4 8.04 2.75 9.97 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75C11.59 2.75 11.25 2.41 11.25 2C11.25 1.59 11.59 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75Z"
                            />
                            <path
                                d="M12 19.75C7.73 19.75 4.25 16.27 4.25 12C4.25 11.59 4.59 11.25 5 11.25C5.41 11.25 5.75 11.59 5.75 12C5.75 15.45 8.55 18.25 12 18.25C15.45 18.25 18.25 15.45 18.25 12C18.25 8.55 15.45 5.75 12 5.75C11.59 5.75 11.25 5.41 11.25 5C11.25 4.59 11.59 4.25 12 4.25C16.27 4.25 19.75 7.73 19.75 12C19.75 16.27 16.27 19.75 12 19.75Z"
                            />
                            <path
                                d="M12 16.75C11.59 16.75 11.25 16.41 11.25 16C11.25 15.59 11.59 15.25 12 15.25C13.79 15.25 15.25 13.79 15.25 12C15.25 10.21 13.79 8.75 12 8.75C11.59 8.75 11.25 8.41 11.25 8C11.25 7.59 11.59 7.25 12 7.25C14.62 7.25 16.75 9.38 16.75 12C16.75 14.62 14.62 16.75 12 16.75Z"
                            />
                        </svg>
                        {{ $t("wallets.popups.add.button") }}
                    </button>
                </blue-button>
            </form>
        </main-popup>
    </teleport>
</template>
<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import WalletBlock from "@/Components/technical/blocks/profile/WalletBlock.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import MainCheckbox from "@/Components/UI/MainCheckbox.vue";
import NoInfo from "@/Components/technical/blocks/NoInfo.vue";
import { mapGetters } from "vuex";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import MainPopup from "@/Components/technical/MainPopup.vue";
import MainInput from "@/Components/UI/inputs/MainInput.vue";

import { WalletService } from "@/services/WalletService";
import {usePage} from "@inertiajs/vue3";

export default {
    components: {
        MainPopup,
        MainCheckbox,
        BlueButton,
        MainTitle,
        NoInfo,
        WalletBlock,
        MainInput,
    },
    layout: profileLayoutView,
    computed: {
        ...mapGetters(["getActive"]),
        endWallet() {
            return this.wallets.wallets?.length > 0;
        },
        emptyWallet() {
            return this.wallets.wallets?.length === 0;
        },
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    data() {
        return {
            // isChecked: false,
            viewportWidth: 0,
            waitWallet: true,
            wallets: [],
            isActiveLabelEmail: false,
            isActiveLabelName: false,
            isActiveLabelMinWithdrawal: false,
        };
    },
    watch: {
        getActive() {
            this.walletInit();
        },
        "wallets.form.percent"(newVal) {
            this.wallets.form.percent = String(newVal).replace(
                /[\u0401\u0451\u0410-\u044f/a-zA-Z]/g,
                ""
            );
        },
        "wallets.form.minWithdrawal"(newVal) {
            this.wallets.form.minWithdrawal = newVal.replace(
                /[\u0401\u0451\u0410-\u044f/a-zA-Z]/g,
                ""
            );
        },
    },
    methods: {
        walletInit() {
            this.wallets = new WalletService();

            this.wallets.index();
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        moveLabelFor(name) {
            switch (name) {
                case "email":
                    this.isActiveLabelEmail = true;
                    break;
                case "name":
                    this.isActiveLabelName = true;
                    break;
                case "minWithdrawal":
                    this.isActiveLabelMinWithdrawal = true;
                    break;
            }
        },
        returnLabelfor(name) {
            switch (name) {
                case "email":
                    if (this.wallets.form.wallet === "")
                        return (this.isActiveLabelEmail = false);
                    break;
                case "name":
                    if (this.wallets.form.name === "")
                        return (this.isActiveLabelName = false);
                    break;
                case "minWithdrawal":
                    if (this.wallets.form.minWithdrawal === "")
                        return (this.isActiveLabelMinWithdrawal = false);
                    break;
            }
        },
    },
    mounted() {
        const { props } = usePage();
        this.wallets = new WalletService(props.csrf);
        this.walletInit();
        document.title = this.$t("header.links.wallets");
        this.$refs.page.style.opacity = 1;
    },
    props: ["errors", "message", "user", "auth_user"],
};
</script>
<style lang="scss">
.wallets {
    width: 100%;
    transition: all 0.3s linear 0.2s;
    opacity: 0;
    .no-info.no-bg {
        padding: 0;
        .wallets {
            &__block {
                display: inline-flex;
                cursor: pointer;
                gap: 8px;
                align-items: center;
                justify-content: center;
                min-height: 140px;
                font-size: 18px;
                font-weight: 400;
                line-height: 135%;
                color: #3f7bdd;
                transition: all 0.5s ease 0s;
            }
        }
    }
    @media (max-width: 1271.98px) {
        transition: all 0.3s ease 0s;
    }
    .title.profile {
        @media (max-width: 767.98px) {
            flex-wrap: wrap;
            gap: 30px;
        }
    }
    // .wallets__filter
    &__filter {
        margin: 0 24px 0 auto;
        @media (max-width: 767.98px) {
            margin: 0;
            justify-content: flex-start !important;
        }
    }

    &__list {
        display: flex;
        gap: 16px;
        transition: all 0.3s ease 0s;
        width: 100%;
        @media (max-width: 1320.98px) {
            grid-template-columns: repeat(3, 1fr);
        }
        @media (max-width: 991.98px) {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        @media (max-width: 767.98px) {
            grid-template-columns: repeat(1, 1fr);
            .wallets__block {
                border-radius: 12px;
                border: none;
            }
        }
    }

    // .wallets__wrap
    .wrap {
        margin-bottom: 40px;

        &:last-child {
            margin-bottom: 0;
            transition: all 0.3s ease;
        }

        &_title {
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
            @media (max-width: 767.98px) {
                margin-bottom: 0;
                &:after {
                    content: none;
                }
                flex-wrap: wrap;
                gap: 12px;
            }
        }
    }

    &__block {
        padding: 16px;
        background: #fafafa;
        border-radius: 12px;
        width: 100%;
        @media (max-width: 767.98px) {
            padding: 10px 0 10px;
            border-top: 1px solid #d7d8d9;
            border-radius: 0;

            &:first-child {
                border-top: none;
            }
        }
    }

    // .wallets__column
    &__column {
        display: flex;
        flex-direction: column;
        @media (max-width: 767.98px) {
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }
        @media (max-width: 479.98px) {
            gap: 0;
            flex-direction: column;
            align-items: flex-start;
        }
    }

    // .wallets__buttons
    &__buttons {
        display: flex;
        gap: 16px;
        @media (max-width: 767.98px) {
            width: 100%;
            justify-content: space-between;
            gap: 11px;
        }
    }
}
.wallets-popup-btn {
    margin-top: 25px;
}
.input-container {
    position: relative;
}
.input-label {
    position: absolute;
    top: 17px;
    left: 15px;
    z-index: 1;
    transition-timing-function: ease-in-out;
    transition-duration: 0.3s;
    cursor: text;
    color: rgba(197, 197, 197, 1);
}
.move-label {
    transform: translate(-1px, -21px);
    font-size: 12px;
    transition-timing-function: ease-in-out;
    transition-duration: 0.3s;
    background: rgba(250, 250, 250, 1);
}
.input-wallet {
    width: 100%;
    padding: 0 12px;
    border-radius: 8px;
    font-weight: 300;
    font-size: 14px;
    line-height: 115%;
    outline: none;
    display: inline-flex;
    align-items: center;
    min-height: 48px;
    background: rgba(250, 250, 250, 1);
    border: 1px solid rgba(197, 197, 197, 1);
    color: black;
    transition-timing-function: ease-in-out;
    transition-duration: 0.3s;
    &:focus {
        & + .move-label {
            color: rgba(83, 137, 225, 1);
        }
    }
}
.input-minWithdrawal {
    text-align: end;
    padding-right: 40px;
    transition-timing-function: ease-in-out;
    transition-duration: 0.3s;
}
.input-minWithdrawal:focus {
    transition-timing-function: ease-in-out;
    transition-duration: 0.5s;
    padding-right: 80%;
}
.input-btc-text {
    position: absolute;
    right: 10px;
    top: 17px;
}
input:focus {
    border: 1px solid rgba(83, 137, 225, 1);
    background: rgba(250, 250, 250, 1);
}
.input-error {
    color: red;
    font-size: 12px;
    margin-top: 4px;
    transition: all 0.4s ease;
}
.error-input {
    border: 1px solid rgba(237, 24, 24, 1);
    transition: all 0.4s ease;
    animation: shake 0.5s;
}
@keyframes shake {
    0% {
        transform: translate(1px, 1px) rotate(0deg);
        box-shadow: 0 0 0px red;
    }
    10% {
        transform: translate(0px, -1px) rotate(-1deg);
    }
    20% {
        transform: translate(-2px, 1px) rotate(1deg);
    }
    30% {
        transform: translate(1px, 0px) rotate(0deg);
        box-shadow: 0 0 7px red;
    }
}
.form-wallet {
    padding: 5px;
}
</style>

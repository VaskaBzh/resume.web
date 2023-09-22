<template>
    <div class="wallets" ref="page">
        <div class="wallet-wrapper">
            <div class="autopayout-component">
                <div class="header-component-wallet">
                    <main-title class="" tag="h3"
                    >{{ $t("wallets.title[0]") }}
                    </main-title>
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M7.66025 11.3326C7.66025 11.6087 7.88411 11.8326 8.16025 11.8326C8.4364 11.8326 8.66025 11.6087 8.66025 11.3326H7.66025ZM7.49359 6.83255C7.21744 6.83255 6.99359 7.05641 6.99359 7.33255C6.99359 7.60869 7.21744 7.83255 7.49359 7.83255V6.83255ZM8.06262 7.43018L8.41618 7.07663L8.06262 7.43018ZM7.99346 4.83255C7.71732 4.83255 7.49346 5.05641 7.49346 5.33255C7.49346 5.60869 7.71732 5.83255 7.99346 5.83255V4.83255ZM7.99945 5.83255C8.27559 5.83255 8.49945 5.60869 8.49945 5.33255C8.49945 5.05641 8.27559 4.83255 7.99945 4.83255V5.83255ZM7.99886 13.8327C6.49194 13.8327 5.41206 13.8316 4.59079 13.7212C3.78391 13.6127 3.30194 13.407 2.94658 13.0516L2.23947 13.7587C2.8116 14.3309 3.53977 14.5889 4.45754 14.7123C5.36093 14.8337 6.52021 14.8327 7.99886 14.8327V13.8327ZM1.16553 7.99935C1.16553 9.47799 1.16447 10.6373 1.28592 11.5407C1.40931 12.4584 1.66734 13.1866 2.23947 13.7587L2.94658 13.0516C2.59121 12.6963 2.38549 12.2143 2.27701 11.4074C2.16659 10.5862 2.16553 9.50626 2.16553 7.99935H1.16553ZM13.8322 7.99935C13.8322 9.50626 13.8311 10.5862 13.7207 11.4074C13.6122 12.2143 13.4065 12.6963 13.0511 13.0516L13.7583 13.7587C14.3304 13.1866 14.5884 12.4584 14.7118 11.5407C14.8333 10.6373 14.8322 9.47799 14.8322 7.99935H13.8322ZM7.99886 14.8327C9.47751 14.8327 10.6368 14.8337 11.5402 14.7123C12.458 14.5889 13.1861 14.3309 13.7583 13.7587L13.0511 13.0516C12.6958 13.407 12.2138 13.6127 11.4069 13.7212C10.5857 13.8316 9.50578 13.8327 7.99886 13.8327V14.8327ZM7.99886 2.16602C9.50578 2.16602 10.5857 2.16708 11.4069 2.27749C12.2138 2.38598 12.6958 2.5917 13.0511 2.94706L13.7583 2.23996C13.1861 1.66783 12.458 1.4098 11.5402 1.28641C10.6368 1.16495 9.47751 1.16602 7.99886 1.16602V2.16602ZM14.8322 7.99935C14.8322 6.5207 14.8333 5.36142 14.7118 4.45803C14.5884 3.54026 14.3304 2.81209 13.7583 2.23996L13.0511 2.94706C13.4065 3.30243 13.6122 3.7844 13.7207 4.59128C13.8311 5.41254 13.8322 6.49243 13.8322 7.99935H14.8322ZM7.99886 1.16602C6.52021 1.16602 5.36093 1.16495 4.45754 1.28641C3.53977 1.4098 2.8116 1.66783 2.23947 2.23996L2.94658 2.94706C3.30194 2.5917 3.78391 2.38598 4.59079 2.27749C5.41206 2.16708 6.49194 2.16602 7.99886 2.16602V1.16602ZM2.16553 7.99935C2.16553 6.49243 2.16659 5.41254 2.27701 4.59128C2.38549 3.7844 2.59121 3.30243 2.94658 2.94706L2.23947 2.23996C1.66734 2.81209 1.40931 3.54026 1.28592 4.45803C1.16447 5.36142 1.16553 6.5207 1.16553 7.99935H2.16553ZM7.66025 7.99922V11.3326H8.66025V7.99922H7.66025ZM7.49359 7.83255C7.57401 7.83255 7.63589 7.83258 7.68874 7.83392C7.74184 7.83526 7.77341 7.8377 7.79272 7.8403C7.81171 7.84285 7.80533 7.84389 7.78648 7.83614C7.76364 7.82674 7.73497 7.80964 7.70907 7.78374L8.41618 7.07663C8.25898 6.91943 8.07218 6.86887 7.92597 6.84921C7.79414 6.83149 7.63659 6.83255 7.49359 6.83255V7.83255ZM8.66025 7.99922C8.66025 7.85622 8.66132 7.69867 8.64359 7.56684C8.62393 7.42062 8.57338 7.23383 8.41618 7.07663L7.70907 7.78374C7.68317 7.75784 7.66607 7.72917 7.65667 7.70632C7.64891 7.68747 7.64996 7.6811 7.65251 7.70009C7.6551 7.71939 7.65755 7.75097 7.65889 7.80407C7.66022 7.85691 7.66025 7.91879 7.66025 7.99922H8.66025ZM7.99346 5.83255H7.99945V4.83255H7.99346V5.83255Z" fill="#D0D5DD"/>
                        </svg>
                    </button>
                </div>
                <div class="form_column">
                        <div class="autopayout-container">
                            <input
                            name="minWithdrawal"
                            id="min"
                            type="text"
                            class="input popup__input autopayout-input"
                            placeholder="0.005"
                        />
                        <label for="min" class="main__label autopayout-label">{{
                            $t("wallets.popups.change.labels.minWithdrawal")
                        }}</label>
                        <span class="autopayout-btc">BTC</span>
                        </div>
                </div>
            </div>
        <main-title class="header-component-wallet" tag="h3"
            >{{ $t("wallets.title[1]") }}
        </main-title>
        <div ref="wallets" class="wrap">
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
        <div class="blue-button-container">
            <button class="add" data-popup="#addWallet">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12 4V20M4 12H20" stroke="#98A2B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
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
                <main-title tag="h3" class="change-label_title">
                    {{ $t("wallets.popups.change.title") }}
                </main-title>
                <div class="autopayout-input_container">
                    <label class="label-popup"> {{$t('wallets.popups.add.placeholders.wallet')}} </label>
                    <input
                    v-model="wallets.form.wallet"
                    autofocus
                    disabled
                    type="text"
                    class="input popup__input autopayput_input"
                    :placeholder="
                        $t('wallets.popups.change.placeholders.wallet')
                    "
                />
                </div>
                <div class="autopayout-input_container">
                    <label class="label-popup"> {{$t('wallets.popups.add.placeholders.name')}} </label>
                <input
                    v-model="wallets.form.name"
                    autofocus
                    type="text"
                    class="input popup__input  autopayput_input"
                    :placeholder="$t('wallets.popups.change.placeholders.name')"
                />
                </div>
                    <button type="submit" class="all-link change-autopyout_button">
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
                }}
                <p class="wallet-description">{{$t("wallets.popups.note")  }}</p>

            </main-title>
                <div class="autopayout-input_container">
                    <label class="label-popup"> {{$t('wallets.popups.add.placeholders.wallet')}} </label>
                    <input
                    v-model="wallets.form.wallet"
                    required
                    autofocus
                    type="text"
                    :placeholder="$t('wallets.popups.add.placeholders.wallet')"
                    class="input popup__input autopayput_input"

                />
                </div>
                <div class="autopayout-input_container">
                    <label class="label-popup"> {{$t('wallets.popups.add.placeholders.name')}} </label>
                <input
                    v-model="wallets.form.name"
                    type="text"
                    :placeholder="$t('wallets.popups.add.placeholders.name')"
                    class="input popup__input  autopayput_input"
                />
                </div>
                <button type="submit" class="all-link change-autopyout_button">
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
            </form>
        </main-popup>
        <main-popup
            id="removeWallet"
            :wait="wallets.wait"
            :closed="wallets.closed"
            :errors="errors"
            @closed="wallets.clearForm(wallets.form)"
            v-if="wallets.form"
        >
            <main-title tag="h3">
                        {{ $t("wallets.popups.remove.title") }}
            </main-title>
            <p class="wallet-description">{{$t("wallets.popups.remove.note")}}</p>
            <div class="wallet__remove-inf-container">
                <img src="../../../assets/img/wallet-icon.png">
                <div class="wallet-inf">
                    <span class="wallet-fullname">{{ wallets.form.name}}</span>
                    <span class="wallet-wallet_address">{{ wallets.form.wallet }}</span>
                </div>
            </div>
            <div class="wallet__remove-button-container">
                <button class="button_wallet cancel-button">{{$t("wallets.popups.remove.button[0]")  }}</button>
                <button class="button_wallet remove-button">{{$t("wallets.popups.remove.button[1]")  }}</button>
            </div>
        </main-popup>
    </teleport>
</template>
<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import WalletBlock from "@/Components/technical/blocks/profile/WalletBlock.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import MainPreloader from "@/modules/preloader/Components/MainPreloader.vue";
import { mapGetters } from "vuex";
import MainPopup from "@/modules/popup/Components/MainPopup.vue";

import { WalletService } from "@/services/WalletService";
import { usePage } from "@inertiajs/vue3";

export default {
    components: {
        MainPopup,
        MainButton,
        MainTitle,
        WalletBlock,
    },
    computed: {
        ...mapGetters(["getActive", "errors"]),
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
            this.wallets = new WalletService(this.$t);

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
        this.wallets = new WalletService(this.$t);
        console.log(this.wallets.form.minWithdrawal)
        this.walletInit();
        document.title = this.$t("header.links.wallets");
        this.$refs.page.style.opacity = 1;
    },
    props: ["message", "auth_user"],
};
</script>
<style lang="scss">
.change-label_title{
    margin-bottom: 24px;
}
.change-label_button{
    margin-top: 80px;
}
.wallet-inf{
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.wallet-wallet_address{
    color: var(--light-gray-400, #98A2B3);
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
.header-component-wallet{
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    margin-bottom: 24px;
}
.autopayout-component{
    margin-bottom: 40px;
}
.autopayout-container{
    position: relative;
    width: 100%;
}
.wallet__remove-inf-container{
    display: flex;
    align-items: center;
    gap: 16px;
    border-radius: 24px;
    background: var(--light-secondary-wb, #FFF);
    padding: 16px 24px;
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
}
.autopayout-btc{
    color: var(--light-gray-400, #98A2B3);
    font-family: NunitoSans;
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: 150%; /* 24px */
    position: absolute;
    top: 16px;
    right: 16px;
}
.autopayout-label{
    position: absolute;
    top: 8px;
    left: 16px;
    color: var(--light-gray-400, #98A2B3);
    font-family: NunitoSans;
    font-size: 12px;
    font-style: normal;
    font-weight: 400;
    line-height: 135%; /* 16.2px */
}
.autopayout-input{
    border: none;
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--light-background-first, #F8FAFD);
    padding: 24px 0 0 16px;
    width: 100%;
    height: 56px;
    outline: none;
}
input:focus{
    border: none !important;
    outline: none !important;
    background: none !important;
}
.button-container{
    margin-top: 80px;
}
.add{
    border-radius: 12px;
    background: var(--buttons-island-inner-fill-border-default-day, #F8FAFD);
    padding: 12px;
    box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.01);
    display: flex;
    align-items: center;
}
.wallet-description{
    color: var(--light-gray-400, #98A2B3);
    font-family: NunitoSans;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%; /* 24px */
    margin: 8px 0 24px;
}
.wallet-wrapper{
    border-radius: 24px;
    background: var(--light-secondary-wb, #FFF);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    width: 560px;
    padding: 32px 40px;
}
.blue-button-container{
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.wallet__remove-button-container{
    display: flex;
    width: 100%;
    justify-content: space-between;
    margin-top: 92px;
}
.button_wallet{
    border-radius: 12px;
    padding: 12px 16px;
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: 175%; /* 31.5px */
    width: 48%;
}
.autopayout-input_container{
    display: flex;
    margin-bottom: 12px;
    flex-direction: column;
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--background-modal-input-day, #FFF);
    padding: var(--pt-3, 12px) var(--pr-4, 16px) var(--pb-2, 8px) var(--pl-4, 16px);
}
.change-autopyout_button{
    border-radius: 12px;
    background: var(--buttons-primary-fill-border-default, #2E90FA);
    box-shadow: 0px 10px 10px -6px rgba(0, 0, 0, 0.10);
    padding: 12px 16px;
    color: var(--buttons-primary-text, #FFF);
    font-family: NunitoSans;
    margin: 36px 0 0;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: 32px; /* 177.778% */
}
.autopayput_input{
   background: inherit;
}
.cancel-button{
    border: 1px solid var(--light-gray-400, #98A2B3);
    color: var(--light-gray-600, #475467);
}
.remove-button{
    color: var(--light-secondary-wb, #FFF);
    background: var(--light-red-100, #F1404A);
    box-shadow: 0px 10px 10px -6px rgba(0, 0, 0, 0.10);
}
.wallets {
    display: flex;
    padding: 24px;
    align-items: center;
    justify-content: center;
    height: calc(100vh - 132px);
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
.label-popup{
    color: var(--text-teritary-day, #98A2B3);
    font-family: NunitoSans;
    font-size: 12px;
    font-style: normal;
    font-weight: 400;
    line-height: 16px; /* 133.333% */
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

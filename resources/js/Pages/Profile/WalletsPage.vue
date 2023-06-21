<template>
    <div class="hint">
        <div class="hint_item" v-hide="mess !== ''">
            {{ this.mess }}
        </div>
    </div>
    <div class="wallets" ref="page">
        <main-title class="profile cabinet_title" tag="h3"
            >{{ $t("wallets.title") }}
            <!--                <blue-button class="wallets__button wallets__button-history">-->
            <!--                    <Link :href="route('income')"> Доходы </Link>-->
            <!--                </blue-button>-->
            <main-checkbox
                class="wallets__filter"
                @is_checked="checkboxer"
            >
                {{ $t("wallets.block.filter") }}
            </main-checkbox>
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
                ref="noInfo"
                :wait="getWallet"
                :empty="wallets"
            ></no-info>
            <div
                ref="list"
                class="wallets__list"
                v-if="wallets.length > 0"
            >
                <wallet-block
                    v-for="(wallet, i) in wallets"
                    :key="i"
                    v-scroll="'top'"
                    :wallet="wallet"
                    @getWallet="changeWallet(wallet)"
                    @getMessage="setMessage"
                ></wallet-block>
            </div>
        </div>
    </div>
    <main-popup id="changeWallet" :wait="wait" :closed="closed">
        <div
            v-for="(error, i) in errs"
            :key="i"
            class="form_wrapper-message"
        >
            <div class="form_message" v-if="error">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="25"
                    height="24"
                    viewBox="0 0 25 24"
                    fill="none"
                >
                    <path
                        d="M12.5 16C12.3022 16 12.1088 16.0587 11.9444 16.1686C11.7799 16.2784 11.6518 16.4346 11.5761 16.6173C11.5004 16.8001 11.4806 17.0011 11.5192 17.1951C11.5578 17.3891 11.653 17.5673 11.7929 17.7071C11.9327 17.847 12.1109 17.9422 12.3049 17.9808C12.4989 18.0194 12.6999 17.9996 12.8827 17.9239C13.0654 17.8482 13.2216 17.72 13.3314 17.5556C13.4413 17.3911 13.5 17.1978 13.5 17C13.5 16.7348 13.3946 16.4805 13.2071 16.2929C13.0195 16.1054 12.7652 16 12.5 16ZM23.17 17.47L15.12 3.47003C14.8598 3.00354 14.4798 2.61498 14.0192 2.3445C13.5586 2.07401 13.0341 1.9314 12.5 1.9314C11.9658 1.9314 11.4414 2.07401 10.9808 2.3445C10.5202 2.61498 10.1402 3.00354 9.87997 3.47003L1.87997 17.47C1.61076 17.924 1.46611 18.441 1.46061 18.9688C1.45511 19.4966 1.58897 20.0166 1.84865 20.4761C2.10834 20.9356 2.48467 21.3185 2.93965 21.5861C3.39463 21.8536 3.91215 21.9964 4.43997 22H20.56C21.092 22.0053 21.6159 21.8689 22.0779 21.6049C22.5399 21.341 22.9233 20.9589 23.1889 20.4978C23.4546 20.0368 23.5928 19.5134 23.5895 18.9814C23.5861 18.4493 23.4414 17.9277 23.17 17.47ZM21.44 19.47C21.3523 19.626 21.2244 19.7556 21.0697 19.8453C20.9149 19.935 20.7389 19.9815 20.56 19.98H4.43997C4.26108 19.9815 4.08507 19.935 3.93029 19.8453C3.7755 19.7556 3.64762 19.626 3.55997 19.47C3.4722 19.318 3.42599 19.1456 3.42599 18.97C3.42599 18.7945 3.4722 18.622 3.55997 18.47L11.56 4.47003C11.6439 4.30623 11.7714 4.16876 11.9284 4.07277C12.0854 3.97678 12.2659 3.92599 12.45 3.92599C12.634 3.92599 12.8145 3.97678 12.9715 4.07277C13.1286 4.16876 13.2561 4.30623 13.34 4.47003L21.39 18.47C21.4892 18.6199 21.5462 18.7937 21.555 18.9732C21.5638 19.1527 21.5241 19.3312 21.44 19.49V19.47ZM12.5 8.00003C12.2348 8.00003 11.9804 8.10538 11.7929 8.29292C11.6053 8.48046 11.5 8.73481 11.5 9.00003V13C11.5 13.2652 11.6053 13.5196 11.7929 13.7071C11.9804 13.8947 12.2348 14 12.5 14C12.7652 14 13.0195 13.8947 13.2071 13.7071C13.3946 13.5196 13.5 13.2652 13.5 13V9.00003C13.5 8.73481 13.3946 8.48046 13.2071 8.29292C13.0195 8.10538 12.7652 8.00003 12.5 8.00003Z"
                    />
                </svg>
                {{ error[0] }}
            </div>
        </div>
        <form @submit.prevent="change" class="form form-popup popup__form">
            <main-title tag="h3">
                {{ $t("wallets.popups.change.title") }}
            </main-title>
            <input
                v-model="formChg.wallet"
                autofocus
                disabled
                type="text"
                class="input popup__input"
                :placeholder="$t('wallets.popups.change.placeholders.wallet')"
            />
            <input
                v-model="formChg.name"
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
                        @input="handleInputChange"
                        v-model="formChg.percent"
                        id="percent"
                        autofocus
                        type="text"
                        class="input popup__input"
                        placeholder="100%"
                    />
                </div>
                <div class="form_column">
                    <label for="min" class="main__label">{{
                        $t("wallets.popups.change.labels.minWithdrawal")
                    }}</label>
                    <input
                        name="minWithdrawal"
                        @input="handleInputChange"
                        v-model="formChg.minWithdrawal"
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
    <main-popup id="addWallet" :wait="wait" :closed="closed">
        <div v-for="(error, i) in err" :key="i" class="form_wrapper-message">
            <div class="form_message" v-if="error">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="25"
                    height="24"
                    viewBox="0 0 25 24"
                    fill="none"
                >
                    <path
                        d="M12.5 16C12.3022 16 12.1088 16.0587 11.9444 16.1686C11.7799 16.2784 11.6518 16.4346 11.5761 16.6173C11.5004 16.8001 11.4806 17.0011 11.5192 17.1951C11.5578 17.3891 11.653 17.5673 11.7929 17.7071C11.9327 17.847 12.1109 17.9422 12.3049 17.9808C12.4989 18.0194 12.6999 17.9996 12.8827 17.9239C13.0654 17.8482 13.2216 17.72 13.3314 17.5556C13.4413 17.3911 13.5 17.1978 13.5 17C13.5 16.7348 13.3946 16.4805 13.2071 16.2929C13.0195 16.1054 12.7652 16 12.5 16ZM23.17 17.47L15.12 3.47003C14.8598 3.00354 14.4798 2.61498 14.0192 2.3445C13.5586 2.07401 13.0341 1.9314 12.5 1.9314C11.9658 1.9314 11.4414 2.07401 10.9808 2.3445C10.5202 2.61498 10.1402 3.00354 9.87997 3.47003L1.87997 17.47C1.61076 17.924 1.46611 18.441 1.46061 18.9688C1.45511 19.4966 1.58897 20.0166 1.84865 20.4761C2.10834 20.9356 2.48467 21.3185 2.93965 21.5861C3.39463 21.8536 3.91215 21.9964 4.43997 22H20.56C21.092 22.0053 21.6159 21.8689 22.0779 21.6049C22.5399 21.341 22.9233 20.9589 23.1889 20.4978C23.4546 20.0368 23.5928 19.5134 23.5895 18.9814C23.5861 18.4493 23.4414 17.9277 23.17 17.47ZM21.44 19.47C21.3523 19.626 21.2244 19.7556 21.0697 19.8453C20.9149 19.935 20.7389 19.9815 20.56 19.98H4.43997C4.26108 19.9815 4.08507 19.935 3.93029 19.8453C3.7755 19.7556 3.64762 19.626 3.55997 19.47C3.4722 19.318 3.42599 19.1456 3.42599 18.97C3.42599 18.7945 3.4722 18.622 3.55997 18.47L11.56 4.47003C11.6439 4.30623 11.7714 4.16876 11.9284 4.07277C12.0854 3.97678 12.2659 3.92599 12.45 3.92599C12.634 3.92599 12.8145 3.97678 12.9715 4.07277C13.1286 4.16876 13.2561 4.30623 13.34 4.47003L21.39 18.47C21.4892 18.6199 21.5462 18.7937 21.555 18.9732C21.5638 19.1527 21.5241 19.3312 21.44 19.49V19.47ZM12.5 8.00003C12.2348 8.00003 11.9804 8.10538 11.7929 8.29292C11.6053 8.48046 11.5 8.73481 11.5 9.00003V13C11.5 13.2652 11.6053 13.5196 11.7929 13.7071C11.9804 13.8947 12.2348 14 12.5 14C12.7652 14 13.0195 13.8947 13.2071 13.7071C13.3946 13.5196 13.5 13.2652 13.5 13V9.00003C13.5 8.73481 13.3946 8.48046 13.2071 8.29292C13.0195 8.10538 12.7652 8.00003 12.5 8.00003Z"
                    />
                </svg>
                {{ error[0] }}
            </div>
        </div>
        <form @submit.prevent="addWallet" class="form form-popup popup__form">
            <main-title tag="h3">{{
                $t("wallets.popups.add.title")
            }}</main-title>
            <input
                v-model="form.wallet"
                required
                autofocus
                type="text"
                class="input popup__input"
                :placeholder="$t('wallets.popups.add.placeholders.wallet')"
            />
            <input
                v-model="form.name"
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
                        @input="handleInputChange"
                        v-model="form.percent"
                        id="percentChg"
                        autofocus
                        type="text"
                        class="input popup__input"
                        placeholder="100%"
                    />
                </div>
                <div class="form_column">
                    <label for="min" class="main__label">{{
                        $t("wallets.popups.add.labels.minWithdrawal")
                    }}</label>
                    <input
                        name="minWithdrawal"
                        @input="handleInputChange"
                        v-model="form.minWithdrawal"
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
</template>
<script>
import axios from "axios";
import MainTitle from "@/Components/UI/MainTitle.vue";
import WalletBlock from "@/Components/technical/blocks/profile/WalletBlock.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import MainCheckbox from "@/Components/UI/MainCheckbox.vue";
import NoInfo from "@/Components/technical/blocks/NoInfo.vue";
import { mapGetters } from "vuex";
import Vue from "lodash";
import { Link } from "@inertiajs/vue3";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import MainPopup from "@/Components/technical/MainPopup.vue";

export default {
    components: {
        MainPopup,
        MainCheckbox,
        BlueButton,
        MainTitle,
        Link,
        NoInfo,
        WalletBlock,
    },
    layout: profileLayoutView,
    computed: {
        errs() {
            let errs = this.errors || {};
            errs = Object.values(errs).filter((el) => el !== "");
            return errs;
        },
        ...mapGetters([
            "getIncome",
            "allAccounts",
            "allHistoryForDays",
            "getActive",
            "getWallet",
        ]),
        wallets() {
            let arr = [];
            if (
                this.getWallet[this.getActive] &&
                Object.values(this.getWallet[this.getActive]).length > 0
            ) {
                if (this.isChecked) {
                    Object.values(this.getWallet[this.getActive]).forEach(
                        (wal, i) => {
                            let val = 0;
                            if (wal) {
                                if (wal.payment) {
                                    val = wal.payment;
                                }
                                if (val > 0) {
                                    let name = wal.wallet;
                                    if (wal.name) {
                                        name = wal.name;
                                    }
                                    let fullName = "";
                                    if (name.length > 11) {
                                        fullName = name;
                                        name =
                                            name.substr(0, 4) +
                                            "..." +
                                            name.substr(
                                                name.length - 4,
                                                name.length
                                            );
                                    }
                                    let walletModel = {
                                        img: "bitcoin_img.png",
                                        name: name,
                                        wallet: wal.wallet,
                                        fullName: fullName,
                                        shortName: "BTC",
                                        value: val,
                                        dollarValue: 0,
                                        rubleValue: 0,
                                        percent: wal.percent,
                                    };
                                    Vue.set(arr, i, walletModel);
                                }
                            }
                        }
                    );
                } else {
                    Object.values(this.getWallet[this.getActive]).forEach(
                        (wal, i) => {
                            let val = 0;
                            if (wal) {
                                if (wal.payment) {
                                    val = wal.payment;
                                }
                                let name = wal.wallet;
                                if (wal.name) {
                                    name = wal.name;
                                }
                                let fullName = "";
                                if (name.length > 11) {
                                    fullName = name;
                                    name =
                                        name.substr(0, 4) +
                                        "..." +
                                        name.substr(
                                            name.length - 4,
                                            name.length
                                        );
                                }
                                let walletModel = {
                                    img: "bitcoin_img.png",
                                    name: name,
                                    wallet: wal.wallet,
                                    fullName: fullName,
                                    shortName: "BTC",
                                    value: val,
                                    dollarValue: 0,
                                    rubleValue: 0,
                                    percent: wal.percent,
                                    minWithdrawal: wal.minWithdrawal,
                                };
                                Vue.set(arr, i, walletModel);
                            }
                        }
                    );
                }
            }
            return arr;
        },
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    data() {
        return {
            miningCash: 0,
            isChecked: false,
            viewportWidth: 0,
            err: {},
            mess: "",
            wait: false,
            form: {
                name: "",
                wallet: "",
                percent: 100,
                minWithdrawal: 0.005,
            },
            formChg: {
                name: "",
                percent: 100,
                minWithdrawal: 0.005,
            },
            walletObj: {},
            closed: false,
        };
    },
    methods: {
        setMessage(message) {
            this.mess = message;
            setTimeout(() => (this.mess = ""), 3000);
        },
        changeWallet(wallet) {
            this.walletObj = wallet;
            this.formChg.percent = wallet.percent;
            this.formChg.minWithdrawal = wallet.minWithdrawal;
            this.formChg.wallet = wallet.wallet;
            wallet.fullName === ""
                ? (this.formChg.name = wallet.name)
                : (this.formChg.name = wallet.fullName);
        },
        change() {
            this.wait = true;
            let wallet = this.walletObj;
            wallet.group_id = this.getActive;
            wallet.percent = this.formChg.percent;
            wallet.minWithdrawal = this.formChg.minWithdrawal;
            wallet.name = this.formChg.name;
            axios
                .post("/wallet_change", wallet)
                .then((res) => {
                    this.mess = res.data.message;
                    this.$store.dispatch("getWallets", wallet);
                    this.wait = false;
                    this.formChg.percent = "";
                    this.formChg.minWithdrawal = "";
                    this.formChg.name = "";
                    setTimeout(() => {
                        this.closed = true;
                    }, 300);
                    setTimeout(() => {
                        this.closed = false;
                    }, 600);
                })
                .catch((err) => {
                    this.wait = false;
                    this.mess = err.response.data.message;
                });
            setTimeout(() => (this.mess = ""), 3000);
        },
        removeLetters(input) {
            const letterRegExp = /[a-zA-Z]/g;
            let fin = input.replace(letterRegExp, "");
            if (fin[0] === "0" && fin[1] !== "." && fin[1] !== undefined) {
                fin = "0.";
            }
            return fin;
        },
        handleInputChange(event) {
            const { name, value } = event.target;
            this.form[name] = this.removeLetters(value);
        },
        addWallet() {
            if (this.wallets && this.getActive !== -1) {
                this.wait = true;
                let per = 0;
                this.wallets.forEach((wal) => {
                    per = per + wal["percent"];
                });
                let obj = this.form;
                per = per + Number(obj.percent);
                obj.group_id = this.getActive;
                axios
                    .post("/wallet_create", this.form)
                    .then((res) => {
                        this.wait = false;
                        let group = this.allAccounts[this.getActive];
                        group.group_id = this.allAccounts[this.getActive].id;
                        this.$store.dispatch("getWallets", group);
                        setTimeout(() => {
                            this.closed = true;
                        }, 300);
                        setTimeout(() => {
                            this.closed = false;
                        }, 600);
                    })
                    .catch((err) => {
                        this.wait = false;
                        if (err.response) {
                            this.err = {};
                            this.err = err.response.data.errors;
                        }
                    });
            } else {
                this.err = {};
                this.err = { 0: ["Попробуйте через 5 секунд"] };
            }
        },
        checkboxer(is_checked) {
            this.isChecked = is_checked;
            // setTimeout(() => {
            //     if (this.$refs.list) {
            //         if (this.viewportWidth > 768) {
            //             setTimeout(() => {
            //                 this.$refs.wallets.style.height =
            //                     48 + 46 + this.$refs.list.offsetHeight + "px";
            //             }, 1);
            //         } else {
            //             setTimeout(() => {
            //                 this.$refs.wallets.style.height =
            //                     40 + 132 + this.$refs.list.offsetHeight + "px";
            //             }, 1);
            //         }
            //     } else {
            //         if (this.viewportWidth > 768) {
            //             setTimeout(() => {
            //                 this.$refs.wallets.style.height =
            //                     48 + 46 + this.$refs.noInfo.offsetHeight + "px";
            //             }, 1);
            //         } else {
            //             setTimeout(() => {
            //                 this.$refs.wallets.style.height =
            //                     40 +
            //                     132 +
            //                     this.$refs.noInfo.offsetHeight +
            //                     "px";
            //             }, 1);
            //         }
            //     }
            // }, 100);
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
    },
    mounted() {
        document.title = "Кошельки";
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
    @media (max-width: 1271.98px) {
        transition: all 0.3s ease 0s;
    }
    .title.profile {
        @media (max-width: 767.98px) {
            flex-wrap: wrap;
        }
    }
    // .wallets__filter
    &__filter {
        margin: 0 24px 0 auto;
        @media (max-width: 767.98px) {
            width: 80%;
            margin: 0;
            justify-content: flex-start !important;
            &:before {
                left: 213px;
            }
            &.checked {
                &:before {
                    left: 233px;
                }
            }
        }
        @media (max-width: 479.98px) {
            width: 90%;
            &:before {
                left: 212px;
            }
            &.checked {
                &:before {
                    left: 227px;
                }
            }
        }
    }

    &__list {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        transition: all 0.3s ease 0s;
        width: 100%;
        @media (max-width: 1320.98px) {
            grid-template-columns: repeat(3, 1fr);
        }
        @media (max-width: 767.98px) {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            .wallets__block {
                border-radius: 12px;
                border: none;
            }
        }
        @media (max-width: 479.98px) {
            grid-template-columns: repeat(1, 1fr);
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
        background-color: #fff;
        border-radius: 13px;
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
</style>

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
            <main-checkbox class="wallets__filter" @is_checked="checkboxer">
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
                :wait="waitWallet"
                :interval="70"
                :end="endWallet"
                :empty="emptyWallet"
            ></no-info>
            <div ref="list" class="wallets__list" v-if="!waitWallet">
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
    <teleport to="body">
        <main-popup
            id="changeWallet"
            :wait="wait"
            :closed="closed"
            :errors="err"
        >
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
                    :placeholder="
                        $t('wallets.popups.change.placeholders.wallet')
                    "
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
        <main-popup id="addWallet" :wait="wait" :closed="closed" :errors="err">
            <form
                @submit.prevent="addWallet"
                class="form form-popup popup__form"
            >
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
    </teleport>
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
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import MainPopup from "@/Components/technical/MainPopup.vue";

export default {
    components: {
        MainPopup,
        MainCheckbox,
        BlueButton,
        MainTitle,
        NoInfo,
        WalletBlock,
    },
    layout: profileLayoutView,
    computed: {
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
                                        img: "bitcoin_img.webp",
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
                                    img: "bitcoin_img.webp",
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
        endWallet() {
            return this.wallets.length > 0;
        },
        emptyWallet() {
            return this.wallets.length === 0;
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
            waitWallet: true,
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
                    this.err = err.response.data.message;
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
                this.err = { 0: "Попробуйте через 5 секунд" };
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
    beforeUpdate() {
        if (this.getWallet[this.getActive])
            setTimeout(() => (this.waitWallet = false), 300);
    },
    mounted() {
        document.title = "Кошельки";
        this.$refs.page.style.opacity = 1;
        if (this.getWallet[this.getActive]) this.waitWallet = false;
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

<template>
    <div class="wallets" ref="page">
        <div class="wallets__container">
            <main-title tag="h2" titleName="Мои кошельки">
                <!--                <blue-button class="wallets__button wallets__button-history">-->
                <!--                    <Link :href="route('income')"> Доходы </Link>-->
                <!--                </blue-button>-->
                <span class="wallets__button" data-popup="#addWallet">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="21"
                        height="21"
                        viewBox="0 0 21 21"
                        fill="none"
                    >
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M1.07129 10.0703C1.07129 9.51803 1.519 9.07031 2.07129 9.07031H18.0713C18.6236 9.07031 19.0713 9.51803 19.0713 10.0703C19.0713 10.6226 18.6236 11.0703 18.0713 11.0703H2.07129C1.519 11.0703 1.07129 10.6226 1.07129 10.0703Z"
                        />
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M10.0708 1.0708C10.6231 1.0708 11.0708 1.51852 11.0708 2.0708V18.0708C11.0708 18.6231 10.6231 19.0708 10.0708 19.0708C9.51852 19.0708 9.0708 18.6231 9.0708 18.0708V2.0708C9.0708 1.51852 9.51852 1.0708 10.0708 1.0708Z"
                        />
                    </svg>
                </span>
            </main-title>
            <div ref="wallets" class="wallets__wrap">
                <h3 class="wallets__title">
                    Список кошельков
                    <main-checkbox
                        class="wallets__filter"
                        @is_checked="this.checkboxer"
                    >
                        Скрыть с нулевым балансом
                    </main-checkbox>
                </h3>
                <div
                    class="no-info"
                    v-scroll="'opacity'"
                    ref="noInfo"
                    v-if="!this.bool"
                >
                    <div class="propeller"></div>
                </div>
                <div ref="list" class="wallets__list" v-else>
                    <div
                        class="wallets__block wallets__block-wallet"
                        v-for="(wallet, i) in this.wallets"
                        :key="i"
                        v-scroll="'top'"
                    >
                        <div class="wallets__block_name">
                            <!--                            <img-->
                            <!--                                :src="-->
                            <!--                                    'http://127.0.0.1:5173' +-->
                            <!--                                    `/resources/assets/img/${wallet.img}`-->
                            <!--                                "-->
                            <!--                            />-->
                            <span>{{ wallet.name }}</span>
                            <div class="wallets__block_doths">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                        <div class="wallets__block_value">
                            <span>{{ wallet.value }}</span>
                            {{ wallet.shortName }}
                        </div>
                        <div class="wallets__block_convert">
                            ≈
                            <span>{{
                                (wallet.value * dollar).toFixed(2)
                            }}</span>
                            $ ≈
                            <span>{{
                                ((wallet.value * dollar) / ruble).toFixed(2)
                            }}</span>
                            ₽
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <popup-view id="addWallet">
        <div
            v-for="(error, i) in this.err"
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
        <form
            @submit.prevent="this.addWallet"
            class="form form-popup popup__form"
        >
            <main-title tag="h3" title-name="Добавьте кошелек" />
            <input
                v-model="form.wallet"
                required
                autofocus
                type="text"
                class="input popup__input"
                placeholder="Введите кошелек"
            />
            <input
                v-model="form.name"
                autofocus
                type="text"
                class="input popup__input"
                placeholder="Введите имя"
            />
            <div class="form_row">
                <div class="form_column">
                    <label for="percent" class="main__label">Процент</label>
                    <input
                        name="percent"
                        @input="handleInputChange"
                        v-model="form.percent"
                        id="percent"
                        autofocus
                        type="text"
                        class="input popup__input"
                        placeholder="100%"
                    />
                </div>
                <div class="form_column">
                    <label for="min" class="main__label">Мин. вывод</label>
                    <input
                        name="minWithdrawal"
                        @input="handleInputChange"
                        v-model="form.minWithdrawal"
                        id="min"
                        autofocus
                        type="text"
                        class="input popup__input"
                        placeholder="0.005"
                    />
                </div>
            </div>
            <blue-button>
                <button type="submit" class="all-link">+ Добавить</button>
            </blue-button>
        </form>
    </popup-view>
</template>
<script>
import axios from "axios";
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import MainCheckbox from "@/Components/UI/MainCheckbox.vue";
import { mapGetters } from "vuex";
import Vue from "lodash";
import { Link } from "@inertiajs/vue3";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";
import PopupView from "@/Components/technical/PopupView.vue";

export default {
    components: { PopupView, MainCheckbox, BlueButton, MainTitle, Link },
    layout: profileLayoutView,
    computed: {
        ...mapGetters([
            "getIncome",
            "allAccounts",
            "allHistoryForDays",
            "getActive",
            "getWallet",
        ]),
        bool() {
            return this.wallets.length > 0;
        },
        wallets() {
            let arr = [];
            if (this.getWallet && Object.values(this.getWallet).length > 0) {
                if (this.isChecked) {
                    Object.values(this.getWallet).forEach((wal, i) => {
                        let val = 0;
                        if (wal[i].payment) {
                            val = wal[i].payment;
                        }
                        if (val > 0) {
                            let name = wal[i].wallet;
                            if (wal[i].name) {
                                name = wal[i].name;
                            }
                            let walletModel = {
                                img: "bitcoin_img.png",
                                name: name,
                                shortName: "BTC",
                                value: val.toFixed(8),
                                dollarValue: 0,
                                rubleValue: 0,
                            };
                            Vue.set(arr, i, walletModel);
                        }
                    });
                } else {
                    Object.values(this.getWallet).forEach((wal, i) => {
                        let val = 0;
                        if (wal[i].payment) {
                            val = wal[i].payment;
                        }
                        let name = wal[i].wallet;
                        if (wal[i].name) {
                            name = wal[i].name;
                        }
                        let walletModel = {
                            img: "bitcoin_img.png",
                            name: name,
                            shortName: "BTC",
                            value: val.toFixed(8),
                            dollarValue: 0,
                            rubleValue: 0,
                        };
                        Vue.set(arr, i, walletModel);
                    });
                }
            }
            return arr;
        },
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
        axios
            .get("https://api.minerstat.com/v2/coins?list=BTC,BCH,BSV")
            .then((response) => (this.dollar = response.data[0].price));
        setTimeout(() => {
            axios
                .get("https://www.cbr-xml-daily.ru/latest.js")
                .then((response) => (this.ruble = response.data.rates.USD));
        }, 100);
    },
    data() {
        return {
            miningCash: 0,
            isChecked: false,
            viewportWidth: 0,
            ruble: 0,
            dollar: 0,
            err: {},
            form: {
                name: "",
                wallet: "",
                percent: 100,
                minWithdrawal: 0.005,
            },
        };
    },
    methods: {
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
            let obj = this.form;
            obj.group_id = this.getActive;
            obj.minWithdrawal === "0"
                ? (this.err.message = ["Вывод должен быть больше 0.005."])
                : axios
                      .post("/wallet_create", this.form)
                      .then((res) =>
                          document.querySelector("[data-close]").click()
                      )
                      .catch((err) => (this.err = err.response.data.errors));
        },
        checkboxer(is_checked) {
            this.isChecked = is_checked;
            setTimeout(() => {
                if (this.$refs.list) {
                    if (this.viewportWidth > 768) {
                        setTimeout(() => {
                            this.$refs.wallets.style.height =
                                48 + 46 + this.$refs.list.offsetHeight + "px";
                        }, 1);
                    } else {
                        setTimeout(() => {
                            this.$refs.wallets.style.height =
                                40 + 114 + this.$refs.list.offsetHeight + "px";
                        }, 1);
                    }
                } else {
                    if (this.viewportWidth > 768) {
                        setTimeout(() => {
                            this.$refs.wallets.style.height =
                                48 + 46 + this.$refs.noInfo.offsetHeight + "px";
                        }, 1);
                    } else {
                        setTimeout(() => {
                            this.$refs.wallets.style.height =
                                40 +
                                114 +
                                this.$refs.noInfo.offsetHeight +
                                "px";
                        }, 1);
                    }
                }
            }, 100);
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
    &__title {
        font-family: AmpleSoftPro, serif;
        font-style: normal;
        color: #000;
        margin: 0 0 16px;
        font-weight: 700;
        font-size: 24px;
        line-height: 30px;
        width: 100%;
        display: inline-flex;
        justify-content: space-between;
        @media (max-width: 479.89px) {
            font-size: 21px;
            line-height: 26px;
        }
        @media (max-width: 767.98px) {
            position: relative;
            margin-bottom: 90px !important;
            flex-direction: column;
            &:after {
                content: "";
                height: 1px;
                position: absolute;
                bottom: -20px;
                left: 0;
                width: 100%;
                background-color: #d7d8d9;
            }
        }
    }

    // .wallets__filter
    &__filter {
        line-height: 23px;
        font-size: 16px;
        color: #99acd3;
        @media (max-width: 767.98px) {
            position: absolute;
            left: 0;
            bottom: calc(-40px - 100%);
        }
        @media (max-width: 479.98px) {
            width: 100%;
        }
    }

    .title {
        margin: 0 0 24px;
        padding-left: 70px;
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: space-between;
    }

    &__list {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        transition: all 0.3s ease 0s;
        @media (max-width: 991.98px) {
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

    // .wallets__block
    &__block {
        padding: 16px;
        background-color: #fff;
        border-radius: 13px;
        width: 100%;

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
                color: #000000;
                @media (max-width: 991.98px) {
                    font-size: 16px;
                    line-height: 23px;
                }
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
            @media (max-width: 767.98px) {
                width: 20px;
                gap: 2.5px;
            }

            &:hover {
                div {
                    background-color: #3f7bdd;
                }
            }

            div {
                width: 4px;
                height: 4px;
                border-radius: 50%;
                background-color: rgba(0, 0, 0, 0.62);
                transition: all 0.3s ease;
            }
        }

        &_value {
            padding: 16px 16px 0;
            margin-bottom: 8px;
            font-weight: 400;
            font-size: 20px;
            line-height: 28px;
            color: #0000009e;
            width: 100%;
            @media (max-width: 767.98px) {
                padding: 10px 10px 0;
                font-weight: 500;
                font-size: 16px;
                line-height: 23px;
                color: #000034;
                margin-bottom: 0;
                span {
                    font-weight: 500;
                }
            }

            span {
                font-weight: 700;
                color: #000034;
            }
        }

        &_convert {
            padding: 0 16px;
            font-weight: 400;
            font-size: 16px;
            line-height: 23px;
            color: rgba(0, 0, 0, 0.62);
            @media (max-width: 767.98px) {
                color: #000034;
            }
        }

        .wallets__subtitle {
            font-weight: 400;
            font-size: 16px;
            line-height: 23px;
        }
    }

    // .wallets__button
    &__button {
        //color: #68809d !important;
        //background: #fff !important;
        //min-width: 179px;
        //box-shadow: none;
        //transform: translate(0, 0);
        //max-height: 51px;
        //gap: 10px;
        //@media (max-width: 991.98px) {
        //    min-width: 160px;
        //    height: 38px;
        //}
        //@media (max-width: 767.98px) {
        //    font-size: 18px !important;
        //    line-height: 22px !important;
        //    width: 100% !important;
        //    min-width: 120px;
        //    &:before {
        //        content: none;
        //    }
        //}
        //@media (max-width: 479.98px) {
        //    flex-direction: column;
        //    gap: 6px;
        //    min-height: 54px;
        //    min-width: 0;
        //    font-size: 12px !important;
        //    line-height: 14px !important;
        //    padding: 0;
        //}
        //
        //&:first-child {
        //    margin-left: 0;
        //}
        //
        //svg {
        //    stroke: #68809d;
        //    transition: all 0.3s ease;
        //    @media (max-width: 767.98px) {
        //        width: 20px;
        //        height: 20px;
        //        stroke: #68809d;
        //        margin-right: 6px;
        //    }
        //    @media (max-width: 479.98px) {
        //        margin: 0;
        //    }
        //}
        //
        //&::before {
        //    z-index: -1;
        //    content: "";
        //    position: absolute;
        //    background: transparent;
        //    border-radius: 10px;
        //    width: 100%;
        //    height: 100%;
        //    top: 0;
        //    left: 0;
        //    transition: all 0.3s ease 0s;
        //    @media (max-width: 767.98px) {
        //        background: #fff;
        //    }
        //}
        //
        //@media (any-hover: hover) {
        //    &:hover {
        //        background-color: #4182ec !important;
        //        color: #fff !important;
        //
        //        &:before {
        //            background: linear-gradient(
        //                84.14deg,
        //                rgba(63, 123, 221, 0.27) 8.75%,
        //                rgba(66, 130, 236, 0.27) 92.01%
        //            );
        //        }
        //
        //        svg {
        //            stroke: #fff;
        //        }
        //    }
        //}
        // .wallets__button-history
        //&-history {
        //    min-height: 51px;
        //    color: #fff;
        //    background-color: #4182ec;
        //    min-width: 210px;
        //    padding: 0;
        //
        //    &:before {
        //        background: linear-gradient(
        //            84.14deg,
        //            rgba(63, 123, 221, 0.27) 8.75%,
        //            rgba(66, 130, 236, 0.27) 92.01%
        //        );
        //    }
        //
        //    a {
        //        width: 100%;
        //        height: 100%;
        //        display: inline-flex;
        //        align-items: center;
        //        justify-content: center;
        //    }
        //
        //    @media (min-width: 767.98px) {
        //        font-size: 20px;
        //        line-height: 28px;
        //    }
        //    @media (max-width: 767.98px) {
        //        width: auto;
        //        min-height: 48px;
        //        min-width: 150px;
        //        &:before {
        //            content: none;
        //        }
        //    }
        //    @media (max-width: 479.98px) {
        //        min-height: 28px;
        //        height: auto;
        //        font-size: 14px;
        //        line-height: 20px;
        //        min-width: 90px;
        //    }
        //}&__button {
        width: 60px;
        height: 44px;
        border-radius: 13px;
        background-color: #4182ec;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        &::before {
            content: "";
            position: absolute;
            z-index: -1;
            background: linear-gradient(
                84.14deg,
                rgba(63, 123, 221, 0.27) 8.75%,
                rgba(66, 130, 236, 0.27) 92.01%
            );
            border-radius: 10px;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            transition: all 0.3s ease 0s;
        }
        @media (any-hover: hover) {
            &:hover {
                transform: translate(-4px, -4px);
                &::before {
                    top: 4px;
                    left: 4px;
                }
            }
        }
        &:active {
            @media (min-width: 479.89px) {
                transform: translate(0, 0);
                box-shadow: inset 0 4px 4px rgba(0, 0, 0, 0.25);
                &::before {
                    top: 0;
                    left: 0;
                }
            }
        }
        svg {
            width: 14px;
            height: 14px;
            fill: #fff;
        }
        @media (max-width: 479.89px) {
            background-color: transparent;
            width: 20px;
            height: 20px;

            svg {
                fill: #4182ec;
                width: 18px;
                height: 18px;
            }
        }
    }

    // .wallets__wrap
    &__wrap {
        margin-bottom: 40px;
        background: rgba(255, 255, 255, 0.29);
        border-radius: 21px;
        width: 100%;
        padding: 24px 16px;
        @media (max-width: 1270px) {
            padding: 20px;
        }
        @media (max-width: 767.98px) {
            margin: 0 -15px 20px;
            width: calc(100% + 30px);
        }
        @media (max-width: 479.98px) {
            margin: 0 -20px 20px;
            width: calc(100% + 40px);
        }

        &:last-child {
            margin-bottom: 0;
            overflow-y: hidden;
            transition: all 0.3s ease;
        }
    }

    // .wallets__row
    &__row {
        width: 100%;
        display: flex;
        gap: 16px;
        @media (max-width: 767.98px) {
            flex-direction: column;
            gap: 0;
            background-color: #fff;
            border: 0.5px solid rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            padding: 4px 10px;
        }
        @media (max-width: 767.98px) {
            .wallets__block {
                padding: 10px 0 10px;
                border-top: 1px solid #d7d8d9;
                border-radius: 0;

                &:last-child {
                    padding: 10px 0 0;
                }

                &:first-child {
                    border-top: none;
                    padding: 0 0 10px;
                }
            }
        }
        // .wallets__row-balance
        &-balance {
            gap: 0;
            justify-content: space-between;
            margin-bottom: 16px;
            h3 {
                margin-bottom: 0;
                @media (max-width: 767.98px) {
                    margin-bottom: 30px !important;
                }
            }
            @media (max-width: 767.98px) {
                background-color: transparent;
                padding: 0;
                border: none;
                .wallets__column {
                    gap: 0;
                    background-color: #fff;
                    border: 0.5px solid rgba(0, 0, 0, 0.08);
                    border-radius: 8px;
                    padding: 10px 10px;
                    margin-bottom: 10px;
                    flex-direction: row;
                    align-items: center;
                    justify-content: center;
                }
            }
            @media (max-width: 479.98px) {
                .wallets__column {
                    padding: 4px 10px;
                    flex-direction: column;
                    align-items: flex-start;
                }
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

    // .wallets__subtitle
    &__subtitle {
        font-weight: 500;
        font-size: 18px;
        line-height: 26px;
        color: rgba(0, 0, 0, 0.62);
        margin-bottom: 8px;
        @media (max-width: 767.98px) {
            margin-bottom: 0;
            font-size: 14px;
            line-height: 20px;
            font-weight: 400;
        }
    }

    // .wallets__value
    &__value {
        color: #000034;
        font-weight: 500;
        font-size: 24px;
        line-height: 34px;
        @media (max-width: 767.98px) {
            margin-left: 5px;
            font-size: 21px;
            line-height: 30px;
        }
        @media (max-width: 479.98px) {
            margin-left: 0;
        }

        span {
            font-weight: 700;
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

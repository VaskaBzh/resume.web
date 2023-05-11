<template>
    <div class="profile" v-scroll="'opacity'" :data-key="accountInfo.id">
        <div class="profile__head">
            <!--            <img-->
            <!--                :src="-->
            <!--                    'http://127.0.0.1:5173' +-->
            <!--                    `/resources/assets/img/${this.accountInfo.img}`-->
            <!--                "-->
            <!--                @click="this.chageActive"-->
            <!--                class="profile__icon"-->
            <!--                alt="profile__icon"-->
            <!--            />-->
            <span class="profile__name" @click="chageActive">{{
                account.name
            }}</span>
            <div
                class="profile__settings"
                @click="this.toggleTarget"
                :class="{ target: this.target }"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="32"
                    height="32"
                    viewBox="0 0 32 32"
                    fill="none"
                >
                    <path
                        d="M20 16C20 18.2091 18.2091 20 16 20C13.7909 20 12 18.2091 12 16C12 13.7909 13.7909 12 16 12C18.2091 12 20 13.7909 20 16Z"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <path
                        d="M17.2061 4.08006C16.9318 4 16.6212 4 16 4C15.3788 4 15.0682 4 14.7939 4.08006C14.3922 4.19725 14.0375 4.43743 13.7795 4.76681C13.6033 4.99183 13.4879 5.28021 13.2572 5.85695C12.9256 6.68602 12.0052 7.11294 11.1581 6.83067L10.397 6.57708C9.8572 6.39713 9.58726 6.30715 9.32262 6.29173C8.93385 6.26908 8.54694 6.36042 8.20935 6.55454C7.97953 6.68668 7.77834 6.88788 7.37596 7.29026C6.94829 7.71793 6.73445 7.93176 6.59861 8.17585C6.39903 8.53446 6.3146 8.94578 6.35678 9.35401C6.38549 9.63187 6.4978 9.91265 6.72243 10.4742C7.0742 11.3536 6.73578 12.3584 5.92363 12.8458L5.55361 13.0678C4.98708 13.4078 4.70382 13.5777 4.49806 13.8117C4.31597 14.0188 4.17868 14.2613 4.09479 14.524C4 14.8208 4 15.1544 4 15.8217C4 16.6118 4 17.0069 4.12616 17.345C4.23764 17.6438 4.41895 17.9116 4.65498 18.1261C4.9221 18.3688 5.28527 18.5141 6.01155 18.8046C6.75378 19.1015 7.13595 19.9255 6.88315 20.6839L6.59628 21.5445C6.39758 22.1406 6.29823 22.4386 6.2892 22.7315C6.27833 23.0836 6.36065 23.4323 6.52783 23.7423C6.66687 24.0002 6.88904 24.2224 7.33333 24.6667C7.77764 25.111 7.9998 25.3331 8.25767 25.4722C8.56773 25.6393 8.91645 25.7217 9.26854 25.7108C9.56137 25.7018 9.85942 25.6024 10.4555 25.4037L11.1582 25.1695C12.0052 24.8871 12.9256 25.314 13.2572 26.143C13.4879 26.7198 13.6033 27.0082 13.7795 27.2332C14.0375 27.5626 14.3922 27.8028 14.7939 27.9199C15.0682 28 15.3788 28 16 28C16.6212 28 16.9318 28 17.2061 27.9199C17.6078 27.8028 17.9625 27.5626 18.2205 27.2332C18.3967 27.0082 18.5121 26.7198 18.7428 26.143C19.0744 25.314 19.9948 24.8872 20.8418 25.1697L21.5439 25.4038C22.14 25.6025 22.4381 25.7019 22.7309 25.7109C23.083 25.7218 23.4317 25.6395 23.7418 25.4723C23.9997 25.3332 24.2218 25.1111 24.6661 24.6668C25.1104 24.2225 25.3326 24.0003 25.4716 23.7424C25.6388 23.4324 25.7211 23.0837 25.7103 22.7316C25.7012 22.4387 25.6019 22.1406 25.4032 21.5446L25.1165 20.6845C24.8636 19.9258 25.2459 19.1016 25.9884 18.8046C26.7147 18.5141 27.0779 18.3688 27.345 18.1261C27.581 17.9116 27.7624 17.6438 27.8738 17.345C28 17.0069 28 16.6118 28 15.8217C28 15.1544 28 14.8208 27.9052 14.524C27.8213 14.2613 27.684 14.0188 27.5019 13.8117C27.2962 13.5777 27.0129 13.4078 26.4464 13.0678L26.0759 12.8455C25.2637 12.3582 24.9253 11.3535 25.277 10.4741C25.5016 9.91257 25.614 9.63177 25.6427 9.35391C25.6848 8.94568 25.6004 8.53436 25.4008 8.17575C25.265 7.93166 25.0512 7.71783 24.6235 7.29016C24.2211 6.88779 24.0199 6.68658 23.7901 6.55444C23.4525 6.36032 23.0656 6.26898 22.6768 6.29163C22.4122 6.30705 22.1423 6.39703 21.6024 6.57698L20.8418 6.8305C19.9948 7.11286 19.0744 6.686 18.7428 5.85695C18.5121 5.28021 18.3967 4.99184 18.2205 4.76681C17.9625 4.43743 17.6078 4.19725 17.2061 4.08006Z"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
                <div class="profile__menu">
                    <div
                        class="profile__menu_elem"
                        :data-popup="`#edit`"
                        @click="this.$emit('getId', account.id)"
                    >
                        <svg
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
                        </svg>
                        Изменить название
                    </div>
                    <div @click="getWallets" class="profile__menu_elem">
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <g clip-path="url(#clip0_1063_963)">
                                <path
                                    d="M4.91016 16.9267H7.30273C7.58919 16.9267 7.82031 16.8388 7.99609 16.663C8.17188 16.4872 8.25977 16.2626 8.25977 15.9892V14.1825C8.25977 13.9026 8.17188 13.6764 7.99609 13.5039C7.82031 13.3313 7.58919 13.2451 7.30273 13.2451H4.91016C4.6237 13.2451 4.39258 13.3313 4.2168 13.5039C4.04101 13.6764 3.95312 13.9026 3.95312 14.1825V15.9892C3.95312 16.2626 4.04101 16.4872 4.2168 16.663C4.39258 16.8388 4.6237 16.9267 4.91016 16.9267ZM1.31641 9.76852H22.6934V7.55172H1.31641V9.76852ZM3.5918 20.3447H20.4082C21.4303 20.3447 22.1969 20.0924 22.708 19.5878C23.2191 19.0833 23.4746 18.3297 23.4746 17.3271V6.69235C23.4746 5.68975 23.2191 4.93454 22.708 4.42673C22.1969 3.91891 21.4303 3.66501 20.4082 3.66501H3.5918C2.56966 3.66501 1.80306 3.91729 1.29199 4.42184C0.780925 4.9264 0.525391 5.68324 0.525391 6.69235V17.3271C0.525391 18.3297 0.780925 19.0833 1.29199 19.5878C1.80306 20.0924 2.56966 20.3447 3.5918 20.3447ZM3.61133 18.7724C3.12305 18.7724 2.7487 18.6438 2.48828 18.3866C2.22787 18.1295 2.09766 17.747 2.09766 17.2392V6.78024C2.09766 6.27243 2.22787 5.88832 2.48828 5.6279C2.7487 5.36748 3.12305 5.23727 3.61133 5.23727H20.3887C20.8704 5.23727 21.2431 5.36748 21.5068 5.6279C21.7705 5.88832 21.9024 6.27243 21.9024 6.78024V17.2392C21.9024 17.747 21.7705 18.1295 21.5068 18.3866C21.2431 18.6438 20.8704 18.7724 20.3887 18.7724H3.61133Z"
                                />
                            </g>
                            <defs>
                                <clipPath id="clip0_1063_963">
                                    <rect
                                        width="22.9492"
                                        height="16.6895"
                                        fill="white"
                                        transform="translate(0.525391 3.65524)"
                                    />
                                </clipPath>
                            </defs>
                        </svg>
                        Привязанные кошельки
                    </div>
                </div>
            </div>
        </div>
        <div class="profile__body">
            <div class="profile__body-block">
                <span class="profile__body-name">Ср. хешрейт / 1ч</span>
                <span class="profile__body-value">
                    {{ this.hashRate }} {{ this.accountInfo.unit }}H/s</span
                >
            </div>
            <div class="profile__body-block">
                <span class="profile__body-name">Количество воркеров</span>
                <span class="profile__body-value">
                    {{ this.accountInfo.workersActive }} /
                    {{ this.accountInfo.workersAll }}
                    <span>(Активные / Все)</span>
                </span>
            </div>
            <div class="profile__body-block">
                <span class="profile__body-name"
                    >Прогнозируемое начисление за сегодня</span
                >
                <span class="profile__body-value">
                    {{ this.todayProfit }} BTC</span
                >
            </div>
            <div class="profile__body-block">
                <span class="profile__body-name">Всего выплачено</span>
                <span class="profile__body-value">
                    {{ this.myPayment }} BTC</span
                >
            </div>
        </div>
    </div>
</template>
<script>
import { Link, router, useForm } from "@inertiajs/vue3";
export default {
    emits: ["changeActive", "click"],
    components: {
        Link,
    },
    props: {
        accountInfo: Object,
        profit: Object,
    },
    data() {
        return {
            account: this.accountInfo,
            savedName: this.accountInfo.name,
            target: false,
        };
    },
    methods: {
        toggleTarget() {
            this.target = !this.target;
        },
        hideMenu(e) {
            if (!e.target.closest(".target")) {
                this.target = false;
            }
        },
        router() {
            return router;
        },
        chageActive() {
            this.$emit("changeActive", this.accountInfo.id);
        },
        // saveName() {
        //     let form = useForm({
        //         group_name: this.account.name,
        //         group_id: String(this.account.id),
        //         puid: "781195",
        //     });
        //
        //     form.put("/sub_change", {
        //         onFinish: () => {
        //             this.errors?.length === 0
        //                 ? this.$store.dispatch("getAccounts")
        //                 : (this.account.name = this.savedName);
        //         },
        //     });
        // },
        getWallets() {
            this.$store.commit("updateActive", this.accountInfo.id);
            router.visit("/profile/wallets");
        },
    },
    mounted() {
        document.addEventListener("click", this.hideMenu.bind(this), true);
    },
    computed: {
        todayProfit() {
            if (isNaN(this.profit[this.accountInfo.id])) {
                return "0.00000000";
            } else {
                return Number(this.profit[this.accountInfo.id]).toFixed(8);
            }
        },
        myPayment() {
            return Number(this.account.myPayment).toFixed(8);
        },
        hashRate() {
            return Number(this.account.shares1m).toFixed(2);
        },
    },
};
</script>

<style lang="scss" scoped>
.profile {
    width: 100%;
    padding: 16px;
    transition: all 0.7s ease 0s;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 21px;
    position: relative;
    filter: drop-shadow(0px 8px 24px rgba(129, 135, 189, 0.15));
    backdrop-filter: blur(5px);
    -webkit-box-shadow: 0 11px 34px 0 rgb(0 0 0 / 10%);
    @media (max-width: 479.98px) {
        //width: calc(100% + 40px);
        //margin: 0 -20px;
        border-radius: 12px;
    }
    &:before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        transition: all 0.7s ease 0s;
        height: 100%;
        z-index: 0;
        opacity: 0;
        visibility: hidden;
        background: radial-gradient(
            66.49% 172.2% at 2.47% 5.67%,
            rgba(65, 130, 236, 0.76) 0%,
            #4182ec 100%
        );
        border-radius: 21px;
        @media (max-width: 479.98px) {
            border-radius: 12px;
        }
    }
    &.active {
        -webkit-box-shadow: 0 11px 34px 0 rgb(0 0 0 / 20%);
        &:before {
            visibility: visible;
            opacity: 1;
        }
        .profile {
            &__name {
                color: #ffffff;
                &:hover {
                    text-decoration-color: #fff;
                }
            }
            &__body {
                background-color: transparent;
                &-block {
                    background: transparent;
                }
                &:before {
                    visibility: visible;
                    opacity: 1;
                }
                &-name,
                &-value {
                    color: #fff;
                    span {
                        color: #fff;
                    }
                }
            }
        }
        svg {
            stroke: #ffffff;
        }
        .form_row {
            height: auto;
            width: 100%;
            position: relative;
            svg {
                fill: #fff;
            }
        }
    }
    svg {
        stroke: #417fe5;
        width: 24px;
        height: 24px;
        cursor: pointer;
        transition: all 0.3s ease 0s;
        @media (max-width: 479.98px) {
            width: 24px;
            height: 24px;
            stroke: #4182ec;
        }
    }
    .form_row {
        height: auto;
        width: 100%;
        position: relative;
        svg {
            position: absolute;
            right: 2px;
            top: 50%;
            transform: translateY(-50%);
            width: 24px;
            height: 24px;
            fill: #4181ea;
        }
        .input {
            color: #fff;
            font-size: 24px;
            line-height: 30px;
            font-weight: 700;
            min-height: 0;
            font-family: AmpleSoftPro, serif;
            height: auto;
            border-bottom: 1px solid #fff !important;
            padding-right: 32px;
            @media (max-width: 479.98px) {
                font-size: 15px;
                line-height: 19px;
            }
        }
    }
    &__menu {
        transition: all 0.6s ease 0s;
        position: absolute;
        top: calc(100% + 16px);
        right: 0;
        display: flex;
        flex-direction: column;
        background: #ffffff;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border-radius: 20px;
        overflow: hidden;
        opacity: 0;
        z-index: 2;
        max-height: 0;
        min-width: 257px;
        max-width: 257px;
        border: 1px solid #fff;
        &_elem {
            width: 100%;
            min-height: 48px;
            display: flex;
            gap: 12px;
            transition: all 0.6s ease 0s;
            background: #ffffff;
            align-items: center;
            padding: 6px 12px;
            cursor: pointer;
            border-bottom: 1px solid transparent;
            font-weight: 400;
            font-size: 17px;
            line-height: 143.1%;
            color: #000034;
            &:not(:last-child) {
                border-bottom: 1px solid rgba(214, 214, 214, 0.3);
            }
            svg {
                width: 24px;
                height: 24px;
                stroke: transparent !important;
            }
            svg:not(.stroke) {
                fill: #417fe5 !important;
            }
            svg.stroke {
                stroke: #417fe5 !important;
            }
            &:hover {
                background: rgba(208, 222, 242, 0.7);
            }
        }
    }
    &__settings {
        position: relative;
        &.target {
            .profile {
                &__menu {
                    max-height: 100vh;
                    transition: all 0.6s ease 0s, ;
                    //visibility: visible;
                    opacity: 1;
                }
            }
        }
    }
    &__head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        @media (max-width: 479.98px) {
            margin-bottom: 40px;
            position: relative;
            &:before {
                content: "";
                position: absolute;
                bottom: -20px;
                left: 0;
                width: 100%;
                height: 1px;
                background-color: #d7d8d9;
            }
        }
    }
    //&__icon {
    //    width: 64px;
    //    height: 64px;
    //    margin-right: 16px;
    //    cursor: pointer;
    //    @media (max-width: 479.98px) {
    //        width: 36px;
    //        height: 36px;
    //        margin-right: 20px;
    //    }
    //}
    &__name {
        font-size: 24px;
        line-height: 30px;
        font-family: AmpleSoftPro, serif;
        font-weight: 700;
        text-decoration: underline;
        text-decoration-color: transparent;
        transition: all 0.7s ease 0s;
        cursor: pointer;
        z-index: 1;
        border: 1px solid transparent;
        //@media (max-width: 479.98px) {
        //    font-size: 15px;
        //    line-height: 19px;
        //}
        &:hover {
            text-decoration-color: #331a38;
        }
    }
    &__body {
        position: relative;
        padding: 24px 16px 0;
        display: flex;
        flex-wrap: wrap;
        background-color: #fff;
        border-radius: 21px;
        transition: all 0.5s ease 0s;
        &:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            opacity: 0;
            visibility: hidden;
            background: linear-gradient(
                113.15deg,
                rgba(255, 255, 255, 0.2) 31.75%,
                rgba(255, 255, 255, 0) 121.06%
            );
            transition: all 0.5s ease 0s;
            backdrop-filter: blur(5px);
            border-radius: 21px;
        }
        @media (max-width: 479.98px) {
            flex-direction: column;
            gap: 6px;
            color: rgba(255, 255, 255, 0.3);
            background-color: transparent;
            padding: 0;
        }
        &-block {
            width: calc(50% - 5px);
            display: flex;
            flex-direction: column;
            margin: 0 auto 24px 0;
            z-index: 1;
            transition: all 0.5s ease 0s;

            &:nth-child(2n) {
                margin-right: 0;
            }
            @media (max-width: 479.98px) {
                width: 100%;
                background: #ffffff;
                border-radius: 12px;
                border: 0.5px solid #d7d8d9;
                margin: 0;
                padding: 4px 10px;
            }
        }
        &-name {
            color: rgba(0, 0, 0, 0.62);
            font-size: 16px;
            line-height: 23px;
            margin-bottom: 4px;
            z-index: 1;
            @media (max-width: 479.98px) {
                font-size: 14px;
                line-height: 20px;
                color: #818c99;
                margin-bottom: 6px;
            }
        }
        &-value {
            font-size: 18px;
            line-height: 25px;
            font-weight: 500;
            z-index: 1;
            span {
                color: rgba(0, 0, 0, 0.62);
                font-weight: 400;
                font-size: 16px;
                line-height: 23px;
                z-index: 1;
            }
            @media (max-width: 479.98px) {
                font-size: 16px;
                line-height: 23px;
                color: #000034;
            }
        }
    }
}
</style>

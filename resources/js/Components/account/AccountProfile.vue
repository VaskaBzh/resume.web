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
            <span class="profile__name" v-show="!edit" @click="chageActive">{{
                accountInfo.name
            }}</span>
            <div class="form_row" v-show="edit">
                <input
                    v-model="account.name"
                    type="text"
                    class="input input-no-bg"
                />
                <svg
                    @click="saveName"
                    width="1328"
                    height="1346"
                    viewBox="0 0 1328 1346"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M1067.24 297.129L498.126 873.965L260.759 633.379C239.14 611.466 204.14 611.466 182.576 633.379C161.013 655.291 160.957 690.765 182.576 712.621L459.035 992.83C480.654 1014.74 515.653 1014.74 537.217 992.83L1145.43 376.371C1167.04 354.459 1167.04 318.985 1145.43 297.129C1123.81 275.272 1088.81 275.216 1067.24 297.129Z"
                    />
                </svg>
            </div>
            <div class="profile__settings">
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
                    <div class="profile__menu_elem" @click="editName">
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M22 7.24002C22.0008 7.10841 21.9756 6.97795 21.9258 6.85611C21.876 6.73427 21.8027 6.62346 21.71 6.53002L17.47 2.29002C17.3766 2.19734 17.2658 2.12401 17.1439 2.07425C17.0221 2.02448 16.8916 1.99926 16.76 2.00002C16.6284 1.99926 16.4979 2.02448 16.3761 2.07425C16.2543 2.12401 16.1435 2.19734 16.05 2.29002L13.22 5.12002L2.29002 16.05C2.19734 16.1435 2.12401 16.2543 2.07425 16.3761C2.02448 16.4979 1.99926 16.6284 2.00002 16.76V21C2.00002 21.2652 2.10537 21.5196 2.29291 21.7071C2.48045 21.8947 2.7348 22 3.00002 22H7.24002C7.37994 22.0076 7.51991 21.9857 7.65084 21.9358C7.78176 21.8858 7.90073 21.8089 8.00002 21.71L18.87 10.78L21.71 8.00002C21.8013 7.9031 21.8757 7.79155 21.93 7.67002C21.9397 7.59031 21.9397 7.50973 21.93 7.43002C21.9347 7.38347 21.9347 7.33657 21.93 7.29002L22 7.24002ZM6.83002 20H4.00002V17.17L13.93 7.24002L16.76 10.07L6.83002 20ZM18.17 8.66002L15.34 5.83002L16.76 4.42002L19.58 7.24002L18.17 8.66002Z"
                            />
                        </svg>
                        Изменить название
                    </div>
                    <div @click="getWallets" class="profile__menu_elem">
                        <svg
                            class="stroke"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M16.4998 14.1502H16.5088M18.999 4.00098H6.19902C5.07892 4.00098 4.51887 4.00098 4.09104 4.21896C3.71472 4.41071 3.40876 4.71667 3.21701 5.093C2.99902 5.52082 2.99902 6.08087 2.99902 7.20098V16.801C2.99902 17.9211 2.99902 18.4811 3.21701 18.909C3.40876 19.2853 3.71472 19.5912 4.09104 19.783C4.51887 20.001 5.07892 20.001 6.19902 20.001H17.799C18.9191 20.001 19.4792 20.001 19.907 19.783C20.2833 19.5912 20.5893 19.2853 20.781 18.909C20.999 18.4811 20.999 17.9211 20.999 16.801V11.201C20.999 10.0809 20.999 9.52082 20.781 9.093C20.5893 8.71667 20.2833 8.41071 19.907 8.21896C19.4792 8.00098 18.9191 8.00098 17.799 8.00098H6.99902M16.9498 14.1502C16.9498 14.3987 16.7483 14.6002 16.4998 14.6002C16.2513 14.6002 16.0498 14.3987 16.0498 14.1502C16.0498 13.9017 16.2513 13.7002 16.4998 13.7002C16.7483 13.7002 16.9498 13.9017 16.9498 14.1502Z"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
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
import {Link, router, useForm} from "@inertiajs/vue3";
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
            edit: false,
        };
    },
    methods: {
        router() {
            return router;
        },
        chageActive() {
            this.$emit("changeActive", this.accountInfo.id);
        },
        editName() {
            this.edit = !this.edit;
        },
        saveName() {
            this.editName();
            let form = useForm({
                group_name: this.account.name,
                group_id: String(this.account.id),
            });
            // Раскомментить и пофиксить
            // form.put("/change_sub");
        },
        getWallets() {
            this.$store.commit("updateActive", this.accountInfo.id);
            router.visit("/profile/wallets");
        },
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
    background: rgba(255, 255, 255, 0.29);
    border-radius: 21px;
    border: 1px solid;
    border-color: transparent;
    transition: all 0.3s ease 0s;
    @media (max-width: 479.98px) {
        width: calc(100% + 40px);
        margin: 0 -20px;
        border-radius: 12px;
        padding: 20px;
    }
    &.active {
        border-color: rgba(#331a38, 0.5);
        background: #331a38;
        .profile__name {
            color: #ffffff;
            &:hover {
                text-decoration-color: #fff;
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
        stroke: #99acd3;
        width: 32px;
        height: 32px;
        cursor: pointer;
        transition: all 0.3s ease 0s;
        &:hover,
        &:active {
            stroke: #4182ec;
        }
        @media (max-width: 479.98px) {
            width: 24px;
            height: 24px;
            stroke: #4182ec;
        }
    }
    &__settings {
        position: relative;
        &:hover {
            .profile {
                &__menu {
                    transition: all 0.6s ease 0s;
                    visibility: visible;
                    opacity: 1;
                }
            }
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
        transition: all 0.6s ease 0.6s;
        min-width: 257px;
        max-width: 257px;
        position: absolute;
        top: calc(100% + 16px);
        right: 0;
        display: flex;
        flex-direction: column;
        background: #ffffff;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border-radius: 20px;
        overflow: hidden;
        visibility: hidden;
        opacity: 0;
        border: 1px solid #fff;
        &_elem {
            width: 100%;
            min-height: 48px;
            display: flex;
            gap: 12px;
            font-size: 17px;
            line-height: 143.1%;
            color: #616161;
            transition: all 0.6s ease 0s;
            background: #ffffff;
            align-items: center;
            padding: 6px 12px;
            cursor: pointer;
            border-bottom: 1px solid transparent;
            &:not(:last-child) {
                border-bottom: 1px solid rgba(214, 214, 214, 0.3);
            }
            svg {
                width: 24px;
                height: 24px;
                fill: transparent !important;
                stroke: transparent !important;
            }
            svg:not(.stroke) {
                fill: #99acd3 !important;
            }
            svg.stroke {
                stroke: #99acd3 !important;
            }
            &:hover {
                background: #331a38;
                color: #fff;
                svg:not(.stroke) {
                    fill: #fff !important;
                }
                svg.stroke {
                    stroke: #fff !important;
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
        transition: all 0.3s ease 0s;
        cursor: pointer;
        border: 1px solid transparent;
        @media (max-width: 479.98px) {
            font-size: 15px;
            line-height: 19px;
        }
        &:hover {
            text-decoration-color: #331a38;
        }
    }
    &__body {
        padding: 24px 16px 0;
        display: flex;
        flex-wrap: wrap;
        background-color: #fff;
        border-radius: 21px;
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
            span {
                color: rgba(0, 0, 0, 0.62);
                font-weight: 400;
                font-size: 16px;
                line-height: 23px;
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

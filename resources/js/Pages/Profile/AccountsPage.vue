<template>
    <Head title="Аккаунты" />
    <div class="accounts">
        <div class="accounts__wrapper">
            <main-title tag="h2" class="accounts__title">
                Аккаунты
                <span class="accounts__button">
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
            <div class="accounts__content">
                <account-profile
                    v-for="(account, index) in accounts"
                    :key="index"
                    :accountInfo="account"
                />
            </div>
        </div>
    </div>
</template>

<script>
import { Head } from "@inertiajs/vue3";
import AccountProfile from "@/Components/account/AccountProfile.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import profileLayoutView from "@/Shared/ProfileLayoutView.vue";

export default {
    components: {
        MainTitle,
        AccountProfile,
        Head,
    },
    layout: profileLayoutView,
    data() {
        return {
            accounts: {
                AleksaLoboda: {
                    img: "profile1.png",
                    myName: "Aleksa Loboda",
                    hashRate: "0.00",
                    workersActive: "0",
                    workersAll: "0",
                    todayProfit: "0.00000000",
                    myPayment: "0.00000000",
                },
                PavelPreson: {
                    img: "profile2.png",
                    myName: "Pavel Person",
                    hashRate: "0.00",
                    workersActive: "0",
                    workersAll: "0",
                    todayProfit: "0.00000000",
                    myPayment: "0.00000000",
                },
            },
        };
    },
};
</script>

<style lang="scss" scoped>
.accounts {
    &__wrapper {
        width: 100%;
    }
    &__content {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 32px;
        @media (max-width: 1270px) {
            grid-template-columns: 1fr;
        }
    }
    &__title {
        display: inline-flex;
        justify-content: space-between;
        margin-bottom: 16px;
        width: 100%;
        align-items: center;
        @media (max-width: 767.98px) {
            margin-bottom: 24px;
        }
    }
    &__button {
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
}
</style>

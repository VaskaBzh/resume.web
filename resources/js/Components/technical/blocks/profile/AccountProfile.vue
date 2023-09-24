<template>
    <div
        class="profile cabinet__block cabinet__block-light"
        :data-key="accountInfo.group_id"
        @click="chageActive"
    >
        <div class="profile__head">
            <span class="profile_name">{{ account.name || "subName" }}</span>
            <span
                class="profile_status active"
                v-if="
                    Object.entries(allAccounts).length > 0 &&
                    accountInfo.group_id === getActive
                "
            >
                {{ this.$t("accounts.toggle[0]") }}
            </span>
            <span
                class="profile_status"
                v-else-if="Object.entries(allAccounts).length > 0"
            >
                {{ this.$t("accounts.toggle[1]") }}</span
            >
            <!--            <div class="profile__settings" @click="toggleOpen">-->
            <!--                <svg-->
            <!--                    xmlns="http://www.w3.org/2000/svg"-->
            <!--                    width="32"-->
            <!--                    height="32"-->
            <!--                    viewBox="0 0 32 32"-->
            <!--                    fill="none"-->
            <!--                >-->
            <!--                    <path-->
            <!--                        d="M20 16C20 18.2091 18.2091 20 16 20C13.7909 20 12 18.2091 12 16C12 13.7909 13.7909 12 16 12C18.2091 12 20 13.7909 20 16Z"-->
            <!--                        stroke-width="2"-->
            <!--                        stroke-linecap="round"-->
            <!--                        stroke-linejoin="round"-->
            <!--                    />-->
            <!--                    <path-->
            <!--                        d="M17.2061 4.08006C16.9318 4 16.6212 4 16 4C15.3788 4 15.0682 4 14.7939 4.08006C14.3922 4.19725 14.0375 4.43743 13.7795 4.76681C13.6033 4.99183 13.4879 5.28021 13.2572 5.85695C12.9256 6.68602 12.0052 7.11294 11.1581 6.83067L10.397 6.57708C9.8572 6.39713 9.58726 6.30715 9.32262 6.29173C8.93385 6.26908 8.54694 6.36042 8.20935 6.55454C7.97953 6.68668 7.77834 6.88788 7.37596 7.29026C6.94829 7.71793 6.73445 7.93176 6.59861 8.17585C6.39903 8.53446 6.3146 8.94578 6.35678 9.35401C6.38549 9.63187 6.4978 9.91265 6.72243 10.4742C7.0742 11.3536 6.73578 12.3584 5.92363 12.8458L5.55361 13.0678C4.98708 13.4078 4.70382 13.5777 4.49806 13.8117C4.31597 14.0188 4.17868 14.2613 4.09479 14.524C4 14.8208 4 15.1544 4 15.8217C4 16.6118 4 17.0069 4.12616 17.345C4.23764 17.6438 4.41895 17.9116 4.65498 18.1261C4.9221 18.3688 5.28527 18.5141 6.01155 18.8046C6.75378 19.1015 7.13595 19.9255 6.88315 20.6839L6.59628 21.5445C6.39758 22.1406 6.29823 22.4386 6.2892 22.7315C6.27833 23.0836 6.36065 23.4323 6.52783 23.7423C6.66687 24.0002 6.88904 24.2224 7.33333 24.6667C7.77764 25.111 7.9998 25.3331 8.25767 25.4722C8.56773 25.6393 8.91645 25.7217 9.26854 25.7108C9.56137 25.7018 9.85942 25.6024 10.4555 25.4037L11.1582 25.1695C12.0052 24.8871 12.9256 25.314 13.2572 26.143C13.4879 26.7198 13.6033 27.0082 13.7795 27.2332C14.0375 27.5626 14.3922 27.8028 14.7939 27.9199C15.0682 28 15.3788 28 16 28C16.6212 28 16.9318 28 17.2061 27.9199C17.6078 27.8028 17.9625 27.5626 18.2205 27.2332C18.3967 27.0082 18.5121 26.7198 18.7428 26.143C19.0744 25.314 19.9948 24.8872 20.8418 25.1697L21.5439 25.4038C22.14 25.6025 22.4381 25.7019 22.7309 25.7109C23.083 25.7218 23.4317 25.6395 23.7418 25.4723C23.9997 25.3332 24.2218 25.1111 24.6661 24.6668C25.1104 24.2225 25.3326 24.0003 25.4716 23.7424C25.6388 23.4324 25.7211 23.0837 25.7103 22.7316C25.7012 22.4387 25.6019 22.1406 25.4032 21.5446L25.1165 20.6845C24.8636 19.9258 25.2459 19.1016 25.9884 18.8046C26.7147 18.5141 27.0779 18.3688 27.345 18.1261C27.581 17.9116 27.7624 17.6438 27.8738 17.345C28 17.0069 28 16.6118 28 15.8217C28 15.1544 28 14.8208 27.9052 14.524C27.8213 14.2613 27.684 14.0188 27.5019 13.8117C27.2962 13.5777 27.0129 13.4078 26.4464 13.0678L26.0759 12.8455C25.2637 12.3582 24.9253 11.3535 25.277 10.4741C25.5016 9.91257 25.614 9.63177 25.6427 9.35391C25.6848 8.94568 25.6004 8.53436 25.4008 8.17575C25.265 7.93166 25.0512 7.71783 24.6235 7.29016C24.2211 6.88779 24.0199 6.68658 23.7901 6.55444C23.4525 6.36032 23.0656 6.26898 22.6768 6.29163C22.4122 6.30705 22.1423 6.39703 21.6024 6.57698L20.8418 6.8305C19.9948 7.11286 19.0744 6.686 18.7428 5.85695C18.5121 5.28021 18.3967 4.99184 18.2205 4.76681C17.9625 4.43743 17.6078 4.19725 17.2061 4.08006Z"-->
            <!--                        stroke-width="2"-->
            <!--                        stroke-linecap="round"-->
            <!--                        stroke-linejoin="round"-->
            <!--                    />-->
            <!--                </svg>-->
            <!--                <main-menu-->
            <!--                    className="profile__menu"-->
            <!--                    :opened="opened"-->
            <!--                    :options="options"-->
            <!--                    @clicked="getWallets"-->
            <!--                ></main-menu>-->
            <!--            </div>-->
        </div>
        <div class="profile__body">
            <div class="profile__body-block">
                <span class="text-md">{{
                    $t("accounts.block.titles[0]")
                }}</span>
                <span class="text-md" v-hash>
                    {{ hashRate }} {{ accountInfo.unit }}H/s</span
                >
            </div>
            <div class="profile__body-block">
                <span class="text-md">{{
                    $t("accounts.block.titles[1]")
                }}</span>
                <span class="text-md">
                    {{ accountInfo.workers_count_active }} /
                    {{ workersCount }}
                    <span
                        >({{ $t("accounts.block.workers_status[0]") }} /
                        {{ $t("accounts.block.workers_status[1]") }})</span
                    >
                </span>
            </div>
            <div class="profile__body-block">
                <span class="text-md">{{
                    $t("accounts.block.titles[2]")
                }}</span>
                <span class="text-md"> {{ todayEarn }} BTC</span>
            </div>
            <div class="profile__body-block">
                <span class="text-md">{{
                    $t("accounts.block.titles[3]")
                }}</span>
                <span class="text-md"> {{ myPayment }} BTC</span>
            </div>
        </div>
    </div>
</template>
<script>
import { router } from "@inertiajs/vue3";
import { mapGetters } from "vuex";

import { Profit } from "@/Scripts/profit";

export default {
    emits: ["changeActive", "click"],
    props: {
        accountInfo: Object,
    },
    data() {
        return {
            account: this.accountInfo,
            savedName: this.accountInfo.name,
            opened: false,
        };
    },
    methods: {
        toggleOpen() {
            this.opened = !this.opened;
        },
        router() {
            return router;
        },
        chageActive() {
            this.$store.dispatch("set_active", this.accountInfo.group_id);
        },
    },
    computed: {
        ...mapGetters(["getActive", "btcInfo", "allAccounts"]),
        workersCount() {
            return (
                this.accountInfo.workers_count_active +
                    this.accountInfo.workers_count_in_active +
                    this.accountInfo.workers_count_unstable || 0
            );
        },
        todayEarn() {
            if (this.btcInfo) {
                if (this.accountInfo) {
                    return this.accountInfo.today_forecast;
                }
            }
            return 0;
        },
        myPayment() {
            let val = Number(this.account.total_payout);
            return val ? val.toFixed(8) : "0.00000000";
        },
        hashRate() {
            let val = Number(this.accountInfo.hash_per_min);
            return val ? val.toFixed(8) : "0.00000000";
        },
    },
};
</script>

<style lang="scss" scoped>
.profile {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 16px;
    padding: 24px;
    cursor: pointer;
    //svg {
    //    stroke: #417fe5;
    //    width: 24px;
    //    height: 24px;
    //    cursor: pointer;
    //    transition: all 0.3s ease 0s;
    //    @media (max-width: 479.98px) {
    //        width: 24px;
    //        height: 24px;
    //        stroke: #4182ec;
    //    }
    //}
    //.form_row {
    //    height: auto;
    //    width: 100%;
    //    position: relative;
    //    svg {
    //        position: absolute;
    //        right: 2px;
    //        top: 50%;
    //        transform: translateY(-50%);
    //        width: 24px;
    //        height: 24px;
    //        fill: #4181ea;
    //    }
    //}
    //&__settings {
    //    position: relative;
    //}
    &__head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 4px;
        @media (max-width: 479.98px) {
            flex-wrap: wrap;
        }
    }
    &_name {
        color: #3f7bdd;
        font-weight: 700;
        font-size: 24px;
        line-height: 30px;
        z-index: 1;
        @media (max-width: 991.98px) {
            font-size: 20px;
            font-style: normal;
            font-weight: 500;
            line-height: 135%;
        }
    }
    &_status {
        color: #989898;
        font-family: AmpleSoftPro, serif;
        font-weight: 500;
        font-size: 18px;
        line-height: 22px;
        transition: all 0.5s ease 0s;
        cursor: pointer;
        @media (max-width: 991.98px) {
            &:not(.active) {
                display: none;
            }
        }
        &.active {
            color: #86ff83;
        }
    }
    &__body {
        display: grid;
        border-radius: 21px;
        transition: all 0.5s ease 0.2s;
        gap: 24px;
        grid-template-columns: repeat(2, 1fr);
        @media (max-width: 991.98px) {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        &-block {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 8px;
            .text-md {
                color: var(--text-teritary);
                &:last-child {
                    color: var(--text-secondary);
                    font-weight: 700;
                    line-height: 115%;
                    @media (max-width: 991.98px) {
                        text-align: right;
                    }
                }
            }
            @media (max-width: 991.98px) {
                flex-direction: row;
                justify-content: space-between;
                .text-md {
                    font-size: 14px;
                }
            }
        }
    }
}
</style>

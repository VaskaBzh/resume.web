<template>
    <div class="accounts">
        <div class="accounts__wrapper">
            <!-- <main-title tag="h3" class="cabinet_title">
                {{ $t("accounts.title") }}
                <blue-button class="add" data-popup="#addAcc">
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
            </main-title> -->
            <main-title class="title-sub" tag="h4">{{
                    $t("accounts.title")
                }}</main-title>
            <div class="accounts__header">
                <!--                <div class="input__container">-->
                <!--                    <input-->
                <!--                        class="accounts_input"-->
                <!--                        placeholder="Поиск по имени"-->
                <!--                    />-->
                <!--                    <div class="input_svg">-->
                <!--                        <svg-->
                <!--                            xmlns="http://www.w3.org/2000/svg"-->
                <!--                            width="24"-->
                <!--                            height="24"-->
                <!--                            viewBox="0 0 24 24"-->
                <!--                            fill="none"-->
                <!--                        >-->
                <!--                            <path-->
                <!--                                d="M14 14L16.5 16.5M21.5667 21.5667C20.9891 22.1444 20.0525 22.1444 19.4748 21.5667L16.4333 18.5252C15.8556 17.9475 15.8556 17.0109 16.4333 16.4333C17.0109 15.8556 17.9475 15.8556 18.5252 16.4333L21.5667 19.4748C22.1444 20.0525 22.1444 20.9891 21.5667 21.5667ZM16 9C16 5.13401 12.866 2 9 2C5.13401 2 2 5.13401 2 9C2 12.866 5.13401 16 9 16C12.866 16 16 12.866 16 9Z"-->
                <!--                                stroke="#98A2B3"-->
                <!--                                stroke-width="1.5"-->
                <!--                                stroke-linejoin="round"-->
                <!--                            />-->
                <!--                        </svg>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--                <div class="buttons__block">-->
                <!--                    <button-->
                <!--                        class="button__container current-state"-->
                <!--                        data-popup="#addAcc"-->
                <!--                    >-->
                <!--                        <svg-->
                <!--                            xmlns="http://www.w3.org/2000/svg"-->
                <!--                            width="24"-->
                <!--                            height="24"-->
                <!--                            viewBox="0 0 24 24"-->
                <!--                            fill="none"-->
                <!--                        >-->
                <!--                            <path-->
                <!--                                fill-rule="evenodd"-->
                <!--                                clip-rule="evenodd"-->
                <!--                                d="M12.0002 2.75C9.92911 2.75 8.25018 4.42893 8.25018 6.5C8.25018 8.57107 9.92911 10.25 12.0002 10.25C14.0712 10.25 15.7502 8.57107 15.7502 6.5C15.7502 4.42893 14.0712 2.75 12.0002 2.75ZM6.75018 6.5C6.75018 3.6005 9.10068 1.25 12.0002 1.25C14.8997 1.25 17.2502 3.6005 17.2502 6.5C17.2502 9.39949 14.8997 11.75 12.0002 11.75C9.10068 11.75 6.75018 9.39949 6.75018 6.5ZM12.3954 14.8478C10.1959 14.5376 7.91061 14.9654 5.96146 16.126C5.79364 16.2259 5.60976 16.3302 5.41715 16.4395L5.417 16.4396L5.41686 16.4397C4.70426 16.844 3.87223 17.316 3.29214 17.8838C2.93202 18.2363 2.77851 18.5271 2.75395 18.7517C2.73445 18.9301 2.77954 19.2242 3.23017 19.6535C4.26602 20.6404 5.3186 21.25 6.59104 21.25H12.5002C12.9144 21.25 13.2502 21.5858 13.2502 22C13.2502 22.4142 12.9144 22.75 12.5002 22.75H6.59104C4.77274 22.75 3.36695 21.8556 2.1955 20.7396C1.51649 20.0927 1.17802 19.3646 1.26283 18.5888C1.34257 17.8592 1.78123 17.2637 2.2429 16.8118C2.98106 16.0893 4.05857 15.4814 4.77139 15.0793C4.93405 14.9875 5.07773 14.9064 5.19404 14.8372C7.44648 13.496 10.0781 13.0062 12.6049 13.3625C13.5238 13.4921 14.4189 13.7336 15.2836 14.0865C15.6671 14.243 15.8511 14.6808 15.6946 15.0643C15.538 15.4478 15.1003 15.6318 14.7168 15.4753C13.9667 15.1691 13.1916 14.9601 12.3954 14.8478ZM19.2502 15C19.2502 14.5858 18.9144 14.25 18.5002 14.25C18.086 14.25 17.7502 14.5858 17.7502 15V17.75H15.0002C14.586 17.75 14.2502 18.0858 14.2502 18.5C14.2502 18.9142 14.586 19.25 15.0002 19.25H17.7502L17.7502 22C17.7502 22.4142 18.086 22.75 18.5002 22.75C18.9144 22.75 19.2502 22.4142 19.2502 22V19.25H22.0002C22.4144 19.25 22.7502 18.9142 22.7502 18.5C22.7502 18.0858 22.4144 17.75 22.0002 17.75H19.2502V15Z"-->
                <!--                                fill="#98A2B3"-->
                <!--                            />-->
                <!--                        </svg>-->
                <!--                    </button>-->
                <!--                    <div class="button_choose-state">-->
                <!--                        <button-->
                <!--                            class="button__container"-->
                <!--                            @click="activeButton('card')"-->
                <!--                            :class="{ 'current-state': isCard }"-->
                <!--                        >-->
                <!--                            <svg-->
                <!--                                xmlns="http://www.w3.org/2000/svg"-->
                <!--                                width="24"-->
                <!--                                height="24"-->
                <!--                                viewBox="0 0 24 24"-->
                <!--                                fill="none"-->
                <!--                            >-->
                <!--                                <path-->
                <!--                                    d="M2 18C2 16.4596 2 15.6893 2.34673 15.1235C2.54074 14.8069 2.80693 14.5407 3.12353 14.3467C3.68934 14 4.45956 14 6 14C7.54044 14 8.31066 14 8.87647 14.3467C9.19307 14.5407 9.45926 14.8069 9.65327 15.1235C10 15.6893 10 16.4596 10 18C10 19.5404 10 20.3107 9.65327 20.8765C9.45926 21.1931 9.19307 21.4593 8.87647 21.6533C8.31066 22 7.54044 22 6 22C4.45956 22 3.68934 22 3.12353 21.6533C2.80693 21.4593 2.54074 21.1931 2.34673 20.8765C2 20.3107 2 19.5404 2 18Z"-->
                <!--                                    stroke="#98A2B3"-->
                <!--                                    stroke-width="1.5"-->
                <!--                                />-->
                <!--                                <path-->
                <!--                                    d="M14 18C14 16.4596 14 15.6893 14.3467 15.1235C14.5407 14.8069 14.8069 14.5407 15.1235 14.3467C15.6893 14 16.4596 14 18 14C19.5404 14 20.3107 14 20.8765 14.3467C21.1931 14.5407 21.4593 14.8069 21.6533 15.1235C22 15.6893 22 16.4596 22 18C22 19.5404 22 20.3107 21.6533 20.8765C21.4593 21.1931 21.1931 21.4593 20.8765 21.6533C20.3107 22 19.5404 22 18 22C16.4596 22 15.6893 22 15.1235 21.6533C14.8069 21.4593 14.5407 21.1931 14.3467 20.8765C14 20.3107 14 19.5404 14 18Z"-->
                <!--                                    stroke="#98A2B3"-->
                <!--                                    stroke-width="1.5"-->
                <!--                                />-->
                <!--                                <path-->
                <!--                                    d="M2 6C2 4.45956 2 3.68934 2.34673 3.12353C2.54074 2.80693 2.80693 2.54074 3.12353 2.34673C3.68934 2 4.45956 2 6 2C7.54044 2 8.31066 2 8.87647 2.34673C9.19307 2.54074 9.45926 2.80693 9.65327 3.12353C10 3.68934 10 4.45956 10 6C10 7.54044 10 8.31066 9.65327 8.87647C9.45926 9.19307 9.19307 9.45926 8.87647 9.65327C8.31066 10 7.54044 10 6 10C4.45956 10 3.68934 10 3.12353 9.65327C2.80693 9.45926 2.54074 9.19307 2.34673 8.87647C2 8.31066 2 7.54044 2 6Z"-->
                <!--                                    stroke="#98A2B3"-->
                <!--                                    stroke-width="1.5"-->
                <!--                                />-->
                <!--                                <path-->
                <!--                                    d="M14 6C14 4.45956 14 3.68934 14.3467 3.12353C14.5407 2.80693 14.8069 2.54074 15.1235 2.34673C15.6893 2 16.4596 2 18 2C19.5404 2 20.3107 2 20.8765 2.34673C21.1931 2.54074 21.4593 2.80693 21.6533 3.12353C22 3.68934 22 4.45956 22 6C22 7.54044 22 8.31066 21.6533 8.87647C21.4593 9.19307 21.1931 9.45926 20.8765 9.65327C20.3107 10 19.5404 10 18 10C16.4596 10 15.6893 10 15.1235 9.65327C14.8069 9.45926 14.5407 9.19307 14.3467 8.87647C14 8.31066 14 7.54044 14 6Z"-->
                <!--                                    stroke="#98A2B3"-->
                <!--                                    stroke-width="1.5"-->
                <!--                                />-->
                <!--                            </svg>-->
                <!--                        </button>-->
                <!--                        <button-->
                <!--                            class="button__container"-->
                <!--                            @click="activeButton('table')"-->
                <!--                            :class="{ 'current-state': isTable }"-->
                <!--                        >-->
                <!--                            <svg-->
                <!--                                xmlns="http://www.w3.org/2000/svg"-->
                <!--                                width="24"-->
                <!--                                height="24"-->
                <!--                                viewBox="0 0 24 24"-->
                <!--                                fill="none"-->
                <!--                            >-->
                <!--                                <path-->
                <!--                                    d="M2 11.4C2 10.2417 2.24173 10 3.4 10H20.6C21.7583 10 22 10.2417 22 11.4V12.6C22 13.7583 21.7583 14 20.6 14H3.4C2.24173 14 2 13.7583 2 12.6V11.4Z"-->
                <!--                                    stroke="#98A2B3"-->
                <!--                                    stroke-width="1.5"-->
                <!--                                    stroke-linecap="round"-->
                <!--                                />-->
                <!--                                <path-->
                <!--                                    d="M2 3.4C2 2.24173 2.24173 2 3.4 2H20.6C21.7583 2 22 2.24173 22 3.4V4.6C22 5.75827 21.7583 6 20.6 6H3.4C2.24173 6 2 5.75827 2 4.6V3.4Z"-->
                <!--                                    stroke="#98A2B3"-->
                <!--                                    stroke-width="1.5"-->
                <!--                                    stroke-linecap="round"-->
                <!--                                />-->
                <!--                                <path-->
                <!--                                    d="M2 19.4C2 18.2417 2.24173 18 3.4 18H20.6C21.7583 18 22 18.2417 22 19.4V20.6C22 21.7583 21.7583 22 20.6 22H3.4C2.24173 22 2 21.7583 2 20.6V19.4Z"-->
                <!--                                    stroke="#98A2B3"-->
                <!--                                    stroke-width="1.5"-->
                <!--                                    stroke-linecap="round"-->
                <!--                                />-->
                <!--                            </svg>-->
                <!--                        </button>-->
                <!--                    </div>-->
                <!--                </div>-->
            </div>
            
            <div v-if="isCard">

                <div class="accounts__content" v-if="!waitAccounts">
                    <account-profile
                        @getId="setId"
                        v-for="(account, i) in allAccounts"
                        :key="i + account.name + getActive"
                        :accKey="i"
                        :accountInfo="account"
                    />
                    <div
                        class="accounts_block cabinet__block cabinet__block-light"
                        data-popup="#addAcc"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M12.0002 2.75C9.92911 2.75 8.25018 4.42893 8.25018 6.5C8.25018 8.57107 9.92911 10.25 12.0002 10.25C14.0712 10.25 15.7502 8.57107 15.7502 6.5C15.7502 4.42893 14.0712 2.75 12.0002 2.75ZM6.75018 6.5C6.75018 3.6005 9.10068 1.25 12.0002 1.25C14.8997 1.25 17.2502 3.6005 17.2502 6.5C17.2502 9.39949 14.8997 11.75 12.0002 11.75C9.10068 11.75 6.75018 9.39949 6.75018 6.5ZM12.3954 14.8478C10.1959 14.5376 7.91061 14.9654 5.96146 16.126C5.79364 16.2259 5.60976 16.3302 5.41715 16.4395L5.417 16.4396L5.41686 16.4397C4.70426 16.844 3.87223 17.316 3.29214 17.8838C2.93202 18.2363 2.77851 18.5271 2.75395 18.7517C2.73445 18.9301 2.77954 19.2242 3.23017 19.6535C4.26602 20.6404 5.3186 21.25 6.59104 21.25H12.5002C12.9144 21.25 13.2502 21.5858 13.2502 22C13.2502 22.4142 12.9144 22.75 12.5002 22.75H6.59104C4.77274 22.75 3.36695 21.8556 2.1955 20.7396C1.51649 20.0927 1.17802 19.3646 1.26283 18.5888C1.34257 17.8592 1.78123 17.2637 2.2429 16.8118C2.98106 16.0893 4.05857 15.4814 4.77139 15.0793C4.93405 14.9875 5.07773 14.9064 5.19404 14.8372C7.44648 13.496 10.0781 13.0062 12.6049 13.3625C13.5238 13.4921 14.4189 13.7336 15.2836 14.0865C15.6671 14.243 15.8511 14.6808 15.6946 15.0643C15.538 15.4478 15.1003 15.6318 14.7168 15.4753C13.9667 15.1691 13.1916 14.9601 12.3954 14.8478ZM19.2502 15C19.2502 14.5858 18.9144 14.25 18.5002 14.25C18.086 14.25 17.7502 14.5858 17.7502 15V17.75H15.0002C14.586 17.75 14.2502 18.0858 14.2502 18.5C14.2502 18.9142 14.586 19.25 15.0002 19.25H17.7502L17.7502 22C17.7502 22.4142 18.086 22.75 18.5002 22.75C18.9144 22.75 19.2502 22.4142 19.2502 22V19.25H22.0002C22.4144 19.25 22.7502 18.9142 22.7502 18.5C22.7502 18.0858 22.4144 17.75 22.0002 17.75H19.2502V15Z"
                                fill="#98A2B3"
                            />
                        </svg>
                    </div>
                </div>
                <div v-else>
                    <!-- <main-table
                     @getId="setId"
                    v-for="(account, i) in allAccounts"
                    :key="i + account.name + getActive"
                    :accKey="i"
                    :table="account"
                /> -->
                </div>
            </div>

            <main-preloader
                class="cabinet__preloader"
                :wait="waitAccounts"
                :interval="50"
                :end="endAccounts"
            />
        </div>
    </div>
</template>

<script>
import { Head } from "@inertiajs/vue3";
import AccountProfile from "@/Components/technical/blocks/profile/AccountProfile.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import BlueButton from "@/modules/common/Components/UI/ButtonBlue.vue";
import MainPreloader from "@/modules/preloader/Components/MainPreloader.vue";
import { mapGetters } from "vuex";
import MainTable from "@/modules/table/Components/blocks/MainTable.vue";
export default {
    components: {
        MainTitle,
        AccountProfile,
        Head,
        MainPopup,
        BlueButton,
        MainPreloader,
        MainTable,
    },
    watch: {
        "$i18n.locale"() {
            document.title = this.$t("accounts.title");
        },
    },
    props: ["errors", "message", "user", "auth_user"],
    data() {
        return {
            waitAccounts: true,
            profit: {},
            id: null,
            closed: false,
            isCard: true,
            isTable: false,
        };
    },
    computed: {
        ...mapGetters([
            "allAccounts",
            "allHistoryForDays",
            "btcInfo",
            "getActive",
            "getAccount",
        ]),
        endAccounts() {
            return !!this.getAccount;
        },
    },
    methods: {
        setId(id) {
            this.id = id;
        },
        activeButton(step) {
            if (step === "card") {
                this.isCard = true;
                this.isTable = false;
            }
            if (step === "table") {
                this.isTable = true;
                this.isCard = false;
            }
        },
    },
    mounted() {
        document.title = this.$t("accounts.title");
        if (Object.values(this.allAccounts).length > 0)
            this.waitAccounts = false;
    },
    beforeUpdate() {
        document.title = this.$t("accounts.title");
        if (Object.values(this.allAccounts).length > 0)
            setTimeout(() => (this.waitAccounts = false), 300);
    },
};
</script>

<style lang="scss" scoped>
.title-sub {
    display: none;
}
@media (max-width: 500px) {
    .title-sub {
        display: inline-block;
        padding: 0 0 0px 16px;
    }
}
.accounts__header {
    display: flex;
    justify-content: center;
    //space-between
    margin-bottom: 24px;
}
.accounts_block {
    display: flex;
    align-items: center;
    cursor: pointer;
    justify-content: center;
    min-height: 202px;
    svg {
        width: 72px;
        height: 72px;
    }
}
.accounts_input {
    width: 349px;
    padding: 12px 12px 12px 44px;
    border-radius: 12px;
    background: var(--background-island);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    color: var(--text-secondary, #475467);
    font-family: NunitoSans;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 20px; /* 142.857% */
}
.buttons__block {
    display: flex;
    gap: 12px;
    position: relative;
}
.current-state {
    background: var(--background-island);
    transition: all 0.2s linear;
}
.button_choose-state {
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--buttons-fourth-fill-border-default, #2c2f34);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
}
.button__container {
    border-radius: 12px;
    padding: 8px;
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    width: 78px;
}
@media (max-width: 900px) {
    .button_choose-state {
        display: none;
    }
    .accounts_input {
        max-width: 244px;
    }
    .button__container {
        width: 40px;
    }
}
.input__container {
    position: relative;
}
.input_svg {
    position: absolute;
    top: 8px;
    left: 12px;
}

.accounts {
    padding: 24px;
    display: flex;
    flex: 1 1 auto;
    flex-direction: column;
    @media (max-width: 900px) {
        padding: 24px 12px 24px;
    }
    &__wrapper {
        width: 100%;
        flex: 1 1 auto;
    }
    &__content {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        &.preloader {
            display: flex;
        }
        @media (max-width: 1320.98px) {
            grid-template-columns: 1fr;
        }
        @media (max-width: 991.98px) {
            grid-template-columns: repeat(2, 1fr);
        }
        @media (max-width: 767.98px) {
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
            margin-bottom: 18px;
        }
    }
}
</style>

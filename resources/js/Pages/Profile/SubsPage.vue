<template>
    <Head :title="$t('accounts.title')" />
    <div class="accounts profile">
        <div class="accounts__wrapper">
            <main-title tag="h3" class="cabinet_title">
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
            </main-title>
            <div class="accounts__content" v-if="!waitAccounts">
                <account-profile
                    @getId="setId"
                    v-for="(account, i) in allAccounts"
                    :key="i + account.name + getActive"
                    :accKey="i"
                    :accountInfo="account"
                />
            </div>
            <no-info
                :wait="waitAccounts"
                :interval="50"
                :end="endAccounts"
            ></no-info>
        </div>
        <!--        <teleport to="body">-->
        <!--            <main-popup-->
        <!--                id="edit"-->
        <!--                :wait="wait"-->
        <!--                :closed="closed"-->
        <!--                :errors="errors"-->
        <!--            >-->
        <!--                <form-->
        <!--                    @submit.prevent="changeName"-->
        <!--                    class="form form-popup popup__form"-->
        <!--                >-->
        <!--                    <main-title tag="h3">{{-->
        <!--                        $t("accounts.popups.change.title")-->
        <!--                    }}</main-title>-->
        <!--                    <input-->
        <!--                        v-model="form.name"-->
        <!--                        required-->
        <!--                        autofocus-->
        <!--                        type="text"-->
        <!--                        class="input popup__input"-->
        <!--                        :placeholder="-->
        <!--                            $t('accounts.popups.change.placeholders.name')-->
        <!--                        "-->
        <!--                    />-->
        <!--                    <blue-button>-->
        <!--                        <button type="submit" class="all-link">-->
        <!--                            <svg-->
        <!--                                width="24"-->
        <!--                                height="24"-->
        <!--                                viewBox="0 0 24 24"-->
        <!--                                fill="none"-->
        <!--                                xmlns="http://www.w3.org/2000/svg"-->
        <!--                            >-->
        <!--                                <path-->
        <!--                                    d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 9.64 2 7.4 3.42 5.52C3.67 5.19 4.14 5.13 4.47 5.38C4.8 5.63 4.87 6.1 4.62 6.43C3.4 8.04 2.75 9.97 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75C11.59 2.75 11.25 2.41 11.25 2C11.25 1.59 11.59 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75Z"-->
        <!--                                />-->
        <!--                                <path-->
        <!--                                    d="M12 19.75C7.73 19.75 4.25 16.27 4.25 12C4.25 11.59 4.59 11.25 5 11.25C5.41 11.25 5.75 11.59 5.75 12C5.75 15.45 8.55 18.25 12 18.25C15.45 18.25 18.25 15.45 18.25 12C18.25 8.55 15.45 5.75 12 5.75C11.59 5.75 11.25 5.41 11.25 5C11.25 4.59 11.59 4.25 12 4.25C16.27 4.25 19.75 7.73 19.75 12C19.75 16.27 16.27 19.75 12 19.75Z"-->
        <!--                                />-->
        <!--                                <path-->
        <!--                                    d="M12 16.75C11.59 16.75 11.25 16.41 11.25 16C11.25 15.59 11.59 15.25 12 15.25C13.79 15.25 15.25 13.79 15.25 12C15.25 10.21 13.79 8.75 12 8.75C11.59 8.75 11.25 8.41 11.25 8C11.25 7.59 11.59 7.25 12 7.25C14.62 7.25 16.75 9.38 16.75 12C16.75 14.62 14.62 16.75 12 16.75Z"-->
        <!--                                />-->
        <!--                            </svg>-->
        <!--                            {{ $t("accounts.popups.change.button") }}-->
        <!--                        </button>-->
        <!--                    </blue-button>-->
        <!--                </form>-->
        <!--            </main-popup>-->
        <!--        </teleport>-->
    </div>
</template>

<script>
import { Head } from "@inertiajs/vue3";
import AccountProfile from "@/Components/technical/blocks/profile/AccountProfile.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import MainPopup from "@/Components/technical/MainPopup.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import NoInfo from "@/Components/technical/blocks/NoInfo.vue";
import { mapGetters } from "vuex";

export default {
    components: {
        MainTitle,
        AccountProfile,
        Head,
        MainPopup,
        BlueButton,
        NoInfo,
    },
    props: ["errors", "message", "user", "auth_user"],
    data() {
        return {
            waitAccounts: true,
            profit: {},
            id: null,
            closed: false,
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
.accounts {
    &__wrapper {
        width: 100%;
    }
    &__content {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        &.no-info {
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

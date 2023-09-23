<template>
    <div @click="toggleMenu" class="button">
        <div
            class="button_name"
            :class="{ 'button_name-target': target }"
            ref="name"
        >
        <div>
            <p class="user-name-text">{{ name }}</p>
            <p class="user-title-text">{{$t("header.user_title")}}</p>
        </div>
            <svg v-show="accounts.length > 1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M18 9.00005C18 9.00005 13.5811 15 12 15C10.4188 15 6 9 6 9" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="button__menu" ref="menu" :class="{ target: target }" v-show="accounts.length > 1">
            <div class="button__row">
                <main-radio
                    v-for="(option, i) in accounts"
                    :key="i"
                    :options="option"
                    :getActive="getActive"
                ></main-radio>
            </div>
        </div>
    </div>
    <teleport to="body">
        <main-popup
            id="addAcc"
            :openedOff="openedAddPopup"
            :wait="wait"
            :closed="closed"
            :errors="errors"
        >
            <form @submit.prevent="addAcc" class="form form-popup popup__form">
                <main-title tag="h3">{{
                    $t("accounts.popups.add.title")
                }}</main-title>
                <p class="popup-text">
                    {{
                        $t("accounts.popups.add.text")
                    }}
                </p>
                <input
                    ref="input"
                    v-model="form.name"
                    required
                    autofocus
                    type="text"
                    class="input popup__input"
                    :placeholder="$t('accounts.popups.add.placeholders.name')"
                />
                    <button type="submit" class="all-link blue-button">
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
                        {{ $t("accounts.popups.add.button") }}
                    </button>
            </form>
        </main-popup>
    </teleport>
</template>

<script>
import BlueButton from "@/modules/common/Components/UI/ButtonBlue.vue";
import { mapGetters } from "vuex";
import MainRadio from "@/modules/common/Components/UI/MainRadio.vue";
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import { openNotification } from '@/modules/notifications/services/NotificationServices';
import store from "../../../../store";
import { ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import api from "@/api/api";

export default {
    name: "account-menu",
    components: {
        MainTitle,
        MainPopup,
        BlueButton,
        MainRadio,
    },
    props: {
        user: {
            type: Object,
        },
        is_auth: {
            type: Boolean,
            default: false,
        },
        viewportWidth: {
            type: Number,
            require: true,
        },
    },
    data() {
        return {
            target: false,
            open: false,
            openedAddPopup: false,
            linkAddClicked: false,
            name: "...",
        };
    },
    mounted() {
        this.name = this.getAccount === {} ? "..." : this.getAccount.name;

        document.addEventListener("click", this.hideMenuClick, true);
        document.addEventListener("keydown", this.hideKey);
    },
    unmounted() {
        document.removeEventListener("click", this.hideMenuClick, true);
        document.removeEventListener("keydown", this.hideKey);
    },
    setup() {
        let wait = ref(false);
        let closed = ref(false);
        const router = useRouter();

        const form = {
            name: "",
        };

        const addAcc = async () => {
            wait.value = true;
            try {
               const response =  await api.post("/subs/create", form, {
                    headers: {
                        Authorization: `Bearer ${store.getters.token}`,
                    },
                });
                openNotification(response.data.message, 'Добавлено')
                closed.value = true;
                store.dispatch("accounts_all", store.getters.user.id);

            } catch (e) {
                console.error("Error with: " + e);
                store.dispatch("setFullErrors", e.response.data.errors);
            }

            wait.value = false;
            store.dispatch("accounts_all", store.getters.user.id);
        };

        return {
            form,
            addAcc,
            wait,
            closed,
        };
    },
    computed: {
        ...mapGetters([
            "getIncome",
            "getAccount",
            "allAccounts",
            "getActive",
            "errors",
        ]),
        accounts() {
            let arr = [];
            if (this.allAccounts && Object.values(this.allAccounts)[0]) {
                arr.length = 0;
                Object.values(this.allAccounts).forEach((acc) => {
                    arr.push({
                        title: acc.name,
                        value: acc.group_id,
                    });
                });
            }
            return arr;
        },
        earnSum() {
            let sum = 0;
            if (Object.values(this.getIncome).length > 0) {
                Object.values(this.getIncome).forEach((el) => {
                    sum += Number(el.accruals);
                });
            }
            return sum.toFixed(8);
        },
    },
    watch: {
        getAccount(newValue) {
            this.name = newValue.name;
        },
        accounts() {
            this.change_height();
        },
        linkAddClicked(newBool) {
            if (this.$route.fullPath !== "/profile/accounts" && newBool) {
                this.linkAddClicked = false;
                setTimeout(() => {
                    this.openedAddPopup = true;
                }, 50);
                setTimeout(() => {
                    this.openedAddPopup = false;
                }, 100);
            }
        },
    },
    methods: {
        async openAddPopup() {
            if (this.$route.fullPath !== "/profile/accounts") {
                await this.$router.push({ name: "accounts" });

                this.linkAddClicked = true;

                setTimeout(() => {
                    this.$refs.input.focus();
                }, 300);
            } else {
                this.openedAddPopup = true;

                setTimeout(() => {
                    this.$refs.input.focus();
                }, 300);

                setTimeout(() => {
                    this.openedAddPopup = false;
                }, 100);
            }
        },
        change_height() {
            if (this.target) {
                this.$nextTick(() => {
                    const height = this.$refs.menu.scrollHeight;
                    this.$refs.menu.style.maxHeight = `${height}px`;
                    if (this.viewportWidth <= 991.98) {
                        this.$refs.name.style.marginBottom = `${height + 8}px`;
                    }
                });
            } else {
                this.$refs.menu.style.maxHeight = `0`;
                if (this.viewportWidth <= 991.98) {
                    this.$refs.name.style.marginBottom = `0`;
                }
            }
        },
        change_index(data) {
            this.$store.dispatch("set_active", data);
        },
        hideKey(e) {
            if (e.keyCode === 27) {
                this.hideMenu();
            }
        },
        hideMenu() {
            this.target = false;
            this.change_height();
        },
        hideMenuClick(e) {
            if (
                !e.target.closest(".nav__container .button .button_name") &&
                !e.target.closest(".nav__container .button .button__row")
            )
                this.hideMenu();
        },
        toggleMenu() {
            this.target = !this.target;
            this.change_height();
            if (this.target === true) {
                setTimeout(() => (this.open = true), 300);
                this.$emit("clicked", true);
            }
        },
    },
};
</script>

<style scoped lang="scss">
.popup-text{
    color: var(--text-teritary-day, #98A2B3);
    font-family: NunitoSans;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px; /* 150% */
    margin-bottom: 40px;
}
.user-name-text{
    color: var(--text-primary-inverse);
    font-family: Unbounded;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%; /* 24px */
}
.user-title-text{
    color: var(--text-primary-inverse);
    font-family: NunitoSans;
    font-size: 12px;
    font-weight: 600;
    line-height: 135%; /* 16.2px */
}
.popup__input{
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--background-island, #FFF);
    padding: var(--py-4, 16px) var(--px-4, 16px);
    color: var(--select-text-no-value-day, #D0D5DD);
    font-family: NunitoSans;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px; /* 150% */
}
.blue-button{
    border-radius: 12px;
    background: var(--buttons-primary-fill-border-default, #2E90FA);
    /* shadow-btn-xl */
    box-shadow: 0px 10px 10px -6px rgba(0, 0, 0, 0.10);
    padding: 12px 16px;
    color: var(--buttons-primary-text, #FFF);
    /* Body 1/Nunito Sans 10pt/18/Bold */
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: 32px; /* 177.778% */
    margin: 80px 0 0px;
}
.button {
    position: relative;
    width:270px;
    margin-bottom: 16px;
    &_name {
        width: 100%;
        cursor: pointer;
        transition: all 0.5s ease 0s;
        border-radius: 16px;
        background: var(--gradient-v-1, linear-gradient(117deg, #024BC0 16.84%, #3597F9 103.73%));
        box-shadow: 0px 0px 1px 0px rgba(0, 0, 0, 0.40), 0px 8px 24px -6px rgba(0, 0, 0, 0.16);
        display: flex;
        padding: 16px;
        color: var(--background-island, #FFF);
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%; /* 24px */
        align-items: center;
        gap: 16px;
        align-self: stretch;
        &-target {
            svg {
                &:last-child {
                    transform: rotate(180deg);
                }
            }
        }
        svg {
            fill: #3f7bdd;
            transition: all 0.5s ease 0s;
            &:last-child {
                margin-left: auto;
            }
        }

    }
    .list_button {
        a {
            text-decoration: none;
        }
    }
    .mini {
        height: fit-content;
    }
    .target {
        &.button {
            &__menu {
                visibility: visible;
                opacity: 1;
                transition: all 0.5s ease 0s;
            }
        }
    }
    &__row {
        position: relative;
        &:not(:first-child) {
            height: 40px;
        }
        &:not(:last-child) {
            &:after {
                content: "";
                width: 100%;
                height: 1px;
                background: #c5c5c5;
                position: absolute;
                left: 0;
                bottom: 0;
            }
        }
    }
    &_title {
        font-weight: 500;
        font-size: 16px;
        line-height: 143.1%;
        color: #969797;
    }
    &__menu {
        visibility: hidden;
        opacity: 0;
        height: fit-content;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border-radius: 16px;
        background: var(--background-sub-dropdown, #FFF);
        box-shadow: 0px 2px 12px -1px rgba(16, 24, 40, 0.08);
        min-width: 100%;
        padding: 4px;
        position: absolute;
        color: var(--text-secondary);
        right: 0;
        top: 80px;
        transition: all 0.5s ease 0s;
}
}
</style>

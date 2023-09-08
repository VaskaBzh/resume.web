<template>
    <div @click="toggleMenu" class="button">
        <div
            class="button_name"
            :class="{ 'button_name-target': target }"
            ref="name"
        >
            <svg
                width="22"
                height="22"
                viewBox="0 0 22 22"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M11.0003 3.66553C11.9606 3.68412 12.8752 4.07865 13.5478 4.76435C14.2203 5.45004 14.5971 6.37219 14.5971 7.33265C14.5971 8.29312 14.2203 9.21526 13.5478 9.90096C12.8752 10.5867 11.9606 10.9812 11.0003 10.9998C10.04 10.9812 9.1253 10.5867 8.45276 9.90096C7.78021 9.21526 7.40347 8.29312 7.40347 7.33265C7.40347 6.37219 7.78021 5.45004 8.45276 4.76435C9.1253 4.07865 10.04 3.68412 11.0003 3.66553ZM11.0003 12.834C15.0531 12.834 18.3345 14.4751 18.3345 16.4998V18.334H3.66602V16.4998C3.66602 14.4751 6.94745 12.834 11.0003 12.834Z"
                />
            </svg>

            {{ name }}
            <svg
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M1.70833 6.33317L2.89583 5.1665L10.0417 12.3123L17.1875 5.1665L18.375 6.33317L10.0417 14.6665L1.70833 6.33317Z"
                />
            </svg>
        </div>
        <div class="button__menu" ref="menu" :class="{ target: target }">
            <div class="button__row">
                <main-radio
                    v-for="(option, i) in accounts"
                    :key="i"
                    :options="option"
                    :getActive="getActive"
                ></main-radio>
            </div>
            <div class="button__row">
                <a @click.prevent="openAddPopup"
                    ><svg
                        width="22"
                        height="22"
                        viewBox="0 0 22 22"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M10.3132 17.4168V11.6877H4.58398V10.3127H10.3132V4.5835H11.6882V10.3127H17.4173V11.6877H11.6882V17.4168H10.3132Z"
                        />
                    </svg>
                    {{ $t("header.menu.acc_admin.add") }}
                </a>
            </div>
            <div class="button__row" v-if="viewportWidth >= 991.98">
                <router-link class="settings" :to="{ name: 'settings' }"
                    ><svg
                        width="16"
                        height="17"
                        viewBox="0 0 16 17"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M6.46634 15.1663L6.13301 13.0663C5.9219 12.9886 5.69967 12.883 5.46634 12.7497C5.23301 12.6163 5.02745 12.4775 4.84967 12.333L2.88301 13.233L1.33301 10.4997L3.13301 9.18301C3.11079 9.08301 3.0969 8.96912 3.09134 8.84134C3.08579 8.71356 3.08301 8.59967 3.08301 8.49967C3.08301 8.39967 3.08579 8.28579 3.09134 8.15801C3.0969 8.03023 3.11079 7.91634 3.13301 7.81634L1.33301 6.49967L2.88301 3.76634L4.84967 4.66634C5.02745 4.5219 5.23301 4.38301 5.46634 4.24967C5.69967 4.11634 5.9219 4.01634 6.13301 3.94967L6.46634 1.83301H9.53301L9.86634 3.93301C10.0775 4.01079 10.3025 4.11356 10.5413 4.24134C10.7802 4.36912 10.983 4.51079 11.1497 4.66634L13.1163 3.76634L14.6663 6.49967L12.8663 7.78301C12.8886 7.89412 12.9025 8.01356 12.908 8.14134C12.9136 8.26912 12.9163 8.38856 12.9163 8.49967C12.9163 8.61079 12.9136 8.72745 12.908 8.84967C12.9025 8.9719 12.8886 9.08856 12.8663 9.19967L14.6663 10.4997L13.1163 13.233L11.1497 12.333C10.9719 12.4775 10.7691 12.6191 10.5413 12.758C10.3136 12.8969 10.0886 12.9997 9.86634 13.0663L9.53301 15.1663H6.46634ZM7.99967 10.6663C8.59967 10.6663 9.11079 10.4552 9.53301 10.033C9.95523 9.61079 10.1663 9.09967 10.1663 8.49967C10.1663 7.89967 9.95523 7.38856 9.53301 6.96634C9.11079 6.54412 8.59967 6.33301 7.99967 6.33301C7.39967 6.33301 6.88856 6.54412 6.46634 6.96634C6.04412 7.38856 5.83301 7.89967 5.83301 8.49967C5.83301 9.09967 6.04412 9.61079 6.46634 10.033C6.88856 10.4552 7.39967 10.6663 7.99967 10.6663ZM7.99967 9.66634C7.67745 9.66634 7.40245 9.55245 7.17467 9.32467C6.9469 9.0969 6.83301 8.8219 6.83301 8.49967C6.83301 8.17745 6.9469 7.90245 7.17467 7.67467C7.40245 7.4469 7.67745 7.33301 7.99967 7.33301C8.3219 7.33301 8.5969 7.4469 8.82467 7.67467C9.05245 7.90245 9.16634 8.17745 9.16634 8.49967C9.16634 8.8219 9.05245 9.0969 8.82467 9.32467C8.5969 9.55245 8.3219 9.66634 7.99967 9.66634ZM7.26634 14.1663H8.73301L8.96634 12.2997C9.33301 12.2108 9.68023 12.0719 10.008 11.883C10.3358 11.6941 10.633 11.4663 10.8997 11.1997L12.6663 11.9663L13.333 10.7663L11.7663 9.61634C11.8108 9.42745 11.8469 9.24134 11.8747 9.05801C11.9025 8.87467 11.9163 8.68856 11.9163 8.49967C11.9163 8.31079 11.9052 8.12467 11.883 7.94134C11.8608 7.75801 11.8219 7.5719 11.7663 7.38301L13.333 6.23301L12.6663 5.03301L10.8997 5.79967C10.6441 5.51079 10.3552 5.26912 10.033 5.07467C9.71078 4.88023 9.35523 4.75523 8.96634 4.69967L8.73301 2.83301H7.26634L7.03301 4.69967C6.65523 4.77745 6.30245 4.91079 5.97467 5.09967C5.6469 5.28856 5.35523 5.5219 5.09967 5.79967L3.33301 5.03301L2.66634 6.23301L4.23301 7.38301C4.18856 7.5719 4.15245 7.75801 4.12467 7.94134C4.0969 8.12467 4.08301 8.31079 4.08301 8.49967C4.08301 8.68856 4.0969 8.87467 4.12467 9.05801C4.15245 9.24134 4.18856 9.42745 4.23301 9.61634L2.66634 10.7663L3.33301 11.9663L5.09967 11.1997C5.36634 11.4663 5.66356 11.6941 5.99134 11.883C6.31912 12.0719 6.66634 12.2108 7.03301 12.2997L7.26634 14.1663Z"
                        />
                    </svg>

                    {{ $t("header.menu.acc_admin.settings") }}</router-link
                >
            </div>
            <div class="button__row">
                <button @click.prevent="logout">
                    <svg
                        width="16"
                        height="17"
                        viewBox="0 0 16 17"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M4.1502 13.0502L3.4502 12.3502L7.3002 8.5002L3.4502 4.6502L4.1502 3.9502L8.0002 7.8002L11.8502 3.9502L12.5502 4.6502L8.7002 8.5002L12.5502 12.3502L11.8502 13.0502L8.0002 9.2002L4.1502 13.0502Z"
                        />
                    </svg>

                    {{ $t("header.menu.acc_admin.logout") }}
                </button>
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
                <input
                    ref="input"
                    v-model="form.name"
                    required
                    autofocus
                    type="text"
                    class="input popup__input"
                    :placeholder="$t('accounts.popups.add.placeholders.name')"
                />
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
                        {{ $t("accounts.popups.add.button") }}
                    </button>
                </blue-button>
            </form>
        </main-popup>
    </teleport>
</template>

<script>
import BlueButton from "@/Components/UI/BlueButton.vue";
import { mapGetters } from "vuex";
import MainRadio from "@/Components/UI/MainRadio.vue";
import MainPopup from "@/Components/technical/MainPopup.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import store from "../../../store";
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
                await api.post("/subs/create", form, {
                    headers: {
                        Authorization: `Bearer ${store.getters.token}`,
                    },
                });

                closed.value = true;
                store.dispatch("accounts_all", store.getters.user.id);
            } catch (e) {
                console.error("Error with: " + e);
                store.dispatch("setFullErrors", e.response.data.errors);
            }

            wait.value = false;
            store.dispatch("accounts_all", store.getters.user.id);
        };

        const logout = async () => {
            try {
                await api.post(
                    "/logout",
                    {},
                    {
                        headers: {
                            Authorization: `Bearer ${store.getters.token}`,
                        },
                    }
                );

                store.dispatch("dropUser");
                store.dispatch("dropToken");

                router.push({ name: "default" });
            } catch (e) {
                console.error("Error with: " + e);
            }
        };

        return {
            logout,
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
.button {
    position: relative;
    min-width: 160px;
    width: fit-content;
    @media (min-width: 991.98px) {
        margin-left: 40px;
    }
    @media (max-width: 991.98px) {
        min-width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }
    &_name {
        width: 100%;
        cursor: pointer;
        transition: all 0.5s ease 0s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        color: #3f7bdd;
        min-width: 160px;
        font-size: 16px;
        line-height: 150%;
        border: 1px solid #3f7bdd;
        padding: 0 24px;
        min-height: 40px;
        border-radius: 8px;
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
        @media (max-width: 991.98px) {
            background: #d2def2;
            border: none;
            padding: 0 16px;
            min-height: 56px;
            gap: 8px;
            font-weight: 500;
            font-size: 18px;
            line-height: 120%;
            svg {
                width: 24px;
                height: 24px;
                &:last-child {
                    width: 22px;
                    height: 22px;
                }
            }
        }
        @media (max-width: 479.98px) {
            background: #d2def2;
            border: none;
            min-height: 48px;
        }
        @media (min-width: 991.98px) {
            &:hover {
                background: #c6d8f5;
                border: 1px solid #c6d8f5;
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
        padding: 8px 0;
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
        border-radius: 8px;
        visibility: hidden;
        opacity: 0;
        height: fit-content;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        background: #fafafa;
        min-width: 100%;
        padding: 16px;
        position: absolute;
        color: #818c99;
        right: 0;
        top: 48px;
        transition: all 0.5s ease 0s;
        @media (max-width: 991.98px) {
            top: 64px;
        }
        @media (max-width: 479.98px) {
            top: 56px;
        }
        @media (min-width: 991.98px) {
            min-width: 326px;
        }
        button,
        a {
            font-weight: 400;
            display: inline-flex;
            gap: 8px;
            align-items: center;
            transition: all 0.3s ease 0s;
            width: 100%;
            font-size: 16px;
            line-height: 120%;
        }
        button {
            color: #e5403f;
            svg {
                fill: #e5403f;
            }
        }
        svg {
            width: 22px;
            height: 22px;
            fill: #3f7bdd;
        }
    }
}
</style>

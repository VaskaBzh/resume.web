<template>
    <div @click="toggleMenu" class="button">
        <div class="button_name" ref="name">
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

            {{ this.name }}
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
                <Link class="settings" :href="route('settings')"
                    ><svg
                        width="16"
                        height="17"
                        viewBox="0 0 16 17"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M6.46634 15.1663L6.13301 13.0663C5.9219 12.9886 5.69967 12.883 5.46634 12.7497C5.23301 12.6163 5.02745 12.4775 4.84967 12.333L2.88301 13.233L1.33301 10.4997L3.13301 9.18301C3.11079 9.08301 3.0969 8.96912 3.09134 8.84134C3.08579 8.71356 3.08301 8.59967 3.08301 8.49967C3.08301 8.39967 3.08579 8.28579 3.09134 8.15801C3.0969 8.03023 3.11079 7.91634 3.13301 7.81634L1.33301 6.49967L2.88301 3.76634L4.84967 4.66634C5.02745 4.5219 5.23301 4.38301 5.46634 4.24967C5.69967 4.11634 5.9219 4.01634 6.13301 3.94967L6.46634 1.83301H9.53301L9.86634 3.93301C10.0775 4.01079 10.3025 4.11356 10.5413 4.24134C10.7802 4.36912 10.983 4.51079 11.1497 4.66634L13.1163 3.76634L14.6663 6.49967L12.8663 7.78301C12.8886 7.89412 12.9025 8.01356 12.908 8.14134C12.9136 8.26912 12.9163 8.38856 12.9163 8.49967C12.9163 8.61079 12.9136 8.72745 12.908 8.84967C12.9025 8.9719 12.8886 9.08856 12.8663 9.19967L14.6663 10.4997L13.1163 13.233L11.1497 12.333C10.9719 12.4775 10.7691 12.6191 10.5413 12.758C10.3136 12.8969 10.0886 12.9997 9.86634 13.0663L9.53301 15.1663H6.46634ZM7.99967 10.6663C8.59967 10.6663 9.11079 10.4552 9.53301 10.033C9.95523 9.61079 10.1663 9.09967 10.1663 8.49967C10.1663 7.89967 9.95523 7.38856 9.53301 6.96634C9.11079 6.54412 8.59967 6.33301 7.99967 6.33301C7.39967 6.33301 6.88856 6.54412 6.46634 6.96634C6.04412 7.38856 5.83301 7.89967 5.83301 8.49967C5.83301 9.09967 6.04412 9.61079 6.46634 10.033C6.88856 10.4552 7.39967 10.6663 7.99967 10.6663ZM7.99967 9.66634C7.67745 9.66634 7.40245 9.55245 7.17467 9.32467C6.9469 9.0969 6.83301 8.8219 6.83301 8.49967C6.83301 8.17745 6.9469 7.90245 7.17467 7.67467C7.40245 7.4469 7.67745 7.33301 7.99967 7.33301C8.3219 7.33301 8.5969 7.4469 8.82467 7.67467C9.05245 7.90245 9.16634 8.17745 9.16634 8.49967C9.16634 8.8219 9.05245 9.0969 8.82467 9.32467C8.5969 9.55245 8.3219 9.66634 7.99967 9.66634ZM7.26634 14.1663H8.73301L8.96634 12.2997C9.33301 12.2108 9.68023 12.0719 10.008 11.883C10.3358 11.6941 10.633 11.4663 10.8997 11.1997L12.6663 11.9663L13.333 10.7663L11.7663 9.61634C11.8108 9.42745 11.8469 9.24134 11.8747 9.05801C11.9025 8.87467 11.9163 8.68856 11.9163 8.49967C11.9163 8.31079 11.9052 8.12467 11.883 7.94134C11.8608 7.75801 11.8219 7.5719 11.7663 7.38301L13.333 6.23301L12.6663 5.03301L10.8997 5.79967C10.6441 5.51079 10.3552 5.26912 10.033 5.07467C9.71078 4.88023 9.35523 4.75523 8.96634 4.69967L8.73301 2.83301H7.26634L7.03301 4.69967C6.65523 4.77745 6.30245 4.91079 5.97467 5.09967C5.6469 5.28856 5.35523 5.5219 5.09967 5.79967L3.33301 5.03301L2.66634 6.23301L4.23301 7.38301C4.18856 7.5719 4.15245 7.75801 4.12467 7.94134C4.0969 8.12467 4.08301 8.31079 4.08301 8.49967C4.08301 8.68856 4.0969 8.87467 4.12467 9.05801C4.15245 9.24134 4.18856 9.42745 4.23301 9.61634L2.66634 10.7663L3.33301 11.9663L5.09967 11.1997C5.36634 11.4663 5.66356 11.6941 5.99134 11.883C6.31912 12.0719 6.66634 12.2108 7.03301 12.2997L7.26634 14.1663Z"
                            fill="#3F7BDD"
                        />
                    </svg>

                    {{ $t("header.menu.acc_admin.settings") }}</Link
                >
            </div>
            <div class="button__row">
                <form @submit.prevent="logout">
                    <button type="submit">
                        <svg
                            width="16"
                            height="17"
                            viewBox="0 0 16 17"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M4.1502 13.0502L3.4502 12.3502L7.3002 8.5002L3.4502 4.6502L4.1502 3.9502L8.0002 7.8002L11.8502 3.9502L12.5502 4.6502L8.7002 8.5002L12.5502 12.3502L11.8502 13.0502L8.0002 9.2002L4.1502 13.0502Z"
                                fill="#E5403F"
                            />
                        </svg>

                        {{ $t("header.menu.acc_admin.logout") }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import BlueButton from "@/Components/UI/BlueButton.vue";
import { mapGetters } from "vuex";
import MainList from "@/Components/UI/MainList.vue";
import { Link } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import MainRadio from "@/Components/UI/MainRadio.vue";

export default {
    name: "account-menu",
    components: {
        MainList,
        BlueButton,
        MainRadio,
        Link,
    },
    props: {
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
        };
    },
    mounted() {
        document.addEventListener("click", this.hideMenu.bind(this), true);
        document.addEventListener("keydown", (e) => {
            if (e.keyCode === 27) {
                this.hideMenu();
            }
        });
    },
    setup() {
        const logout = async () => {
            await Inertia.post("/logout");
        };

        return {
            logout,
        };
    },
    computed: {
        ...mapGetters(["getIncome", "allAccounts", "getActive"]),
        accounts() {
            let arr = [];
            if (this.allAccounts && Object.values(this.allAccounts)[0]) {
                arr.length = 0;
                Object.values(this.allAccounts).forEach((acc) => {
                    arr.push({
                        title: acc.name,
                        value: acc.id,
                    });
                });
            }
            return arr;
        },
        name() {
            let name = "...";
            if (this.allAccounts[this.getActive]) {
                name = this.allAccounts[this.getActive].name;
            }
            return name;
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
    methods: {
        change_height() {
            if (this.target) {
                this.$nextTick(() => {
                    const height = this.$refs.menu.scrollHeight;
                    this.$refs.menu.style.maxHeight = `${height}px`;
                    if (this.viewportWidth <= 991.98) {
                        this.$refs.name.style.marginBottom = `${height}px`;
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
            this.$store.commit("updateActive", data);
        },
        hideMenu() {
            this.target = false;
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
    width: 100%;
    min-width: 160px;
    @media (max-width: 991.98px) {
        min-width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }
    &_name {
        width: 100%;
        cursor: pointer;
        transition: all 0.3s ease 0s;
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
        svg {
            fill: #3f7bdd;
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
        &:not(:last-child) {
            &:after {
                content: "";
                width: 100%;
                height: 1px;
                background: linear-gradient(
                    179.87deg,
                    #e6eaf0 1.02%,
                    #e6eaf1 4.79%,
                    #e7ebf1 8.76%,
                    #eaeef4 14.75%,
                    #e8ecf2 19.07%
                );
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
        box-shadow: 0 4px 10px rgba(35, 38, 63, 0.15);
        min-width: 100%;
        padding: 16px;
        position: absolute;
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
        }
        svg {
            width: 16px;
            height: 16px;
        }
    }
}
</style>

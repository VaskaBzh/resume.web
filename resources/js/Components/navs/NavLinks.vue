<template>
    <div class="nav__links_con">
        <div class="nav__links">
            <div
                class="nav__button nav__button-account"
                v-show="viewportWidth <= 767.78 && is_auth"
            >
                <Link :href="route('profile')" class="nav__button_link">
                    {{ this.name }}
                </Link>
                <div class="nav__button_menu">
                    <main-list>
                        <template
                            v-slot:head
                            v-if="
                                this.allAccounts[this.getActive] &&
                                this.getIncome[this.getActive].accruals
                            "
                        >
                            {{
                                this.getIncome[this.getActive].accruals.toFixed(
                                    8
                                )
                            }}
                            BTC</template
                        >
                        <template v-slot:head v-else> 0.00000000 BTC</template>
                        <template v-slot:body>
                            <div class="list_row">
                                <span>Всего</span>
                                <span> {{ this.earnSum }} BTC</span>
                            </div>
                            <div class="list_row">
                                <blue-button class="list_button"
                                    ><Link :href="route('income')"
                                        >Доходы</Link
                                    ></blue-button
                                >
                            </div>
                        </template>
                    </main-list>
                    <Link :href="route('settings')"
                    ><svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                            stroke="#99ACD3"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M12.9046 3.06005C12.6988 3 12.4659 3 12 3C11.5341 3 11.3012 3 11.0954 3.06005C10.7942 3.14794 10.5281 3.32808 10.3346 3.57511C10.2024 3.74388 10.1159 3.96016 9.94291 4.39272C9.69419 5.01452 9.00393 5.33471 8.36857 5.123L7.79779 4.93281C7.3929 4.79785 7.19045 4.73036 6.99196 4.7188C6.70039 4.70181 6.4102 4.77032 6.15701 4.9159C5.98465 5.01501 5.83376 5.16591 5.53197 5.4677C5.21122 5.78845 5.05084 5.94882 4.94896 6.13189C4.79927 6.40084 4.73595 6.70934 4.76759 7.01551C4.78912 7.2239 4.87335 7.43449 5.04182 7.85566C5.30565 8.51523 5.05184 9.26878 4.44272 9.63433L4.16521 9.80087C3.74031 10.0558 3.52786 10.1833 3.37354 10.3588C3.23698 10.5141 3.13401 10.696 3.07109 10.893C3 11.1156 3 11.3658 3 11.8663C3 12.4589 3 12.7551 3.09462 13.0088C3.17823 13.2329 3.31422 13.4337 3.49124 13.5946C3.69158 13.7766 3.96395 13.8856 4.50866 14.1035C5.06534 14.3261 5.35196 14.9441 5.16236 15.5129L4.94721 16.1584C4.79819 16.6054 4.72367 16.829 4.7169 17.0486C4.70875 17.3127 4.77049 17.5742 4.89587 17.8067C5.00015 18.0002 5.16678 18.1668 5.5 18.5C5.83323 18.8332 5.99985 18.9998 6.19325 19.1041C6.4258 19.2295 6.68733 19.2913 6.9514 19.2831C7.17102 19.2763 7.39456 19.2018 7.84164 19.0528L8.36862 18.8771C9.00393 18.6654 9.6942 18.9855 9.94291 19.6073C10.1159 20.0398 10.2024 20.2561 10.3346 20.4249C10.5281 20.6719 10.7942 20.8521 11.0954 20.94C11.3012 21 11.5341 21 12 21C12.4659 21 12.6988 21 12.9046 20.94C13.2058 20.8521 13.4719 20.6719 13.6654 20.4249C13.7976 20.2561 13.8841 20.0398 14.0571 19.6073C14.3058 18.9855 14.9961 18.6654 15.6313 18.8773L16.1579 19.0529C16.605 19.2019 16.8286 19.2764 17.0482 19.2832C17.3123 19.2913 17.5738 19.2296 17.8063 19.1042C17.9997 18.9999 18.1664 18.8333 18.4996 18.5001C18.8328 18.1669 18.9994 18.0002 19.1037 17.8068C19.2291 17.5743 19.2908 17.3127 19.2827 17.0487C19.2759 16.8291 19.2014 16.6055 19.0524 16.1584L18.8374 15.5134C18.6477 14.9444 18.9344 14.3262 19.4913 14.1035C20.036 13.8856 20.3084 13.7766 20.5088 13.5946C20.6858 13.4337 20.8218 13.2329 20.9054 13.0088C21 12.7551 21 12.4589 21 11.8663C21 11.3658 21 11.1156 20.9289 10.893C20.866 10.696 20.763 10.5141 20.6265 10.3588C20.4721 10.1833 20.2597 10.0558 19.8348 9.80087L19.5569 9.63416C18.9478 9.26867 18.6939 8.51514 18.9578 7.85558C19.1262 7.43443 19.2105 7.22383 19.232 7.01543C19.2636 6.70926 19.2003 6.40077 19.0506 6.13181C18.9487 5.94875 18.7884 5.78837 18.4676 5.46762C18.1658 5.16584 18.0149 5.01494 17.8426 4.91583C17.5894 4.77024 17.2992 4.70174 17.0076 4.71872C16.8091 4.73029 16.6067 4.79777 16.2018 4.93273L15.6314 5.12287C14.9961 5.33464 14.3058 5.0145 14.0571 4.39272C13.8841 3.96016 13.7976 3.74388 13.6654 3.57511C13.4719 3.32808 13.2058 3.14794 12.9046 3.06005Z"
                            stroke="#99ACD3"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                        Настройки</Link
                    >
                    <Link :href="route('home')" @click.prevent="logout"
                        ><svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M16 16L20 12M20 12L16 8M20 12H10M12 4H7.2C6.0799 4 5.51984 4 5.09202 4.21799C4.71569 4.40973 4.40973 4.71569 4.21799 5.09202C4 5.51984 4 6.0799 4 7.2V16.8C4 17.9201 4 18.4802 4.21799 18.908C4.40973 19.2843 4.71569 19.5903 5.09202 19.782C5.51984 20 6.0799 20 7.2 20H12"
                                stroke="#99ACD3"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        Выход</Link
                    >
                </div>
            </div>
            <Link
                v-if="!is_auth"
                :href="route('home')"
                class="nav__link"
                :class="{ active: $page.url === '/' }"
            >
                Главная
            </Link>
            <Link
                v-else
                :href="route('statistic')"
                class="nav__link"
                :class="{ active: $page.url.startsWith('/profile') }"
            >
                Личный кабинет
            </Link>
            <Link
                :href="route('complexity')"
                class="nav__link"
                :class="{ active: $page.url.startsWith('/complexity') }"
            >
                Сложность
            </Link>
            <!--            <Link-->
            <!--                :href="route('help')"-->
            <!--                class="nav__link"-->
            <!--                :class="{ active: $page.url === '/help' }"-->
            <!--            >-->
            <!--                FAQ-->
            <!--            </Link>-->
            <!--            <Link-->
            <!--                :href="route('about')"-->
            <!--                class="nav__link"-->
            <!--                :class="{ active: $page.url === '/about' }"-->
            <!--            >-->
            <!--                О нас-->
            <!--            </Link>-->
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import BlueButton from "@/Components/UI/BlueButton.vue";
import { mapGetters } from "vuex";
import MainList from "@/Components/UI/MainList.vue";
import axios from "axios";

export default {
    components: {
        MainList,
        BlueButton,
        Link,
    },
    props: {
        viewportWidth: Number,
        is_auth: {
            type: Boolean,
            default: false,
        },
    },
    methods: {
        async logout() {
            axios.post("/logout", {}).catch((error) => {
                console.log(error.response);
            });
        },
    },
    computed: {
        ...mapGetters(["getIncome", "allAccounts", "getActive"]),
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
        allErrors() {
            let obj = {};
            if (this.errors) {
                obj = this.errors;
            }
            return Object.assign(obj, this.frontErrs);
        },
    },
};
</script>

<style lang="scss" scoped>
.nav__links {
    display: flex;
    width: 100%;
    gap: 100px;
    @media (max-width: 767.98px) {
        padding: 150px 64px 38px;
        flex-direction: column;
        gap: 64px;
    }

    &_con {
        width: 100%;
        @media (max-width: 767.98px) {
            position: absolute;
            background: linear-gradient(
                179.87deg,
                #e6eaf0 1.02%,
                #e6eaf1 4.79%,
                #e7ebf1 8.76%,
                #eaeef4 14.75%,
                #e8ecf2 19.07%
            );
            overflow: scroll;
            width: 100vw;
            height: 100vh;
            top: 0;
            right: -100vw;
            bottom: 0;
        }
        transition: all 0.5s ease 0s;

        &.open {
            right: 0;
        }
    }
}

.nav__link {
    font-style: normal;
    font-weight: 400;
    font-size: 17px;
    line-height: 143.1%;
    color: #000000;
    display: flex;
    gap: 16px;
    align-items: center;
    white-space: nowrap;

    &.active {
        color: #4182ec;

        &::before {
            background: rgba(65, 130, 236, 0.52);
        }
    }

    &.non-before {
        &::before {
            display: none;
        }
    }

    @media (max-width: 767.98px) {
        font-size: 20px;
        line-height: 143.1%;
        &::before {
            display: none;
        }
    }
}
.nav__button {
    font-style: normal;
    font-weight: 400;
    font-size: 17px;
    line-height: 143.1%;
    color: #3f7bdd;
    background: rgba(194, 213, 242, 0.61);
    border-radius: 5px;
    padding: 11px 36px;
    white-space: nowrap;
    transition: all 0.3s ease 0s;
    cursor: pointer;
    &:hover {
        background: rgba(194, 213, 242);
    }

    &_mobile {
        background: rgba(194, 213, 242, 0.61);
        border-radius: 5px;
        width: 60px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        white-space: nowrap;
        transition: all 0.3s ease 0s;
        @media (any-hover: hover) {
            &:hover {
                background: rgba(194, 213, 242);
            }
        }
    }
    &_menu {
        position: absolute;
        top: calc(100% + 8px);
        visibility: hidden;
        opacity: 0;
        max-height: 0;
        padding: 16px;
        right: 0;
        min-width: 230px;
        border-radius: 21px;
        background: #ffffff;
        transition: all 0.5s ease 0s;
        height: fit-content;
        display: flex;
        flex-direction: column;
        gap: 16px;
        overflow: hidden;
        &:hover {
            transform: translate(4px, 4px);
            color: #000034;
            visibility: visible;
            max-height: 500px;
            opacity: 1;
        }
        a {
            font-weight: 400;
            display: inline-flex;
            gap: 10px;
            align-items: center;
            transition: all 0.3s ease 0s;
            text-decoration: underline;
            text-decoration-color: transparent;
            &:hover {
                text-decoration-color: #000034;
            }
        }
    }
    &_link {
        padding: 0 20px;
        width: 100%;
        height: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    &-account {
        border-radius: 13px;
        padding: 0;
        height: 44px;
        min-width: 162px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: 700;
        line-height: 20px;
        color: #000034;
        transition: all 0.3s ease 0s;
        position: relative;
        background: rgba(194, 213, 242, 0.61);
        .list_button {
            a {
                text-decoration: none;
            }
        }
        .mini {
            height: fit-content;
            margin-top: -8px;
        }
        &:before {
            content: "";
            position: absolute;
            border-radius: 16px;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                84.14deg,
                rgba(63, 123, 221, 0.27) 8.75%,
                rgba(66, 130, 236, 0.27) 92.01%
            );
            left: 0;
            top: 0;
            transition: all 0.3s ease 0s;
        }
        &:hover {
            color: #ffffff;
            background-color: #3f7bdd;
            transform: translate(-4px, -4px);
            .nav__button_menu {
                transform: translate(4px, 4px);
                color: #000034;
                visibility: visible;
                max-height: 500px;
                opacity: 1;
            }
            &:before {
                transform: translate(4px, 4px);
            }
        }
    }
}
</style>

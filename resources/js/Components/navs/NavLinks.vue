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

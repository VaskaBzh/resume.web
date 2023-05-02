<template>
    <div class="nav__links_con">
        <div class="nav__links">
            <account-menu
                v-show="viewportWidth <= 767.78 && is_auth"></account-menu>
            <Link
                v-if="!is_auth || $page.url.startsWith('/profile')"
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
import AccountMenu from "@/Components/UI/AccountMenu.vue";
import { mapGetters } from "vuex";
import MainList from "@/Components/UI/MainList.vue";
import axios from "axios";

export default {
    components: {
        MainList,
        BlueButton,
        AccountMenu,
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
.button {
    width: 100%;
}
</style>

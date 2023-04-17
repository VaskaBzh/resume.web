<template>
    <div class="nav__links_con">
        <div class="nav__links">
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

export default {
    components: {
        Link,
    },
    props: {
        is_auth: {
            type: Boolean,
            default: false,
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
</style>

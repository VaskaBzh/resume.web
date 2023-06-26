<template>
    <Link
        :href="route(link.link)"
        class="nav__link"
        :class="{
            burger_link: viewportWidth < 991.98,
            active: $page.url === link.page,
        }"
    >
        <div class="burger_link_icon" v-if="link.svg" v-html="link.svg"></div>

        {{ link.name }}
    </Link>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    name: "main-link",
    components: {
        Link,
    },
    props: {
        link: Object,
        viewportWidth: Number,
    },
};
</script>

<style scoped lang="scss">
.nav__link {
    font-style: normal;
    font-weight: 400;
    font-size: 17px;
    line-height: 143.1%;
    color: #505050;
    display: flex;
    gap: 16px;
    align-items: center;
    white-space: nowrap;

    &.active {
        color: #5389e1;

        &::before {
            background: rgba(65, 130, 236, 0.52);
        }
    }

    &.non-before {
        &::before {
            display: none;
        }
    }
}
.burger_link {
    @media (max-width: 991.98px) {
        gap: 16px;
        font-size: 16px;
        line-height: 150%;
        color: #80809a;
        height: 48px;
        transition: all 0.3s ease 0s;
        border-radius: 8px;
        border: 1px solid transparent;
        padding: 10px 16px;
        font-weight: 400;
        &::before,
        &::after {
            content: none;
        }
        &_icon {
            width: 20px;
            height: 20px;
            margin: auto 0;
        }
        &-active {
            color: #5389e1;
        }
        &-account {
            display: inline-flex;
            align-items: center;
            gap: 16px;
            font-size: 18px;
            border: 1px solid transparent;
            &::before {
                display: none;
            }
            &.burger_link-active {
                border-color: #3f7bdd;
                color: #5389e1;
                &:after {
                    opacity: 0;
                }
            }
        }
    }
}
</style>

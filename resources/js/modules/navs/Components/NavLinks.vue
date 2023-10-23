<template>
    <div class="nav__links">
        <router-link class="nav_link" v-for="item in link" :to="item.url">
            {{ item.name }}
        </router-link>
    </div>
</template>

<script>
import { NavMessages } from "@/modules/navs/lang/NavMessages";

export default {
    i18n: {
        sharedMessages: NavMessages,
    },
    computed: {
        link() {
            return [
                {
                    name: this.$t("nav_links.home"),
                    url: "/",
                },
                {
                    name: this.$t("nav_links.hosting"),
                    url: "/hosting",
                },
                {
                    name: this.$t("nav_links.miners"),
                    url: "/miners",
                },
            ];
        },
    },
};
</script>

<style lang="scss">
.shadow-enter-active,
.shadow-leave-active {
    transition: all 0.5s ease 0s, visibility 0.5s ease 0s;
    visibility: visible;
    opacity: 1;
}

.shadow-enter-from,
.shadow-leave-to {
    visibility: hidden;
    opacity: 0;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.8s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.nav__links {
    display: flex;
    flex-direction: column;
}

.nav_link {
    color: rgba(228, 231, 236, 0.6);
    font-family: Unbounded, serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 120%; /* 21.6px */
    text-transform: uppercase;
    cursor: pointer;
    position: relative;
    left: 0;
    top: 0;
    transition: all 0.2s ease-in;

    &:before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 50%;
        position: absolute;
        left: -10px;
        background: white;
        top: 30%;
        opacity: 0;
    }

    &:hover {
        color: white;
    }

    &:hover:before {
        opacity: 1;
    }
}

.active__link {
    position: relative;
    left: 0;
    top: 0;

    &:before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 50%;
        position: absolute;
        left: -10px;
        background: white;
        top: 30%;
        opacity: 1;
    }
}

.menu-container .nav__links {
    width: 100%;
}

.menu-container .nav_link {
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 0.5px solid rgba(208, 213, 221, 0.6);
}

.menu-container .nav_link:before {
    right: 0px;
    left: auto;
    top: 20%;
}
</style>

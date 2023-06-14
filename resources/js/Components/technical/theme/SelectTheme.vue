<template>
    <div class="select" @click="toggle">
        <div class="select_title menu_toggle" :class="{ rotate: opened }">
            <svg
                width="15"
                height="16"
                viewBox="0 0 15 16"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M6.79289 10.2929L3.70711 7.20711C3.07714 6.57714 3.52331 5.5 4.41421 5.5H10.5858C11.4767 5.5 11.9229 6.57714 11.2929 7.20711L8.20711 10.2929C7.81658 10.6834 7.18342 10.6834 6.79289 10.2929Z"
                />
            </svg>

            <img :src="activeImg" :alt="active" />
        </div>
        <main-menu
            className="select__options"
            :opened="opened"
            :options="options"
            @clicked="changeActive"
        ></main-menu>
    </div>
</template>

<script>
import MainMenu from "@/Components/UI/MainMenu.vue";
import { useDark, useToggle } from "@vueuse/core";

export default {
    name: "select-theme",
    props: {
        viewportWidth: Number,
    },
    data() {
        return {
            opened: false,
            isDark: false,
        };
    },
    components: {
        MainMenu,
    },
    computed: {
        options() {
            return [
                {
                    name: "Светлая",
                    img: "light.png",
                    value: "light",
                },
                {
                    name: "Темная",
                    img: "dark.png",
                    value: "dark",
                },
            ];
        },
        active() {
            if (this.isDark) {
                return this.options.filter((el) => el.value === "dark")[0];
            } else {
                return this.options.filter((el) => el.value === "light")[0];
            }
        },
        activeImg() {
            if (this.active) {
                return new URL(
                    `/resources/assets/img/${this.active.img}`,
                    import.meta.url
                );
            }
        },
        imgs() {
            let arr = [];
            this.options.forEach((el) =>
                arr.push(
                    new URL(`/resources/assets/img/${el.img}`, import.meta.url)
                )
            );
            return arr;
        },
    },
    methods: {
        async changeActive(theme) {
            theme.value === "dark"
                ? (this.isDark = true)
                : (this.isDark = false);
            this.$store.dispatch("theme", this.isDark);
        },
        toggle() {
            this.opened = !this.opened;
        },
    },
    mounted() {
        this.isDark = useDark({
            selector: "body",
            attribute: "color-scheme",
            valueDark: "dark",
            valueLight: "light",
        });
        this.$store.dispatch("theme", this.isDark);
    },
};
</script>

<style lang="scss" scoped>
.select {
    height: 44px;
    width: fit-content;
    position: relative;
    cursor: pointer;
    @media (max-width: 767.98px) {
        height: 36px;
    }
    img {
        width: 22px;
        height: 22px;
        border-radius: 50%;
    }
    &_title {
        padding: 2px 10px;
        height: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: rgba(194, 213, 242, 0.6);
        border-radius: 14px;
        transition: all 0.5s ease 0s;
        svg {
            fill: #000034;
            transition: all 0.5s ease 0s;
        }
        &:hover {
            background-color: rgb(194, 213, 242);
        }
    }
}
</style>

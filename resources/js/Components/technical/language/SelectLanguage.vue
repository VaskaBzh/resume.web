<template>
    <div class="select" @click="toggle">
        <div class="select_title menu_toggle" :class="{ rotate: opened }">
            <img :src="activeImg" :alt="active" />
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
import axios from "axios";
import { Inertia } from "@inertiajs/inertia";
import MainMenu from "@/Components/UI/MainMenu.vue";

export default {
    name: "select-language",
    props: {
        viewportWidth: Number,
    },
    data() {
        return {
            opened: false,
        };
    },
    components: {
        MainMenu,
    },
    computed: {
        options() {
            return [
                {
                    name: this.$t("language.ru"),
                    img: "ru.svg",
                    value: "ru",
                },
                {
                    name: this.$t("language.en"),
                    img: "en.svg",
                    value: "en",
                },
            ];
        },
        active() {
            return this.options.filter(
                (el) => el.value === this.$i18n.locale
            )[0];
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
        async changeActive(lang) {
            if (this.$i18n.locale !== lang.value) {
                this.$i18n.locale = lang.value;
                localStorage.setItem("location", lang.value);
                await axios.post(
                    "/set_location",
                    {
                        location: this.$i18n.locale,
                    },
                    {}
                );
                Inertia.reload({ preserveScroll: true });
            }
        },
        toggle() {
            this.opened = !this.opened;
        },
        setLanguage() {
            if (localStorage.getItem("location")) {
                this.$i18n.locale = localStorage.getItem("location");
                axios.post(
                    "/set_location",
                    {
                        location: this.$i18n.locale,
                    },
                    {}
                );
            }
        },
    },
    created() {
        if (localStorage.getItem("location")) {
            this.$i18n.locale = localStorage.getItem("location");
        }
    },
    mounted() {
        this.setLanguage();
    },
};
</script>

<style lang="scss" scoped>
.select {
    height: 24px;
    width: fit-content;
    position: relative;
    cursor: pointer;
    @media (max-width: 767.98px) {
        height: 36px;
    }
    img {
        width: 20px;
        height: 20px;
        border-radius: 50%;
    }
    &_title {
        padding: 2px 0 2px 4px;
        height: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border-radius: 14px;
        transition: all 0.5s ease 0s;
        svg {
            fill: #3f7bdd;
            transition: all 0.5s ease 0s;
            width: 15px;
            height: 15px;
        }
    }
}
</style>

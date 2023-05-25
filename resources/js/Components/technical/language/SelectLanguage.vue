<template>
    <div class="select" @click="toggle">
        <div class="select_title" :class="{ rotate: opened }">
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

            <img :src="activeImg" :alt="active.value" />
        </div>
        <teleport to="body">
            <transition name="shadow">
                <div
                    class="shadow_container"
                    v-show="this.opened && viewportWidth <= 767.98"
                    id="shadow_container"
                ></div>
            </transition>
        </teleport>
        <teleport to="body" :disabled="viewportWidth >= 767.98">
            <transition name="options">
                <div class="select__options" v-show="this.opened">
                    <div
                        class="select_option"
                        v-for="(lang, i) in langs"
                        @click="changeActive(lang)"
                        :key="i"
                        :class="{
                            active: lang.value === this.$i18n.locale,
                        }"
                    >
                        <p>
                            <img :src="imgs[i]" :alt="lang.value" />
                            <span> {{ lang.title }}</span>
                        </p>
                    </div>
                </div>
            </transition>
        </teleport>
    </div>
</template>

<script>
import axios from "axios";
import { Inertia } from "@inertiajs/inertia";
import anime from "animejs";

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
    computed: {
        langs() {
            return [
                {
                    title: this.$t("language.ru"),
                    img: "ru.png",
                    value: "ru",
                },
                {
                    title: this.$t("language.en"),
                    img: "en.png",
                    value: "en",
                },
            ];
        },
        active() {
            return this.langs.filter((el) => el.value === this.$i18n.locale)[0];
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
            this.langs.forEach((el) =>
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
        close(e) {
            if (!e.target.closest(".select")) {
                this.opened = false;
            }
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
        document.addEventListener("click", this.close.bind(this), true);
        document.addEventListener("keydown", (e) => {
            if (e.keyCode === 27) {
                this.close();
            }
        });
        this.setLanguage();
    },
    unmounted() {
        // document.removeEventListener("click", this.hideSelect.bind(this), true);
        document.removeEventListener("keydown", (e) => {
            if (e.keyCode === 27) {
                this.close();
            }
        });
    },
};
</script>

<style scoped lang="scss">
.shadow-enter-active,
.shadow-leave-active {
    transition: all 0.5s ease 0s;
    visibility: visible;
}
.shadow-enter-from,
.shadow-leave-to {
    visibility: hidden;
}
.options-enter-active,
.options-leave-active {
    @media (min-width: 767.98px) {
        transition: all 0.5s ease 0.2s;
        visibility: visible;
        opacity: 1;
        max-height: 300px;
    }
    @media (max-width: 767.98px) {
        transition: all 0.8s ease 0s !important;
        bottom: 10px !important;
    }
}
.options-enter-from,
.options-leave-to {
    @media (min-width: 767.98px) {
        visibility: hidden;
        opacity: 0;
        max-height: 0;
        transition: all 0.5s ease 0s, opacity 0.2s ease 0s;
    }
    @media (max-width: 767.98px) {
        bottom: -100% !important;
    }
}
.shadow_container {
    position: fixed;
    width: 100vw;
    height: 100vh;
    left: 0;
    top: 0;
    background: rgba(#000, 0.65);
    z-index: 300;
}
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
            //svg {
            //    fill: #ffffff;
            //}
        }
    }
    &__options {
        position: absolute;
        display: flex;
        flex-direction: column;
        left: 0;
        min-width: 168px;
        gap: 10px;
        padding: 10px;
        height: fit-content;
        top: calc(100% + 11px);
        background: #ffffff;
        border-radius: 20px;
        z-index: 2;
        overflow: hidden;
        @media (max-width: 767.98px) {
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background: #ffffff;
            border-radius: 21px;
            width: calc(100% - 20px);
            max-height: 50vh;
            height: fit-content;
            z-index: 350;
            padding: 10px;
            top: auto;
            transition: all 0.8s ease 0s;
            img {
                width: 22px;
                height: 22px;
                border-radius: 50%;
            }
        }
    }
    &_option {
        font-size: 17px;
        line-height: 143.1%;
        transition: all 0.3s ease 0s;
        width: 100%;
        height: 32px;
        display: inline-flex;
        align-items: center;
        @media (max-width: 767.98px) {
            height: 42px;
        }
        &:hover {
            background: rgba(175, 208, 255, 0.8);
        }
        &.active {
            p {
                padding: 2px 10px;
                background: rgba(175, 208, 255, 0.8);
            }
        }
        p {
            width: 100%;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            height: 32px;
            background: transparent;
            border-radius: 8px;
            font-weight: 400;
            font-size: 17px;
            line-height: 143.1%;
            padding: 2px 10px;
            color: #000000;
            transition: all 0.3s ease 0s;
            @media (max-width: 767.98px) {
                height: 42px;
            }
        }
    }
}
</style>

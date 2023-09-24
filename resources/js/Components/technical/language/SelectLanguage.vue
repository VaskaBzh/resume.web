<template>
    <div class="select" @click="toggle">
        <div class="select_title menu_toggle" :class="{ rotate: opened }">
            <span>RU</span>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
            >
                <path
                    d="M18 9.00005C18 9.00005 13.5811 15 12 15C10.4188 15 6 9 6 9"
                    stroke="#D0D5DD"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
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
import MainMenu from "@/modules/common/Components/UI/MainMenu.vue";

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
                    img: "ru.svg",
                    value: "ru",
                },
                {
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
            }
        },
        toggle() {
            this.opened = !this.opened;
        },
        async setLanguage() {
            if (localStorage.getItem("location")) {
                this.$i18n.locale = localStorage.getItem("location");
                // await axios.post(
                //     "/v1/set_location",
                //     {
                //         location: this.$i18n.locale,
                //     },
                //     {}
                // );
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
    width: fit-content;
    padding: 8px 12px;
    border-radius: 12px;
    background: var(--buttons-fourth-fill-border-default, #f2f4f7);
    position: relative;
    cursor: pointer;
    @media (max-width: 767.98px) {
        height: 36px;
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
        color: var(--gray-400, #98a2b3);
        text-align: center;

        /* Label 1/Nunito Sans 10pt/14/SemiBold */
        font-family: NunitoSans;
        font-size: 14px;
        font-style: normal;
        font-weight: 600;
        line-height: 145%; /* 20.3px */
    }
}
</style>

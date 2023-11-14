<template>
    <div ref="selectLanguage" class="select" @click="toggle">
        <div class="select_title menu_toggle" :class="{ rotate: opened }">
            <span>{{ active.value }}</span>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                class="svg-lang"
            >
                <path
                    d="M18 9.00005C18 9.00005 13.5811 15 12 15C10.4188 15 6 9 6 9"
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
            options: [
                {
                    img: "ru.svg",
                    value: "ru",
                },
                {
                    img: "en.svg",
                    value: "en",
                },
            ],
        };
    },
    components: {
        MainMenu,
    },
    computed: {
        active() {
            return this.options.filter(
                (el) => el.value === this.$i18n.locale
            )[0];
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
        closeSelect(event) {
            if (this.$refs.selectLanguage && !this.$refs.selectLanguage.contains(event.target)) {
                this.opened = false;
            }
        },
        async setLanguage() {
            if (localStorage.getItem("location")) {
                this.$i18n.locale = localStorage.getItem("location");
            }
        },
    },
    created() {
        if (localStorage.getItem("location")) {
            this.$i18n.locale = localStorage.getItem("location");
        }
    },
    mounted() {
        document.addEventListener('click', this.closeSelect)
        this.setLanguage();
    },
    unmounted() {
        document.removeEventListener('click', this.closeSelect)
    }
};
</script>

<style lang="scss" scoped>
.svg-lang{
    stroke: var(--svg-fill)
}
.select {
    width: fit-content;
    height: 40px;
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

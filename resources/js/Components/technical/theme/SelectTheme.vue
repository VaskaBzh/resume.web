<template>
    <div class="checkbox" :class="{ active: isDark }" @click="changeActive()">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="32"
            height="32"
            viewBox="0 0 32 32"
            fill="none"
        >
            <path
                d="M28.6663 18.7713C27.0668 19.6254 25.2399 20.1096 23.2999 20.1096C16.9985 20.1096 11.8902 15.0013 11.8902 8.69997C11.8902 6.75998 12.3744 4.93307 13.2285 3.3335C7.55654 4.66281 3.33301 9.75367 3.33301 15.831C3.33301 22.92 9.07981 28.6668 16.1688 28.6668C22.2462 28.6668 27.337 24.4433 28.6663 18.7713Z"
                stroke="#98A2B3"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
        </svg>

        <svg
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M12 2V3.5M12 20.5V22M19.0708 19.0713L18.0101 18.0106M5.98926 5.98926L4.9286 4.9286M22 12H20.5M3.5 12H2M19.0713 4.92871L18.0106 5.98937M5.98975 18.0107L4.92909 19.0714M17 12C17 14.7614 14.7614 17 12 17C9.23858 17 7 14.7614 7 12C7 9.23858 9.23858 7 12 7C14.7614 7 17 9.23858 17 12Z"
                stroke="#6F7682"
                stroke-width="1.5"
                stroke-linecap="round"
            />
        </svg>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import ThemeService from "@/modules/interface/Services/ThemeService";
export default {
    name: "select-theme",
    props: {
        viewportWidth: Number,
    },
    data() {
        return {
            opened: false,
            timer: true,
            service: new ThemeService(),
        };
    },
    computed: {
        ...mapGetters(["isDark"]),
        theme() {
            return this.active.value;
        },
        options() {
            return [
                {
                    name: "Светлая",
                    img: "light.svg",
                    value: "light",
                },
                {
                    name: "Темная",
                    img: "dark.svg",
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
    },
    watch: {
        isDark() {
            this.initTheme();
        },
    },
    methods: {
        async changeActive() {
            if (this.timer) {
                this.timer = false;
                if (this.theme === "light") {
                    this.$store.dispatch("SetThemeVal", true);
                    this.service.toggleTheme("dark");
                } else {
                    this.$store.dispatch("SetThemeVal", false);
                    this.service.toggleTheme("light");
                }

                this.$store.dispatch("theme", this.isDark);
                setTimeout(() => (this.timer = true), 500);
            }
        },
        initTheme() {
            const activeTheme =
                JSON.parse(localStorage.getItem("theme")) ?? this.isDark
                    ? "dark"
                    : "light";

            this.$store.dispatch("theme", activeTheme);
            this.service.setTheme();
            this.$store.dispatch(
                "SetThemeVal",
                activeTheme === "light" ? false : true
            );

            this.service.toggleTheme(activeTheme);
        },
    },
    mounted() {
        this.initTheme();
    },
};
</script>

<style lang="scss" scoped>
.checkbox {
    width: 60px;
    height: 32px;
    background: var(--buttons-fourth-fill-border-default, #f2f4f7);
    border-radius: 24px;
    position: relative;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 4px 8px;

    &::before {
        content: "";
        display: inline-flex;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: var(--background-island);
        left: 4px;
        transition: all 0.3s ease 0s;
    }
    &.active {
        &::before {
            left: calc(100% - 28px);
        }
    }
    svg {
        width: 16px;
        height: 16px;
    }
}
</style>

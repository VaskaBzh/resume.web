<template>
    <div class="checkbox" :class="{ active: isDark }" @click="changeActive()">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
        >
            <path
                d="M21.5 14.0784C20.3003 14.7189 18.9301 15.0821 17.4751 15.0821C12.7491 15.0821 8.91792 11.2509 8.91792 6.52485C8.91792 5.06986 9.28105 3.69968 9.92163 2.5C5.66765 3.49698 2.5 7.31513 2.5 11.8731C2.5 17.1899 6.8101 21.5 12.1269 21.5C16.6849 21.5 20.503 18.3324 21.5 14.0784Z"
                stroke="#595E68"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
        </svg>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
        >
            <path
                d="M12 2V3.5M12 20.5V22M19.0708 19.0713L18.0101 18.0106M5.98926 5.98926L4.9286 4.9286M22 12H20.5M3.5 12H2M19.0713 4.92871L18.0106 5.98937M5.98975 18.0107L4.92909 19.0714M17 12C17 14.7614 14.7614 17 12 17C9.23858 17 7 14.7614 7 12C7 9.23858 9.23858 7 12 7C14.7614 7 17 9.23858 17 12Z"
                stroke="#98A2B3"
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
    name: "SelectTheme",
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
    mounted() {
        this.initTheme();
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
};
</script>

<style lang="scss" scoped>
.checkbox {
    width: 60px;
    height: 32px;
    background: var(--buttons-fourth-fill-border-default);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    border-radius: 24px;
    position: relative;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 4px;

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
        width: 24px;
        height: 24px;
    }
}
</style>

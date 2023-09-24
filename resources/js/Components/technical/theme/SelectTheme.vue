<template>
    <div class="checkbox" :class="{ active: isDark }" @click="changeActive()">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
  <path d="M28.6663 18.7713C27.0668 19.6254 25.2399 20.1096 23.2999 20.1096C16.9985 20.1096 11.8902 15.0013 11.8902 8.69997C11.8902 6.75998 12.3744 4.93307 13.2285 3.3335C7.55654 4.66281 3.33301 9.75367 3.33301 15.831C3.33301 22.92 9.07981 28.6668 16.1688 28.6668C22.2462 28.6668 27.337 24.4433 28.6663 18.7713Z" stroke="#98A2B3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
  <path d="M22.6663 16.0002C22.6663 19.6821 19.6816 22.6668 15.9997 22.6668C12.3178 22.6668 9.33301 19.6821 9.33301 16.0002C9.33301 12.3183 12.3178 9.3335 15.9997 9.3335C19.6816 9.3335 22.6663 12.3183 22.6663 16.0002Z" stroke="#98A2B3" stroke-width="2"/>
  <path d="M15.994 4H16.006M15.9948 28H16.0068M24.4784 7.51465H24.4904M7.51212 24.4854H7.52409M7.51212 7.5153H7.52409M24.4776 24.486H24.4896M27.988 16.0008H28M4 16.0008H4.01197" stroke="#98A2B3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import ThemeService from '@/modules/interface/Services/ThemeService';
export default {
    name: "select-theme",
    props: {
        viewportWidth: Number,
    },
    data() {
        return {
            opened: false,
            timer: true,
            service: new ThemeService()

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
    methods: {
        async changeActive() {
            
            if (this.timer) {
                this.timer = false;
               if(this.theme === "light") {
                this.$store.dispatch("SetThemeVal", true)
                this.service.toggleTheme('dark')

               }else{
                this.$store.dispatch("SetThemeVal", false);
                this.service.toggleTheme('light')
               }
                
                this.$store.dispatch("theme", this.isDark);
                setTimeout(() => this.timer = true, 500)
            }
        },
    },
    mounted() {
        this.$store.dispatch("theme", this.isDark);
        this.service.setTheme();
        this.$store.dispatch("SetThemeVal", false);
        this.service.toggleTheme('light')
    },
};
</script>

<style lang="scss" scoped>
.checkbox {
    width: 60px;
    height: 32px;
    background: var(--buttons-fourth-fill-border-default, #F2F4F7);
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

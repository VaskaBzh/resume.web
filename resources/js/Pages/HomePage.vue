<template>
    <transition name="paralax" @enter="enter" @leave="leave">
        <component
            :is="component"
            :start="true"
            ref="view"
            @next="nextView"
            @prev="prevView"
        />
    </transition>
</template>

<script>
import { ComponentsEnum } from "@/modules/home/enums/ComponentsEnum";

export default {
    name: "home-page",
    data() {
        return {
            keys: [
                "home",
                "about",
                "calculator",
                "miners",
                "cabinet",
                "security",
                "mobile",
                "payments",
                "mission",
                "history",
                "contact",
            ],
            component: null,
            direction: true,
            index: 0,
            timeout: null,
        };
    },
    methods: {
        enter(view, done) {
            view.style.opacity = 0;
            view.focus();
            view.style.transform = view.style.transform
                ? view.style.transform
                : window.innerHeight >= 1100 || window.innerWidth < 991
                ? `translateY(${this.direction ? 200 : -200}%)`
                : `translateY(${this.direction ? 200 : -200}%) scale(0.8)`;

            setTimeout(() => {
                view.style.transform =
                    window.innerHeight >= 1100 || window.innerWidth < 991
                        ? `translateY(0%)`
                        : `translateY(0%) scale(0.8)`;
            }, 400);
            setTimeout(() => {
                view.style.opacity = 1;
                done();
            }, 600);
        },
        leave(view, done) {
            view.style.opacity = 1;
            view.focus();
            view.style.transform = view.style.transform
                ? view.style.transform
                : window.innerHeight >= 1100 || window.innerWidth < 991
                ? `translateY(0%)`
                : `translateY(0%)) scale(0.8)`;

            setTimeout(() => {
                view.style.opacity = 0;
            }, 100);
            setTimeout(() => {
                view.style.transform =
                    window.innerHeight >= 1100 || window.innerWidth < 991
                        ? `translateY(${this.direction ? -200 : 200}%)`
                        : `translateY(${
                              this.direction ? -200 : 200
                          }%) scale(0.8)`;
            }, 300);
            setTimeout(() => {
                done();
            }, 600);
        },
        nextView() {
            this.index = this.index + 1;

            this.direction = true;
        },
        prevView() {
            this.index = this.index - 1;

            this.direction = false;
        },
        renderView() {
            this.component = ComponentsEnum[this.keys[this.index]];
        },
    },
    watch: {
        index(newIndex, oldIndex) {
            if (newIndex === this.keys.length || newIndex === -1) {
                this.index = oldIndex;
            }
            this.renderView();
            if (newIndex >= this.keys.length - 1) {
                document.querySelector(".footer-content").style.opacity = 1;
                document.querySelector(".footer-content").style.display =
                    "flex";
            } else {
                document.querySelector(".footer-content").style.opacity = 0;
            }
            if (newIndex === 0) {
                this.timeout = setTimeout(() => {
                    document.querySelector(".nav").style.opacity = 1;
                    document.querySelector(".nav").style.transform =
                        "translateY(0)";
                }, 1500);
            }
            if (newIndex > 0) {
                clearTimeout(this.timeout);
                document.querySelector(".nav").style.opacity = 0;
                document.querySelector(".nav").style.transform =
                    "translateY(-100%)";
            }
        },
    },
    mounted() {
        document.querySelector("body").style.overflow = "hidden";
        document.querySelector(".layout").style.overflow = "hidden";
        document.querySelector("#app").style.overflow = "hidden";
        document.querySelector(".footer-content").style.display = "none";
        document.querySelector(".footer-content").style.opacity = 0;
        this.renderView();
    },
    unmounted() {
        document.querySelector("body").style.overflow = "visible";
        if (document.querySelector(".layout")) {
            document.querySelector(".layout").style.overflow = "visible";
        }
        document.querySelector("#app").style.overflow = "visible";
        if (document.querySelector(".nav")) {
            document.querySelector(".nav").style.opacity = 1;
            document.querySelector(".nav").style.transform = "translateY(0)";
        }
        if (document.querySelector(".footer-content")) {
            document.querySelector(".footer-content").style.display = "flex";
            document.querySelector(".footer-content").style.opacity = 1;
        }
    },
};
</script>

<style scoped></style>

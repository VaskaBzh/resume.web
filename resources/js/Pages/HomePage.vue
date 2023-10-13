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
import {ComponentsEnum} from "@/modules/home/enums/ComponentsEnum";

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
        };
    },
    methods: {
        enter(view, done) {
            view.style.opacity = 0;
            view.focus();
            view.style.transform = view.style.transform
                ? view.style.transform
                : `translateY(${this.direction ? 200 : -200}%)`;

            setTimeout(() => {
                view.style.transform = `translateY(0%)`;
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
                : `translateY(0%)`;

            setTimeout(() => {
                view.style.opacity = 0;
            }, 100);
            setTimeout(() => {
                view.style.transform = `translateY(${
                    this.direction ? -200 : 200
                }%)`;
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
        },
    },
    mounted() {
        document.querySelector("body").style.overflow = "hidden";
        this.renderView();
    },
};
</script>

<style scoped></style>

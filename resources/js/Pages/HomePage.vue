<template>
    <transition name="paralax" @enter="enter" @leave="leave">
        <component
            :is="component"
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
            ],
            component: null,
            direction: true,
            index: 0,
        };
    },
    methods: {
        enter(view, done) {
            view.style.transform = view.style.transform
                ? view.style.transform
                : `translateY(${this.direction ? 150 : -150}%)`;
            view.style.opacity = 0;

            setTimeout(() => {
                view.style.transform = `translateY(0%)`;
            }, 100);
            setTimeout(() => {
                view.style.opacity = 1;
                view.focus();
                done();
            }, 300);
        },
        leave(view, done) {
            view.style.opacity = 1;
            view.style.transform = view.style.transform
                ? view.style.transform
                : `translateY(0%)`;

            setTimeout(() => {
                view.style.transform = `translateY(${
                    this.direction ? -150 : 150
                }%)`;
                view.style.opacity = 0;
            }, 100);
            setTimeout(() => {
                view.focus();
                done();
            }, 300);
        },
        nextView() {
            this.index = this.index + 1;

            this.direction = true;
            this.renderView();
        },
        prevView() {
            this.index = this.index - 1;

            this.direction = false;
            this.renderView();
        },
        renderView() {
            this.component = ComponentsEnum[this.keys[this.index]];
        },
    },
    watch: {
        index(newIndex, oldIndex) {
            if (newIndex === this.keys.length - 1 || newIndex === 0) {
                this.index = oldIndex;
            }
        },
    },
    mounted() {
        document.querySelector("body").style.overflow = "hidden";
        this.renderView();
    },
};
</script>

<style scoped></style>

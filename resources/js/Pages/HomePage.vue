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
// import { ComponentsEnum } from "@/modules/home/enums/ComponentsEnum";
import ConnectWithUsView from "@/modules/home/Components/Views/ConnectWithUsView.vue";
import HistoryPoolView from "@/modules/home/Components/Views/HistoryPoolView.vue";
import MissionView from "@/modules/home/Components/Views/MissionView.vue";
import PaymentsView from "@/modules/home/Components/Views/PaymentsView.vue";
import AppMobileView from "@/modules/home/Components/Views/AppMobileView.vue";
import SecurityView from "@/modules/home/Components/Views/SecurityView.vue";
import MakeUpCab from "@/modules/home/Components/Views/CabinetView.vue";
import MinersInfoView from "@/modules/home/Components/Views/MinersInfoView.vue";
import CalculatorLand from "@/modules/home/Components/Views/CalculatorLand.vue";
import WhoWeAre from "@/modules/home/Components/Views/AboutView.vue";
import HomeTitle from "@/modules/home/Components/Views/HeroView.vue";

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
            ComponentsEnum: {
                contact: ConnectWithUsView,
                history: HistoryPoolView,
                mission: MissionView,
                payments: PaymentsView,
                mobile: AppMobileView,
                security: SecurityView,
                cabinet: MakeUpCab,
                miners: MinersInfoView,
                calculator: CalculatorLand,
                about: WhoWeAre,
                home: HomeTitle,
            },
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
            this.component = this.ComponentsEnum[this.keys[this.index]];
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
                document.querySelector(".all-content").style.opacity = 1;
            } else {
                document.querySelector(".footer-content").style.opacity = 0;
                document.querySelector(".all-content").style.opacity = 0;
                document.querySelector(
                    ".footer-content"
                ).style.transform = `translateY(100%)`;
            }
            if (newIndex === 0) {
                this.timeout = setTimeout(() => {
                    document.querySelector(".nav").style.opacity = 1;
                    document.querySelector(".nav").style.transform =
                        "translateY(0)";
                }, 1500);
                document
                    .querySelector(".burger-mobile")
                    .removeAttribute("style");
            }
            if (newIndex > 0) {
                clearTimeout(this.timeout);
                document.querySelector(".nav").style.opacity = 0;
                document.querySelector(".nav").style.transform =
                    "translateY(-100%)";
                document.querySelector(".burger-mobile").style.opacity = 1;
            }
        },
    },
    mounted() {
        document.querySelector("body").style.overflow = "hidden";
        document.querySelector(".layout").style.overflow = "hidden";
        document.querySelector("#app").style.overflow = "hidden";
        document.querySelector(".footer-content").style.opacity = 0;
        document.querySelector(
            ".footer-content"
        ).style.transform = `translateY(100%)`;
        document.querySelector(".all-content").style.opacity = 0;
        document.querySelector(
            ".all-content"
        ).style.transform = `translateY(100%)`;
        document.querySelector(".layout__container").style.opacity = 1;
        document.querySelector(
            ".layout__container"
        ).style.transform = `translateY(0)`;
        this.renderView();
    },
    unmounted() {
        document.querySelector("body").style.overflow = "visible";
        if (document.querySelector(".layout")) {
            document.querySelector(".layout").style.overflow = "visible";
        }
        document.querySelector("#app").style.overflow = "visible";
        if (document.querySelector(".burger-mobile")) {
            document.querySelector(".burger-mobile").removeAttribute("style");
        }
        if (document.querySelector(".nav")) {
            document.querySelector(".nav").style.opacity = 1;
            document.querySelector(".nav").style.transform = "translateY(0)";
        }
        if (document.querySelector(".footer-content")) {
            document.querySelector(".footer-content").style.opacity = 1;
            document.querySelector(
                ".footer-content"
            ).style.transform = `translateY(0)`;
        }
        if (document.querySelector(".all-content")) {
            document.querySelector(".all-content").style.opacity = 1;
            document.querySelector(
                ".all-content"
            ).style.transform = `translateY(0)`;
        }
        if (document.querySelector(".layout__container")) {
            document.querySelector(".layout__container").style.opacity = 1;
            document.querySelector(
                ".layout__container"
            ).style.transform = `translateY(0)`;
        }
    },
};
</script>

<style scoped></style>

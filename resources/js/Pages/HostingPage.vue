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
import { HostingMessage } from "@/modules/hosting/lang/HostingMessage";
import { ComponentsEnum } from "@/modules/hosting/enums/ComponentsEnum";

export default {
    name: "hosting-page",
    i18n: {
        sharedMessages: HostingMessage,
    },
    data() {
        return {
            keys: [
                "hero",
                "about",
                "offer",
                "working",
                "monitoring",
                "support",
                "clients",
                "personal",
                "mobile",
                "guarantee",
                "connect",
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
<style scoped>
.first-text {
    flex-direction: column;
}
.third-text {
    flex-direction: column;
    gap: 110px;
}

.footer-hosting {
    /* height: 673px; */
    flex-shrink: 0;
    border-radius: 70px 70px 0px 0px;
    border-top: 1px solid #585757;
    border-bottom: 1px solid #585757;
    background: var(--gray-4100, #0d0d0d);
    box-shadow: 0px -4px 4px 0px rgba(18, 31, 78, 0.25),
        0px 4px 4px 0px rgba(0, 0, 0, 0.25);
    padding: 100px 100px 50px;
}

@media (max-width: 850px) {
    .help-button {
        display: none;
    }
}

@media (max-width: 768px) {
    .get-consultation {
        width: 80%;
    }

    .second-text {
        width: 85%;
        gap: 50px;
    }
}

@media (max-width: 450px) {
    .hosting-content {
        font-size: 22px;
        width: 244px;
        height: auto;
    }

    .get-consultation {
        width: 90vw;
        font-size: 12px;
        font-style: normal;
        font-weight: 600;
        margin-top: 70px;
        line-height: 120%; /* 14.4px */
    }

    .second-text {
        gap: 50px;
    }

    .third-text {
        gap: 50px;
    }

    .footer-hosting {
        padding: 40px 16px;
    }
}
</style>

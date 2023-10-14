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
import {ComponentsEnum} from "../modules/miners/enum/ComponentsEnum";


export default {
    name: 'miners-page',

    data() {
        return {

            ourOffer: {
                title: this.$t("offer.title"),
                text: this.$t("offer.text")
            },
            keys: [
                "hero",
                "about",
                "our-offer",
                'personal-card',
                'mobile-card',
                'guarante',
                'community',
                'connect-card',
            ],
            component: null,
            direction: true,
            index: 0,
        }
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
            if (newIndex === 0) {
                setTimeout(() => {
                    document.querySelector(".nav").style.opacity = 1;
                    document.querySelector(".nav").style.transform =
                        "translateY(0)";
                }, 1500);
            }
            if (newIndex > 0) {
                document.querySelector(".nav").style.opacity = 1;
                document.querySelector(".nav").style.transform =
                    "translateY(-100%)";
            }
        },
    },
    mounted() {
        document.querySelector("body").style.overflow = "hidden";
        document.querySelector(".layout").style.overflow = "hidden";
        document.querySelector("#app").style.overflow = "hidden";
        this.renderView();
    },
    unmounted() {
        document.querySelector("body").style.overflow = "visible";
        document.querySelector(".layout").style.overflow = "visible";
        document.querySelector("#app").style.overflow = "visible";
        document.querySelector(".nav").style.opacity = 1;
        document.querySelector(".nav").style.transform = "translateY(0)";
    },
}

</script>
<style scoped>

.first-text {
    flex-direction: column;
}

.miners-content {
    width: 660px;
    height: 381px;
    color: var(--gray-1100, #F5FAFF);
    font-family: Unbounded;
    font-size: 55px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 66px */
    text-transform: uppercase;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.footer-hosting {
    /* height: 673px; */
    flex-shrink: 0;
    border-radius: 70px 70px 0px 0px;
    border-top: 1px solid #585757;
    border-bottom: 1px solid #585757;
    background: var(--gray-4100, #0D0D0D);
    box-shadow: 0px -4px 4px 0px rgba(18, 31, 78, 0.25), 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
    padding: 100px 100px 50px;
}

.text-mining {
    margin-right: 130px;
}

.text-bitcoin {
    margin-left: 211px;
}

.get-consultation {
    display: flex;
    width: 480px;
    height: 56px;
    padding: 8px 20px;
    justify-content: center;
    align-items: center;
    gap: 10px;
    padding: 8px 20px;
    color: var(--gray-1100, #F5FAFF);
    font-family: Unbounded;
    font-size: 18px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 21.6px */
    text-transform: uppercase;
    border-radius: 40px;
    border: 1px solid rgba(192, 228, 255, 0.60);
    background: var(--gray-480, rgba(13, 13, 13, 0.80));
    cursor: pointer;
}

.article-hosting {
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
}

@media (max-width: 768px) {
    .miners-content {
        font-size: 36px;
        line-height: 120%; /* 43.2px */
        width: 400px;
    }

    .get-consultation {
        width: 400px;
    }
}

@media (max-width: 450px) {
    .miners-content {
        font-size: 22px;
        width: 322px;
        height: auto;
    }

    .get-consultation {
        width: 90vw;
        font-size: 12px;
        font-style: normal;
        font-weight: 600;
        margin-top: 70px;
        line-height: 120%; /* 14.4px */
        padding: 8px 20px;
        height: 40px;
    }

    .footer-hosting {
        padding: 40px 16px;
    }

    .text-mining {
        margin-right: 52px;
    }

    .text-bitcoin {
        margin-left: 84px;
    }
}
</style>

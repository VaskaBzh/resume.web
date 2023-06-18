<template>
    <div class="popup" :class="{ popup_show: opened }">
        <Teleport to="body">
            <div class="un-click" v-if="wait === true"></div>
        </Teleport>
        <div class="popup__wrapper">
            <div
                ref="popup"
                class="popup__content"
                :class="{
                    opened: contentOpened,
                    ['popup__content-' + typePopup]: typePopup !== 'form',
                }"
            >
                <img
                    v-if="!getTheme"
                    class="popup__content_logo"
                    src="../../../assets/img/logo_high_quality.png"
                    alt="logo"
                />
                <img
                    v-else
                    class="popup__content_logo"
                    src="../../../assets/img/logo_high_quality-dark.png"
                    alt="logo"
                />
                <div class="popup__content_block" :class="{ loading: wait }">
                    <button type="button" class="popup__close" @click="close">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 48 48"
                        >
                            <path
                                d="M38 12.83L35.17 10L24 21.17L12.83 10L10 12.83L21.17 24L10 35.17L12.83 38L24 26.83L35.17 38L38 35.17L26.83 24L38 12.83Z"
                            />
                        </svg>
                    </button>
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { Inertia } from "@inertiajs/inertia";
import { mapGetters } from "vuex";

export default {
    name: "main-popup",
    props: {
        typePopup: {
            type: String,
            default: "form",
        },
        wait: Boolean,
        id: String,
        animationEnd: Number,
    },
    data() {
        return {
            opened: false,
            contentOpened: false,
        };
    },
    computed: {
        ...mapGetters(["getTheme"]),
    },
    methods: {
        async close() {
            this.$emit("closed");
            this.opened = false;
            this.contentOpened = false;
            document.body.classList.remove("popup-show");
            setTimeout(() => {
                document.body.classList.remove("lock");
            }, 500);
        },
        async open() {
            this.opened = true;
            setTimeout(() => {
                this.contentOpened = true;
            }, 300);
            document.body.classList.add("popup-show");
            document.body.classList.add("lock");
            this.animationEnd
                ? setTimeout(() => this.$emit("opened"), this.animationEnd)
                : this.$emit("opened");
        },
        initFunc() {
            document.addEventListener(
                "click",
                (e) => {
                    if (!this.opened) {
                        if (e.target.closest(`[data-popup="#${this.id}"]`)) {
                            e.preventDefault();
                            this.open();
                        }
                    } else if (!e.target.closest(".popup__content")) {
                        this.close();
                    }
                },
                true
            );
            document.addEventListener("keydown", (e) => {
                if (e.keyCode === 27) this.close(e);
            });
        },
        destroyFunc() {
            document.removeEventListener(
                "click",
                (e) => {
                    if (!this.opened) {
                        if (e.target.closest(`[data-popup="#${this.id}"]`)) {
                            e.preventDefault();
                            this.open();
                        }
                    } else if (!e.target.closest(".popup__content")) {
                        this.close();
                    }
                },
                true
            );
            document.removeEventListener("keydown", (e) => {
                if (e.keyCode === 27) this.close(e);
            });
        },
    },
    mounted() {
        this.initFunc();
        Inertia.on("before", async (event) => {
            await this.close();
        });
    },
    beforeUnmount() {
        this.destroyFunc();
    },
};
</script>
<style lang="scss">
.un-click {
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100vw;
    height: 100vh;
}
</style>

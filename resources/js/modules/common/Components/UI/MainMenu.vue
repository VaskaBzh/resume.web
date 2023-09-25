<template>
    <teleport to="body">
        <transition name="shadow">
            <div
                class="shadow_container"
                v-show="open && viewportWidth <= 767.98"
            ></div>
        </transition>
    </teleport>
    <teleport to="body" :disabled="viewportWidth >= 767.98">
        <transition name="options">
            <div class="menu" :class="className" v-show="open">
                <button
                    @mousedown="
                        option.class === 'remove'
                            ? this.$emit('remove', option)
                            : this.$emit('clicked', option)
                    "
                    class="menu_elem"
                    v-for="(option, i) in options"
                    :key="i"
                    :class="option.class"
                    :data-popup="option.attr"
                >
                    <span
                        class="icon"
                        v-if="option.svg"
                        v-html="option.svg"
                    ></span>
                    <img v-if="option.img" :src="imgs[i]" alt="" />
                    {{ option.value }}
                </button>
            </div>
        </transition>
    </teleport>
</template>

<script>
export default {
    name: "main-menu",
    props: {
        options:Object,
        opened: Boolean,
        className: String,
    },
    data() {
        return {
            viewportWidth: 0,
            open: false,
            valid: true,
        };
    },
    computed: {
        imgs() {
            let imgs = [];
            this.options.forEach((el) => {
                if (el.img) {
                    imgs.push(
                        new URL(
                            `/resources/assets/img/${el.img}`,
                            import.meta.url
                        )
                    );
                }
            });
            return imgs;
        },
    },
    created: function () {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    watch: {
        opened() {
            if (this.valid) {
                this.open = this.opened;
            } else {
                this.open = true;
            }
            this.open ? this.initListeners() : this.dropListeners();
        },
    },
    methods: {
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        close(e) {
            if (this.open === true) {
                if (e.keyCode === 27) {
                    this.open = false;
                    this.valid = false;
                }
                if (!e.target.closest(".menu_toggle")) {
                    this.open = false;
                    this.valid = false;
                }
            }
        },
        initListeners() {
            document.addEventListener("click", this.close.bind(this), true);
            document.addEventListener("keydown", (e) => {
                this.close(e);
            });
        },
        dropListeners() {
            document.removeEventListener("click", this.close);
            document.removeEventListener("keydown", (e) => {
                if (e.keyCode === 27) {
                    this.close();
                }
            });
        },
    },
    unmounted() {
        this.dropListeners();
    },
};
</script>
<style lang="scss" scoped>
.shadow-enter-active,
.shadow-leave-active {
    transition: all 0.3s ease 0s, visibility 0.3s ease 0s;
    visibility: visible;
    opacity: 1;
}
.shadow-enter-from,
.shadow-leave-to {
    visibility: hidden;
    opacity: 0;
}
.options-enter-active,
.options-leave-active {
    @media (min-width: 767.98px) {
        transition: all 0.2s ease 0s, max-height 0.2s ease 0.2s;
        visibility: visible;
        opacity: 1;
        max-height: 300px;
    }
    @media (max-width: 767.98px) {
        transition: all 0.5s ease 0s !important;
        bottom: 10px !important;
    }
}
.options-enter-from {
    @media (min-width: 767.98px) {
        visibility: hidden;
        opacity: 0;
        max-height: 0;
        transition: all 0.5s ease 0s, opacity 0.2s ease 0s;
    }
    @media (max-width: 767.98px) {
        bottom: -100% !important;
    }
}
.options-leave-to {
    @media (min-width: 767.98px) {
        visibility: hidden;
        opacity: 0;
        transition: all 0.5s ease 0s, opacity 0.2s ease 0s;
    }
    @media (max-width: 767.98px) {
        bottom: -100% !important;
    }
}
.menu {
    cursor: default;
    position: absolute;
    padding: 4px;
    height: fit-content;
    width: 180px;
    display: flex;
    flex-direction: column;
    align-items: center;
    border-radius: 16px;
    background: var(--background-island);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.05);
    z-index: 5;
    transition: all 0.5s ease 0s;
    overflow: hidden;
    img {
        width: 22px;
        height: 22px;
        border-radius: 50%;
    }
    @media (max-width: 991.98px) {
        right: 0;
        left: auto;
        top: 0;
        min-width: 200px;
    }
    @media (max-width: 767.98px) {
        position: fixed;
        bottom: 10px;
        left: 50% !important;
        transform: translateX(-50%);
        background:  var(--background-island);
        width: calc(100% - 20px) !important;
        max-height: 50vh;
        height: fit-content;
        z-index: 350 !important;
        padding: 10px;
        top: auto !important;
        transition: all 0.8s ease 0s;
        max-width: 100%;
        img {
            width: 22px;
            height: 22px;
            border-radius: 50%;
        }
    }
    &_elem {
        &-remove {
            color: #ff3b30;
        }
        color: var(--text-secondary, #475467);
        font-family: NunitoSans;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 145%; /* 20.3px */
        display: flex;
        gap: 12px;
        padding: 10px 12px;
        align-items: center;
        width: 100%;
        background: transparent;
        transition: all 0.3s ease 0s;

        &:hover {
            background: #f6f8fa;
        }
    }
    &_column {
        display: flex;
        flex-direction: column;
        span {
            width: 100%;
        }
    }
    &_title {
        font-weight: 400;
        font-size: 16px;
        line-height: 143.1%;
        color: rgba(0, 0, 0, 0.62);
    }
    &_val {
        font-weight: 500;
        font-size: 18px;
        line-height: 143.1%;
        color: #000034;
    }
}
.profile {
    &__menu {
        top: calc(100% + 16px);
        right: 0;
    }
}
.select {
    &__options {
        left: 0;
        // min-width: 168px;
        width: auto;
        top: calc(100% + 12px);
        z-index: 2;
    }
}
.wallets__block_doths_menu {
    right: 24px;
    top: -75px;
}
</style>

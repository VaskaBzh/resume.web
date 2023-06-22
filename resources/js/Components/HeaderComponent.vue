<template>
    <nav class="nav__container">
        <Link :href="route('home')">
            <img
                v-if="!getTheme"
                class="nav__logo headder"
                src="../../assets/img/logo_high_quality.png"
                alt="logo"
            />
            <img
                v-else
                class="nav__logo headder"
                src="../../assets/img/logo_high_quality-dark.png"
                alt="logo"
            />
        </Link>

        <teleport to="body" :disabled="viewportWidth >= 991.98">
            <nav-links
                @clicked="burgerAction"
                @auth="changeSlide"
                :is_auth="is_auth"
                :viewportWidth="viewportWidth"
            />
        </teleport>

        <div class="nav__buttons" v-show="viewportWidth >= 991.78">
            <select-language
                v-if="viewportWidth >= 991.78"
                :viewportWidth="viewportWidth"
            ></select-language>
            <select-theme
                v-if="viewportWidth >= 991.78"
                :viewportWidth="viewportWidth"
            ></select-theme>

            <account-menu v-show="is_auth"></account-menu>
            <Link
                :href="route('login')"
                v-show="viewportWidth >= 991.98 && !is_auth"
                class="nav__button"
                @mousedown="this.linkChanger"
            >
                {{ $t("header.login_button") }}
            </Link>
            <!--            <div-->
            <!--                v-show="-->
            <!--                    viewportWidth <= 991.98 &&-->
            <!--                    !is_auth &&-->
            <!--                    viewportWidth >= 991.98-->
            <!--                "-->
            <!--                class="nav__button_mobile"-->
            <!--                data-popup="#auth"-->
            <!--                @click="this.linkChanger"-->
            <!--            >-->
            <!--                <img src="../../assets/img/user.svg" alt="" />-->
            <!--            </div>-->
        </div>

        <div v-show="viewportWidth < 991.98" class="nav__buttons_mobile">
            <select-language :viewportWidth="viewportWidth"></select-language>
            <select-theme :viewportWidth="viewportWidth"></select-theme>
            <div
                @click="burgerAction"
                class="nav__burger"
                :class="{ active: is_clicked }"
            >
                <div class="nav__burger_con">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import { Link, router, useForm } from "@inertiajs/vue3";
import SelectLanguage from "@/Components/technical/language/SelectLanguage.vue";
import NavLinks from "@/Components/navs/NavLinks.vue";
import AccountMenu from "@/Components/UI/profile/AccountMenu.vue";
import { Navigation, Pagination } from "swiper";
import { Swiper, SwiperSlide } from "swiper/vue";
import { defineComponent, reactive, ref } from "vue";
import "swiper/css";
import "swiper/css/pagination";
import { mapGetters } from "vuex";
import SelectTheme from "@/Components/technical/theme/SelectTheme.vue";

export default defineComponent({
    components: {
        Link,
        NavLinks,
        // eslint-disable-next-line vue/no-unused-components
        Swiper,
        // eslint-disable-next-line vue/no-unused-components
        SwiperSlide,
        AccountMenu,
        SelectLanguage,
        SelectTheme,
    },
    data() {
        return {
            is_clicked: false,
            viewportWidth: 0,
        };
    },
    props: {
        is_auth: {
            type: Boolean,
            default: false,
        },
        user: {
            type: Object,
        },
        errors: {
            type: Object,
        },
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    setup() {
        let wait = ref(false);
        let message = ref("");
        let noInfo = ref(false);
        let closed = ref(false);
        const form = useForm({
            email: "",
            password: "",
            remember: false,
        });
        const new_account_input = reactive(
            useForm({
                email: "",
                name: "",
                password: "",
                ["password_confirmation"]: "",
            })
        );

        const submit = async () => {
            wait.value = true;
            await form.post("/login", {
                onError: (errors) => {
                    // Обработка ошибок
                    console.log(errors);
                    wait.value = false;
                },
            });
            wait.value = false;
            setTimeout(() => {
                closed.value = true;
            }, 300);
            setTimeout(() => {
                closed.value = false;
            }, 600);
        };
        const reverify = () => {
            wait.value = true;
            form.post("/reverify", {
                onFinish() {
                    wait.value = false;
                },
            });
        };
        const account_create = () => {
            wait.value = true;
            new_account_input.post("/register", {
                async onSuccess() {
                    wait.value = false;
                    setTimeout(() => {
                        closed.value = true;
                    }, 300);
                    setTimeout(() => {
                        closed.value = false;
                    }, 600);
                },
                onError(error) {
                    wait.value = false;
                },
            });
        };

        let swipe = () => {
            document.querySelectorAll("#auth .popup_slide").forEach((el) => {
                setTimeout(() => {
                    if (el.classList.contains("swiper-slide-active")) {
                        location.replace(`#${el.dataset.id}`);
                    }
                }, 10);
            });
        };

        return {
            pagination: {
                clickable: true,
                renderBullet: function (index, className) {
                    return '<span class="' + className + '">' + "</span>";
                },
            },
            paginationUnClicalble: {
                clickable: false,
                renderBullet: function (index, className) {
                    return '<span class="' + className + '">' + "</span>";
                },
            },
            runCallbacksOnInit: {},
            modules: [Pagination, Navigation],
            form,
            new_account_input,
            submit,
            account_create,
            swipe,
            message,
            noInfo,
            reverify,
            wait,
            closed,
        };
    },
    computed: {
        ...mapGetters(["getIncome", "allAccounts", "getActive", "getTheme"]),
        // errors() {
        //     let errs = this.$page.props.errors || {};
        //     errs = Object.values(errs).filter((el) => el !== "");
        //     return errs;
        // },
    },
    methods: {
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        burgerAction() {
            if (this.is_clicked === true && this.viewportWidth < 991.98) {
                this.is_clicked = false;
                document.querySelector("body").style.overflowY = "auto";
                document
                    .querySelector(".nav__links_con")
                    .classList.remove("open");
            } else if (
                this.is_clicked === false &&
                this.viewportWidth < 991.98
            ) {
                this.is_clicked = true;
                document.querySelector("body").style.overflowY = "hidden";
                document.querySelector(".nav__links_con").classList.add("open");
            }
        },
        handleScroller(bool) {
            if (
                bool === false &&
                document.querySelector("body").classList.contains("header-fix")
            ) {
                document
                    .querySelector(".nav__container")
                    .classList.remove("fixed");
            } else if (
                bool === true &&
                document.querySelector("body").classList.contains("header-fix")
            ) {
                document
                    .querySelector(".nav__container")
                    .classList.add("fixed");
            }
        },
        handleScroll(attr) {
            if (attr === "update") {
                document.querySelector("body").classList.remove("header-fix");
            }
            const animationObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        document
                            .querySelector(".nav__container")
                            .classList.remove("fixed");
                        document
                            .querySelector("body")
                            .classList.remove("header-fix");
                    } else if (!entry.isIntersecting) {
                        document
                            .querySelector("body")
                            .classList.add("header-fix");
                    }
                });
            });
            animationObserver.observe(
                document.querySelector(".observer_block")
            );
            window.addEventListener("wheel", (e) => {
                if (e.deltaY < 0) {
                    setTimeout(() => {
                        this.handleScroller(true);
                    }, 10);
                } else {
                    this.handleScroller(false);
                }
            });
        },
    },
});
</script>

<style lang="scss" scoped>
//.header-fix {
//    @media (min-width: 1271px) {
//        nav.nav__container {
//            position: fixed;
//            transform: translateX(-50%) translateY(-120%);
//            z-index: 100;
//        }
//    }
//}

#app {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    overflow: hidden;
    background: #fafafa;
    width: 100vw;
}

.swiper {
    padding-bottom: 0 !important;
    .swiper {
        &-slide {
            margin: auto 0;
        }
    }
}

.all-link {
    padding: 2px 40px;
}

.nav__logo {
    max-width: 170px;
    @media (max-width: 1270px) {
        max-width: 140px;
    }
    @media (max-width: 991.98px) {
        &.headder {
            position: relative;
            z-index: 100;
        }
        max-width: 120px;
    }
}

nav.nav__container {
    z-index: 100;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 115px;
    width: 100%;
    box-sizing: border-box !important;
    padding: 22px 0;
    position: fixed;
    top: 0;
    left: 50%;
    transform: translateX(-50%) translateY(0);
    &:before {
        transition: all 0.3s ease 0s;
        left: 50%;
        content: "";
        transform: translateX(-50%);
        top: 0;
        width: 100vw;
        height: 84px;
        z-index: -1;
        position: fixed;
        background: #eef1f5;
        box-shadow: 0px 8px 24px rgba(129, 135, 189, 0.15);
    }
    @media (min-width: 1271px) {
        transition: all 0.3s ease 0s;
        width: 100vw;
        z-index: 100;
        //&.fixed {
        //    transform: translateX(-50%) translateY(0);
        //
        //    &:before {
        //        transform: translateX(-50%) translateY(0);
        //    }
        //}
    }
    @media (max-width: 1270px) {
        padding: 21px 0;
        gap: 20px;
    }
    //@media (max-width: 991.98px) {
    //    padding-top: 20px;
    //}
    @media (max-width: 991.98px) {
        padding: 20px 15px 15px;
        position: fixed;
        left: 50%;
        top: 0;
        transform: translate(-50%, 0);
        gap: 15px;
        height: 64px;
        width: 100vw;
        &::before {
            content: "";
            position: absolute;
            z-index: 100;
            width: 100vw;
            height: 100%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            filter: drop-shadow(0px 1px 1px rgba(0, 0, 0, 0.1));
            background: linear-gradient(
                179.87deg,
                #e6eaf0 1.02%,
                #e6eaf1 4.79%,
                #e7ebf1 8.76%,
                #eaeef4 14.75%,
                #e8ecf2 19.07%
            );
        }
    }
}

.nav__buttons_mobile {
    display: flex;
    align-items: center;
    gap: 12px;
    position: relative;
    z-index: 100;

    & .nav__burger {
        background: transparent;
        border-radius: 14px;
        gap: 4px;
        width: 38px;
        height: 38px;
        transition: all 0.3s ease 0s;
        margin-left: 28px;
        @media (max-width: 479.98px) {
            margin-left: 8px;
        }

        &:active {
            box-shadow: inset 0 4px 4px rgba(0, 0, 0, 0.25);
        }

        &_con {
            margin: 0 auto;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 4px;
            width: 18px;
            overflow: hidden;
        }

        & span {
            display: block;
            width: 18px;
            height: 2px;
            flex: 0 0 2px;
            background-color: #4182ec;
            border-radius: 5px;
            position: relative;
            right: 0;
            transition: all 0.3s ease 0.3s;

            &:nth-child(2) {
                transition: all 0.3s ease 0s;

                &::before {
                    transition: all 0.3s ease 0s;
                    content: "";
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    background-color: #4182ec;
                }
            }
        }

        &.active {
            & span {
                &:nth-child(1) {
                    transition: all 0.3s ease 0s;
                    right: 100%;
                }

                &:nth-child(2) {
                    transition: all 0.3s ease 0.3s;
                    transform: rotate(45deg);

                    &::before {
                        transition: all 0.3s ease 0.3s;
                        transform: rotate(-90deg);
                    }
                }

                &:nth-child(3) {
                    transition: all 0.3s ease 0s;
                    right: -100%;
                }
            }
        }
    }
}
.nav__buttons {
    display: flex;
    gap: 12px;
    align-items: center;
    .button {
        margin-left: 28px;
    }
}
.nav__button {
    font-style: normal;
    font-weight: 400;
    font-size: 17px;
    line-height: 143.1%;
    color: #3f7bdd;
    background: rgba(194, 213, 242, 0.61);
    border-radius: 14px;
    padding: 11px 36px;
    white-space: nowrap;
    transition: all 0.3s ease 0s;
    cursor: pointer;
    @media (any-hover: hover) {
        &:hover {
            background: rgba(194, 213, 242);
        }
    }

    &_mobile {
        background: rgba(194, 213, 242, 0.61);
        border-radius: 14px;
        min-width: 65px;
        width: 60px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        white-space: nowrap;
        transition: all 0.3s ease 0s;
        &:hover {
            background: rgba(194, 213, 242);
        }
    }
    &_link {
        padding: 0 20px;
        width: 100%;
        height: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
}

//.nav__button {
//    font-style: normal;
//    font-weight: 400;
//    font-size: 17px;
//    line-height: 143.1%;
//    color: #3f7bdd;
//    background: rgba(194, 213, 242, 0.61);
//    border-radius: 14px;
//    padding: 11px 36px;
//    white-space: nowrap;
//    transition: all 0.3s ease 0s;
//    cursor: pointer;
//    @media (any-hover: hover) {
//        &:hover {
//            background: rgba(194, 213, 242);
//        }
//    }
//
//    &_mobile {
//        background: rgba(194, 213, 242, 0.61);
//        border-radius: 14px;
//        min-width: 65px;
//        width: 60px;
//        height: 45px;
//        display: flex;
//        justify-content: center;
//        align-items: center;
//        white-space: nowrap;
//        transition: all 0.3s ease 0s;
//        &:hover {
//            background: rgba(194, 213, 242);
//        }
//    }
//    &_link {
//        padding: 0 20px;
//        width: 100%;
//        height: 100%;
//        display: inline-flex;
//        align-items: center;
//        justify-content: center;
//        gap: 10px;
//    }
//}
.nav__button {
    font-style: normal;
    font-weight: 400;
    color: #3f7bdd;
    background: transparent;
    border: 1px solid #3f7bdd;
    padding: 8px 24px;
    white-space: nowrap;
    transition: all 0.3s ease 0s;
    border-radius: 8px;
    font-size: 17px;
    line-height: 140%;
    @media (any-hover: hover) {
        &:hover {
            background: #c6d8f5;
            border: 1px solid #c6d8f5;
        }
    }

    &_mobile {
        background: rgba(194, 213, 242, 0.61);
        border-radius: 5px;
        width: 60px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        white-space: nowrap;
        transition: all 0.3s ease 0s;
        @media (any-hover: hover) {
            &:hover {
                background: rgba(194, 213, 242);
            }
        }
    }
}
</style>

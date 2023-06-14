<template>
    <header-component :errors="errors" :is_auth="auth_user" />
    <div class="page">
        <div class="hint">
            <div class="hint_item" v-hide="this.getMessage !== ''">
                {{ this.getMessage }}
            </div>
            <div class="hint_item" v-hide="this.message !== null">
                {{ this.message }}
            </div>
        </div>
        <div class="observer_block"></div>
        <keep-alive>
            <slot :errors="errors"></slot>
        </keep-alive>
    </div>
    <footer-component />
</template>

<script>
import FooterComponent from "@/Components/FooterComponent.vue";
import HeaderComponent from "@/Components/HeaderComponent.vue";
import { mapGetters } from "vuex";

export default {
    props: {
        auth_user: {
            type: Boolean,
            default: false,
        },
        message: {
            type: String,
        },
        errors: {
            type: Object,
        },
    },
    data() {
        return {
            interval: null,
        };
    },
    components: { HeaderComponent, FooterComponent },
    computed: {
        ...mapGetters(["getMessage", "allAccounts"]),
    },
    async created() {
        await this.$store.dispatch("getConverter");
        if (this.auth_user && this.$store.getters.getValid) {
            await this.$store.dispatch("getAccounts");
        }
        if (this.auth_user) {
            this.interval = setInterval(() => {
                this.$store.dispatch("getAccounts");
            }, 60000);
        }
        // if (!localStorage.getItem("location")) {
        //     axios.get("/get_location").then((res) => {
        //         localStorage.setItem('location', res.data);
        //     });
        // }
    },
    unmounted() {
        if (!this.auth_user) {
            this.$store.dispatch("destroyer");
        }
        if (this.interval) {
            clearInterval(this.interval);
        }
    },
};
</script>

<style lang="scss">
.page {
    flex: 1 1 auto;
    position: relative;
    padding-bottom: 60px;
    @media (max-width: 991.98px) {
        padding-bottom: 30px;
        margin-top: 64px;
    }
}

#app {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    transition: all 0.5s ease 0s;
    overflow: hidden;
    background: linear-gradient(
        179.87deg,
        #e6eaf0 1.02%,
        #e6eaf1 4.79%,
        #e7ebf1 8.76%,
        #eaeef4 14.75%,
        #e8ecf2 19.07%
    );

    position: relative;
    width: 100vw;
}

.nav__logo {
    max-width: 170px;
    @media (max-width: 767.98px) {
        &.headder {
            position: relative;
            z-index: 100;
        }
        max-width: 138px;
    }
}

nav.nav__container {
    position: relative;
    z-index: 100;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 115px;
    width: 100%;
    box-sizing: border-box !important;
    padding: 40px 0 15px;
    @media (max-width: 1270px) {
        padding-top: 40px;
        padding: 15px;
        gap: 50px;
    }
    @media (max-width: 991.98px) {
        padding-top: 20px;
    }
    @media (max-width: 767.98px) {
        position: fixed;
        gap: 15px;
        &::before {
            content: "";
            position: absolute;
            z-index: 100;
            width: 100%;
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
    gap: 10px;
    position: relative;
    z-index: 100;

    & .nav__burger {
        background: #4182ec;
        border-radius: 5px;
        width: 60px;
        height: 45px;
        gap: 4px;
        transition: all 0.3s ease 0s;

        &:active {
            box-shadow: inset 0px 4px 4px rgba(0, 0, 0, 0.25);
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
            height: 1.5px;
            flex: 0 0 1.5px;
            background-color: #fff;
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
                    background-color: #fff;
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

.nav__button {
    font-style: normal;
    font-weight: 400;
    font-size: 17px;
    line-height: 143.1%;
    color: #3f7bdd;
    background: rgba(194, 213, 242, 0.61);
    border-radius: 5px;
    padding: 11px 36px;
    white-space: nowrap;
    transition: all 0.3s ease 0s;
    @media (any-hover: hover) {
        &:hover {
            background: rgba(194, 213, 242);
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

.swiper {
    padding-bottom: 48px !important;

    .swiper-pagination {
        .swiper-pagination-bullet {
            position: relative;
            width: 21px;
            height: 21px;
            overflow: hidden;
            opacity: 1;
            background: transparent;
            border-radius: 3px;

            &::before {
                content: "";
                position: absolute;
                width: 100%;
                height: 100%;
                border: 5px solid rgba(63, 123, 222, 0.16);
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            &::after {
                content: "";
                position: absolute;
                width: 100%;
                height: 100%;
                border: 8px solid #3f7bde;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                transition: all 0.3s ease 0s;
                opacity: 0;
                visibility: hidden;
            }

            &.swiper-pagination-bullet-active {
                &::after {
                    opacity: 1;
                    visibility: visible;
                }
            }
        }
    }
}
</style>

<template>
    <blue-button
        class="feedback"
        v-show="!route.fullPath.startsWith('/profile')"
        data-popup="#feedback"
    >
        <span class="all-link">{{ $t("footer.feedback.button") }}</span>
    </blue-button>
    <blue-button
        class="feedback"
        v-show="route.fullPath.startsWith('/profile')"
    >
        <a
            class="all-link"
            target="_blank"
            href="https://t.me/allbtc_support"
            >{{ $t("footer.feedback.button") }}</a
        >
    </blue-button>
    <teleport to="body">
        <main-popup
            id="feedback"
            v-show="!route.fullPath.startsWith('/profile')"
            :wait="wait"
            :errors="errors"
        >
            <form
                @submit.prevent="sendFeedback"
                class="form form-popup popup__form"
            >
                <main-title tag="h3">{{
                    $t("footer.feedback.popup.title")
                }}</main-title>
                <input
                    v-model="form.contacts"
                    :placeholder="
                        $t('footer.feedback.popup.placeholders.contacts')
                    "
                    type="text"
                    class="input popup__input"
                />
                <textarea
                    v-model="form.message"
                    autofocus
                    type="text"
                    class="input popup__input"
                    :placeholder="
                        $t('footer.feedback.popup.placeholders.comment')
                    "
                />
                <blue-button>
                    <button type="submit" class="all-link">
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 9.64 2 7.4 3.42 5.52C3.67 5.19 4.14 5.13 4.47 5.38C4.8 5.63 4.87 6.1 4.62 6.43C3.4 8.04 2.75 9.97 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75C11.59 2.75 11.25 2.41 11.25 2C11.25 1.59 11.59 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75Z"
                            />
                            <path
                                d="M12 19.75C7.73 19.75 4.25 16.27 4.25 12C4.25 11.59 4.59 11.25 5 11.25C5.41 11.25 5.75 11.59 5.75 12C5.75 15.45 8.55 18.25 12 18.25C15.45 18.25 18.25 15.45 18.25 12C18.25 8.55 15.45 5.75 12 5.75C11.59 5.75 11.25 5.41 11.25 5C11.25 4.59 11.59 4.25 12 4.25C16.27 4.25 19.75 7.73 19.75 12C19.75 16.27 16.27 19.75 12 19.75Z"
                            />
                            <path
                                d="M12 16.75C11.59 16.75 11.25 16.41 11.25 16C11.25 15.59 11.59 15.25 12 15.25C13.79 15.25 15.25 13.79 15.25 12C15.25 10.21 13.79 8.75 12 8.75C11.59 8.75 11.25 8.41 11.25 8C11.25 7.59 11.59 7.25 12 7.25C14.62 7.25 16.75 9.38 16.75 12C16.75 14.62 14.62 16.75 12 16.75Z"
                            /></svg
                        >{{ $t("footer.feedback.popup.button") }}
                    </button>
                </blue-button>
            </form>
        </main-popup>
    </teleport>
    <footer class="footer__container">
        <div class="footer__main">
            <div class="footer__row">
                <div class="footer__social_con">
                    <router-link :to="{ name: 'home' }">
                        <img
                            class="nav__logo"
                            v-if="!isDark"
                            src="../../assets/img/logo_high_quality.svg"
                            alt="logo"
                        />
                        <img
                            class="nav__logo"
                            v-else
                            src="../../assets/img/logo_high_quality-dark.svg"
                            alt="logo"
                        />
                    </router-link>
                    <div class="footer__social socials">
                        <a
                            target="_blank"
                            href="https://t.me/allbtc_support"
                            class="footer__social_link socials_link teleg"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                            >
                                <path
                                    d="M18.2949 0.176566C18.2949 0.176566 20.1451 -0.689148 19.9909 1.4133C19.9395 2.27903 19.477 5.30902 19.1172 8.58639L17.8838 18.2948C17.8838 18.2948 17.781 19.717 16.8559 19.9644C15.9308 20.2117 14.5432 19.0987 14.2862 18.8513C14.0807 18.6658 10.4318 15.8831 9.14696 14.5227C8.7872 14.1517 8.37605 13.4096 9.19834 12.5439L14.5946 6.36028C15.2113 5.61823 15.8281 3.8868 13.2584 5.98925L6.06339 11.8638C6.06339 11.8638 5.2411 12.4821 3.69934 11.9256L0.358772 10.6888C0.358772 10.6888 -0.874662 9.76131 1.23245 8.83371C6.37177 5.92737 12.6931 2.9592 18.2949 0.176566Z"
                                />
                                <path
                                    d="M18.2949 0.176566C18.2949 0.176566 20.1451 -0.689148 19.9909 1.4133C19.9395 2.27903 19.477 5.30902 19.1172 8.58639L17.8838 18.2948C17.8838 18.2948 17.781 19.717 16.8559 19.9644C15.9308 20.2117 14.5432 19.0987 14.2862 18.8513C14.0807 18.6658 10.4318 15.8831 9.14696 14.5227C8.7872 14.1517 8.37605 13.4096 9.19834 12.5439L14.5946 6.36028C15.2113 5.61823 15.8281 3.8868 13.2584 5.98925L6.06339 11.8638C6.06339 11.8638 5.2411 12.4821 3.69934 11.9256L0.358772 10.6888C0.358772 10.6888 -0.874662 9.76131 1.23245 8.83371C6.37177 5.92737 12.6931 2.9592 18.2949 0.176566Z"
                                />
                                <defs>
                                    <linearGradient
                                        id="paint0_linear_0_5585"
                                        x1="3.25"
                                        y1="1.25"
                                        x2="17.25"
                                        y2="18.25"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#3F7BDD" />
                                        <stop
                                            offset="0.9999"
                                            stop-color="#3F66B6"
                                        />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </a>
                        <!-- <a href="#" class="footer__social_link yout">
                          <svg
                            width="40"
                            height="40"
                            viewBox="0 0 40 40"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M38.4409 6.74697C36.997 4.79587 34.3312 4 29.2401 4H10.7595C5.55187 4 2.8409 4.84721 1.40245 6.92445C0 8.94977 0 11.9339 0 16.0641V23.9361C0 31.9375 1.664 36 10.7595 36H29.2403C33.6552 36 36.1017 35.2977 37.6844 33.5759C39.3075 31.8102 40 28.9272 40 23.9361V16.0641C40 11.7085 39.8915 8.70673 38.4409 6.74697ZM25.6801 21.0869L17.2881 26.0726C17.1005 26.1841 16.8954 26.2394 16.6905 26.2394C16.4585 26.2394 16.227 26.1684 16.0219 26.0273C15.6359 25.7613 15.4001 25.2857 15.4001 24.7726V14.8331C15.4001 14.3209 15.6352 13.8457 16.0205 13.5796C16.4059 13.3136 16.8853 13.2954 17.2852 13.5315L25.6772 18.4851C26.1041 18.7371 26.3723 19.2382 26.3729 19.7848C26.3734 20.3319 26.1065 20.8337 25.6801 21.0869Z"
                              fill="#000034"
                              fill-opacity="0.74"
                            />
                          </svg>
                        </a> -->
                        <a
                            target="_blank"
                            href="#"
                            class="footer__social_link socials_link inst"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                            >
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M0 5C0 2.23858 2.23858 0 5 0H15C17.7614 0 20 2.23858 20 5V15C20 17.7614 17.7614 20 15 20H5C2.23858 20 0 17.7614 0 15V5ZM17 4.5C17 5.32843 16.3284 6 15.5 6C14.6716 6 14 5.32843 14 4.5C14 3.67157 14.6716 3 15.5 3C16.3284 3 17 3.67157 17 4.5ZM13 10C13 11.6569 11.6569 13 10 13C8.34315 13 7 11.6569 7 10C7 8.34315 8.34315 7 10 7C11.6569 7 13 8.34315 13 10ZM15 10C15 12.7614 12.7614 15 10 15C7.23858 15 5 12.7614 5 10C5 7.23858 7.23858 5 10 5C12.7614 5 15 7.23858 15 10Z"
                                />
                                <defs>
                                    <linearGradient
                                        id="paint0_linear_0_5576"
                                        x1="3.25"
                                        y1="1.25"
                                        x2="17.25"
                                        y2="18.25"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#3F7BDD" />
                                        <stop
                                            offset="0.9999"
                                            stop-color="#3F66B6"
                                        />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </a>
                        <a
                            target="_blank"
                            href="#"
                            class="footer__social_link socials_link youtube"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="16"
                                viewBox="0 0 20 16"
                                fill="none"
                            >
                                <path
                                    d="M19.2204 1.37349C18.4985 0.397935 17.1656 0 14.6201 0H5.37974C2.77594 0 1.42045 0.423604 0.701226 1.46223C0 2.47489 0 3.96696 0 6.03203V9.96804C0 13.9687 0.832 16 5.37974 16H14.6201C16.8276 16 18.0508 15.6489 18.8422 14.7879C19.6537 13.9051 20 12.4636 20 9.96804V6.03203C20 3.85424 19.9457 2.35336 19.2204 1.37349ZM12.8401 8.54344L8.64406 11.0363C8.55026 11.092 8.44768 11.1197 8.34523 11.1197C8.22923 11.1197 8.11348 11.0842 8.01097 11.0136C7.81793 10.8807 7.70006 10.6428 7.70006 10.3863V5.41657C7.70006 5.16047 7.81761 4.92286 8.01026 4.78982C8.20297 4.65678 8.44265 4.64769 8.64258 4.76577L12.8386 7.24256C13.0521 7.36855 13.1861 7.61908 13.1865 7.89241C13.1867 8.16597 13.0532 8.41686 12.8401 8.54344Z"
                                />
                                <defs>
                                    <linearGradient
                                        id="paint0_linear_0_5582"
                                        x1="3.25"
                                        y1="1"
                                        x2="13.7355"
                                        y2="16.9155"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#3F7BDD" />
                                        <stop
                                            offset="0.9999"
                                            stop-color="#3F66B6"
                                        />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </a>
                    </div>
                </div>

                <ul class="footer__contacts contacts">
                    <li class="footer__contacts_item contacts_item">
                        <a href="mailto:support@all-btc.com" target="_blank">
                            <span class="contacts_img">
                                <svg
                                    width="26"
                                    height="24"
                                    viewBox="0 0 26 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M6.5 8.70248L12.5 12.5764L18.5 8.70248L12.5 4.82851L6.5 8.70248ZM20 8.70248V16.4504C20 16.8614 19.842 17.2555 19.5607 17.5461C19.2794 17.8367 18.8978 18 18.5 18H6.5C6.10218 18 5.72064 17.8367 5.43934 17.5461C5.15804 17.2555 5 16.8614 5 16.4504V8.70248C5 8.13688 5.2925 7.64876 5.7275 7.37758L12.5 3L19.2725 7.37758C19.7075 7.64876 20 8.13688 20 8.70248Z"
                                        fill="#5389E1"
                                    />
                                </svg> </span
                            >support@all-btc.com</a
                        >
                    </li>
                    <li class="footer__contacts_item contacts_item">
                        <a
                            href="https://goo.gl/maps/N7xFJENqJkuomqvYA"
                            target="_blank"
                        >
                            <span class="contacts_img">
                                <svg
                                    width="19"
                                    height="19"
                                    viewBox="0 0 19 19"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M9.5 1C7.77669 1.00201 6.12453 1.70631 4.90597 2.9584C3.6874 4.21049 3.00195 5.90811 3 7.67883C3 13.3938 8.90909 17.7123 9.16023 17.8944C9.26087 17.9633 9.37909 18 9.5 18C9.62091 18 9.73913 17.9633 9.83977 17.8944C10.0909 17.7123 16 13.3938 16 7.67883C15.998 5.90811 15.3126 4.21049 14.094 2.9584C12.8755 1.70631 11.2233 1.00201 9.5 1ZM9.5 5.25016C9.96748 5.25016 10.4245 5.3926 10.8132 5.65947C11.2019 5.92633 11.5048 6.30564 11.6837 6.74942C11.8626 7.1932 11.9094 7.68152 11.8182 8.15264C11.727 8.62375 11.5019 9.0565 11.1713 9.39616C10.8408 9.73581 10.4196 9.96712 9.96112 10.0608C9.50262 10.1545 9.02737 10.1064 8.59548 9.92263C8.16358 9.7388 7.79443 9.42752 7.53471 9.02812C7.27499 8.62873 7.13636 8.15918 7.13636 7.67883C7.13636 7.03471 7.38539 6.41697 7.82866 5.9615C8.27192 5.50604 8.87313 5.25016 9.5 5.25016Z"
                                        fill="#5389E1"
                                    />
                                </svg> </span
                            >ВDubai Silicon Oasis, DDP, Building A2, Dubai,
                            United Arab Emirates</a
                        >
                    </li>
                </ul>
            </div>
            <div class="footer__quote quote">
                © 2022-2023 Allbtc Pool
                <a :href="pdf" target="_blank">{{ $t("footer.confidence") }}</a>
            </div>
        </div>
    </footer>
</template>

<script>
import pdf from "@/../assets/files/policy.pdf";
import BlueButton from "@/modules/common/Components/UI/ButtonBlue.vue";
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import { ref } from "vue";
import { mapGetters } from "vuex";
import { useRoute } from "vue-router";
import { MainApi } from "@/api/api";
import store from "@/store";

export default {
    name: "footer-component",
    components: { MainTitle, MainPopup, BlueButton },
    computed: {
        ...mapGetters(["isDark", "errors"]),
        route() {
            return useRoute();
        },
    },
    data() {
        return {
            pdf,
        };
    },
    setup() {
        let wait = ref(false);

        let form = {
            message: "",
            contacts: "",
        };

        const sendFeedback = async () => {
            wait.value = true;
            try {
                await MainApi.post("/send_message", form);

                form.message = "";
                form.contacts = "";
            } catch (e) {
                console.error("Error with: " + e);
                store.dispatch("setFullErrors", e.response.data.errors);
            }

            wait.value = false;
        };

        return {
            form,
            sendFeedback,
            wait,
        };
    },
};
</script>

<style lang="scss" scoped>
.feedback {
    position: fixed;
    .all-link {
        min-height: 48px;
        display: inline-flex;
        align-items: center;
        @media (max-width: 479.98px) {
            min-height: 40px;
        }
    }
    &:before {
        box-shadow: 2px 4px 10px rgba(#000034, 0.5);
    }
    @media (min-width: 767.98px) {
        right: 60px;
        min-width: 200px;
    }
    @media (max-width: 479.98px) {
        bottom: 50px;
        min-width: 140px;
    }
    right: 15px;
    bottom: calc(30px);
    z-index: 99;
}
.footer {
    &__container {
        margin: 110px auto 0;
        z-index: 1;
    }
    // .footer__main
    &__main {
        text-align: center;
        min-width: 1240px;
        @media (max-width: 1320.98px) {
            min-width: 970px;
        }
        @media (max-width: 991.98px) {
            min-width: 750px;
        }
        @media (max-width: 767.98px) {
            min-width: unset;
        }
    }

    // .footer__row
    &__row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        @media (max-width: 1320.98px) {
            flex-direction: column;
            gap: 48px;
        }
        @media (max-width: 479.98px) {
            justify-content: center;
            gap: 38px;
        }
    }

    // .footer__social
    &__social {
        &_con {
            display: flex;
            gap: 80px;
            @media (max-width: 1320.98px) {
                justify-content: space-between;
                width: 100%;
            }
            @media (max-width: 479.98px) {
                flex-direction: column;
                align-items: center;
                & img {
                    max-width: 170px;
                }
            }
        }
    }

    // .footer__quote
    &__quote {
        margin-top: 48px;
        margin-bottom: 28px;
        @media (max-width: 479.98px) {
            margin-top: 30px;
            margin-bottom: 96px;
        }
    }
}
</style>

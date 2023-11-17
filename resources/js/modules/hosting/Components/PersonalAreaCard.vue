<template>
    <div class="system__section-wrap" ref="view">
        <div class="system__section">
            <div class="system-card-inf">
                <p class="system-card-title">{{ $t("hosting_personal_account.title") }}</p>
                <p class="system-card-text">{{ $t("hosting_personal_account.text") }}</p>
            </div>
            <div class="system-card-img" @mouseleave="changeShadow('blank')">
                <!-- Web -->
                <img
                    src="../assets/img/Mockup-mac.png"
                    class="img-mac img-system web"
                />
                <!--            <img-->
                <!--                src="../assets/img/Mockup-statistic-ru.png"-->
                <!--                class="img-statistic img-system web"-->
                <!--                v-show="$i18n.locale === 'ru'"-->
                <!--            />-->
                <img
                    src="../assets/img/Mockup-statistic-en.png"
                    class="img-statistic img-system web"
                />

                <!-- Наложение тени -->
                <img
                    :src="img"
                    class="img-shadow"
                    :class="{ 'add-opacity': addOpacity }"
                />

                <!-- Кнопки для смены -->
                <button
                    class="navbar-note-buttton note-button"
                    @mouseenter="changeShadow('navbar')"
                    @mouseleave="addOpacity = false"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="34"
                        height="34"
                        viewBox="0 0 34 34"
                        fill="none"
                        class="svg-note"
                    >
                        <g filter="url(#filter0_b_833_7493)">
                            <circle
                                cx="17"
                                cy="17"
                                r="17"
                                :fill="[
                                    currentShadow == 'navbar'
                                        ? '#0D0D0D'
                                        : '#175CD3',
                                ]"
                            />
                        </g>
                        <rect
                            width="15.6923"
                            height="0.980769"
                            rx="0.490385"
                            transform="matrix(0.00871668 -0.999962 0.999962 -0.00871668 16.3457 24.8477)"
                            :fill="[
                                currentShadow == 'navbar' ? '#2E90FA' : '#F5FAFF',
                            ]"
                        />
                        <rect
                            width="15.6923"
                            height="0.980769"
                            rx="0.490385"
                            transform="matrix(0.999962 -0.00871668 -0.00871668 0.999962 9.1543 16.3477)"
                            :fill="[
                                currentShadow == 'navbar' ? '#2E90FA' : '#F5FAFF',
                            ]"
                        />
                        <defs>
                            <filter
                                id="filter0_b_833_7493"
                                x="-20"
                                y="-20"
                                width="74"
                                height="74"
                                filterUnits="userSpaceOnUse"
                                color-interpolation-filters="sRGB"
                            >
                                <feFlood
                                    flood-opacity="0"
                                    result="BackgroundImageFix"
                                />
                                <feGaussianBlur
                                    in="BackgroundImageFix"
                                    stdDeviation="10"
                                />
                                <feComposite
                                    in2="SourceAlpha"
                                    operator="in"
                                    result="effect1_backgroundBlur_833_7493"
                                />
                                <feBlend
                                    mode="normal"
                                    in="SourceGraphic"
                                    in2="effect1_backgroundBlur_833_7493"
                                    result="shape"
                                />
                            </filter>
                        </defs>
                    </svg>
                    <transition name="fade">
                        <MockupTooltip
                            :firstRow="$t('hosting_personal_account.tooltip[4]')"
                            position="right"
                            v-if="currentShadow == 'navbar'"
                        ></MockupTooltip>
                    </transition>
                </button>
                <button
                    class="cards-note-buttton note-button"
                    @mouseenter="changeShadow('cards')"
                    @mouseleave="addOpacity = false"
                >
                    <transition name="fade">
                        <MockupTooltip
                            :firstRow="$t('hosting_personal_account.tooltip[0]')"
                            :secondRow="$t('hosting_personal_account.tooltip[1]')"
                            position="up"
                            v-if="currentShadow == 'cards'"
                        ></MockupTooltip>
                    </transition>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="34"
                        height="34"
                        viewBox="0 0 34 34"
                        fill="none"
                        class="svg-note"
                    >
                        <g filter="url(#filter0_b_833_7493)">
                            <circle
                                cx="17"
                                cy="17"
                                r="17"
                                :fill="[
                                    currentShadow == 'cards'
                                        ? '#0D0D0D'
                                        : '#175CD3',
                                ]"
                            />
                        </g>
                        <rect
                            width="15.6923"
                            height="0.980769"
                            rx="0.490385"
                            transform="matrix(0.00871668 -0.999962 0.999962 -0.00871668 16.3457 24.8477)"
                            :fill="[
                                currentShadow == 'cards' ? '#2E90FA' : '#F5FAFF',
                            ]"
                        />
                        <rect
                            width="15.6923"
                            height="0.980769"
                            rx="0.490385"
                            transform="matrix(0.999962 -0.00871668 -0.00871668 0.999962 9.1543 16.3477)"
                            :fill="[
                                currentShadow == 'cards' ? '#2E90FA' : '#F5FAFF',
                            ]"
                        />
                        <defs>
                            <filter
                                id="filter0_b_833_7493"
                                x="-20"
                                y="-20"
                                width="74"
                                height="74"
                                filterUnits="userSpaceOnUse"
                                color-interpolation-filters="sRGB"
                            >
                                <feFlood
                                    flood-opacity="0"
                                    result="BackgroundImageFix"
                                />
                                <feGaussianBlur
                                    in="BackgroundImageFix"
                                    stdDeviation="10"
                                />
                                <feComposite
                                    in2="SourceAlpha"
                                    operator="in"
                                    result="effect1_backgroundBlur_833_7493"
                                />
                                <feBlend
                                    mode="normal"
                                    in="SourceGraphic"
                                    in2="effect1_backgroundBlur_833_7493"
                                    result="shape"
                                />
                            </filter>
                        </defs>
                    </svg>
                </button>

                <button
                    class="hasrate-note-buttton note-button"
                    @mouseenter="changeShadow('chart-hasrate')"
                    @mouseleave="addOpacity = false"
                >
                    <transition name="fade">
                        <MockupTooltip
                            :firstRow="$t('hosting_personal_account.tooltip[2]')"
                            :secondRow="$t('hosting_personal_account.tooltip[3]')"
                            position="up"
                            v-if="currentShadow == 'chart-hasrate'"
                        ></MockupTooltip>
                    </transition>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="34"
                        height="34"
                        viewBox="0 0 34 34"
                        fill="none"
                        class="svg-note"
                    >
                        <g filter="url(#filter0_b_833_7493)">
                            <circle
                                cx="17"
                                cy="17"
                                r="17"
                                :fill="[
                                    currentShadow == 'chart-hasrate'
                                        ? '#0D0D0D'
                                        : '#175CD3',
                                ]"
                            />
                        </g>
                        <rect
                            width="15.6923"
                            height="0.980769"
                            rx="0.490385"
                            transform="matrix(0.00871668 -0.999962 0.999962 -0.00871668 16.3457 24.8477)"
                            :fill="[
                                currentShadow == 'chart-hasrate'
                                    ? '#2E90FA'
                                    : '#F5FAFF',
                            ]"
                        />
                        <rect
                            width="15.6923"
                            height="0.980769"
                            rx="0.490385"
                            transform="matrix(0.999962 -0.00871668 -0.00871668 0.999962 9.1543 16.3477)"
                            :fill="[
                                currentShadow == 'chart-hasrate'
                                    ? '#2E90FA'
                                    : '#F5FAFF',
                            ]"
                        />
                        <defs>
                            <filter
                                id="filter0_b_833_7493"
                                x="-20"
                                y="-20"
                                width="74"
                                height="74"
                                filterUnits="userSpaceOnUse"
                                color-interpolation-filters="sRGB"
                            >
                                <feFlood
                                    flood-opacity="0"
                                    result="BackgroundImageFix"
                                />
                                <feGaussianBlur
                                    in="BackgroundImageFix"
                                    stdDeviation="10"
                                />
                                <feComposite
                                    in2="SourceAlpha"
                                    operator="in"
                                    result="effect1_backgroundBlur_833_7493"
                                />
                                <feBlend
                                    mode="normal"
                                    in="SourceGraphic"
                                    in2="effect1_backgroundBlur_833_7493"
                                    result="shape"
                                />
                            </filter>
                        </defs>
                    </svg>
                </button>

                <button
                    class="forecast-note-buttton note-button"
                    @mouseenter="changeShadow('forecast')"
                    @mouseleave="addOpacity = false"
                >
                    <transition name="fade">
                        <MockupTooltip
                            :firstRow="$t('hosting_personal_account.tooltip[5]')"
                            :secondRow="$t('hosting_personal_account.tooltip[6]')"
                            position="up"
                            v-if="currentShadow == 'forecast'"
                        ></MockupTooltip>
                    </transition>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="34"
                        height="34"
                        viewBox="0 0 34 34"
                        fill="none"
                        class="svg-note"
                    >
                        <g filter="url(#filter0_b_833_7493)">
                            <circle
                                cx="17"
                                cy="17"
                                r="17"
                                :fill="[
                                    currentShadow == 'forecast'
                                        ? '#0D0D0D'
                                        : '#175CD3',
                                ]"
                            />
                        </g>
                        <rect
                            width="15.6923"
                            height="0.980769"
                            rx="0.490385"
                            transform="matrix(0.00871668 -0.999962 0.999962 -0.00871668 16.3457 24.8477)"
                            :fill="[
                                currentShadow == 'forecast' ? '#2E90FA' : '#F5FAFF',
                            ]"
                        />
                        <rect
                            width="15.6923"
                            height="0.980769"
                            rx="0.490385"
                            transform="matrix(0.999962 -0.00871668 -0.00871668 0.999962 9.1543 16.3477)"
                            :fill="[
                                currentShadow == 'forecast' ? '#2E90FA' : '#F5FAFF',
                            ]"
                        />
                        <defs>
                            <filter
                                id="filter0_b_833_7493"
                                x="-20"
                                y="-20"
                                width="74"
                                height="74"
                                filterUnits="userSpaceOnUse"
                                color-interpolation-filters="sRGB"
                            >
                                <feFlood
                                    flood-opacity="0"
                                    result="BackgroundImageFix"
                                />
                                <feGaussianBlur
                                    in="BackgroundImageFix"
                                    stdDeviation="10"
                                />
                                <feComposite
                                    in2="SourceAlpha"
                                    operator="in"
                                    result="effect1_backgroundBlur_833_7493"
                                />
                                <feBlend
                                    mode="normal"
                                    in="SourceGraphic"
                                    in2="effect1_backgroundBlur_833_7493"
                                    result="shape"
                                />
                            </filter>
                        </defs>
                    </svg>
                </button>

                <button
                    class="accrued-note-buttton note-button"
                    @mouseenter="changeShadow('chart-accrued')"
                    @mouseleave="addOpacity = false"
                >
                    <transition name="fade">
                        <MockupTooltip
                            :firstRow="$t('hosting_personal_account.tooltip[7]')"
                            :secondRow="$t('hosting_personal_account.tooltip[8]')"
                            position="up"
                            v-if="currentShadow == 'chart-accrued'"
                        ></MockupTooltip>
                    </transition>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="34"
                        height="34"
                        viewBox="0 0 34 34"
                        fill="none"
                        class="svg-note"
                    >
                        <g filter="url(#filter0_b_833_7493)">
                            <circle
                                cx="17"
                                cy="17"
                                r="17"
                                :fill="[
                                    currentShadow == 'chart-accrued'
                                        ? '#0D0D0D'
                                        : '#175CD3',
                                ]"
                            />
                        </g>
                        <rect
                            width="15.6923"
                            height="0.980769"
                            rx="0.490385"
                            transform="matrix(0.00871668 -0.999962 0.999962 -0.00871668 16.3457 24.8477)"
                            :fill="[
                                currentShadow == 'chart-accrued'
                                    ? '#2E90FA'
                                    : '#F5FAFF',
                            ]"
                        />
                        <rect
                            width="15.6923"
                            height="0.980769"
                            rx="0.490385"
                            transform="matrix(0.999962 -0.00871668 -0.00871668 0.999962 9.1543 16.3477)"
                            :fill="[
                                currentShadow == 'chart-accrued'
                                    ? '#2E90FA'
                                    : '#F5FAFF',
                            ]"
                        />
                        <defs>
                            <filter
                                id="filter0_b_833_7493"
                                x="-20"
                                y="-20"
                                width="74"
                                height="74"
                                filterUnits="userSpaceOnUse"
                                color-interpolation-filters="sRGB"
                            >
                                <feFlood
                                    flood-opacity="0"
                                    result="BackgroundImageFix"
                                />
                                <feGaussianBlur
                                    in="BackgroundImageFix"
                                    stdDeviation="10"
                                />
                                <feComposite
                                    in2="SourceAlpha"
                                    operator="in"
                                    result="effect1_backgroundBlur_833_7493"
                                />
                                <feBlend
                                    mode="normal"
                                    in="SourceGraphic"
                                    in2="effect1_backgroundBlur_833_7493"
                                    result="shape"
                                />
                            </filter>
                        </defs>
                    </svg>
                </button>

                <button
                    class="header-note-buttton note-button"
                    @mouseenter="changeShadow('header')"
                    @mouseleave="addOpacity = false"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="34"
                        height="34"
                        viewBox="0 0 34 34"
                        fill="none"
                        class="svg-note"
                    >
                        <g filter="url(#filter0_b_833_7493)">
                            <circle
                                cx="17"
                                cy="17"
                                r="17"
                                :fill="[
                                    currentShadow == 'header'
                                        ? '#0D0D0D'
                                        : '#175CD3',
                                ]"
                            />
                        </g>
                        <rect
                            width="15.6923"
                            height="0.980769"
                            rx="0.490385"
                            transform="matrix(0.00871668 -0.999962 0.999962 -0.00871668 16.3457 24.8477)"
                            :fill="[
                                currentShadow == 'header' ? '#2E90FA' : '#F5FAFF',
                            ]"
                        />
                        <rect
                            width="15.6923"
                            height="0.980769"
                            rx="0.490385"
                            transform="matrix(0.999962 -0.00871668 -0.00871668 0.999962 9.1543 16.3477)"
                            :fill="[
                                currentShadow == 'header' ? '#2E90FA' : '#F5FAFF',
                            ]"
                        />
                        <defs>
                            <filter
                                id="filter0_b_833_7493"
                                x="-20"
                                y="-20"
                                width="74"
                                height="74"
                                filterUnits="userSpaceOnUse"
                                color-interpolation-filters="sRGB"
                            >
                                <feFlood
                                    flood-opacity="0"
                                    result="BackgroundImageFix"
                                />
                                <feGaussianBlur
                                    in="BackgroundImageFix"
                                    stdDeviation="10"
                                />
                                <feComposite
                                    in2="SourceAlpha"
                                    operator="in"
                                    result="effect1_backgroundBlur_833_7493"
                                />
                                <feBlend
                                    mode="normal"
                                    in="SourceGraphic"
                                    in2="effect1_backgroundBlur_833_7493"
                                    result="shape"
                                />
                            </filter>
                        </defs>
                    </svg>
                    <transition name="fade">
                        <MockupTooltip
                            :firstRow="$t('hosting_personal_account.tooltip[9]')"
                            :secondRow="$t('hosting_personal_account.tooltip[10]')"
                            position="down"
                            v-if="currentShadow == 'header'"
                        ></MockupTooltip>
                    </transition>
                </button>

                <!-- Mobile -->
                <img
                    src="../assets/img/Mockup-iphone.png"
                    class="img-mac img-system mobile"
                />
                <img
                    src="../assets/img/Mockup-mobile-statistic.png"
                    class="img-monitoring img-system mobile"
                />
            </div>
            <a
                href="https://all-btc.com/watcher/statistic?access_key=eyJuYW1lIjoiTWFpbkxpbmsiLCJncm91cF9pZCI6NjAwMTkxMn0=&puid=6001912"
                target="_blank"
                class="get-consultation"
            >{{ $t("hosting_personal_account.button") }}</a
            >
        </div>
    </div>
</template>
<script>
import {HostingMessage} from "@/modules/hosting/lang/HostingMessage";
import MockupTooltip from "./MockupTooltip.vue";

export default {
    components: {
        MockupTooltip,
    },
    i18n: {
        sharedMessages: HostingMessage,
    },
    data() {
        return {
            currentShadow: "blank",
            addOpacity: false,
        };
    },
    props: {
        start: Boolean,
    },
    methods: {
        changeShadow(name) {
            this.currentShadow = name;
            this.addOpacity = true;
        },
    },
    computed: {
        img() {
            // this.addOpacity = !this.addOpacity
            return new URL(
                `/resources/js/modules/hosting/assets/img/${this.currentShadow}-shadow.png`,
                import.meta.url
            );
        },
    },
};
</script>
<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.navbar-note-buttton {
    position: absolute;
    top: 38%;
    left: 23%;
    z-index: 10;
}

.cards-note-buttton {
    position: absolute;
    top: 52%;
    left: 67.5%;
    z-index: 10;
}

.hasrate-note-buttton {
    position: absolute;
    top: 16%;
    left: 44%;
    z-index: 10;
}

.forecast-note-buttton {
    position: absolute;
    top: 67%;
    left: 47%;
    z-index: 10;
}

.accrued-note-buttton {
    position: absolute;
    top: 67%;
    left: 77.5%;
    z-index: 10;
}

.header-note-buttton {
    position: absolute;
    top: 5.5%;
    left: 63%;
    z-index: 10;
}

.img-shadow {
    position: absolute;
    left: 50%;
    top: 15px;
    transform: translateX(-50%);
    width: calc(100% - 200px);
}

.add-opacity {
    animation: test 1s forwards;
}

/* @keyframes test{
  0%{
    opacity: 0;
  }
  100%{
    opacity: 1;
  }
} */
.system-card-inf {
    width: 100%;
    max-width: 464px;
}

.system-card-title {
    color: var(--gray-1100, #f5faff);
    font-family: Unbounded;
    font-size: 36px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 43.2px */
    text-transform: uppercase;
    margin-bottom: 20px;
}

.system-card-text {
    color: var(--gray-170, rgba(245, 250, 255, 0.7));
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 110%; /* 19.8px */
    margin-bottom: clamp(40px, 5vw, 70px);
}

.system-card-img {
    position: relative;
    width: 100%;
    max-width: 990px;
    height: 560px;
    margin: 0 auto;
}

.img-system {
    position: absolute;
    left: 50%;
    top: 15px;
    transform: translateX(-50%);
    width: 100%;
}

.img-statistic {
    width: calc(100% - 200px);
}

.get-consultation {
    color: var(--gray-1100, #f5faff);
    text-align: center;
    font-family: Unbounded, serif;
    font-size: 14px;
    font-weight: 600;
    line-height: 120%;
    text-transform: uppercase;
    border-radius: 40px;
    border: 1px solid rgba(192, 228, 255, 0.6);
    background: var(--gray-480, rgba(13, 13, 13, 0.8));
    padding: 8px 20px;
    width: 100%;
    max-width: 400px;
    margin-top: clamp(40px, 5vw, 50px);
    z-index: 7;
}

.img-mac {
    z-index: 10;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}

.mobile {
    display: none;
}

.cabinet_title {
    display: flex;
    flex-direction: column;
    max-width: 443px;
    margin-bottom: clamp(20px, 5vw, 40px);
}

.cabinet_title_elem-left {
    transform: translateX(-70px);
}

.cabinet_title_elem-right {
    transform: translateX(50px);
}

@media (max-width: 1450px) {
    .system-card-img,
    .img-mac {
        width: 100%;
        max-width: 736px;
        height: 423px;
    }

    .img-statistic,
    .img-shadow {
        width: 100%;
        max-width: 584px;
    }

    .system-card-title {
        font-size: 24px;
    }
}

@media (max-width: 1000px) {
    .svg-note {
        width: 100%;
        max-width: 30px;
        height: 30px;
    }
}

@media (max-width: 760px) {
    .web,
    .img-shadow {
        display: none;
    }

    .mobile {
        display: inline-block;
    }

    .system-card-img,
    .img-mac {
        width: 100%;
        max-width: 281px;
        height: 497px;
    }

    .img-monitoring {
        width: 100%;
        max-width: 224px;
        height: 482px;
        top: 8px;
    }

    .note-button {
        display: none;
    }

    .get-consultation {
        width: 100%;
        max-width: 80%;
        font-size: 12px;
    }
}

@media (max-width: 450px) {
    .system-card-inf {
        width: 100%;
        max-width: 244px;
    }

    .system-card-title {
        font-size: 18px;
    }

    .system-card-text {
        font-size: 14px;
    }

    .get-consultation {
        width: 100%;
        max-width: 90vw;
    }
}
</style>

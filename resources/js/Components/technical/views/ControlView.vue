<template>
    <div class="control section">
        <div class="control__container">
            <div class="control__content">
                <div class="control__head">
                    <main-title tag="h2" class="title-blue"
                        >Безупречный контроль доходов <br />
                        в реальном времени в течении дня и ночи</main-title
                    >
                    <img
                        v-if="!getTheme"
                        src="../../../../assets/img/light.png"
                        alt="light"
                        class="light"
                    />
                    <img
                        v-else
                        src="../../../../assets/img/dark.png"
                        alt="dark"
                        class="dark"
                    />
                </div>
                <div class="control__asics" ref="asics">
                    <img
                        v-if="!getTheme"
                        src="../../../../assets/img/ASIC.png"
                        alt="asic"
                        class="asic"
                    />
                    <img
                        v-else
                        src="../../../../assets/img/ASIC-dark.png"
                        alt="asic"
                        class="asic"
                    />
                    <img
                        v-if="!getTheme"
                        src="../../../../assets/img/ASIC.png"
                        alt="asic"
                        class="asic"
                    />
                    <img
                        v-else
                        src="../../../../assets/img/ASIC-dark.png"
                        alt="asic"
                        class="asic"
                    />
                    <img
                        v-if="!getTheme"
                        src="../../../../assets/img/ASIC.png"
                        alt="asic"
                        class="asic"
                    />
                    <img
                        v-else
                        src="../../../../assets/img/ASIC-dark.png"
                        alt="asic"
                        class="asic"
                    />
                    <img
                        v-if="!getTheme"
                        src="../../../../assets/img/ASIC.png"
                        alt="asic"
                        class="asic"
                    />
                    <img
                        v-else
                        src="../../../../assets/img/ASIC-dark.png"
                        alt="asic"
                        class="asic"
                    />
                    <img
                        v-if="!getTheme"
                        src="../../../../assets/img/ASIC.png"
                        alt="asic"
                        class="asic"
                    />
                    <img
                        v-else
                        src="../../../../assets/img/ASIC-dark.png"
                        alt="asic"
                        class="asic"
                    />
                    <img
                        v-if="!getTheme"
                        src="../../../../assets/img/ASIC.png"
                        alt="asic"
                        class="asic"
                    />
                    <img
                        v-else
                        src="../../../../assets/img/ASIC-dark.png"
                        alt="asic"
                        class="asic"
                    />
                    <img
                        v-if="!getTheme"
                        src="../../../../assets/img/ASIC.png"
                        alt="asic"
                        class="asic"
                    />
                    <img
                        v-else
                        src="../../../../assets/img/ASIC-dark.png"
                        alt="asic"
                        class="asic"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import { mapGetters } from "vuex";

export default {
    name: "control-view",
    components: {
        MainTitle,
    },
    data() {
        return {
            animated: false,
        };
    },
    computed: {
        ...mapGetters(["getTheme"]),
    },
    methods: {
        animationInit() {
            const animationObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (
                        entry.isIntersecting &&
                        entry.boundingClientRect.bottom >
                            entry.boundingClientRect.height
                    ) {
                        this.animated = true;
                    } else if (entry.isIntersecting) {
                        this.animated = false;
                    }
                });
            });
            animationObserver.observe(this.$refs.asics);
        },
    },
    mounted() {
        this.animationInit();
    },
};
</script>

<style scoped lang="scss">
.control {
    &__content {
        display: flex;
        flex-direction: column;
        gap: 80px;
        align-items: center;
        @media (max-width: 479.98px) {
            gap: 64px;
        }
    }
    &__head {
        display: flex;
        flex-direction: column;
        gap: 40px;
        align-items: center;
        @media (max-width: 479.98px) {
            gap: 32px;
        }
        .title {
            @media (min-width: 991.98px) {
                margin-bottom: 16px;
            }
            text-align: center;
        }
        img {
            width: 120px;
            height: 120px;
        }
    }
    &__asics {
        display: flex;
        justify-content: space-between;
        width: 100%;
        @media (min-width: 1320.98px) {
            gap: 24px;
        }
        .asic {
            height: fit-content;
            width: 8%;
            filter: drop-shadow(0px 5.94951px 47.5961px rgba(27, 27, 27, 0.25));
            &:nth-child(2),
            &:nth-child(6) {
                margin-top: 16px;
                width: 11%;
                @media (max-width: 767.98px) {
                    margin-top: 8px;
                }
                @media (max-width: 479.98px) {
                    margin-top: 8px;
                }
            }
            &:nth-child(3),
            &:nth-child(5) {
                margin-top: 43px;
                width: 15%;
                @media (max-width: 767.98px) {
                    margin-top: 23px;
                }
                @media (max-width: 479.98px) {
                    margin-top: 10px;
                }
            }
            &:nth-child(4) {
                margin-top: 65px;
                width: 21%;
                @media (max-width: 767.98px) {
                    margin-top: 35px;
                }
                @media (max-width: 479.98px) {
                    margin-top: 16px;
                }
            }
        }
    }
}
</style>

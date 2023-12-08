<template>
    <div class="faq">
        <div class="faq__main">
            <transition-group name="fade">
                <div
                    v-for="(accordion, i) in filteredFaq"
                    :key="i"
                    class="faq__list"
                >
                    <main-title class="title-gray"
                    >{{ accordion.title }}
                    </main-title>
                    <div class="section__block section__block-light">
                        <main-accordion
                            v-for="(accordionList, index) in accordion.list"
                            :key="index"
                            :accordion="accordionList"
                        ></main-accordion>
                    </div>
                </div>
            </transition-group>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import BlueButton from "@/modules/common/Components/UI/ButtonBlue.vue";
import MainAccordion from "@/modules/common/Components/UI/MainAccordion.vue";
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";

export default {
    components: {LandingTitle, MainTitle, BlueButton, MainAccordion },
    data() {
        return {
            searchQuery: "",
        };
    },
    computed: {
        filteredFaq() {
            const query = this.searchQuery.toLowerCase().trim();
            if (!query) {
                return this.faq;
            }

            return this.faq
                .map((section) => {
                    const filteredList = Object.fromEntries(
                        Object.entries(section.list).filter(
                            // eslint-disable-next-line no-unused-vars
                            ([_, item]) =>
                                item.title.toLowerCase().includes(query) ||
                                item.text.toLowerCase().includes(query)
                        )
                    );

                    if (Object.keys(filteredList).length) {
                        return {
                            ...section,
                            list: filteredList,
                        };
                    }
                })
                .filter(Boolean);
        },
        faq() {
            return [
                {
                    title: this.$t("faq[0].title"),
                    list: {
                        0: {
                            title: this.$t("faq[0].list[0].title"),
                            text: this.$t("faq[0].list[0].text"),
                        },
                        1: {
                            title: this.$t("faq[0].list[1].title"),
                            text: this.$t("faq[0].list[1].text"),
                        },
                        2: {
                            title: this.$t("faq[0].list[2].title"),
                            text: this.$t("faq[0].list[2].text"),
                        },
                        3: {
                            title: this.$t("faq[0].list[3].title"),
                            text: this.$t("faq[0].list[3].text"),
                        },
                    },
                },
                {
                    title: this.$t("faq[1].title"),
                    list: {
                        0: {
                            title: this.$t("faq[1].list[0].title"),
                            text: this.$t("faq[1].list[0].text"),
                        },
                        1: {
                            title: this.$t("faq[1].list[1].title"),
                            text: this.$t("faq[1].list[1].text"),
                        },
                        2: {
                            title: this.$t("faq[1].list[2].title"),
                            text: this.$t("faq[1].list[2].text"),
                        },
                    },
                },
                // {
                //     title: this.$t("faq[2].title"),
                //     list: {
                //         0: {
                //             title: this.$t("faq[2].list[0].title"),
                //             text: this.$t("faq[2].list[0].text"),
                //         },
                //         1: {
                //             title: this.$t("faq[2].list[1].title"),
                //             text: this.$t("faq[2].list[1].text"),
                //         },
                //         2: {
                //             title: this.$t("faq[2].list[2].title"),
                //             text: this.$t("faq[2].list[2].text"),
                //         },
                //     },
                // },
            ];
        },
    },
    mounted() {
        document.title = "FAQ";
    },
};
</script>

<style lang="scss" scoped>
.fade-enter-active,
.fade-leave-active {
    transition: all 0.3s ease;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}

.description-text {
    color: #98a2b3;
    font-family: NunitoSans, serif;
    margin: 8px 0 40px;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%; /* 24px */
}

.title-gray {
    color: #6F7682;
    font-family: NunitoSans, serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 150%; /* 24px */
    margin-left: 24px;
}

@media (max-width: 500px) {
    .title-gray {
        font-size: 12px;
        margin: 16px 16px 0;
    }
    .faq__container {
        padding: 0;
    }
    .description-text {
        display: none;
    }
}

.faq {
    flex: 1 1 0;
    display: flex;
    flex-direction: column;

    &__main {
        flex: 1 1 auto;
    }

    &_title {
        margin-top: 8px;
        font-size: 27px;
        color: var(--text-primary);
        font-family: Unbounded, serif;
        font-style: normal;
        font-weight: 400;
        line-height: 40px; /* 148.148% */
        @media (max-width: 991.98px) {
            margin-top: 48px;
        }
        @media (max-width: 767.98px) {
            margin-top: 0px;
        }
        @media (max-width: 500px) {
            margin: 0px 0 0 16px;
        }
    }

    .search {
        margin: 56px 0 48px;
        @media (max-width: 991.98px) {
            margin: 40px 0;
        }
        @media (max-width: 767.98px) {
            margin: 24px 0 32px;
        }
    }

    &__list {
        margin-bottom: 40px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        width: 100%;
        @media (max-width: 998px) {
            margin-bottom: 40px;
            width: 100%;
        }
        @media (max-width: 479.98px) {
            margin-bottom: 32px;
            gap: 8px;
        }

        .section__block {
            border-radius: 24px;
            background: var(--background-island);
            padding: 0 16px;
            box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.05);
        }
    }
}
</style>


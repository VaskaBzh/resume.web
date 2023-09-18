<template>
    <div class="faq">
        <div class="faq__container">
            <div class="faq__main">
                <main-title tag="h1" class="title-blue faq_title">
                    FAQ
                </main-title>

                <div class="search">
                    <input
                        v-model="searchQuery"
                        type="text"
                        class="input input-lg input-white"
                        placeholder="Search"
                    />
                    <blue-button>
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <g clip-path="url(#clip0_202_2129)">
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M10.5 2C9.1446 2.00012 7.80887 2.32436 6.60427 2.94569C5.39966 3.56702 4.3611 4.46742 3.57525 5.57175C2.78939 6.67609 2.27902 7.95235 2.08672 9.29404C1.89442 10.6357 2.02576 12.004 2.46979 13.2846C2.91382 14.5652 3.65766 15.7211 4.63925 16.6557C5.62084 17.5904 6.81171 18.2768 8.11252 18.6576C9.41333 19.0384 10.7864 19.1026 12.117 18.8449C13.4477 18.5872 14.6975 18.015 15.762 17.176L19.414 20.828C19.6026 21.0102 19.8552 21.111 20.1174 21.1087C20.3796 21.1064 20.6304 21.0012 20.8158 20.8158C21.0012 20.6304 21.1064 20.3796 21.1087 20.1174C21.111 19.8552 21.0102 19.6026 20.828 19.414L17.176 15.762C18.164 14.5086 18.7792 13.0024 18.9511 11.4157C19.123 9.82905 18.8448 8.22602 18.1482 6.79009C17.4517 5.35417 16.3649 4.14336 15.0123 3.29623C13.6597 2.44911 12.096 1.99989 10.5 2ZM4.00001 10.5C4.00001 8.77609 4.68483 7.12279 5.90382 5.90381C7.1228 4.68482 8.7761 4 10.5 4C12.2239 4 13.8772 4.68482 15.0962 5.90381C16.3152 7.12279 17 8.77609 17 10.5C17 12.2239 16.3152 13.8772 15.0962 15.0962C13.8772 16.3152 12.2239 17 10.5 17C8.7761 17 7.1228 16.3152 5.90382 15.0962C4.68483 13.8772 4.00001 12.2239 4.00001 10.5Z"
                                />
                            </g>
                            <defs>
                                <clipPath id="clip0_202_2129">
                                    <rect width="24" height="24" />
                                </clipPath>
                            </defs>
                        </svg>
                    </blue-button>
                </div>
                <transition-group name="fade">
                    <div
                        class="faq__list"
                        v-for="(accordion, i) in filteredFaq"
                        :key="i"
                    >
                        <main-title tag="h3" class="title-blue">{{
                            accordion.title
                        }}</main-title>
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
    </div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import BlueButton from "@/modules/common/Components/UI/ButtonBlue.vue";
import MainAccordion from "@/modules/common/Components/UI/MainAccordion.vue";

export default {
    components: { MainTitle, BlueButton, MainAccordion },
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
                {
                    title: this.$t("faq[2].title"),
                    list: {
                        0: {
                            title: this.$t("faq[2].list[0].title"),
                            text: this.$t("faq[2].list[0].text"),
                        },
                        1: {
                            title: this.$t("faq[2].list[1].title"),
                            text: this.$t("faq[2].list[1].text"),
                        },
                        2: {
                            title: this.$t("faq[2].list[2].title"),
                            text: this.$t("faq[2].list[2].text"),
                        },
                    },
                },
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
.faq {
    &_title {
        margin-top: 100px;
        @media (max-width: 991.98px) {
            margin-top: 48px;
        }
        @media (max-width: 767.98px) {
            margin-top: 32px;
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
        margin-bottom: 48px;
        display: flex;
        flex-direction: column;
        gap: 24px;
        @media (max-width: 767.98px) {
            margin-bottom: 40px;
        }
        @media (max-width: 479.98px) {
            margin-bottom: 32px;
            gap: 16px;
        }
        .section__block {
            border-radius: 16px;
            padding: 16px 40px;
            @media (max-width: 991.98px) {
                padding: 8px 24px;
            }
            @media (max-width: 479.98px) {
                padding: 6px 8px;
            }
        }
    }
}
</style>

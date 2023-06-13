<template>
    <div class="hosting_info section">
        <div class="hosting_info__container">
            <div class="hosting_info_wrapper">
                <hosting-info-card
                    v-for="(card, i) in cards"
                    :key="i"
                    :card="card"
                    v-if="viewportWidth > 767.98"
                ></hosting-info-card>
                <swiper
                    v-else
                    :modules="modules"
                    loop
                    :slides-per-view="1"
                    :space-between="24"
                    :pagination="pagination"
                >
                    <swiper-slide :key="i" v-for="(card, i) in cards">
                        <hosting-info-card
                            :key="i"
                            :card="card"
                        ></hosting-info-card>
                    </swiper-slide>
                </swiper>
            </div>
        </div>
    </div>
</template>

<script>
import HostingInfoCard from "@/Components/technical/blocks/HostingInfoCard.vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import { Pagination } from "swiper";

export default {
    name: "hosting-info-view",
    setup() {
        return {
            pagination: {
                clickable: true,
                renderBullet: function (index, className) {
                    return '<span class="' + className + '">' + "</span>";
                },
            },
            modules: [Pagination],
        };
    },
    components: {
        Swiper,
        SwiperSlide,
        HostingInfoCard,
    },
    computed: {
        cards() {
            return [
                {
                    title: this.$t("hosting_info.cards[0].title"),
                    img: this.$t("hosting_info.cards[0].img"),
                    text: this.$t("hosting_info.cards[0].text"),
                },
                {
                    title: this.$t("hosting_info.cards[1].title"),
                    img: this.$t("hosting_info.cards[1].img"),
                    text: this.$t("hosting_info.cards[1].text"),
                },
                {
                    title: this.$t("hosting_info.cards[2].title"),
                    img: this.$t("hosting_info.cards[2].img"),
                    text: this.$t("hosting_info.cards[2].text"),
                },
            ];
        },
    },
    data() {
        return {
            viewportWidth: 0,
        };
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    methods: {
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
    },
};
</script>

<style lang="scss">
.hosting_info {
    &_wrapper {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px;
        width: 100%;
        .swiper {
            width: calc(100% + 30px);
            margin: 0 -15px;
            padding-bottom: 30px !important;
            &-pagination {
                bottom: 0;
                &-bullet {
                    height: 8px !important;
                    width: 8px !important;
                    border-radius: 10px !important;
                    background: #d9d9d9 !important;
                    transition: all 0.3s ease 0s !important;
                    &-active {
                        background: #c6d8f5 !important;
                        width: 32px !important;
                    }
                    &:before,
                    &:after {
                        content: none !important;
                    }
                }
            }
        }
        @media (max-width: 991.98px) {
            grid-template-columns: 1fr;
        }
        @media (max-width: 767.98px) {
        }
    }
}
</style>

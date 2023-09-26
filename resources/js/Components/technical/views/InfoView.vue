<template>
    <div class="info section">
        <div class="info__container">
            <div class="info_wrapper" v-if="viewportWidth > 991.98">
                <slot name="pc"></slot>
            </div>
            <swiper
                v-else-if="viewportWidth > 600.98"
                :modules="modules"
                loop
                :slides-per-view="2"
                :space-between="1"
                :pagination="pagination"
                ref="swiper"
            >
                <slot name="mobile"></slot>
            </swiper>
            <swiper
                v-else
                :modules="modules"
                loop
                :slides-per-view="1"
                :space-between="9"
                :pagination="pagination"
                ref="swiper"
            >
                <slot name="mobile"></slot>
            </swiper>
        </div>
    </div>
</template>

<script>
import { Swiper } from "swiper/vue";
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
    watch: {
        viewportWidth() {
            if (this.$refs.swiper) {
                this.setHeight();
            }
        },
    },
    methods: {
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        setHeight() {
            let slides = this.$refs.swiper.$el.querySelectorAll(".card.sm");
            let heightArr = [];
            slides.forEach((slide) => heightArr.push(slide.offsetHeight));

            slides.forEach((slide) => {
                slide.style.minHeight = Math.max.apply(null, heightArr) + "px";
            });
        },
    },
    mounted() {
        if (this.$refs.swiper) {
            this.setHeight();
        }
    },
};
</script>

<style lang="scss">
.info {
    &__container {

        margin: 0 auto;
        @media (max-width: 991.98px) {
            max-width: 100%;
            padding: 0;
        }
    }

    .card.sm {
        min-height: 404px;
    }

    &_wrapper {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px;
        width: 100%;
        @media (max-width: 991.98px) {
            grid-template-columns: 1fr;
        }
    }
}
</style>

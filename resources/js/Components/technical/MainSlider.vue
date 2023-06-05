<template>
    <div class="slider">
        <wrap-table
            ref="list"
            :type="this.type"
            :table="this.table"
            :first="firstRow"
            :wait="this.wait"
            :rowsVal="rows"
        ></wrap-table>
        <div class="slider__nav" v-if="this.table.rows">
            <span class="slider__nav_info" v-if="this.pages === 0">
                0 {{ $t("swiper.or") }}
                {{ this.table.rows.length }}
            </span>
            <span
                class="slider__nav_info"
                v-else-if="this.rows > this.table.rows.length"
            >
                {{ this.startRow }}-{{ this.table.rows.length }}
                {{ $t("swiper.or") }}
                {{ this.table.rows.length }}
            </span>
            <span class="slider__nav_info" v-else>
                {{ this.startRow }}-{{ this.rows }} {{ $t("swiper.or") }}
                {{ this.table.rows.length }}
            </span>
            <div class="slider__nav-slides">
                <button class="slider__button" @click="slider(-1)">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                    >
                        <path
                            d="M14 18L8 12L14 6"
                            stroke="#131A29"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </button>
                <div class="slider__slides" v-if="this.pages === 0">
                    <span>...</span>
                </div>
                <div class="slider__slides" v-else-if="this.pages <= 8">
                    <a
                        ref="page"
                        v-for="(page, index) in this.pages"
                        :key="index"
                        @click="pagination(page)"
                        :class="{ active: this.page === page }"
                        >{{ page }}</a
                    >
                </div>
                <div class="slider__slides" v-else-if="this.booler">
                    <a
                        @click="pagination(page)"
                        ref="page"
                        v-for="(page, index) in this.overPages"
                        :key="index"
                        :class="{ active: this.page === page }"
                        >{{ page }}</a
                    >
                </div>
                <div class="slider__slides slider__slides-full" v-else>
                    <a
                        @click="pagination(page)"
                        ref="page"
                        v-for="(page, index) in this.firstPages"
                        :key="index"
                        :class="{ active: this.page === page }"
                        >{{ page }}</a
                    >
                    <span>...</span>
                    <a
                        @click="pagination(page)"
                        ref="page"
                        v-for="(page, index) in this.lastPages"
                        :key="index"
                        :class="{ active: this.page === page }"
                        >{{ page }}</a
                    >
                </div>
                <button class="slider__button" @click="slider(1)">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                    >
                        <path
                            d="M10 6L16 12L10 18"
                            stroke="#131A29"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import WrapTable from "@/Components/tables/WrapTable.vue";

export default {
    components: { WrapTable },
    props: {
        table: Object,
        type: String,
        wait: Object,
        rowsNum: {
            type: Number,
            default: 10,
        },
    },
    data() {
        return {
            viewportWidth: 0,
            firstRow: 0,
            slides: 1,
            slide: 1,
            firstPages: [1, 2, 3, 4, 5],
            key: 0,
            rows: this.rowsNum,
            page: 1,
        };
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    computed: {
        startRow() {
            return Number(this.firstRow) + 1;
        },
        pages() {
            return Math.ceil(this.table.rows.length / this.rowsNum);
        },
        lastPages() {
            return [this.pages - 1, this.pages].filter((page) => page > 0);
        },
        overPages() {
            let startPage = Math.max(this.pages - 7, 1);
            let pages = [];
            for (let i = 0; i < 8 && startPage + i <= this.pages; i++) {
                pages.push(startPage + i);
            }
            return pages;
        },
        booler() {
            return this.overPages.includes(this.page);
        },
    },
    methods: {
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        slider(slides = 1) {
            let newPage = this.page + slides;

            if (newPage < 1) newPage = this.pages;
            else if (newPage > this.pages) newPage = 1;

            this.page = newPage;
            this.firstRow = (newPage - 1) * this.rowsNum;
            this.rows = Number(this.firstRow) + Number(this.rowsNum);

            if (this.rows > this.table.rows.length) {
                this.rows = this.table.rows.length;
            }
        },
        pagination(page) {
            if (page < 1) page = 1;
            else if (page > this.pages) page = this.pages;

            this.page = page;
            this.firstRow = (page - 1) * this.rowsNum;
            this.rows = Number(this.firstRow) + Number(this.rowsNum);

            if (this.rows > this.table.rows.length) {
                this.rows = this.table.rows.length;
            }
        },
    },
};
</script>
<style lang="scss" scoped>
.ref {
    .slider__wrap {
        @media (max-width: 991.98px) {
            background: transparent;
            padding: 0;
            width: 100%;
            margin: 0;
        }
    }
}
.slider {
    // .slider__wrap
    &__wrap {
        width: 100%;
        padding: 24px 16px;
        background: rgba(255, 255, 255, 0.29);
        border-radius: 21px;
        margin-bottom: 16px;
        @media (max-width: 1270px) {
            padding: 20px;
        }
        @media (max-width: 767.98px) {
            margin: 0 -15px 20px;
            width: calc(100% + 30px);
        }
        @media (max-width: 479.98px) {
            margin: 0 -20px 20px;
            width: calc(100% + 40px);
        }
    }
    // .slider__nav
    &__nav {
        width: 100%;
        display: flex;
        align-items: center;
        min-height: 40px;
        @media (min-width: 480px) {
            justify-content: space-between;
        }
        @media (max-width: 479.98px) {
            display: grid;
            grid-template-rows: 1fr 1fr;
        }
        // .slider__nav_info
        &_info {
            font-weight: 500;
            font-size: 18px;
            font-family: AmpleSoftPro, serif;
            line-height: 22px;
            @media (max-width: 479.98px) {
                margin-bottom: 16px;
                color: #000034;
                font-size: 16px;
                line-height: 15px;
            }
        }

        // .slider__nav-slides
        &-slides {
            display: flex;
            height: 100%;
            align-items: center;
            gap: 16px;
            @media (max-width: 767.98px) {
                gap: 13px;
            }
            @media (max-width: 479.98px) {
                width: 100%;
            }
        }
    }
    // .slider__button
    &__button {
        background: #ffffff;
        border-radius: 13px;
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        &:hover {
            background: rgba(#c2d5f2, 0.61);
        }
        @media (max-width: 479.98px) {
            min-width: 32px;
            width: 32px;
            height: 32px;
            svg {
                width: 19px;
                height: 19px;
            }
        }
    }
    // .slider__slides
    &__slides {
        max-width: 245px;
        display: flex;
        height: 100%;
        align-items: center;
        font-family: AmpleSoftPro, serif;
        font-style: normal;
        font-weight: 500;
        font-size: 18px;
        line-height: 22px;
        gap: 16px;
        @media (max-width: 767.98px) {
            gap: 20px;
        }
        @media (max-width: 479.98px) {
            max-width: 100%;
            justify-content: space-between;
            gap: 12px;
        }
        &-full {
            @media (max-width: 479.98px) {
                width: 100%;
                gap: 0;
            }
        }
        a,
        span {
            user-select: none;
            color: #331a38;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: underline;
            text-decoration-color: transparent;
            @media (max-width: 479.98px) {
                font-size: 16px;
                line-height: 17px;
            }
        }
        .active {
            color: #4182ec;
            text-decoration-color: #4182ec;
        }
    }
}
</style>

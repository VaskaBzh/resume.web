<template>
    <div class="slider">
        <wrap-table
            :table="this.table"
            :first="firstRow"
            :rowsVal="rows"
        ></wrap-table>
        <div class="slider__nav">
            <span
                class="slider__nav_info"
                v-if="this.rows > this.table.rows.length"
            >
                {{ this.startRow }}-{{ this.table.rows.length }} из
                {{ this.table.rows.length }}
            </span>
            <span class="slider__nav_info" v-else>
                {{ this.startRow }}-{{ this.rows }} из
                {{ this.table.rows.length }}
            </span>
            <div class="slider__nav-slides">
                <button class="slider__button" @click="slider(false, 1)">
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
                <div class="slider__slides" v-if="this.pages <= 8">
                    <a
                        ref="page"
                        v-for="(page, index) in this.pages"
                        :key="index"
                        @click="pagination(page)"
                        >{{ page }}</a
                    >
                </div>
                <div class="slider__slides" v-else-if="this.booler">
                    <a
                        @click="pagination(page)"
                        ref="page"
                        v-for="(page, index) in this.overPages"
                        :key="index"
                        >{{ page }}</a
                    >
                </div>
                <div class="slider__slides slider__slides-full" v-else>
                    <a
                        @click="pagination(page)"
                        ref="page"
                        v-for="(page, index) in this.firstPages"
                        :key="index"
                        >{{ page }}</a
                    >
                    <span>...</span>
                    <a
                        @click="pagination(page)"
                        ref="page"
                        v-for="(page, index) in this.lastPages"
                        :key="index"
                        >{{ page }}</a
                    >
                </div>
                <button class="slider__button" @click="slider(true, 1)">
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
    },
    data() {
        return {
            firstRow: 0,
            rows: 10,
            slides: 1,
            slide: 1,
            firstPages: [1, 2, 3, 4, 5],
        };
    },
    computed: {
        startRow() {
            return this.firstRow + 1;
        },
        pages() {
            return Math.ceil(this.table.rows.length / 10);
        },
        lastPages() {
            let obj = [
                Math.ceil(this.table.rows.length / 10 - 1),
                Math.ceil(this.table.rows.length / 10),
            ];
            return obj;
        },
        overPages() {
            let obj = [
                Math.ceil(this.table.rows.length / 10 - 7),
                Math.ceil(this.table.rows.length / 10 - 6),
                Math.ceil(this.table.rows.length / 10 - 5),
                Math.ceil(this.table.rows.length / 10 - 4),
                Math.ceil(this.table.rows.length / 10 - 3),
                Math.ceil(this.table.rows.length / 10 - 2),
                Math.ceil(this.table.rows.length / 10 - 1),
                Math.ceil(this.table.rows.length / 10),
            ];
            return obj;
        },
        booler() {
            let bool = false;
            for (let i = 0; i < this.firstPages.length; i++) {
                if (this.firstPages[i] === this.lastPages[0]) {
                    bool = true;
                }
            }
            if (this.rows / 10 >= this.lastPages[0]) {
                bool = true;
            }
            return bool;
        },
    },
    methods: {
        slider(event, skip) {
            if (
                event &&
                this.rows < this.table.rows.length &&
                this.firstRow < this.table.rows.length - Number(skip + "0")
            ) {
                if (
                    skip < 3 &&
                    this.rows < 30 &&
                    this.rows + Number(skip + "0") !== 40
                ) {
                    this.firstPages = [1, 2, 3, 4, 5];
                } else if (this.rows < this.table.rows.length) {
                    if (
                        this.$refs.page[0].innerText !==
                            String(this.rows).slice(0, -1) &&
                        this.$refs.page[1].innerText !==
                            String(this.rows).slice(0, -1)
                    ) {
                        this.firstPages = this.firstPages.map(
                            (elem) => elem + Number(skip)
                        );
                    } else if (
                        this.$refs.page[0].innerText ===
                        String(this.rows).slice(0, -1)
                    ) {
                        this.firstPages = this.firstPages.map(
                            (elem) => elem + Number(skip) - 2
                        );
                    } else if (
                        this.$refs.page[1].innerText ===
                        String(this.rows).slice(0, -1)
                    ) {
                        this.firstPages = this.firstPages.map(
                            (elem) => elem + Number(skip) - 1
                        );
                    }
                }
                this.firstRow = this.firstRow + Number(skip + "0");
                this.rows = this.rows + Number(skip + "0");
            } else if (
                !event &&
                this.firstRow > 0 &&
                this.rows > Number(skip + "0")
            ) {
                if (this.rows > 40 && this.rows > Number(skip + "0") + 30) {
                    this.firstPages = this.firstPages.map(
                        (elem) => elem - Math.abs(Number(skip))
                    );
                } else {
                    this.firstPages = [1, 2, 3, 4, 5];
                }
                this.firstRow = this.firstRow - Math.abs(Number(skip + "0"));
                this.rows = this.rows - Math.abs(Number(skip + "0"));
            }
            this.slideNumber();
        },
        pagination(skip) {
            if (Number(skip + "0") > this.rows) {
                this.slider(true, skip - String(this.rows).slice(0, -1));
            } else {
                this.slider(false, skip - String(this.rows).slice(0, -1));
            }
        },
        slideNumber() {
            setTimeout(() => {
                for (let i = 0; i < this.$refs.page.length; i++) {
                    if (
                        this.$refs.page[i].innerText ===
                        String(this.rows).slice(0, -1)
                    ) {
                        this.$refs.page[i].classList.add("active");
                    } else {
                        this.$refs.page[i].classList.remove("active");
                    }
                }
            }, 10);
        },
    },
    mounted() {
        this.slideNumber();
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
                font-size: 12px;
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
            gap: 16px;
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
            @media (max-width: 479.98px) {
                font-size: 14px;
                line-height: 17px;
            }
        }
        .active {
            color: #4182ec;
            text-decoration: underline;
        }
    }
}
</style>

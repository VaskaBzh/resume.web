<template>
    <div class="slider">
        <wrap-table
            ref="list"
            :table="saveTable"
            :wait="wait"
            :empty="empty"
            :errors="errors"
        ></wrap-table>
        <div class="slider__nav">
            <!--            <span class="slider__nav_info" v-if="this.pages === 0">-->
            <!--                0 {{ $t("swiper.or") }}-->
            <!--                {{ this.table.rows.length }}-->
            <!--            </span>-->
            <!--            <span-->
            <!--                class="slider__nav_info"-->
            <!--                v-else-if="this.rows > this.table.rows.length"-->
            <!--            >-->
            <!--                {{ this.startRow }}-{{ this.table.rows.length }}-->
            <!--                {{ $t("swiper.or") }}-->
            <!--                {{ this.table.rows.length }}-->
            <!--            </span>-->
            <!--            <span class="slider__nav_info" v-else>-->
            <!--                {{ this.startRow }}-{{ this.rows }} {{ $t("swiper.or") }}-->
            <!--                {{ this.table.rows.length }}-->
            <!--            </span>-->
            <div class="slider__nav-slides">
                <button class="slider__button" @click="ajax(meta?.links.prev)">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                    >
                        <path
                            d="M14 18L8 12L14 6"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </button>

                <div class="slider__slides" v-if="!haveMeta">
                    <span>...</span>
                </div>
                <div class="slider__slides" v-else>
                    <span class="active">{{
                        links.filter((link) => link.active)[0].label
                    }}</span>
                </div>
                <!--                <div class="slider__slides" v-else>-->
                <!--                    <a-->
                <!--                        @click="ajax(link.url)"-->
                <!--                        v-for="(link, i) in links"-->
                <!--                        :key="i"-->
                <!--                        :class="{-->
                <!--                            active: link.active,-->
                <!--                        }"-->
                <!--                        >{{ link.label }}</a-->
                <!--                    >-->
                <!--                </div>-->
                <button class="slider__button" @click="ajax(meta?.links.next)">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                    >
                        <path
                            d="M10 6L16 12L10 18"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </button>
            </div>
            <div class="slider__nav-rows">
                <input type="text" v-model="rowsNumber" />
                <span class="slider__nav-rows__buttons">
                    <svg
                        @click="rowsNumber = String(Number(rowsNumber) + 1)"
                        width="15"
                        height="15"
                        viewBox="0 0 15 15"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M8.20711 5.20711L11.2929 8.29289C11.9229 8.92286 11.4767 10 10.5858 10H4.41421C3.52331 10 3.07714 8.92286 3.70711 8.29289L6.79289 5.20711C7.18342 4.81658 7.81658 4.81658 8.20711 5.20711Z"
                        /></svg
                    ><svg
                        @click="rowsNumber = String(Number(rowsNumber) - 1)"
                        width="15"
                        height="15"
                        viewBox="0 0 15 15"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M6.79289 9.79289L3.70711 6.70711C3.07714 6.07714 3.52331 5 4.41421 5H10.5858C11.4767 5 11.9229 6.07714 11.2929 6.70711L8.20711 9.79289C7.81658 10.1834 7.18342 10.1834 6.79289 9.79289Z"
                        />
                    </svg>
                </span>
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
        wait: Boolean,
        empty: Object,
        rowsNum: {
            type: Number,
            default: 10,
        },
        errors: Object,
        meta: Object,
    },
    watch: {
        meta(newValue) {
            this.getMeta(newValue);
            if (newValue?.meta.links) {
                this.links = newValue?.meta.links;
                this.dropButtonLinks();
                let lastIndex = Number(
                    this.links[Object.values(this.links).length - 1].label
                );
                if (lastIndex > 9) {
                    let index = this.filteredActiveLink?.label ?? 1;
                    index = Number(index);
                    this.setLinks(index, lastIndex);
                }
            }
            this.cache(newValue);
        },
        rowsNumber(newVal, oldVal) {
            const regex = /^[0-9]*\.?[0-9]*$/;

            this.rowsNumber =
                (
                    regex.test(newVal) &&
                    newVal <= 100 &&
                    newVal > 0
                )
                    ? newVal
                    : oldVal;

            this.$emit("changePerPage", this.rowsNumber);
        },
    },
    data() {
        return {
            viewportWidth: 0,
            rowsNumber: this.rowsNum,
            links: [],
            saveTable: {},
            haveMeta: false,
        };
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    computed: {
        filteredActiveLink() {
            return this.links.filter((el, i) => {
                if (el.active) {
                    return i;
                }
            })[0];
        },
    },
    methods: {
        getMeta(meta) {
            let bool = !!meta?.meta.to;
            if (bool) {
                this.haveMeta = bool;
            } else {
                setTimeout(() => {
                    if (bool) {
                        this.haveMeta = bool;
                    }
                }, 200);
            }
        },
        cache(meta) {
            if (meta?.meta) {
                this.saveTable = this.table;
            }
        },
        dropButtonLinks() {
            this.links.splice(0, 1);
            this.links.splice(this.links.length - 1, 1);
        },
        setLinks(index, lastIndex) {
            let links = [];
            if (index <= 4) {
                links = links.concat(
                    this.mapLinks(0, 4),
                    ["..."],
                    this.mapLinks(lastIndex - 2, lastIndex)
                );
            }
            if (index > 4 && index <= lastIndex - 5) {
                links = links.concat(
                    this.mapLinks(0, 3),
                    ["..."],
                    this.mapLinks(index - 2, index),
                    ["..."],
                    this.mapLinks(lastIndex - 2, lastIndex)
                );
            }
            if (index > lastIndex - 5 && index <= lastIndex) {
                links = links.concat(
                    this.mapLinks(0, 3),
                    ["..."],
                    this.mapLinks(lastIndex - 5, lastIndex)
                );
            }
            this.links = links;
        },
        mapLinks(numStart, numEnd) {
            return this.links.filter((link, i) => {
                if (i >= numStart && i <= numEnd) return link;
            });
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        ajax(url) {
            if (url) {
                let link = url.split("=");
                this.$emit("changePage", link[link.length - 1]);
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
        margin-top: 40px;
        width: 100%;
        display: flex;
        align-items: center;
        min-height: 40px;
        gap: 16px;
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

        &-rows {
            max-width: 96px;
            width: 100%;
            min-height: 40px;
            display: flex;
            padding: 0 5px;
            background: var(--background-island);;
            border-radius: 8px;
            align-items: center;
            @media (max-width: 767.98px) {
                display: none;
            }
            input {
                outline: none;
                color: #7c7c7c;
                border: none;
                font-family: AmpleSoftPro, serif;
                font-weight: 500;
                font-size: 18px;
                line-height: 135%;
                padding: 0 9px 0 8px;
                background: transparent;
                text-align: center;
                max-width: calc(18px + 13px + 12px);
            }
            &__buttons {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 0 15px 0 15px;
                position: relative;
                svg {
                    fill: #7c7c7c;
                    cursor: pointer;
                    width: 15px;
                    height: 15px;
                    transition: all 0.3s ease 0s;
                    &:hover {
                        fill: #343434;
                    }
                }
                &:before {
                    content: "";
                    position: absolute;
                    left: 0;
                    height: 100%;
                    width: 1px;
                    background: #eff2f6;
                }
            }
        }

        // .slider__nav-slides
        &-slides {
            display: flex;
            height: 100%;
            align-items: center;
            gap: 16px;
            margin-left: auto;
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
        svg {
            stroke: #131a29;
        }
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
            color: #3f7bdd !important;
        }
    }
}
</style>

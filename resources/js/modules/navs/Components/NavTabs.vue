<template>
    <div
        class="nav-tabs"
        :class="{
            'nav-tabs-full-page': this.fullPage,
        }"
        ref="tabs"
        v-if="this.viewportWidth > 991.98"
    >
        <a class="nav-tabs_link-back" href="#" @click="service.back">
            <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M14 18L8 12L14 6"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        </a>
        <router-link
            v-for="(link, i) in links"
            :key="i"
            :to="link.url"
            :class="{
                burger_link: this.viewportWidth < 991.98,
                'router-link-active': $page.url.startsWith(
                    `${link.url}`
                ),
            }"
            class="nav-tabs__tab"
        >
            <svg
                v-html="link.icon"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="25"
                viewBox="0 0 24 25"
                fill="none"
            ></svg>

            {{ $t(`tabs.${link.name}`) }}
        </router-link>
    </div>
</template>
<script>
import { Link } from "@inertiajs/vue3";
import { TabsService } from "../services/TabsService";
import {useRoute} from "vue-router";

export default {
    components: {
        Link,
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    data() {
        return {
            viewportWidth: 0,
            service: new TabsService(),
        };
    },
    methods: {
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
    },
    mounted() {
        this.service.setLinks();
    },
    computed: {
        fullPage() {
            const pageArr = useRoute().fullPath.split("/");
            const fullPages = ["income", "settings", "wallets"];
            return fullPages.find(
                (page) => page === pageArr[pageArr.length - 1]
            );
        },
        links() {
            return this.service.links;
        },
    },
};
</script>
<style lang="scss">
.nav-tabs {
    max-width: 240px;
    width: 100%;
    display: flex;
    flex-direction: column;
    border-radius: 12px;
    background: transparent;
    height: fit-content;
    -webkit-box-shadow: 0 11px 34px 0 transparent;
    z-index: 9;
    @media (min-width: 991px) {
        //&:hover {
        //    -webkit-box-shadow: 0 11px 34px 0 rgb(0 0 0 / 10%);
        //}
        overflow: hidden;
        position: fixed;
        top: 132px;
        transform: translateY(0);
    }
    &_link-back {
        display: none;
        @media (min-width: 991px) {
            background: #fafafa;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            visibility: hidden;
            opacity: 0;
            width: 0;
            height: 0;
            svg {
                width: 24px;
                height: 24px;
                stroke: #343434;
            }
            &:hover {
                background: #5389e1;
                svg {
                    stroke: #fafafa;
                }
            }
        }
    }
    //&.fixed {
    //    @media (min-width: 1271px) {
    //        transform: translateY(-92px);
    //    }
    //}
    &-full-page {
        @media (min-width: 991.98px) {
            position: absolute;
            border-radius: 13px;
            padding: 0;
            top: 3px;
            background-color: transparent;
            border: 0.5px solid transparent;
            width: fit-content;
            height: fit-content;
            -webkit-box-shadow: 0 11px 34px 0 transparent !important;
            &.fixed {
                @media (min-width: 991px) {
                    transform: translate(0);
                }
            }
            .nav-tabs {
                &__tab {
                    overflow: hidden;
                    visibility: hidden;
                    opacity: 0;
                    width: 0;
                    height: 0;
                    min-height: 0;
                }

                &_link-back {
                    width: 40px;
                    height: 40px;
                    overflow: visible;
                    visibility: visible;
                    opacity: 1;
                }
            }
        }
    }
    //@media (max-width: 1270px) {
    //    max-height: 68px;
    //    height: 100%;
    //    max-width: 131%;
    //    width: 131%;
    //    overflow-x: scroll;
    //    overflow-y: visible;
    //    background-color: transparent;
    //    padding: 4px calc((1270px - 970px) / 2) 0;
    //    border-radius: 0;
    //    flex-direction: row;
    //    box-sizing: border-box;
    //    gap: 6px;
    //    position: absolute;
    //    top: 0;
    //    left: 0;
    //    margin: 0 calc((1270px - 970px) / -2);
    //    &::-webkit-scrollbar {
    //        width: 0;
    //    }
    //}
    @media (max-width: 991.98px) {
        padding: 4px calc((992px - 750px) / 2) 0;
        margin: 0 calc((992px - 750px) / -2);
        max-width: calc(100% + (992px - 750px) / 2);
        width: calc(100% + (992px - 750px) / 2);
    }
    @media (max-width: 991.98px) {
        padding: 4px 15px 0 30px;
        margin: 0 -15px;
        max-width: calc(100% + 15px);
        width: calc(100% + 15px);
        display: none;
    }
    @media (max-width: 479.98px) {
        padding: 4px 15px 0 15px;
        margin: 0;
        max-width: calc(100% + 30px);
        width: calc(100% + 30px);
    }
    &__tab {
        width: 100%;
        color: #80809a;
        padding: 5px 20px 5px 16px;
        display: inline-flex;
        align-items: center;
        position: relative;
        height: 60px;
        min-height: 60px;
        user-select: none;
        font-weight: 500;
        -webkit-tap-highlight-color: transparent;
        //-webkit-box-shadow: 0 11px 34px 0 transparent;
        @media (min-width: 991px) {
            position: relative;
            color: #000;
            border-radius: 12px;
            font-weight: 400;
            font-size: 20px;
            font-family: AmpleSoftPro, serif;
            line-height: 132.6%;
            gap: 16px;
            background: transparent;
            svg {
                width: 22px;
                height: 22px;
            }
        }
        //@media (max-width: 1270px) {
        //    background: rgba(255, 255, 255, 0.5);
        //    border-radius: 8px;
        //    color: #818c99;
        //    height: 40px;
        //    min-height: 40px;
        //    padding: 0 20px;
        //    justify-content: center;
        //    font-size: 18px;
        //    line-height: 23px;
        //    border: none;
        //    width: auto;
        //    white-space: nowrap;
        //    svg {
        //        display: none;
        //    }
        //}
        @media (max-width: 991.98px) {
            font-size: 16px;
            line-height: 16px;
            height: 34px;
            min-height: 34px;
        }
        @media (max-width: 991.98px) {
            svg {
                display: block;
            }
        }
        @media (max-width: 380.98px) {
            height: 28px;
            min-height: 28px;
            font-size: 16px;
            line-height: 14px;
        }
        svg {
            @media (min-width: 991px) {
                fill: #417fe5;
            }
        }
        &-stroke {
            svg {
                @media (min-width: 991px) {
                    fill: transparent;
                    stroke: #417fe5;
                }
            }
            //&:hover {
            //    svg {
            //        fill: transparent !important;
            //        fill-opacity: 0 !important;
            //        stroke-opacity: 1;
            //        stroke: #4182ec !important ;
            //    }
            //}
        }
        &:hover {
            //-webkit-box-shadow: 0 11px 34px 0 rgb(0 0 0 / 5%);
        }
        //    @media (max-width: 1270px) {
        //        background: #fff;
        //        border: 0.5px solid rgba(0, 0, 0, 0.08);
        //        box-shadow: 0 4px 4px rgba(0, 0, 0, 0.04);
        //    }
        //    @media (min-width: 1271px) {
        //        &:before {
        //            opacity: 1;
        //            visibility: visible;
        //        }
        //        svg {
        //            stroke: transparent;
        //            stroke-width: 0;
        //            fill-opacity: 1;
        //            fill: #4182ec;
        //        }
        //    }
        //}
        &:last-child {
            @media (min-width: 1270px) {
                border-bottom: none;
            }
        }
        svg {
            @media (min-width: 1270px) {
                height: 24px;
                width: 24px;
            }
        }
    }
    .router-link-active {
        @media (min-width: 991.98px) {
            color: #5389e1;
            background: #dce4f1;
            font-weight: 500;
        }
    }
}
</style>

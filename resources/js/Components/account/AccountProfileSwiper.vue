<template>
    <swiper
        class="wrap__swiper"
        v-if="Object.values(this.allAccounts).length > 0"
        :modules="modules"
        :slides-per-view="1"
        :space-between="15"
        :pagination="pagination"
    >
        <swiper-slide
            v-for="(account, i) in this.allAccounts"
            :key="i"
            :accKey="i"
            :accountInfo="account"
            :profit="this.profit"
            class="profile wrap__column"
            :data-key="account.id"
        >
            <div class="profile__head" ref="profileHead">
                <span
                    class="profile__name"
                    @click="this.changeActive(account.id)"
                    >{{ account.name }}</span
                >
            </div>
            <div class="profile__body">
                <div class="profile__body-block">
                    <span class="profile__body-name">Хешрейт / 1ч</span>
                    <span class="profile__body-value">
                        {{ account.shares1m }}
                        {{ account.unit }}H/s</span
                    >
                </div>
                <div class="profile__body-block">
                    <span class="profile__body-name">Воркеры</span>
                    <span class="profile__body-value">
                        {{ account.workersActive }} /
                        {{ account.workersAll }}
                        <span>(Активные / Все)</span>
                    </span>
                </div>
                <div class="profile__body-block">
                    <span class="profile__body-name">Прогноз</span>
                    <span class="profile__body-value">
                        {{ this.todayProfit[account.id] }} BTC</span
                    >
                </div>
                <div class="profile__body-block">
                    <span class="profile__body-name">Выплачено</span>
                    <span class="profile__body-value">
                        {{ Number(account.myPayment).toFixed(8) }} BTC</span
                    >
                </div>
            </div>
        </swiper-slide>
    </swiper>
</template>
<script>
import { Link, router } from "@inertiajs/vue3";
import { Pagination } from "swiper";
import { Swiper, SwiperSlide } from "swiper/vue";
import { mapGetters } from "vuex";
import Vue from "lodash";
export default {
    emits: ["changeActive", "click"],
    components: {
        Link,
        // eslint-disable-next-line vue/no-unused-components
        Swiper,
        // eslint-disable-next-line vue/no-unused-components
        SwiperSlide,
    },
    setup() {
        try {
            return {
                pagination: {
                    clickable: true,
                    renderBullet: function (index, className) {
                        return '<span class="' + className + '">' + "</span>";
                    },
                },
                modules: [Pagination],
            };
        } catch {
            this.$store.dispatch(
                "getMessage",
                "Произошла ошибка перегазгрузите страницу для корректной работы."
            );
        }
    },
    props: {
        accountInfo: Object,
        profit: Object,
    },
    data() {
        return {
            account: this.accountInfo,
        };
    },
    beforeUpdate() {
        if (this.allAccounts && this.allAccounts[this.getActive]) {
            this.startMount(this.getActive);
        }
    },
    mounted() {
        if (this.allAccounts && this.allAccounts[this.getActive]) {
            this.startMount(this.getActive);
        }
    },
    methods: {
        activeMount() {
            document.querySelectorAll(".profile").forEach((profile) => {
                profile.classList.remove("active");
                if (profile.dataset.key == this.getActive) {
                    profile.classList.add("active");
                }
            });
        },
        async startMount(index) {
            this.changeActive(index);
        },
        router() {
            return router;
        },
        changeActive(id) {
            this.$store.commit("updateActive", id);
            setTimeout(this.activeMount, 300);
        },
    },
    computed: {
        ...mapGetters(["allAccounts", "btcInfo", "getActive"]),
        todayProfit() {
            let obj = {};
            if (this.btcInfo && this.btcInfo.btc && this.allAccounts) {
                let val;
                Object.values(this.allAccounts).forEach((acc) => {
                    val = 0;
                    if (acc.shares1m > 0) {
                        val =
                            (acc.shares1m *
                                Math.pow(10, 12) *
                                86400 *
                                this.btcInfo.btc.reward) /
                            (this.btcInfo.btc.diff * Math.pow(2, 32));
                    }
                    Vue.set(
                        obj,
                        acc.id,
                        (val * (1 - 0.035 - 0.0175)).toFixed(8)
                    );
                });
            }
            return obj;
            // if (isNaN(this.profit[this.accountInfo.id])) {
            //     return "0.00000000";
            // } else {
            //     return Number(this.profit[this.accountInfo.id]).toFixed(8);
            // }
        },
    },
};
</script>

<style lang="scss" scoped>
.profile {
    padding: 20px;
    background: rgba(255, 255, 255, 1);
    border-radius: 21px;
    border: 1px solid;
    border-color: transparent;
    transition: all 0.3s ease 0s;
    height: 100%;
    max-width: 416px;
    @media (max-width: 991.98px) {
        max-width: 339px;
        padding: 16px 12px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    @media (max-width: 767.98px) {
        max-width: 100%;
    }
    @media (max-width: 479.98px) {
        background: rgba(255, 255, 255, 0.29);
        border: 0.5px solid #d7d8d9;
    }
    //&.active {
    //    border-color: rgba(#331a38, 0.5);
    //    background: #331a38;
    //    .profile {
    //        &__name {
    //            color: #ffffff;
    //            &:hover {
    //                text-decoration-color: #fff;
    //            }
    //        }
    //        @media (min-width: 479.98px) {
    //            &__body {
    //                &-name,
    //                &-value {
    //                    color: #fff;
    //                    span {
    //                        color: #fff;
    //                        width: 100px;
    //                    }
    //                }
    //            }
    //        }
    //    }
    //    svg {
    //        stroke: #ffffff;
    //    }
    //}
    &__head {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        margin-bottom: 4px;
        @media (max-width: 479.98px) {
            position: relative;
        }
    }
    &__name {
        margin-right: auto;
        font-size: 16px;
        line-height: 24px;
        font-family: AmpleSoftPro, serif;
        font-weight: 700;
        text-decoration: underline;
        text-decoration-color: transparent;
        transition: all 0.3s ease 0s;
        cursor: pointer;
        @media (max-width: 991.98px) {
            font-size: 24px;
            line-height: 32px;
            margin-bottom: 0;
        }
        @media (max-width: 479.98px) {
            font-size: 18px;
            line-height: 22px;
        }
        &:hover {
            text-decoration-color: #331a38;
        }
    }
    svg {
        stroke: #99acd3;
        width: 24px;
        height: 24px;
        cursor: pointer;
        transition: all 0.3s ease 0s;
        &:hover,
        &:active {
            stroke: #4182ec;
        }
        @media (max-width: 479.98px) {
            width: 24px;
            height: 24px;
            stroke: #4182ec;
        }
    }
    &__body {
        display: flex;
        flex-wrap: wrap;
        gap: 12px 8px;
        @media (max-width: 991.98px) {
            gap: 20px 8px;
        }
        @media (max-width: 479.98px) {
            gap: 6px;
            color: rgba(255, 255, 255, 0.3);
            background-color: transparent;
            padding: 0;
        }
        &-block {
            width: calc(50% - 5px);
            display: flex;
            flex-direction: column;
            &:nth-child(2n) {
                margin-right: 0;
            }
            @media (max-width: 479.98px) {
                background: #ffffff;
                border-radius: 12px;
                border: 0.5px solid #d7d8d9;
                margin: 0;
                padding: 4px 10px;
            }
        }
        &-name {
            color: rgba(0, 0, 0, 0.62);
            font-size: 14px;
            line-height: 20px;
            margin-bottom: 4px;
            transition: all 0.3s ease 0s;
            @media (max-width: 991.98px) {
                font-size: 16px;
                line-height: 24px;
            }
            @media (max-width: 479.98px) {
                font-size: 14px;
                line-height: 16px;
                color: #818c99;
                margin-bottom: 6px;
            }
        }
        &-value {
            font-size: 14px;
            line-height: 20px;
            font-weight: 500;
            transition: all 0.3s ease 0s;
            @media (max-width: 991.98px) {
                font-size: 16px;
                line-height: 24px;
            }
            span {
                color: rgba(0, 0, 0, 0.62);
                font-weight: 400;
                font-size: 12px;
                line-height: 16px;
                transition: all 0.3s ease 0s;
            }
            @media (max-width: 479.98px) {
                font-size: 14px;
                line-height: 16px;
                color: #000034;
            }
        }
    }
}
</style>

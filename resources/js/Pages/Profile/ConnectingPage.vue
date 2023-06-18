<template>
    <Head :title="$t('connection.title')" />
    <div class="connecting profile">
        <div class="connecting__wrapper">
            <main-title class="cabinet_title" tag="h3">{{
                $t("connection.title")
            }}</main-title>
            <div>
                <copy-block
                    v-for="(object, i) in this.copyObject"
                    :key="i"
                    :copyObject="object"
                ></copy-block>
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import ProfileLayoutView from "@/Shared/ProfileLayoutView.vue";
import CopyBlock from "@/Components/technical/blocks/profile/CopyBlock.vue";
import { router, Head } from "@inertiajs/vue3";
import { mapGetters } from "vuex";

export default {
    components: { MainTitle, Head, CopyBlock },
    layout: ProfileLayoutView,
    data() {
        return {
            viewportWidth: 0,
        };
    },
    methods: {
        router() {
            return router;
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
    },
    async created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    computed: {
        ...mapGetters(["allAccounts"]),
        copyObject() {
            return [
                {
                    title: this.$t("connection.block.title"),
                    copyObject: [
                        { link: "btc.all-btc.com:4444", title: "Port" },
                        { link: "btc.all-btc.com:3333", title: "Port 1" },
                        { link: "btc.all-btc.com:2222", title: "Port 2" },
                    ],
                },
            ];
        },
    },
    mounted() {
        document.title = "Подключение";
    },
};
</script>
<style lang="scss" scoped>
.connecting {
    .title {
        margin-bottom: 40px;
        @media (max-width: 767.98px) {
            margin-bottom: 18px;
        }
    }
    // .connecting_question
    &__question {
        width: 100%;
        min-height: 68px;
        padding: 12px 20px;
        border-radius: 21px;
        background-color: #fff;
        display: flex;
        align-items: center;
        @media (max-width: 767.98px) {
            padding: 12px;
        }
        &_wrap {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            margin-right: 16px;
            background-color: rgba(194, 213, 242, 0.61);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            @media (max-width: 767.98px) {
                margin-right: 10px;
            }
        }
        &_title {
            font-weight: 700;
            font-family: AmpleSoftPro, serif;
            font-size: 18px;
            line-height: 21px;
            color: #000000;
            margin-bottom: 8px;
            @media (max-width: 767.98px) {
                margin: 0;
                font-size: 16px;
                line-height: 20px;
            }
        }
        &_text {
            font-weight: 400;
            line-height: 21px;
            @media (max-width: 767.98px) {
                font-size: 16px;
                line-height: 16px;
            }
        }
    }
    // .connecting__wrapper
    &__wrapper {
        width: 100%;
    }
    &__select {
        max-width: 280px !important;
        height: 40px;
        @media (max-width: 767.98px) {
            margin: 6px 0 0;
            max-width: 100% !important;
            height: 38px;
        }
    }
    .title {
        @media (max-width: 767.98px) {
            margin-bottom: 24px;
        }
    }
}
</style>

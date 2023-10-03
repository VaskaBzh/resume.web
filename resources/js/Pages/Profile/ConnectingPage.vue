<template>
    <div class="connecting">
        <div class="connecting__wrapper">
            <main-title class="title-connecting" tag="h4">{{
                $t("connection.title")
            }}</main-title>
            <div>
                <copy-block
                    v-for="(object, i) in this.copyObject"
                    :key="i"
                    :copyObject="object"
                ></copy-block>
            </div>
            <div class="note-card">
                <span class="note-text">{{ $t("connection.note") }}</span>
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import CopyBlock from "@/Components/technical/blocks/profile/CopyBlock.vue";
import { router, Head } from "@inertiajs/vue3";
import { mapGetters } from "vuex";

export default {
    components: { MainTitle, Head, CopyBlock },
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
                        { link: "btc.all-btc.com:4444", title: "Port1" },
                        { link: "btc.all-btc.com:3333", title: "Port 2" },
                        { link: "btc.all-btc.com:2222", title: "Port 3" },
                    ],
                },
            ];
        },
    },
    watch: {
        "$i18n.locale"() {
            document.title = this.$t("header.links.connecting");
        },
    },
    mounted() {
        document.title = this.$t("header.links.connecting");
    },
};
</script>
<style lang="scss" scoped>
.title-connecting{
    margin-bottom: 8px;
    color: var(--text-primary-80);
    font-family: Unbounded;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 155%; /* 27.9px */
}
.note-card{
    border-radius: 12px;
    background: var(--background-island-inner-1, #F5FAFF);
    padding: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-top: 40px;
}
.note-text{
    color: var(--primary-400, #53B1FD);
    font-family: NunitoSans;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 145%; /* 20.3px */
}
@media(max-width: 500px){
    .note-text{
        font-size: 12px;
        line-height: 16px;
    }
    .note-card{
        margin-top: 32px;
    }
}
.connecting {
    display: flex;
    align-items: center;
    justify-content: center;
    height: calc(100vh - 132px);
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
        border-radius: 24px;
        background: var(--background-island);
        box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
        width: 560px;
        padding: 32px 40px;
        @media (max-width: 767.98px) {
            margin: 0 16px;
            padding: 16px;
        }
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
}
</style>

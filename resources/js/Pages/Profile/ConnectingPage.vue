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
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                 <path d="M22.5303 2.53033C22.8232 2.23744 22.8232 1.76256 22.5303 1.46967C22.2374 1.17678 21.7626 1.17678 21.4697 1.46967L22.5303 2.53033ZM19.4697 3.46967C19.1768 3.76256 19.1768 4.23744 19.4697 4.53033C19.7626 4.82322 20.2374 4.82322 20.5303 4.53033L19.4697 3.46967ZM19.4967 11.7619L18.9664 11.2316L19.4967 11.7619ZM16.5933 12.4877L17.1236 11.9574L16.5933 12.4877ZM18.7708 12.4877L19.3012 13.0181L18.7708 12.4877ZM11.5123 5.22916L10.9819 4.69883L11.5123 5.22916ZM11.5123 7.40674L10.9819 7.93707L11.5123 7.40674ZM12.2381 4.5033L12.7684 5.03363L12.2381 4.5033ZM4.53033 20.5303C4.82322 20.2374 4.82322 19.7626 4.53033 19.4697C4.23744 19.1768 3.76256 19.1768 3.46967 19.4697L4.53033 20.5303ZM1.46967 21.4697C1.17678 21.7626 1.17678 22.2374 1.46967 22.5303C1.76256 22.8232 2.23744 22.8232 2.53033 22.5303L1.46967 21.4697ZM11.7619 19.4967L12.2922 20.027H12.2922L11.7619 19.4967ZM12.4877 16.5933L13.0181 16.0629L12.4877 16.5933ZM12.4877 18.7708L11.9574 18.2405H11.9574L12.4877 18.7708ZM5.22916 11.5123L5.75949 12.0426L5.75949 12.0426L5.22916 11.5123ZM7.40674 11.5123L6.87641 12.0426L7.40674 11.5123ZM4.5033 12.2381L3.97297 11.7078L3.97297 11.7078L4.5033 12.2381ZM9.96967 8.96967C9.67678 9.26256 9.67678 9.73744 9.96967 10.0303C10.2626 10.3232 10.7374 10.3232 11.0303 10.0303L9.96967 8.96967ZM12.5303 8.53033C12.8232 8.23744 12.8232 7.76256 12.5303 7.46967C12.2374 7.17678 11.7626 7.17678 11.4697 7.46967L12.5303 8.53033ZM13.9697 12.9697C13.6768 13.2626 13.6768 13.7374 13.9697 14.0303C14.2626 14.3232 14.7374 14.3232 15.0303 14.0303L13.9697 12.9697ZM16.5303 12.5303C16.8232 12.2374 16.8232 11.7626 16.5303 11.4697C16.2374 11.1768 15.7626 11.1768 15.4697 11.4697L16.5303 12.5303ZM21.4697 1.46967L19.4697 3.46967L20.5303 4.53033L22.5303 2.53033L21.4697 1.46967ZM11.7078 3.97297L10.9819 4.69883L12.0426 5.75949L12.7684 5.03363L11.7078 3.97297ZM10.9819 7.93707L16.0629 13.0181L17.1236 11.9574L12.0426 6.87641L10.9819 7.93707ZM19.3012 13.0181L20.027 12.2922L18.9664 11.2316L18.2405 11.9574L19.3012 13.0181ZM20.027 12.2922C22.3243 9.99492 22.3243 6.27027 20.027 3.97297L18.9664 5.03363C20.6779 6.74514 20.6779 9.52005 18.9664 11.2316L20.027 12.2922ZM12.7684 5.03363C14.48 3.32212 17.2549 3.32212 18.9664 5.03363L20.027 3.97297C17.7297 1.67568 14.0051 1.67568 11.7078 3.97297L12.7684 5.03363ZM12.0426 6.87641C11.8131 6.6469 11.7519 6.45527 11.75 6.32326C11.7482 6.19624 11.7993 6.0028 12.0426 5.75949L10.9819 4.69883C10.521 5.15975 10.2413 5.72436 10.2502 6.34472C10.259 6.96007 10.55 7.50512 10.9819 7.93707L12.0426 6.87641ZM18.2405 11.9574C18.011 12.1869 17.8194 12.2481 17.6874 12.25C17.5603 12.2518 17.3669 12.2007 17.1236 11.9574L16.0629 13.0181C16.5239 13.479 17.0885 13.7587 17.7088 13.7498C18.3242 13.741 18.8692 13.45 19.3012 13.0181L18.2405 11.9574ZM3.46967 19.4697L1.46967 21.4697L2.53033 22.5303L4.53033 20.5303L3.46967 19.4697ZM5.03363 12.7684L5.75949 12.0426L4.69883 10.9819L3.97297 11.7078L5.03363 12.7684ZM6.87641 12.0426L11.9574 17.1236L13.0181 16.0629L7.93707 10.9819L6.87641 12.0426ZM11.9574 18.2405L11.2316 18.9664L12.2922 20.027L13.0181 19.3012L11.9574 18.2405ZM11.2316 18.9664C9.52005 20.6779 6.74514 20.6779 5.03363 18.9664L3.97297 20.027C6.27027 22.3243 9.99492 22.3243 12.2922 20.027L11.2316 18.9664ZM3.97297 11.7078C1.67568 14.0051 1.67568 17.7297 3.97297 20.027L5.03363 18.9664C3.32212 17.2549 3.32212 14.48 5.03363 12.7684L3.97297 11.7078ZM7.93707 10.9819C7.50512 10.55 6.96007 10.259 6.34472 10.2502C5.72436 10.2413 5.15975 10.521 4.69883 10.9819L5.75949 12.0426C6.0028 11.7993 6.19624 11.7482 6.32326 11.75C6.45527 11.7519 6.6469 11.8131 6.87641 12.0426L7.93707 10.9819ZM13.0181 19.3012C13.45 18.8692 13.741 18.3242 13.7498 17.7088C13.7587 17.0885 13.479 16.5239 13.0181 16.0629L11.9574 17.1236C12.2007 17.3669 12.2518 17.5603 12.25 17.6874C12.2481 17.8194 12.1869 18.011 11.9574 18.2405L13.0181 19.3012ZM11.0303 10.0303L12.5303 8.53033L11.4697 7.46967L9.96967 8.96967L11.0303 10.0303ZM15.0303 14.0303L16.5303 12.5303L15.4697 11.4697L13.9697 12.9697L15.0303 14.0303Z" fill="#53B1FD"/>
                </svg>
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
                        { link: "btc.all-btc.com:4444", title: "Port" },
                        { link: "btc.all-btc.com:3333", title: "Port 1" },
                        { link: "btc.all-btc.com:2222", title: "Port 2" },
                    ],
                },
            ];
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

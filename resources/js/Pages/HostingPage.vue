<template>
    <main class="main-hosting">
        <div class="hosting__section">
            <article class="article-hosting first-text hosting__section">
                <div class="hosting-content">
                    <span class="text-on">{{ $t("title[0]") }}</span>
                    <span class="text-fifty">{{ $t("title[1]") }} <br/></span>
                    <span class="text-increase"
                    >{{ $t("title[2]") }} <br
                    /></span>
                    <span class="text-income">{{ $t("title[3]") }} <br/></span>
                    <span class="text-cvt">{{ $t("title[4]") }}</span>
                </div>
                <button-blue class="get-consultation"
                >{{ $t("button") }}
                </button-blue>
            </article>
            <article
                class="article-hosting test-color second-text hosting__section"
            >
                <AboutView
                    :facts="factsHosting"
                    :title="titleHostings"
                ></AboutView>
            </article>
            <article class="article-hosting third-text hosting__section">
                <div class="how-are-we">{{ $t("offer.button") }}</div>
                <div class="offer-content">
                    <span class="text-offer">{{ $t("offer.title[0]") }}</span>
                    <div class="text-offer-column">
                        <span class="text-offer"
                        >{{ $t("offer.title[1]") }}<br
                        /></span>
                        <span class="text-offer"
                        >{{ $t("offer.title[2]") }}<br
                        /></span>
                    </div>
                    <span class="text-offer text-end"
                    >{{ $t("offer.title[3]") }}<br
                    /></span>
                </div>
                <div class="offer-card-container">
                    <div class="offer-card" v-for="offer in offers">
                        <div>
                            <p class="offer-title">{{ offer.percent }}</p>
                            <p class="offer-title">{{ offer.title }}</p>
                        </div>
                        <p class="offer-text">{{ offer.text }}</p>
                    </div>
                </div>
            </article>
            <article
                class="article-hosting article-work-with-us hosting__section hosting__section-blue"
            >
                <BlueView :inf="workingWithUs"></BlueView>
            </article>
            <article
                class="article-hosting hosting__section-wrap hosting__section"
            >
                <MonitoringSystemCard></MonitoringSystemCard>
            </article>
            <article
                class="article-hosting hosting__section-wrap hosting__section"
            >
                <SupportSystemCard></SupportSystemCard>
            </article>
            <article
                class="article-hosting article-work-with-us hosting__section hosting__section-blue"
            >
                <BlueView :inf="getYourClients"></BlueView>
            </article>
            <article
                class="article-hosting hosting__section-wrap hosting__section"
            >
                <PersonalAreaCard></PersonalAreaCard>
            </article>
            <article
                class="article-hosting hosting__section-wrap hosting__section"
            >
                <MobileAppCard></MobileAppCard>
            </article>
            <article
                class="article-hosting article-work-with-us hosting__section hosting__section-blue"
            >
                <GuaranteeCard></GuaranteeCard>
            </article>
            <article class="article-hosting second-text hosting__section">
                <ConnectCard></ConnectCard>
            </article>
        </div>
    </main>
</template>
<script>
import HeaderComponent from "../modules/common/Components/HeaderComponent.vue";
import ButtonBlue from "../modules/common/Components/UI/ButtonBlue.vue";
import MonitoringSystemCard from "../modules/hosting/Components/MonitoringSystemCard.vue";
import SupportSystemCard from "../modules/hosting/Components/SupportSystemCard.vue";
import ForClientsCard from "../modules/hosting/Components/ForClientsCard.vue";
import PersonalAreaCard from "../modules/hosting/Components/PersonalAreaCard.vue";
import MobileAppCard from "../modules/hosting/Components/MobileAppCard.vue";
import GuaranteeCard from "../modules/hosting/Components/GuaranteeCard.vue";
import ConnectCard from "../modules/hosting/Components/ConnectCard.vue";
import FooterHosting from "../modules/hosting/Components/FooterHosting.vue";
import AboutView from "../modules/common/landing/Components/AboutView.vue";
import BlueView from "../modules/common/landing/Components/BlueView.vue";
import {HostingMessage} from "@/modules/hosting/lang/HostingMessage";

export default {
    name: "hosting-page",
    components: {
        HeaderComponent,
        ButtonBlue,
        MonitoringSystemCard,
        SupportSystemCard,
        ForClientsCard,
        PersonalAreaCard,
        MobileAppCard,
        GuaranteeCard,
        ConnectCard,
        FooterHosting,
        AboutView,
        BlueView,
    },
    i18n: {
        sharedMessages: HostingMessage,
    },
    data() {
        return {
            factsHosting: [
                {
                    num: ">3",
                    grayText: this.$t("who_are_we.column.gray_text[0]"),
                    mainText: [
                        this.$t("who_are_we.column.main_text[0]"),
                        this.$t("who_are_we.column.main_text[1]"),
                    ],
                },
                {
                    num: "5",
                    grayText: this.$t("who_are_we.column.gray_text[1]"),
                    mainText: [
                        this.$t("who_are_we.column.main_text[2]"),
                        this.$t("who_are_we.column.main_text[3]"),
                    ],
                },
                {
                    num: ">1,7",
                    grayText: "EH /s",
                    mainText: [
                        this.$t("who_are_we.column.main_text[4]"),
                        this.$t("who_are_we.column.main_text[5]"),
                    ],
                },
            ],
            offers: [
                {
                    percent: this.$t("offer.cards.title[0]"),
                    title: this.$t("offer.cards.title[1]"),
                    text: this.$t("offer.cards.text[0]"),
                },
                {
                    percent: this.$t("offer.cards.title[2]"),
                    title: this.$t("offer.cards.title[3]"),
                    text: this.$t("offer.cards.text[1]"),
                },
            ],
            titleHostings: [
                this.$t("who_are_we.title[0]"),
                this.$t("who_are_we.title[1]"),
                this.$t("who_are_we.title[2]"),
                this.$t("who_are_we.title[3]"),
                this.$t("who_are_we.title[4]"),
            ],
            getYourClients: {
                title: this.$t("for_clients.button"),
                text: this.$t("for_clients.text"),
            },
            workingWithUs: {
                title: this.$t("pluse.button"),
                text: this.$t("pluse.text"),
            },
        };
    },
};
</script>
<style scoped>
.offer-content {
    color: var(--gray-1100, #f5faff);
    text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
    font-family: Unbounded;
    font-size: 55px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 66px */
    text-transform: uppercase;
}

.text-offer-column {
    margin-left: 195px;
}

.text-end {
    display: flex;
    justify-content: end;
}

.first-text {
    flex-direction: column;
}

.offer-card-container {
    display: flex;
    justify-content: flex-end;
    margin-right: 137px;
    gap: 20px;
}

.offer-card {
    border-radius: 40px;
    border-top: 2px solid #555353;
    border-bottom: 0.5px solid #555353;
    background: var(--gray-480, rgba(13, 13, 13, 0.8));
    display: inline-flex;
    padding: 30px;
    flex-direction: column;
    align-items: flex-start;
    gap: 30px;
    width: 385px;
}

.offer-title {
    color: var(--gray-3100, #d0d5dd);
    font-family: Unbounded;
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 19.2px */
    text-transform: uppercase;
}

.offer-text {
    color: var(--gray-170, rgba(245, 250, 255, 0.7));
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 110%; /* 19.8px */
    width: 280px;
}

/*
//.main-hosting {
//  width: 100vw;
//  height: 100vh;
//  margin: 0 auto;
//  overflow-y: scroll;
//  transition: all .5s;
//}

//.main-hosting__container {
//  margin: 0 auto;
//  display: flex;
//  flex-flow: column nowrap;
//  align-items: center;
//  justify-content: center;
//  max-width: 1720px;
//}

.article-hosting {
    height: auto;
    display: flex;
    align-items: center;
    justify-content: center;
}
*/


.third-text {
    flex-direction: column;
    gap: 110px;
}

.hosting-content {
    max-width: 607px;
    max-height: 317px;
    color: var(--gray-1100, #f5faff);
    font-feature-settings: "clig" off, "liga" off;
    font-family: Unbounded, serif;
    font-size: clamp(44px, 7vw, 24px);
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 52.8px */
    text-transform: uppercase;
}

.text-fifty {
    font-size: clamp(156px, 11vw, 60px);
}

.text-income {
    display: flex;
    align-items: end;
    justify-content: end;
}

.get-consultation {
    margin-top: 50px;
    padding: 8px 20px;
    width: 100%;
    max-width: 534px;
    color: var(--gray-1100, #f5faff);
    border-radius: 40px;
    border: 1px solid rgba(192, 228, 255, 0.6);
    background: var(--gray-480, rgba(13, 13, 13, 0.8));
    font-family: Unbounded, serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 16.8px */
    text-transform: uppercase;
}

.how-are-we {
    border-radius: 30px;
    border: 0.5px solid var(--secondary-gray, #98a2b3);
    padding: 14px 24px;
    color: var(--gray-3100, #d0d5dd);
    font-family: Unbounded;
    font-size: 20px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 24px */
    text-transform: uppercase;
}

.footer-hosting {
    /* height: 673px; */
    flex-shrink: 0;
    border-radius: 70px 70px 0px 0px;
    border-top: 1px solid #585757;
    border-bottom: 1px solid #585757;
    background: var(--gray-4100, #0d0d0d);
    box-shadow: 0px -4px 4px 0px rgba(18, 31, 78, 0.25),
    0px 4px 4px 0px rgba(0, 0, 0, 0.25);
    padding: 100px 100px 50px;
}

@media (max-width: 850px) {
    .help-button {
        display: none;
    }

    .offer-content {
        font-size: 36px;
    }

    .how-are-we {
        font-size: 14px;
    }

    .offer-card-container {
        margin-right: 0px;
        justify-content: center;
    }

    .article-hosting {
        height: auto;
    }
}

@media (max-width: 768px) {
    .hosting-content {
        font-size: 36px;
        line-height: 120%; /* 43.2px */
        width: 400px;
    }

    .text-fifty {
        font-size: 106px;
    }

    .get-consultation {
        width: 80%;
    }

    .second-text {
        width: 85%;
        gap: 50px;
    }

    .offer-card-container {
        margin-right: 0px;
        justify-content: center;
        align-items: center;
        flex-flow: column nowrap;
    }
}

@media (max-width: 450px) {
    .hosting-content {
        font-size: 22px;
        width: 244px;
        height: auto;
    }

    .text-fifty {
        font-size: 60px;
    }

    .get-consultation {
        width: 328px;
        font-size: 12px;
        font-style: normal;
        font-weight: 600;
        margin-top: 70px;
        line-height: 120%; /* 14.4px */
    }

    .how-are-we {
        font-size: 12px;
        padding: 8px 10px;
    }

    .second-text {
        gap: 50px;
    }

    .offer-content {
        font-size: 22px;
        padding: 0 16px;
        margin-top: 30px;
    }

    .text-offer-column {
        margin-left: 75px;
    }

    .offer-card-container {
        flex-direction: column;
    }

    .offer-card {
        width: 328px;
        padding: 20px;
    }

    .offer-title {
        font-size: 14px;
    }

    .offer-text {
        font-size: 14px;
        width: auto;
    }

    .third-text {
        gap: 50px;
    }

    .footer-hosting {
        padding: 40px 16px;
    }
}

@media (max-width: 450px) {
    .hosting-content {
        font-size: 22px;
        width: 244px;
        height: auto;
    }

    .text-fifty {
        font-size: 60px;
    }

    .get-consultation {
        width: 90vw;
        font-size: 12px;
        font-style: normal;
        font-weight: 600;
        margin-top: 70px;
        line-height: 120%; /* 14.4px */
    }

    .how-are-we {
        font-size: 12px;
        padding: 8px 10px;
    }

    .second-text {
        gap: 50px;
    }

    .offer-content {
        font-size: 22px;
        padding: 0 16px;
        margin-top: 30px;
    }

    .text-offer-column {
        margin-left: 75px;
    }

    .offer-card-container {
        flex-direction: column;
    }

    .offer-card {
        width: 328px;
        padding: 20px;
    }

    .offer-title {
        font-size: 14px;
    }

    .offer-text {
        font-size: 14px;
        width: auto;
    }

    .third-text {
        gap: 50px;
    }

    .footer-hosting {
        padding: 40px 16px;
    }
}
</style>

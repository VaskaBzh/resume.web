<template>
    <div class="guarantee__section guarantee__section-blue" ref="view">
        <div class="guarantee-card">
            <p class="title-card">{{ $t("guarantees.title") }}</p>
            <p class="text-card">{{ $t("guarantees.text") }}</p>
        </div>
        <faq-view :faq="faq" class="remove_before"></faq-view>
    </div>
</template>
<script>
import {HostingMessage} from "@/modules/hosting/lang/HostingMessage";
import FaqView from "../../home/Components/Views/FaqView.vue";

export default {
    i18n: {
        sharedMessages: HostingMessage,
    },
    components: {
        FaqView,
    },
    data() {
        return {
            isOpenAccordion: false,
        };
    },
    computed: {
        faq() {
            return [
                {
                    title: this.$t("guarantees.list.title[0]"),
                    text: this.$t("guarantees.list.text[0]"),
                },
                {
                    title: this.$t("guarantees.list.title[1]"),
                    text: this.$t("guarantees.list.text[1]"),
                },
                {
                    title: this.$t("guarantees.list.title[2]"),
                    text: this.$t("guarantees.list.text[2]"),
                },
                {
                    title: this.$t("guarantees.list.title[3]"),
                    text: this.$t("guarantees.list.text[3]"),
                },
            ];
        },
    },
};
</script>
<style scoped>
.guarantee-block {
    display: flex;
    flex-direction: column;
    width: 100%;
}

.title-card {
    color: var(--gray-1100, #f5faff);
    font-family: Unbounded;
    font-size: 36px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 43.2px */
    text-transform: uppercase;
    margin-bottom: 20px;
}

.text-system {
    width: 380px;
}

.text-card {
    color: var(--gray-170, rgba(245, 250, 255, 0.7));
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 110%; /* 19.8px */
}

.title-hosting {
    color: var(--gray-1100, #f5faff);
    text-align: right;
    font-family: Unbounded;
    font-size: 55px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 66px */
    text-transform: uppercase;
}

.guarantee-card {
    width: 464px;
    margin: 0 auto;
    margin-bottom: 100px;
}

.income-system-card {
    display: flex;
    justify-content: space-between;
}

.gray-line {
    padding: 32px 100px;
    border-bottom: 0.5px solid var(--gray-240, rgba(228, 231, 236, 0.4));
}

.gray-line-top {
    border-top: 0.5px solid var(--gray-240, rgba(228, 231, 236, 0.4));
}

.accordion-button {
    display: none;
}

.card-row {
    display: flex;
    justify-content: space-between;
    width: 100%;
}

@media (max-width: 950px) {
    .title-card {
        font-size: 24px;
    }

    .guarantee-card {
        width: 354px;
        margin-bottom: 80px;
        margin-top: 100px;
    }

    .card-row {
        flex-direction: column-reverse;
        align-items: flex-start;
    }

    .title-hosting {
        text-align: inherit;
        width: 100%;
        font-size: 44px;
    }

    .accordion-button {
        display: inline-block;
        height: 30px;
        margin-top: 32px;
        /* align-self: center; */
    }

    .guarantee-block {
        padding: 0;
    }

    .text-system {
        width: 590px;
    }

    .gray-line {
        padding: 30px 32px;
    }

    .text-web {
        display: none;
    }
}

@media (max-width: 450px) {
    .title-card {
        font-size: 18px;
    }

    .text-card {
        font-size: 14px;
    }

    .title-hosting {
        font-size: 22px;
    }

    .guarantee-card {
        width: 244px;
        margin-bottom: 70px;
    }

    .gray-line {
        padding: 20px 16px;
    }

    .text-system {
        width: 328px;
    }

    .card-row {
        gap: 10px;
    }

    .accordion-button {
        margin-top: 12px;
    }
}




</style>

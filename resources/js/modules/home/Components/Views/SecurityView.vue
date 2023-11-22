<template>
    <div class="security security__section" ref="view">
        <div class="security__wrapper">
            <landing-headline class="security__headline"
            >{{ $t("safety.button") }}
            </landing-headline>
            <landing-wrap >
                <template v-slot:title>
                    {{ $t("safety.encryption.title") }}
                </template>
                <template v-slot:content>
                    <landing-text
                        class="security_text"
                    >
                        {{ $t("safety.encryption.text") }}
                    </landing-text>
                </template>
            </landing-wrap >
            <landing-wrap>
                <template v-slot:title>
                    {{ $t("safety.updates.title") }}
                </template>
                <template v-slot:content>
                    <landing-text
                        class="security_text"
                    >
                        {{ $t("safety.updates.text") }}
                    </landing-text>
                </template>
            </landing-wrap>
            <landing-wrap >
                <template v-slot:title>
                    {{ $t("safety.DDoS.title") }}
                </template>
                <template v-slot:content>
                    <landing-text
                        class="security_text"
                    >
                        {{ $t("safety.DDoS.text") }}
                    </landing-text>
                </template>
            </landing-wrap>
        </div>
        <div class="security__hidden"></div>
    </div>
</template>

<script>
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import LandingHeadline from "@/modules/common/Components/UI/LandingHeadline.vue";
import LandingWrap from "@/modules/common/Components/blocks/LandingWrap.vue";
import LandingText from "@/modules/common/Components/UI/LandingText.vue";

export default {
    name: "SecurityView",
    components: {
        LandingText,
        LandingWrap,
        LandingHeadline,
    },
    props: {
        start: Boolean,
    },
    i18n: {
        sharedMessages: HomeMessage,
    },
    computed: {
        infoCards() {
            return {
                encryption: {
                    title: this.$t("safety.encryption.title"),
                    text: this.$t("safety.encryption.text"),
                },
                updates: {
                    title: this.$t("safety.updates.title"),
                    text: this.$t("safety.updates.text"),
                },
                DDoS: {
                    title: this.$t("safety.DDoS.title"),
                    text: this.$t("safety.DDoS.text"),
                },
            };
        },
    },
};
</script>

<style scoped>
.security {
    width: 100%;
}

@media (max-width: 767.87px) {
    .security {
        min-width: calc(100% - 64px);
    }
}






.security__hidden {
    opacity: 0;
    height: 0;
    max-width: 860px;
    width: 100%;
}

.security_text {
    font-size: clamp(14px, 1vw, 20px);
}

@media (max-width: 767.87px) {
    .security__headline {
        margin-bottom: 135px;
    }
}

.security__wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
}

@media (max-width: 1500.87px) {
    .security__wrapper {
        gap: 50px;
    }
}
</style>

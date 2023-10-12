<template>
    <div class="security security__section">
        <div class="security__wrapper">
            <landing-headline>{{ $t("safety.button") }}</landing-headline>
            <landing-wrap :title="infoCards[key].title">
                <template v-slot:content>
                    <landing-text class="security_text">
                        {{ infoCards[key].text }}
                    </landing-text>
                </template>
            </landing-wrap>
        </div>
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
    data() {
        return {
            key: "encryption",
            keys: ["encryption", "updates", "DDoS"],
        };
    },
};
</script>

<style scoped>
.security {
    width: 100%;
}

.security__wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
}

</style>

<template>
    <div class="confirm">
        <main-title class="confirm_title title-base">
            {{ $t("confirm.title") }}
        </main-title>
        <main-description class="confirm_description description-base">
            {{ $t("confirm.text[0]") }} {{ $route.query?.email }}
            {{ $t("confirm.text[1]") }}
        </main-description>
        <verify-link
            v-show="countResend < 2"
            class="confirm_link"
            verify-url="/email/verify"
            :verify-text="$t('re_send')"
            :send-verification="sendVerification"
            :data="{
                email: $route.query?.email,
            }"
            @sendVerification="incrementCountResend"
        />
        <a
            v-show="countResend >= 2"
            href="https://t.me/allbtc_support"
            class="confirm_link"
        >
            {{ $t("support") }}
        </a>
    </div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescriptionOld.vue";
import VerifyLink from "@/modules/verify/Components/UI/VerifyLink.vue";
import { AuthMessages } from "@/modules/auth/lang/AuthMessages";

export default {
    name: "ConfirmBlock",
    components: {
        VerifyLink,
        MainTitle,
        MainDescription,
    },
    i18n: {
        sharedMessages: AuthMessages,
    },
    data() {
        return {
            countResend: 0,
            sendVerification: false,
        };
    },
    mounted() {
        if (this.$route.query?.action !== "registration") {
            this.sendFirstVerification();
        }
        if (!this.$route.query?.email) {
            this.$router.push({
                name: "home",
            });
        }
    },
    methods: {
        incrementCountResend() {
            this.countResend++;
        },
        sendFirstVerification() {
            this.sendVerification = true;
        },
    },
};
</script>

<style scoped lang="scss">
.confirm {
    display: flex;
    flex-direction: column;

    &_title {
        margin-bottom: 32px;
        @media (max-width: $pc) {
            margin-bottom: 24px;
        }
        @media (max-width: $mobile) {
            margin-bottom: 16px;
        }
    }

    &_description {
        margin-bottom: 24px;
        @media (max-width: $mobile) {
            margin-bottom: 16px;
        }
    }

    &_link {
        min-width: 300px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 56px;
        padding: 0 16px;
        color: var(--buttons-primary-text, var(--main-gohan, #fff));
        font-family: NunitoSans, serif;
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
        border-radius: 12px;
        background: var(--primary-500, #2e90fa);
        box-shadow: 0 10px 10px -6px rgba(0, 0, 0, 0.1);
        width: fit-content;
    }
}
</style>

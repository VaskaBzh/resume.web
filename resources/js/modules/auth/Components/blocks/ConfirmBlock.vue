<template>
    <div class="confirm">
        <main-title tag="h3" class="confirm_title title-base">
            Подтверждение регистрации
        </main-title>
        <main-description class="confirm_description description-base">
            На почту {{ this.$route.query?.email }} было отправлено письмо со ссылкой для подтверждения регистрации. Проверьте папку “Спам“, если не обнаружили письмо в списке входящих.
        </main-description>
        <verify-link
            v-show="countResend < 2"
            class="confirm_link"
            verifyUrl="/email/verify"
            :verifyText="$t('re_send')"
            :sendVerification="sendVerification"
            :data="{
                email: this.$route.query?.email,
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
import MainDescription from "@/modules/common/Components/UI/MainDescription.vue";
import VerifyLink from "@/modules/verify/Components/UI/VerifyLink.vue";
import { AuthMessages } from "@/modules/auth/lang/AuthMessages";

export default {
    name: "confirm-block",
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
    methods: {
        incrementCountResend() {
            this.countResend++;
        },
        sendFirstVerification() {
            this.sendVerification = true;
        }
    },
    mounted() {
        if (this.$route.query?.action !== "registration") {
            this.sendFirstVerification();
        }
        if (!this.$route.query?.email) {
            this.$router.push({
                name: "home",
            })
        }
    }
}
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
        color: var(--icons-accent, #53B1FD);
        font-family: NunitoSans, serif;
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
    }
}
</style>

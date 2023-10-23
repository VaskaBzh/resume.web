<template>
    <div class="working__section working__section-blue" ref="view">
        <div class="working-card animation-scale">
            <p class="working-title">{{ inf.title }}</p>
            <p class="working-text">{{ inf.text }}</p>
        </div>
    </div>
</template>
<script>
import {HostingMessage} from "@/modules/hosting/lang/HostingMessage";

export default {
    i18n: {
        sharedMessages: HostingMessage,
    },
    computed: {
        inf() {
            return {
                title: this.$t("for_clients.button"),
                text: this.$t("for_clients.text"),
            };
        },
    },
};
</script>

<style scoped>
.working-card {
    width: 432px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 30px;
}

.working-title {
    color: var(--gray-3100, #d0d5dd);
    font-family: Unbounded;
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 19.2px */
    text-transform: uppercase;
    border-radius: 20px;
    border: 0.5px solid var(--secondary-gray, #98a2b3);
    padding: 10px 20px;
    display: inline-flex;
}

.working-text {
    color: var(--gray-170, rgba(245, 250, 255, 0.7));
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 110%; /* 19.8px */
}

@media (max-width: 450px) {
    .working-title {
        font-size: 12px;
        padding: 8px 10px;
    }

    .working-text {
        font-size: 14px;
    }

    .working-card {
        width: 266px;
        gap: 20px;
    }
}
</style>

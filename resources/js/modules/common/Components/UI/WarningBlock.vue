<template>
    <div class="warning">
        <warning-icon class="warning_icon" />
        <p class="warning_text">
            <span class="warning_text-elem">{{ $t(text) }}</span>
            <a
                href="https://t.me/allbtc_support"
                target="_blank"
                class="warning_text-link"
                v-if="!!link"
            >
                {{ $t(link) }}
            </a>
        </p>
    </div>
</template>

<script>
import WarningIcon from "@/modules/common/icons/WarningIcon.vue";

import { WarningMessages } from "@/modules/common/lang/WarningMessages";

export default {
    name: "warning-block",
    props: {
        text: String,
        link: {
            type: String,
            default: null,
        },
    },
    i18n: {
        sharedMessages: WarningMessages,
    },
    components: {
        WarningIcon,
    }
}
</script>

<style scoped>
.warning {
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--background-waiting, #37322D);
    padding: 16px;
    display: flex;
    gap: 12px;
    align-items: center;
}
.warning_icon {
    min-width: 24px;
    width: 24px;
    height: 24px;
}
.warning_text {
    color: var(--status-waiting, #FFB868);
    font-family: NunitoSans, serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 20px;
    display: inline-flex;
    flex-direction: column;
    gap: 4px;
}
.warning_text-link {
    text-decoration: underline;
}
</style>

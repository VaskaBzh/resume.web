<template>
    <div class="warning">
        <main-icon class="warning_icon icon-md icon-warning" name="warning" />
        <main-description
            v-i18n="$t(text, { time: time })"
            class="warning_text text-warning text-md"
        />
    </div>
</template>

<script>
import MainIcon from "@/modules/common/icons/MainIcon.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescription.vue";

import { WarningMessages } from "@/modules/common/lang/WarningMessages";

export default {
    name: "WarningBlock",
    components: {
        MainDescription,
        MainIcon,
    },
    props: {
        text: {
            type: String,
            default: "connecting_feedback",
        },
        time: {
            type: String,
            default: "24 часа.",
        },
    },
    i18n: {
        sharedMessages: WarningMessages,
    },
};
</script>

<style scoped>
.warning {
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--background-waiting, #37322d);
    padding: 16px;
    display: flex;
    gap: 12px;
    align-items: center;
}
.warning_icon {
    min-width: 24px;
}
</style>

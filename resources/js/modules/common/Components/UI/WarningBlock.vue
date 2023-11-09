<template>
    <a @click="openSupport"  class="warning">
        <main-icon class="warning_icon icon-md icon-warning" name="cabinet-help" />
        <main-description
            class="warning_text text-warning text-md"
        >
            <p class="warning_text">{{$t("connecting_text")}}</p>
            <p class="warning_link">{{$t("connecting_feedback")}}</p>
        </main-description>
    </a>
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
            default: "connecting_text",
        },
        time: {
            type: String,
            default: "24 часа.",
        },
    },
    i18n: {
        sharedMessages: WarningMessages,
    },
    computed: {
        openSupport() {
            window.open('https://t.me/allbtc_support')
        }
    }
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

.warning_link {
    border-bottom: .5px solid #ffb26b;
}
</style>

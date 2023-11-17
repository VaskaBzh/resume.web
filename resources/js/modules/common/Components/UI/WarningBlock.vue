<template>
    <div class="warning">
        <main-icon
            class="warning_icon icon-md icon-warning"
            name="cabinet-help"
        />
        <main-description class="warning_text text-warning text-md">
            <p v-i18n="$t(text)" class="warning_text"></p>
            <a
                v-show="!!link"
                href="https://t.me/allbtc_support"
                class="warning_link"
            >
                {{ $t(link) }}
            </a>
        </main-description>
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
            default: "connecting_text",
        },
        link: {
            type: String,
            default: "",
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

.warning_link {
    border-bottom: 0.5px solid #ffb26b;
}
</style>

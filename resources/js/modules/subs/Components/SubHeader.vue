<template>
    <div class="head">
        <main-search
            class="head_search"
            :placeholder="$t('search_placeholder')"
            @searched="$emit('searched', $event)"
        />
        <div class="head__buttons">
            <main-button
                class="button-md button-white"
                @click="$emit('open_add_popup')"
            >
                <template #svg>
                    <add-sub-icon class="head_icon" />
                </template>
            </main-button>
            <sub-type-buttons
                :subs-type="subsType"
                @changeType="$emit('changeType', $event)"
            />
        </div>
    </div>
</template>

<script>
import MainSearch from "@/modules/common/Components/inputs/MainSearch.vue";
import AddSubIcon from "@/modules/subs/icons/AddSubIcon.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";
import SubTypeButtons from "@/modules/subs/Components/UI/SubTypeButtons.vue";

import { SubMessages } from "@/modules/subs/lang/SubMessages";

export default {
    name: "SubHeader",
    components: {
        SubTypeButtons,
        AddSubIcon,
        MainSearch,
        MainButton,
    },
    props: {
        subsType: Boolean,
    },
    i18n: {
        sharedMessages: SubMessages,
    },
    emits: ["open_add_popup", "searched", "changeType"],
};
</script>

<style scoped>
.head {
    width: 100%;
    display: flex;
    justify-content: space-between;
    gap: 12px;
    align-items: center;
}

.head__buttons {
    display: flex;
    align-items: center;
    gap: 12px;
}

.head_icon {
    fill: var(--icons-primary);
    transition: all 0.5s ease 0s;
    stroke: transparent;
}

.head_icon:hover {
    fill: var(--buttons-tabs-text-focus, #2e90fa);
}
</style>

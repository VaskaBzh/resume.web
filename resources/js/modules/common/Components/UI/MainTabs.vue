<template>
    <div class="cabinet__buttons">
        <button
            class="cabinet_button referal-btns"
            v-for="(tab, i) in tabs"
            :key="i"
            :class="{
                active:
                    (tab.value?.length
                        ? tab.value[tab.value.length - 1]
                        : tab.value) === active,
            }"
            @click="$emit('getValue', tab.value)"
        >
            {{ this.$t(`tabs[${i}]`) }}
        </button>
    </div>
</template>

<script>
import {ReferralsMessage} from "../../../referral/lang/ReferralsMessage";

export default {
    name: "main-tabs",
    props: {
        tabs: Array,
        active: Number,
    },
    i18n: {
        sharedMessages: ReferralsMessage,
    },
};
</script>

<style scoped lang="scss">
@media (max-width: 497.98px) {
    .referal-btns {
        font-size: 12px;
        font-style: normal;
        font-weight: 600;
        line-height: 16px;
        padding: 10px 12px;
        height: 34px;
    }
}

</style>

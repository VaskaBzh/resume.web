<template>
    <main-popup
        id="cardPopup"
        :wait="wait"
        :closed="closed"
        :opened="opened"
        @closed="$emit('dropWatcher')"
    >
        <slot />
    </main-popup>
</template>

<script>
import MainPopup from "@/modules/popup/Components/MainPopup.vue";
import { mapGetters } from "vuex";
import { WatchersMessage } from "@/modules/watchers/lang/WatchersMessages";

export default {
    name: "watchers-popup-card",
    components: {
        MainPopup,
    },
    props: {
        wait: Boolean,
        closed: Boolean,
        opened: Boolean,
    },
    i18n: {
        sharedMessages: WatchersMessage,
    },
    computed: {
        ...mapGetters(["errorsExpired"]),
    },
};
</script>

<style>
#cardPopup .card {
    min-height: fit-content;
    padding: 0;
}
</style>

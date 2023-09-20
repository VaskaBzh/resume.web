<template>
    <main-popup
        id="addWatcher"
        :wait="wait"
        :closed="closed"
        :errors="errors"
        :openedOff="opened"
    >

    </main-popup>
</template>

<script>
import MainPopup from "@/Components/technical/MainPopup.vue";
import {  mapGetters } from "vuex";

export default {
    name: "watchers-popup",
    components: {
        MainPopup,
    },
    props: {
        wait: Boolean,
        closed: Boolean,
        opened: Boolean,
    },
    computed: {
        ...mapGetters(["errors"]),
    }
}
</script>

<style scoped>

</style>

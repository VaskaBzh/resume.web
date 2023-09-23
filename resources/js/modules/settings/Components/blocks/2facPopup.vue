<template>
    <main-popup id="2fac" :wait="wait" :closed="closed">

    </main-popup>
</template>

<script>
import MainPopup from "@/Components/technical/MainPopup.vue";

export default {
    name: "2fac-popup",
    props: {
        closed: Boolean,
        wait: Boolean,
    },
    components: {
        MainPopup,
    },
};
</script>

<style scoped></style>

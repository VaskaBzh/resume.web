<template>
    <main-title tag="h1" class="statistic__title" style="width: 100%">
        Добро пожаловать!
    </main-title>
</template>
<script>
import { Head } from "@inertiajs/vue3";
import MainTitle from "@/Components/UI/MainTitle.vue";

export default {
    components: { MainTitle, Head },
    data() {
        return {};
    },
    mounted() {
        document.querySelector("html").classList.remove("popup-show", "lock");
    },
};
</script>
<style lang="scss" scoped>
.title {
    @media (min-width: 1271px) {
        padding-left: 310px;
    }
}
</style>

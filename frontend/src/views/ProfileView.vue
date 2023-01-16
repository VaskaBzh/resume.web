<template>
    <div class="account">
        <div class="account__container">
            <nav-tabs />
            <router-view />
        </div>
    </div>
</template>
<script>
import NavTabs from "@/components/navs/NavTabs";
// import { onMounted } from "vue";

export default {
    components: {
        NavTabs,
    },
};
</script>
<style lang="scss">
.account {
    margin-top: 32px;
    &__container {
        display: flex;
        justify-content: space-between;
    }
}
</style>

<template>
    <router-link :to="{ name: 'home' }" class="logo">
        <img
            class="logo_img"
            src="../../assets/img/logo-tabs.svg"
            alt="logo"
            v-show="!isDark"
        />
        <img
            class="logo_img"
            src="../../assets/img/logo-tabs-dark.svg"
            alt="logo"
            v-show="isDark"
        />
    </router-link>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "logo-block",
    computed: {
        ...mapGetters(["isDark"]),
    },
};
</script>

<style scoped>
.logo {
    display: inline-flex;
    justify-content: center;
    align-items: flex-start;
    gap: 10px;
    flex-shrink: 0;
}
.logo_block {
    display: flex;
    max-height: 54px;
    flex-direction: column;
}
.logo_img-pool {
    width: 47px;
    height: 23px;
}

img {
  max-width: 100%;
  height: 100%;
}
</style>

<template>
    <router-link :to="{ name: 'home' }">
        <div class="logo">
            <img class="logo_img" src="../../assets/img/logo-img.svg" alt="logo" />
            <div class="logo_block">
                <img
                    class="logo_img"
                    src="../../assets/img/logo-allbtc.svg"
                    alt="logo"
                />
                <img
                    class="logo_img-pool"
                    src="../../assets/img/logo-pool.svg"
                    alt="logo"
                />
            </div>
        </div>
    </router-link>
</template>

<script>
export default {
    name: "logo-block",
};
</script>

<style scoped>
.logo {
    display: inline-flex;
    padding: 40px 0 40px 16px;
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
</style>

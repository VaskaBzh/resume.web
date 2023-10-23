<template>
    <div class="logo">
        <div class="logo__content">
            <span class="logo_elem logo_elem-first">
                <allbtc-logo-icon/>
            </span>
            <span class="logo_elem logo_elem-last">
                <pool-logo-icon/>
            </span>
        </div>
    </div>
</template>

<script>
import PoolLogoIcon from "@/modules/home/icons/PoolLogoIcon.vue";
import AllbtcLogoIcon from "@/modules/home/icons/AllbtcLogoIcon.vue";

export default {
    name: "logo-background",
    components: {
        PoolLogoIcon,
        AllbtcLogoIcon,
    },
};
</script>

<style scoped>
.logo {
    width: 100vw;
    min-height: 400px;
    position: absolute;
    top: 50vh;
    left: 50vw;
    transform: translate(-50vw, -50vh);
    z-index: -1;
}

@media (max-width: 768.98px) {
    .logo {
        top: 38vh;
    }
}

.logo__content {
    width: 100%;
    display: flex;
    flex-direction: column;
    max-width: 1920px;
    margin: 0 auto;
    padding: 160px 100px 0;
}
@media (max-width: 1300px) {
    .logo__content {
        padding: 20vh 100px 0;
    }
}
@media (max-width: 768px) {
    .logo__content {
        padding: 25vh 5vw 0px;
    }
}

.logo_elem {
    display: inline-block;
}

.logo_elem svg {
    width: 100%;
    height: 100%;
}

.logo_elem-first {
    height: 348px;
}

@media (max-width: 1300px) {
    .logo_elem-first {
        width: 600px;
        height: 260px;
    }
}
@media (max-width: 768px) {
    .logo_elem-first {
        width: 450px;
        height: unset;
    }
}
@media (max-width: 470px) {
    .logo_elem-first {
        width: 320px;
    }
}

.logo_elem-last {
    margin-left: auto;
    margin-top: -46px;
    width: 778px;
    height: 348px;
}

@media (max-width: 1300px) {
    .logo_elem-last {
        width: 500px;
        height: 260px;
    }
}
@media (max-width: 768px) {
    .logo_elem-last {
        width: 400px;
    }
}
@media (max-width: 470px) {
    .logo_elem-last {
        width: 300px;
    }
}
</style>

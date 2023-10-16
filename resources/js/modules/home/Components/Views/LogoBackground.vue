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
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: -1;
}

.logo__content {
    width: 100%;
    display: flex;
    flex-direction: column;
    max-width: 1920px;
    margin: 0 auto;
    padding: 0 clamp(16px, 10vw, 100px);
}

.logo_elem {
    display: inline-block;
}

.logo_elem svg {
    width: 100%;
    height: 100%;
}

.logo_elem-first {
    width: clamp(324px, 50vw, 1070px);
    height: clamp(106px, 24vw, 348px);
}

.logo_elem-last {
    margin-left: auto;
    margin-top: -46px;
    width: clamp(237px, 50vw, 778px);
    height: clamp(106px, 24vw, 348px);
}

@media (max-width: 1300px) {
    .logo_elem-last {
        margin-top: 16px;
    }
}
</style>

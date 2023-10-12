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
    top: 242px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 0;
}

.logo__content {
    width: 100%;
    display: flex;
    flex-direction: column;
    max-width: 1920px;
    padding: 0 100px;
    margin: 0 auto;
}

.logo_elem {
    display: inline-block;
}

.logo_elem-first {
    width: clamp(1070px, 10vw, 324px);
}

.logo_elem-last {
    margin-left: auto;
    margin-top: -46px;
    width: clamp(778px, 10vw, 237px);
}
</style>

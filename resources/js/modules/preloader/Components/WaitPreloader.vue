<template>
    <div
        class="preloader cabinet__block"
        v-scroll="'opacity transition--fast'"
        v-show="!killPreloaderCondition"
    >
        <div class="preloader__wrap">
            <div class="preloader__icon">
                <preloader-logo-icon
                    class="preloader_logo"
                    id="preloader_logo"
                />
                <preloader-container-icon
                    class="preloader__icon-custom"
                    @getPolygon="service.setPolygon($event)"
                />
            </div>
        </div>
    </div>
</template>

<script>
import PreloaderLogoIcon from "../icons/PreloaderLogoIcon.vue";

import PreloaderContainerIcon from "../icons/PreloaderContainerIcon.vue";
import { WaitPreloaderService } from "@/modules/preloader/services/WaitPreloaderService";

export default {
    name: "main-preloader",
    props: {
        wait: Boolean,
        interval: {
            type: Number,
            default: 15,
        },
    },
    computed: {
        killPreloaderCondition() {
            return !this.wait;
        },
    },
    components: {
        PreloaderLogoIcon,
        PreloaderContainerIcon,
    },
    data() {
        return {
            service: new WaitPreloaderService(),
            crossVisible: false,
            progressVisible: false,
        };
    },
    watch: {
        killPreloaderCondition(newState) {
            if (!newState) {
                this.service.startProcess(this.interval);
            }
        },
    },
    mounted() {
        this.service.startProcess(this.interval);
    },
};
</script>

<style lang="scss" scoped>
.preloader {
    display: flex;
    justify-content: center;
    align-items: center;
    &__wrap {
        width: 150px;
        height: 150px;
        transition: all 0.8s ease 0s;
        position: relative;
        display: flex;
    }
    &_logo {
        position: absolute;
        top: 50%;
        left: 50%;
        transition: all 0.8s ease 0s;
        transform: translate(-50%, -50%);
        &-center {
            top: 50%;
        }
    }
    &__icon {
        position: relative;
        height: 150px;
        width: 100%;
        transition: all 0.5s ease 0s;
        &-custom {
            overflow: visible;
        }
    }
    &_polygon {
        position: absolute;
        left: 0;
        top: 100%;
        transform-origin: center center;
    }
}
</style>

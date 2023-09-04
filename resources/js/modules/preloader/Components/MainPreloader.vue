<template>
    <div
        class="preloader cabinet__block cabinet__block-light"
        v-scroll="'opacity transition--fast'"
        v-show="!killPreloaderCondition"
    >
        <div class="preloader__wrap">
            <div class="preloader_icon">
                <preloader-circle-icon class="preloader_circle" id="preloader_circle" v-show="false" @getElement="service.setCircleElement($event)" @dropContainer="service.dropElement($event)" />
                <preloader-end-icon class="preloader_cross" id="preloader_cross" v-show="endConditionWithoutSlots" />
                <preloader-line-icon v-show="false" @getElement="service.setLineElement($event)" @dropContainer="service.dropElement($event)" />
                <preloader-logo-icon class="preloader_logo" id="preloader_logo" v-show="!endConditionWithoutSlots" />

                <preloader-container-icon class="preloader_icon-custom" @getPolygon="service.setPolygon($event)" @getContainer="service.setContainerElement($event)" />
            </div>

            <span class="preloader_progress">{{ progressValue }}</span>
        </div>
    </div>
    <!--        class="no-info no-bg"-->
<!--    <div-->
<!--        v-scroll="'opacity'"-->
<!--        v-else-if="empty && Object.entries($slots).length > 0"-->
<!--    >-->
<!--        <slot />-->
<!--    </div>-->
<!--    <div v-scroll="'opacity'" class="no-info" v-else-if="empty">-->
<!--        <img src="../../../../assets/img/img_no-info.svg" alt="no_info" />-->
<!--        <span>{{ $t("no_info") }}</span>-->
<!--    </div>-->
</template>

<script>
import PreloaderCircleIcon from "../icons/PreloaderCircleIcon.vue";
import PreloaderEndIcon from "../icons/PreloaderEndIcon.vue";
import PreloaderLineIcon from "../icons/PreloaderLineIcon.vue";
import PreloaderLogoIcon from "../icons/PreloaderLogoIcon.vue";

import { PreloaderService } from "../services/PreloaderService";
import PreloaderContainerIcon from "../icons/PreloaderContainerIcon.vue";

export default {
    name: "main-preloader",
    props: {
        wait: Boolean,
        end: Boolean,
        empty: {
            type: Boolean,
            default: false,
        },
        interval: {
            type: Number,
            default: 15,
        },
    },
    computed: {
        endConditionWithoutSlots() {
            return !this.wait && this.empty && Object.entries(this.$slots).length === 0;
        },
        killPreloaderCondition() {
            return !this.wait && !this.empty && this.end;
        },
        progressValue() {
            return this.endConditionWithoutSlots ? this.$t('no_info') : `${this.service.progressPercentage}%`;
        },
    },
    components: {
        PreloaderCircleIcon,
        PreloaderEndIcon,
        PreloaderLineIcon,
        PreloaderLogoIcon,
        PreloaderContainerIcon,
    },
    data() {
        return {
            service: new PreloaderService(),
        };
    },
    watch: {
        end(newEndVal) {
            this.service.endProcess(newEndVal);
        },
        progressPercentage() {
            this.service.slowProcess();
        },
    },
    mounted() {
        this.service.startProcess(this.interval);
    },
    beforeUnmount() {
        this.service.killInterval();
    },
};
</script>

<style lang="scss">
.preloader {
    display: flex;
    justify-content: center;
    align-items: center;
    &__wrap {
        width: 150px;
        height: 190px;
        position: relative;
    }
    &_icon {
        &-custom {
            position: relative;
            overflow: visible;
            margin-top: 75px;
        }
    }
    &_progress {
        color: #4066B5;
        font-size: 18px;
        font-weight: 700;
        line-height: 24px;
    }
    &_line {
        position: absolute;
        left: 0;
        top: 100%;
        transform-origin: center top;
    }
}
</style>

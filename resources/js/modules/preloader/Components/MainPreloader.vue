<template>
    <div
        class="preloader cabinet__block"
        v-scroll="'opacity transition--fast'"
        v-show="!killPreloaderCondition"
    >
        <div
            class="preloader__wrap"
            :class="{
                'preloader__wrap-no-info':
                    service.animateService.isCrossVisible?.animateState,
            }"
        >
            <div class="preloader__icon">
                <preloader-end-icon
                    class="preloader_cross"
                    id="preloader_cross"
                    @getCross="service.setCross($event)"
                    v-if="
                        !service.animateService.cross.element
                        || service.animateService.isCrossVisible?.animateState
                    "
                />
                <preloader-logo-icon
                    class="preloader_logo"
                    id="preloader_logo"
                    :class="{
                        'preloader_logo-center':
                            service.animateService.isLogoCenter?.animateState,
                    }"
                />
                <preloader-container-icon
                    class="preloader__icon-custom"
                    @getPolygon="service.setPolygon($event)"
                />
            </div>
            <transition name="progress">
                <span
                    class="preloader_progress"
                    v-if="service.animateService.isProgressVisible?.animateState"
                >
                    {{
                        String(service.progressPercentage).length <= 3
                            ? `${service.progressPercentage}%`
                            : $t(service.progressPercentage)
                    }}
                </span>
            </transition>
        </div>
    </div>
</template>

<script>
import PreloaderEndIcon from "../icons/PreloaderEndIcon.vue";
import PreloaderLogoIcon from "../icons/PreloaderLogoIcon.vue";

import { PreloaderService } from "../services/PreloaderService";
import PreloaderContainerIcon from "../icons/PreloaderContainerIcon.vue";
import { mapGetters } from "vuex";

export default {
    name: "main-preloader",
    props: {
        wait: Boolean,
        empty: {
            type: Boolean,
            default: false,
        },
        interval: {
            type: Number,
            default: 15,
        },
    },
    components: {
        PreloaderEndIcon,
        PreloaderLogoIcon,
        PreloaderContainerIcon,
    },
    computed: {
        ...mapGetters(["getActive"]),
        killPreloaderCondition() {
            return (
                !this.service.waitTable.state &&
                !this.service.emptyTable.state &&
                this.service.endTable.state
            );
        },
    },
    data() {
        return {
            service: new PreloaderService(),
        };
    },
    watch: {
        wait(newWaitState) {
            this.service.setWaitState(newWaitState)
                .setEndState(!newWaitState);
        },
        empty(newEmptyState) {
            this.service
                .setEmptyState(newEmptyState)
                .setCrossVisible(newEmptyState)
                .setLogoCenter(newEmptyState);
        },
        "service.endTable.state"(newEndVal) {
            this.service.setProgressVisible(!newEndVal)
                .endProcess(newEndVal);
        },
        getActive(newId, oldId) {
            if (oldId !== -1) {
                this.service.startProcess(this.interval);
            }
        },
    },
    mounted() {
        this.service.startProcess(this.interval);
    },
    unmounted() {
        this.service.endProcess(true);
    },
};
</script>

<style lang="scss" scoped>
.preloader {
    display: flex;
    justify-content: center;
    align-items: center;
    &-enter-active,
    &-leave-active {
        transition: opacity 0.5s ease 0s;
    }
    &-enter-from,
    &-leave-to {
        opacity: 0;
        visibility: hidden;
    }
    &_img {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 160px;
        height: 160px;
        transition: none;
    }
    &__wrap {
        width: 150px;
        height: 190px;
        transition: all 0.8s ease 0s;
        position: relative;
        display: flex;
        &-no-info {
            .preloader {
                &__icon {
                    margin: 0;
                }
                &_progress {
                    bottom: 0;
                    font-weight: 400;
                    font-family: NunitoSans, serif;
                }
            }
        }
    }
    &_logo {
        position: absolute;
        top: 40%;
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
        margin: 20px 0 0;
        transition: all 0.5s ease 0s;
        &-custom {
            overflow: visible;
        }
    }
    &_cross {
        position: absolute;
        bottom: -6px;
        right: 34px;
    }
    &_progress {
        color: #4066b5;
        font-size: 16px;
        font-weight: 700;
        line-height: 24px;
        position: absolute;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        transition: top 0.8s ease 0s;
        white-space: nowrap;
        &.progress {
            &-enter-active {
                transition: opacity 0.8s ease 0s, top 0.8s ease 0s;
            }
            &-leave-active {
                transition: opacity 0.2s ease 0s, top 0.8s ease 0s;
            }
            &-enter-from,
            &-leave-to {
                opacity: 0;
            }
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

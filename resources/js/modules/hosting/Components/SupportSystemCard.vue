<template>
    <div class="support__section support__section-wrap" ref="view">
        <div class="system-card-inf">
            <p class="system-card-title">{{ $t("support.title") }}</p>
            <p class="system-card-text">{{ $t("support.text") }}</p>
        </div>
        <div class="system-card-img">
            <img
                src="../assets/img/Mockup-iphone.png"
                class="img-iphone img-system"
            />
            <img
                src="../assets/img/Mockup-support.png"
                class="img-support img-system"
                v-if="$i18n.locale == 'ru'"
            />
            <img
                src="../assets/img/Mockup-support-en.png"
                class="img-support img-system"
                v-else
            />
        </div>
    </div>
</template>
<script>
import {HostingMessage} from "@/modules/hosting/lang/HostingMessage";

export default {
    i18n: {
        sharedMessages: HostingMessage,
    },
};
</script>
<style scoped>
.system-card-inf {
    width: 399px;
    margin-bottom: 50px;
}

.system-card-title {
    color: var(--gray-1100, #f5faff);
    font-family: Unbounded;
    font-size: 36px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 43.2px */
    text-transform: uppercase;
    margin-bottom: 20px;
}

.system-card-text {
    color: var(--gray-170, rgba(245, 250, 255, 0.7));
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 110%; /* 19.8px */
}

.system-card-img {
    position: relative;
    width: 408px;
    height: 722px;
}

.img-system {
    position: absolute;
}

.img-support {
    left: 42px;
    top: 12px;
}

.img-iphone {
    z-index: 10;
}

@media (max-width: 768px) {
    .system-card-title {
        font-size: 24px;
    }
}

@media (max-width: 460px) {
    .system-card-title {
        font-size: 18px;
    }

    .system-card-text {
        font-size: 14px;
    }

    .system-card-inf {
        width: 244px;
    }

    .system-card-img,
    .img-iphone {
        width: 281px;
        height: 497px;
    }

    .img-support {
        width: 224px;
        height: 482px;
        left: 29px;
        top: 9px;
    }
}
</style>

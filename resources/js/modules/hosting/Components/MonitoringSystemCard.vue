<template>
    <div class="system__section-wrap" ref="view">
        <div class="system__section">
            <div class="system-card-inf">
                <p class="system-card-title">
                    {{ $t("system_monitoring.title[0]") }} <br/>
                    {{ $t("system_monitoring.title[1]") }} <br/>
                    {{ $t("system_monitoring.title[2]") }}
                </p>
                <p class="system-card-text">{{ $t("system_monitoring.text") }}</p>
            </div>
            <div class="system-card-img">
                <img
                    src="../assets/img/Mockup-mac.png"
                    class="img-mac img-system web"
                />
                <!--            <img-->
                <!--                src="../assets/img/Mockup-monitoring-ru.png"-->
                <!--                class="img-monitoring img-system web"-->
                <!--                v-show="$i18n.locale === 'ru'"-->
                <!--            />-->
                <img
                    src="../assets/img/Mockup-monitoring-en.png"
                    class="img-monitoring img-system web"
                />

                <img
                    src="../assets/img/Mockup-iphone.png"
                    class="img-mac img-system mobile"
                />
                <!--            <img-->
                <!--                src="../assets/img/Mockup-monitoring-iphone-ru.png"-->
                <!--                class="img-monitoring img-system mobile"-->
                <!--                v-show="$i18n.locale === 'ru'"-->
                <!--            />-->
                <img
                    src="../assets/img/Mockup-monitoring-iphone-en.png"
                    class="img-monitoring img-system mobile"
                />
            </div>
            <a
                href="https://t.me/allbtc_connect"
                target="_blank"
                class="get-consultation"
            >{{ $t("system_monitoring.button") }}</a
            >
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
    width: 100%;
    max-width: 399px;
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
    max-width: 990px;
    margin: 0 auto clamp(40px, 5vw, 50px);
    width: 100%;
    height: 560px;
}

.img-system {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
}

.img-monitoring {
    max-width: 80%;
    left: 50%;
    top: calc(50% - 15px);
}

.get-consultation {
    color: var(--gray-1100, #f5faff);
    text-align: center;
    font-family: Unbounded;
    font-size: 14px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 16.8px */
    text-transform: uppercase;
    border-radius: 40px;
    border: 1px solid rgba(192, 228, 255, 0.6);
    background: var(--gray-480, rgba(13, 13, 13, 0.8));
    padding: 8px 20px;
    width: 100%;
    max-width: 400px;
}

.img-mac {
    z-index: 10;
}

.mobile {
    display: none;
    max-width: 80%;
    transform: translate(-50%, -50%);
    left: 50%;
}

@media (max-width: 1450px) {
    .system-card-img,
    .img-mac {
        width: 100%;
    }

    .img-monitoring {
        width: 100%;
    }

    .get-consultation {
        width: 100%;
        max-width: 80%;
    }

    .system-card-title {
        font-size: 24px;
    }
}

@media (max-width: 450px) {
    .mobile {
        display: inline-block;
    }

    .web {
        display: none;
    }

    .system-card-img,
    .img-mac {
        width: 100%;
    }

    .img-monitoring {
        top: 50%;
        width: 65%;
    }

    .system-card-inf {
        width: 100%;
    }

    .system-card-title {
        font-size: 18px;
    }

    .system-card-text {
        font-size: 14px;
    }

    .get-consultation {
        width: 100%;
        max-width: 328px;
        font-size: 12px;
    }
}
</style>
